<div>
    <x-slot:header>Theme Studio</x-slot:header>

    <!-- 100% Self-Hosted Local Fonts (Zero CDN Dependency) -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">

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
                class="inline-flex items-center justify-center h-10 px-6 rounded-xl font-bold text-xs uppercase tracking-wider bg-[#003C58] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 shadow-sm active:scale-95 transition-all cursor-pointer disabled:opacity-60 disabled:cursor-wait shrink-0 self-start sm:self-auto">
            
            <span wire:loading.remove wire:target="saveThemeTokens" class="inline-flex items-center gap-2 whitespace-nowrap">
                <x-icon name="solid:floppy-disk" class="w-3.5 h-3.5" />
                <span>Publish Theme Tokens</span>
            </span>

            <span wire:loading.inline-flex wire:target="saveThemeTokens" class="items-center justify-center gap-2 whitespace-nowrap" style="display: none;">
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
                            class="p-2.5 rounded-xl border text-left transition-all cursor-pointer group bg-slate-50/50 dark:bg-slate-950/40 relative {{ ($theme['theme_primary_color'] ?? '') === $preset['primary'] ? 'border-[#003C58] dark:border-cyan-400 ring-2 ring-[#003C58]/20 dark:ring-cyan-400/20' : 'border-slate-200 dark:border-slate-800 hover:border-[#003C58] dark:hover:border-cyan-400' }}">
                            
                            <div class="flex items-center gap-1.5 mb-2">
                                <span class="w-3.5 h-3.5 rounded-full border border-slate-300 dark:border-slate-700 shadow-xs shrink-0" style="background-color: {{ $preset['primary'] }}"></span>
                                <span class="w-3.5 h-3.5 rounded-full border border-slate-300 dark:border-slate-700 shadow-xs shrink-0" style="background-color: {{ $preset['secondary'] }}"></span>
                                <span class="w-3.5 h-3.5 rounded-full border border-slate-300 dark:border-slate-700 shadow-xs shrink-0" style="background-color: {{ $preset['accent'] }}"></span>
                            </div>
                            <p class="text-[11px] font-bold text-slate-800 dark:text-white truncate group-hover:text-[#003C58] dark:group-hover:text-cyan-400">{{ $preset['name'] }}</p>
                            <span class="text-[9px] text-slate-400 block truncate mt-0.5">{{ $preset['font_head'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Granular Studio Tabs -->
            <div class="flex items-center gap-1 overflow-x-auto no-scrollbar p-1 rounded-xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-2xs">
                <button wire:click="setTab('colors')"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0 {{ $activeTab === 'colors' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Colors
                </button>
                <button wire:click="setTab('typography')"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0 {{ $activeTab === 'typography' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Fonts &amp; Text
                </button>
                <button wire:click="setTab('buttons')"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0 {{ $activeTab === 'buttons' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Buttons
                </button>
                <button wire:click="setTab('cards')"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0 {{ $activeTab === 'cards' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Cards
                </button>
                <button wire:click="setTab('header')"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0 {{ $activeTab === 'header' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Header Nav
                </button>
                <button wire:click="setTab('layout')"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0 {{ $activeTab === 'layout' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Page Layout
                </button>
                <button wire:click="setTab('background')"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer shrink-0 {{ $activeTab === 'background' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    <span class="inline-flex items-center gap-1.5">
                        <x-icon name="solid:video" class="w-3.5 h-3.5" />
                        <span>Background Video</span>
                    </span>
                </button>
            </div>

            <!-- TAB 1: COLORS -->
            @if($activeTab === 'colors')
                <div class="p-5 sm:p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2">Brand Colors &amp; Appearance</h3>

                    <!-- Primary -->
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 dark:text-white">Primary Brand Color (Main Color)</label>
                            <p class="text-[11px] text-slate-400">Used for main buttons, header, active menu links, and important highlights.</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <input type="color" wire:model.live="theme.theme_primary_color" class="w-8 h-8 rounded-lg border-0 cursor-pointer bg-transparent" />
                            <input type="text" wire:model.live="theme.theme_primary_color" class="w-24 px-2.5 py-1 text-xs font-mono rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 uppercase" />
                        </div>
                    </div>

                    <!-- Secondary -->
                    <div class="flex items-center justify-between gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 dark:text-white">Secondary Slate Color</label>
                            <p class="text-[11px] text-slate-400">Used for technical labels, subtle borders, and secondary buttons.</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <input type="color" wire:model.live="theme.theme_secondary_color" class="w-8 h-8 rounded-lg border-0 cursor-pointer bg-transparent" />
                            <input type="text" wire:model.live="theme.theme_secondary_color" class="w-24 px-2.5 py-1 text-xs font-mono rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 uppercase" />
                        </div>
                    </div>

                    <!-- Accent -->
                    <div class="flex items-center justify-between gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 dark:text-white">Accent Highlight Color (Badges &amp; CTA)</label>
                            <p class="text-[11px] text-slate-400">Used for badges, status indicators, glowing dots, and special action buttons.</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <input type="color" wire:model.live="theme.theme_accent_color" class="w-8 h-8 rounded-lg border-0 cursor-pointer bg-transparent" />
                            <input type="text" wire:model.live="theme.theme_accent_color" class="w-24 px-2.5 py-1 text-xs font-mono rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 uppercase" />
                        </div>
                    </div>

                    <!-- Light Surface -->
                    <div class="flex items-center justify-between gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 dark:text-white">Page Background (Light Mode)</label>
                            <p class="text-[11px] text-slate-400">The clean background tone for daylight mode.</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <input type="color" wire:model.live="theme.theme_surface_light" class="w-8 h-8 rounded-lg border-0 cursor-pointer bg-transparent" />
                            <input type="text" wire:model.live="theme.theme_surface_light" class="w-24 px-2.5 py-1 text-xs font-mono rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 uppercase" />
                        </div>
                    </div>

                    <!-- Dark Surface -->
                    <div class="flex items-center justify-between gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 dark:text-white">Page Background (Dark Mode)</label>
                            <p class="text-[11px] text-slate-400">Deep corporate ocean tone used for dark cards &amp; night mode.</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <input type="color" wire:model.live="theme.theme_surface_dark" class="w-8 h-8 rounded-lg border-0 cursor-pointer bg-transparent" />
                            <input type="text" wire:model.live="theme.theme_surface_dark" class="w-24 px-2.5 py-1 text-xs font-mono rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 uppercase" />
                        </div>
                    </div>

                    <!-- Border Color -->
                    <div class="flex items-center justify-between gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 dark:text-white">Borders &amp; Separator Lines</label>
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
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2">Website Fonts &amp; Typography</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Heading Font Family (Titles)</label>
                            <select wire:model.live="theme.theme_heading_font" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="Plus Jakarta Sans">Plus Jakarta Sans (Nordic Modern - Recommended)</option>
                                <option value="Inter">Inter (Ultra Precision Clean)</option>
                                <option value="Outfit">Outfit (Bold Industrial)</option>
                                <option value="Montserrat">Montserrat (Corporate Prestige - Dana Group style)</option>
                                <option value="Space Grotesk">Space Grotesk (High-Tech Architectural)</option>
                                <option value="Syne">Syne (Heavy Impact Editorial)</option>
                                <option value="DM Sans">DM Sans (Humanist Corporate)</option>
                                <option value="Manrope">Manrope (Clean Minimalist)</option>
                                <option value="Poppins">Poppins (Geometric Display)</option>
                                <option value="Roboto">Roboto (Classic Standard)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Body Text Font Family (Paragraphs)</label>
                            <select wire:model.live="theme.theme_body_font" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="Plus Jakarta Sans">Plus Jakarta Sans (Recommended)</option>
                                <option value="Inter">Inter (Great for data &amp; tables)</option>
                                <option value="Outfit">Outfit</option>
                                <option value="DM Sans">DM Sans</option>
                                <option value="Manrope">Manrope</option>
                                <option value="Poppins">Poppins</option>
                                <option value="Roboto">Roboto</option>
                                <option value="system-ui">System Default (Native UI)</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Heading Thickness (Boldness)</label>
                            <select wire:model.live="theme.theme_heading_weight" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="600">Semi-Bold (600)</option>
                                <option value="700">Bold (700)</option>
                                <option value="800">Extra Bold (800 - Standard)</option>
                                <option value="900">Black / Heavy Industrial (900)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Letter Spacing (Tracking)</label>
                            <select wire:model.live="theme.theme_letter_spacing" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="-0.03em">Tight (-0.03em)</option>
                                <option value="-0.015em">Normal Tight (-0.015em)</option>
                                <option value="0em">Standard (0em)</option>
                                <option value="0.05em">Wide Lettering (0.05em)</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Base Body Text Size</label>
                            <select wire:model.live="theme.theme_base_font_size" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="14px">Compact (14px)</option>
                                <option value="15px">Refined (15px)</option>
                                <option value="16px">Standard Web (16px - Recommended)</option>
                                <option value="18px">Large &amp; Easy to Read (18px)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Line Height (Spacing between lines)</label>
                            <select wire:model.live="theme.theme_line_height" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="1.4">Tight (1.4)</option>
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
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2">Button Shapes &amp; Styles</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Button Corner Shape</label>
                            <select wire:model.live="theme.theme_button_radius" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="0px">Sharp Corners (0px)</option>
                                <option value="4px">Slightly Rounded (4px)</option>
                                <option value="8px">Balanced Modern (8px)</option>
                                <option value="12px">Corporate Rounded (12px - Recommended)</option>
                                <option value="16px">Extra Rounded (16px)</option>
                                <option value="9999px">Full Pill (Pill Shaped)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Button Fill Style</label>
                            <select wire:model.live="theme.theme_button_style" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="solid">Solid Brand Color</option>
                                <option value="gradient">Subtle Gradient Fill</option>
                                <option value="outline_bold">Clean Outline Border</option>
                                <option value="soft_tint">Soft Tinted Fill</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Button Hover Animation</label>
                            <select wire:model.live="theme.theme_button_hover" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="lift">Lift Slightly Up (-2px)</option>
                                <option value="glow">Subtle Brand Glow</option>
                                <option value="scale">Slight Scale (1.03x)</option>
                                <option value="none">Flat Color Change Only</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <!-- TAB 4: CARDS & SURFACES -->
            @if($activeTab === 'cards')
                <div class="p-5 sm:p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2">Content Cards &amp; Elevation</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Card Shadow Elevation</label>
                            <select wire:model.live="theme.theme_card_shadow" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="none">Flat (No Shadow)</option>
                                <option value="shadow-sm">Subtle Soft Shadow (shadow-sm - Recommended)</option>
                                <option value="shadow-md">Medium Elevation (shadow-md)</option>
                                <option value="shadow-lg">Elevated Floating (shadow-lg)</option>
                                <option value="glow">Subtle Brand Glow</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Card Border Style</label>
                            <select wire:model.live="theme.theme_card_border" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="subtle">Subtle Line on All Sides (Recommended)</option>
                                <option value="accent_top">Brand Color Accent Bar on Top</option>
                                <option value="none">Clean Borderless</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Card Corner Roundness</label>
                            <select wire:model.live="theme.theme_card_radius" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
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
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2">Top Navigation Bar Style</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Header Navbar Appearance</label>
                            <select wire:model.live="theme.theme_header_style" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="glass">Glass Frosted (Blurred semi-transparent - Recommended)</option>
                                <option value="solid">Solid Crisp Background</option>
                                <option value="transparent">Fully Transparent (Floats directly over hero)</option>
                                <option value="floating">Floating Island Navbar (Pill Container)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Navbar Height</label>
                            <select wire:model.live="theme.theme_header_height" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="64px">Compact (64px)</option>
                                <option value="80px">Standard Corporate (80px - Recommended)</option>
                                <option value="96px">Spacious Grand (96px)</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <!-- TAB 6: LAYOUT & SPACING -->
            @if($activeTab === 'layout')
                <div class="p-5 sm:p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2">Page Width &amp; Section Spacing</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Website Content Max Width</label>
                            <select wire:model.live="theme.theme_container_width" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="1280px">Boxed Standard (1280px)</option>
                                <option value="1440px">Corporate Wide (1440px)</option>
                                <option value="1536px">Ultra Wide (1536px - Recommended)</option>
                                <option value="1680px">Studio Panoramic (1680px)</option>
                                <option value="100%">100% Fluid Full Width</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Space Between Page Sections</label>
                            <select wire:model.live="theme.theme_section_padding" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                                <option value="64px">Compact (64px)</option>
                                <option value="80px">Balanced (80px)</option>
                                <option value="96px">Generous Premium (96px - Recommended)</option>
                                <option value="128px">Spacious Grand (128px)</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <!-- TAB 7: BACKGROUND VIDEO SETTINGS -->
            @if($activeTab === 'background')
                <div class="p-5 sm:p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-6">
                    <div>
                        <h3 class="text-sm font-bold text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2 flex items-center justify-between">
                            <span>Full-Site Background Video</span>
                            <span class="text-[10px] font-semibold text-cyan-600 dark:text-cyan-400 bg-cyan-500/10 px-2.5 py-0.5 rounded-full">Turbo Internacional Style</span>
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                            Plays a high-definition marine video in the background while your website pages scroll smoothly on top of it.
                        </p>
                    </div>

                    <!-- 1. Master On/Off Switch -->
                    <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-200/80 dark:border-slate-800">
                        <div class="space-y-0.5">
                            <span class="block text-xs font-bold text-slate-800 dark:text-white">Play Background Video</span>
                            <span class="block text-[11px] text-slate-400">Turn On or Off the background video across the entire website</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model.live="theme.site_bg_video_enabled" value="1" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#003C58] dark:peer-checked:bg-cyan-500"></div>
                        </label>
                    </div>

                    <!-- 2. Video File / Link Selection -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">Video File or URL Link</label>
                        <div class="flex items-center gap-2">
                            <input type="text" wire:model.live="theme.site_bg_video_url"
                                   placeholder="assets/videos/background-marine.mp4 or https://..."
                                   class="flex-1 px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white font-mono focus:outline-none focus:ring-2 focus:ring-[#003C58]" />
                            <button type="button"
                                    @click="$dispatch('open-media-picker', { targetField: 'site_bg_video_url' })"
                                    class="px-4 py-2.5 text-xs font-bold rounded-xl bg-[#003C58] hover:bg-[#024a6d] text-white dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 shrink-0 transition-colors flex items-center gap-1.5 cursor-pointer shadow-xs">
                                <x-icon name="solid:photo" class="w-3.5 h-3.5" />
                                <span>Choose from Media</span>
                            </button>
                        </div>
                        <p class="text-[11px] text-slate-400">Default: <code class="font-mono text-cyan-600 dark:text-cyan-400">assets/videos/background-marine.mp4</code>. Local video or external video links work automatically.</p>
                    </div>

                    <!-- 3. Video Visibility / Brightness (Opacity Slider) -->
                    <div class="space-y-2.5 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-xs font-bold text-slate-700 dark:text-slate-300">Video Brightness / Visibility</label>
                                <p class="text-[11px] text-slate-400">How clearly the background video is seen through the page</p>
                            </div>
                            <span class="text-xs font-mono font-bold px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 text-[#003C58] dark:text-cyan-400">
                                {{ $theme['site_bg_video_opacity'] ?? 85 }}% ({{ ($theme['site_bg_video_opacity'] ?? 85) >= 80 ? 'Clear & Vibrant' : (($theme['site_bg_video_opacity'] ?? 85) >= 40 ? 'Soft' : 'Subtle') }})
                            </span>
                        </div>
                        <input type="range" min="10" max="100" step="5"
                               wire:model.live="theme.site_bg_video_opacity"
                               class="w-full accent-[#003C58] dark:accent-cyan-400 cursor-pointer" />
                        <div class="flex justify-between text-[10px] text-slate-400 font-mono">
                            <span>10% (Subtle)</span>
                            <span>50% (Medium)</span>
                            <span>85% (Recommended)</span>
                            <span>100% (Full Bright)</span>
                        </div>
                    </div>

                    <!-- 4. Top Hero Banner Look -->
                    <div class="space-y-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">Top Hero Banner Background Look</label>
                        <select wire:model.live="theme.theme_hero_backdrop" class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                            <option value="frosted">Frosted Glass (Recommended - Keeps the spinning turbine &amp; text easy to read)</option>
                            <option value="subtle_tint">Semi-Transparent Tint (Shows more video while keeping text readable)</option>
                            <option value="transparent">Fully Transparent (Video is completely visible directly behind hero text)</option>
                            <option value="solid">Solid Color (Hides the video completely in the top hero area)</option>
                        </select>
                        <p class="text-[11px] text-slate-400">Tip: <strong>Frosted Glass</strong> gives the cleanest look because the turbine instrument dial stays razor-sharp.</p>
                    </div>

                    <!-- 5. Mid-Page Video Panorama Section -->
                    <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-200/80 dark:border-slate-800">
                        <div class="space-y-0.5">
                            <span class="block text-xs font-bold text-slate-800 dark:text-white">Mid-Page Video Panorama Section</span>
                            <span class="block text-[11px] text-slate-400">Shows a 100% clear panoramic window between Services and Company (Turbo Internacional style)</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model.live="theme.theme_video_break_enabled" value="1" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#003C58] dark:peer-checked:bg-cyan-500"></div>
                        </label>
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
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
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
                <div class="p-5 rounded-2xl border transition-all duration-300 relative overflow-hidden"
                     :class="canvasDark ? 'dark-canvas' : 'light-canvas'"
                     :style="canvasDark 
                        ? 'background-color: {{ ($theme['theme_hero_backdrop'] ?? 'frosted') === 'transparent' ? 'transparent' : ($theme['theme_surface_dark'] ?? '#0a1926') }}; border-color: {{ $theme['theme_border_color'] ?? '#1e293b' }}; color: #ffffff;' 
                        : 'background-color: {{ ($theme['theme_hero_backdrop'] ?? 'frosted') === 'transparent' ? 'transparent' : ($theme['theme_surface_light'] ?? '#ffffff') }}; border-color: {{ $theme['theme_border_color'] ?? '#e2e8f0' }}; color: #0f172a;'">
                    
                    @if(!empty($theme['site_bg_video_enabled']))
                        <!-- Simulated Canvas Background Video Underlay -->
                        <div class="absolute inset-0 pointer-events-none -z-0 overflow-hidden"
                             style="opacity: {{ ($theme['site_bg_video_opacity'] ?? 85) / 100 }};">
                            <video autoplay muted loop playsinline class="w-full h-full object-cover">
                                <source src="{{ asset($theme['site_bg_video_url'] ?? 'assets/videos/background-marine.mp4') }}" type="video/mp4">
                            </video>
                            <div class="absolute inset-0 bg-[#003C58]/25 mix-blend-multiply"></div>
                        </div>

                        <!-- Hero Backdrop Glaze Simulation Layer -->
                        @if(($theme['theme_hero_backdrop'] ?? 'frosted') === 'frosted')
                            <div class="absolute inset-0 bg-white/90 dark:bg-[#07131e]/90 backdrop-blur-xs pointer-events-none"></div>
                        @elseif(($theme['theme_hero_backdrop'] ?? 'frosted') === 'subtle_tint')
                            <div class="absolute inset-0 bg-white/70 dark:bg-[#07131e]/70 backdrop-blur-xs pointer-events-none"></div>
                        @elseif(($theme['theme_hero_backdrop'] ?? 'frosted') === 'solid')
                            <div class="absolute inset-0 bg-white dark:bg-[#07131e] pointer-events-none"></div>
                        @endif
                    @endif

                    <div class="relative z-10 space-y-4">
                        <!-- Mockup Header Navbar -->
                        <div class="px-3.5 py-2.5 border flex items-center justify-between text-xs transition-all"
                             style="
                                 border-radius: {{ $theme['theme_button_radius'] ?? '12px' }};
                                 background-color: {{ ($theme['theme_header_style'] ?? 'glass') === 'glass' ? 'rgba(255,255,255,0.1)' : (($theme['theme_header_style'] ?? 'glass') === 'solid' ? ($theme['theme_primary_color'] ?? '#003C58') : 'transparent') }};
                                 border-color: {{ $theme['theme_border_color'] ?? '#e2e8f0' }};
                             ">
                            <span class="font-extrabold uppercase tracking-wider text-[11px]" 
                                  style="font-family: '{{ $theme['theme_heading_font'] }}', sans-serif; color: {{ ($theme['theme_header_style'] ?? 'glass') === 'solid' ? '#ffffff' : ($theme['theme_primary_color'] ?? '#003C58') }}">
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
                                  color: {{ $theme['theme_primary_color'] ?? '#003C58' }};
                                  background-color: {{ $theme['theme_primary_color'] ?? '#003C58' }}15;
                                  border-color: {{ $theme['theme_primary_color'] ?? '#003C58' }}35;
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
                                color: {{ $theme['theme_primary_color'] ?? '#003C58' }};
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
                                        ? 'linear-gradient(135deg, ' . ($theme['theme_primary_color'] ?? '#003C58') . ', ' . ($theme['theme_accent_color'] ?? '#0ea5e9') . ')' 
                                        : (($theme['theme_button_style'] ?? 'solid') === 'soft_tint' ? ($theme['theme_primary_color'] ?? '#003C58') . '25' : ($theme['theme_primary_color'] ?? '#003C58')) }};
                                    color: {{ ($theme['theme_button_style'] ?? 'solid') === 'soft_tint' ? ($theme['theme_primary_color'] ?? '#003C58') : '#ffffff' }};
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
                                    border-color: {{ $theme['theme_secondary_color'] ?? '#75767A' }};
                                    color: {{ $theme['theme_secondary_color'] ?? '#75767A' }};
                                ">
                            Outline Spec
                        </button>
                    </div>

                    <!-- Sample Card Surface Feature -->
                    <div class="p-3.5 border transition-all mt-2"
                         style="
                             border-radius: {{ $theme['theme_card_radius'] ?? '16px' }};
                             border-color: {{ $theme['theme_border_color'] ?? '#e2e8f0' }};
                             border-top: {{ ($theme['theme_card_border'] ?? 'subtle') === 'accent_top' ? '3px solid ' . ($theme['theme_primary_color'] ?? '#003C58') : '' }};
                             box-shadow: {{ ($theme['theme_card_shadow'] ?? 'shadow-sm') === 'none' ? 'none' : (($theme['theme_card_shadow'] ?? 'shadow-sm') === 'shadow-lg' ? '0 10px 15px -3px rgba(0, 0, 0, 0.1)' : (($theme['theme_card_shadow'] ?? 'shadow-sm') === 'glow' ? '0 0 15px ' . ($theme['theme_primary_color'] ?? '#003C58') . '30' : '0 1px 3px rgba(0,0,0,0.08)')) }};
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
                    <div class="pt-3 border-t border-slate-200/80 dark:border-slate-800/80 grid grid-cols-2 sm:grid-cols-4 gap-2 text-[10px] font-mono text-slate-500">
                        <div>Radius: <strong class="text-slate-800 dark:text-slate-200">{{ $theme['theme_button_radius'] }}</strong></div>
                        <div>Max-W: <strong class="text-slate-800 dark:text-slate-200">{{ $theme['theme_container_width'] }}</strong></div>
                        <div>Video: <strong class="text-slate-800 dark:text-slate-200">{{ !empty($theme['site_bg_video_enabled']) ? ($theme['site_bg_video_opacity'] ?? 85).'%' : 'Off' }}</strong></div>
                        <div>Glaze: <strong class="text-slate-800 dark:text-slate-200">{{ ucfirst($theme['theme_hero_backdrop'] ?? 'frosted') }}</strong></div>
                    </div>

                    </div> <!-- End .relative.z-10.space-y-4 -->

                </div>

            </div>

        </div>

    </div>

    <!-- Media Picker Modal Integration for Video & Background Assets -->
    <x-media-picker-modal />
</div>
