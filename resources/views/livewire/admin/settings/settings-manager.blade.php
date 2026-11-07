<div x-data="{ currentTab: $wire.entangle('activeTab') }">
    <x-slot:header>Global Settings</x-slot:header>

    <!-- Global Modals -->
    <x-icon-picker-modal />
    <x-media-picker-modal />

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">System Engine</span>
            <h1 class="text-xl font-extrabold text-slate-900 dark:text-white mt-0.5">Global Configuration Studio</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400">Configure corporate identity, credentials, brand assets, and digital presence.</p>
        </div>

        <button wire:click="saveSettings" wire:loading.attr="disabled"
            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-[#013d5a] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 shadow-sm active:scale-95 transition-all cursor-pointer disabled:opacity-50 shrink-0 self-start sm:self-auto">
            <span wire:loading.remove wire:target="saveSettings">Save Changes</span>
            <span wire:loading wire:target="saveSettings" class="flex items-center gap-2">
                <svg class="animate-spin h-3.5 w-3.5 text-current" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Syncing...
            </span>
        </button>
    </div>

    <!-- Success Toast Alert -->
    @if (session()->has('message'))
        <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-800 dark:text-emerald-400 text-xs font-semibold flex items-center justify-between">
            <div class="flex items-center gap-2">
                <x-icon name="solid:circle-check" class="w-4 h-4 text-emerald-500" />
                <span>{{ session('message') }}</span>
            </div>
            <button @click="$el.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 cursor-pointer">&times;</button>
        </div>
    @endif

    <!-- Responsive Layout Container -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Tab Navigation (Mobile: Horizontal / Desktop: Sticky) -->
        <div class="lg:col-span-3 lg:sticky lg:top-28 z-10">
            <nav class="flex lg:flex-col overflow-x-auto no-scrollbar gap-1 p-1.5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs">
                
                <button type="button" @click="currentTab = 'general'"
                    :class="currentTab === 'general' ? 'bg-[#013d5a] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800'"
                    class="shrink-0 flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold transition-colors text-left whitespace-nowrap cursor-pointer">
                    <x-icon name="solid:building" class="w-4 h-4 shrink-0" />
                    <span>General & Identity</span>
                </button>

                <button type="button" @click="currentTab = 'branding'"
                    :class="currentTab === 'branding' ? 'bg-[#013d5a] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800'"
                    class="shrink-0 flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold transition-colors text-left whitespace-nowrap cursor-pointer">
                    <x-icon name="solid:palette" class="w-4 h-4 shrink-0" />
                    <span>Brand Assets</span>
                </button>

                <button type="button" @click="currentTab = 'storage'"
                    :class="currentTab === 'storage' ? 'bg-[#013d5a] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800'"
                    class="shrink-0 flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold transition-colors text-left whitespace-nowrap cursor-pointer">
                    <x-icon name="solid:server" class="w-4 h-4 shrink-0" />
                    <span>Storage Engine</span>
                </button>

                <button type="button" @click="currentTab = 'localization'"
                    :class="currentTab === 'localization' ? 'bg-[#013d5a] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800'"
                    class="shrink-0 flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold transition-colors text-left whitespace-nowrap cursor-pointer">
                    <x-icon name="solid:clock" class="w-4 h-4 shrink-0" />
                    <span>Timezone & Formats</span>
                </button>

                <button type="button" @click="currentTab = 'social'"
                    :class="currentTab === 'social' ? 'bg-[#013d5a] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800'"
                    class="shrink-0 flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold transition-colors text-left whitespace-nowrap cursor-pointer">
                    <x-icon name="solid:share-nodes" class="w-4 h-4 shrink-0" />
                    <span>Social Presence</span>
                </button>

                <button type="button" @click="currentTab = 'scripts'"
                    :class="currentTab === 'scripts' ? 'bg-[#013d5a] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800'"
                    class="shrink-0 flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold transition-colors text-left whitespace-nowrap cursor-pointer">
                    <x-icon name="solid:code" class="w-4 h-4 shrink-0" />
                    <span>Custom Scripts</span>
                </button>

            </nav>
        </div>

        <!-- Form Canvas -->
        <div class="lg:col-span-9 w-full">
            <div class="p-5 sm:p-6 lg:p-7 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs w-full">
                
                <!-- TAB 1: GENERAL -->
                <div x-show="currentTab === 'general'" class="space-y-5">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2.5">Corporate Identity & Contact</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Platform Brand Name</label>
                            <input wire:model="settings.site_name" type="text" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Corporate Tagline</label>
                            <input wire:model="settings.site_tagline" type="text" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Official Corporate Email</label>
                            <input wire:model="settings.contact_email" type="email" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Direct Hotline</label>
                            <input wire:model="settings.contact_phone" type="text" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                        </div>
                        <div class="sm:col-span-2 xl:col-span-1">
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">WhatsApp Hotline</label>
                            <input wire:model="settings.whatsapp_number" type="text" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Company Physical Address</label>
                        <textarea wire:model="settings.company_address" rows="2" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Google Maps Embed URL</label>
                        <input wire:model="settings.google_maps_embed" type="text" placeholder="https://www.google.com/maps/embed?..." class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                    </div>
                </div>

                <!-- TAB 2: BRANDING (Standard Preview & Recommended Dimensions) -->
                <div x-show="currentTab === 'branding'" class="space-y-5" style="display: none;">
                    <div class="border-b border-slate-100 dark:border-slate-800 pb-2.5">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white">Brand Visual Assets</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Manage your official logos and favicon with standardized dimensions.</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <!-- 1. Corporate Primary Logo -->
                        <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-1">
                                    <span class="block text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white">Corporate Primary Logo</span>
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-mono font-bold bg-[#013d5a]/10 dark:bg-cyan-500/10 text-[#013d5a] dark:text-cyan-400 border border-[#013d5a]/20">
                                        240 × 60 px
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-400 mb-4">Recommended: Transparent SVG or PNG (Max height 60px).</p>
                                
                                <!-- Standard Real-World Height Container (h-18) -->
                                <div class="h-20 px-4 py-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 flex items-center justify-center mb-4 overflow-hidden shadow-2xs">
                                    <img src="{{ asset($settings['site_logo'] ?? 'assets/images/logo.png') }}" 
                                         alt="Corporate Logo" 
                                         class="max-h-11 w-auto max-w-[220px] object-contain dark:brightness-110" />
                                </div>
                            </div>

                            <div class="flex items-center gap-2 pt-3 border-t border-slate-200/60 dark:border-slate-800">
                                <button type="button" 
                                    @click="$dispatch('open-media-picker', { targetField: 'site_logo' })"
                                    class="flex-1 px-3.5 py-2 rounded-xl text-xs font-bold bg-[#013d5a] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 shadow-sm transition-all cursor-pointer flex items-center justify-center gap-2">
                                    <x-icon name="solid:images" class="w-3.5 h-3.5" />
                                    <span>Select from Media Library</span>
                                </button>

                                <button type="button" 
                                    wire:click="removeSettingAsset('site_logo', 'assets/images/logo.png')"
                                    title="Reset to default logo"
                                    class="p-2 rounded-xl text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors cursor-pointer border border-slate-200 dark:border-slate-800">
                                    <x-icon name="solid:rotate-left" class="w-3.5 h-3.5" />
                                </button>
                            </div>
                        </div>

                        <!-- 2. Favicon / Turbine Icon -->
                        <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-1">
                                    <span class="block text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white">Browser Favicon / Icon</span>
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-mono font-bold bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20">
                                        64 × 64 px
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-400 mb-4">Recommended: Square SVG, PNG, or ICO (1:1 ratio).</p>
                                
                                <!-- Realistic Favicon Scale Container -->
                                <div class="h-20 rounded-xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 flex items-center justify-center mb-4 overflow-hidden shadow-2xs">
                                    <div class="w-12 h-12 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-800 flex items-center justify-center p-2">
                                        <img src="{{ asset($settings['site_icon'] ?? 'assets/images/icon.png') }}" 
                                             alt="Favicon" 
                                             class="w-8 h-8 object-contain" />
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 pt-3 border-t border-slate-200/60 dark:border-slate-800">
                                <button type="button" 
                                    @click="$dispatch('open-media-picker', { targetField: 'site_icon' })"
                                    class="flex-1 px-3.5 py-2 rounded-xl text-xs font-bold bg-[#013d5a] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 shadow-sm transition-all cursor-pointer flex items-center justify-center gap-2">
                                    <x-icon name="solid:images" class="w-3.5 h-3.5" />
                                    <span>Select from Media Library</span>
                                </button>

                                <button type="button" 
                                    wire:click="removeSettingAsset('site_icon', 'assets/images/icon.png')"
                                    title="Reset to default icon"
                                    class="p-2 rounded-xl text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors cursor-pointer border border-slate-200 dark:border-slate-800">
                                    <x-icon name="solid:rotate-left" class="w-3.5 h-3.5" />
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- TAB 3: STORAGE ENGINE -->
                <div x-show="currentTab === 'storage'" class="space-y-5" style="display: none;">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2.5">Cloud Storage Driver Architecture</h3>
                    
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Active Filesystem Driver</label>
                        <select wire:model.live="settings.storage_driver" class="w-full md:w-72 px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none">
                            <option value="public">Local Public Storage</option>
                            <option value="s3">Amazon AWS S3 Bucket</option>
                            <option value="r2">Cloudflare R2 (S3 Compatible)</option>
                        </select>
                    </div>

                    <div x-show="$wire.settings.storage_driver === 's3' || $wire.settings.storage_driver === 'r2'" class="space-y-4 pt-1">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Access Key ID</label>
                                <input wire:model="settings.s3_key" type="password" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Secret Access Key</label>
                                <input wire:model="settings.s3_secret" type="password" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Bucket Name</label>
                                <input wire:model="settings.s3_bucket" type="text" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Region</label>
                                <input wire:model="settings.s3_region" type="text" placeholder="auto or us-east-1" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">CDN / Public URL</label>
                                <input wire:model="settings.s3_cdn_url" type="text" placeholder="https://cdn.nordroy.com" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                            </div>
                        </div>

                        <div x-show="$wire.settings.storage_driver === 'r2'">
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Cloudflare R2 Endpoint URL</label>
                            <input wire:model="settings.s3_endpoint" type="text" placeholder="https://<account-id>.r2.cloudflarestorage.com" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                        </div>
                    </div>
                </div>

                <!-- TAB 4: LOCALIZATION -->
                <div x-show="currentTab === 'localization'" class="space-y-5" style="display: none;">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2.5">Timezone & Localization Settings</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">System Timezone</label>
                            <input wire:model="settings.default_timezone" type="text" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Date Format</label>
                            <select wire:model="settings.date_format" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none">
                                <option value="d M, Y">15 Mar, 2026 (d M, Y)</option>
                                <option value="Y-m-d">2026-03-15 (Y-m-d)</option>
                                <option value="d/m/Y">15/03/2026 (d/m/Y)</option>
                                <option value="F d, Y">March 15, 2026 (F d, Y)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Time Format</label>
                            <select wire:model="settings.time_format" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none">
                                <option value="h:i A">12 Hour (06:30 PM)</option>
                                <option value="H:i">24 Hour (18:30)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- TAB 5: COMPACT SOCIAL PRESENCE -->
                <div x-show="currentTab === 'social'" class="space-y-4" style="display: none;">
                    <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-2.5">
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white">Corporate Social Channels</h3>
                            <p class="text-[11px] text-slate-400">Click on any icon badge to visually select from the Vector Library.</p>
                        </div>
                        <button type="button" wire:click="addSocialLink"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-[#013d5a]/10 dark:bg-cyan-500/10 text-[#013d5a] dark:text-cyan-400 hover:bg-[#013d5a] hover:text-white dark:hover:bg-cyan-500 dark:hover:text-slate-950 transition-all cursor-pointer">
                            <x-icon name="solid:plus" class="w-3.5 h-3.5" />
                            <span>Add Channel</span>
                        </button>
                    </div>

                    <div class="divide-y divide-slate-100 dark:divide-slate-800/80">
                        @forelse ($socialLinks as $index => $link)
                            <div wire:key="compact-social-{{ $index }}" 
                                 class="py-3 flex flex-col sm:flex-row items-start sm:items-center gap-3 group">
                                
                                <button type="button" 
                                    @click="$dispatch('open-icon-picker', { targetField: 'socialLinks', targetTypeField: 'icon_type', targetIndex: {{ $index }} })"
                                    title="Click to change icon visually from library"
                                    class="relative w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800/80 hover:bg-[#013d5a] dark:hover:bg-cyan-500 hover:text-white dark:hover:text-slate-950 text-[#013d5a] dark:text-cyan-400 border border-slate-200 dark:border-slate-700/80 flex items-center justify-center shrink-0 transition-all cursor-pointer group/btn shadow-2xs">
                                    <x-icon :name="$link['icon'] ?? 'solid:globe'" class="w-4 h-4" />
                                    <span class="absolute -bottom-1 -right-1 w-3.5 h-3.5 rounded-full bg-slate-900 text-white dark:bg-white dark:text-slate-900 flex items-center justify-center text-[8px] opacity-0 group-hover/btn:opacity-100 transition-opacity">✎</span>
                                </button>

                                <div class="w-full sm:w-44 shrink-0">
                                    <input wire:model="socialLinks.{{ $index }}.title" type="text" placeholder="Platform (e.g. LinkedIn)"
                                        class="w-full px-3 py-1.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                                </div>

                                <div class="w-full flex-1">
                                    <input wire:model="socialLinks.{{ $index }}.url" type="url" placeholder="https://..."
                                        class="w-full px-3 py-1.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                                </div>

                                <button type="button" wire:click="removeSocialLink({{ $index }})"
                                    title="Delete link"
                                    class="p-1.5 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors cursor-pointer self-end sm:self-auto shrink-0">
                                    <x-icon name="solid:trash" class="w-4 h-4" />
                                </button>

                            </div>
                        @empty
                            <div class="py-8 text-center text-slate-400 text-xs">
                                No social channels added yet. Click <button type="button" wire:click="addSocialLink" class="font-bold text-[#013d5a] dark:text-cyan-400 hover:underline">+ Add Channel</button> to begin.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- TAB 6: CUSTOM SCRIPTS -->
                <div x-show="currentTab === 'scripts'" class="space-y-4" style="display: none;">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2.5">Raw Analytics & Script Injection</h3>
                    
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Custom Header Scripts (Inside &lt;head&gt;)</label>
                        <textarea wire:model="settings.custom_head_scripts" rows="4" placeholder="<!-- Google Analytics, Meta Pixel, etc. -->" class="w-full px-3 py-2 rounded-xl text-xs font-mono bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Custom Footer Scripts (Before &lt;/body&gt;)</label>
                        <textarea wire:model="settings.custom_footer_scripts" rows="4" placeholder="<!-- Live Chat, Tracking widgets, etc. -->" class="w-full px-3 py-2 rounded-xl text-xs font-mono bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none"></textarea>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>