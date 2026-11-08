<div wire:ignore.self
     x-data="nordroyIconPicker()"
     @open-icon-picker.window="openPicker($event.detail)"
     @custom-icon-saved.window="handleCustomIconSaved($event.detail)"
     @custom-icon-deleted.window="handleCustomIconDeleted($event.detail)"
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
                        <span>Saved &amp; Upload</span>
                        <span class="px-1.5 py-0.2 rounded-full text-[10px] bg-emerald-500/10 text-emerald-600 dark:text-emerald-400" x-text="customIcons.length"></span>
                    </button>
                    <button type="button" @click="activeTab = 'raw_svg'"
                        :class="activeTab === 'raw_svg' ? 'bg-white dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 shadow-xs' : 'text-slate-500 hover:text-slate-900 dark:hover:text-white'"
                        class="px-3 py-1.5 rounded-lg transition-colors cursor-pointer flex items-center gap-2">
                        <span>Paste SVG</span>
                        <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
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
                               @input="limit = 72"
                               type="text" 
                               placeholder="Search icons (e.g. linkedin, ship, gear)..." 
                               class="w-full px-3 py-1.5 text-xs rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#003C58] dark:focus:ring-cyan-500" />
                    </div>

                    <div class="flex items-center gap-1.5 overflow-x-auto w-full sm:w-auto pb-1 sm:pb-0">
                        <button type="button" @click="selectedCategory = 'all'; limit = 72"
                            :class="selectedCategory === 'all' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white'"
                            class="px-3 py-1 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0">
                            All
                        </button>
                        <button type="button" @click="selectedCategory = 'brands'; limit = 72"
                            :class="selectedCategory === 'brands' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white'"
                            class="px-3 py-1 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0">
                            Brands
                        </button>
                        <button type="button" @click="selectedCategory = 'solid'; limit = 72"
                            :class="selectedCategory === 'solid' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white'"
                            class="px-3 py-1 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0">
                            Solid
                        </button>
                        <button type="button" @click="selectedCategory = 'regular'; limit = 72"
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
                    <span>Instant caching vector icons...</span>
                </div>

                <!-- Visual Grid -->
                <div x-show="!isLoadingIcons" class="flex-1 overflow-y-auto p-5 max-h-[50vh]">
                    <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-2.5">
                        <template x-for="icon in displayedIcons" :key="icon.id">
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
                        <button type="button" @click="limit += 72"
                            class="px-5 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer">
                            Load More (<span x-text="filteredFaIcons.length - limit"></span> remaining)
                        </button>
                    </div>
                </div>
            </div>

            <!-- TAB 2: MY CUSTOM ICONS & IMAGE UPLOAD -->
            <div x-show="activeTab === 'custom'" class="flex-1 overflow-y-auto p-6 space-y-6 max-h-[65vh]" style="display: none;">
                
                <!-- Upload Box with Drag & Drop & Direct File Handler -->
                <div class="p-5 rounded-3xl border-2 border-dashed transition-all"
                     :class="isDragging ? 'border-cyan-500 bg-cyan-500/5' : 'border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950'"
                     @dragover.prevent="isDragging = true"
                     @dragleave.prevent="isDragging = false"
                     @drop.prevent="handleDrop($event)">
                    
                    <div class="flex flex-col md:flex-row items-center justify-between gap-5">
                        
                        <div class="flex items-center gap-4 w-full md:w-auto">
                            <!-- Preview Box -->
                            <div class="w-16 h-16 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center shrink-0 shadow-inner overflow-hidden p-2 relative group">
                                <template x-if="customPreviewUrl">
                                    <img :src="customPreviewUrl" class="w-full h-full object-contain" />
                                </template>
                                <template x-if="!customPreviewUrl">
                                    <x-icon name="solid:cloud-arrow-up" class="w-7 h-7 text-slate-300 dark:text-slate-600" />
                                </template>
                            </div>

                            <div class="space-y-1.5 flex-1">
                                <div class="flex items-center gap-2">
                                    <h4 class="text-xs font-bold text-slate-800 dark:text-white uppercase tracking-wider">Upload Icon Image or Vector</h4>
                                    <span class="text-[10px] font-mono text-slate-400">PNG, SVG, WebP, JPG, ICO, GIF</span>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                                    <input type="text" 
                                           x-model="customIconTitle" 
                                           placeholder="Icon Title (e.g. Marine Radar)" 
                                           class="w-full sm:w-64 px-3 py-1.5 rounded-xl text-xs bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]" />
                                    
                                    <div class="flex items-center gap-2">
                                        <input type="file" 
                                               x-ref="iconFileInput" 
                                               @change="handleFileSelect($event)"
                                               accept=".svg,.png,.webp,.jpg,.jpeg,.ico,.gif" 
                                               class="hidden" />

                                        <button type="button" 
                                                @click="$refs.iconFileInput.click()"
                                                class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors inline-flex items-center gap-1.5 cursor-pointer shadow-2xs">
                                            <x-icon name="solid:folder-open" class="w-3.5 h-3.5" />
                                            <span x-text="customFileSelected ? 'Change File' : 'Choose File'"></span>
                                        </button>

                                        <template x-if="customFileSelected">
                                            <button type="button" 
                                                    @click="clearSelectedFile()"
                                                    class="p-1.5 rounded-xl text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors cursor-pointer"
                                                    title="Remove selected file">
                                                <x-icon name="solid:xmark" class="w-4 h-4" />
                                            </button>
                                        </template>
                                    </div>
                                </div>

                                <template x-if="selectedFileName">
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400">
                                        Selected: <span class="font-semibold text-slate-700 dark:text-slate-200" x-text="selectedFileName"></span>
                                        <span class="text-[10px] text-slate-400" x-text="'(' + selectedFileSize + ')'"></span>
                                    </p>
                                </template>

                                <template x-if="uploadError">
                                    <span class="text-rose-500 text-xs font-semibold block mt-1" x-text="uploadError"></span>
                                </template>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="w-full md:w-auto flex flex-col items-center md:items-end gap-2">
                            <button type="button" 
                                @click="uploadCustomIconFile()"
                                :disabled="!customFileSelected || isUploading"
                                class="w-full md:w-auto px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-[#003C58] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 shadow-sm transition-all cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed inline-flex items-center justify-center gap-2">
                                
                                <template x-if="!isUploading">
                                    <span class="inline-flex items-center gap-2 whitespace-nowrap">
                                        <x-icon name="solid:cloud-arrow-up" class="w-4 h-4" />
                                        <span>Upload &amp; Save Icon</span>
                                    </span>
                                </template>

                                <template x-if="isUploading">
                                    <span class="inline-flex items-center gap-2 whitespace-nowrap">
                                        <svg class="animate-spin h-3.5 w-3.5 text-current shrink-0" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span x-text="uploadProgress < 100 ? ('Uploading ' + uploadProgress + '%...') : 'Processing Icon...'"></span>
                                    </span>
                                </template>
                            </button>
                        </div>
                    </div>

                    <!-- Upload Progress Bar -->
                    <div x-show="isUploading" class="w-full mt-4 bg-slate-200 dark:bg-slate-800 rounded-full h-1.5 overflow-hidden" style="display: none;">
                        <div class="bg-cyan-500 h-1.5 rounded-full transition-all duration-150" :style="'width: ' + uploadProgress + '%'"></div>
                    </div>
                </div>

                <!-- Custom Saved Library Grid -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white">Saved Custom Library (<span x-text="customIcons.length"></span>)</h4>
                        <span class="text-[10px] text-slate-400">Click to select icon. Hover to delete permanently.</span>
                    </div>

                    <template x-if="customIcons.length === 0">
                        <div class="p-8 text-center text-xs text-slate-400 border border-dashed border-slate-200 dark:border-slate-800 rounded-2xl">
                            No custom icons uploaded yet. Upload a PNG, SVG or paste SVG code above to build your corporate icon library.
                        </div>
                    </template>

                    <div x-show="customIcons.length > 0" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-3">
                        <template x-for="icon in customIcons" :key="icon.id">
                            <div class="relative group">
                                <button type="button"
                                        @click="selectIcon(icon.path || icon.id)"
                                        class="w-full flex flex-col items-center justify-center p-3 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 hover:border-[#003C58] dark:hover:border-cyan-400 bg-white dark:bg-slate-950 hover:bg-slate-50 dark:hover:bg-slate-800/60 transition-all cursor-pointer shadow-2xs">
                                    
                                    <div class="w-8 h-8 flex items-center justify-center mb-1.5 transition-transform group-hover:scale-115">
                                        <template x-if="icon.is_raw_svg && icon.raw_svg">
                                            <div class="w-6 h-6 shrink-0 fill-current text-slate-800 dark:text-cyan-400 [&>svg]:w-full [&>svg]:h-full [&>svg]:max-w-full [&>svg]:max-h-full flex items-center justify-center" x-html="icon.raw_svg"></div>
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

            <!-- TAB 3: PASTE RAW SVG (WITH LIVE DUAL-SURFACE PREVIEW) -->
            <div x-show="activeTab === 'raw_svg'" class="flex-1 overflow-y-auto p-6 space-y-5 max-h-[65vh]" style="display: none;">
                
                <div class="p-5 rounded-3xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 space-y-4">
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-xs font-bold text-slate-800 dark:text-white uppercase tracking-wider">Paste Raw Vector SVG Code</h4>
                            <p class="text-[11px] text-slate-400 mt-0.5">Paste SVG markup from Figma, Heroicons, or Lucide and preview in real time.</p>
                        </div>
                        <button type="button" 
                                @click="pasteFromClipboard()"
                                class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors inline-flex items-center gap-1.5 cursor-pointer shadow-2xs">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                            <span>Paste from Clipboard</span>
                        </button>
                    </div>

                    <!-- Input & Preview Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 pt-1">
                        
                        <!-- Left: Inputs (7 cols) -->
                        <div class="lg:col-span-7 space-y-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Vector Icon Name</label>
                                <input type="text" 
                                       x-model="rawSvgTitle" 
                                       placeholder="e.g. Marine Radar Symbol" 
                                       class="w-full px-3 py-2 text-xs rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]" />
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300">
                                        Raw SVG Markup (&lt;svg&gt;...&lt;/svg&gt;)
                                    </label>
                                    <span class="text-[10px] font-mono text-slate-400" x-text="rawSvgInput.length + ' chars'"></span>
                                </div>
                                <textarea x-model="rawSvgInput" 
                                          rows="6" 
                                          placeholder="<svg viewBox='0 0 24 24' fill='currentColor'> ... </svg>" 
                                          class="w-full px-3 py-2 text-xs font-mono rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]"></textarea>
                            </div>
                        </div>

                        <!-- Right: LIVE DUAL-SURFACE PREVIEW HUD (5 cols) -->
                        <div class="lg:col-span-5 flex flex-col justify-between p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 space-y-3">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Live Icon Preview</span>
                                    <template x-if="isSvgValid">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Valid Vector
                                        </span>
                                    </template>
                                    <template x-if="!isSvgValid && rawSvgInput.length > 0">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-600 dark:text-amber-400">
                                            Incomplete SVG
                                        </span>
                                    </template>
                                </div>

                                <!-- Dual Preview Swatches -->
                                <div class="grid grid-cols-2 gap-3">
                                    
                                    <!-- Light Surface Swatch -->
                                    <div class="p-3 rounded-xl bg-slate-100 border border-slate-200 text-center space-y-1.5">
                                        <span class="text-[10px] font-mono font-semibold text-slate-500 uppercase block">Light Theme</span>
                                        <div class="h-16 w-full rounded-lg bg-white border border-slate-200/80 flex items-center justify-center p-2 shadow-2xs">
                                            <template x-if="isSvgValid">
                                                <div class="w-8 h-8 flex items-center justify-center text-[#003C58] fill-current stroke-current [&>svg]:w-full [&>svg]:h-full [&>svg]:max-w-full [&>svg]:max-h-full" 
                                                     x-html="sanitizedSvgPreview"></div>
                                            </template>
                                            <template x-if="!isSvgValid">
                                                <span class="text-[10px] text-slate-300 font-mono">No Preview</span>
                                            </template>
                                        </div>
                                    </div>

                                    <!-- Dark Surface Swatch -->
                                    <div class="p-3 rounded-xl bg-[#06121d] border border-slate-800 text-center space-y-1.5">
                                        <span class="text-[10px] font-mono font-semibold text-slate-400 uppercase block">Dark Theme</span>
                                        <div class="h-16 w-full rounded-lg bg-[#0b1b2b] border border-slate-700/60 flex items-center justify-center p-2 shadow-inner">
                                            <template x-if="isSvgValid">
                                                <div class="w-8 h-8 flex items-center justify-center text-cyan-400 fill-current stroke-current [&>svg]:w-full [&>svg]:h-full [&>svg]:max-w-full [&>svg]:max-h-full" 
                                                     x-html="sanitizedSvgPreview"></div>
                                            </template>
                                            <template x-if="!isSvgValid">
                                                <span class="text-[10px] text-slate-600 font-mono">No Preview</span>
                                            </template>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <p class="text-[10px] text-slate-400 leading-tight">
                                SVGs automatically inherit brand colors and adjust to light/dark mode seamlessly.
                            </p>
                        </div>

                    </div>

                    <!-- Footer Action -->
                    <div class="flex items-center justify-between pt-3 border-t border-slate-200 dark:border-slate-800">
                        <span class="text-[11px] text-slate-400" x-show="isSvgValid">Ready to store in persistent vector database.</span>
                        <span class="text-[11px] text-amber-500" x-show="!isSvgValid && rawSvgInput.length > 0">Please paste a complete &lt;svg&gt;...&lt;/svg&gt; block.</span>
                        <span class="text-[11px] text-slate-400" x-show="rawSvgInput.length === 0"></span>

                        <button type="button" 
                                @click="saveRawSvg()"
                                :disabled="!isSvgValid || isSavingSvg"
                                class="px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-[#003C58] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 shadow-sm transition-all cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed inline-flex items-center justify-center gap-2">
                            <span x-show="!isSavingSvg" class="inline-flex items-center gap-2 whitespace-nowrap">
                                <x-icon name="solid:cloud-arrow-up" class="w-4 h-4" />
                                <span>Store Vector &amp; Use Icon</span>
                            </span>
                            <span x-show="isSavingSvg" class="items-center justify-center gap-2 whitespace-nowrap" style="display: none;">
                                <svg class="animate-spin h-3.5 w-3.5 text-current shrink-0" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Processing Vector...</span>
                            </span>
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

