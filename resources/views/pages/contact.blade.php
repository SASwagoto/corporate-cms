<x-layouts.frontend title="Contact & 24/7 Port Duty Desk">
    
    <!-- Hero Header (Transparent so background video is visible behind the title) -->
    <div class="py-16 sm:py-24 bg-transparent border-b border-slate-200/80 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            <span class="text-xs font-bold uppercase tracking-wider text-[#003C58] dark:text-cyan-400 bg-white dark:bg-slate-900 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-800 shadow-2xs">
                Port Response &amp; Headquarters
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold font-heading text-slate-900 dark:text-white mt-4 leading-tight drop-shadow-xs">
                Contact &amp; 24/7 Marine Duty Desk.
            </h1>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 max-w-3xl mt-4 leading-relaxed font-medium">
                Connect directly with our port superintendent engineers for immediate vessel assistance, dynamic balancing bookings, and genuine spare parts quotes.
            </p>
        </div>
    </div>

    <!-- Contact & RFQ Grid -->
    <section id="rfq" class="py-20 bg-slate-50 dark:bg-[#06121d]">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left: Offices & Hotlines (5 cols) -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="p-8 rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                        <span class="text-xs font-bold uppercase tracking-widest text-[#003C58] dark:text-cyan-400">Primary Workshop</span>
                        <h3 class="text-xl font-bold font-heading text-slate-900 dark:text-white">Chattogram Port Facility</h3>
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                            Near Marine Academy Jetty &bull; Port of Chattogram, Bangladesh.<br>
                            Equipped with heavy overhead gantry cranes, Schenck dynamic balancing benches, and ultrasonic clean bays.
                        </p>
                        <div class="pt-2 text-xs space-y-2 font-mono">
                            <div class="text-[#003C58] dark:text-cyan-400 font-bold">Duty Superintendent: +880 1800-000000</div>
                            <div class="text-slate-500">Email: port.ops@nordroy.com</div>
                        </div>
                    </div>

                    <div class="p-8 rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                        <span class="text-xs font-bold uppercase tracking-widest text-[#003C58] dark:text-cyan-400">Headquarters</span>
                        <h3 class="text-xl font-bold font-heading text-slate-900 dark:text-white">Dhaka Corporate HQ</h3>
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                            {{ \App\Models\Setting::get('company_address', 'Gulshan Industrial Area, Dhaka, Bangladesh') }}
                        </p>
                        <div class="pt-2 text-xs space-y-2 font-mono">
                            <div class="text-slate-700 dark:text-slate-300">Desk: +880 1700-000000</div>
                            <div class="text-slate-500">Email: {{ \App\Models\Setting::get('contact_email', 'operations@nordroy.com') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Right: RFQ Form (7 cols) -->
                <div class="lg:col-span-7">
                    <div class="p-8 sm:p-10 rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-xl space-y-6">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest text-[#003C58] dark:text-cyan-400">Instant Inquiry</span>
                            <h3 class="text-2xl font-bold font-heading text-slate-900 dark:text-white">Request Quotation / Port Squad</h3>
                        </div>

                        <livewire:frontend.rfq-lead-form />
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-layouts.frontend>
