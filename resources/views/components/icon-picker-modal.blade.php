<div x-data="{
        isOpen: false,
        activeTab: 'library',
        searchQuery: '',
        selectedCategory: 'all',
        targetField: null,
        targetTypeField: null,
        targetIndex: null,
        limit: 48,
        isLoadingIcons: false,

        customFileSelected: false,
        customPreviewUrl: null,

        // Lightweight lazy-loaded arrays
        faIcons: [],
        customIcons: {{ Js::from(\App\Services\IconRegistry::getCustomIcons()) }},

        get filteredFaIcons() {
            let list = this.faIcons;
            if (this.selectedCategory !== 'all') {
                list = list.filter(i => i.cat === this.selectedCategory);
            }
            if (this.searchQuery.trim() !== '') {
                const q = this.searchQuery.toLowerCase().trim();
                list = list.filter(i => i.name.toLowerCase().includes(q) || i.title.toLowerCase().includes(q));
            }
            return list;
        },

        async openPicker(detail) {
            this.targetField = detail.targetField || null;
            this.targetTypeField = detail.targetTypeField || null;
            this.targetIndex = detail.targetIndex ?? null;
            
            $wire.set('modalTargetField', this.targetField);
            $wire.set('modalTargetIndex', this.targetIndex);

            this.searchQuery = '';
            this.selectedCategory = 'all';
            this.activeTab = 'library';
            this.limit = 48;
            this.customFileSelected = false;
            this.customPreviewUrl = null;
            this.isOpen = true;

            // Zero-Bloat Async Fetch with LocalStorage caching
            if (this.faIcons.length === 0) {
                if (window._cachedNordroyIcons && window._cachedNordroyIcons.length > 0) {
                    this.faIcons = window._cachedNordroyIcons;
                } else {
                    const localCached = localStorage.getItem('nordroy_fa_manifest_v2');
                    if (localCached) {
                        try {
                            this.faIcons = JSON.parse(localCached);
                            window._cachedNordroyIcons = this.faIcons;
                        } catch(e) {}
                    }
                }

                if (this.faIcons.length === 0) {
                    this.isLoadingIcons = true;
                    try {
                        const res = await fetch('{{ route('admin.icons.manifest') }}');
                        if (!res.ok) throw new Error('HTTP ' + res.status);
                        this.faIcons = await res.json();
                        window._cachedNordroyIcons = this.faIcons;
                        try {
                            localStorage.setItem('nordroy_fa_manifest_v2', JSON.stringify(this.faIcons));
                        } catch(e) {}
                    } catch (e) {
                        console.error('Icons manifest fetch failed:', e);
                        this.faIcons = [];
                    } finally {
                        this.isLoadingIcons = false;
                    }
                }
            }

            this.$nextTick(() => { this.$refs.searchInput?.focus(); });
        },

        selectIcon(iconId) {
            if (this.targetField) {
                if (typeof $wire.selectIconAsset === 'function') {
                    $wire.selectIconAsset(this.targetField, this.targetIndex, iconId, this.targetTypeField);
                } else if (this.targetIndex !== null) {
                    $wire.set(`${this.targetField}.${this.targetIndex}.icon`, iconId);
                    if (this.targetTypeField) {
                        const isCustom = iconId.startsWith('storage/') || iconId.startsWith('http');
                        $wire.set(`${this.targetField}.${this.targetIndex}.${this.targetTypeField}`, isCustom ? 'upload' : 'library');
                        if (isCustom) {
                            $wire.set(`${this.targetField}.${this.targetIndex}.custom_path`, iconId);
                        }
                    }
                } else {
                    $wire.set(this.targetField, iconId);
                }
            }
            this.closeModal();
        },

        closeModal() {
            this.isOpen = false;
            this.customFileSelected = false;
            this.customPreviewUrl = null;
        }
     }"
     @open-icon-picker.window="openPicker($event.detail)"
     @custom-icon-saved.window="
        const newUrl = $event.detail.iconUrl || ($event.detail.iconPath ? '/' + $event.detail.iconPath.replace(/^\/+/, '') : null);
        customIcons.unshift({ 
            id: $event.detail.iconId, 
            path: $event.detail.iconPath, 
            name: $event.detail.iconName, 
            is_raw_svg: $event.detail.isRawSvg,
            raw_svg: $event.detail.rawSvg,
            url: $event.detail.isRawSvg ? null : newUrl
         });
        closeModal();
     "
     @custom-icon-deleted.window="
        customIcons = customIcons.filter(i => i.id !== $event.detail.iconId && i.path !== $event.detail.iconPath);
     "
     @keydown.escape.window="closeModal()"
     class="relative z-[10000]"
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
             class="w-full max-w-4xl rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden flex flex-col max-h-[88vh]">
            
            <!-- Header -->
            <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <div class="flex items-center gap-1.5 p-1 rounded-xl bg-slate-100 dark:bg-slate-800 text-xs font-bold">
                    <button type="button" @click="activeTab = 'library'"
                        :class="activeTab === 'library' ? 'bg-white dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 shadow-xs' : 'text-slate-500 hover:text-slate-900 dark:hover:text-white'"
                        class="px-3 py-1.5 rounded-lg transition-colors cursor-pointer flex items-center gap-2">
                        <span>FontAwesome</span>
                        <span class="px-1.5 py-0.2 rounded-full text-[10px] bg-slate-200 dark:bg-slate-800" x-text="faIcons.length || '...'"></span>
                    </button>
                    <button type="button" @click="activeTab = 'custom'"
                        :class="activeTab === 'custom' ? 'bg-white dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 shadow-xs' : 'text-slate-500 hover:text-slate-900 dark:hover:text-white'"
                        class="px-3 py-1.5 rounded-lg transition-colors cursor-pointer flex items-center gap-2">
                        <span>Saved Icons</span>
                        <span class="px-1.5 py-0.2 rounded-full text-[10px] bg-emerald-500/10 text-emerald-600 dark:text-emerald-400" x-text="customIcons.length"></span>
                    </button>
                    <button type="button" @click="activeTab = 'raw_svg'"
                        :class="activeTab === 'raw_svg' ? 'bg-white dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 shadow-xs' : 'text-slate-500 hover:text-slate-900 dark:hover:text-white'"
                        class="px-3 py-1.5 rounded-lg transition-colors cursor-pointer flex items-center gap-2">
                        <span>Paste SVG</span>
                    </button>
                </div>

                <button type="button" @click="closeModal()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer">
                    <x-icon name="solid:xmark" class="w-5 h-5" />
                </button>
            </div>

            <!-- TAB 1: FONTAWESOME LIBRARY -->
            <div x-show="activeTab === 'library'" class="flex flex-col flex-1 min-h-0">
                <div class="px-5 py-3.5 bg-slate-50 dark:bg-slate-950/60 border-b border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <div class="relative w-full sm:w-80">
                        <input x-ref="searchInput"
                               x-model="searchQuery"
                               type="text" 
                               placeholder="Search icons (e.g. linkedin, ship, gear)..." 
                               class="w-full px-3 py-1.5 text-xs rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#003C58] dark:focus:ring-cyan-500" />
                    </div>

                    <div class="flex items-center gap-1.5 overflow-x-auto w-full sm:w-auto pb-1 sm:pb-0">
                        <button type="button" @click="selectedCategory = 'all'"
                            :class="selectedCategory === 'all' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white'"
                            class="px-3 py-1 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0">
                            All
                        </button>
                        <button type="button" @click="selectedCategory = 'brands'"
                            :class="selectedCategory === 'brands' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white'"
                            class="px-3 py-1 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0">
                            Brands
                        </button>
                        <button type="button" @click="selectedCategory = 'solid'"
                            :class="selectedCategory === 'solid' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white'"
                            class="px-3 py-1 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0">
                            Solid
                        </button>
                        <button type="button" @click="selectedCategory = 'regular'"
                            :class="selectedCategory === 'regular' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white'"
                            class="px-3 py-1 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0">
                            Regular
                        </button>
                    </div>
                </div>

                <!-- Loading State inside Modal -->
                <div x-show="isLoadingIcons" class="py-20 text-center text-xs text-slate-400">
                    <svg class="animate-spin h-6 w-6 text-[#003C58] dark:text-cyan-400 mx-auto mb-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Instant caching 2,800+ vector icons...</span>
                </div>

                <!-- Visual Grid -->
                <div x-show="!isLoadingIcons" class="flex-1 overflow-y-auto p-5 max-h-[50vh]">
                    <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-2.5">
                        <template x-for="icon in filteredFaIcons.slice(0, limit)" :key="icon.id">
                            <button type="button"
                                    @click="selectIcon(icon.id)"
                                    class="flex flex-col items-center justify-center p-3 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 hover:border-[#003C58] dark:hover:border-cyan-400 bg-white dark:bg-slate-950 hover:bg-slate-50 dark:hover:bg-slate-800/60 transition-all group cursor-pointer shadow-2xs">
                                
                                <div class="w-6 h-6 flex items-center justify-center mb-1.5 transition-transform group-hover:scale-120">
                                    <img :src="'/' + icon.url" :alt="icon.name" loading="lazy" class="w-5 h-5 object-contain dark:invert transition-all" />
                                </div>

                                <span class="text-[10px] font-medium text-slate-500 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-white text-center truncate max-w-full" x-text="icon.name"></span>
                            </button>
                        </template>
                    </div>

                    <div x-show="filteredFaIcons.length > limit" class="mt-6 text-center">
                        <button type="button" @click="limit += 48"
                            class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer">
                            Load More (<span x-text="filteredFaIcons.length - limit"></span> remaining)
                        </button>
                    </div>
                </div>
            </div>

            <!-- TAB 2: MY CUSTOM ICONS -->
            <div x-show="activeTab === 'custom'" class="flex-1 overflow-y-auto p-6 space-y-6 max-h-[65vh]" style="display: none;">
                <div class="p-5 rounded-3xl border-2 border-dashed border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 flex flex-col md:flex-row items-center justify-between gap-5">
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <div class="w-14 h-14 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center shrink-0 shadow-inner overflow-hidden">
                            <template x-if="customPreviewUrl">
                                <img :src="customPreviewUrl" class="w-9 h-9 object-contain" />
                            </template>
                            <template x-if="!customPreviewUrl">
                                <x-icon name="solid:cloud-arrow-up" class="w-6 h-6 text-slate-300 dark:text-slate-600" />
                            </template>
                        </div>

                        <div class="space-y-1.5 flex-1">
                            <h4 class="text-xs font-bold text-slate-800 dark:text-white uppercase tracking-wider">Upload Icon File</h4>
                            <div class="flex items-center gap-2">
                                <input type="text" 
                                       wire:model="modalCustomIconTitle"
                                       placeholder="Name (e.g. Turbine Badge)" 
                                       class="w-full sm:w-60 px-3 py-1.5 rounded-xl text-xs bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]" />
                            </div>
                            <input type="file" 
                                   wire:model="modalUploadedFile" 
                                   @change="
                                       const file = $event.target.files[0];
                                       if (file) {
                                           customFileSelected = true;
                                           customPreviewUrl = URL.createObjectURL(file);
                                       } else {
                                           customFileSelected = false;
                                           customPreviewUrl = null;
                                       }
                                   "
                                   accept=".svg,.png,.webp,.jpg,.ico" 
                                   class="text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-slate-200 dark:file:bg-slate-800 file:text-slate-800 dark:file:text-white cursor-pointer" />
                        </div>
                    </div>

                    <button type="button" 
                        wire:click="uploadCustomIcon"
                        wire:loading.attr="disabled"
                        :disabled="!customFileSelected"
                        class="w-full md:w-auto px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-[#003C58] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 shadow-sm transition-all cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed">
                        <span wire:loading.remove wire:target="uploadCustomIcon">Upload & Save</span>
                        <span wire:loading wire:target="uploadCustomIcon">Saving...</span>
                    </button>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white">Saved Custom Library (<span x-text="customIcons.length"></span>)</h4>
                        <span class="text-[10px] text-slate-400">Hover icon to delete permanently.</span>
                    </div>

                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-3">
                        <template x-for="icon in customIcons" :key="icon.id">
                            <div class="relative group">
                                <button type="button"
                                        @click="selectIcon(icon.path || icon.id)"
                                        class="w-full flex flex-col items-center justify-center p-3 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 hover:border-[#003C58] dark:hover:border-cyan-400 bg-white dark:bg-slate-950 hover:bg-slate-50 dark:hover:bg-slate-800/60 transition-all cursor-pointer shadow-2xs">
                                    
                                    <div class="w-8 h-8 flex items-center justify-center mb-1.5 transition-transform group-hover:scale-115">
                                        <template x-if="icon.is_raw_svg && icon.raw_svg">
                                            <div class="w-6 h-6 shrink-0 fill-current" x-html="icon.raw_svg"></div>
                                        </template>
                                        <template x-if="!icon.is_raw_svg && icon.url">
                                            <img :src="icon.url" :alt="icon.name" class="w-7 h-7 object-contain" />
                                        </template>
                                    </div>

                                    <span class="text-[10px] font-semibold text-slate-600 dark:text-slate-300 text-center truncate max-w-full" x-text="icon.name"></span>
                                </button>

                                <button type="button"
                                        @click.stop="$dispatch('open-confirm-dialog', {
                                            title: 'Delete Custom Icon',
                                            message: 'Permanently remove \'' + icon.name + '\' from library?',
                                            type: 'danger',
                                            confirmButtonText: 'Delete Icon',
                                            method: 'deleteCustomIcon',
                                            params: [icon.id]
                                        })"
                                        title="Delete icon"
                                        class="absolute top-1.5 right-1.5 p-1 rounded-lg bg-rose-500 text-white opacity-0 group-hover:opacity-100 transition-all cursor-pointer shadow-xs">
                                    <x-icon name="solid:trash" class="w-3 h-3" />
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- TAB 3: PASTE RAW SVG -->
            <div x-show="activeTab === 'raw_svg'" class="flex-1 overflow-y-auto p-6 space-y-5 max-h-[65vh]" style="display: none;">
                <div class="p-5 rounded-3xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 space-y-4">
                    <div>
                        <h4 class="text-xs font-bold text-slate-800 dark:text-white uppercase tracking-wider">Paste Raw Vector SVG Code</h4>
                        <p class="text-[11px] text-slate-400 mt-0.5">Copy any SVG from Figma or icon sites and paste directly.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Vector Name</label>
                        <input type="text" 
                               wire:model="modalCustomIconTitle" 
                               placeholder="e.g. Custom Nordroy Symbol" 
                               class="w-full sm:w-80 px-3 py-2 text-xs rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Raw SVG Markup (&lt;svg&gt;...&lt;/svg&gt;)</label>
                        <textarea wire:model="modalRawSvgCode" 
                                  rows="6" 
                                  placeholder="<svg viewBox='0 0 24 24'> ... </svg>" 
                                  class="w-full px-3 py-2 text-xs font-mono rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]"></textarea>
                        @error('modalRawSvgCode') <span class="text-rose-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="button" 
                                wire:click="saveRawSvgIcon"
                                class="px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-[#003C58] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 shadow-sm cursor-pointer">
                            Store Vector & Use Icon
                        </button>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="p-3.5 bg-slate-50 dark:bg-slate-950/40 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs text-slate-400">
                <span>Optimized Asynchronous Vector Engine</span>
                <button type="button" @click="closeModal()" class="px-4 py-1.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>