<script>
    window.nordroyIconPicker = function() {
        return {
            isOpen: false,
            activeTab: 'library',
            searchQuery: '',
            selectedCategory: 'all',
            targetField: null,
            targetTypeField: null,
            targetIndex: null,
            limit: 72,
            isLoadingIcons: false,
            iconsVersion: 0,

            // File upload state
            selectedFile: null,
            selectedFileName: null,
            selectedFileSize: null,
            customFileSelected: false,
            customPreviewUrl: null,
            customIconTitle: '',
            isUploading: false,
            uploadProgress: 0,
            uploadError: null,
            isDragging: false,

            // Raw SVG state
            rawSvgInput: '',
            rawSvgTitle: '',
            isSavingSvg: false,

            // Lightweight lazy-loaded arrays
            faIcons: [],
            customIcons: @json(\App\Services\IconRegistry::getCustomIcons()),

            init() {
                this.preloadIcons();
            },

            async preloadIcons() {
                if (this.faIcons && this.faIcons.length > 0) return;

                if (window._cachedNordroyIcons && window._cachedNordroyIcons.length > 0) {
                    this.faIcons = window._cachedNordroyIcons;
                    this.iconsVersion++;
                    return;
                }

                const localCached = localStorage.getItem('nordroy_fa_manifest_v2');
                if (localCached) {
                    try {
                        const parsed = JSON.parse(localCached);
                        if (Array.isArray(parsed) && parsed.length > 0) {
                            this.faIcons = parsed;
                            window._cachedNordroyIcons = parsed;
                            this.iconsVersion++;
                            return;
                        }
                    } catch(e) {}
                }

                this.isLoadingIcons = true;
                try {
                    const res = await fetch('{{ route('admin.icons.manifest') }}');
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    const data = await res.json();
                    this.faIcons = Array.isArray(data) ? data : [];
                    window._cachedNordroyIcons = this.faIcons;
                    this.iconsVersion++;
                    try {
                        localStorage.setItem('nordroy_fa_manifest_v2', JSON.stringify(this.faIcons));
                    } catch(e) {}
                } catch (e) {
                    console.error('Icons manifest fetch failed:', e);
                    this.faIcons = [];
                } finally {
                    this.isLoadingIcons = false;
                }
            },

            get filteredFaIcons() {
                this.iconsVersion;
                let list = this.faIcons || [];
                if (this.selectedCategory !== 'all') {
                    list = list.filter(i => i.cat === this.selectedCategory);
                }
                if (this.searchQuery && this.searchQuery.trim() !== '') {
                    const q = this.searchQuery.toLowerCase().trim();
                    list = list.filter(i => (i.name && i.name.toLowerCase().includes(q)) || (i.title && i.title.toLowerCase().includes(q)));
                }
                return list;
            },

            get displayedIcons() {
                this.iconsVersion;
                return this.filteredFaIcons.slice(0, this.limit);
            },

            get sanitizedSvgPreview() {
                if (!this.rawSvgInput || typeof this.rawSvgInput !== 'string') return null;
                let val = this.rawSvgInput.trim();
                if (!val.includes('<svg') || !val.includes('</svg>')) return null;

                try {
                    val = val.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
                    if (!val.includes('viewBox')) {
                        const m = val.match(/width=['"]([0-9.]+)['"]\s+height=['"]([0-9.]+)['"]/i);
                        if (m) {
                            val = val.replace(/<svg/i, `<svg viewBox='0 0 ${m[1]} ${m[2]}'`);
                        }
                    }
                    val = val.replace(/\s*(width|height)=['"][^'"]*['"]/gi, '');
                    return val;
                } catch(e) {
                    return null;
                }
            },

            get isSvgValid() {
                return this.sanitizedSvgPreview !== null;
            },

            formatFileSize(bytes) {
                if (!bytes || bytes === 0) return '0 B';
                const k = 1024;
                const sizes = ['B', 'KB', 'MB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
            },

            handleFileSelect(event) {
                const file = event.target.files ? event.target.files[0] : null;
                this.processSelectedFile(file);
            },

            handleDrop(event) {
                this.isDragging = false;
                const file = event.dataTransfer?.files?.[0];
                if (file) {
                    this.processSelectedFile(file);
                }
            },

            processSelectedFile(file) {
                this.uploadError = null;
                if (!file) {
                    this.clearSelectedFile();
                    return;
                }

                const validExtensions = ['svg', 'png', 'webp', 'jpg', 'jpeg', 'ico', 'gif'];
                const ext = file.name.split('.').pop().toLowerCase();
                if (!validExtensions.includes(ext)) {
                    this.uploadError = 'Supported formats: PNG, SVG, WebP, JPG, ICO, GIF.';
                    return;
                }

                if (file.size > 5 * 1024 * 1024) {
                    this.uploadError = 'Icon file size exceeds 5MB limit.';
                    return;
                }

                this.selectedFile = file;
                this.selectedFileName = file.name;
                this.selectedFileSize = this.formatFileSize(file.size);
                this.customFileSelected = true;
                this.customPreviewUrl = URL.createObjectURL(file);

                if (!this.customIconTitle || this.customIconTitle.trim() === '') {
                    const base = file.name.substring(0, file.name.lastIndexOf('.')) || file.name;
                    this.customIconTitle = base.replace(/[-_]+/g, ' ').replace(/\b\w/g, c => c.toUpperCase()).trim();
                }
            },

            clearSelectedFile() {
                this.selectedFile = null;
                this.selectedFileName = null;
                this.selectedFileSize = null;
                this.customFileSelected = false;
                this.customPreviewUrl = null;
                this.customIconTitle = '';
                this.uploadProgress = 0;
                this.uploadError = null;
                if (this.$refs.iconFileInput) {
                    this.$refs.iconFileInput.value = '';
                }
            },

            uploadCustomIconFile() {
                if (!this.selectedFile) {
                    this.uploadError = 'Please select an icon file first.';
                    return;
                }

                this.isUploading = true;
                this.uploadProgress = 0;
                this.uploadError = null;

                const file = this.selectedFile;
                const title = (this.customIconTitle || '').trim();

                this.$wire.upload(
                    'modalUploadedFile',
                    file,
                    () => {
                        this.$wire.uploadCustomIcon(this.targetField, this.targetIndex, this.targetTypeField, title)
                            .then(() => {
                                this.isUploading = false;
                                this.clearSelectedFile();
                            })
                            .catch((err) => {
                                this.isUploading = false;
                                this.uploadError = 'Failed to save custom icon on server.';
                                console.error('Error saving custom icon:', err);
                            });
                    },
                    (error) => {
                        this.isUploading = false;
                        this.uploadError = error || 'Upload failed. File must be under 5MB.';
                    },
                    (event) => {
                        this.uploadProgress = event.detail.progress;
                    }
                );
            },

            saveRawSvg() {
                if (!this.isSvgValid) return;
                this.isSavingSvg = true;

                const title = (this.rawSvgTitle || '').trim();
                const svgCode = (this.rawSvgInput || '').trim();

                this.$wire.saveRawSvgIcon(this.targetField, this.targetIndex, this.targetTypeField, svgCode, title)
                    .then(() => {
                        this.isSavingSvg = false;
                        this.rawSvgInput = '';
                        this.rawSvgTitle = '';
                    })
                    .catch((err) => {
                        this.isSavingSvg = false;
                        console.error('Failed to save raw SVG:', err);
                    });
            },

            async pasteFromClipboard() {
                try {
                    const text = await navigator.clipboard.readText();
                    if (text && text.includes('<svg')) {
                        this.rawSvgInput = text;
                    }
                } catch(e) {
                    console.warn('Clipboard read permission denied or unavailable:', e);
                }
            },

            async openPicker(detail) {
                detail = detail || {};
                this.targetField = detail.targetField || null;
                this.targetTypeField = detail.targetTypeField || null;
                this.targetIndex = detail.targetIndex ?? null;
                
                if (this.$wire) {
                    this.$wire.set('modalTargetField', this.targetField);
                    this.$wire.set('modalTargetIndex', this.targetIndex);
                }

                this.searchQuery = '';
                this.selectedCategory = 'all';
                this.activeTab = detail.initialTab || 'library';
                this.limit = 72;
                this.clearSelectedFile();
                this.rawSvgInput = '';
                this.rawSvgTitle = '';

                if (this.faIcons.length === 0) {
                    await this.preloadIcons();
                }

                this.isOpen = true;
                this.$nextTick(() => { this.$refs.searchInput?.focus(); });
            },

            handleCustomIconSaved(detail) {
                detail = detail || {};
                const newUrl = detail.iconUrl || (detail.iconPath ? '/' + detail.iconPath.replace(/^\/+/, '') : null);
                this.customIcons.unshift({ 
                    id: detail.iconId, 
                    path: detail.iconPath, 
                    name: detail.iconName, 
                    is_raw_svg: detail.isRawSvg,
                    raw_svg: detail.rawSvg,
                    url: detail.isRawSvg ? null : newUrl
                });
                if (this.targetField) {
                    this.selectIcon(detail.iconPath);
                } else {
                    this.closeModal();
                }
            },

            handleCustomIconDeleted(detail) {
                detail = detail || {};
                this.customIcons = this.customIcons.filter(i => i.id !== detail.iconId && i.path !== detail.iconPath);
            },

            selectIcon(iconId) {
                if (this.targetField && this.$wire) {
                    if (typeof this.$wire.selectIconAsset === 'function') {
                        this.$wire.selectIconAsset(this.targetField, this.targetIndex, iconId, this.targetTypeField);
                    } else if (this.targetIndex !== null) {
                        this.$wire.set(`${this.targetField}.${this.targetIndex}.icon`, iconId);
                        if (this.targetTypeField) {
                            const isCustom = iconId.startsWith('storage/') || iconId.startsWith('http') || iconId.startsWith('raw_svg:');
                            this.$wire.set(`${this.targetField}.${this.targetIndex}.${this.targetTypeField}`, isCustom ? 'upload' : 'library');
                            if (isCustom) {
                                this.$wire.set(`${this.targetField}.${this.targetIndex}.custom_path`, iconId);
                            }
                        }
                    } else {
                        this.$wire.set(this.targetField, iconId);
                    }
                }
                this.closeModal();
            },

            closeModal() {
                this.isOpen = false;
                this.clearSelectedFile();
                this.rawSvgInput = '';
                this.rawSvgTitle = '';
            }
        };
    };
</script>
