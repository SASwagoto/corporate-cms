<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dashboard' }} | {{ \App\Models\Setting::get('site_name', 'Nordroy CMS') }}</title>

    <!-- Dynamic Favicon (Adaptive Light & Dark Mode) -->
    @php
        $siteIconLight = \App\Models\Setting::get('site_icon', 'assets/images/icon.png');
        $siteIconDark = \App\Models\Setting::get('site_icon_dark', 'assets/images/icon-dark.png') ?: $siteIconLight;
    @endphp
    <link rel="icon" type="image/png" href="{{ asset($siteIconLight) }}" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" href="{{ asset($siteIconDark) }}" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" href="{{ asset($siteIconLight) }}">

    <!-- 100% Self-Hosted Webfonts (Zero Latency & 100% Offline Compatible) -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">

    <!-- Anti-FOUC Theme Script (Default to Dark Mode unless Light Mode explicitly requested) -->
    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }
    </script>

    <style>
        @keyframes turbine-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-turbine {
            animation: turbine-spin 3s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }
        .icon-glow {
            filter: drop-shadow(0 4px 12px rgba(1, 61, 90, 0.25));
        }
        .dark .icon-glow {
            filter: drop-shadow(0 4px 16px rgba(0, 0, 0, 0.6));
        }
        /* Hide scrollbars for clean horizontal tab navigation */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        @keyframes progress {
            0% { transform: translateX(-100%); }
            50% { transform: translateX(50%); }
            100% { transform: translateX(200%); }
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full font-sans antialiased bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100 selection:bg-[#003C58] selection:text-white transition-colors duration-200"
      x-data="{
          mobileSidebarOpen: false,
          isDark: document.documentElement.classList.contains('dark'),
          toggleTheme() {
              this.isDark = !this.isDark;
              if (this.isDark) {
                  document.documentElement.classList.add('dark');
                  localStorage.setItem('theme', 'dark');
              } else {
                  document.documentElement.classList.remove('dark');
                  localStorage.setItem('theme', 'light');
              }
          }
      }">

    @php
        $siteLogoLight = \App\Models\Setting::get('site_logo', 'assets/images/logo.png');
        $siteLogoDark = \App\Models\Setting::get('site_logo_dark') ?: $siteLogoLight;
        $siteIconLight = \App\Models\Setting::get('site_icon', 'assets/images/icon.png');
        $siteIconDark = \App\Models\Setting::get('site_icon_dark', 'assets/images/icon-dark.png') ?: $siteIconLight;
    @endphp

    <!-- ==================== NORDROY PRELOADER ==================== -->
    <div id="nordroy-preloader" 
         x-data="{ isLoading: true }" 
         x-init="setTimeout(() => isLoading = false, 350)"
         x-show="isLoading"
         x-transition:leave="transition ease-in-out duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-white dark:bg-slate-950 select-none"
         style="display: flex;">
        
        <div class="flex flex-col items-center">
            <div class="relative w-16 h-16 flex items-center justify-center mb-6">
                <img src="{{ asset($siteIconLight) }}" 
                     alt="Nordroy Turbine" 
                     class="w-14 h-14 object-contain animate-turbine drop-shadow-[0_4px_10px_rgba(0,60,88,0.15)] dark:hidden" />
                <img src="{{ asset($siteIconDark) }}" 
                     alt="Nordroy Turbine" 
                     class="w-14 h-14 object-contain animate-turbine drop-shadow-[0_4px_12px_rgba(0,0,0,0.6)] hidden dark:block" />
            </div>
            <div class="w-36 h-[2px] bg-slate-100 dark:bg-slate-900 rounded-full overflow-hidden relative shadow-inner">
                <div class="absolute inset-0 w-1/2 bg-gradient-to-r from-transparent via-[#003C58] to-cyan-500 dark:via-cyan-400 dark:to-teal-300 rounded-full animate-[progress_1.2s_ease-in-out_infinite]"></div>
            </div>
        </div>
    </div>
    <!-- ================== END NORDROY PRELOADER ================== -->

    <div class="min-h-full flex">
        
        <!-- MOBILE BACKDROP -->
        <div x-show="mobileSidebarOpen" 
             @click="mobileSidebarOpen = false"
             class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm lg:hidden"
             style="display: none;"></div>

        <!-- MOBILE SIDEBAR DRAWER -->
        <div x-show="mobileSidebarOpen"
             class="fixed inset-y-0 left-0 z-50 w-72 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 flex flex-col lg:hidden shadow-2xl"
             style="display: none;">
            
            <div class="h-20 flex items-center justify-between px-6 border-b border-slate-200 dark:border-slate-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset($siteLogoLight) }}" 
                         alt="{{ \App\Models\Setting::get('site_name', 'Nordroy CMS') }}" 
                         class="h-9 w-auto object-contain dark:hidden" />
                    <img src="{{ asset($siteLogoDark) }}" 
                         alt="{{ \App\Models\Setting::get('site_name', 'Nordroy CMS') }}" 
                         class="h-9 w-auto object-contain hidden dark:block" />
                </a>
                <button @click="mobileSidebarOpen = false" class="p-2 rounded-lg text-slate-400 hover:text-slate-600 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto px-4 py-6 space-y-6">
                @include('components.layouts.partials.admin-nav')
            </div>

            <!-- Mobile Drawer User Profile & Logout Footer -->
            <div class="p-4 border-t border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-9 h-9 rounded-full bg-[#003C58]/10 dark:bg-[#003C58]/30 border border-[#003C58]/20 flex items-center justify-center shrink-0">
                        <img src="{{ asset($siteIconLight) }}" alt="Icon" class="w-5 h-5 object-contain dark:hidden" />
                        <img src="{{ asset($siteIconDark) }}" alt="Icon" class="w-5 h-5 object-contain hidden dark:block" />
                    </div>
                    <div class="truncate">
                        <p class="text-xs font-semibold text-slate-800 dark:text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-400 truncate">Super Administrator</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Sign Out" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-rose-600 dark:text-rose-400 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/40 dark:hover:bg-rose-900/60 transition-colors cursor-pointer border border-rose-200 dark:border-rose-900/50">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- DESKTOP FIXED SIDEBAR -->
        <aside class="hidden lg:flex lg:flex-col lg:w-64 lg:fixed lg:inset-y-0 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 z-30 transition-colors duration-200">
            
            <div class="h-20 flex items-center px-6 border-b border-slate-200 dark:border-slate-800">
                <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center gap-3 group">
                    <img src="{{ asset($siteLogoLight) }}" 
                         alt="{{ \App\Models\Setting::get('site_name', 'Nordroy CMS') }}" 
                         class="h-9 w-auto max-w-[200px] object-contain dark:hidden group-hover:opacity-90 transition-opacity" />
                    <img src="{{ asset($siteLogoDark) }}" 
                         alt="{{ \App\Models\Setting::get('site_name', 'Nordroy CMS') }}" 
                         class="h-9 w-auto max-w-[200px] object-contain hidden dark:block group-hover:opacity-90 transition-opacity" />
                </a>
            </div>

            <div class="flex-1 overflow-y-auto px-4 py-6 space-y-6">
                @include('components.layouts.partials.admin-nav')
            </div>

            <div class="p-4 border-t border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50 flex items-center justify-between">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-9 h-9 rounded-full bg-[#003C58]/10 dark:bg-[#003C58]/30 border border-[#003C58]/20 flex items-center justify-center shrink-0">
                        <img src="{{ asset($siteIconLight) }}" alt="Icon" class="w-5 h-5 object-contain dark:hidden" />
                        <img src="{{ asset($siteIconDark) }}" alt="Icon" class="w-5 h-5 object-contain hidden dark:block" />
                    </div>
                    <div class="truncate">
                        <p class="text-xs font-semibold text-slate-800 dark:text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-400 truncate">Super Administrator</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Sign Out" class="p-2 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN VIEWPORT (Fluid Screen Width) -->
        <div class="lg:pl-64 flex flex-col flex-1 min-w-0">
            
            <!-- TOPBAR -->
            <header class="h-20 sticky top-0 z-20 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-4 sm:px-6 lg:px-8 transition-colors duration-200">
                
                <div class="flex items-center gap-3 sm:gap-4">
                    <button type="button" @click="mobileSidebarOpen = true" class="lg:hidden text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white p-2 -ml-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div>
                        <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                            <span>Nordroy Studio</span>
                            <span>/</span>
                            <span class="text-slate-600 dark:text-slate-300">{{ $header ?? 'Dashboard' }}</span>
                        </div>
                        <h1 class="text-sm sm:text-base lg:text-lg font-bold text-slate-900 dark:text-white mt-0.5 truncate">{{ $header ?? 'Executive Overview' }}</h1>
                    </div>
                </div>

                <div class="flex items-center gap-2 sm:gap-3">
                    
                    <!-- Search Input Trigger -->
                    <div x-data="{}" 
                         @keydown.window.prevent.cmd.k="$refs.searchInput.focus()"
                         @keydown.window.prevent.ctrl.k="$refs.searchInput.focus()"
                         class="relative hidden md:flex items-center">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input x-ref="searchInput"
                               type="text" 
                               placeholder="Search CMS sections..." 
                               class="w-48 lg:w-64 pl-9 pr-12 py-2 text-xs rounded-xl bg-slate-100 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80 text-slate-800 dark:text-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#003C58] dark:focus:ring-cyan-500/50 focus:w-72 transition-all duration-200" />
                        <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center pointer-events-none">
                            <kbd class="text-[10px] bg-white dark:bg-slate-700 text-slate-400 px-1.5 py-0.5 rounded border border-slate-200 dark:border-slate-600 font-mono shadow-xs">⌘K</kbd>
                        </div>
                    </div>

                    <!-- Theme Toggle -->
                    <button type="button" @click="toggleTheme()" 
                            class="p-2 sm:p-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-amber-400 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors cursor-pointer"
                            title="Toggle Light/Dark Theme">
                        <svg class="w-4 h-4 text-amber-500 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg class="w-4 h-4 text-slate-700 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <!-- Live Website Link -->
                    <a href="/" target="_blank"
                       class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 transition-colors">
                        <span>Live Site</span>
                        <svg class="w-3.5 h-3.5 text-slate-500 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>

                    <!-- Mobile Quick Sign Out Button -->
                    <form method="POST" action="{{ route('logout') }}" class="inline-flex lg:hidden">
                        @csrf
                        <button type="submit" title="Sign Out" class="p-2 rounded-xl border border-rose-200 dark:border-rose-900/50 bg-rose-50/90 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 hover:bg-rose-100 dark:hover:bg-rose-900/60 transition-colors cursor-pointer" title="Sign Out">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </header>

            <!-- MAIN BODY (Full Width Responsive Coverage) -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 w-full">
                {{ $slot }}
            </main>

        </div>
    </div>

    <x-confirm-modal />
    
    @livewireScripts
</body>
</html>