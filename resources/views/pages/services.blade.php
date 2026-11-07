<x-layouts.frontend title="Precision Overhaul Services & Dynamic Balancing">
    
    <!-- Hero Header (Transparent so background video is visible behind the title) -->
    <div class="py-16 sm:py-24 bg-transparent border-b border-slate-200/80 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            <span class="text-xs font-bold uppercase tracking-wider text-[#013d5a] dark:text-cyan-400 bg-white dark:bg-slate-900 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-800 shadow-2xs">
                Technical Capabilities
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold font-heading text-slate-900 dark:text-white mt-4 leading-tight drop-shadow-xs">
                Precision Overhaul Services &amp; Port Flying Squads.
            </h1>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 max-w-3xl mt-4 leading-relaxed font-medium">
                Operating with calibrated German balancing rigs and certified marine engineers to guarantee that every turbocharger overhaul achieves maximum boost pressure and zero vibration.
            </p>
        </div>
    </div>

    <!-- Overhaul Services Detailed Grid -->
    <section class="py-20 bg-slate-50 dark:bg-[#06121d] border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8 space-y-16">
            
            <!-- Service 1: Dynamic Balancing -->
            <div id="balancing" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center p-8 rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="lg:col-span-7 space-y-4">
                    <span class="text-xs font-mono font-bold text-[#013d5a] dark:text-cyan-400 uppercase tracking-wider">01 &bull; DYNAMIC CALIBRATION</span>
                    <h2 class="text-2xl font-bold font-heading text-slate-900 dark:text-white">Computerized Dynamic Rotor Balancing (100,000 RPM)</h2>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        At extreme peripheral velocities, even a fraction of a gram imbalance creates immense centrifugal forces that destroy hydrodynamic bearings and trigger blade failure. We utilize high-precision Schenck dynamic balancing systems with dual-plane phase angle sensors, balancing rotors up to 100,000 RPM in accordance with ISO 1940-1 grade G2.5 standards.
                    </p>
                    <div class="flex flex-wrap items-center gap-4 text-xs font-mono text-slate-500 pt-2">
                        <span>Tolerance: &plusmn; 0.1g &bull; mm</span>
                        <span>Rig: Schenck Hard-Bearing</span>
                        <span>Certificate: DNV / Class Approved</span>
                    </div>
                </div>
                <div class="lg:col-span-5">
                    <div class="rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-md bg-black relative aspect-video group cursor-pointer"
                         @click="$dispatch('open-video-modal', { title: 'Computerized Dynamic Rotor Balancing at 100,000 RPM (Schenck Hard-Bearing Rig)', embedUrl: 'https://www.youtube-nocookie.com/embed/5mGhWcKzDTo' })">
                        <img src="{{ asset('assets/images/gallery/gallery-balancing.webp') }}" alt="Dynamic Balancing" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        <div class="absolute inset-0 bg-slate-950/30 group-hover:bg-slate-950/20 flex items-center justify-center transition-colors">
                            <div class="w-14 h-14 rounded-full bg-red-600 text-white flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 fill-current translate-x-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                        <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-[11px] text-white font-mono bg-black/70 px-3 py-1.5 rounded-lg backdrop-blur-xs">
                            <span class="truncate max-w-[200px]">Dynamic Balancing Run</span>
                            <span class="text-red-400 font-bold shrink-0">Watch YouTube &rarr;</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 2: Blading & Welding -->
            <div id="overhaul" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center p-8 rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="lg:col-span-7 space-y-4">
                    <span class="text-xs font-mono font-bold text-[#013d5a] dark:text-cyan-400 uppercase tracking-wider">02 &bull; METALLURGICAL RESTORATION</span>
                    <h2 class="text-2xl font-bold font-heading text-slate-900 dark:text-white">Turbine Blading &amp; Micro-TIG Welding</h2>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Heavy fuel oil deposits and high exhaust temperatures erode turbine blade tips, degrading thermodynamic expansion efficiency. We perform certified micro-TIG reconstruction on Nimonic alloys, re-profiling blade aerofoils, replacing damping wires, and conducting dye-penetrant inspection to eliminate micro-fractures.
                    </p>
                    <div class="flex flex-wrap items-center gap-4 text-xs font-mono text-slate-500 pt-2">
                        <span>Alloy: Nimonic 80A / Inconel 718</span>
                        <span>NDT: 100% Liquid Penetrant</span>
                    </div>
                </div>
                <div class="lg:col-span-5">
                    <div class="rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-md bg-black relative aspect-video group cursor-pointer"
                         @click="$dispatch('open-video-modal', { title: 'Micro-TIG Turbine Blade Reconstruction & Polishing', embedUrl: 'https://www.youtube-nocookie.com/embed/bXQeM_6rVMo' })">
                        <img src="{{ asset('assets/images/gallery/gallery-welding.webp') }}" alt="Micro-TIG Welding" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        <div class="absolute inset-0 bg-slate-950/30 group-hover:bg-slate-950/20 flex items-center justify-center transition-colors">
                            <div class="w-14 h-14 rounded-full bg-red-600 text-white flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 fill-current translate-x-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                        <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-[11px] text-white font-mono bg-black/70 px-3 py-1.5 rounded-lg backdrop-blur-xs">
                            <span class="truncate max-w-[200px]">Micro-TIG Rebuilding</span>
                            <span class="text-red-400 font-bold shrink-0">Watch YouTube &rarr;</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 3: CHRA Exchange -->
            <div id="cartridge" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center p-8 rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="lg:col-span-8 space-y-4">
                    <span class="text-xs font-mono font-bold text-[#013d5a] dark:text-cyan-400 uppercase tracking-wider">03 &bull; RAPID EXCHANGE</span>
                    <h2 class="text-2xl font-bold font-heading text-slate-900 dark:text-white">Cartridge (CHRA) Exchange &amp; Rebuild</h2>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        When vessel schedules permit only a short port window, our ready-assembled, balanced cartridge (Center Housing Rotating Assembly) modules provide the fastest solution. We swap out the worn core, install a factory-calibrated CHRA, and rebuild your core at our workshop for future rotation.
                    </p>
                    <div class="flex items-center gap-4 text-xs font-mono text-slate-500 pt-2">
                        <span>Turnaround: Under 12 Hours</span>
                        <span>Availability: Ready Stock</span>
                    </div>
                </div>
                <div class="lg:col-span-4 flex justify-center">
                    <div class="w-32 h-32 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-[#013d5a] dark:text-cyan-400">
                        <x-icon name="solid:arrows-rotate" class="w-16 h-16" />
                    </div>
                </div>
            </div>

            <!-- Service 4: Ultrasonic Cleaning -->
            <div id="ultrasonic" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center p-8 rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="lg:col-span-8 space-y-4">
                    <span class="text-xs font-mono font-bold text-[#013d5a] dark:text-cyan-400 uppercase tracking-wider">04 &bull; DE-CARBONIZATION</span>
                    <h2 class="text-2xl font-bold font-heading text-slate-900 dark:text-white">Heated Ultrasonic Chemical Cleaning</h2>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Abrasive blasting can score finely ground bearing journals and labyrinth seals. Our automated multi-stage ultrasonic baths use specialized chemical surfactants and 40 kHz cavitation waves to lift baked heavy fuel oil carbon without altering metal surface finish.
                    </p>
                    <div class="flex items-center gap-4 text-xs font-mono text-slate-500 pt-2">
                        <span>Frequency: 40 kHz Cavitation</span>
                        <span>Safe: Zero Mechanical Abrasion</span>
                    </div>
                </div>
                <div class="lg:col-span-4 flex justify-center">
                    <div class="w-32 h-32 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-[#013d5a] dark:text-cyan-400">
                        <x-icon name="solid:spray-can" class="w-16 h-16" />
                    </div>
                </div>
            </div>

            <!-- Service 5: Port Flying Squads -->
            <div id="flying-squad" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center p-8 rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="lg:col-span-8 space-y-4">
                    <span class="text-xs font-mono font-bold text-[#013d5a] dark:text-cyan-400 uppercase tracking-wider">05 &bull; 24/7 PORT RESPONSE</span>
                    <h2 class="text-2xl font-bold font-heading text-slate-900 dark:text-white">Emergency Port Flying Squads to Vessel</h2>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Our marine engineers are on 24/7 standby equipped with portable vibration analyzers, boroscopes, and hydraulic extractors. We board vessels at Chattogram, Mongla, or international outer anchorages to perform in-situ inspections, emergency bearing renewals, or complete turbocharger dismounts.
                    </p>
                    <div class="flex items-center gap-4 text-xs font-mono text-slate-500 pt-2">
                        <span>Response: 45 Min Dispatch</span>
                        <span>Hotline: +880 1800-000000</span>
                    </div>
                </div>
                <div class="lg:col-span-4 flex justify-center">
                    <div class="w-32 h-32 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-[#013d5a] dark:text-cyan-400">
                        <x-icon name="solid:truck-fast" class="w-16 h-16" />
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Bottom CTA -->
    <div class="py-16 bg-white/90 dark:bg-[#07131e]/90 text-center">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8 space-y-4">
            <h2 class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-900 dark:text-white">Need an Emergency Port Squad or Overhaul Quotation?</h2>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 max-w-xl mx-auto">
                Submit your vessel particulars and our duty marine superintendent will get back to you immediately.
            </p>
            <a href="{{ route('contact') }}#rfq" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider text-white shadow-lg"
               style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color));">
                Request Instant RFQ &rarr;
            </a>
        </div>
    </div>

</x-layouts.frontend>
