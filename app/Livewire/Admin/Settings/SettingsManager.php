<?php

namespace App\Livewire\Admin\Settings;

use App\Models\CustomIcon;
use App\Models\MediaAsset;
use App\Models\Setting;
use App\Services\MediaStorageService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
class SettingsManager extends Component
{
    use WithFileUploads;

    public string $activeTab = 'general';

    public array $settings = [];
    public array $socialLinks = [];

    // Media Modal File Upload State (Prevents crash when uploading via Media Modal in Settings)
    public $uploads = [];
    public string $uploadFolder = 'branding';
    public bool $autoCompress = true;

    // Custom Icon Upload State for Modal
    public $modalUploadedFile;
    public string $modalCustomIconTitle = '';
    public string $modalRawSvgCode = '';
    public ?string $modalTargetField = null;
    public ?int $modalTargetIndex = null;

    public function mount(): void
    {
        $existing = Setting::all()->pluck('value', 'key')->toArray();

        $defaults = [
            'site_name'            => 'Nordroy CMS',
            'site_tagline'         => 'Marine & Power Platform',
            'contact_email'        => 'contact@nordroy.com',
            'contact_phone'        => '+880 1700-000000',
            'whatsapp_number'      => '+880 1700-000000',
            'company_address'      => 'Corporate Headquarters, Port Area, Chattogram, Bangladesh',
            'google_maps_embed'    => '',
            'site_logo'            => 'assets/images/logo.png',
            'site_icon'            => 'assets/images/icon.png',
            'storage_driver'       => 'public',
            's3_key'               => '',
            's3_secret'            => '',
            's3_region'            => 'auto',
            's3_bucket'            => '',
            's3_endpoint'          => '',
            's3_cdn_url'           => '',
            'default_timezone'     => 'Asia/Dhaka',
            'date_format'          => 'd M, Y',
            'time_format'          => 'h:i A',
            'custom_head_scripts'  => '',
            'custom_footer_scripts'=> '',
        ];

        $this->settings = array_merge($defaults, $existing);

        $storedSocial = Setting::get('social_links_data');
        if ($storedSocial) {
            $this->socialLinks = is_array($storedSocial) ? $storedSocial : (json_decode($storedSocial, true) ?? []);
        } else {
            $this->socialLinks = [
                ['title' => 'LinkedIn',    'url' => 'https://linkedin.com/company/nordroy', 'icon_type' => 'library', 'icon' => 'brands:linkedin', 'custom_path' => null],
                ['title' => 'Facebook',    'url' => '', 'icon_type' => 'library', 'icon' => 'brands:facebook', 'custom_path' => null],
                ['title' => 'X / Twitter', 'url' => '', 'icon_type' => 'library', 'icon' => 'brands:twitter', 'custom_path' => null],
                ['title' => 'YouTube',     'url' => '', 'icon_type' => 'library', 'icon' => 'brands:youtube', 'custom_path' => null],
            ];
        }
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    #[On('media-selected')]
    public function handleMediaSelected(int $assetId, string $assetUrl, ?string $targetField = null, ?int $targetIndex = null): void
    {
        $this->selectAsset($assetId, $assetUrl, $targetField, $targetIndex);
    }

    public function selectAsset(int $assetId, string $assetUrl, ?string $targetField = null, ?int $targetIndex = null): void
    {
        $field = $targetField ?: $this->modalTargetField;

        if ($field && array_key_exists($field, $this->settings)) {
            if (str_starts_with($assetUrl, 'http://') || str_starts_with($assetUrl, 'https://')) {
                $localPrefix = asset('');
                if (str_starts_with($assetUrl, $localPrefix)) {
                    $cleanUrl = ltrim(str_replace($localPrefix, '', $assetUrl), '/');
                } else {
                    $cleanUrl = $assetUrl;
                }
            } else {
                $cleanUrl = ltrim(str_replace('storage/', '', $assetUrl), '/');
                $cleanUrl = 'storage/' . $cleanUrl;
            }

            $this->settings[$field] = $cleanUrl;
            Setting::set($field, $cleanUrl, 'general');
            session()->flash('message', 'Asset successfully selected and synchronized.');
        }
    }

    /**
     * Upload brand assets directly through Media Modal when in Settings.
     */
    public function uploadFiles(): void
    {
        if (empty($this->uploads) || !is_array($this->uploads)) {
            $this->addError('uploads', 'Please select at least one file to upload.');
            return;
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'svg', 'pdf', 'gif', 'ico'];
        $service = app(MediaStorageService::class);
        $lastAsset = null;
        $successCount = 0;

        foreach ($this->uploads as $file) {
            if ($file) {
                $ext = strtolower($file->getClientOriginalExtension());
                if (!in_array($ext, $allowedExtensions)) {
                    continue;
                }

                $lastAsset = $service->store($file, $this->uploadFolder, null, $this->autoCompress);
                $successCount++;

                // Dispatch reactive event to instantly update Alpine asset list in modal
                $this->dispatch('media-asset-uploaded', [
                    'id'       => $lastAsset->id,
                    'name'     => $lastAsset->getTranslation('title', 'en') ?: $lastAsset->file_name,
                    'url'      => $lastAsset->url,
                    'is_image' => in_array(strtolower(pathinfo($lastAsset->file_name, PATHINFO_EXTENSION)), ['jpg','jpeg','png','webp','svg','gif','ico']),
                    'size'     => $lastAsset->human_size,
                    'folder'   => $lastAsset->folder,
                ]);
            }
        }

        $this->uploads = [];

        if ($successCount > 0) {
            if ($this->modalTargetField && $lastAsset) {
                $this->selectAsset($lastAsset->id, $lastAsset->url, $this->modalTargetField, $this->modalTargetIndex);
            }
            session()->flash('message', "{$successCount} asset(s) successfully processed and added to library.");
            $this->dispatch('close-media-modal');
        }
    }

    /**
     * Single atomic update method for Icon Picker to avoid 3 sequential HTTP requests.
     */
    public function selectIconAsset(?string $targetField, ?int $targetIndex, string $iconId, ?string $targetTypeField = null): void
    {
        $field = $targetField ?: $this->modalTargetField;
        $index = $targetIndex ?? $this->modalTargetIndex;

        if ($field === 'socialLinks' && $index !== null && isset($this->socialLinks[$index])) {
            $isCustom = str_starts_with($iconId, 'storage/') || str_starts_with($iconId, 'http') || str_starts_with($iconId, 'raw_svg:') || str_starts_with($iconId, 'custom_');
            $this->socialLinks[$index]['icon'] = $iconId;
            if ($targetTypeField) {
                $this->socialLinks[$index][$targetTypeField] = $isCustom ? 'upload' : 'library';
                if ($isCustom) {
                    $this->socialLinks[$index]['custom_path'] = $iconId;
                }
            }
        } elseif ($field && array_key_exists($field, $this->settings)) {
            $this->settings[$field] = $iconId;
        }
    }

    public function removeSettingAsset(string $key, string $fallback): void
    {
        $this->settings[$key] = $fallback;
        Setting::set($key, $fallback, 'general');
        session()->flash('message', 'Asset reset to default.');
    }

    public function addSocialLink(): void
    {
        $this->socialLinks[] = [
            'title'       => '',
            'url'         => '',
            'icon_type'   => 'library',
            'icon'        => 'solid:globe',
            'custom_path' => null,
        ];
    }

    public function removeSocialLink(int $index): void
    {
        unset($this->socialLinks[$index]);
        $this->socialLinks = array_values($this->socialLinks);
    }

    /**
     * Upload custom file (PNG/SVG/WebP) directly into dedicated CustomIcon database & storage.
     */
    public function uploadCustomIcon(): void
    {
        $this->validate([
            'modalUploadedFile'    => 'required|file|max:3072',
            'modalCustomIconTitle' => 'nullable|string|max:50',
        ]);

        $ext = strtolower($this->modalUploadedFile->getClientOriginalExtension());
        if (!in_array($ext, ['svg', 'png', 'webp', 'jpg', 'jpeg', 'ico'])) {
            $this->addError('modalUploadedFile', 'Supported formats: SVG, PNG, WebP, JPG, ICO.');
            return;
        }

        $dir = storage_path('app/public/custom-icons');
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $count = CustomIcon::count();
        if (!empty(trim($this->modalCustomIconTitle))) {
            $baseName = Str::slug($this->modalCustomIconTitle);
            $readableTitle = trim($this->modalCustomIconTitle);
        } else {
            $original = Str::slug(pathinfo($this->modalUploadedFile->getClientOriginalName(), PATHINFO_FILENAME));
            $baseName = !empty($original) ? $original : 'icon_' . ($count + 1);
            $readableTitle = ucwords(str_replace(['-', '_'], ' ', $baseName));
        }

        $cleanFileName = "{$baseName}.{$ext}";
        $counter = 1;
        while (File::exists($dir . DIRECTORY_SEPARATOR . $cleanFileName)) {
            $cleanFileName = "{$baseName}_{$counter}.{$ext}";
            $counter++;
        }

        $this->modalUploadedFile->storeAs('custom-icons', $cleanFileName, 'public');
        $storedPath = 'storage/custom-icons/' . $cleanFileName;

        $icon = CustomIcon::create([
            'title'      => $readableTitle,
            'type'       => 'file',
            'file_path'  => $storedPath,
            'file_name'  => $cleanFileName,
            'created_by' => auth()->id(),
        ]);

        // Dynamically assign to target field
        if ($this->modalTargetField === 'socialLinks' && $this->modalTargetIndex !== null && isset($this->socialLinks[$this->modalTargetIndex])) {
            $this->socialLinks[$this->modalTargetIndex]['icon'] = $storedPath;
            $this->socialLinks[$this->modalTargetIndex]['icon_type'] = 'upload';
            $this->socialLinks[$this->modalTargetIndex]['custom_path'] = $storedPath;
        } elseif ($this->modalTargetField && array_key_exists($this->modalTargetField, $this->settings)) {
            $this->settings[$this->modalTargetField] = $storedPath;
        }

        $this->modalUploadedFile = null;
        $this->modalCustomIconTitle = '';

        $this->dispatch('custom-icon-saved', 
            iconId: $icon->id, 
            iconPath: $storedPath, 
            iconUrl: asset($storedPath),
            iconName: $readableTitle,
            isRawSvg: false,
            rawSvg: null
        );

        session()->flash('message', "Custom Icon '{$readableTitle}' successfully saved to library!");
    }

    /**
     * Store Raw SVG Code directly without JSON array conflicts.
     */
    public function saveRawSvgIcon(): void
    {
        $this->validate([
            'modalRawSvgCode'      => 'required|string|min:20',
            'modalCustomIconTitle' => 'nullable|string|max:50',
        ]);

        $rawSvg = trim($this->modalRawSvgCode);
        if (!str_contains($rawSvg, '<svg') || !str_contains($rawSvg, '</svg>')) {
            $this->addError('modalRawSvgCode', 'Please paste valid <svg>...</svg> code.');
            return;
        }

        $count = CustomIcon::count();
        $readableTitle = !empty(trim($this->modalCustomIconTitle)) 
            ? trim($this->modalCustomIconTitle) 
            : 'Custom Vector ' . ($count + 1);

        $icon = CustomIcon::create([
            'title'      => $readableTitle,
            'type'       => 'svg',
            'file_name'  => Str::slug($readableTitle) . '.svg',
            'svg_code'   => $rawSvg,
            'created_by' => auth()->id(),
        ]);

        $targetIconKey = "raw_svg:{$icon->id}";

        if ($this->modalTargetField === 'socialLinks' && $this->modalTargetIndex !== null && isset($this->socialLinks[$this->modalTargetIndex])) {
            $this->socialLinks[$this->modalTargetIndex]['icon'] = $targetIconKey;
            $this->socialLinks[$this->modalTargetIndex]['icon_type'] = 'library';
            $this->socialLinks[$this->modalTargetIndex]['custom_path'] = null;
        } elseif ($this->modalTargetField && array_key_exists($this->modalTargetField, $this->settings)) {
            $this->settings[$this->modalTargetField] = $targetIconKey;
        }

        $this->modalRawSvgCode = '';
        $this->modalCustomIconTitle = '';

        $this->dispatch('custom-icon-saved', 
            iconId: $icon->id, 
            iconPath: $targetIconKey, 
            iconUrl: null,
            iconName: $readableTitle,
            isRawSvg: true,
            rawSvg: $rawSvg
        );

        session()->flash('message', "Raw SVG Vector '{$readableTitle}' permanently stored in library!");
    }

    public function deleteCustomIcon($assetIdOrPath): void
    {
        $deletedId = null;

        if (is_numeric($assetIdOrPath)) {
            $icon = CustomIcon::find($assetIdOrPath);
            if ($icon) {
                $deletedId = $icon->id;
                if ($icon->type === 'file' && $icon->file_path) {
                    $cleanPath = ltrim(str_replace('storage/', '', $icon->file_path), '/');
                    Storage::disk('public')->delete($cleanPath);
                }
                $icon->delete();
            }
        } elseif (is_string($assetIdOrPath) && (str_starts_with($assetIdOrPath, 'raw_svg:') || str_starts_with($assetIdOrPath, 'custom_svg:'))) {
            $rawId = (int) preg_replace('/[^0-9]/', '', $assetIdOrPath);
            CustomIcon::where('id', $rawId)->delete();
            $deletedId = $rawId;
        } else {
            $cleanPath = ltrim(str_replace('storage/', '', $assetIdOrPath), '/');
            Storage::disk('public')->delete($cleanPath);
            CustomIcon::where('file_path', 'like', '%' . $cleanPath . '%')->delete();
            $deletedId = $assetIdOrPath;
        }

        // Flush svg render caches
        Cache::forget("custom_svg_render_{$deletedId}_w-4 h-4");

        $this->dispatch('custom-icon-deleted', iconId: $deletedId, iconPath: $assetIdOrPath);
        session()->flash('message', 'Custom icon successfully deleted.');
    }

    public function saveSettings(): void
    {
        $groupMap = [
            'site_name'             => 'general',
            'site_tagline'          => 'general',
            'contact_email'         => 'general',
            'contact_phone'         => 'general',
            'whatsapp_number'       => 'general',
            'company_address'       => 'general',
            'google_maps_embed'     => 'general',
            'site_logo'             => 'general',
            'site_icon'             => 'general',
            'storage_driver'        => 'storage',
            's3_key'                => 'storage',
            's3_secret'             => 'storage',
            's3_region'             => 'storage',
            's3_bucket'             => 'storage',
            's3_endpoint'           => 'storage',
            's3_cdn_url'            => 'storage',
            'default_timezone'      => 'localization',
            'date_format'           => 'localization',
            'time_format'           => 'localization',
            'custom_head_scripts'   => 'scripts',
            'custom_footer_scripts' => 'scripts',
        ];

        foreach ($this->settings as $key => $value) {
            $group = $groupMap[$key] ?? 'general';
            Setting::set($key, $value, $group);
        }

        Setting::set('social_links_data', json_encode($this->socialLinks, JSON_UNESCAPED_UNICODE), 'social', 'json');

        // Flush runtime memory
        Setting::flushCache();

        session()->flash('message', 'All settings and brand assets successfully synchronized in real time.');
    }

    public function render()
    {
        return view('livewire.admin.settings.settings-manager')
            ->title('Global Settings Studio | ' . Setting::get('site_name', 'Nordroy CMS'));
    }
}
