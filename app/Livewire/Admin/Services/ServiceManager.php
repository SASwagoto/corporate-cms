<?php

namespace App\Livewire\Admin\Services;

use App\Models\CustomIcon;
use App\Models\MediaAsset;
use App\Models\Service;
use App\Services\IconRegistry;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class ServiceManager extends Component
{
    use WithPagination, WithFileUploads;

    // Search and Filters
    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $statusFilter = 'all';

    #[Url(as: 'featured')]
    public string $featuredFilter = 'all';

    // Service Form Modal State
    public bool $isFormModalOpen = false;
    public ?int $editingServiceId = null;

    public string $title_en = '';
    public string $title_bn = '';
    public string $slug = '';
    public string $icon = 'solid:gauge';
    public ?int $featured_image_id = null;
    public ?string $featured_image_url = null;
    public string $short_summary_en = '';
    public string $short_summary_bn = '';
    public string $content_en = '';
    public string $content_bn = '';
    public int $order = 0;
    public bool $is_featured = false;
    public bool $is_active = true;

    // Delete Confirmation State
    public bool $isDeleteModalOpen = false;
    public ?int $serviceIdToDelete = null;
    public ?string $serviceNameToDelete = null;

    // Icon Picker Modal State
    public ?string $modalTargetField = 'icon';
    public ?int $modalTargetIndex = null;
    public string $modalCustomIconTitle = '';
    public $modalUploadedFile = null;
    public string $modalRawSvgCode = '';

    // Media Picker Modal State
    public $uploads = [];
    public string $uploadFolder = 'services';
    public bool $autoCompress = true;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatingFeaturedFilter(): void
    {
        $this->resetPage();
    }

    public function updatedTitleEn(string $value): void
    {
        if (!$this->editingServiceId || empty($this->slug)) {
            $this->slug = Str::slug($value);
        }
    }

    public function createService(): void
    {
        $this->resetValidation();
        $this->editingServiceId = null;

        $maxOrder = (int) Service::max('order');

        $this->title_en = '';
        $this->title_bn = '';
        $this->slug = '';
        $this->icon = 'solid:gauge';
        $this->featured_image_id = null;
        $this->featured_image_url = null;
        $this->short_summary_en = '';
        $this->short_summary_bn = '';
        $this->content_en = '';
        $this->content_bn = '';
        $this->order = $maxOrder + 1;
        $this->is_featured = false;
        $this->is_active = true;

        $this->isFormModalOpen = true;
    }

    public function editService(int $id): void
    {
        $this->resetValidation();
        $service = Service::with('featuredImage')->findOrFail($id);

        $this->editingServiceId = $service->id;

        $title = $service->title ?? [];
        $summary = $service->short_summary ?? [];
        $content = $service->content ?? [];

        $this->title_en = is_array($title) ? ($title['en'] ?? '') : (string) $title;
        $this->title_bn = is_array($title) ? ($title['bn'] ?? '') : '';

        $this->slug = $service->slug;
        $this->icon = $service->icon ?: 'solid:gauge';
        $this->featured_image_id = $service->featured_image_id;
        $this->featured_image_url = $service->featuredImage?->url ?? null;

        $this->short_summary_en = is_array($summary) ? ($summary['en'] ?? '') : (string) $summary;
        $this->short_summary_bn = is_array($summary) ? ($summary['bn'] ?? '') : '';

        $this->content_en = is_array($content) ? ($content['en'] ?? '') : (string) $content;
        $this->content_bn = is_array($content) ? ($content['bn'] ?? '') : '';

        $this->order = (int) $service->order;
        $this->is_featured = (bool) $service->is_featured;
        $this->is_active = (bool) $service->is_active;

        $this->isFormModalOpen = true;
    }

    public function saveService(): void
    {
        $slugRule = 'required|string|max:255|unique:services,slug' . ($this->editingServiceId ? (',' . $this->editingServiceId) : '');

        $this->validate([
            'title_en'          => 'required|string|max:255',
            'title_bn'          => 'nullable|string|max:255',
            'slug'              => $slugRule,
            'icon'              => 'nullable|string|max:100',
            'short_summary_en'  => 'nullable|string|max:1000',
            'short_summary_bn'  => 'nullable|string|max:1000',
            'content_en'        => 'nullable|string',
            'content_bn'        => 'nullable|string',
            'order'             => 'required|integer|min:0',
            'featured_image_id' => 'nullable|exists:media_assets,id',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
        ]);

        $titleData = [
            'en' => trim($this->title_en),
            'bn' => !empty(trim($this->title_bn)) ? trim($this->title_bn) : trim($this->title_en),
        ];

        $summaryData = [
            'en' => trim($this->short_summary_en),
            'bn' => !empty(trim($this->short_summary_bn)) ? trim($this->short_summary_bn) : trim($this->short_summary_en),
        ];

        $contentData = [
            'en' => trim($this->content_en),
            'bn' => !empty(trim($this->content_bn)) ? trim($this->content_bn) : trim($this->content_en),
        ];

        $payload = [
            'title'             => $titleData,
            'slug'              => Str::slug($this->slug),
            'icon'              => $this->icon ?: 'solid:gauge',
            'short_summary'     => $summaryData,
            'content'           => $contentData,
            'featured_image_id' => $this->featured_image_id,
            'order'             => (int) $this->order,
            'is_featured'       => (bool) $this->is_featured,
            'is_active'         => (bool) $this->is_active,
        ];

        if ($this->editingServiceId) {
            $service = Service::findOrFail($this->editingServiceId);
            $service->update($payload);
            session()->flash('message', "Service '{$service->display_title}' updated successfully.");
        } else {
            $service = Service::create($payload);
            session()->flash('message', "Service '{$service->display_title}' created successfully.");
        }

        $this->closeFormModal();
    }

    public function closeFormModal(): void
    {
        $this->isFormModalOpen = false;
        $this->editingServiceId = null;
        $this->resetValidation();
    }

    public function toggleActive(int $id): void
    {
        $service = Service::findOrFail($id);
        $service->is_active = !$service->is_active;
        $service->save();

        session()->flash('message', "Service '{$service->display_title}' status updated.");
    }

    public function toggleFeatured(int $id): void
    {
        $service = Service::findOrFail($id);
        $service->is_featured = !$service->is_featured;
        $service->save();

        session()->flash('message', "Service '{$service->display_title}' featured status updated.");
    }

    public function moveUp(int $id): void
    {
        $current = Service::findOrFail($id);
        $previous = Service::where('order', '<', $current->order)
            ->orderBy('order', 'desc')
            ->first();

        if ($previous) {
            $prevOrder = $previous->order;
            $previous->order = $current->order;
            $current->order = $prevOrder;
            $previous->save();
            $current->save();
        }
    }

    public function moveDown(int $id): void
    {
        $current = Service::findOrFail($id);
        $next = Service::where('order', '>', $current->order)
            ->orderBy('order', 'asc')
            ->first();

        if ($next) {
            $nextOrder = $next->order;
            $next->order = $current->order;
            $current->order = $nextOrder;
            $next->save();
            $current->save();
        }
    }

    public function duplicateService(int $id): void
    {
        $source = Service::findOrFail($id);
        $maxOrder = (int) Service::max('order');

        $copyTitleEn = ($source->title['en'] ?? 'Service') . ' (Copy)';
        $copyTitleBn = ($source->title['bn'] ?? 'সার্ভিস') . ' (কপি)';

        $newSlug = Str::slug($source->slug . '-copy-' . time());

        $cloned = Service::create([
            'title' => [
                'en' => $copyTitleEn,
                'bn' => $copyTitleBn,
            ],
            'slug' => $newSlug,
            'icon' => $source->icon,
            'short_summary' => $source->short_summary,
            'content' => $source->content,
            'featured_image_id' => $source->featured_image_id,
            'order' => $maxOrder + 1,
            'is_featured' => false,
            'is_active' => false,
        ]);

        session()->flash('message', "Service duplicated as '{$cloned->display_title}'.");
    }

    public function confirmDelete(int $id): void
    {
        $service = Service::findOrFail($id);
        $this->serviceIdToDelete = $service->id;
        $this->serviceNameToDelete = $service->display_title;
        $this->isDeleteModalOpen = true;
    }

    public function deleteService(): void
    {
        if ($this->serviceIdToDelete) {
            $service = Service::find($this->serviceIdToDelete);
            if ($service) {
                $name = $service->display_title;
                $service->delete();
                session()->flash('message', "Service '{$name}' permanently deleted.");
            }
        }

        $this->closeDeleteModal();
    }

    public function closeDeleteModal(): void
    {
        $this->isDeleteModalOpen = false;
        $this->serviceIdToDelete = null;
        $this->serviceNameToDelete = null;
    }

    // =========================================================================
    // ICON PICKER INTEGRATION
    // =========================================================================
    public function selectIconAsset(?string $targetField, ?int $targetIndex, string $iconId, ?string $targetTypeField = null): void
    {
        $this->icon = $iconId;
    }

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
        $this->icon = $storedKey;

        $this->modalUploadedFile = null;
        $this->modalCustomIconTitle = '';

        $this->dispatch('custom-icon-saved', 
            iconId: $icon->id, 
            iconPath: $storedKey, 
            iconUrl: $icon->url, 
            iconName: $readableTitle,
            isRawSvg: $isSvg,
            rawSvg: $isSvg ? IconRegistry::cleanSvgMarkup($rawSvg, 'w-6 h-6') : null
        );

        IconRegistry::flushCache($icon->id);
        session()->flash('message', "Custom Icon '{$readableTitle}' saved and applied!");
    }

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

        $storedKey = "raw_svg:{$icon->id}";
        $this->icon = $storedKey;

        $this->modalRawSvgCode = '';
        $this->modalCustomIconTitle = '';

        $this->dispatch('custom-icon-saved', 
            iconId: $icon->id, 
            iconPath: $storedKey, 
            iconUrl: null,
            iconName: $readableTitle,
            isRawSvg: true,
            rawSvg: IconRegistry::cleanSvgMarkup($rawSvg, 'w-6 h-6')
        );

        IconRegistry::flushCache($icon->id);
        session()->flash('message', "Raw Vector '{$readableTitle}' saved and applied!");
    }

    public function deleteCustomIcon(int $id): void
    {
        $icon = CustomIcon::find($id);
        if ($icon) {
            $path = $icon->file_path;
            if ($path && !str_starts_with($path, 'raw_svg:') && !str_starts_with($path, 'http')) {
                $clean = str_replace('storage/', '', $path);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($clean);
            }
            $icon->delete();
            IconRegistry::flushCache($id);
            $this->dispatch('custom-icon-deleted', iconId: $id, iconPath: "raw_svg:{$id}");
            session()->flash('message', 'Custom icon deleted from library.');
        }
    }

    // =========================================================================
    // MEDIA ASSET PICKER INTEGRATION
    // =========================================================================
    public function selectAsset(int $assetId, string $assetUrl, ?string $targetField = null, ?int $targetIndex = null): void
    {
        $this->featured_image_id = $assetId;
        $this->featured_image_url = $assetUrl;
        $this->dispatch('close-media-modal');
    }

    public function removeFeaturedImage(): void
    {
        $this->featured_image_id = null;
        $this->featured_image_url = null;
    }

    public function uploadFiles(?string $targetField = null, ?int $targetIndex = null): void
    {
        if (empty($this->uploads) || !is_array($this->uploads)) {
            $this->addError('uploads', 'Please select at least one file to upload.');
            return;
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'svg', 'pdf', 'gif', 'ico'];
        $service = app(\App\Services\MediaStorageService::class);
        $lastAsset = null;
        $successCount = 0;

        foreach ($this->uploads as $file) {
            if ($file) {
                $ext = strtolower($file->getClientOriginalExtension());
                if (!in_array($ext, $allowedExtensions)) {
                    continue;
                }

                $folder = $this->uploadFolder ?: 'services';
                $lastAsset = $service->store($file, $folder, null, $this->autoCompress);
                $successCount++;

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

        if ($successCount > 0 && $lastAsset) {
            $field = $targetField ?: $this->modalTargetField;
            $index = $targetIndex ?? $this->modalTargetIndex;
            $this->selectAsset($lastAsset->id, $lastAsset->url, $field, $index);
            session()->flash('message', "{$successCount} asset(s) successfully uploaded and attached.");
            $this->dispatch('close-media-modal');
        }
    }

    public function processUploads(?string $targetField = null, ?int $targetIndex = null): void
    {
        $this->uploadFiles($targetField, $targetIndex);
    }

    public function render()
    {
        $query = Service::query()->with('featuredImage');

        if (!empty(trim($this->search))) {
            $q = trim($this->search);
            $query->where(function ($sub) use ($q) {
                $sub->where('slug', 'like', "%{$q}%")
                    ->orWhere('title', 'like', "%{$q}%")
                    ->orWhere('short_summary', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            });
        }

        if ($this->statusFilter === 'active') {
            $query->where('is_active', true);
        } elseif ($this->statusFilter === 'inactive') {
            $query->where('is_active', false);
        }

        if ($this->featuredFilter === 'featured') {
            $query->where('is_featured', true);
        } elseif ($this->featuredFilter === 'standard') {
            $query->where('is_featured', false);
        }

        $services = $query->orderBy('order', 'asc')
            ->orderBy('id', 'asc')
            ->paginate(12);

        $stats = [
            'total'    => Service::count(),
            'active'   => Service::where('is_active', true)->count(),
            'featured' => Service::where('is_featured', true)->count(),
            'inactive' => Service::where('is_active', false)->count(),
        ];

        return view('livewire.admin.services.service-manager', [
            'services' => $services,
            'stats'    => $stats,
        ]);
    }
}
