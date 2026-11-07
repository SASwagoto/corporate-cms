<x-layouts.frontend title="Industrial Projects, Video & Photo Gallery">
    
    <!-- Hero Header (Transparent so background video is visible behind the title) -->
    <div class="py-16 sm:py-24 bg-transparent border-b border-slate-200/80 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            <span class="text-xs font-bold uppercase tracking-wider text-[#013d5a] dark:text-cyan-400 bg-white dark:bg-slate-900 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-800 shadow-2xs">
                Track Record &amp; Media
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold font-heading text-slate-900 dark:text-white mt-4 leading-tight drop-shadow-xs">
                Our Projects, Video &amp; Photo Gallery.
            </h1>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 max-w-3xl mt-4 leading-relaxed font-medium">
                Proven execution across international shipping fleets and heavy industrial captive utilities. Hover over videos for instant preview.
            </p>
        </div>
    </div>

    <!-- FEATURED PROJECTS -->
    <section id="projects" class="py-20 bg-slate-50 dark:bg-[#06121d] border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8 space-y-12">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[#013d5a] dark:text-cyan-400">Case Studies</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-900 dark:text-white">Delivered Marine &amp; Industrial Overhauls</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Project 1 -->
                <div class="rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-lg transition-all group">
                    <div class="h-48 bg-slate-900 relative overflow-hidden flex items-center justify-center">
                        <img src="{{ asset('assets/images/gallery/gallery-plant.webp') }}" alt="7.2 MW Plant Overhaul" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                        <div class="absolute bottom-3 left-4 right-4 flex justify-between text-[11px] font-bold text-white">
                            <span class="px-2 py-0.5 rounded bg-[#013d5a]">Power Generation</span>
                            <span class="text-cyan-400 font-mono">7.2 MW Plant</span>
                        </div>
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">Waukesha 900kW x 8 Gas Engine Overhaul</h3>
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                            Scheduled turnaround maintenance for 8 turbochargers at Ekhlus Spinning Mills Ltd. Zero operational stoppage achieved.
                        </p>
                    </div>
                </div>

                <!-- Project 2 -->
                <div class="rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-lg transition-all group">
                    <div class="h-48 bg-slate-900 relative overflow-hidden flex items-center justify-center">
                        <img src="{{ asset('assets/images/gallery/gallery-vessel.jpg') }}" alt="Marine Vessel" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                        <div class="absolute bottom-3 left-4 right-4 flex justify-between text-[11px] font-bold text-white">
                            <span class="px-2 py-0.5 rounded bg-[#013d5a]">Marine Fleet</span>
                            <span class="text-cyan-400 font-mono">45k DWT Vessel</span>
                        </div>
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">ABB TPL-77 Emergency Cartridge Swap</h3>
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                            Anchorage emergency response at Chattogram Port, resolving severe dynamic surging within 18 hours.
                        </p>
                    </div>
                </div>

                <!-- Project 3 -->
                <div class="rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-lg transition-all group">
                    <div class="h-48 bg-slate-900 relative overflow-hidden flex items-center justify-center">
                        <img src="{{ asset('assets/images/gallery/gallery-generator.webp') }}" alt="Industrial Compressors" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                        <div class="absolute bottom-3 left-4 right-4 flex justify-between text-[11px] font-bold text-white">
                            <span class="px-2 py-0.5 rounded bg-[#013d5a]">Industrial Terminal</span>
                            <span class="text-cyan-400 font-mono">Ariel Units</span>
                        </div>
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">Gas Compression Turbine Modernization</h3>
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                            Retrofitting legacy turbochargers with high-efficiency titanium impellers, reducing thermodynamic fuel consumption by 6.2%.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- VIDEO GALLERY WITH HOVER-TO-PLAY (Dana Group Inspired) -->
    <section id="videos" class="py-20 bg-white dark:bg-[#07131e] border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8 space-y-12">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[#013d5a] dark:text-cyan-400">Media Stream</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-900 dark:text-white">Video Gallery (Hover to Play)</h2>
                <p class="text-xs text-slate-500">Move your mouse over the cards below to preview our operations in motion. Click to play full video.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Video 1 -->
                <div class="rounded-3xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-xl transition-all flex flex-col justify-between group"
                     x-data="{ isHovered: false }">
                    <div class="relative aspect-video bg-black overflow-hidden flex items-center justify-center cursor-pointer"
                         @mouseenter="isHovered = true; $refs.vid1.play()"
                         @mouseleave="isHovered = false; $refs.vid1.pause(); $refs.vid1.currentTime = 0"
                         @click="$dispatch('open-video-modal', { title: 'Dynamic Rotor Balancing at 100,000 RPM (Schenck Rig Calibration)', embedUrl: 'https://www.youtube-nocookie.com/embed/5mGhWcKzDTo' })">
                        
                        <video x-ref="vid1" loop muted playsinline preload="metadata" 
                               class="w-full h-full object-cover">
                            <source src="{{ asset('assets/videos/background-marine.mp4') }}" type="video/mp4">
                        </video>

                        <img src="{{ asset('assets/images/gallery/gallery-balancing.webp') }}" 
                             alt="Balancing Video Poster"
                             x-show="!isHovered"
                             class="absolute inset-0 w-full h-full object-cover z-10 pointer-events-none transition-opacity duration-150" />

                        <div x-show="!isHovered" class="absolute inset-0 bg-slate-950/25 flex items-center justify-center transition-opacity pointer-events-none z-20">
                            <div class="w-12 h-12 rounded-full bg-white/95 text-[#013d5a] flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <x-icon name="solid:play" class="w-4 h-4 translate-x-0.5" />
                            </div>
                        </div>

                        <div class="absolute bottom-3 right-3 px-2 py-0.5 rounded bg-black/75 text-[10px] font-mono text-white pointer-events-none z-20">
                            0:24 HD &bull; Hover to Preview
                        </div>
                    </div>
                    <div class="p-5 space-y-3 flex-1 flex flex-col justify-between">
                        <div class="space-y-1.5">
                            <span class="text-[10px] font-bold text-[#013d5a] dark:text-cyan-400 uppercase tracking-widest">Schenck Dynamic Test</span>
                            <h4 class="text-sm font-bold font-heading text-slate-900 dark:text-white">100,000 RPM Dynamic Balancing Demonstration</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Computerized tolerance monitoring on Schenck hard-bearing system.</p>
                        </div>
                        <div class="pt-3 border-t border-slate-200/80 dark:border-slate-800 flex items-center justify-between text-xs">
                            <button type="button" 
                                    @click="$dispatch('open-video-modal', { title: 'Dynamic Rotor Balancing at 100,000 RPM (Schenck Rig Calibration)', embedUrl: 'https://www.youtube-nocookie.com/embed/5mGhWcKzDTo' })"
                                    class="inline-flex items-center gap-1.5 font-bold text-red-600 dark:text-red-400 hover:underline cursor-pointer">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                <span>Watch Full (YouTube)</span>
                            </button>
                            <a href="{{ route('services') }}#balancing" class="font-bold text-[#013d5a] dark:text-cyan-400 hover:underline">
                                Balancing Service &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Video 2 -->
                <div class="rounded-3xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-xl transition-all flex flex-col justify-between group"
                     x-data="{ isHovered: false }">
                    <div class="relative aspect-video bg-black overflow-hidden flex items-center justify-center cursor-pointer"
                         @mouseenter="isHovered = true; $refs.vid2.play()"
                         @mouseleave="isHovered = false; $refs.vid2.pause(); $refs.vid2.currentTime = 0"
                         @click="$dispatch('open-video-modal', { title: 'Emergency Vessel Boarding at Chattogram Outer Anchorage', embedUrl: 'https://www.youtube-nocookie.com/embed/X9cW23sT1tU' })">
                        
                        <video x-ref="vid2" loop muted playsinline preload="metadata" 
                               class="w-full h-full object-cover">
                            <source src="{{ asset('assets/videos/background-marine.mp4') }}" type="video/mp4">
                        </video>

                        <img src="{{ asset('assets/images/gallery/gallery-vessel.jpg') }}" 
                             alt="Vessel Boarding Video Poster"
                             x-show="!isHovered"
                             class="absolute inset-0 w-full h-full object-cover z-10 pointer-events-none transition-opacity duration-150" />

                        <div x-show="!isHovered" class="absolute inset-0 bg-slate-950/25 flex items-center justify-center transition-opacity pointer-events-none z-20">
                            <div class="w-12 h-12 rounded-full bg-white/95 text-[#013d5a] flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <x-icon name="solid:play" class="w-4 h-4 translate-x-0.5" />
                            </div>
                        </div>

                        <div class="absolute bottom-3 right-3 px-2 py-0.5 rounded bg-black/75 text-[10px] font-mono text-white pointer-events-none z-20">
                            0:32 HD &bull; Hover to Preview
                        </div>
                    </div>
                    <div class="p-5 space-y-3 flex-1 flex flex-col justify-between">
                        <div class="space-y-1.5">
                            <span class="text-[10px] font-bold text-[#013d5a] dark:text-cyan-400 uppercase tracking-widest">Port Logistics</span>
                            <h4 class="text-sm font-bold font-heading text-slate-900 dark:text-white">Emergency Vessel Boarding at Chattogram Outer Anchorage</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400">24/7 flying squad mobilization with mobile extraction tooling.</p>
                        </div>
                        <div class="pt-3 border-t border-slate-200/80 dark:border-slate-800 flex items-center justify-between text-xs">
                            <button type="button" 
                                    @click="$dispatch('open-video-modal', { title: 'Emergency Vessel Boarding at Chattogram Outer Anchorage', embedUrl: 'https://www.youtube-nocookie.com/embed/X9cW23sT1tU' })"
                                    class="inline-flex items-center gap-1.5 font-bold text-red-600 dark:text-red-400 hover:underline cursor-pointer">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                <span>Watch Full (YouTube)</span>
                            </button>
                            <a href="{{ route('projects') }}#projects" class="font-bold text-[#013d5a] dark:text-cyan-400 hover:underline">
                                Port Projects &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Video 3 -->
                <div class="rounded-3xl bg-slate-50 dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-xl transition-all flex flex-col justify-between group"
                     x-data="{ isHovered: false }">
                    <div class="relative aspect-video bg-black overflow-hidden flex items-center justify-center cursor-pointer"
                         @mouseenter="isHovered = true; $refs.vid3.play()"
                         @mouseleave="isHovered = false; $refs.vid3.pause(); $refs.vid3.currentTime = 0"
                         @click="$dispatch('open-video-modal', { title: 'Precision Micro-TIG Turbine Blade Reconstruction', embedUrl: 'https://www.youtube-nocookie.com/embed/bXQeM_6rVMo' })">
                        
                        <video x-ref="vid3" loop muted playsinline preload="metadata" 
                               class="w-full h-full object-cover">
                            <source src="{{ asset('assets/videos/background-marine.mp4') }}" type="video/mp4">
                        </video>

                        <img src="{{ asset('assets/images/gallery/gallery-welding.webp') }}" 
                             alt="Welding Video Poster"
                             x-show="!isHovered"
                             class="absolute inset-0 w-full h-full object-cover z-10 pointer-events-none transition-opacity duration-150" />

                        <div x-show="!isHovered" class="absolute inset-0 bg-slate-950/25 flex items-center justify-center transition-opacity pointer-events-none z-20">
                            <div class="w-12 h-12 rounded-full bg-white/95 text-[#013d5a] flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <x-icon name="solid:play" class="w-4 h-4 translate-x-0.5" />
                            </div>
                        </div>

                        <div class="absolute bottom-3 right-3 px-2 py-0.5 rounded bg-black/75 text-[10px] font-mono text-white pointer-events-none z-20">
                            0:18 HD &bull; Hover to Preview
                        </div>
                    </div>
                    <div class="p-5 space-y-3 flex-1 flex flex-col justify-between">
                        <div class="space-y-1.5">
                            <span class="text-[10px] font-bold text-[#013d5a] dark:text-cyan-400 uppercase tracking-widest">Metallurgical Restoration</span>
                            <h4 class="text-sm font-bold font-heading text-slate-900 dark:text-white">Micro-TIG Turbine Blade Reconstruction</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Laser-aligned profiling of high-temperature Nimonic blades.</p>
                        </div>
                        <div class="pt-3 border-t border-slate-200/80 dark:border-slate-800 flex items-center justify-between text-xs">
                            <button type="button" 
                                    @click="$dispatch('open-video-modal', { title: 'Precision Micro-TIG Turbine Blade Reconstruction', embedUrl: 'https://www.youtube-nocookie.com/embed/bXQeM_6rVMo' })"
                                    class="inline-flex items-center gap-1.5 font-bold text-red-600 dark:text-red-400 hover:underline cursor-pointer">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                <span>Watch Full (YouTube)</span>
                            </button>
                            <a href="{{ route('services') }}#overhaul" class="font-bold text-[#013d5a] dark:text-cyan-400 hover:underline">
                                Welding Service &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PHOTO GALLERY (8 Distinct Authentic Overhaul Photographs) -->
    <section id="photos" class="py-20 bg-slate-50 dark:bg-[#06121d] transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8 space-y-12">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[#013d5a] dark:text-cyan-400">Facilities</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-900 dark:text-white">Photo Gallery &amp; Workshops</h2>
                <p class="text-xs text-slate-500">Click any photograph to view high-resolution facility inspection.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                
                <!-- Photo 1: Dynamic Balancing -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-balancing.webp') }}', title: 'Dynamic Rotor Balancing Bay (Schenck Hard-Bearing Calibrated)' })">
                    <img src="{{ asset('assets/images/gallery/gallery-balancing.webp') }}" alt="Balancing Bay" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>
                    <div class="absolute bottom-3 left-3 right-3 text-white text-xs font-bold">Dynamic Balancing Bay</div>
                </div>

                <!-- Photo 2: Blade Welding -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-welding.webp') }}', title: 'Micro-TIG Turbine Blade Reconstruction Bay' })">
                    <img src="{{ asset('assets/images/gallery/gallery-welding.webp') }}" alt="Welding Bay" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>
                    <div class="absolute bottom-3 left-3 right-3 text-white text-xs font-bold">Turbine Blade Welding</div>
                </div>

                <!-- Photo 3: CHRA Cartridge Assembly -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-turbine.webp') }}', title: 'Heavy Turbocharger Cartridge (CHRA) Assembly' })">
                    <img src="{{ asset('assets/images/gallery/gallery-turbine.webp') }}" alt="CHRA Assembly" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>
                    <div class="absolute bottom-3 left-3 right-3 text-white text-xs font-bold">CHRA Cartridge Assembly</div>
                </div>

                <!-- Photo 4: Captive Power Plant -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-plant.webp') }}', title: '7.2 MW Captive Power Plant Turbomachinery Overhaul' })">
                    <img src="{{ asset('assets/images/gallery/gallery-plant.webp') }}" alt="Power Plant" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>
                    <div class="absolute bottom-3 left-3 right-3 text-white text-xs font-bold">Captive Power Plant</div>
                </div>

                <!-- Photo 5: Generator Turbochargers -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-generator.webp') }}', title: 'Industrial Diesel & Gas Generator Turbochargers' })">
                    <img src="{{ asset('assets/images/gallery/gallery-generator.webp') }}" alt="Generator Turbochargers" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>
                    <div class="absolute bottom-3 left-3 right-3 text-white text-xs font-bold">Generator Overhauls</div>
                </div>

                <!-- Photo 6: Vessel Port Call -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-vessel.jpg') }}', title: 'Chattogram Port Anchorage Vessel Flying Squad' })">
                    <img src="{{ asset('assets/images/gallery/gallery-vessel.jpg') }}" alt="Vessel Port Call" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>
                    <div class="absolute bottom-3 left-3 right-3 text-white text-xs font-bold">Anchorage Port Call</div>
                </div>

                <!-- Photo 7: NDT Inspection -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-technician.jpg') }}', title: 'Non-Destructive Metallurgical Flaw Detection & Testing' })">
                    <img src="{{ asset('assets/images/gallery/gallery-technician.jpg') }}" alt="NDT Inspection" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>
                    <div class="absolute bottom-3 left-3 right-3 text-white text-xs font-bold">ASNT Level III NDT</div>
                </div>

                <!-- Photo 8: Turbine Power Diagnostics -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer"
                     @click="$dispatch('open-lightbox', { src: '{{ asset('assets/images/gallery/gallery-substation.webp') }}', title: 'Industrial Turbine Power Substation Diagnostics' })">
                    <img src="{{ asset('assets/images/gallery/gallery-substation.webp') }}" alt="Power Diagnostics" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>
                    <div class="absolute bottom-3 left-3 right-3 text-white text-xs font-bold">Substation Diagnostics</div>
                </div>

            </div>
        </div>
    </section>

</x-layouts.frontend>
