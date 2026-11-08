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
            'site_logo_dark'       => 'assets/images/logo-dark.png',
            'site_icon'            => 'assets/images/icon.png',
            'site_icon_dark'       => 'assets/images/icon-dark.png',
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
            'seo_meta_title'       => 'Nordroy Marine & Turbochargers | Authorized Maritime Overhauls',
            'seo_meta_description' => 'Authorized multi-brand marine turbocharger overhauls, high-speed dynamic balancing, cartridge reconditioning, and 24/7 port emergency flying squads in Bangladesh.',
            'seo_meta_keywords'    => 'marine turbocharger, dynamic balancing, turbocharger overhaul, chittagong port, maritime engineering, cartridge rebuilding',
            'seo_og_image'         => '',
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
            Setting::set('social_links_data', json_encode($this->socialLinks, JSON_UNESCAPED_UNICODE), 'social', 'json');
            Setting::flushCache();
        } elseif ($field && array_key_exists($field, $this->settings)) {
            $this->settings[$field] = $iconId;
            Setting::set($field, $iconId, 'general');
            Setting::flushCache();
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
        Setting::set('social_links_data', json_encode($this->socialLinks, JSON_UNESCAPED_UNICODE), 'social', 'json');
        Setting::flushCache();
    }

    /**
     * Upload custom file (PNG/SVG/WebP/JPG/ICO/GIF) directly into dedicated CustomIcon database & storage.
     */
    public function uploadCustomIcon(?string $targetField = null, ?int $targetIndex = null, ?string $targetTypeField = null, ?string $customTitle = null): void
    {
        $this->validate([
            'modalUploadedFile'    => 'required|file|max:5120',
            'modalCustomIconTitle' => 'nullable|string|max:50',
        ], [
            'modalUploadedFile.required' => 'Please select an image or vector icon file first.',
            'modalUploadedFile.file'     => 'The selected file is not a valid upload.',
            'modalUploadedFile.max'      => 'The icon file size must not exceed 5MB.',
        ]);

        $ext = strtolower($this->modalUploadedFile->getClientOriginalExtension());
        if (!in_array($ext, ['svg', 'png', 'webp', 'jpg', 'jpeg', 'ico', 'gif'])) {
            $this->addError('modalUploadedFile', 'Supported formats: SVG, PNG, WebP, JPG, ICO, GIF.');
            return;
        }

        $dir = storage_path('app/public/custom-icons');
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $count = CustomIcon::count();
        $passedTitle = !empty(trim($customTitle ?? '')) ? trim($customTitle) : trim($this->modalCustomIconTitle ?? '');

        if (!empty($passedTitle)) {
            $readableTitle = $passedTitle;
            $baseName = Str::slug($readableTitle);
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

        // If SVG file, read raw content for crisp vector scaling
        $rawSvg = null;
        $isSvg = ($ext === 'svg');
        if ($isSvg) {
            $fullPath = storage_path('app/public/custom-icons/' . $cleanFileName);
            if (File::exists($fullPath)) {
                $rawSvg = File::get($fullPath);
            }
        }

        $icon = CustomIcon::create([
            'title'      => $readableTitle,
            'type'       => $isSvg ? 'svg' : 'file',
            'file_path'  => $storedPath,
            'file_name'  => $cleanFileName,
            'svg_code'   => $rawSvg,
            'created_by' => auth()->id(),
        ]);

        $storedKey = $isSvg ? "raw_svg:{$icon->id}" : $storedPath;

        // Atomic assignment to target field
        $field = $targetField ?: $this->modalTargetField;
        $index = $targetIndex ?? $this->modalTargetIndex;
        $typeField = $targetTypeField;

        if ($field) {
            $this->selectIconAsset($field, $index, $storedKey, $typeField);
        }

        $this->modalUploadedFile = null;
        $this->modalCustomIconTitle = '';

        $this->dispatch('custom-icon-saved', 
            iconId: $icon->id, 
            iconPath: $storedKey, 
            iconUrl: $icon->url,
            iconName: $readableTitle,
            isRawSvg: $isSvg,
            rawSvg: $isSvg ? \App\Services\IconRegistry::cleanSvgMarkup($rawSvg, 'w-6 h-6') : null
        );

        \App\Services\IconRegistry::flushCache($icon->id);

        session()->flash('message', "Custom Icon '{$readableTitle}' successfully saved and applied!");
    }

    /**
     * Store Raw SVG Code directly without JSON array conflicts.
     */
    public function saveRawSvgIcon(?string $targetField = null, ?int $targetIndex = null, ?string $targetTypeField = null, ?string $rawSvgInput = null, ?string $customTitle = null): void
    {
        $rawSvg = trim($rawSvgInput ?: ($this->modalRawSvgCode ?? ''));
        $passedTitle = !empty(trim($customTitle ?? '')) ? trim($customTitle) : trim($this->modalCustomIconTitle ?? '');

        if (empty($rawSvg) || strlen($rawSvg) < 20) {
            $this->addError('modalRawSvgCode', 'Please paste valid <svg>...</svg> code into the box.');
            return;
        }

        if (!str_contains($rawSvg, '<svg') || !str_contains($rawSvg, '</svg>')) {
            $this->addError('modalRawSvgCode', 'Invalid vector format: code must include both <svg> and </svg> tags.');
            return;
        }

        $count = CustomIcon::count();
        $readableTitle = !empty($passedTitle) 
            ? $passedTitle 
            : 'Custom Vector ' . ($count + 1);

        $icon = CustomIcon::create([
            'title'      => $readableTitle,
            'type'       => 'svg',
            'file_name'  => Str::slug($readableTitle) . '.svg',
            'svg_code'   => $rawSvg,
            'created_by' => auth()->id(),
        ]);

        $targetIconKey = "raw_svg:{$icon->id}";

        // Atomic assignment to target field
        $field = $targetField ?: $this->modalTargetField;
        $index = $targetIndex ?? $this->modalTargetIndex;
        $typeField = $targetTypeField;

        if ($field) {
            $this->selectIconAsset($field, $index, $targetIconKey, $typeField);
        }

        $this->modalRawSvgCode = '';
        $this->modalCustomIconTitle = '';

        $this->dispatch('custom-icon-saved', 
            iconId: $icon->id, 
            iconPath: $targetIconKey, 
            iconUrl: null,
            iconName: $readableTitle,
            isRawSvg: true,
            rawSvg: \App\Services\IconRegistry::cleanSvgMarkup($rawSvg, 'w-6 h-6')
        );

        \App\Services\IconRegistry::flushCache($icon->id);

        session()->flash('message', "Raw SVG Vector '{$readableTitle}' stored and applied!");
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
        \App\Services\IconRegistry::flushCache(is_numeric($deletedId) ? (int)$deletedId : null);

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
            'site_logo_dark'        => 'general',
            'site_icon'             => 'general',
            'site_icon_dark'        => 'general',
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
            'seo_meta_title'        => 'seo',
            'seo_meta_description'  => 'seo',
            'seo_meta_keywords'     => 'seo',
            'seo_og_image'          => 'seo',
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
