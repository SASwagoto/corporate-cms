<x-layouts.frontend title="Contact & 24/7 Port Duty Desk">
    
    <!-- Hero Header (Transparent so background video is visible behind the title) -->
    <div class="py-16 sm:py-24 bg-transparent border-b border-slate-200/80 dark:border-slate-800 transition-colors">
        <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
            <span class="text-xs font-bold uppercase tracking-wider text-[#013d5a] dark:text-cyan-400 bg-white dark:bg-slate-900 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-800 shadow-2xs">
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
                        <span class="text-xs font-bold uppercase tracking-widest text-[#013d5a] dark:text-cyan-400">Primary Workshop</span>
                        <h3 class="text-xl font-bold font-heading text-slate-900 dark:text-white">Chattogram Port Facility</h3>
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                            Near Marine Academy Jetty &bull; Port of Chattogram, Bangladesh.<br>
                            Equipped with heavy overhead gantry cranes, Schenck dynamic balancing benches, and ultrasonic clean bays.
                        </p>
                        <div class="pt-2 text-xs space-y-2 font-mono">
                            <div class="text-[#013d5a] dark:text-cyan-400 font-bold">Duty Superintendent: +880 1800-000000</div>
                            <div class="text-slate-500">Email: port.ops@nordroy.com</div>
                        </div>
                    </div>

                    <div class="p-8 rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                        <span class="text-xs font-bold uppercase tracking-widest text-[#013d5a] dark:text-cyan-400">Headquarters</span>
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
                            <span class="text-xs font-bold uppercase tracking-widest text-[#013d5a] dark:text-cyan-400">Instant Inquiry</span>
                            <h3 class="text-2xl font-bold font-heading text-slate-900 dark:text-white">Request Quotation / Port Squad</h3>
                        </div>

                        <form action="#" method="POST" class="space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Vessel or Plant Name</label>
                                    <input type="text" placeholder="e.g. M/V Nordroy Carrier" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Turbocharger Model</label>
                                    <input type="text" placeholder="e.g. ABB TPL-77 or MAN TCR22" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Port Location</label>
                                    <input type="text" placeholder="Chattogram Port / Mongla / Other" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Urgency</label>
                                    <select class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none">
                                        <option>Standard Planned Maintenance</option>
                                        <option>Urgent Port Turnaround (< 48h)</option>
                                        <option>Vessel Blackout Emergency</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Contact Email &amp; Phone</label>
                                <input type="text" placeholder="ops@shipping.com / +880 1800-000000" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none" />
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Work Scope &amp; Symptoms</label>
                                <textarea rows="3" placeholder="Provide details of required overhaul, vibration measurements, or parts needed..." class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#013d5a]/40 focus:outline-none"></textarea>
                            </div>

                            <button type="button" class="w-full py-3.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white shadow-md active:scale-95 transition-all"
                                    style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color));">
                                Transmit RFQ to 24/7 Port Duty Desk
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-layouts.frontend>
