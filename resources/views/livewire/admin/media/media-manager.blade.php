<div>
    <x-slot:header>Media Asset Library</x-slot:header>

    <x-media-picker-modal />

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Digital Asset Management</span>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white mt-0.5">Corporate Media Library</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400">Centralized repository for high-resolution photography, banners, and technical drawings.</p>
        </div>

        <!-- Directly Opens Upload Mode Modal -->
        <button type="button" 
            @click="$dispatch('open-media-picker', { uploadOnly: true })"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-[#013d5a] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 shadow-sm active:scale-95 transition-all cursor-pointer shrink-0 self-start sm:self-auto">
            <x-icon name="solid:cloud-arrow-up" class="w-4 h-4" />
            <span>Upload Assets</span>
        </button>
    </div>

    <!-- Feedback Message -->
    @if (session()->has('message'))
        <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-800 dark:text-emerald-400 text-xs font-semibold flex items-center justify-between">
            <div class="flex items-center gap-2">
                <x-icon name="solid:circle-check" class="w-4 h-4 text-emerald-500" />
                <span>{{ session('message') }}</span>
            </div>
            <button @click="$el.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 cursor-pointer">&times;</button>
        </div>
    @endif

    <!-- Folders & Search Strip -->
    <div class="p-3.5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs mb-6 flex flex-col md:flex-row items-center justify-between gap-4">
        
        <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar w-full md:w-auto pb-1 md:pb-0">
            @foreach(['all' => 'All Assets', 'general' => 'General', 'banners' => 'Hero Banners', 'services' => 'Services', 'products' => 'Products', 'branding' => 'Logos & Brand'] as $fKey => $fTitle)
                <button type="button" wire:click="setFolder('{{ $fKey }}')"
                    class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-colors cursor-pointer shrink-0 {{ $selectedFolder === $fKey ? 'bg-[#013d5a] text-white dark:bg-cyan-500 dark:text-slate-950 shadow-xs' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white bg-slate-50 dark:bg-slate-950/60' }}">
                    {{ $fTitle }}
                </button>
            @endforeach
        </div>

        <div class="relative w-full md:w-72">
            <input type="text" 
                   wire:model.live.debounce.300ms="search" 
                   placeholder="Search by title or filename..." 
                   class="w-full px-3.5 py-1.5 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#013d5a]" />
        </div>

    </div>

    <!-- Compact Responsive Square Media Grid -->
    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 xl:grid-cols-10 gap-3">
        @forelse($assets as $asset)
            <div wire:key="media-item-{{ $asset->id }}" 
                 class="relative group rounded-2xl border border-slate-200/80 dark:border-slate-800/80 overflow-hidden bg-white dark:bg-slate-900 shadow-2xs hover:border-[#013d5a] dark:hover:border-cyan-400 transition-all cursor-pointer">
                
                <!-- Fixed Aspect-Square Box for Identical Dimensions -->
                <div wire:click="openAssetDetails({{ $asset->id }})" class="aspect-square w-full bg-slate-100 dark:bg-slate-950 flex items-center justify-center p-2 overflow-hidden">
                    @php
                        $ext = strtolower(pathinfo($asset->file_name, PATHINFO_EXTENSION));
                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'svg', 'gif', 'ico']) || str_contains($asset->mime_type ?? '', 'image');
                    @endphp

                    @if($isImage)
                        <img src="{{ $asset->url }}" alt="{{ $asset->file_name }}" loading="lazy" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-200" />
                    @else
                        <div class="flex flex-col items-center justify-center p-2 text-center">
                            <x-icon name="solid:file-pdf" class="w-8 h-8 text-rose-500" />
                            <span class="text-[9px] font-mono text-slate-400 mt-1 uppercase">{{ $ext ?: 'DOC' }}</span>
                        </div>
                    @endif
                </div>

                <div class="p-2 border-t border-slate-100 dark:border-slate-800/80">
                    <p class="text-[10px] font-bold text-slate-800 dark:text-white truncate" title="{{ $asset->file_name }}">
                        {{ $asset->getTranslation('title', 'en') ?: $asset->file_name }}
                    </p>
                    <div class="flex items-center justify-between text-[9px] text-slate-400 mt-0.5">
                        <span>{{ $asset->human_size }}</span>
                        <span class="uppercase">{{ $ext }}</span>
                    </div>
                </div>

                <!-- Delete Action -->
                <button type="button"
                    @click.stop="$dispatch('open-confirm-dialog', {
                        title: 'Delete Media Asset',
                        message: 'Permanently remove \'{{ $asset->file_name }}\' from library?',
                        type: 'danger',
                        confirmButtonText: 'Delete Asset',
                        method: 'deleteAsset',
                        params: [{{ $asset->id }}]
                    })"
                    class="absolute top-1.5 right-1.5 p-1 rounded-lg bg-rose-500 text-white opacity-0 group-hover:opacity-100 transition-opacity shadow-sm cursor-pointer"
                    title="Delete Asset">
                    <x-icon name="solid:trash" class="w-3 h-3" />
                </button>

            </div>
        @empty
            <div class="col-span-full p-16 text-center rounded-3xl bg-white dark:bg-slate-900 border border-dashed border-slate-200 dark:border-slate-800">
                <x-icon name="solid:images" class="w-12 h-12 mx-auto text-slate-300 dark:text-slate-600 mb-3" />
                <h4 class="text-sm font-bold text-slate-700 dark:text-slate-300">No media assets found</h4>
                <p class="text-xs text-slate-400 mt-1">Upload photography, banners, and technical specs.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $assets->links() }}
    </div>

    <!-- ==================== MEDIA DETAILS & SEO INSPECTOR MODAL ==================== -->
    @if($showDetailsModal && $selectedAsset)
        <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-slate-950/75 backdrop-blur-sm" wire:click="$set('showDetailsModal', false)"></div>
            
            <div class="relative w-full max-w-4xl rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden z-10 flex flex-col md:flex-row max-h-[88vh]">
                
                <!-- Left: Uniform Fixed Preview Container (Always Identical Size) -->
                <div class="md:w-1/2 p-6 bg-slate-50 dark:bg-slate-950 flex flex-col justify-between border-b md:border-b-0 md:border-r border-slate-200 dark:border-slate-800 overflow-y-auto">
                    
                    <!-- Fixed Height Balanced Frame -->
                    <div class="w-full h-72 sm:h-80 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center p-4 overflow-hidden shadow-inner">
                        @if(str_contains($selectedAsset->mime_type, 'image') || str_contains($selectedAsset->file_name, '.svg') || in_array(pathinfo($selectedAsset->file_name, PATHINFO_EXTENSION), ['jpg','jpeg','png','webp']))
                            <img src="{{ $selectedAsset->url }}" alt="{{ $selectedAsset->file_name }}" class="w-full h-full object-contain" />
                        @else
                            <x-icon name="solid:file-pdf" class="w-16 h-16 text-rose-500" />
                        @endif
                    </div>

                    <!-- 1-Click Copy Public URL Bar -->
                    <div x-data="{ copied: false }" class="mt-4 pt-4 border-t border-slate-200 dark:border-slate-800/80">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Public CDN URL</span>
                        <div class="flex items-center gap-2">
                            <input type="text" readonly value="{{ $selectedAsset->url }}" class="w-full px-2.5 py-1.5 text-xs font-mono rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-300 select-all" />
                            <button type="button" 
                                    @click="
                                        navigator.clipboard.writeText('{{ $selectedAsset->url }}');
                                        copied = true;
                                        setTimeout(() => copied = false, 2000);
                                    "
                                    class="px-3 py-1.5 rounded-lg text-xs font-bold bg-[#013d5a] text-white dark:bg-cyan-500 dark:text-slate-950 shrink-0 cursor-pointer flex items-center gap-1.5">
                                <span x-show="!copied">Copy</span>
                                <span x-show="copied" style="display: none;">Copied!</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right: Metadata & SEO Edit Form -->
                <div class="md:w-1/2 p-6 flex flex-col justify-between overflow-y-auto">
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                            <div>
                                <h3 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider">Asset Details & SEO</h3>
                                <p class="text-[10px] text-slate-400 mt-0.5">{{ $selectedAsset->human_size }} • {{ $selectedAsset->width ? $selectedAsset->width.'x'.$selectedAsset->height : 'Vector/Doc' }}</p>
                            </div>
                            <button wire:click="$set('showDetailsModal', false)" class="text-slate-400 hover:text-slate-600 dark:hover:text-white cursor-pointer">
                                <x-icon name="solid:xmark" class="w-4 h-4" />
                            </button>
                        </div>

                        <form wire:submit="saveAssetMetadata" class="space-y-4 pt-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Asset Title / Name</label>
                                <input type="text" wire:model="editTitle" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]" />
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300">Image Alt Text (SEO)</label>
                                    <span class="text-[10px] text-emerald-600 dark:text-cyan-400 font-medium">Search Ranking Factor</span>
                                </div>
                                <input type="text" wire:model="editAlt" placeholder="Brief visual description for search engines & accessibility" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]" />
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Caption / Description</label>
                                <textarea wire:model="editCaption" rows="2" placeholder="Optional caption or technical notes" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]"></textarea>
                            </div>
                        </form>
                    </div>

                    <div class="pt-6 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                        <button type="button" 
                                wire:click="deleteAsset({{ $selectedAsset->id }})"
                                class="text-xs font-bold text-rose-500 hover:text-rose-700 cursor-pointer">
                            Delete Permanently
                        </button>

                        <div class="flex items-center gap-2">
                            <button type="button" wire:click="$set('showDetailsModal', false)" class="px-3.5 py-1.5 text-xs font-semibold text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl cursor-pointer">
                                Cancel
                            </button>
                            <button type="button" wire:click="saveAssetMetadata" class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider bg-[#013d5a] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 shadow-sm cursor-pointer">
                                Save SEO Meta
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    @endif

</div>