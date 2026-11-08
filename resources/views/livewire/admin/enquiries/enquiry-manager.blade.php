<div class="space-y-6">
    
    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200 dark:border-slate-800">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-xl font-bold font-heading text-slate-900 dark:text-white">Inquiries &amp; RFQ Duty Desk</h1>
                @if ($counts['new'] > 0)
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-500 text-white animate-pulse">
                        {{ $counts['new'] }} NEW
                    </span>
                @endif
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                Real-time technical RFQs, emergency port call requests, and general corporate communications.
            </p>
        </div>

        <div class="flex items-center gap-2">
            @if ($counts['new'] > 0)
                <button type="button" 
                        wire:click="markAllAsRead" 
                        class="px-3 py-2 rounded-xl text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors flex items-center gap-1.5 cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Mark All Read</span>
                </button>
            @endif

            <button type="button" 
                    wire:click="exportCsv" 
                    class="px-3.5 py-2 rounded-xl text-xs font-bold bg-[#003C58] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 shadow-sm transition-all flex items-center gap-1.5 cursor-pointer">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                <span>Export CSV</span>
            </button>
        </div>
    </div>

    <!-- Flash Feedback -->
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
             class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-xs flex items-center justify-between transition-all">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('message') }}</span>
            </div>
            <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 cursor-pointer">&times;</button>
        </div>
    @endif

    <!-- Status Tabs & Filters -->
    <div class="space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            
            <!-- Horizontal Status Tabs -->
            <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar pb-1">
                <button type="button" 
                        wire:click="$set('statusFilter', 'all')" 
                        class="px-3.5 py-1.5 rounded-xl text-xs font-semibold whitespace-nowrap transition-all cursor-pointer flex items-center gap-1.5 {{ $statusFilter === 'all' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950 shadow-xs' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <span>All Leads</span>
                    <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $statusFilter === 'all' ? 'bg-white/20 text-white dark:bg-slate-950/20 dark:text-slate-950' : 'bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300' }}">{{ $counts['all'] }}</span>
                </button>

                <button type="button" 
                        wire:click="$set('statusFilter', 'new')" 
                        class="px-3.5 py-1.5 rounded-xl text-xs font-semibold whitespace-nowrap transition-all cursor-pointer flex items-center gap-1.5 {{ $statusFilter === 'new' ? 'bg-rose-500 text-white shadow-xs' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <span>New / Unread</span>
                    <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $statusFilter === 'new' ? 'bg-white/20 text-white' : 'bg-rose-100 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400' }}">{{ $counts['new'] }}</span>
                </button>

                <button type="button" 
                        wire:click="$set('statusFilter', 'read')" 
                        class="px-3.5 py-1.5 rounded-xl text-xs font-semibold whitespace-nowrap transition-all cursor-pointer flex items-center gap-1.5 {{ $statusFilter === 'read' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950 shadow-xs' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <span>In Review</span>
                    <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $statusFilter === 'read' ? 'bg-white/20 text-white dark:bg-slate-950/20 dark:text-slate-950' : 'bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300' }}">{{ $counts['read'] }}</span>
                </button>

                <button type="button" 
                        wire:click="$set('statusFilter', 'replied')" 
                        class="px-3.5 py-1.5 rounded-xl text-xs font-semibold whitespace-nowrap transition-all cursor-pointer flex items-center gap-1.5 {{ $statusFilter === 'replied' ? 'bg-emerald-600 text-white shadow-xs' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <span>Quoted / Replied</span>
                    <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $statusFilter === 'replied' ? 'bg-white/20 text-white' : 'bg-emerald-100 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400' }}">{{ $counts['replied'] }}</span>
                </button>

                <button type="button" 
                        wire:click="$set('statusFilter', 'archived')" 
                        class="px-3.5 py-1.5 rounded-xl text-xs font-semibold whitespace-nowrap transition-all cursor-pointer flex items-center gap-1.5 {{ $statusFilter === 'archived' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950 shadow-xs' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <span>Archived</span>
                    <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $statusFilter === 'archived' ? 'bg-white/20 text-white dark:bg-slate-950/20 dark:text-slate-950' : 'bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300' }}">{{ $counts['archived'] }}</span>
                </button>
            </div>

            <!-- Search & Type Filter Controls -->
            <div class="flex items-center gap-2">
                <div class="relative w-full sm:w-64">
                    <input type="text" 
                           wire:model.live.debounce.300ms="search" 
                           placeholder="Search vessel, client, email..." 
                           class="w-full pl-8 pr-8 py-1.5 rounded-xl text-xs bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-[#003C58]/40 focus:outline-none" />
                    <svg class="w-3.5 h-3.5 text-slate-400 absolute left-2.5 top-2.5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    @if (!empty($search))
                        <button type="button" wire:click="$set('search', '')" class="absolute right-2.5 top-2 text-slate-400 hover:text-slate-600 cursor-pointer text-xs">&times;</button>
                    @endif
                </div>

                <select wire:model.live="typeFilter" 
                        class="px-2.5 py-1.5 rounded-xl text-xs bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-slate-200 focus:outline-none">
                    <option value="all">All Types</option>
                    <option value="quotation">RFQ / Quotation</option>
                    <option value="service">Service</option>
                    <option value="general">General</option>
                    <option value="career">Career</option>
                </select>
            </div>

        </div>
    </div>

    <!-- Data Table Surface -->
    <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        @if ($enquiries->isEmpty())
            <div class="p-12 text-center space-y-3">
                <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400 mx-auto flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800 dark:text-white">No Inquiries Found</h3>
                <p class="text-xs text-slate-400 max-w-sm mx-auto">
                    There are no inquiries matching your active filters. RFQ submissions from the frontend will appear here instantly.
                </p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-950/60 border-b border-slate-200 dark:border-slate-800 text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            <th class="px-5 py-3">Reference / Date</th>
                            <th class="px-5 py-3">Vessel / Plant Target</th>
                            <th class="px-5 py-3">Client Personnel</th>
                            <th class="px-5 py-3">Service &amp; Port</th>
                            <th class="px-5 py-3">Urgency</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/80">
                        @foreach ($enquiries as $enquiry)
                            @php
                                $payload = is_array($enquiry->payload) ? $enquiry->payload : [];
                                $vessel = $payload['vessel_plant_name'] ?? ($enquiry->subject ?: 'Maritime Target');
                                $model = $payload['turbocharger_model'] ?? 'N/A';
                                $port = $payload['port_location'] ?? 'Chattogram';
                                $service = $payload['service_required'] ?? $enquiry->subject;
                                $urgency = $payload['urgency'] ?? 'Standard';
                                $isEmergency = str_contains(strtolower($urgency), 'emergency') || str_contains(strtolower($urgency), 'blackout');
                                $isUrgent = str_contains(strtolower($urgency), 'urgent');
                            @endphp
                            <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/40 transition-colors {{ $enquiry->status === 'new' ? 'bg-amber-50/30 dark:bg-amber-950/10 font-semibold' : '' }}">
                                
                                <!-- ID & Date -->
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        @if ($enquiry->status === 'new')
                                            <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping" title="Unread Lead"></span>
                                        @endif
                                        <span class="font-mono font-bold text-slate-900 dark:text-white">
                                            #NRQ-{{ str_pad($enquiry->id, 4, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </div>
                                    <div class="text-[11px] text-slate-400 mt-0.5 font-mono">
                                        {{ $enquiry->created_at->diffForHumans() }}
                                    </div>
                                </td>

                                <!-- Vessel & Equipment -->
                                <td class="px-5 py-4">
                                    <div class="font-bold text-slate-800 dark:text-slate-200 truncate max-w-[180px]">
                                        {{ $vessel }}
                                    </div>
                                    <div class="text-[11px] text-slate-500 dark:text-slate-400 font-mono truncate max-w-[180px]">
                                        {{ $model }}
                                    </div>
                                </td>

                                <!-- Contact Person -->
                                <td class="px-5 py-4">
                                    <div class="text-slate-800 dark:text-slate-200 truncate max-w-[180px]">
                                        {{ $enquiry->full_name }}
                                    </div>
                                    <div class="text-[11px] text-slate-400 truncate max-w-[180px]">
                                        {{ $enquiry->company ?: $enquiry->email }}
                                    </div>
                                </td>

                                <!-- Service & Port -->
                                <td class="px-5 py-4">
                                    <div class="text-slate-700 dark:text-slate-300 truncate max-w-[180px]">
                                        {{ $service }}
                                    </div>
                                    <div class="text-[11px] text-[#003C58] dark:text-cyan-400 font-mono truncate max-w-[180px]">
                                        {{ $port }}
                                    </div>
                                </td>

                                <!-- Urgency Badge -->
                                <td class="px-5 py-4 whitespace-nowrap">
                                    @if ($isEmergency)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-500/30 animate-pulse">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            EMERGENCY
                                        </span>
                                    @elseif ($isUrgent)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-700 dark:text-amber-400 border border-amber-500/30">
                                            URGENT (&lt;48h)
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400">
                                            Standard
                                        </span>
                                    @endif
                                </td>

                                <!-- Status Badge -->
                                <td class="px-5 py-4 whitespace-nowrap">
                                    @if ($enquiry->status === 'new')
                                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-500/20 uppercase">
                                            New
                                        </span>
                                    @elseif ($enquiry->status === 'read')
                                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 uppercase">
                                            Reviewed
                                        </span>
                                    @elseif ($enquiry->status === 'replied')
                                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 uppercase">
                                            Quoted
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-md text-[10px] font-medium bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 uppercase">
                                            Archived
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-5 py-4 whitespace-nowrap text-right space-x-1">
                                    <button type="button" 
                                            wire:click="viewEnquiry({{ $enquiry->id }})" 
                                            class="px-2.5 py-1.5 rounded-lg text-xs font-semibold bg-[#003C58]/10 text-[#003C58] dark:bg-cyan-500/10 dark:text-cyan-400 hover:bg-[#003C58]/20 transition-colors cursor-pointer">
                                        View Dossier
                                    </button>

                                    <button type="button" 
                                            wire:click="deleteEnquiry({{ $enquiry->id }})" 
                                            wire:confirm="Are you sure you want to permanently delete inquiry #{{ $enquiry->id }}?"
                                            title="Delete Inquiry"
                                            class="p-1.5 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-950/30 transition-colors cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Bar -->
            <div class="px-5 py-4 border-t border-slate-100 dark:border-slate-800">
                {{ $enquiries->links() }}
            </div>
        @endif
    </div>

    <!-- =========================================================================
         TECHNICAL DOSSIER DETAIL MODAL / DRAWER
         ========================================================================= -->
    @if ($selectedEnquiry)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/70 backdrop-blur-xs flex items-center justify-center p-4">
            
            <div class="relative w-full max-w-2xl rounded-3xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden transition-all">
                
                @php
                    $p = is_array($selectedEnquiry->payload) ? $selectedEnquiry->payload : [];
                    $cleanPhone = preg_replace('/[^0-9]/', '', $selectedEnquiry->phone);
                @endphp

                <!-- Modal Header -->
                <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/60 dark:bg-slate-950/40">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950">
                                #NRQ-{{ str_pad($selectedEnquiry->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="text-xs font-mono text-slate-400">
                                {{ $selectedEnquiry->created_at->format('M d, Y - h:i A') }}
                            </span>
                        </div>
                        <h2 class="text-lg font-bold font-heading text-slate-900 dark:text-white">
                            {{ $p['vessel_plant_name'] ?? $selectedEnquiry->subject }}
                        </h2>
                    </div>

                    <button type="button" 
                            wire:click="closeModal" 
                            class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center cursor-pointer transition-colors">
                        &times;
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-6 max-h-[75vh] overflow-y-auto">
                    
                    <!-- Quick Contact Action Bar -->
                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-950/80 border border-slate-200/80 dark:border-slate-800 flex flex-wrap items-center justify-between gap-3">
                        <div class="space-y-0.5">
                            <span class="text-[10px] font-mono uppercase tracking-wider text-slate-400">Client Personnel:</span>
                            <div class="text-xs font-bold text-slate-900 dark:text-white">
                                {{ $selectedEnquiry->full_name }}
                                @if ($selectedEnquiry->company)
                                    <span class="font-normal text-slate-500">({{ $selectedEnquiry->company }})</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <!-- Direct Mailto -->
                            <a href="mailto:{{ $selectedEnquiry->email }}?subject=RE: Nordroy RFQ #NRQ-{{ str_pad($selectedEnquiry->id, 4, '0', STR_PAD_LEFT) }} - {{ urlencode($p['vessel_plant_name'] ?? '') }}" 
                               target="_blank"
                               class="px-3 py-1.5 rounded-xl text-xs font-bold bg-[#003C58] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 transition-colors flex items-center gap-1.5 shadow-2xs">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>Reply Email</span>
                            </a>

                            <!-- Direct WhatsApp -->
                            @if (!empty($cleanPhone))
                                <a href="https://wa.me/{{ $cleanPhone }}?text=Hello%20{{ urlencode($selectedEnquiry->full_name) }},%20this%20is%20Nordroy%20Marine%20Duty%20Desk%20regarding%20your%20RFQ%20%23NRQ-{{ str_pad($selectedEnquiry->id, 4, '0', STR_PAD_LEFT) }}." 
                                   target="_blank"
                                   class="px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-600 text-white hover:bg-emerald-700 transition-colors flex items-center gap-1.5 shadow-2xs">
                                    <x-icon name="brands:whatsapp" class="w-3.5 h-3.5" />
                                    <span>WhatsApp</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Technical Specs HUD -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                        <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-950/40 border border-slate-200 dark:border-slate-800">
                            <span class="block text-[10px] font-mono uppercase text-slate-400">Equipment / Model:</span>
                            <span class="text-xs font-bold font-mono text-slate-900 dark:text-white mt-0.5 block truncate">
                                {{ $p['turbocharger_model'] ?? 'N/A' }}
                            </span>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-950/40 border border-slate-200 dark:border-slate-800">
                            <span class="block text-[10px] font-mono uppercase text-slate-400">Port / Facility:</span>
                            <span class="text-xs font-bold text-[#003C58] dark:text-cyan-400 mt-0.5 block truncate">
                                {{ $p['port_location'] ?? 'Chattogram' }}
                            </span>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-950/40 border border-slate-200 dark:border-slate-800">
                            <span class="block text-[10px] font-mono uppercase text-slate-400">Urgency Level:</span>
                            <span class="text-xs font-bold text-amber-600 dark:text-amber-400 mt-0.5 block truncate">
                                {{ $p['urgency'] ?? 'Standard' }}
                            </span>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-950/40 border border-slate-200 dark:border-slate-800">
                            <span class="block text-[10px] font-mono uppercase text-slate-400">Required Service:</span>
                            <span class="text-xs font-bold text-slate-900 dark:text-white mt-0.5 block truncate">
                                {{ $p['service_required'] ?? $selectedEnquiry->subject }}
                            </span>
                        </div>
                    </div>

                    <!-- Technical Notes & Symptoms -->
                    <div class="space-y-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 block">
                            Technical Scope &amp; Observed Symptoms:
                        </span>
                        <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 text-xs text-slate-800 dark:text-slate-200 whitespace-pre-wrap leading-relaxed">
                            {{ $selectedEnquiry->message }}
                        </div>
                    </div>

                    <!-- Client Direct Channels -->
                    <div class="p-4 rounded-xl bg-slate-50/50 dark:bg-slate-950/30 border border-slate-100 dark:border-slate-800 text-xs space-y-1.5 font-mono">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400">Direct Email:</span>
                            <span class="text-slate-700 dark:text-slate-300 font-bold select-all">{{ $selectedEnquiry->email }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400">Direct Phone:</span>
                            <span class="text-slate-700 dark:text-slate-300 font-bold select-all">{{ $selectedEnquiry->phone }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400">Origin IP:</span>
                            <span class="text-slate-500 text-[11px]">{{ $selectedEnquiry->ip_address ?? '127.0.0.1' }}</span>
                        </div>
                    </div>

                </div>

                <!-- Modal Footer Status Controls -->
                <div class="p-5 border-t border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-950/40 flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-1.5">
                        <span class="text-xs font-semibold text-slate-500 mr-1">Status:</span>

                        <button type="button" 
                                wire:click="updateStatus({{ $selectedEnquiry->id }}, 'new')" 
                                class="px-2.5 py-1 rounded-lg text-xs font-semibold {{ $selectedEnquiry->status === 'new' ? 'bg-rose-500 text-white' : 'bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-300' }} cursor-pointer transition-colors">
                            New
                        </button>

                        <button type="button" 
                                wire:click="updateStatus({{ $selectedEnquiry->id }}, 'read')" 
                                class="px-2.5 py-1 rounded-lg text-xs font-semibold {{ $selectedEnquiry->status === 'read' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-300' }} cursor-pointer transition-colors">
                            Reviewing
                        </button>

                        <button type="button" 
                                wire:click="updateStatus({{ $selectedEnquiry->id }}, 'replied')" 
                                class="px-2.5 py-1 rounded-lg text-xs font-semibold {{ $selectedEnquiry->status === 'replied' ? 'bg-emerald-600 text-white' : 'bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-300' }} cursor-pointer transition-colors">
                            Quoted
                        </button>

                        <button type="button" 
                                wire:click="updateStatus({{ $selectedEnquiry->id }}, 'archived')" 
                                class="px-2.5 py-1 rounded-lg text-xs font-semibold {{ $selectedEnquiry->status === 'archived' ? 'bg-slate-700 text-white' : 'bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-300' }} cursor-pointer transition-colors">
                            Archive
                        </button>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" 
                                wire:click="deleteEnquiry({{ $selectedEnquiry->id }})" 
                                wire:confirm="Permanently delete this inquiry?" 
                                class="px-3 py-1.5 rounded-lg text-xs font-bold text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-colors cursor-pointer">
                            Delete
                        </button>

                        <button type="button" 
                                wire:click="closeModal" 
                                class="px-4 py-1.5 rounded-xl text-xs font-bold bg-slate-200 dark:bg-slate-800 text-slate-800 dark:text-white hover:bg-slate-300 dark:hover:bg-slate-700 transition-colors cursor-pointer">
                            Close
                        </button>
                    </div>
                </div>

            </div>

        </div>
    @endif

</div>
