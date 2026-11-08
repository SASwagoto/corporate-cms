<x-layouts.frontend>
    <x-slot:title>{{ $project['title'] }} | Case Study | {{ \App\Models\Setting::get('site_name', 'Nordroy Marine & Turbochargers') }}</x-slot:title>

    <!-- =====================================================================
         BREADCRUMBS & PROJECT TITLE HERO SECTION (Dana Group BD Style)
         ===================================================================== -->
    <section class="pt-28 pb-8 sm:pb-12 bg-white dark:bg-[#07131e] border-b border-slate-200 dark:border-slate-800 transition-colors duration-200">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8 space-y-4">
            
            <!-- Breadcrumbs Navigation -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500 dark:text-slate-400" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">Home</a>
                <span class="text-slate-300 dark:text-slate-600">/</span>
                <a href="{{ route('projects') }}" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">Projects</a>
                <span class="text-slate-300 dark:text-slate-600">/</span>
                <span class="text-slate-800 dark:text-slate-200 truncate max-w-xs sm:max-w-md">{{ $project['title'] }}</span>
            </nav>

            <!-- Badges & Title -->
            <div class="space-y-3 pt-2">
                <div class="flex flex-wrap items-center gap-2.5">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#003C58]/10 dark:bg-cyan-500/10 text-[#003C58] dark:text-cyan-400 border border-[#003C58]/20 dark:border-cyan-500/20">
                        {{ $project['category'] }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-800">
                        {{ $project['classification'] }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-500/10 border border-emerald-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                        {{ $project['status'] }}
                    </span>
                </div>

                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black font-heading tracking-tight text-slate-900 dark:text-white leading-tight">
                    {{ $project['title'] }}
                </h1>

                <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 max-w-4xl leading-relaxed">
                    {{ $project['subtitle'] }}
                </p>
            </div>

        </div>
    </section>

    <!-- =====================================================================
         MAIN YOUTUBE VIDEO SHOWCASE (Full Page Player - Dana Group BD Reference)
         ===================================================================== -->
    <section class="py-8 sm:py-12 bg-slate-100 dark:bg-slate-950 border-b border-slate-200 dark:border-slate-800 transition-colors duration-200">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            <div class="rounded-3xl overflow-hidden border border-slate-300/80 dark:border-slate-800 shadow-2xl bg-black relative">
                
                <!-- Video Top Bar Info -->
                <div class="px-5 py-3.5 bg-slate-100 dark:bg-slate-900 text-slate-900 dark:text-white flex items-center justify-between border-b border-slate-200 dark:border-slate-800 text-xs">
                    <div class="flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-600"></span>
                        <span class="font-bold tracking-wider uppercase font-mono text-cyan-400">Engineering Documentation Video</span>
                        <span class="text-slate-400 hidden sm:inline">&bull; 1080p Full HD Audio &amp; Video</span>
                    </div>
                    <a href="https://www.youtube.com/watch?v={{ $project['youtube_id'] }}" target="_blank" rel="noopener noreferrer" 
                       class="text-xs text-slate-600 dark:text-slate-300 hover:text-[#003C58] dark:hover:text-white inline-flex items-center gap-1 font-semibold hover:underline">
                        <span>Watch on YouTube</span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                    </a>
                </div>

                <!-- Responsive 16:9 YouTube Iframe Container -->
                <div class="relative w-full pb-[56.25%] bg-black">
                    <iframe 
                        src="{{ $project['youtube_url'] }}" 
                        title="{{ $project['title'] }}"
                        class="absolute top-0 left-0 w-full h-full border-0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen>
                    </iframe>
                </div>

                <!-- Video Caption Footer -->
                <div class="p-4 sm:p-5 bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                    <div class="flex items-center gap-3 text-slate-600 dark:text-slate-300">
                        <span class="font-bold text-[#003C58] dark:text-cyan-400 uppercase tracking-wider">Project ID:</span>
                        <span class="font-mono">{{ strtoupper(str_replace('-', '', substr($project['slug'], 0, 8))) }}-{{ $project['year'] }}</span>
                        <span class="text-slate-400">&bull;</span>
                        <span>Location: <strong>{{ $project['location'] }}</strong></span>
                    </div>
                    <div class="flex items-center gap-4 text-slate-500 dark:text-slate-400">
                        <span>Client: <strong class="text-slate-800 dark:text-white">{{ $project['client'] }}</strong></span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =====================================================================
         DETAILED CASE STUDY CONTENT (2 Columns: 8 cols left / 4 cols right)
         ===================================================================== -->
    <section class="py-12 sm:py-16 bg-white dark:bg-[#07131e] transition-colors duration-200">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                
                <!-- LEFT COLUMN: Case Study Narrative, Key Metrics, Scope & Photos (8 cols) -->
                <div class="lg:col-span-8 space-y-10 sm:space-y-12">
                    
                    <!-- 1. Executive Summary & Overview -->
                    <div class="space-y-4">
                        <h2 class="text-xl sm:text-2xl font-bold font-heading text-slate-900 dark:text-white flex items-center gap-3">
                            <span class="w-1.5 h-6 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                            Project Overview &amp; Operational Context
                        </h2>
                        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                            {{ $project['overview'] }}
                        </p>
                    </div>

                    <!-- 2. Key Metrics & Impact Grid (4 Cards) -->
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">Engineering Performance Metrics</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            @foreach($project['metrics'] as $metric)
                                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800 space-y-1">
                                    <span class="text-2xl sm:text-3xl font-black font-heading text-[#003C58] dark:text-cyan-400">
                                        {{ $metric['value'] }}
                                    </span>
                                    <h4 class="text-xs font-bold text-slate-800 dark:text-white">{{ $metric['label'] }}</h4>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-snug">{{ $metric['detail'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 3. The Challenge vs The Solution -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-6 rounded-2xl bg-red-50/50 dark:bg-red-950/20 border border-red-200/60 dark:border-red-900/40 space-y-3">
                            <div class="flex items-center gap-2 text-red-700 dark:text-red-400 font-bold text-xs uppercase tracking-wider">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                <span>The Engineering Challenge</span>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed">
                                {{ $project['challenge'] }}
                            </p>
                        </div>

                        <div class="p-6 rounded-2xl bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-200/60 dark:border-emerald-900/40 space-y-3">
                            <div class="flex items-center gap-2 text-emerald-700 dark:text-emerald-400 font-bold text-xs uppercase tracking-wider">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <span>Engineered Remediation</span>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed">
                                {{ $project['solution'] }}
                            </p>
                        </div>
                    </div>

                    <!-- 4. Scope of Technical Deliverables -->
                    <div class="space-y-4">
                        <h2 class="text-xl sm:text-2xl font-bold font-heading text-slate-900 dark:text-white flex items-center gap-3">
                            <span class="w-1.5 h-6 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                            Scope of Technical Work &amp; Overhaul Steps
                        </h2>
                        
                        <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800">
                            <ul class="space-y-3 text-xs sm:text-sm text-slate-700 dark:text-slate-300">
                                @foreach($project['scope_items'] as $item)
                                    <li class="flex items-start gap-3">
                                        <span class="w-5 h-5 rounded-full bg-[#003C58]/10 dark:bg-cyan-500/20 text-[#003C58] dark:text-cyan-400 flex items-center justify-center shrink-0 mt-0.5">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                        </span>
                                        <span class="leading-relaxed">{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- 5. Photographic Evidence Gallery (Dana Group BD Style) -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl sm:text-2xl font-bold font-heading text-slate-900 dark:text-white flex items-center gap-3">
                                <span class="w-1.5 h-6 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                                Photographic Documentation
                            </h2>
                            <span class="text-xs text-slate-400">Click photo to enlarge</span>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
                            @foreach($project['gallery'] as $idx => $photo)
                                <div class="group relative rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800 aspect-4/3 cursor-pointer bg-slate-100 dark:bg-slate-900"
                                     @click="$dispatch('open-lightbox', { src: '{{ asset($photo) }}', title: 'Job Photo #{{ $idx + 1 }} - {{ $project['title'] }}' })">
                                    <img src="{{ asset($photo) }}" alt="Project Photo {{ $idx + 1 }}" 
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                                         loading="lazy" />
                                    <div class="absolute inset-0 bg-[#003C58]/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <span class="px-2.5 py-1 rounded-lg bg-white/90 dark:bg-black/70 text-slate-900 dark:text-white text-[10px] font-bold uppercase tracking-wider backdrop-blur-md border border-slate-200/80 dark:border-transparent shadow-sm">
                                            View Photo &rarr;
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN: Project Quick Facts & Action Card (4 cols) -->
                <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-28">
                    
                    <!-- Quick Facts Card -->
                    <div class="p-6 rounded-3xl bg-slate-50 dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-md space-y-5">
                        <div class="border-b border-slate-200 dark:border-slate-800 pb-3 flex items-center justify-between">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#003C58] dark:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                <span>Project Specifications</span>
                            </h3>
                            <span class="text-[10px] font-mono font-bold text-slate-400">{{ $project['year'] }}</span>
                        </div>

                        <dl class="space-y-3.5 text-xs">
                            <div class="flex items-start justify-between gap-3 border-b border-slate-100 dark:border-slate-800/80 pb-2.5">
                                <dt class="text-slate-400 font-medium">Client</dt>
                                <dd class="font-bold text-slate-800 dark:text-white text-right">{{ $project['client'] }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-3 border-b border-slate-100 dark:border-slate-800/80 pb-2.5">
                                <dt class="text-slate-400 font-medium">Location / Port</dt>
                                <dd class="font-bold text-slate-800 dark:text-white text-right">{{ $project['location'] }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-3 border-b border-slate-100 dark:border-slate-800/80 pb-2.5">
                                <dt class="text-slate-400 font-medium">Industry Sector</dt>
                                <dd class="font-bold text-slate-800 dark:text-white text-right">{{ $project['sector'] }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-3 border-b border-slate-100 dark:border-slate-800/80 pb-2.5">
                                <dt class="text-slate-400 font-medium">Equipment Rating</dt>
                                <dd class="font-bold text-[#003C58] dark:text-cyan-400 text-right">{{ $project['capacity'] }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-3 border-b border-slate-100 dark:border-slate-800/80 pb-2.5">
                                <dt class="text-slate-400 font-medium">Execution Window</dt>
                                <dd class="font-bold text-slate-800 dark:text-white text-right">{{ $project['duration'] }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-3 border-b border-slate-100 dark:border-slate-800/80 pb-2.5">
                                <dt class="text-slate-400 font-medium">Classification</dt>
                                <dd class="font-bold text-slate-800 dark:text-white text-right">{{ $project['classification'] }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-3">
                                <dt class="text-slate-400 font-medium">Project Status</dt>
                                <dd class="font-bold text-emerald-600 dark:text-emerald-400 text-right">{{ $project['status'] }}</dd>
                            </div>
                        </dl>

                        <div class="pt-2">
                            <a href="{{ route('contact') }}?subject={{ urlencode('Inquiry regarding ' . $project['title']) }}"
                               class="w-full py-3 px-4 rounded-xl font-bold text-xs uppercase tracking-wider text-center block bg-[#003C58] hover:bg-[#024a6d] text-white shadow-md transition-all">
                                Request Similar Overhaul Quote
                            </a>
                        </div>
                    </div>

                    <!-- 24/7 Port Call & Urgent Assistance Box -->
                    <div class="p-6 rounded-3xl bg-linear-to-br from-[#003C58] to-[#042436] text-white space-y-4 shadow-xl">
                        <div class="flex items-center gap-2.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-cyan-400"></span>
                            <span class="text-xs font-extrabold uppercase tracking-widest text-cyan-300">24/7 Port Call Squad</span>
                        </div>
                        <h4 class="text-base font-bold font-heading">Need Urgent Flying Squad or Dynamic Balancing?</h4>
                        <p class="text-xs text-slate-200 leading-relaxed">
                            Our mobile engineering squads mobilize within 2-4 hours for maritime anchorage and industrial plants across Bangladesh and Southeast Asia.
                        </p>
                        <div class="pt-2 space-y-2">
                            <a href="tel:{{ \App\Models\Setting::get('contact_phone', '+880 1800-TURBO') }}" 
                               class="w-full py-2.5 px-3 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 flex items-center justify-center gap-2 text-xs font-bold transition-all">
                                <svg class="w-4 h-4 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                <span>{{ \App\Models\Setting::get('contact_phone', '+880 1800-TURBO') }}</span>
                            </a>
                            <a href="{{ route('contact') }}"
                               class="w-full py-2.5 px-3 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs uppercase tracking-wider text-center block transition-all">
                                Contact Engineering Team &rarr;
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- =====================================================================
         RELATED CASE STUDIES / OTHER PROJECTS (Dana Group BD Style)
         ===================================================================== -->
    <section class="py-12 sm:py-16 bg-slate-50 dark:bg-slate-950 border-t border-slate-200 dark:border-slate-800 transition-colors duration-200">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8 space-y-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#003C58] dark:text-cyan-400">Portfolio</span>
                    <h2 class="text-2xl sm:text-3xl font-black font-heading tracking-tight text-slate-900 dark:text-white mt-1">
                        Other Featured Case Studies
                    </h2>
                </div>
                <a href="{{ route('projects') }}" class="text-xs font-bold text-[#003C58] dark:text-cyan-400 hover:underline inline-flex items-center gap-1.5">
                    <span>View All Projects</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $pSlug => $otherProject)
                    @if($pSlug !== $project['slug'])
                        <div class="group rounded-3xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                            <div class="relative aspect-16/10 overflow-hidden bg-slate-100 dark:bg-slate-900">
                                <img src="{{ asset($otherProject['featured_image']) }}" alt="{{ $otherProject['title'] }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white/90 dark:bg-black/60 text-slate-900 dark:text-white backdrop-blur-md border border-slate-200/80 dark:border-transparent shadow-sm">
                                        {{ $otherProject['category'] }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                                <div class="space-y-2">
                                    <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white group-hover:text-[#003C58] dark:group-hover:text-cyan-400 transition-colors line-clamp-2">
                                        {{ $otherProject['title'] }}
                                    </h3>
                                    <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                        {{ $otherProject['subtitle'] }}
                                    </p>
                                </div>

                                <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs">
                                    <span class="text-slate-400">{{ $otherProject['location'] }}</span>
                                    <a href="{{ route('project.details', ['slug' => $pSlug]) }}"
                                       class="font-bold text-[#003C58] dark:text-cyan-400 inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                        <span>View Case Study</span>
                                        <span>&rarr;</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

</x-layouts.frontend>
