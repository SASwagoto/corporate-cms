<!-- Platform Core -->
<div>
    <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Platform
    </div>
    <nav class="space-y-1">
        <a href="{{ route('admin.dashboard') }}" wire:navigate
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }} transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        <a href="#"
            class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition-colors">
            <span class="flex items-center gap-3">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Pages & Builder
            </span>
            <span
                class="px-1.5 py-0.5 text-[9px] font-bold rounded-md bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-300">CMS</span>
        </a>

        <a href="{{ route('admin.media') }}" wire:navigate
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.media') ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }} transition-colors">
            <x-icon name="solid:images" class="w-4 h-4" />
            <span>Media Assets</span>
        </a>
    </nav>
</div>

<!-- Modules -->
<div>
    <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Corporate
        Modules</div>
    <nav class="space-y-1">
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            Business Units
        </a>
        <a href="{{ route('admin.services') }}" wire:navigate
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.services*') ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950 shadow-xs' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }} transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            Services & Overhauls
        </a>
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            Products & Parts
        </a>
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Leadership
        </a>
    </nav>
</div>

<!-- Configuration -->
<div>
    <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">
        Configuration</div>
    <nav class="space-y-1">
        @php
            $newEnquiriesCount = \App\Models\Enquiry::where('status', 'new')->count();
        @endphp
        <a href="{{ route('admin.enquiries') }}" wire:navigate
            class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.enquiries') ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950 shadow-xs' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }} transition-colors">
            <span class="flex items-center gap-3">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Enquiries / RFQ
            </span>
            @if ($newEnquiriesCount > 0)
                <span class="px-1.5 py-0.5 text-[10px] font-bold rounded-md bg-rose-500 text-white">
                    {{ $newEnquiriesCount }}
                </span>
            @else
                <span class="px-1.5 py-0.5 text-[10px] font-bold rounded-md bg-slate-200 dark:bg-slate-800 text-slate-500 dark:text-slate-400">
                    {{ \App\Models\Enquiry::count() }}
                </span>
            @endif
        </a>
        <a href="{{ route('admin.theme') }}" wire:navigate
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.theme') ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }} transition-colors">
            <x-icon name="solid:palette" class="w-4 h-4" />
            <span>Theme Studio</span>
        </a>
        <!-- Settings Link -->
        <a href="{{ route('admin.settings') }}" wire:navigate
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.settings') ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }} transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Global Settings
        </a>
        <a href="{{ route('admin.access') }}" wire:navigate
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.access') ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }} transition-colors">
            <x-icon name="solid:user-shield" class="w-4 h-4" />
            <span>Access & Roles</span>
        </a>
    </nav>
</div>
