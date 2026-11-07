<x-layouts.admin>
    <x-slot:header>Executive Overview</x-slot:header>

    <div class="space-y-8">
        
        <!-- Welcome Card -->
        <div class="p-6 lg:p-8 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Control Center</span>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white mt-1">Good day, {{ auth()->user()->name }}</h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">Your corporate portal is fully operational and synchronized.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    System Live
                </span>
            </div>
        </div>

        <!-- 4 Authentic Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <!-- 1. Pages -->
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-xs font-semibold uppercase tracking-wider">Dynamic Pages</span>
                    <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="text-3xl font-extrabold text-slate-900 dark:text-white mt-3">{{ \App\Models\Page::count() }}</div>
                <div class="mt-2 text-xs text-slate-500 dark:text-slate-400">Total published pages</div>
            </div>

            <!-- 2. Business Units -->
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-xs font-semibold uppercase tracking-wider">Business Units</span>
                    <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div class="text-3xl font-extrabold text-slate-900 dark:text-white mt-3">{{ \App\Models\BusinessUnit::count() }}</div>
                <div class="mt-2 text-xs text-slate-500 dark:text-slate-400">Conglomerate portfolio</div>
            </div>

            <!-- 3. Services -->
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-xs font-semibold uppercase tracking-wider">Services</span>
                    <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div class="text-3xl font-extrabold text-slate-900 dark:text-white mt-3">{{ \App\Models\Service::count() }}</div>
                <div class="mt-2 text-xs text-slate-500 dark:text-slate-400">Industrial capabilities</div>
            </div>

            <!-- 4. RFQ / Enquiries -->
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-xs font-semibold uppercase tracking-wider">Inquiries & Leads</span>
                    <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="text-3xl font-extrabold text-slate-900 dark:text-white mt-3">{{ \App\Models\Enquiry::count() }}</div>
                <div class="mt-2 text-xs text-slate-500 dark:text-slate-400">Pending client responses</div>
            </div>
        </div>

        <!-- Two Columns Work Surface -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left: Quick Management Actions -->
            <div class="lg:col-span-2 p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-white mb-4">Quick Studio Actions</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl border border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 bg-slate-50/50 dark:bg-slate-950/40 transition-colors cursor-pointer group">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold text-xs">P</div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">Create Page</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Modular Page Builder</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 rounded-xl border border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 bg-slate-50/50 dark:bg-slate-950/40 transition-colors cursor-pointer group">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-xs">M</div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Media Library</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Upload & optimize assets</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 rounded-xl border border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 bg-slate-50/50 dark:bg-slate-950/40 transition-colors cursor-pointer group">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-xs">T</div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">Theme Tokens</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Colors, fonts, & radii</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 rounded-xl border border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 bg-slate-50/50 dark:bg-slate-950/40 transition-colors cursor-pointer group">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center font-bold text-xs">S</div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">AI & SEO Registry</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">llms.txt & Knowledge Graph</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: System Specifications -->
            <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex flex-col justify-between">
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-white mb-4">Architecture Engine</h3>
                    
                    <ul class="space-y-3 text-xs">
                        <li class="flex items-center justify-between pb-2 border-b border-slate-100 dark:border-slate-800">
                            <span class="text-slate-500 dark:text-slate-400">Framework</span>
                            <span class="font-semibold text-slate-800 dark:text-white">Laravel {{ app()->version() }}</span>
                        </li>
                        <li class="flex items-center justify-between pb-2 border-b border-slate-100 dark:border-slate-800">
                            <span class="text-slate-500 dark:text-slate-400">Runtime</span>
                            <span class="font-semibold text-slate-800 dark:text-white">PHP {{ phpversion() }}</span>
                        </li>
                        <li class="flex items-center justify-between pb-2 border-b border-slate-100 dark:border-slate-800">
                            <span class="text-slate-500 dark:text-slate-400">Interactive Layer</span>
                            <span class="font-semibold text-amber-600 dark:text-amber-400">Livewire 3 + Alpine</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-slate-500 dark:text-slate-400">Theme Engine</span>
                            <span class="font-semibold text-emerald-600 dark:text-emerald-400">Light / Dark CSS Tokens</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-[11px] text-slate-400">
                    <span>Database Status</span>
                    <span class="font-medium text-emerald-600 dark:text-emerald-400">Connected & Synced</span>
                </div>
            </div>

        </div>

    </div>
</x-layouts.admin>