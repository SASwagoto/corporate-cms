<div>
    <x-slot:header>Theme Studio</x-slot:header>

    <!-- Dynamic Web Fonts Loader: Ensures every font family renders instantly in the preview -->
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800,900|inter:400,500,600,700,800,900|outfit:400,500,600,700,800,900|montserrat:400,500,600,700,800,900|space-grotesk:400,500,600,700|syne:500,600,700,800|roboto:400,500,700,900|dm-sans:400,500,700,800&display=swap" />

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Design System Architecture</span>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white mt-0.5">Corporate Theme & Visual Tokens</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400">Granular control over global colors, typography, buttons, layout width, and header styling.</p>
        </div>

        <!-- Publish Button -->
        <button wire:click="saveThemeTokens" 
                wire:loading.attr="disabled"
                class="inline-flex items-center justify-center h-10 px-6 rounded-xl font-bold text-xs uppercase tracking-wider bg-[#013d5a] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 shadow-sm active:scale-95 transition-all cursor-pointer disabled:opacity-60 disabled:cursor-wait shrink-0 self-start sm:self-auto">
            
            <span wire:loading.remove wire:target="saveThemeTokens" class="inline-flex items-center gap-2 whitespace-nowrap">
                <x-icon name="solid:floppy-disk" class="w-3.5 h-3.5" />
                <span>Publish Theme Tokens</span>
            </span>

            <span wire:loading.flex wire:target="saveThemeTokens" class="items-center justify-center gap-2 whitespace-nowrap" style="display: none;">
                <svg class="animate-spin h-3.5 w-3.5 text-current shrink-0" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Publishing Tokens...</span>
            </span>
        </button>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-800 dark:text-emerald-400 text-xs font-semibold flex items-center justify-between">
            <div class="flex items-center gap-2">
                <x-icon name="solid:circle-check" class="w-4 h-4 text-emerald-500" />
                <span>{{ session('message') }}</span>
            </div>
            <button @click="$el.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 cursor-pointer">&times;</button>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start" x-data="{ canvasDark: false }">
        
        <!-- LEFT COLUMN: Navigation Tabs + Controls (7 cols) -->
        <div class="lg:col-span-7 space-y-5">
            
            <!-- Quick Presets Shelf (8 Curated Industrial Palettes) -->
            <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-2xs">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Instant Corporate Presets</span>
                    <span class="text-[10px] text-slate-400">Click to apply palette & typography</span>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                    @foreach($presets as $key => $preset)
                        <button type="button" wire:click="applyPreset('{{ $key }}')"
                            class="p-2.5 rounded-xl border text-left transition-all cursor-pointer group bg-slate-50/50 dark:bg-slate-950/40 relative {{ ($theme['theme_primary_color'] ?? '') === $preset['primary'] ? 'border-[#013d5a] dark:border-cyan-400 ring-2 ring-[#013d5a]/20 dark:ring-cyan-400/20' : 'border-slate-200 dark:border-slate-800 hover:border-[#013d5a] dark:hover:border-cyan-400' }}">
                            
                            <div class="flex items-center gap-1.5 mb-2">
                                <span class="w-3.5 h-3.5 rounded-full border border-slate-300 dark:border-slate-700 shadow-xs shrink-0" style="background-color: {{ $preset['primary'] }}"></span>
                                <span class="w-3.5 h-3.5 rounded-full border border-slate-300 dark:border-slate-700 shadow-xs shrink-0" style="background-color: {{ $preset['secondary'] }}"></span>
                                <span class="w-3.5 h-3.5 rounded-full border border-slate-300 dark:border-slate-700 shadow-xs shrink-0" style="background-color: {{ $preset['accent'] }}"></span>
                            </div>
                            <p class="text-[11px] font-bold text-slate-800 dark:text-white truncate group-hover:text-[#013d5a] dark:group-hover:text-cyan-400">{{ $preset['name'] }}</p>
                            <span class="text-[9px] text-slate-400 block truncate mt-0.5">{{ $preset['font_head'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Granular Studio Tabs -->
            <div class="flex items-center gap-1 overflow-x-auto no-scrollbar p-1 rounded-xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-2xs">
                <button wire:click="setTab('colors')"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0 {{ $activeTab === 'colors' ? 'bg-[#013d5a] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Colors & Palette
                </button>
                <button wire:click="setTab('typography')"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0 {{ $activeTab === 'typography' ? 'bg-[#013d5a] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Typography
                </button>
                <button wire:click="setTab('buttons')"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0 {{ $activeTab === 'buttons' ? 'bg-[#013d5a] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Button Styles
                </button>
                <button wire:click="setTab('cards')"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0 {{ $activeTab === 'cards' ? 'bg-[#013d5a] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Cards & Surfaces
                </button>
                <button wire:click="setTab('header')"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0 {{ $activeTab === 'header' ? 'bg-[#013d5a] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Header & Nav
                </button>
                <button wire:click="setTab('layout')"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0 {{ $activeTab === 'layout' ? 'bg-[#013d5a] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Layout & Spacing
                </button>
            </div>

            <!-- TAB 1: COLORS -->
            @if($activeTab === 'colors')
                <div class="p-5 sm:p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2">Corporate Color Architecture</h3>

                    <!-- Primary -->
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 dark:text-white">Primary Brand Color</label>
                            <p class="text-[11px] text-slate-400">Dominant brand identity, headers, main CTA buttons, active state indicators.</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <input type="color" wire:model.live="theme.theme_primary_color" class="w-8 h-8 rounded-lg border-0 cursor-pointer bg-transparent" />
                            <input type="text" wire:model.live="theme.theme_primary_color" class="w-24 px-2.5 py-1 text-xs font-mono rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 uppercase" />
                        </div>
                    </div>

                    <!-- Secondary -->
                    <div class="flex items-center justify-between gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 dark:text-white">Secondary / Metallic Slate</label>
                            <p class="text-[11px] text-slate-400">Technical spec labels, secondary buttons, subtle borders, subheadings.</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <input type="color" wire:model.live="theme.theme_secondary_color" class="w-8 h-8 rounded-lg border-0 cursor-pointer bg-transparent" />
                            <input type="text" wire:model.live="theme.theme_secondary_color" class="w-24 px-2.5 py-1 text-xs font-mono rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 uppercase" />
                        </div>
                    </div>

                    <!-- Accent -->
                    <div class="flex items-center justify-between gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 dark:text-white">Accent Highlight Color</label>
                            <p class="text-[11px] text-slate-400">High-visibility callouts, glowing neon badges, stat tickers, key links.</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <input type="color" wire:model.live="theme.theme_accent_color" class="w-8 h-8 rounded-lg border-0 cursor-pointer bg-transparent" />
                            <input type="text" wire:model.live="theme.theme_accent_color" class="w-24 px-2.5 py-1 text-xs font-mono rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 uppercase" />
                        </div>
                    </div>

                    <!-- Light Surface -->
                    <div class="flex items-center justify-between gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 dark:text-white">Light Mode Surface Background</label>
                            <p class="text-[11px] text-slate-400">Default canvas tone for clean white / light gray backgrounds.</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <input type="color" wire:model.live="theme.theme_surface_light" class="w-8 h-8 rounded-lg border-0 cursor-pointer bg-transparent" />
                            <input type="text" wire:model.live="theme.theme_surface_light" class="w-24 px-2.5 py-1 text-xs font-mono rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 uppercase" />
                        </div>
                    </div>

                    <!-- Dark Surface -->
                    <div class="flex items-center justify-between gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 dark:text-white">Dark Mode Surface Navy</label>
                            <p class="text-[11px] text-slate-400">Deep corporate ocean tone used for dark cards & hero sections.</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <input type="color" wire:model.live="theme.theme_surface_dark" class="w-8 h-8 rounded-lg border-0 cursor-pointer bg-transparent" />
                            <input type="text" wire:model.live="theme.theme_surface_dark" class="w-24 px-2.5 py-1 text-xs font-mono rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 uppercase" />
                        </div>
                    </div>

                    <!-- Border Color -->
                    <div class="flex items-center justify-between gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 dark:text-white">Card & Divider Border Color</label>
                            <p class="text-[11px] text-slate-400">Subtle container outlines, table borders, and divider lines.</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <input type="color" wire:model.live="theme.theme_border_color" class="w-8 h-8 rounded-lg border-0 cursor-pointer bg-transparent" />
                            <input type="text" wire:model.live="theme.theme_border_color" class="w-24 px-2.5 py-1 text-xs font-mono rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 uppercase" />
                        </div>
                    </div>
                </div>
            @endif

            <!-- TAB 2: TYPOGRAPHY -->
            @if($activeTab === 'typography')
                <div class="p-5 sm:p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2">Font Families & Weights</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Heading Font Family</label>
                            <select wire:model.live="theme.theme_heading_font" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="Plus Jakarta Sans">Plus Jakarta Sans (Nordic Geometric)</option>
                                <option value="Inter">Inter (Ultra Precision Technical)</option>
                                <option value="Outfit">Outfit (Modern Bold Industrial)</option>
                                <option value="Montserrat">Montserrat (Prestige Corporate)</option>
                                <option value="Space Grotesk">Space Grotesk (High-Tech Architectural)</option>
                                <option value="Syne">Syne (Heavy Impact Editorial)</option>
                                <option value="Roboto">Roboto (Clean Universal)</option>
                                <option value="DM Sans">DM Sans (Humanist Corporate)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Body Text Font Family</label>
                            <select wire:model.live="theme.theme_body_font" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="Plus Jakarta Sans">Plus Jakarta Sans</option>
                                <option value="Inter">Inter (Best for dense data & tables)</option>
                                <option value="Outfit">Outfit</option>
                                <option value="Roboto">Roboto</option>
                                <option value="DM Sans">DM Sans</option>
                                <option value="system-ui">System Default (Native UI)</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Headline Font Weight</label>
                            <select wire:model.live="theme.theme_heading_weight" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="600">SemiBold (600)</option>
                                <option value="700">Bold (700)</option>
                                <option value="800">Extra Bold (800 - Standard)</option>
                                <option value="900">Black / Industrial (900)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Letter Spacing (Tracking)</label>
                            <select wire:model.live="theme.theme_letter_spacing" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="-0.03em">Tight (-0.03em)</option>
                                <option value="-0.015em">Normal Tight (-0.015em)</option>
                                <option value="0em">Standard (0em)</option>
                                <option value="0.05em">Wide Lettering (0.05em)</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Base Body Font Size</label>
                            <select wire:model.live="theme.theme_base_font_size" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="14px">Compact (14px)</option>
                                <option value="15px">Refined (15px)</option>
                                <option value="16px">Standard Web (16px - Recommended)</option>
                                <option value="18px">Generous Readability (18px)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Body Line Height (Leading)</label>
                            <select wire:model.live="theme.theme_line_height" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="1.4">Tight Editorial (1.4)</option>
                                <option value="1.6">Balanced Modern (1.6 - Standard)</option>
                                <option value="1.75">Relaxed Reading (1.75)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Live Font Specimen Box -->
                    <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 space-y-2 mt-3">
                        <div class="flex items-center justify-between text-[10px] text-slate-400 font-mono">
                            <span>Specimen: <strong class="text-slate-700 dark:text-slate-200">{{ $theme['theme_heading_font'] }}</strong></span>
                            <span>Weight: {{ $theme['theme_heading_weight'] }}</span>
                        </div>
                        <div class="text-2xl sm:text-3xl text-slate-900 dark:text-white transition-all"
                             style="font-family: '{{ $theme['theme_heading_font'] }}', sans-serif; font-weight: {{ $theme['theme_heading_weight'] }}; letter-spacing: {{ $theme['theme_letter_spacing'] }};">
                            NORDROY PRECISION
                        </div>
                        <div class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed transition-all"
                             style="font-family: '{{ $theme['theme_body_font'] }}', sans-serif; font-size: {{ $theme['theme_base_font_size'] ?? '16px' }}; line-height: {{ $theme['theme_line_height'] ?? '1.6' }};">
                            ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz 0123456789
                        </div>
                    </div>
                </div>
            @endif

            <!-- TAB 3: BUTTONS -->
            @if($activeTab === 'buttons')
                <div class="p-5 sm:p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2">Button Geometry & Fill Styles</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Corner Border Radius</label>
                            <select wire:model.live="theme.theme_button_radius" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="0px">Sharp Industrial (0px)</option>
                                <option value="4px">Subtle Soft (4px)</option>
                                <option value="8px">Balanced Modern (8px)</option>
                                <option value="12px">Corporate Rounded (12px - Standard)</option>
                                <option value="16px">Generous Round (16px)</option>
                                <option value="9999px">Full Pill (Rounded 9999px)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Button Fill Style</label>
                            <select wire:model.live="theme.theme_button_style" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="solid">Flat Solid Brand Color</option>
                                <option value="gradient">Subtle Metallic Gradient</option>
                                <option value="outline_bold">High-Contrast Outline</option>
                                <option value="soft_tint">Soft Tinted Fill</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Button Hover Animation</label>
                            <select wire:model.live="theme.theme_button_hover" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="lift">Lift & Elevation Shadow (-2px)</option>
                                <option value="glow">Neon Color Glow</option>
                                <option value="scale">Slight Micro-Scale (1.03x)</option>
                                <option value="none">Flat Color Shift Only</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <!-- TAB 4: CARDS & SURFACES -->
            @if($activeTab === 'cards')
                <div class="p-5 sm:p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2">Card & Container Presentation</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Card Shadow Elevation</label>
                            <select wire:model.live="theme.theme_card_shadow" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="none">Flat Border Only (0px Shadow)</option>
                                <option value="shadow-sm">Subtle Soft Elevation (shadow-sm)</option>
                                <option value="shadow-md">Medium Elevation (shadow-md)</option>
                                <option value="shadow-lg">Elevated Industrial (shadow-lg)</option>
                                <option value="glow">Ambient Color Glow</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Card Border Treatment</label>
                            <select wire:model.live="theme.theme_card_border" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="subtle">Subtle 1px Border (All Sides)</option>
                                <option value="accent_top">Primary Color Accent Bar on Top</option>
                                <option value="none">Borderless Clean</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Card Corner Radius</label>
                            <select wire:model.live="theme.theme_card_radius" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="0px">Sharp (0px)</option>
                                <option value="8px">Compact (8px)</option>
                                <option value="12px">Modern (12px)</option>
                                <option value="16px">Generous (16px - Standard)</option>
                                <option value="24px">Extra Rounded (24px)</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <!-- TAB 5: HEADER & NAVIGATION -->
            @if($activeTab === 'header')
                <div class="p-5 sm:p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2">Public Header Navbar Style</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Header Navbar Style</label>
                            <select wire:model.live="theme.theme_header_style" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="glass">Glassmorphism (Frosted Blur Backdrop)</option>
                                <option value="solid">Solid Crisp Background</option>
                                <option value="transparent">Transparent Floating (Over Hero Banner)</option>
                                <option value="floating">Floating Island Navbar (Pill Container)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Navbar Height</label>
                            <select wire:model.live="theme.theme_header_height" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="64px">Compact (64px)</option>
                                <option value="80px">Standard Corporate (80px - Recommended)</option>
                                <option value="96px">Grand Architectural (96px)</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <!-- TAB 6: LAYOUT & SPACING -->
            @if($activeTab === 'layout')
                <div class="p-5 sm:p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2">Global Container & Section Spacing</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Maximum Container Width</label>
                            <select wire:model.live="theme.theme_container_width" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="1280px">Boxed Standard (1280px - 7xl)</option>
                                <option value="1440px">Corporate Wide (1440px)</option>
                                <option value="1536px">Ultra Wide (1536px - 2xl Recommended)</option>
                                <option value="1680px">Studio Cinematic (1680px)</option>
                                <option value="100%">100% Fluid Full Width</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Section Vertical Padding (py)</label>
                            <select wire:model.live="theme.theme_section_padding" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#013d5a]">
                                <option value="64px">Compact (64px - py-16)</option>
                                <option value="80px">Balanced (80px - py-20)</option>
                                <option value="96px">Generous Premium (96px - py-24 Recommended)</option>
                                <option value="128px">Spacious Grand (128px - py-32)</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <!-- RIGHT COLUMN: Live Interactive Component Preview (5 cols) -->
        <div class="lg:col-span-5 lg:sticky lg:top-28 space-y-4">
            
            <div class="p-5 sm:p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-md">
                
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3 mb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Live Component Canvas</span>
                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold text-emerald-600 bg-emerald-500/10">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Live
                        </span>
                    </div>

                    <!-- Canvas Dark Mode Toggle -->
                    <button type="button" @click="canvasDark = !canvasDark"
                            class="px-2.5 py-1 text-[11px] font-semibold rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:border-slate-300 transition-colors flex items-center gap-1.5 cursor-pointer">
                        <span x-text="canvasDark ? '🌙 Dark Mode' : '☀️ Light Mode'"></span>
                    </button>
                </div>

                <!-- Mockup Preview Card Container -->
                <div class="p-5 rounded-2xl border space-y-4 transition-all duration-300"
                     :class="canvasDark ? 'dark-canvas' : 'light-canvas'"
                     :style="canvasDark 
                        ? 'background-color: {{ $theme['theme_surface_dark'] ?? '#0a1926' }}; border-color: {{ $theme['theme_border_color'] ?? '#1e293b' }}; color: #ffffff;' 
                        : 'background-color: {{ $theme['theme_surface_light'] ?? '#ffffff' }}; border-color: {{ $theme['theme_border_color'] ?? '#e2e8f0' }}; color: #0f172a;'">
                    
                    <!-- Mockup Header Navbar -->
                    <div class="px-3.5 py-2.5 border flex items-center justify-between text-xs transition-all"
                         style="
                             border-radius: {{ $theme['theme_button_radius'] ?? '12px' }};
                             background-color: {{ ($theme['theme_header_style'] ?? 'glass') === 'glass' ? 'rgba(255,255,255,0.1)' : (($theme['theme_header_style'] ?? 'glass') === 'solid' ? ($theme['theme_primary_color'] ?? '#013d5a') : 'transparent') }};
                             border-color: {{ $theme['theme_border_color'] ?? '#e2e8f0' }};
                         ">
                        <span class="font-extrabold uppercase tracking-wider text-[11px]" 
                              style="font-family: '{{ $theme['theme_heading_font'] }}', sans-serif; color: {{ ($theme['theme_header_style'] ?? 'glass') === 'solid' ? '#ffffff' : ($theme['theme_primary_color'] ?? '#013d5a') }}">
                            NORDROY GLOBAL
                        </span>
                        <div class="flex items-center gap-3 text-[10px] opacity-80" style="font-family: '{{ $theme['theme_body_font'] }}', sans-serif;">
                            <span>Services</span>
                            <span>Products</span>
                            <span>Contact</span>
                        </div>
                    </div>

                    <!-- Category Badge -->
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 text-[10px] font-bold tracking-wider uppercase border transition-all"
                              style="
                                  border-radius: {{ $theme['theme_button_radius'] ?? '12px' }};
                                  color: {{ $theme['theme_primary_color'] ?? '#013d5a' }};
                                  background-color: {{ $theme['theme_primary_color'] ?? '#013d5a' }}15;
                                  border-color: {{ $theme['theme_primary_color'] ?? '#013d5a' }}35;
                              ">
                            Marine Engineering
                        </span>

                        <span class="inline-flex items-center px-2 py-0.5 text-[9px] font-mono rounded-md bg-slate-100 dark:bg-slate-800 text-slate-500">
                            Font: {{ $theme['theme_heading_font'] }}
                        </span>
                    </div>

                    <!-- Preview Headings with EXACT Font Styling -->
                    <div class="space-y-1.5">
                        <h4 class="text-xl sm:text-2xl leading-tight transition-all"
                            style="
                                font-family: '{{ $theme['theme_heading_font'] }}', sans-serif;
                                font-weight: {{ $theme['theme_heading_weight'] ?? '800' }};
                                letter-spacing: {{ $theme['theme_letter_spacing'] ?? '-0.02em' }};
                                color: {{ $theme['theme_primary_color'] ?? '#013d5a' }};
                            ">
                            High-Precision Turbocharger Solutions
                        </h4>
                        <p class="text-xs opacity-75 leading-relaxed transition-all"
                           style="
                               font-family: '{{ $theme['theme_body_font'] }}', sans-serif;
                               font-size: {{ $theme['theme_base_font_size'] ?? '16px' }};
                               line-height: {{ $theme['theme_line_height'] ?? '1.6' }};
                           ">
                            Certified overhauls, dynamic rotor balancing, and genuine spare parts supplied worldwide by authorized marine specialists.
                        </p>
                    </div>

                    <!-- Live Typography Specimen Strip (Guarantees visible font shape differences) -->
                    <div class="p-3 rounded-xl border border-dashed border-slate-200 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-900/60 text-xs">
                        <div class="flex items-center justify-between text-[9px] uppercase tracking-wider text-slate-400 font-mono mb-1">
                            <span>Specimen Shape Test</span>
                            <span>{{ $theme['theme_heading_weight'] }} Weight</span>
                        </div>
                        <div class="text-base tracking-normal text-slate-800 dark:text-slate-100 font-semibold"
                             style="font-family: '{{ $theme['theme_heading_font'] }}', sans-serif;">
                            Aa Bb Gg Rr Qq 1234567890 &amp;
                        </div>
                    </div>

                    <!-- Preview Interactive Buttons -->
                    <div class="flex flex-wrap items-center gap-2 pt-1">
                        <!-- Primary Button -->
                        <button type="button"
                                class="px-4 py-2 text-xs font-bold text-white shadow-sm transition-all hover:opacity-90 active:scale-95"
                                style="
                                    font-family: '{{ $theme['theme_body_font'] }}', sans-serif;
                                    background: {{ ($theme['theme_button_style'] ?? 'solid') === 'gradient' 
                                        ? 'linear-gradient(135deg, ' . ($theme['theme_primary_color'] ?? '#013d5a') . ', ' . ($theme['theme_accent_color'] ?? '#0ea5e9') . ')' 
                                        : (($theme['theme_button_style'] ?? 'solid') === 'soft_tint' ? ($theme['theme_primary_color'] ?? '#013d5a') . '25' : ($theme['theme_primary_color'] ?? '#013d5a')) }};
                                    color: {{ ($theme['theme_button_style'] ?? 'solid') === 'soft_tint' ? ($theme['theme_primary_color'] ?? '#013d5a') : '#ffffff' }};
                                    border-radius: {{ $theme['theme_button_radius'] ?? '12px' }};
                                ">
                            Primary Action
                        </button>

                        <!-- Accent Button -->
                        <button type="button"
                                class="px-4 py-2 text-xs font-bold text-white shadow-sm transition-all hover:opacity-90 active:scale-95"
                                style="
                                    font-family: '{{ $theme['theme_body_font'] }}', sans-serif;
                                    background-color: {{ $theme['theme_accent_color'] ?? '#0ea5e9' }};
                                    border-radius: {{ $theme['theme_button_radius'] ?? '12px' }};
                                ">
                            Accent CTA
                        </button>

                        <!-- Outline Button -->
                        <button type="button"
                                class="px-4 py-2 text-xs font-bold border transition-all hover:bg-slate-100/30 active:scale-95"
                                style="
                                    font-family: '{{ $theme['theme_body_font'] }}', sans-serif;
                                    border-radius: {{ $theme['theme_button_radius'] ?? '12px' }};
                                    border-color: {{ $theme['theme_secondary_color'] ?? '#6f7478' }};
                                    color: {{ $theme['theme_secondary_color'] ?? '#6f7478' }};
                                ">
                            Outline Spec
                        </button>
                    </div>

                    <!-- Sample Card Surface Feature -->
                    <div class="p-3.5 border transition-all mt-2"
                         style="
                             border-radius: {{ $theme['theme_card_radius'] ?? '16px' }};
                             border-color: {{ $theme['theme_border_color'] ?? '#e2e8f0' }};
                             border-top: {{ ($theme['theme_card_border'] ?? 'subtle') === 'accent_top' ? '3px solid ' . ($theme['theme_primary_color'] ?? '#013d5a') : '' }};
                             box-shadow: {{ ($theme['theme_card_shadow'] ?? 'shadow-sm') === 'none' ? 'none' : (($theme['theme_card_shadow'] ?? 'shadow-sm') === 'shadow-lg' ? '0 10px 15px -3px rgba(0, 0, 0, 0.1)' : (($theme['theme_card_shadow'] ?? 'shadow-sm') === 'glow' ? '0 0 15px ' . ($theme['theme_primary_color'] ?? '#013d5a') . '30' : '0 1px 3px rgba(0,0,0,0.08)')) }};
                         ">
                        <div class="flex items-center justify-between text-xs font-bold" style="font-family: '{{ $theme['theme_heading_font'] }}', sans-serif;">
                            <span>Engineering Overhaul 24/7</span>
                            <span style="color: {{ $theme['theme_accent_color'] ?? '#0ea5e9' }}">ISO 9001</span>
                        </div>
                        <p class="text-[11px] opacity-70 mt-1" style="font-family: '{{ $theme['theme_body_font'] }}', sans-serif;">
                            Card Surface with custom shadow elevation & border treatment.
                        </p>
                    </div>

                    <!-- Token Active Values Strip -->
                    <div class="pt-3 border-t border-slate-200/80 dark:border-slate-800/80 grid grid-cols-2 sm:grid-cols-3 gap-2 text-[10px] font-mono text-slate-500">
                        <div>Radius: <strong class="text-slate-800 dark:text-slate-200">{{ $theme['theme_button_radius'] }}</strong></div>
                        <div>Max-W: <strong class="text-slate-800 dark:text-slate-200">{{ $theme['theme_container_width'] }}</strong></div>
                        <div>Padding: <strong class="text-slate-800 dark:text-slate-200">{{ $theme['theme_section_padding'] }}</strong></div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
