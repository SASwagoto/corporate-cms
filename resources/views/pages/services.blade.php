<x-layouts.frontend title="Precision Overhaul Services & Dynamic Balancing">
    
    <!-- Hero Header (Transparent so background video is visible behind the title) -->
    <div class="py-16 sm:py-24 bg-transparent border-b border-slate-200/80 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            <span class="text-xs font-bold uppercase tracking-wider text-[#003C58] dark:text-cyan-400 bg-white dark:bg-slate-900 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-800 shadow-2xs">
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
        @php
            $services = \App\Models\Service::with('featuredImage')
                ->where('is_active', true)
                ->orderBy('order', 'asc')
                ->get();
        @endphp

        <div class="max-w-[1536px] mx-auto px-4 sm:px-8 space-y-16">
            @forelse ($services as $index => $service)
                <!-- Dynamic Service {{ $index + 1 }} -->
                <div id="{{ $service->slug }}" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center p-8 rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm">
                    <div class="lg:col-span-8 space-y-4">
                        <span class="text-xs font-mono font-bold text-[#003C58] dark:text-cyan-400 uppercase tracking-wider">
                            {{ sprintf('%02d', $index + 1) }} &bull; {{ strtoupper(str_replace('-', ' ', explode('-', $service->slug)[0] ?? 'OVERHAUL')) }}
                        </span>
                        <h2 class="text-2xl font-bold font-heading text-slate-900 dark:text-white">
                            {{ $service->display_title }}
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                            {{ $service->display_content ?: $service->display_summary }}
                        </p>
                    </div>
                    <div class="lg:col-span-4 flex justify-center">
                        @if ($service->featuredImage)
                            <div class="rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-md aspect-video w-full">
                                <img src="{{ $service->featuredImage->url }}" alt="{{ $service->display_title }}" class="w-full h-full object-cover" />
                            </div>
                        @else
                            <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-[#003C58] dark:text-cyan-400 shadow-inner">
                                <x-icon :name="$service->icon ?: 'solid:wrench'" class="w-14 h-14" />
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-12 text-center text-slate-400">
                    <p class="text-sm">No active services currently published.</p>
                </div>
            @endforelse
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
