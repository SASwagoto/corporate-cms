<?php

namespace App\Livewire\Admin\Media;

use App\Models\MediaAsset;
use App\Services\MediaStorageService;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class MediaManager extends Component
{
    use WithFileUploads, WithPagination;

    public string $search = '';
    public string $selectedFolder = 'all';

    // File Uploads State
    public $uploads = [];
    public string $uploadFolder = 'general';
    public bool $autoCompress = true;

    // Inspector Details Modal
    public bool $showDetailsModal = false;
    public ?int $selectedAssetId = null;
    public ?MediaAsset $selectedAsset = null;
    public string $editTitle = '';
    public string $editAlt = '';
    public string $editCaption = '';

    // Target Bridge
    public ?string $modalTargetField = null;
    public ?int $modalTargetIndex = null;

    public function mount(): void
    {
        $tmpDir = storage_path('app/livewire-tmp');
        if (!File::isDirectory($tmpDir)) {
            File::makeDirectory($tmpDir, 0777, true);
        }
    }

    public function setFolder(string $folder): void
    {
        $this->selectedFolder = $folder;
        $this->resetPage();
    }

    public function openAssetDetails(int $id): void
    {
        $this->selectedAsset = MediaAsset::findOrFail($id);
        $this->selectedAssetId = $id;
        $this->editTitle = $this->selectedAsset->getTranslation('title', 'en') ?: $this->selectedAsset->file_name;
        $this->editAlt = $this->selectedAsset->getTranslation('alt_text', 'en') ?: '';
        $this->editCaption = $this->selectedAsset->getTranslation('caption', 'en') ?: '';
        $this->showDetailsModal = true;
    }

    public function saveAssetMetadata(): void
    {
        if ($this->selectedAsset) {
            $this->selectedAsset->update([
                'title'    => ['en' => $this->editTitle],
                'alt_text' => ['en' => $this->editAlt],
                'caption'  => ['en' => $this->editCaption],
            ]);

            session()->flash('message', 'Asset SEO metadata successfully updated.');
            $this->showDetailsModal = false;
        }
    }

    /**
     * Bulletproof file upload handling accepting PNG, JPG, WebP, SVG, and PDF.
     */
    public function uploadFiles(): void
    {
        // 1. Check if files actually arrived in Livewire
        if (empty($this->uploads) || !is_array($this->uploads)) {
            $this->addError('uploads', 'Please select at least one file to upload.');
            return;
        }

        // 2. Custom extension validation that NEVER fails on Windows
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'svg', 'pdf', 'gif'];
        
        foreach ($this->uploads as $index => $file) {
            if (!$file) continue;

            $ext = strtolower($file->getClientOriginalExtension());
            if (!in_array($ext, $allowedExtensions)) {
                $this->addError("uploads.{$index}", "The file '{$file->getClientOriginalName()}' is not a supported format. Please select PNG, JPG, WebP, SVG, or PDF.");
                return;
            }

            // 30MB limit check
            if ($file->getSize() > 30 * 1024 * 1024) {
                $this->addError("uploads.{$index}", "The file '{$file->getClientOriginalName()}' exceeds the 30MB size limit.");
                return;
            }
        }

        // 3. Process Uploads via Service
        $service = app(MediaStorageService::class);
        $lastAsset = null;
        $successCount = 0;

        foreach ($this->uploads as $file) {
            if ($file) {
                $lastAsset = $service->store($file, $this->uploadFolder, null, $this->autoCompress);
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

        // 4. Clean State
        $this->uploads = [];

        if ($successCount > 0) {
            if ($this->modalTargetField && $lastAsset) {
                $this->selectAsset($lastAsset->id, $lastAsset->url);
            }
            session()->flash('message', "{$successCount} media asset(s) successfully processed and added to library.");
            $this->dispatch('close-media-modal');
        }
    }

    public function selectAsset(int $assetId, string $assetUrl): void
    {
        $this->dispatch('media-selected', 
            assetId: $assetId, 
            assetUrl: $assetUrl, 
            targetField: $this->modalTargetField,
            targetIndex: $this->modalTargetIndex
        );

        $this->dispatch('close-media-modal');
    }

    public function deleteAsset(int $assetId): void
    {
        $asset = MediaAsset::findOrFail($assetId);
        app(MediaStorageService::class)->delete($asset);

        if ($this->selectedAssetId === $assetId) {
            $this->showDetailsModal = false;
        }

        session()->flash('message', 'Media asset permanently deleted.');
    }

    public function render()
    {
        $query = MediaAsset::where('folder', '!=', 'custom-icons');

        if ($this->selectedFolder !== 'all') {
            $query->where('folder', $this->selectedFolder);
        }

        if (!empty(trim($this->search))) {
            $query->where(function($q) {
                $q->where('file_name', 'like', '%' . $this->search . '%')
                  ->orWhere('title', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.admin.media.media-manager', [
            'assets' => $query->latest()->paginate(36),
            'folders' => ['general', 'banners', 'services', 'products', 'branding'],
        ])->title('Media Asset Library | Nordroy CMS');
    }
}