<x-layouts.frontend>
    
    <!-- =====================================================================
         SECTION 1: HIGH-IMPACT INDUSTRIAL HERO BANNER (Turbo Internacional Style)
         Soft executive frosted backdrop so the precision turbine tachometer instrument dial rests with razor-sharp stability!
         ===================================================================== -->
    @php
        $heroBackdrop = \App\Models\Setting::get('theme_hero_backdrop', 'frosted');
        $heroBackdropClass = match($heroBackdrop) {
            'transparent' => 'bg-transparent backdrop-blur-none',
            'subtle_tint' => 'bg-white/70 dark:bg-[#07131e]/70 backdrop-blur-xs',
            'solid'       => 'bg-white dark:bg-[#07131e]',
            default       => 'bg-white/92 dark:bg-[#07131e]/90 backdrop-blur-xs',
        };
    @endphp
    <section class="relative overflow-hidden {{ $heroBackdropClass }} text-slate-900 dark:text-white py-16 sm:py-24 lg:py-28 border-b border-slate-200/90 dark:border-slate-800 transition-colors duration-200">
        
        <!-- Subtle Industrial Geometric Grid Background -->
        <div class="absolute inset-0 opacity-[0.025] dark:opacity-[0.04] pointer-events-none bg-[radial-gradient(#003C58_1px,transparent_1px)] dark:bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px]"></div>

        <div class="max-w-[1536px] mx-auto px-4 sm:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-10 items-center">
                
                <!-- Left Column: Copy & Actions (7 cols) -->
                <div class="lg:col-span-7 space-y-6 sm:space-y-8 p-6 sm:p-8 lg:p-0 rounded-3xl bg-white/85 dark:bg-[#07131e]/75 lg:bg-transparent lg:dark:bg-transparent backdrop-blur-xs lg:backdrop-blur-none border border-white/60 dark:border-slate-800/60 lg:border-none">
                    
                    <!-- Clean Corporate Badges (NO generic pulsing dots) -->
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="inline-flex items-center px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-slate-100 dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 border border-slate-200 dark:border-slate-800 shadow-2xs">
                            Authorized Multi-Brand Turbocharger Engineering
                        </span>
                        <span class="inline-flex items-center px-3.5 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-white dark:bg-[#0a1926] text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                            ISO 9001:2015 &bull; DNV Certified
                        </span>
                    </div>

                    <!-- Main Headline (Bespoke Human Typography, No AI Text Gradients) -->
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.12] tracking-tight font-heading text-slate-900 dark:text-white drop-shadow-xs">
                        Precision <span class="text-[#003C58] dark:text-cyan-400">Turbocharger Overhauls</span> &amp; Marine Propulsion Support.
                    </h1>

                    <!-- Technical Subtitle -->
                    <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl font-body font-medium">
                        Specialized multi-brand maintenance, dynamic rotor balancing up to 100,000 RPM, and global OEM spare parts logistics for oceangoing commercial vessels, industrial captive power plants, and oil &amp; gas terminals.
                    </p>

                    <!-- Dual Call-to-Action Buttons -->
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="{{ route('services') }}" 
                           class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider text-white shadow-lg active:scale-95 transition-all"
                           style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); border-radius: var(--button-radius);">
                            <span>Explore Overhaul Services</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>

                        <a href="{{ route('contact') }}#rfq" 
                           class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider text-slate-700 dark:text-slate-200 border border-slate-300 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 hover:bg-slate-100 dark:hover:bg-slate-800 active:scale-95 transition-all"
                           style="border-radius: var(--button-radius);">
                            <span>Request Instant RFQ</span>
                        </a>
                    </div>

                    <!-- Key Technical Highlights Strip -->
                    <div class="pt-6 border-t border-slate-200/80 dark:border-slate-800 grid grid-cols-3 gap-4 text-xs">
                        <div>
                            <span class="block text-2xl sm:text-3xl font-black text-[#003C58] dark:text-cyan-400 font-heading">100,000</span>
                            <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">RPM Dynamic Balancing</span>
                        </div>
                        <div>
                            <span class="block text-2xl sm:text-3xl font-black text-slate-800 dark:text-white font-heading">24/7/365</span>
                            <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Flying Squads to Port</span>
                        </div>
                        <div>
                            <span class="block text-2xl sm:text-3xl font-black text-emerald-600 dark:text-emerald-400 font-heading">100%</span>
                            <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Calibrated OEM Specs</span>
                        </div>
                    </div>

                </div>

                <!-- Right Column: PRECISION TURBINE INSTRUMENT DIAL (5 cols) -->
                <!-- Fully adaptive: Brushed titanium precision in light mode, deep metallic carbon in dark mode -->
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-3xl p-6 sm:p-8 bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-xl transition-all">
                        
                        <!-- High-Contrast Tachometer Frame with Calibrated Tick Marks -->
                        <div class="relative w-full aspect-square max-w-[360px] mx-auto flex items-center justify-center mb-6">
                            
                            <!-- Outer Calibrated Graduation Ring -->
                            <div class="absolute inset-0 rounded-full border-2 border-slate-300/80 dark:border-slate-700 flex items-center justify-center">
                                <div class="absolute top-1 text-[9px] font-mono font-bold text-slate-500 dark:text-slate-400">0&deg; / RPM</div>
                                <div class="absolute right-1 text-[9px] font-mono font-bold text-slate-500 dark:text-slate-400">90&deg;</div>
                                <div class="absolute bottom-1 text-[9px] font-mono font-bold text-slate-500 dark:text-slate-400">180&deg;</div>
                                <div class="absolute left-1 text-[9px] font-mono font-bold text-slate-500 dark:text-slate-400">270&deg;</div>
                            </div>
                            
                            <!-- Middle Rotating Indicator Ring -->
                            <div class="absolute inset-4 rounded-full border border-dashed border-[#003C58]/35 dark:border-slate-700 animate-turbine"></div>
                            
                            <!-- Inner Recessed Instrument Center (Light Mode: Clean Titanium Silver, Dark Mode: Deep Shipyard Carbon) -->
                            <div class="relative z-10 w-52 h-52 sm:w-60 sm:h-60 rounded-full bg-slate-50 dark:bg-[#030c14] border-4 border-slate-200 dark:border-slate-800 shadow-inner flex items-center justify-center overflow-hidden">
                                
                                <!-- Subtle Radial Grid Inside Dial -->
                                <div class="absolute inset-0 opacity-20 dark:opacity-10 bg-[radial-gradient(#003C58_1px,transparent_1px)] dark:bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:12px_12px]"></div>
                                
                                <!-- The Spinning Turbine (Clear, Distinct, Dual Mode with zero artificial cyan glow) -->
                                @php
                                    $heroTurbineLight = \App\Models\Setting::get('site_icon', 'assets/images/icon.png');
                                    $heroTurbineDark = \App\Models\Setting::get('site_icon_dark', 'assets/images/icon-dark.png') ?: $heroTurbineLight;
                                @endphp
                                <img src="{{ asset($heroTurbineLight) }}" 
                                     alt="Nordroy Precision Marine Turbine" 
                                     class="w-36 h-36 sm:w-40 sm:h-40 object-contain animate-turbine drop-shadow-[0_4px_16px_rgba(0,60,88,0.22)] dark:hidden relative z-20" />
                                <img src="{{ asset($heroTurbineDark) }}" 
                                     alt="Nordroy Precision Marine Turbine" 
                                     class="w-36 h-36 sm:w-40 sm:h-40 object-contain animate-turbine drop-shadow-[0_6px_20px_rgba(0,0,0,0.6)] hidden dark:block relative z-20" />
                            </div>
                        </div>

                        <!-- Technical Specification HUD Box -->
                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-xs space-y-2 font-mono">
                            <div class="flex items-center justify-between text-slate-500 dark:text-slate-400 text-[11px]">
                                <span>EQUIPMENT:</span>
                                <span class="text-[#003C58] dark:text-cyan-400 font-bold">HEAVY EXHAUST TURBOCHARGER</span>
                            </div>
                            <div class="flex items-center justify-between text-slate-500 dark:text-slate-400 text-[11px]">
                                <span>AUTHORIZED:</span>
                                <span class="text-slate-800 dark:text-white font-bold">ABB &bull; MAN &bull; KBB &bull; MHI &bull; NAPIER</span>
                            </div>
                            <div class="flex items-center justify-between text-slate-500 dark:text-slate-400 text-[11px]">
                                <span>WORKSHOP RADIUS:</span>
                                <span class="text-emerald-600 dark:text-emerald-400 font-bold">CHATTOGRAM &bull; MONGLA &bull; GLOBAL</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =====================================================================
         SECTION 2: OEM MULTI-BRAND PARTNER TICKER (Turbo Internacional Style)
         ===================================================================== -->
    <section id="partners" class="py-8 bg-slate-100 dark:bg-[#06121d] border-b border-slate-200 dark:border-slate-800 overflow-hidden text-slate-600 dark:text-slate-400 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8 mb-4 text-center">
            <span class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400">
                Multi-Brand Authorized Engineering &amp; Overhauls For Global OEM Platforms
            </span>
        </div>
        
        <div class="relative w-full overflow-hidden flex items-center">
            <div class="animate-ticker flex items-center gap-12 sm:gap-20 text-slate-700 dark:text-slate-300 font-heading font-extrabold text-sm sm:text-base tracking-widest uppercase">
                <span class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors cursor-default">Accelleron (ABB)</span>
                <span class="text-slate-400 dark:text-cyan-500 font-black">&bull;</span>
                <span class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors cursor-default">MAN Energy Solutions</span>
                <span class="text-slate-400 dark:text-cyan-500 font-black">&bull;</span>
                <span class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors cursor-default">KBB Kompressorenbau</span>
                <span class="text-slate-400 dark:text-cyan-500 font-black">&bull;</span>
                <span class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors cursor-default">Napier Turbochargers</span>
                <span class="text-slate-400 dark:text-cyan-500 font-black">&bull;</span>
                <span class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors cursor-default">Mitsubishi Heavy Industries (MET)</span>
                <span class="text-slate-400 dark:text-cyan-500 font-black">&bull;</span>
                <span class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors cursor-default">PBS Turbo</span>
                <span class="text-slate-400 dark:text-cyan-500 font-black">&bull;</span>
                <span class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors cursor-default">INNIO Waukesha</span>
                <span class="text-slate-400 dark:text-cyan-500 font-black">&bull;</span>
                <span class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors cursor-default">Ariel Compressors</span>
                <span class="text-slate-400 dark:text-cyan-500 font-black">&bull;</span>
                <!-- Duplicate for seamless infinite loop -->
                <span class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors cursor-default">Accelleron (ABB)</span>
                <span class="text-slate-400 dark:text-cyan-500 font-black">&bull;</span>
                <span class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors cursor-default">MAN Energy Solutions</span>
                <span class="text-slate-400 dark:text-cyan-500 font-black">&bull;</span>
                <span class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors cursor-default">KBB Kompressorenbau</span>
            </div>
        </div>
    </section>

    <!-- =====================================================================
         SECTION 3: CONGLOMERATE OVERVIEW & CORPORATE PILLARS (Dana Group Style)
         ===================================================================== -->
    <section id="about" class="py-20 lg:py-28 bg-white dark:bg-[#07131e] text-slate-800 dark:text-slate-200 border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left: Corporate Presentation (7 cols) -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-slate-100 dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 border border-slate-200 dark:border-slate-800">
                        Conglomerate Heritage &amp; Vision
                    </div>
                    
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white font-heading leading-tight">
                        A Heritage of Heavy Industrial Power, Maritime Integrity, &amp; Turn-Key Engineering.
                    </h2>
                    
                    <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 leading-relaxed">
                        Operating under the high standards of global marine engineering, Nordroy Marine &amp; Turbochargers unites heavy mechanical overhaul workshops, non-destructive metallurgical testing (NDT), dynamic rotor calibration, and comprehensive spare parts logistics under one unified corporate umbrella.
                    </p>

                    <!-- 3 Strategic Pillars -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4">
                        <div class="p-5 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800">
                            <div class="w-10 h-10 rounded-xl bg-slate-200/80 dark:bg-slate-800 flex items-center justify-center text-[#003C58] dark:text-cyan-400 mb-3">
                                <x-icon name="solid:anchor" class="w-5 h-5" />
                            </div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900 dark:text-white font-heading">Global Port Reach</h4>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">24/7 flying squads equipped for anchorage and berth call overhauls.</p>
                        </div>

                        <div class="p-5 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800">
                            <div class="w-10 h-10 rounded-xl bg-slate-200/80 dark:bg-slate-800 flex items-center justify-center text-[#003C58] dark:text-cyan-400 mb-3">
                                <x-icon name="solid:gauge-high" class="w-5 h-5" />
                            </div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900 dark:text-white font-heading">Calibrated Precision</h4>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Computerized Schenck dynamic balancing up to 100,000 RPM.</p>
                        </div>

                        <div class="p-5 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800">
                            <div class="w-10 h-10 rounded-xl bg-slate-200/80 dark:bg-slate-800 flex items-center justify-center text-[#003C58] dark:text-cyan-400 mb-3">
                                <x-icon name="solid:certificate" class="w-5 h-5" />
                            </div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900 dark:text-white font-heading">OEM Alliances</h4>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Direct access to genuine replacement parts and calibrated drawings.</p>
                        </div>
                    </div>

                </div>

                <!-- Right: Executive Leadership Quote Box (Dana Group inspired) (5 cols) -->
                <div class="lg:col-span-5">
                    <div class="p-8 rounded-3xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-lg relative space-y-6">
                        <div class="text-[#003C58] dark:text-cyan-400 opacity-30 text-5xl font-serif leading-none">&ldquo;</div>
                        <blockquote class="text-sm sm:text-base text-slate-700 dark:text-slate-300 italic leading-relaxed">
                            "In maritime logistics and heavy power generation, downtime is measured in thousands of dollars per hour. Our mission is to restore engine efficiency with zero deviation from OEM tolerances."
                        </blockquote>
                        <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#003C58] text-white flex items-center justify-center font-bold text-sm">
                                NR
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider font-heading">Executive Leadership</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Board of Directors &bull; Marine Engineering Division</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- =====================================================================
         SECTION 4: MULTI-BUSINESS UNITS MATRIX (Dana Group Style)
         ===================================================================== -->
    <section id="divisions" class="py-20 lg:py-28 bg-slate-50 dark:bg-[#0b1b2b] text-slate-900 dark:text-white border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-[#003C58] dark:text-cyan-400 bg-white dark:bg-slate-900 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-800">
                    Conglomerate Business Divisions
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-heading text-slate-900 dark:text-white">
                    Specialized Engineering Units
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    Each business unit operates with certified workshops, dedicated engineering squads, and specialized heavy tooling.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Unit 1 -->
                <div class="rounded-2xl p-6 bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-all space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-[#003C58] dark:text-cyan-400">
                        <x-icon name="solid:ship" class="w-6 h-6" />
                    </div>
                    <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">Marine Turbochargers</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Authorized overhauls for container carriers, bulk carriers, tankers, and offshore tugs across Chattogram and international ports.
                    </p>
                    <a href="{{ route('services') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#003C58] dark:text-cyan-400 hover:underline">
                        <span>Division Details</span> &rarr;
                    </a>
                </div>

                <!-- Unit 2 -->
                <div class="rounded-2xl p-6 bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-all space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-[#003C58] dark:text-cyan-400">
                        <x-icon name="solid:bolt" class="w-6 h-6" />
                    </div>
                    <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">Captive Power Generation</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Continuous maintenance contracts for gas and heavy fuel oil (HFO) generator power plants in spinning mills and industries.
                    </p>
                    <a href="{{ route('services') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#003C58] dark:text-cyan-400 hover:underline">
                        <span>Division Details</span> &rarr;
                    </a>
                </div>

                <!-- Unit 3 -->
                <div class="rounded-2xl p-6 bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-all space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-[#003C58] dark:text-cyan-400">
                        <x-icon name="solid:boxes-stacked" class="w-6 h-6" />
                    </div>
                    <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">Spare Parts Logistics</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Warehoused inventory of genuine rotor shafts, turbine blades, bearings, nozzle rings, and seal kits ready for prompt dispatch.
                    </p>
                    <a href="{{ route('services') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#003C58] dark:text-cyan-400 hover:underline">
                        <span>Division Details</span> &rarr;
                    </a>
                </div>

                <!-- Unit 4 -->
                <div class="rounded-2xl p-6 bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-all space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-[#003C58] dark:text-cyan-400">
                        <x-icon name="solid:microscope" class="w-6 h-6" />
                    </div>
                    <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">NDT &amp; Inspection</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Certified ultrasonic flaw detection, magnetic particle testing, hardness verification, and laser geometry alignment.
                    </p>
                    <a href="{{ route('services') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#003C58] dark:text-cyan-400 hover:underline">
                        <span>Division Details</span> &rarr;
                    </a>
                </div>

            </div>

        </div>
    </section>

    <!-- =====================================================================
         SECTION 5: PRECISION OVERHAUL SERVICES (Turbo Internacional Style)
         ===================================================================== -->
    <section id="services" class="py-20 lg:py-28 bg-white dark:bg-[#07131e] text-slate-900 dark:text-white border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-[#003C58] dark:text-cyan-400 bg-slate-100 dark:bg-slate-900 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-800">
                    Workshop &amp; Port Capabilities
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-heading text-slate-900 dark:text-white">
                    Precision Overhaul Services
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    Engineered according to manufacturer tolerance protocols with calibrated German Schenck balancing rigs.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Service 1 -->
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm hover:border-[#003C58] dark:hover:border-cyan-500/50 transition-all space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#003C58] dark:text-cyan-400">01 / BALANCING</span>
                        <x-icon name="solid:gauge" class="w-5 h-5 text-slate-400" />
                    </div>
                    <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">Dynamic Rotor Balancing (100k RPM)</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Elimination of micro-vibrations with computerized dynamic balancing up to 100,000 RPM, certified with comprehensive tolerance test sheets.
                    </p>
                </div>

                <!-- Service 2 -->
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm hover:border-[#003C58] dark:hover:border-cyan-500/50 transition-all space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#003C58] dark:text-cyan-400">02 / WELDING</span>
                        <x-icon name="solid:fire-flame-curved" class="w-5 h-5 text-slate-400" />
                    </div>
                    <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">Turbine Blading &amp; TIG Welding</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Precision laser and micro-TIG rebuilding of eroded turbine blade profiles, shroud rings, and metallurgical crack restoration.
                    </p>
                </div>

                <!-- Service 3 -->
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm hover:border-[#003C58] dark:hover:border-cyan-500/50 transition-all space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#003C58] dark:text-cyan-400">03 / CHRA</span>
                        <x-icon name="solid:arrows-rotate" class="w-5 h-5 text-slate-400" />
                    </div>
                    <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">Cartridge (CHRA) Exchange</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Pre-assembled, factory-balanced cartridge replacement modules for rapid turnaround times during tight vessel port calls.
                    </p>
                </div>

                <!-- Service 4 -->
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm hover:border-[#003C58] dark:hover:border-cyan-500/50 transition-all space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#003C58] dark:text-cyan-400">04 / CHEMICAL</span>
                        <x-icon name="solid:spray-can" class="w-5 h-5 text-slate-400" />
                    </div>
                    <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">Ultrasonic Chemical De-Carbonization</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Multi-stage heated ultrasonic bath cleaning to remove stubborn heavy fuel oil carbon glaze without damaging parent metal tolerances.
                    </p>
                </div>

                <!-- Service 5 -->
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm hover:border-[#003C58] dark:hover:border-cyan-500/50 transition-all space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#003C58] dark:text-cyan-400">05 / FLYING SQUAD</span>
                        <x-icon name="solid:truck-fast" class="w-5 h-5 text-slate-400" />
                    </div>
                    <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">24/7 Port Emergency Flying Squads</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Marine engineers equipped with mobile inspection tools ready to board vessels at Chattogram, Mongla, or international outer anchorages.
                    </p>
                </div>

                <!-- Service 6 -->
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm hover:border-[#003C58] dark:hover:border-cyan-500/50 transition-all space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#003C58] dark:text-cyan-400">06 / RETROFIT</span>
                        <x-icon name="solid:wrench" class="w-5 h-5 text-slate-400" />
                    </div>
                    <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">Retrofit &amp; Modernization Upgrades</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Replacement of outdated, obsolete turbochargers with modern, high-efficiency models for reduced fuel consumption and lower IMO emissions.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- =====================================================================
         TRANSPARENT MARINE VIDEO WINDOW BREAK (Turbo Internacional Style)
         Panoramic viewport over background marine video with adaptive executive glass glaze
         ===================================================================== -->
    @if(\App\Models\Setting::get('theme_video_break_enabled', '1') == '1')
    <section class="py-16 sm:py-24 bg-transparent relative overflow-hidden flex items-center justify-center text-center">
        <div class="max-w-4xl mx-auto px-6 py-10 sm:px-12 sm:py-14 rounded-3xl bg-white/85 dark:bg-[#07131e]/85 backdrop-blur-md border border-slate-200/80 dark:border-slate-800 shadow-xl space-y-6 relative z-10">
            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-slate-100 dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 border border-slate-200 dark:border-slate-800 shadow-2xs">
                Global Marine Engineering Excellence
            </span>
            <h2 class="text-3xl sm:text-5xl font-black font-heading tracking-tight text-slate-900 dark:text-white leading-tight">
                24/7 Rapid Emergency Response Across 40+ International Ports
            </h2>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 max-w-2xl mx-auto leading-relaxed font-medium">
                Our certified flying squads board commercial vessels at anchorage or alongside berths to deliver on-site turbocharger diagnostics, cartridge swap-outs, and dynamic balancing.
            </p>
            <div class="pt-2 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('services') }}" class="px-7 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-[#003C58] hover:bg-[#002f45] text-white shadow-lg transition-all">
                    View Overhaul Capabilities &rarr;
                </a>
                <a href="{{ route('contact') }}" class="px-7 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-200 border border-slate-300 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">
                    Contact Port Operations
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- =====================================================================
         SECTION 6: COMPANY MISSION, VISION & STRATEGIC VALUES (NEW)
         ===================================================================== -->
    <section class="py-20 lg:py-28 bg-slate-50 dark:bg-[#06121d] text-slate-900 dark:text-white border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-[#003C58] dark:text-cyan-400 bg-white dark:bg-slate-900 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-800">
                    Corporate Blueprint
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-heading text-slate-900 dark:text-white">
                    Mission, Vision &amp; Core Values
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    Guiding principles that define our commitment to global shipowners, captive power operators, and heavy industries.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Mission Card -->
                <div class="p-8 rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#003C58]/10 dark:bg-cyan-500/10 flex items-center justify-center text-[#003C58] dark:text-cyan-400">
                        <x-icon name="solid:bullseye" class="w-6 h-6" />
                    </div>
                    <h3 class="text-lg font-bold font-heading text-slate-900 dark:text-white">Our Mission</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        To eliminate engine downtime by delivering certified, multi-brand turbocharger overhauls, high-speed dynamic balancing, and genuine OEM parts with unmatched turnaround speed, metallurgical precision, and total engineering transparency.
                    </p>
                </div>

                <!-- Vision Card -->
                <div class="p-8 rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#003C58]/10 dark:bg-cyan-500/10 flex items-center justify-center text-[#003C58] dark:text-cyan-400">
                        <x-icon name="solid:eye" class="w-6 h-6" />
                    </div>
                    <h3 class="text-lg font-bold font-heading text-slate-900 dark:text-white">Our Vision 2030</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        To be the premier independent maritime turbomachinery conglomerate in South Asia and global waters, recognized by international classification societies as the benchmark for quality, technical integrity, and decarbonization retrofits.
                    </p>
                </div>

                <!-- Core Values Card -->
                <div class="p-8 rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#003C58]/10 dark:bg-cyan-500/10 flex items-center justify-center text-[#003C58] dark:text-cyan-400">
                        <x-icon name="solid:shield-halved" class="w-6 h-6" />
                    </div>
                    <h3 class="text-lg font-bold font-heading text-slate-900 dark:text-white">Core Values</h3>
                    <ul class="text-xs text-slate-600 dark:text-slate-400 space-y-2">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span><strong>Zero-Defect Quality:</strong> Strict adherence to ISO 9001 protocols.</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span><strong>Rapid Port Agility:</strong> 24/7 readiness for urgent port calls.</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span><strong>Technical Rigor:</strong> Calibrated testing and certified reports.</li>
                    </ul>
                </div>

            </div>

        </div>
    </section>

    <!-- =====================================================================
         SECTION 7: LEADERSHIP & ENGINEERING BOARD (MEMBERS) (NEW)
         ===================================================================== -->
    <section class="py-20 lg:py-28 bg-white dark:bg-[#07131e] text-slate-900 dark:text-white border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-[#003C58] dark:text-cyan-400 bg-slate-100 dark:bg-slate-900 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-800">
                    Executive Governance
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-heading text-slate-900 dark:text-white">
                    Leadership &amp; Chief Engineering Board
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    Decades of sea-going and shipyard experience leading certified maritime turbocharger overhauls.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Member 1 -->
                <div class="p-6 rounded-2xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm text-center space-y-4">
                    <div class="w-20 h-20 mx-auto rounded-full bg-slate-100 dark:bg-slate-800 border-2 border-[#003C58] dark:border-cyan-400 flex items-center justify-center font-bold text-xl text-[#003C58] dark:text-cyan-400">
                        TI
                    </div>
                    <div>
                        <h4 class="text-base font-bold font-heading text-slate-900 dark:text-white">Engr. Tariqul Islam</h4>
                        <p class="text-xs text-[#003C58] dark:text-cyan-400 font-semibold">Group Managing Director</p>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Ex-Chief Engineer, Class 1 Marine &bull; 28+ Yrs Maritime Experience</p>
                    </div>
                </div>

                <!-- Member 2 -->
                <div class="p-6 rounded-2xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm text-center space-y-4">
                    <div class="w-20 h-20 mx-auto rounded-full bg-slate-100 dark:bg-slate-800 border-2 border-[#003C58] dark:border-cyan-400 flex items-center justify-center font-bold text-xl text-[#003C58] dark:text-cyan-400">
                        HL
                    </div>
                    <div>
                        <h4 class="text-base font-bold font-heading text-slate-900 dark:text-white">Dr. Henrik Lindqvist</h4>
                        <p class="text-xs text-[#003C58] dark:text-cyan-400 font-semibold">Chief Technical Officer</p>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Ph.D. Turbomachinery Dynamics &bull; Former ABB/Accelleron Specialist</p>
                    </div>
                </div>

                <!-- Member 3 -->
                <div class="p-6 rounded-2xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm text-center space-y-4">
                    <div class="w-20 h-20 mx-auto rounded-full bg-slate-100 dark:bg-slate-800 border-2 border-[#003C58] dark:border-cyan-400 flex items-center justify-center font-bold text-xl text-[#003C58] dark:text-cyan-400">
                        MR
                    </div>
                    <div>
                        <h4 class="text-base font-bold font-heading text-slate-900 dark:text-white">Capt. Mahfuzur Rahman</h4>
                        <p class="text-xs text-[#003C58] dark:text-cyan-400 font-semibold">Director of Port Operations</p>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Master Mariner &bull; 22+ Yrs Chittagong &amp; Singapore Port Operations</p>
                    </div>
                </div>

                <!-- Member 4 -->
                <div class="p-6 rounded-2xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm text-center space-y-4">
                    <div class="w-20 h-20 mx-auto rounded-full bg-slate-100 dark:bg-slate-800 border-2 border-[#003C58] dark:border-cyan-400 flex items-center justify-center font-bold text-xl text-[#003C58] dark:text-cyan-400">
                        AK
                    </div>
                    <div>
                        <h4 class="text-base font-bold font-heading text-slate-900 dark:text-white">Engr. Asaduzzaman Khan</h4>
                        <p class="text-xs text-[#003C58] dark:text-cyan-400 font-semibold">Head of NDT &amp; Dynamic Balancing</p>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">ASNT Level III NDT Certified &bull; Schenck Balancing Specialist</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- =====================================================================
         SECTION 8: OUR PROJECTS PORTFOLIO (Dana Group Style) (NEW)
         ===================================================================== -->
    <section id="projects" class="py-20 lg:py-28 bg-slate-50 dark:bg-[#0b1b2b] text-slate-900 dark:text-white border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-[#003C58] dark:text-cyan-400 bg-white dark:bg-slate-900 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-800">
                    Execution Proven Track Record
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-heading text-slate-900 dark:text-white">
                    Featured Industrial &amp; Marine Projects
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    A glimpse of recent turn-key overhauls completed on commercial ships and captive power plants.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Project 1 -->
                <div class="rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-lg transition-all group">
                    <div class="h-60 bg-slate-100 dark:bg-slate-900 relative overflow-hidden flex items-center justify-center">
                        <img src="{{ asset('assets/images/gallery/gallery-plant.webp') }}" alt="7.2 MW Plant Overhaul" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div class="absolute bottom-3 left-4 right-4 bg-white/90 dark:bg-[#07131e]/90 backdrop-blur-md px-4 py-2 rounded-xl border border-slate-200/80 dark:border-slate-800 flex items-center justify-between text-xs shadow-sm">
                            <span class="px-2.5 py-0.5 rounded-md bg-[#003C58] text-white font-bold uppercase tracking-wider text-[10px]">Captive Power</span>
                            <span class="text-[#003C58] dark:text-cyan-400 font-mono font-bold">7.2 MW Plant Overhaul</span>
                        </div>
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-lg font-bold font-heading text-slate-900 dark:text-white">7.2 MW Waukesha Gas Generator Turbocharger Rebuild</h3>
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                            Complete disassembly, ultrasonic de-carbonization, and Schenck dynamic balancing for eight Waukesha gas engines at a major export spinning mill conglomerate.
                        </p>
                        <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                            <span>Client: Export Spinning Mills Ltd.</span>
                            <span class="text-emerald-600 dark:text-emerald-400 font-bold">Zero Downtime</span>
                        </div>
                    </div>
                </div>

                <!-- Project 2 -->
                <div class="rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-lg transition-all group">
                    <div class="h-60 bg-slate-100 dark:bg-slate-900 relative overflow-hidden flex items-center justify-center">
                        <img src="{{ asset('assets/images/gallery/gallery-turbine.webp') }}" alt="CHRA Cartridge Exchange" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div class="absolute bottom-3 left-4 right-4 bg-white/90 dark:bg-[#07131e]/90 backdrop-blur-md px-4 py-2 rounded-xl border border-slate-200/80 dark:border-slate-800 flex items-center justify-between text-xs shadow-sm">
                            <span class="px-2.5 py-0.5 rounded-md bg-[#003C58] text-white font-bold uppercase tracking-wider text-[10px]">Maritime Vessel</span>
                            <span class="text-[#003C58] dark:text-cyan-400 font-mono font-bold">45,000 DWT Bulk Carrier</span>
                        </div>
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-lg font-bold font-heading text-slate-900 dark:text-white">Emergency CHRA Cartridge Exchange at Chattogram Port</h3>
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                            Rapid 18-hour emergency response for an international bulk carrier experiencing high turbine vibrations, replacing the entire CHRA cartridge during cargo discharging.
                        </p>
                        <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                            <span>Location: Chattogram Outer Anchorage</span>
                            <span class="text-emerald-600 dark:text-emerald-400 font-bold">18h Turnaround</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- =====================================================================
         SECTION 9: VIDEO GALLERY WITH HOVER-TO-PLAY (Dana Group Style) (NEW)
         Thumbnails play video preview smoothly on mouse hover, without YouTube distractions.
         ===================================================================== -->
    <section id="videos" class="py-20 lg:py-28 bg-white dark:bg-[#07131e] text-slate-900 dark:text-white border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-[#003C58] dark:text-cyan-400 bg-slate-100 dark:bg-slate-900 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-800">
                    Workshop &amp; Port In Action
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-heading text-slate-900 dark:text-white">
                    Video Gallery (Hover to Play)
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    Hover your mouse over any video card to stream a live silent preview of our precision balancing and overhaul operations.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Video Card 1 -->
                <div class="rounded-3xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-xl transition-all flex flex-col justify-between group"
                     x-data="{ isHovered: false }">
                    <a href="{{ route('project.details', ['slug' => 'marine-vessel-turbocharger-overhaul']) }}"
                       class="relative aspect-video bg-slate-100 dark:bg-black overflow-hidden flex items-center justify-center cursor-pointer block"
                       @mouseenter="isHovered = true; $refs.video1.play()"
                       @mouseleave="isHovered = false; $refs.video1.pause(); $refs.video1.currentTime = 0">
                        
                        <!-- Video element -->
                        <video x-ref="video1" loop muted playsinline preload="metadata" 
                               class="w-full h-full object-cover">
                            <source src="{{ asset('assets/videos/background-marine.mp4') }}" type="video/mp4">
                        </video>

                        <!-- Guaranteed Poster Image (Fades on hover, INSTANTLY returns on mouseleave so it NEVER stays black) -->
                        <img src="{{ asset('assets/images/gallery/gallery-balancing.webp') }}" 
                             alt="Dynamic Balancing Thumbnail"
                             x-show="!isHovered"
                             class="absolute inset-0 w-full h-full object-cover z-10 pointer-events-none transition-opacity duration-150" />

                        <!-- Play Button Overlay -->
                        <div x-show="!isHovered" class="absolute inset-0 bg-slate-900/15 dark:bg-black/40 flex items-center justify-center transition-opacity pointer-events-none z-20">
                            <div class="w-12 h-12 rounded-full bg-white text-[#003C58] flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <x-icon name="solid:play" class="w-4 h-4 translate-x-0.5" />
                            </div>
                        </div>

                        <div class="absolute bottom-3 right-3 px-2 py-0.5 rounded bg-white/95 dark:bg-black/80 text-[10px] font-mono font-medium text-slate-800 dark:text-white border border-slate-200/80 dark:border-transparent shadow-sm pointer-events-none z-20">
                            0:24 HD &bull; Hover to Preview
                        </div>
                    </a>

                    <div class="p-5 space-y-3 flex-1 flex flex-col justify-between">
                        <div class="space-y-1.5">
                            <span class="text-[10px] font-bold text-[#003C58] dark:text-cyan-400 uppercase tracking-widest">Schenck Dynamic Test</span>
                            <h4 class="text-sm font-bold font-heading text-slate-900 dark:text-white">
                                <a href="{{ route('project.details', ['slug' => 'marine-vessel-turbocharger-overhaul']) }}" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">
                                    Rotor Dynamic Balancing at 100,000 RPM
                                </a>
                            </h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Calibrated precision run on our computerized Schenck hard-bearing rig.</p>
                        </div>

                        <!-- Card Action Links -->
                        <div class="pt-3 border-t border-slate-200/80 dark:border-slate-800 flex items-center justify-between text-xs">
                            <a href="{{ route('project.details', ['slug' => 'marine-vessel-turbocharger-overhaul']) }}"
                               class="inline-flex items-center gap-1.5 font-bold text-red-600 dark:text-red-400 hover:underline">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                <span>Watch Video &amp; Case Study &rarr;</span>
                            </a>
                            <a href="{{ route('services') }}#balancing" class="font-bold text-[#003C58] dark:text-cyan-400 hover:underline">
                                Details &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Video Card 2 -->
                <div class="rounded-3xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-xl transition-all flex flex-col justify-between group"
                     x-data="{ isHovered: false }">
                    <a href="{{ route('project.details', ['slug' => 'emergency-anchorage-flying-squad']) }}"
                       class="relative aspect-video bg-slate-100 dark:bg-black overflow-hidden flex items-center justify-center cursor-pointer block"
                       @mouseenter="isHovered = true; $refs.video2.play()"
                       @mouseleave="isHovered = false; $refs.video2.pause(); $refs.video2.currentTime = 0">
                        
                        <video x-ref="video2" loop muted playsinline preload="metadata" 
                               class="w-full h-full object-cover">
                            <source src="{{ asset('assets/videos/background-marine.mp4') }}" type="video/mp4">
                        </video>

                        <img src="{{ asset('assets/images/gallery/gallery-vessel.jpg') }}" 
                             alt="Vessel Boarding Thumbnail"
                             x-show="!isHovered"
                             class="absolute inset-0 w-full h-full object-cover z-10 pointer-events-none transition-opacity duration-150" />

                        <div x-show="!isHovered" class="absolute inset-0 bg-slate-900/15 dark:bg-black/40 flex items-center justify-center transition-opacity pointer-events-none z-20">
                            <div class="w-12 h-12 rounded-full bg-white text-[#003C58] flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <x-icon name="solid:play" class="w-4 h-4 translate-x-0.5" />
                            </div>
                        </div>

                        <div class="absolute bottom-3 right-3 px-2 py-0.5 rounded bg-white/95 dark:bg-black/80 text-[10px] font-mono font-medium text-slate-800 dark:text-white border border-slate-200/80 dark:border-transparent shadow-sm pointer-events-none z-20">
                            0:32 HD &bull; Hover to Preview
                        </div>
                    </a>

                    <div class="p-5 space-y-3 flex-1 flex flex-col justify-between">
                        <div class="space-y-1.5">
                            <span class="text-[10px] font-bold text-[#003C58] dark:text-cyan-400 uppercase tracking-widest">Chattogram Port</span>
                            <h4 class="text-sm font-bold font-heading text-slate-900 dark:text-white">
                                <a href="{{ route('project.details', ['slug' => 'emergency-anchorage-flying-squad']) }}" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">
                                    Emergency Anchorage Flying Squad Operation
                                </a>
                            </h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Boarding an oceangoing bulk carrier for in-situ turbocharger inspection.</p>
                        </div>

                        <div class="pt-3 border-t border-slate-200/80 dark:border-slate-800 flex items-center justify-between text-xs">
                            <a href="{{ route('project.details', ['slug' => 'emergency-anchorage-flying-squad']) }}"
                               class="inline-flex items-center gap-1.5 font-bold text-red-600 dark:text-red-400 hover:underline">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                <span>Watch Video &amp; Case Study &rarr;</span>
                            </a>
                            <a href="{{ route('projects') }}#projects" class="font-bold text-[#003C58] dark:text-cyan-400 hover:underline">
                                Details &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Video Card 3 -->
                <div class="rounded-3xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-xl transition-all flex flex-col justify-between group"
                     x-data="{ isHovered: false }">
                    <a href="{{ route('project.details', ['slug' => 'industrial-power-plant-balancing']) }}"
                       class="relative aspect-video bg-slate-100 dark:bg-black overflow-hidden flex items-center justify-center cursor-pointer block"
                       @mouseenter="isHovered = true; $refs.video3.play()"
                       @mouseleave="isHovered = false; $refs.video3.pause(); $refs.video3.currentTime = 0">
                        
                        <video x-ref="video3" loop muted playsinline preload="metadata" 
                               class="w-full h-full object-cover">
                            <source src="{{ asset('assets/videos/background-marine.mp4') }}" type="video/mp4">
                        </video>

                        <img src="{{ asset('assets/images/gallery/gallery-welding.webp') }}" 
                             alt="Welding Thumbnail"
                             x-show="!isHovered"
                             class="absolute inset-0 w-full h-full object-cover z-10 pointer-events-none transition-opacity duration-150" />

                        <div x-show="!isHovered" class="absolute inset-0 bg-slate-900/15 dark:bg-black/40 flex items-center justify-center transition-opacity pointer-events-none z-20">
                            <div class="w-12 h-12 rounded-full bg-white text-[#003C58] flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <x-icon name="solid:play" class="w-4 h-4 translate-x-0.5" />
                            </div>
                        </div>

                        <div class="absolute bottom-3 right-3 px-2 py-0.5 rounded bg-white/95 dark:bg-black/80 text-[10px] font-mono font-medium text-slate-800 dark:text-white border border-slate-200/80 dark:border-transparent shadow-sm pointer-events-none z-20">
                            0:18 HD &bull; Hover to Preview
                        </div>
                    </a>

                    <div class="p-5 space-y-3 flex-1 flex flex-col justify-between">
                        <div class="space-y-1.5">
                            <span class="text-[10px] font-bold text-[#003C58] dark:text-cyan-400 uppercase tracking-widest">Precision Metallurgical</span>
                            <h4 class="text-sm font-bold font-heading text-slate-900 dark:text-white">
                                <a href="{{ route('project.details', ['slug' => 'industrial-power-plant-balancing']) }}" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">
                                    Micro-TIG Blade Reconstruction &amp; Polishing
                                </a>
                            </h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Restoration of eroded turbine blade aerofoil geometry and shroud rings.</p>
                        </div>

                        <div class="pt-3 border-t border-slate-200/80 dark:border-slate-800 flex items-center justify-between text-xs">
                            <a href="{{ route('project.details', ['slug' => 'industrial-power-plant-balancing']) }}"
                               class="inline-flex items-center gap-1.5 font-bold text-red-600 dark:text-red-400 hover:underline">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                <span>Watch Video &amp; Case Study &rarr;</span>
                            </a>
                            <a href="{{ route('services') }}#overhaul" class="font-bold text-[#003C58] dark:text-cyan-400 hover:underline">
                                Details &rarr;
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- =====================================================================
         SECTION 10: PHOTO GALLERY & WORKSHOPS (NEW - With Full-Screen Image Lightbox Preview)
         ===================================================================== -->
    <section id="photos" class="py-20 lg:py-28 bg-slate-50 dark:bg-[#06121d] text-slate-900 dark:text-white border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-[#003C58] dark:text-cyan-400 bg-white dark:bg-slate-900 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-800">
                    Visual Facilities
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-heading text-slate-900 dark:text-white">
                    Workshop &amp; Engineering Gallery
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    Click on any photo below to inspect high-resolution images of our port workshops and overhaul facilities.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                
                <!-- Photo 1: Dynamic Balancing Bay -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-balancing.webp') }}', title: 'Dynamic Rotor Balancing Bay (Schenck Hard-Bearing Calibrated)' })">
                    <img src="{{ asset('assets/images/gallery/gallery-balancing.webp') }}" alt="Dynamic Balancing" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-[#003C58]/20 dark:bg-slate-950/50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-10 h-10 rounded-full bg-white dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 border border-slate-200 dark:border-slate-700 flex items-center justify-center shadow-lg">
                            <x-icon name="solid:magnifying-glass-plus" class="w-4 h-4" />
                        </div>
                    </div>
                    <div class="absolute bottom-2 left-2 right-2 bg-white/95 dark:bg-[#07131e]/90 backdrop-blur-md px-3 py-1.5 rounded-xl border border-slate-200/80 dark:border-slate-800 text-xs shadow-sm z-10">
                        <span class="font-bold block truncate text-slate-900 dark:text-white">Dynamic Balancing Bay</span>
                        <span class="text-[10px] text-[#003C58] dark:text-cyan-400 font-mono font-medium">100,000 RPM Schenck Rig</span>
                    </div>
                </div>

                <!-- Photo 2: Micro-TIG Welding Bay -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-welding.webp') }}', title: 'Micro-TIG Turbine Blade Reconstruction Bay' })">
                    <img src="{{ asset('assets/images/gallery/gallery-welding.webp') }}" alt="Micro-TIG Welding" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-[#003C58]/20 dark:bg-slate-950/50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-10 h-10 rounded-full bg-white dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 border border-slate-200 dark:border-slate-700 flex items-center justify-center shadow-lg">
                            <x-icon name="solid:magnifying-glass-plus" class="w-4 h-4" />
                        </div>
                    </div>
                    <div class="absolute bottom-2 left-2 right-2 bg-white/95 dark:bg-[#07131e]/90 backdrop-blur-md px-3 py-1.5 rounded-xl border border-slate-200/80 dark:border-slate-800 text-xs shadow-sm z-10">
                        <span class="font-bold block truncate text-slate-900 dark:text-white">Turbine Blade Welding</span>
                        <span class="text-[10px] text-[#003C58] dark:text-cyan-400 font-mono font-medium">Laser &amp; TIG Profiling</span>
                    </div>
                </div>

                <!-- Photo 3: Cartridge Rebuild Station -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-turbine.webp') }}', title: 'Heavy Turbocharger Cartridge (CHRA) Assembly' })">
                    <img src="{{ asset('assets/images/gallery/gallery-turbine.webp') }}" alt="CHRA Assembly" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-[#003C58]/20 dark:bg-slate-950/50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-10 h-10 rounded-full bg-white dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 border border-slate-200 dark:border-slate-700 flex items-center justify-center shadow-lg">
                            <x-icon name="solid:magnifying-glass-plus" class="w-4 h-4" />
                        </div>
                    </div>
                    <div class="absolute bottom-2 left-2 right-2 bg-white/95 dark:bg-[#07131e]/90 backdrop-blur-md px-3 py-1.5 rounded-xl border border-slate-200/80 dark:border-slate-800 text-xs shadow-sm z-10">
                        <span class="font-bold block truncate text-slate-900 dark:text-white">CHRA Cartridge Assembly</span>
                        <span class="text-[10px] text-[#003C58] dark:text-cyan-400 font-mono font-medium">Calibrated Clean Bay</span>
                    </div>
                </div>

                <!-- Photo 4: 7.2 MW Plant Turbomachinery -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-plant.webp') }}', title: '7.2 MW Captive Power Plant Turbomachinery Overhaul' })">
                    <img src="{{ asset('assets/images/gallery/gallery-plant.webp') }}" alt="Captive Power Plant" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-[#003C58]/20 dark:bg-slate-950/50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-10 h-10 rounded-full bg-white dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 border border-slate-200 dark:border-slate-700 flex items-center justify-center shadow-lg">
                            <x-icon name="solid:magnifying-glass-plus" class="w-4 h-4" />
                        </div>
                    </div>
                    <div class="absolute bottom-2 left-2 right-2 bg-white/95 dark:bg-[#07131e]/90 backdrop-blur-md px-3 py-1.5 rounded-xl border border-slate-200/80 dark:border-slate-800 text-xs shadow-sm z-10">
                        <span class="font-bold block truncate text-slate-900 dark:text-white">Captive Power Plant</span>
                        <span class="text-[10px] text-[#003C58] dark:text-cyan-400 font-mono font-medium">Industrial Utilities</span>
                    </div>
                </div>

                <!-- Photo 5: Generator Overhaul -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-generator.webp') }}', title: 'Industrial Diesel & Gas Generator Turbochargers' })">
                    <img src="{{ asset('assets/images/gallery/gallery-generator.webp') }}" alt="Generator Turbochargers" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-[#003C58]/20 dark:bg-slate-950/50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-10 h-10 rounded-full bg-white dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 border border-slate-200 dark:border-slate-700 flex items-center justify-center shadow-lg">
                            <x-icon name="solid:magnifying-glass-plus" class="w-4 h-4" />
                        </div>
                    </div>
                    <div class="absolute bottom-2 left-2 right-2 bg-white/95 dark:bg-[#07131e]/90 backdrop-blur-md px-3 py-1.5 rounded-xl border border-slate-200/80 dark:border-slate-800 text-xs shadow-sm z-10">
                        <span class="font-bold block truncate text-slate-900 dark:text-white">Generator Turbo Systems</span>
                        <span class="text-[10px] text-[#003C58] dark:text-cyan-400 font-mono font-medium">Continuous Contracts</span>
                    </div>
                </div>

                <!-- Photo 6: Vessel Port Flying Squad -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-vessel.jpg') }}', title: 'Chattogram Port Anchorage Vessel Flying Squad' })">
                    <img src="{{ asset('assets/images/gallery/gallery-vessel.jpg') }}" alt="Vessel Port Call" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-[#003C58]/20 dark:bg-slate-950/50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-10 h-10 rounded-full bg-white dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 border border-slate-200 dark:border-slate-700 flex items-center justify-center shadow-lg">
                            <x-icon name="solid:magnifying-glass-plus" class="w-4 h-4" />
                        </div>
                    </div>
                    <div class="absolute bottom-2 left-2 right-2 bg-white/95 dark:bg-[#07131e]/90 backdrop-blur-md px-3 py-1.5 rounded-xl border border-slate-200/80 dark:border-slate-800 text-xs shadow-sm z-10">
                        <span class="font-bold block truncate text-slate-900 dark:text-white">Port Flying Squad</span>
                        <span class="text-[10px] text-[#003C58] dark:text-cyan-400 font-mono font-medium">Chattogram Outer Anchorage</span>
                    </div>
                </div>

                <!-- Photo 7: NDT Inspection -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-technician.jpg') }}', title: 'Non-Destructive Metallurgical Flaw Detection & Testing' })">
                    <img src="{{ asset('assets/images/gallery/gallery-technician.jpg') }}" alt="NDT Inspection" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-[#003C58]/20 dark:bg-slate-950/50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-10 h-10 rounded-full bg-white dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 border border-slate-200 dark:border-slate-700 flex items-center justify-center shadow-lg">
                            <x-icon name="solid:magnifying-glass-plus" class="w-4 h-4" />
                        </div>
                    </div>
                    <div class="absolute bottom-2 left-2 right-2 bg-white/95 dark:bg-[#07131e]/90 backdrop-blur-md px-3 py-1.5 rounded-xl border border-slate-200/80 dark:border-slate-800 text-xs shadow-sm z-10">
                        <span class="font-bold block truncate text-slate-900 dark:text-white">NDT Metallurgy Testing</span>
                        <span class="text-[10px] text-[#003C58] dark:text-cyan-400 font-mono font-medium">ASNT Level III Bench</span>
                    </div>
                </div>

                <!-- Photo 8: Industrial Power Diagnostics -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-substation.webp') }}', title: 'Industrial Turbine Power Substation Diagnostics' })">
                    <img src="{{ asset('assets/images/gallery/gallery-substation.webp') }}" alt="Turbine Power Diagnostics" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-[#003C58]/20 dark:bg-slate-950/50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-10 h-10 rounded-full bg-white dark:bg-slate-900 text-[#003C58] dark:text-cyan-400 border border-slate-200 dark:border-slate-700 flex items-center justify-center shadow-lg">
                            <x-icon name="solid:magnifying-glass-plus" class="w-4 h-4" />
                        </div>
                    </div>
                    <div class="absolute bottom-2 left-2 right-2 bg-white/95 dark:bg-[#07131e]/90 backdrop-blur-md px-3 py-1.5 rounded-xl border border-slate-200/80 dark:border-slate-800 text-xs shadow-sm z-10">
                        <span class="font-bold block truncate text-slate-900 dark:text-white">Turbine Diagnostics</span>
                        <span class="text-[10px] text-[#003C58] dark:text-cyan-400 font-mono font-medium">Load &amp; Surge Verification</span>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- =====================================================================
         SECTION 11: PROVEN PERFORMANCE METRICS
         ===================================================================== -->
    <section class="py-16 bg-slate-100 dark:bg-[#0b1b2b] border-b border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                
                <div>
                    <span class="block text-4xl sm:text-5xl font-black font-heading text-[#003C58] dark:text-cyan-400">30+</span>
                    <span class="text-xs uppercase tracking-wider text-slate-600 dark:text-slate-400 font-bold mt-1 block">Years of Excellence</span>
                </div>

                <div>
                    <span class="block text-4xl sm:text-5xl font-black font-heading text-slate-900 dark:text-white">1,450+</span>
                    <span class="text-xs uppercase tracking-wider text-slate-600 dark:text-slate-400 font-bold mt-1 block">Turbomachines Overhauled</span>
                </div>

                <div>
                    <span class="block text-4xl sm:text-5xl font-black font-heading text-[#003C58] dark:text-cyan-400">12+</span>
                    <span class="text-xs uppercase tracking-wider text-slate-600 dark:text-slate-400 font-bold mt-1 block">Global Ports Covered</span>
                </div>

                <div>
                    <span class="block text-4xl sm:text-5xl font-black font-heading text-emerald-600 dark:text-emerald-400">100%</span>
                    <span class="text-xs uppercase tracking-wider text-slate-600 dark:text-slate-400 font-bold mt-1 block">Calibrated Schenck Testing</span>
                </div>

            </div>
        </div>
    </section>

    <!-- =====================================================================
         SECTION 12: GENUINE SPARE PARTS CATALOG (Turbo Internacional Style)
         ===================================================================== -->
    <section id="parts" class="py-20 lg:py-28 bg-white dark:bg-[#07131e] text-slate-900 dark:text-white border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-[#003C58] dark:text-cyan-400 bg-slate-100 dark:bg-slate-900 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-800">
                    OEM Replacement Inventory
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-heading text-slate-900 dark:text-white">
                    Genuine Spare Parts Catalog
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    Traceable serial numbers with mill test certificates ready for immediate dispatch.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                
                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 text-center space-y-2 hover:border-[#003C58] dark:hover:border-cyan-400 transition-all">
                    <x-icon name="solid:fan" class="w-8 h-8 mx-auto text-[#003C58] dark:text-cyan-400" />
                    <h4 class="text-xs font-bold font-heading text-slate-900 dark:text-white">Turbine Blades</h4>
                    <span class="text-[10px] text-slate-500 font-mono block">Nimonic 80A / 90</span>
                </div>

                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 text-center space-y-2 hover:border-[#003C58] dark:hover:border-cyan-400 transition-all">
                    <x-icon name="solid:circle-notch" class="w-8 h-8 mx-auto text-[#003C58] dark:text-cyan-400" />
                    <h4 class="text-xs font-bold font-heading text-slate-900 dark:text-white">Rotor Shafts</h4>
                    <span class="text-[10px] text-slate-500 font-mono block">Forged Alloy Steel</span>
                </div>

                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 text-center space-y-2 hover:border-[#003C58] dark:hover:border-cyan-400 transition-all">
                    <x-icon name="solid:ring" class="w-8 h-8 mx-auto text-[#003C58] dark:text-cyan-400" />
                    <h4 class="text-xs font-bold font-heading text-slate-900 dark:text-white">Nozzle Rings</h4>
                    <span class="text-[10px] text-slate-500 font-mono block">High-Temp Resistant</span>
                </div>

                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 text-center space-y-2 hover:border-[#003C58] dark:hover:border-cyan-400 transition-all">
                    <x-icon name="solid:compact-disc" class="w-8 h-8 mx-auto text-[#003C58] dark:text-cyan-400" />
                    <h4 class="text-xs font-bold font-heading text-slate-900 dark:text-white">Bearing Bushes</h4>
                    <span class="text-[10px] text-slate-500 font-mono block">Hydrodynamic Squeeze</span>
                </div>

                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 text-center space-y-2 hover:border-[#003C58] dark:hover:border-cyan-400 transition-all">
                    <x-icon name="solid:asterisk" class="w-8 h-8 mx-auto text-[#003C58] dark:text-cyan-400" />
                    <h4 class="text-xs font-bold font-heading text-slate-900 dark:text-white">Impellers</h4>
                    <span class="text-[10px] text-slate-500 font-mono block">Milled Titanium / Al</span>
                </div>

                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 text-center space-y-2 hover:border-[#003C58] dark:hover:border-cyan-400 transition-all">
                    <x-icon name="solid:shield" class="w-8 h-8 mx-auto text-[#003C58] dark:text-cyan-400" />
                    <h4 class="text-xs font-bold font-heading text-slate-900 dark:text-white">Seal Kits</h4>
                    <span class="text-[10px] text-slate-500 font-mono block">Gas &amp; Oil Labyrinth</span>
                </div>

            </div>

        </div>
    </section>

    <!-- =====================================================================
         SECTION 13: INTERACTIVE RAPID RFQ / DUTY DESK
         ===================================================================== -->
    <section id="rfq" class="py-20 lg:py-28 bg-slate-50 dark:bg-[#06121d] text-slate-900 dark:text-white border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            
            <div class="max-w-4xl mx-auto rounded-3xl p-8 sm:p-12 bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-xl space-y-8">
                
                <div class="text-center space-y-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#003C58] dark:text-cyan-400 bg-slate-100 dark:bg-slate-900 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-800">
                        24/7 Operations Desk
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-900 dark:text-white">
                        Request Instant Quotation or Emergency Port Call
                    </h2>
                    <p class="text-xs text-slate-600 dark:text-slate-400">
                        Our duty marine engineering superintendents respond within 45 minutes of RFQ submission.
                    </p>
                </div>

                <form action="#" method="POST" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Vessel / Plant Name</label>
                            <input type="text" placeholder="e.g. M/V Nordroy Carrier or Power Plant Unit 3" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Turbocharger Model &amp; Serial</label>
                            <input type="text" placeholder="e.g. ABB TPL-77 or MAN TCR22" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Port / Location</label>
                            <input type="text" placeholder="Chattogram / Mongla / Other" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Service Required</label>
                            <select class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none">
                                <option>Complete Overhaul &amp; Dynamic Balancing</option>
                                <option>CHRA Cartridge Exchange</option>
                                <option>Emergency Flying Squad to Vessel</option>
                                <option>Spare Parts Purchase</option>
                                <option>NDT Metallurgical Inspection</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Urgency Level</label>
                            <select class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none">
                                <option>Standard Scheduled Maintenance</option>
                                <option>Urgent Port Call (Within 48h)</option>
                                <option>Emergency Vessel Blackout / AOG</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Contact Email &amp; Phone</label>
                        <input type="text" placeholder="technical.director@shipping-line.com / +880 1800-000000" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Technical Notes &amp; Observed Issues</label>
                        <textarea rows="3" placeholder="Describe symptoms (e.g. abnormal vibrations, oil leakage in exhaust casing, surging under load)..." class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none"></textarea>
                    </div>

                    <button type="button" class="w-full py-3.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white shadow-md active:scale-95 transition-all"
                            style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color));">
                        Submit Technical RFQ to Duty Desk
                    </button>
                </form>

            </div>

        </div>
    </section>

</x-layouts.frontend>
