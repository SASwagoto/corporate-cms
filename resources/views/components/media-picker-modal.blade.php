<div wire:ignore.self
     x-data="nordroyMediaPicker()"
     @open-media-picker.window="openModal($event.detail)"
     @close-media-modal.window="closeModal()"
     @media-asset-uploaded.window="handleAssetUploaded($event.detail)"
     @keydown.escape.window="closeModal()"
     class="relative z-[9998]"
     style="display: none;"
     x-show="isOpen">

    <!-- Backdrop -->
    <div x-show="isOpen"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="closeModal()"
         class="fixed inset-0 bg-slate-950/75 backdrop-blur-sm transition-opacity"></div>

    <!-- Modal Box -->
    <div class="fixed inset-0 z-10 overflow-y-auto p-4 sm:p-6 lg:p-8 flex items-center justify-center">
        <div x-show="isOpen"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95"
             @click.outside="closeModal()"
             class="w-full max-w-5xl rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
            
            <!-- Header -->
            <div class="p-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <template x-if="!isUploadOnly">
                        <div class="flex items-center gap-1 p-1 rounded-xl bg-slate-100 dark:bg-slate-800 text-xs font-bold">
                            <button type="button" @click="activeTab = 'library'"
                                :class="activeTab === 'library' ? 'bg-white dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 shadow-xs' : 'text-slate-500 hover:text-slate-900 dark:hover:text-white'"
                                class="px-4 py-1.5 rounded-lg transition-colors cursor-pointer flex items-center gap-2">
                                <x-icon name="solid:images" class="w-4 h-4" />
                                <span>Media Library</span>
                                <span class="px-1.5 py-0.2 rounded-full text-[10px] bg-slate-200 dark:bg-slate-800" x-text="assets.length"></span>
                            </button>
                            <button type="button" @click="activeTab = 'upload'"
                                :class="activeTab === 'upload' ? 'bg-white dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 shadow-xs' : 'text-slate-500 hover:text-slate-900 dark:hover:text-white'"
                                class="px-4 py-1.5 rounded-lg transition-colors cursor-pointer flex items-center gap-2">
                                <x-icon name="solid:cloud-arrow-up" class="w-4 h-4" />
                                <span>Upload Files</span>
                            </button>
                        </div>
                    </template>
                    <template x-if="isUploadOnly">
                        <div>
                            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-white flex items-center gap-2">
                                <x-icon name="solid:cloud-arrow-up" class="w-4 h-4 text-[#003C58] dark:text-cyan-400" />
                                <span>Upload Media Assets</span>
                            </h3>
                            <p class="text-[11px] text-slate-400">Process photography, PNGs, WebP, SVGs & technical PDFs.</p>
                        </div>
                    </template>
                </div>

                <button type="button" @click="closeModal()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer">
                    <x-icon name="solid:xmark" class="w-5 h-5" />
                </button>
            </div>

            <!-- TAB 1: BROWSE MEDIA LIBRARY -->
            <div x-show="activeTab === 'library' && !isUploadOnly" class="flex flex-col flex-1 min-h-0">
                
                <div class="px-5 py-3 bg-slate-50 dark:bg-slate-950/60 border-b border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <div class="relative w-full sm:w-72">
                        <input type="text" 
                               x-model="searchQuery" 
                               placeholder="Filter assets instantly..." 
                               class="w-full px-3 py-1.5 text-xs rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#003C58] dark:focus:ring-cyan-500" />
                    </div>

                    <div class="flex items-center gap-1.5 overflow-x-auto w-full sm:w-auto pb-1 sm:pb-0">
                        <button type="button" @click="selectedFolder = 'all'"
                            :class="selectedFolder === 'all' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white'"
                            class="px-3 py-1 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0">
                            All Files
                        </button>
                        <button type="button" @click="selectedFolder = 'general'"
                            :class="selectedFolder === 'general' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white'"
                            class="px-3 py-1 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0">
                            General
                        </button>
                        <button type="button" @click="selectedFolder = 'banners'"
                            :class="selectedFolder === 'banners' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white'"
                            class="px-3 py-1 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0">
                            Banners
                        </button>
                        <button type="button" @click="selectedFolder = 'services'"
                            :class="selectedFolder === 'services' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white'"
                            class="px-3 py-1 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0">
                            Services
                        </button>
                        <button type="button" @click="selectedFolder = 'products'"
                            :class="selectedFolder === 'products' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white'"
                            class="px-3 py-1 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0">
                            Products
                        </button>
                    </div>
                </div>

                <!-- Media Visual Grid -->
                <div class="flex-1 overflow-y-auto p-5 max-h-[55vh]">
                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3">
                        <template x-for="asset in filteredAssets" :key="asset.id">
                            <div class="relative group rounded-2xl border border-slate-200/80 dark:border-slate-800/80 overflow-hidden bg-white dark:bg-slate-950 hover:border-[#003C58] dark:hover:border-cyan-400 transition-all shadow-2xs">
                                
                                <button type="button" 
                                    @click="selectMedia(asset.id, asset.url)"
                                    class="w-full text-left cursor-pointer">
                                    <div class="aspect-square w-full bg-slate-100 dark:bg-slate-900 flex items-center justify-center p-2 overflow-hidden">
                                        <template x-if="asset.is_image">
                                            <img :src="asset.url" :alt="asset.name" loading="lazy" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-200" />
                                        </template>
                                        <template x-if="!asset.is_image">
                                            <x-icon name="solid:file-pdf" class="w-8 h-8 text-rose-500" />
                                        </template>
                                    </div>

                                    <div class="p-2 border-t border-slate-100 dark:border-slate-800">
                                        <p class="text-[10px] font-bold text-slate-800 dark:text-white truncate" x-text="asset.name"></p>
                                        <div class="flex items-center justify-between text-[9px] text-slate-400 mt-0.5">
                                            <span x-text="asset.size"></span>
                                            <span class="uppercase" x-text="asset.folder"></span>
                                        </div>
                                    </div>
                                </button>

                            </div>
                        </template>
                    </div>

                    <div x-show="filteredAssets.length === 0" class="py-16 text-center text-slate-400 text-xs">
                        <x-icon name="solid:images" class="w-10 h-10 mx-auto text-slate-300 dark:text-slate-600 mb-2" />
                        <p>No media assets found matching your criteria.</p>
                    </div>
                </div>

            </div>

            <!-- TAB 2: UPLOAD FILES (Zero Auto-Remove, Live Progress Bar & WebP Switch) -->
            <div x-show="activeTab === 'upload'" class="flex-1 overflow-y-auto p-6 space-y-6 max-h-[65vh]">
                
                <div class="max-w-2xl mx-auto p-6 rounded-3xl border-2 border-dashed border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950/60 flex flex-col items-center justify-center text-center">
                    
                    <div class="w-12 h-12 rounded-2xl bg-[#003C58]/10 dark:bg-cyan-500/10 text-[#003C58] dark:text-cyan-400 flex items-center justify-center mb-3">
                        <x-icon name="solid:cloud-arrow-up" class="w-6 h-6" />
                    </div>

                    <h4 class="text-xs font-bold text-slate-800 dark:text-white uppercase tracking-wider">Drag & Drop Media Assets</h4>
                    <p class="text-[11px] text-slate-400 mt-0.5 mb-4">Accepts PNG, JPG, WebP, SVG, and PDF documents (Up to 30MB each).</p>

                    <!-- Target Folder and Auto-Compression Flag -->
                    <div class="w-full flex flex-col sm:flex-row items-center justify-between gap-3 p-3 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 mb-4">
                        <div class="flex items-center gap-2">
                            <label class="text-[11px] font-bold text-slate-600 dark:text-slate-400">Target Folder:</label>
                            <select wire:model="uploadFolder" class="px-2.5 py-1 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-white">
                                <option value="general">General</option>
                                <option value="banners">Hero Banners</option>
                                <option value="services">Services</option>
                                <option value="products">Products</option>
                                <option value="branding">Branding</option>
                            </select>
                        </div>

                        <!-- Auto-Compress WebP Switch -->
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" wire:model="autoCompress" class="w-3.5 h-3.5 rounded text-[#003C58] focus:ring-0" />
                            <span class="text-xs font-bold text-[#003C58] dark:text-cyan-400">Auto-Compress to WebP (Recommended)</span>
                        </label>
                    </div>

                    <!-- Protected File Input Area with Livewire Upload Lifecycle Hooks -->
                    <div wire:ignore.self
                         x-on:livewire-upload-start="isUploading = true; uploadProgress = 0"
                         x-on:livewire-upload-finish="isUploading = false"
                         x-on:livewire-upload-error="isUploading = false; alert('File upload failed. Ensure file size is within limits.')"
                         x-on:livewire-upload-progress="uploadProgress = $event.detail.progress"
                         class="w-full flex flex-col items-center">
                        
                        <input type="file" 
                               wire:model="uploads" 
                               multiple 
                               accept=".jpg,.jpeg,.png,.webp,.svg,.pdf"
                               @change="handleFileSelect($event)"
                               class="text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#003C58] file:text-white hover:file:bg-[#024a6d] file:cursor-pointer" />

                        <!-- Livewire Async Chunk Upload Progress Bar -->
                        <div x-show="isUploading" class="w-full mt-3 bg-slate-200 dark:bg-slate-800 rounded-full h-1.5 overflow-hidden" style="display: none;">
                            <div class="bg-cyan-500 h-1.5 rounded-full transition-all duration-150" :style="'width: ' + uploadProgress + '%'"></div>
                        </div>
                    </div>

                    @error('uploads') <span class="text-rose-500 text-xs block mt-2">{{ $message }}</span> @enderror
                    @error('uploads.*') <span class="text-rose-500 text-xs block mt-2">{{ $message }}</span> @enderror

                    <!-- Selected Files Preview Grid -->
                    <div x-show="previewFiles.length > 0" class="w-full mt-6 pt-5 border-t border-slate-200 dark:border-slate-800" style="display: none;">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2.5 text-left">Ready to Process (<span x-text="previewFiles.length"></span> files)</span>
                        
                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-2.5 max-h-48 overflow-y-auto p-1">
                            <template x-for="file in previewFiles" :key="file.name">
                                <div class="p-1.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-left">
                                    <div class="aspect-square rounded-lg bg-slate-100 dark:bg-slate-950 overflow-hidden flex items-center justify-center p-1">
                                        <template x-if="file.url">
                                            <img :src="file.url" class="w-full h-full object-contain" />
                                        </template>
                                        <template x-if="!file.url">
                                            <x-icon name="solid:file-pdf" class="w-6 h-6 text-rose-500" />
                                        </template>
                                    </div>
                                    <p class="text-[9px] font-bold text-slate-700 dark:text-slate-300 truncate mt-1" x-text="file.name"></p>
                                    <span class="text-[8px] text-slate-400" x-text="file.size"></span>
                                </div>
                            </template>
                        </div>

                        <!-- Confirm Upload Button -->
                        <div class="mt-5 flex justify-center">
                            <button type="button" 
                                wire:click="uploadFiles"
                                wire:loading.attr="disabled"
                                class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-[#003C58] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 shadow-sm active:scale-95 transition-all cursor-pointer inline-flex items-center justify-center gap-2 disabled:opacity-50">
                                <span wire:loading.remove wire:target="uploadFiles" class="inline-flex items-center gap-2 whitespace-nowrap">Upload & Process (<span x-text="previewFiles.length"></span>) Files</span>
                                <span wire:loading.inline-flex wire:target="uploadFiles" class="items-center justify-center gap-2 whitespace-nowrap" style="display: none;">
                                    <svg class="animate-spin h-3.5 w-3.5 text-current shrink-0" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>Compressing & Saving...</span>
                                </span>
                            </button>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Footer -->
            <div class="p-3.5 bg-slate-50 dark:bg-slate-950/40 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs text-slate-400">
                <span>Integrated High-Performance Asset Engine</span>
                <button type="button" @click="closeModal()" class="px-4 py-1.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    window.nordroyMediaPicker = function() {
        return {
            isOpen: false,
            activeTab: 'library',
            isUploadOnly: false,
            searchQuery: '',
            selectedFolder: 'all',
            targetField: null,
            targetIndex: null,
            previewFiles: [],
            isUploading: false,
            uploadProgress: 0,

            // Exclude custom-icons
            assets: {!! json_encode(\App\Models\MediaAsset::where('folder', '!=', 'custom-icons')->latest()->get()->map(fn($a) => [
                'id' => $a->id,
                'name' => $a->getTranslation('title', 'en') ?: $a->file_name,
                'url' => $a->url,
                'is_image' => in_array(strtolower(pathinfo($a->file_name, PATHINFO_EXTENSION)), ['jpg','jpeg','png','webp','svg','gif','ico']) || str_contains($a->mime_type ?? '', 'image'),
                'size' => $a->human_size,
                'folder' => $a->folder,
            ])) !!},

            get filteredAssets() {
                let list = this.assets || [];
                if (this.selectedFolder !== 'all') {
                    list = list.filter(a => a.folder === this.selectedFolder);
                }
                if (this.searchQuery && this.searchQuery.trim() !== '') {
                    const q = this.searchQuery.toLowerCase().trim();
                    list = list.filter(a => a.name && a.name.toLowerCase().includes(q));
                }
                return list;
            },

            openModal(detail) {
                detail = detail || {};
                this.targetField = detail.targetField || null;
                this.targetIndex = detail.targetIndex ?? null;
                this.isUploadOnly = detail.uploadOnly || false;
                this.activeTab = (this.isUploadOnly || detail.initialTab === 'upload') ? 'upload' : 'library';
                this.searchQuery = '';
                this.selectedFolder = 'all';
                this.previewFiles = [];
                this.isUploading = false;
                this.uploadProgress = 0;
                this.isOpen = true;

                if (this.$wire) {
                    this.$wire.set('modalTargetField', this.targetField);
                    this.$wire.set('modalTargetIndex', this.targetIndex);
                }
            },

            handleFileSelect(event) {
                this.previewFiles = [];
                const files = event.target.files;
                if (!files) return;
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const isImg = file.type.includes('image') || file.name.endsWith('.svg');
                    this.previewFiles.push({
                        name: file.name,
                        size: (file.size / (1024 * 1024)).toFixed(2) + ' MB',
                        url: isImg ? URL.createObjectURL(file) : null
                    });
                }
            },

            selectMedia(assetId, assetUrl) {
                if (typeof this.$wire?.selectAsset === 'function') {
                    this.$wire.selectAsset(assetId, assetUrl, this.targetField, this.targetIndex);
                } else if (window.Livewire) {
                    Livewire.dispatch('media-selected', {
                        assetId: assetId,
                        assetUrl: assetUrl,
                        targetField: this.targetField,
                        targetIndex: this.targetIndex
                    });
                }
                this.closeModal();
            },

            handleAssetUploaded(detail) {
                if (detail && detail.id) {
                    const exists = this.assets.some(a => a.id === detail.id);
                    if (!exists) {
                        this.assets.unshift(detail);
                    }
                }
            },

            closeModal() {
                this.isOpen = false;
                this.previewFiles = [];
                this.isUploading = false;
            }
        };
    };
</script>