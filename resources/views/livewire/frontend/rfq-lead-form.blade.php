<div>
    @if ($isSubmitted)
        <!-- SUCCESS CONFIRMATION STATE -->
        <div class="p-8 sm:p-10 rounded-2xl bg-emerald-50/70 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-800/50 text-center space-y-6 transition-all duration-300">
            <div class="w-16 h-16 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 mx-auto flex items-center justify-center border border-emerald-500/20">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <div class="space-y-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-mono font-bold bg-emerald-600 text-white shadow-sm">
                    <span>REFERENCE CODE:</span>
                    <span class="tracking-wider">{{ $referenceCode }}</span>
                </span>
                <h3 class="text-xl sm:text-2xl font-bold font-heading text-slate-900 dark:text-white pt-2">
                    Technical RFQ Successfully Transmitted
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 max-w-lg mx-auto leading-relaxed">
                    Our duty marine engineering superintendents and flying squad coordinators at Chattogram &amp; Mongla have received your inquiry.
                </p>
            </div>

            <!-- Response SLA Indicator -->
            <div class="max-w-md mx-auto p-4 rounded-xl bg-white/80 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800 text-left space-y-2 text-xs">
                <div class="flex items-center justify-between text-[11px] font-mono">
                    <span class="text-slate-500 dark:text-slate-400 uppercase">Duty Desk Protocol:</span>
                    <span class="text-emerald-600 dark:text-emerald-400 font-bold flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Response within 45 Mins
                    </span>
                </div>
                <div class="grid grid-cols-2 gap-2 pt-2 border-t border-slate-100 dark:border-slate-800 font-mono text-[11px]">
                    <div>
                        <span class="text-slate-400 block text-[10px]">VESSEL / PLANT:</span>
                        <span class="font-bold text-slate-800 dark:text-slate-200 truncate block">{{ $submittedData['vessel'] ?? '' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">EQUIPMENT:</span>
                        <span class="font-bold text-slate-800 dark:text-slate-200 truncate block">{{ $submittedData['model'] ?? '' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">LOCATION:</span>
                        <span class="font-bold text-slate-800 dark:text-slate-200 truncate block">{{ $submittedData['port'] ?? '' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">URGENCY:</span>
                        <span class="font-bold text-amber-600 dark:text-amber-400 truncate block">{{ $submittedData['urgency'] ?? '' }}</span>
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="button" 
                        wire:click="resetForm" 
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider bg-slate-900 text-white dark:bg-white dark:text-slate-950 hover:opacity-90 transition-all cursor-pointer shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>Submit Another Inquiry</span>
                </button>
            </div>
        </div>

    @else
        <!-- ACTIVE FORM -->
        <form wire:submit.prevent="submitRfq" class="space-y-4">
            
            <!-- Honeypot -->
            <div class="hidden" aria-hidden="true">
                <input type="text" wire:model="extra_honey" tabindex="-1" autocomplete="off" />
            </div>

            <!-- Row 1: Contact Personnel -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                        Contact Person / Superintendent <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           wire:model="full_name" 
                           placeholder="Capt. / Engr. Full Name" 
                           class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border @error('full_name') border-rose-500 @else border-slate-200 dark:border-slate-800 @enderror text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none transition-colors" />
                    @error('full_name')
                        <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                        Corporate / Shipping Line Company
                    </label>
                    <input type="text" 
                           wire:model="company" 
                           placeholder="e.g. Pacific Bulk Logistics Ltd." 
                           class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none transition-colors" />
                </div>
            </div>

            <!-- Row 2: Communication Channels -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                        Technical Email <span class="text-rose-500">*</span>
                    </label>
                    <input type="email" 
                           wire:model="email" 
                           placeholder="technical.ops@shipping-company.com" 
                           class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border @error('email') border-rose-500 @else border-slate-200 dark:border-slate-800 @enderror text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none transition-colors" />
                    @error('email')
                        <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                        Phone / WhatsApp (Direct Dispatch) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           wire:model="phone" 
                           placeholder="+880 1800-000000 / International format" 
                           class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border @error('phone') border-rose-500 @else border-slate-200 dark:border-slate-800 @enderror text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none transition-colors" />
                    @error('phone')
                        <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Row 3: Vessel & Equipment Identification -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                        Vessel / Power Plant Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           wire:model="vessel_plant_name" 
                           placeholder="e.g. M/V Nordroy Carrier or Unit 3 Turbine" 
                           class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border @error('vessel_plant_name') border-rose-500 @else border-slate-200 dark:border-slate-800 @enderror text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none transition-colors" />
                    @error('vessel_plant_name')
                        <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                        Turbocharger Model &amp; Serial <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           wire:model="turbocharger_model" 
                           placeholder="e.g. ABB TPL-77, MAN TCR22, Napier NA297" 
                           class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border @error('turbocharger_model') border-rose-500 @else border-slate-200 dark:border-slate-800 @enderror text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none transition-colors" />
                    @error('turbocharger_model')
                        <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Row 4: Operational Coordinates -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                        Port / Facility Location <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           wire:model="port_location" 
                           placeholder="Chattogram / Mongla / Anchorage" 
                           class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none transition-colors" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                        Required Service <span class="text-rose-500">*</span>
                    </label>
                    <select wire:model="service_required" 
                            class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none transition-colors">
                        <option value="Complete Overhaul & Dynamic Balancing">Complete Overhaul &amp; Dynamic Balancing</option>
                        <option value="CHRA Cartridge Exchange">CHRA Cartridge Exchange</option>
                        <option value="Emergency Flying Squad to Vessel">Emergency Flying Squad to Vessel</option>
                        <option value="Spare Parts Purchase">Spare Parts Purchase</option>
                        <option value="NDT Metallurgical Inspection">NDT Metallurgical Inspection</option>
                        <option value="Retrofit & Performance Upgrade">Retrofit &amp; Performance Upgrade</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                        Urgency Level <span class="text-rose-500">*</span>
                    </label>
                    <select wire:model="urgency" 
                            class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none transition-colors">
                        <option value="Standard Scheduled Maintenance">Standard Scheduled Maintenance</option>
                        <option value="Urgent Port Call (Within 48h)">Urgent Port Call (Within 48h)</option>
                        <option value="Emergency Vessel Blackout / AOG">Emergency Vessel Blackout / AOG</option>
                    </select>
                </div>
            </div>

            <!-- Technical Symptoms -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                    Technical Symptoms &amp; Observed Issues <span class="text-rose-500">*</span>
                </label>
                <textarea wire:model="message" 
                          rows="3" 
                          placeholder="Describe symptoms (e.g. abnormal vibration levels > 10 mm/s RMS, oil leaks at exhaust casing, high exhaust gas temps, surging under load)..." 
                          class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border @error('message') border-rose-500 @else border-slate-200 dark:border-slate-800 @enderror text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none transition-colors"></textarea>
                @error('message')
                    <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    wire:loading.attr="disabled" 
                    class="w-full py-3.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white shadow-md active:scale-95 transition-all cursor-pointer flex items-center justify-center gap-2 group disabled:opacity-70"
                    style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color));">
                
                <span wire:loading.remove wire:target="submitRfq" class="inline-flex items-center justify-center gap-2 whitespace-nowrap">
                    <svg class="w-4 h-4 shrink-0 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                    <span>Transmit RFQ to 24/7 Port Duty Desk</span>
                </span>

                <span wire:loading.inline-flex wire:target="submitRfq" class="items-center justify-center gap-2 whitespace-nowrap" style="display: none;">
                    <svg class="w-4 h-4 shrink-0 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Encoding &amp; Transmitting Inquiry...</span>
                </span>
            </button>
        </form>
    @endif
</div>
