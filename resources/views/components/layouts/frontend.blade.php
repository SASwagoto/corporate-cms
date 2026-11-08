<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? \App\Models\Setting::get('site_name', 'Nordroy Marine & Turbochargers') }} | {{ \App\Models\Setting::get('site_tagline', 'Authorized Multi-Brand Turbocharger Overhauls & Maritime Engineering') }}</title>

    <!-- Dynamic Favicon -->
    <link rel="icon" type="image/png" href="{{ asset(\App\Models\Setting::get('site_icon', 'assets/images/icon.png')) }}">

    <!-- 100% Self-Hosted Local Webfonts (Zero Latency & 100% Offline Compatible) -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">

    <!-- Anti-FOUC Theme Script (Default to Dark Mode unless Light Mode explicitly requested) -->
    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }

        window.toggleSiteTheme = function() {
            var isDark = document.documentElement.classList.contains('dark');
            if (isDark) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
            window.dispatchEvent(new CustomEvent('theme-changed', { detail: { isDark: !isDark } }));
        };
    </script>

    <!-- Dynamic CSS Design System Tokens from CMS Theme Studio -->
    <style>
        :root {
            --primary-color: {{ \App\Models\Setting::get('theme_primary_color', '#003C58') }};
            --secondary-color: {{ \App\Models\Setting::get('theme_secondary_color', '#75767A') }};
            --accent-color: {{ \App\Models\Setting::get('theme_accent_color', '#0ea5e9') }};
            --surface-light: {{ \App\Models\Setting::get('theme_surface_light', '#ffffff') }};
            --surface-dark: {{ \App\Models\Setting::get('theme_surface_dark', '#07131e') }};
            --border-color: {{ \App\Models\Setting::get('theme_border_color', '#e2e8f0') }};
            --heading-font: '{{ \App\Models\Setting::get('theme_heading_font', 'Plus Jakarta Sans') }}', sans-serif;
            --body-font: '{{ \App\Models\Setting::get('theme_body_font', 'Plus Jakarta Sans') }}', sans-serif;
            --button-radius: {{ \App\Models\Setting::get('theme_button_radius', '12px') }};
            --container-width: {{ \App\Models\Setting::get('theme_container_width', '1536px') }};
            --section-padding: {{ \App\Models\Setting::get('theme_section_padding', '96px') }};
            --heading-weight: {{ \App\Models\Setting::get('theme_heading_weight', '800') }};
            --letter-spacing: {{ \App\Models\Setting::get('theme_letter_spacing', '-0.02em') }};
        }

        /* Dynamic Typography Application */
        .font-heading, h1, h2, h3, h4, h5, h6 { 
            font-family: var(--heading-font) !important; 
            font-weight: var(--heading-weight);
            letter-spacing: var(--letter-spacing);
        }
        .font-body, body, p, span, a, input, select, textarea, li { 
            font-family: var(--body-font); 
        }

        /* LIGHT MODE ONLY: Seamless Brand Primary & Secondary bindings without dark conflicts */
        html:not(.dark) .bg-\[\#003C58\],
        html:not(.dark) .bg-\[\#003C58\] {
            background-color: var(--primary-color) !important;
        }
        html:not(.dark) .text-\[\#003C58\],
        html:not(.dark) .text-\[\#003C58\] {
            color: var(--primary-color) !important;
        }
        html:not(.dark) .border-\[\#003C58\],
        html:not(.dark) .border-\[\#003C58\] {
            border-color: var(--primary-color) !important;
        }
        html:not(.dark) .ring-\[\#003C58\],
        html:not(.dark) .ring-\[\#003C58\] {
            --tw-ring-color: var(--primary-color) !important;
        }

        /* DARK MODE ONLY: High-contrast cyan/sky highlights */
        html.dark .text-cyan-400 {
            color: var(--accent-color) !important;
        }
        html.dark .border-cyan-400 {
            border-color: var(--accent-color) !important;
        }

        /* Dynamic Radius Overrides */
        .rounded-xl, .rounded-2xl {
            border-radius: var(--button-radius) !important;
        }

        /* Dynamic Container Max-Width */
        .max-w-\[1536px\] {
            max-width: var(--container-width) !important;
        }

        @keyframes turbine-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-turbine {
            animation: turbine-spin 4s linear infinite;
        }

        .icon-glow {
            filter: drop-shadow(0 0 16px rgba(1, 61, 90, 0.35));
        }
        .dark .icon-glow {
            filter: drop-shadow(0 0 20px rgba(14, 165, 233, 0.4));
        }

        @keyframes progress {
            0% { transform: translateX(-100%); }
            50% { transform: translateX(50%); }
            100% { transform: translateX(200%); }
        }

        /* Continuous Brand Logo Ticker Animation */
        @keyframes ticker-slide {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-ticker {
            display: flex;
            width: max-content;
            animation: ticker-slide 32s linear infinite;
        }
        .animate-ticker:hover {
            animation-play-state: paused;
        }

        /* Glassmorphism Classes */
        .glass-nav {
            background-color: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        .dark .glass-nav {
            background-color: rgba(7, 19, 30, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full font-body antialiased bg-slate-50 text-slate-900 dark:bg-[#07131e] dark:text-slate-100 selection:bg-[#003C58] selection:text-white transition-colors duration-200 relative"
      x-data="{
          mobileNavOpen: false,
          activeMobileSubmenu: null,
          isDark: document.documentElement.classList.contains('dark'),
          toggleTheme() {
              if (window.toggleSiteTheme) {
                  window.toggleSiteTheme();
              }
              this.isDark = document.documentElement.classList.contains('dark');
          }
      }"
      @theme-changed.window="isDark = $event.detail.isDark">

    <!-- ==================== FIXED FULL-SITE BACKGROUND VIDEO (Turbo Internacional Style) ==================== -->
    @php
        $siteBgVideoEnabled = \App\Models\Setting::get('site_bg_video_enabled', '1');
        $siteBgVideoUrl = \App\Models\Setting::get('site_bg_video_url', 'assets/videos/background-marine.mp4');
        $siteBgVideoOpacity = (int)\App\Models\Setting::get('site_bg_video_opacity', '85');
        if ($siteBgVideoOpacity <= 0 || $siteBgVideoOpacity > 100) {
            $siteBgVideoOpacity = 85;
        }
        $opacityDecimal = $siteBgVideoOpacity / 100;
    @endphp
    @if($siteBgVideoEnabled == '1')
    <div class="fixed inset-0 w-full h-full pointer-events-none -z-20 overflow-hidden select-none bg-white dark:bg-slate-950">
        <video autoplay loop muted playsinline preload="auto" 
               class="w-full h-full object-cover transition-opacity duration-300"
               style="opacity: {{ $opacityDecimal }};">
            <source src="{{ asset($siteBgVideoUrl) }}" type="video/mp4">
        </video>
        <!-- Contrast overlay: Clean ambient white tint in light mode, cinematic vignette in dark mode -->
        <div class="absolute inset-0 bg-gradient-to-b from-white/30 via-transparent to-white/40 dark:from-black/30 dark:via-transparent dark:to-black/40 pointer-events-none"></div>
    </div>
    @endif

    <!-- ==================== NORDROY TURBINE PRELOADER ==================== -->
    <div id="nordroy-preloader" 
         class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-white dark:bg-[#07131e] select-none transition-opacity duration-300">
        <div class="flex flex-col items-center">
            <div class="relative w-16 h-16 flex items-center justify-center mb-6">
                <img src="{{ asset('assets/images/icon.png') }}" 
                     alt="Nordroy Turbine" 
                     class="w-14 h-14 object-contain animate-turbine icon-glow" />
            </div>
            <div class="w-36 h-[2px] bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden relative shadow-inner">
                <div class="absolute inset-0 w-1/2 bg-gradient-to-r from-transparent via-[#003C58] to-[#0ea5e9] dark:via-cyan-400 dark:to-teal-300 rounded-full animate-[progress_1.2s_ease-in-out_infinite]"></div>
            </div>
        </div>
    </div>
    <script>
        (function() {
            var preloaderDismissed = false;
            function dismissPreloader() {
                if (preloaderDismissed) return;
                preloaderDismissed = true;
                var p = document.getElementById('nordroy-preloader');
                if (p) {
                    p.style.opacity = '0';
                    p.style.pointerEvents = 'none';
                    setTimeout(function() {
                        if (p && p.parentNode) {
                            p.style.display = 'none';
                        }
                    }, 350);
                }
            }

            if (document.readyState === 'complete' || document.readyState === 'interactive') {
                setTimeout(dismissPreloader, 350);
            } else {
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(dismissPreloader, 350);
                });
            }
            setTimeout(dismissPreloader, 800);
        })();
    </script>
    <!-- ================== END NORDROY PRELOADER ================== -->

    <div class="min-h-full flex flex-col justify-between relative z-10">
        
        <!-- TOP CORPORATE EMERGENCY & STATS STRIP (Light mode: 100% Light, Dark mode: Shipyard Navy) -->
        <div class="bg-white/95 dark:bg-[#050f18]/95 text-slate-700 dark:text-slate-300 border-b border-slate-200/90 dark:border-slate-800 text-[11px] py-2 px-4 sm:px-8 transition-colors">
            <div class="max-w-[1536px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
                <div class="flex items-center gap-3">
                    <span class="font-bold text-xs text-[#003C58] dark:text-cyan-400 tracking-tight">
                        24/7 Port Call &amp; Emergency Squads
                    </span>
                    <span class="hidden md:inline text-slate-300 dark:text-slate-700">|</span>
                    <span class="hidden md:inline text-slate-500 dark:text-slate-400 font-medium">Authorized Multi-Brand Turbocharger Engineering</span>
                </div>
                <div class="flex items-center gap-4 text-xs">
                    <a href="tel:{{ \App\Models\Setting::get('contact_phone', '+880 1800-000000') }}" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors flex items-center gap-1.5 font-semibold">
                        <svg class="w-3.5 h-3.5 text-[#003C58] dark:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>{{ \App\Models\Setting::get('contact_phone', '+880 1800-000000') }}</span>
                    </a>
                    <a href="mailto:{{ \App\Models\Setting::get('contact_email', 'operations@nordroy.com') }}" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors hidden sm:flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-[#003C58] dark:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>{{ \App\Models\Setting::get('contact_email', 'operations@nordroy.com') }}</span>
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="px-2.5 py-1 rounded-md bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-[11px] font-bold text-slate-700 dark:text-slate-300 transition-colors">
                        Admin Portal &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- STICKY GLASSMORPHISM PUBLIC HEADER -->
        <header class="sticky top-0 z-40 glass-nav border-b border-slate-200/90 dark:border-slate-800 transition-colors duration-200">
            <div class="max-w-[1536px] mx-auto px-4 sm:px-8 h-20 flex items-center justify-between">
                
                <!-- Brand Logo & Title -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset(\App\Models\Setting::get('site_logo', 'assets/images/logo.png')) }}" 
                         alt="{{ \App\Models\Setting::get('site_name', 'Nordroy Marine') }}" 
                         class="h-10 w-auto object-contain dark:brightness-110 group-hover:scale-102 transition-transform duration-200" />
                </a>

                <!-- DESKTOP MULTI-LAYER NAVIGATION LINKS WITH CLEAN SUBMENUS (Consistent Title Case) -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2 text-[13px] font-semibold text-slate-700 dark:text-slate-200 tracking-normal">
                    
                    <!-- 1. Home Link -->
                    <a href="{{ route('home') }}" 
                       class="px-3 py-2 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-100/70 dark:hover:bg-slate-800/60 transition-colors {{ request()->routeIs('home') ? 'text-[#003C58] dark:text-cyan-400 font-bold' : '' }}">
                        Home
                    </a>

                    <!-- 2. About Conglomerate (Dropdown) -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button type="button" class="px-3 py-2 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-100/70 dark:hover:bg-slate-800/60 transition-colors inline-flex items-center gap-1 cursor-pointer">
                            <span>About Us</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <!-- Submenu Dropdown Card -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute left-0 mt-1 w-64 rounded-2xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-xl py-3 px-2 z-50"
                             style="display: none;">
                            <div class="px-3 py-1.5 text-[10px] font-bold uppercase tracking-widest text-slate-400">Conglomerate Structure</div>
                            <a href="{{ route('about') }}#overview" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-[#003C58] dark:hover:text-cyan-400 transition-all">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                                Corporate Heritage &amp; Profile
                            </a>
                            <a href="{{ route('about') }}#mission" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-[#003C58] dark:hover:text-cyan-400 transition-all">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                                Mission, Vision &amp; Core Values
                            </a>
                            <a href="{{ route('about') }}#leadership" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-[#003C58] dark:hover:text-cyan-400 transition-all">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                                Leadership &amp; Engineering Board
                            </a>
                            <a href="{{ route('about') }}#certifications" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-[#003C58] dark:hover:text-cyan-400 transition-all">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                                ISO 9001:2015 &amp; DNV Standards
                            </a>
                        </div>
                    </div>

                    <!-- 3. Overhaul Services (Dropdown) -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button type="button" class="px-3 py-2 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-100/70 dark:hover:bg-slate-800/60 transition-colors inline-flex items-center gap-1 cursor-pointer">
                            <span>Services</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute left-0 mt-1 w-72 rounded-2xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-xl py-3 px-2 z-50"
                             style="display: none;">
                            <div class="px-3 py-1.5 text-[10px] font-bold uppercase tracking-widest text-slate-400">Precision Engineering</div>
                            <a href="{{ route('services') }}#balancing" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-[#003C58] dark:hover:text-cyan-400 transition-all">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                                Dynamic Rotor Balancing (100k RPM)
                            </a>
                            <a href="{{ route('services') }}#overhaul" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-[#003C58] dark:hover:text-cyan-400 transition-all">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                                Turbine Blading &amp; TIG Welding
                            </a>
                            <a href="{{ route('services') }}#cartridge" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-[#003C58] dark:hover:text-cyan-400 transition-all">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                                Cartridge (CHRA) Exchange &amp; Rebuild
                            </a>
                            <a href="{{ route('services') }}#ultrasonic" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-[#003C58] dark:hover:text-cyan-400 transition-all">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                                Ultrasonic Chemical Cleaning
                            </a>
                            <a href="{{ route('services') }}#flying-squad" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-[#003C58] dark:hover:text-cyan-400 transition-all">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                                24/7 Port Flying Squads to Vessel
                            </a>
                        </div>
                    </div>

                    <!-- 4. Business Units -->
                    <a href="{{ route('home') }}#divisions" class="px-3 py-2 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-100/70 dark:hover:bg-slate-800/60 transition-colors">
                        Business Units
                    </a>

                    <!-- 5. Projects & Media (Dropdown) -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button type="button" class="px-3 py-2 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-100/70 dark:hover:bg-slate-800/60 transition-colors inline-flex items-center gap-1 cursor-pointer">
                            <span>Projects &amp; Media</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute left-0 mt-1 w-64 rounded-2xl bg-white dark:bg-[#0b1b2b] border border-slate-200 dark:border-slate-800 shadow-xl py-3 px-2 z-50"
                             style="display: none;">
                            <div class="px-3 py-1.5 text-[10px] font-bold uppercase tracking-widest text-slate-400">Portfolio &amp; Media</div>
                            <a href="{{ route('projects') }}#projects" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-[#003C58] dark:hover:text-cyan-400 transition-all">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                                Industrial Projects
                            </a>
                            <a href="{{ route('projects') }}#videos" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-[#003C58] dark:hover:text-cyan-400 transition-all">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                                Video Gallery (Hover Play)
                            </a>
                            <a href="{{ route('projects') }}#photos" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-[#003C58] dark:hover:text-cyan-400 transition-all">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                                Photo Gallery &amp; Workshops
                            </a>
                        </div>
                    </div>

                    <!-- 6. Contact Link -->
                    <a href="{{ route('contact') }}" 
                       class="px-3 py-2 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-100/70 dark:hover:bg-slate-800/60 transition-colors {{ request()->routeIs('contact') ? 'text-[#003C58] dark:text-cyan-400 font-bold' : '' }}">
                        Contact
                    </a>

                </nav>

                <!-- Header Actions: Theme Toggle + CTA + Mobile Hamburger -->
                <div class="flex items-center gap-3 sm:gap-4">
                    
                    <!-- Theme Toggle -->
                    <button type="button" @click="toggleTheme()" onclick="window.toggleSiteTheme && window.toggleSiteTheme()"
                            class="p-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-100/80 dark:bg-slate-900 text-slate-700 dark:text-amber-400 hover:bg-slate-200/80 dark:hover:bg-slate-800 transition-colors cursor-pointer"
                            title="Toggle Light/Dark Theme">
                        <svg x-show="!isDark" class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg x-show="isDark" class="w-4 h-4 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <!-- Instant RFQ CTA Button -->
                    <a href="{{ route('contact') }}#rfq" 
                       class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white shadow-md active:scale-95 transition-all"
                       style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); border-radius: var(--button-radius);">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Request RFQ</span>
                    </a>

                    <!-- Mobile Hamburger Button -->
                    <button type="button" @click="mobileNavOpen = true" class="lg:hidden p-2 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </header>

        <!-- ==================== MODERN OFF-CANVAS SLIDE-OVER MOBILE DRAWER ==================== -->
        <div x-show="mobileNavOpen" 
             class="fixed inset-0 z-50 lg:hidden overflow-hidden" 
             style="display: none;">
            
            <!-- Backdrop Overlay -->
            <div x-show="mobileNavOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="mobileNavOpen = false"
                 class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs transition-opacity"></div>

            <!-- Slide-over Drawer Panel -->
            <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
                <div x-show="mobileNavOpen"
                     x-transition:enter="transform transition ease-in-out duration-300"
                     x-transition:enter-start="translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transform transition ease-in-out duration-200"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="translate-x-full"
                     class="w-screen max-w-sm bg-white dark:bg-[#07131e] border-l border-slate-200 dark:border-slate-800 flex flex-col justify-between shadow-2xl">
                    
                    <!-- Drawer Header -->
                    <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                        <img src="{{ asset(\App\Models\Setting::get('site_logo', 'assets/images/logo.png')) }}" 
                             alt="{{ \App\Models\Setting::get('site_name', 'Nordroy Marine') }}" 
                             class="h-8 w-auto object-contain dark:brightness-110" />
                        <div class="flex items-center gap-2">
                            <button type="button" @click="toggleTheme()" onclick="window.toggleSiteTheme && window.toggleSiteTheme()"
                                    class="p-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-100/80 dark:bg-slate-900 text-slate-700 dark:text-amber-400 cursor-pointer"
                                    title="Toggle Light/Dark Theme">
                                <svg x-show="!isDark" class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <svg x-show="isDark" class="w-4 h-4 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                </svg>
                            </button>
                            <button type="button" @click="mobileNavOpen = false" class="p-2 rounded-xl text-slate-500 hover:text-slate-800 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Drawer Nav Items (with Accordion Submenus - Pure Title Case) -->
                    <div class="flex-1 overflow-y-auto p-5 space-y-2 text-sm font-semibold tracking-normal">
                        
                        <a href="{{ route('home') }}" @click="mobileNavOpen = false" 
                           class="block py-2.5 px-3 rounded-xl text-slate-800 dark:text-slate-200 hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors {{ request()->routeIs('home') ? 'bg-slate-100 dark:bg-slate-800 font-bold text-[#003C58] dark:text-cyan-400' : '' }}">
                            Home
                        </a>

                        <!-- About Us Accordion -->
                        <div class="border-b border-slate-100 dark:border-slate-800/80 pb-2">
                            <button type="button" @click="activeMobileSubmenu = (activeMobileSubmenu === 'about' ? null : 'about')" 
                                    class="w-full flex items-center justify-between py-2.5 px-3 rounded-xl text-slate-800 dark:text-slate-200 hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer transition-colors">
                                <span>About Us</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="activeMobileSubmenu === 'about' ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div x-show="activeMobileSubmenu === 'about'" x-transition class="pl-4 pt-1 space-y-1.5 text-xs font-medium text-slate-600 dark:text-slate-400">
                                <a href="{{ route('about') }}#overview" @click="mobileNavOpen = false" class="block py-1.5 px-2.5 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">Corporate Heritage &amp; Profile</a>
                                <a href="{{ route('about') }}#mission" @click="mobileNavOpen = false" class="block py-1.5 px-2.5 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">Mission, Vision &amp; Core Values</a>
                                <a href="{{ route('about') }}#leadership" @click="mobileNavOpen = false" class="block py-1.5 px-2.5 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">Leadership &amp; Engineering Board</a>
                                <a href="{{ route('about') }}#certifications" @click="mobileNavOpen = false" class="block py-1.5 px-2.5 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">ISO 9001:2015 &amp; DNV Standards</a>
                            </div>
                        </div>

                        <!-- Services Accordion -->
                        <div class="border-b border-slate-100 dark:border-slate-800/80 pb-2">
                            <button type="button" @click="activeMobileSubmenu = (activeMobileSubmenu === 'services' ? null : 'services')" 
                                    class="w-full flex items-center justify-between py-2.5 px-3 rounded-xl text-slate-800 dark:text-slate-200 hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer transition-colors">
                                <span>Services</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="activeMobileSubmenu === 'services' ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div x-show="activeMobileSubmenu === 'services'" x-transition class="pl-4 pt-1 space-y-1.5 text-xs font-medium text-slate-600 dark:text-slate-400">
                                <a href="{{ route('services') }}#balancing" @click="mobileNavOpen = false" class="block py-1.5 px-2.5 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">Dynamic Rotor Balancing (100k RPM)</a>
                                <a href="{{ route('services') }}#overhaul" @click="mobileNavOpen = false" class="block py-1.5 px-2.5 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">Turbine Blading &amp; TIG Welding</a>
                                <a href="{{ route('services') }}#cartridge" @click="mobileNavOpen = false" class="block py-1.5 px-2.5 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">Cartridge (CHRA) Exchange</a>
                                <a href="{{ route('services') }}#ultrasonic" @click="mobileNavOpen = false" class="block py-1.5 px-2.5 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">Ultrasonic Chemical Cleaning</a>
                                <a href="{{ route('services') }}#flying-squad" @click="mobileNavOpen = false" class="block py-1.5 px-2.5 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">24/7 Port Emergency Flying Squads</a>
                            </div>
                        </div>

                        <a href="{{ route('home') }}#divisions" @click="mobileNavOpen = false" 
                           class="block py-2.5 px-3 rounded-xl text-slate-800 dark:text-slate-200 hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-100 dark:hover:bg-slate-800 border-b border-slate-100 dark:border-slate-800/80 pb-2 transition-colors">
                            Business Units
                        </a>

                        <!-- Projects Accordion -->
                        <div class="border-b border-slate-100 dark:border-slate-800/80 pb-2">
                            <button type="button" @click="activeMobileSubmenu = (activeMobileSubmenu === 'projects' ? null : 'projects')" 
                                    class="w-full flex items-center justify-between py-2.5 px-3 rounded-xl text-slate-800 dark:text-slate-200 hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer transition-colors">
                                <span>Projects &amp; Media</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="activeMobileSubmenu === 'projects' ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div x-show="activeMobileSubmenu === 'projects'" x-transition class="pl-4 pt-1 space-y-1.5 text-xs font-medium text-slate-600 dark:text-slate-400">
                                <a href="{{ route('projects') }}#projects" @click="mobileNavOpen = false" class="block py-1.5 px-2.5 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">Featured Industrial Projects</a>
                                <a href="{{ route('projects') }}#videos" @click="mobileNavOpen = false" class="block py-1.5 px-2.5 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">Video Gallery (Hover to Play)</a>
                                <a href="{{ route('projects') }}#photos" @click="mobileNavOpen = false" class="block py-1.5 px-2.5 rounded-lg hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">Photo Gallery &amp; Workshops</a>
                            </div>
                        </div>

                        <a href="{{ route('contact') }}" @click="mobileNavOpen = false" 
                           class="block py-2.5 px-3 rounded-xl text-slate-800 dark:text-slate-200 hover:text-[#003C58] dark:hover:text-cyan-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors {{ request()->routeIs('contact') ? 'bg-slate-100 dark:bg-slate-800 font-bold text-[#003C58] dark:text-cyan-400' : '' }}">
                            Contact &amp; RFQ
                        </a>
                    </div>

                    <!-- Drawer Footer CTA & Emergency Info -->
                    <div class="p-5 border-t border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 space-y-3">
                        <a href="{{ route('contact') }}#rfq" @click="mobileNavOpen = false" 
                           class="w-full inline-flex items-center justify-center py-3 rounded-xl text-xs font-bold uppercase tracking-wider text-white shadow-md"
                           style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color));">
                            Request Instant RFQ
                        </a>
                        <div class="text-[11px] text-slate-500 dark:text-slate-400 text-center font-medium">
                            24/7 Port Helpline: <a href="tel:{{ \App\Models\Setting::get('contact_phone', '+880 1800-000000') }}" class="font-bold text-[#003C58] dark:text-cyan-400">{{ \App\Models\Setting::get('contact_phone', '+880 1800-000000') }}</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- MAIN PAGE CONTENT -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- ==================== CORPORATE FOOTER (Light Mode: Clean Light Slate, Dark Mode: Shipyard Navy) ==================== -->
        <footer class="bg-slate-100/95 dark:bg-[#040e17]/95 text-slate-700 dark:text-slate-300 border-t border-slate-200 dark:border-slate-800 pt-16 pb-12 transition-colors duration-200">
            <div class="max-w-[1536px] mx-auto px-4 sm:px-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-200 dark:border-slate-800/80">
                    
                    <!-- Col 1: Brand Info & Mission (2 cols on lg) -->
                    <div class="lg:col-span-2 space-y-4">
                        <img src="{{ asset(\App\Models\Setting::get('site_logo', 'assets/images/logo.png')) }}" 
                             alt="{{ \App\Models\Setting::get('site_name', 'Nordroy Marine') }}" 
                             class="h-10 w-auto object-contain dark:brightness-110" />
                        
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed max-w-md">
                            A premier industrial conglomerate and maritime engineering group specializing in authorized multi-brand exhaust gas turbocharger overhauls, dynamic rotor balancing up to 100,000 RPM, genuine OEM spare parts supply, and technical port assistance across global maritime hubs.
                        </p>

                        <!-- Social Media Links (Rendered Dynamically from Settings Engine) -->
                        <div class="flex items-center gap-2 pt-2">
                            @php
                                $socialLinks = json_decode(\App\Models\Setting::get('social_links_data', '[]'), true) ?: [];
                            @endphp
                            @forelse($socialLinks as $link)
                                <a href="{{ $link['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" 
                                   title="{{ $link['platform'] ?? 'Social Link' }}"
                                   class="w-8 h-8 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 hover:text-[#003C58] dark:hover:text-cyan-400 hover:border-[#003C58] dark:hover:border-cyan-400 transition-all">
                                    <x-icon :name="$link['icon'] ?? 'solid:globe'" class="w-3.5 h-3.5" />
                                </a>
                            @empty
                                <a href="#" class="w-8 h-8 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-slate-700 dark:hover:text-white"><x-icon name="solid:globe" class="w-3.5 h-3.5" /></a>
                            @endforelse
                        </div>
                    </div>

                    <!-- Col 2: Business Units -->
                    <div class="space-y-3">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900 dark:text-white font-heading">Business Units</h4>
                        <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                            <li><a href="{{ route('home') }}#divisions" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">Marine Turbochargers</a></li>
                            <li><a href="{{ route('home') }}#divisions" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">Captive Power Generation</a></li>
                            <li><a href="{{ route('home') }}#divisions" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">Spare Parts Distribution</a></li>
                            <li><a href="{{ route('home') }}#divisions" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">Non-Destructive Testing (NDT)</a></li>
                            <li><a href="{{ route('home') }}#divisions" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">Gas Compressor Solutions</a></li>
                        </ul>
                    </div>

                    <!-- Col 3: Technical Services -->
                    <div class="space-y-3">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900 dark:text-white font-heading">Technical Services</h4>
                        <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                            <li><a href="{{ route('services') }}#balancing" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">Dynamic Rotor Balancing</a></li>
                            <li><a href="{{ route('services') }}#overhaul" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">Turbine Blading &amp; Welding</a></li>
                            <li><a href="{{ route('services') }}#cartridge" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">Cartridge Reconditioning</a></li>
                            <li><a href="{{ route('services') }}#ultrasonic" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">Ultrasonic Chemical Cleaning</a></li>
                            <li><a href="{{ route('services') }}#flying-squad" class="hover:text-[#003C58] dark:hover:text-cyan-400 transition-colors">24/7 Port Emergency Call</a></li>
                        </ul>
                    </div>

                    <!-- Col 4: Corporate Offices & Workshops -->
                    <div class="space-y-3">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900 dark:text-white font-heading">Port &amp; HQ Offices</h4>
                        <div class="text-xs text-slate-600 dark:text-slate-400 space-y-2.5">
                            <div>
                                <p class="font-bold text-slate-800 dark:text-slate-200">Chattogram Port Workshop:</p>
                                <p>Near Marine Academy Jetty, Chattogram Port, Bangladesh.</p>
                            </div>
                            <div>
                                <p class="font-bold text-slate-800 dark:text-slate-200">Dhaka Corporate HQ:</p>
                                <p>{{ \App\Models\Setting::get('company_address', 'Gulshan Industrial Area, Dhaka, Bangladesh') }}</p>
                            </div>
                            <div class="pt-1">
                                <a href="tel:{{ \App\Models\Setting::get('contact_phone', '+880 1800-000000') }}" class="text-[#003C58] dark:text-cyan-400 font-bold block">
                                    Emergency: {{ \App\Models\Setting::get('contact_phone', '+880 1800-000000') }}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Bottom Copyright Strip -->
                <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                    <p>&copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'Nordroy CMS') }}. All rights reserved. Maritime Engineering &amp; Industrial Overhauls.</p>
                    <div class="flex items-center gap-6">
                        <span class="inline-flex items-center gap-1.5 text-slate-600 dark:text-slate-400 font-semibold">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            ISO 9001:2015 &amp; DNV Certified
                        </span>
                        <a href="{{ route('login') }}" class="hover:text-slate-700 dark:hover:text-slate-300 transition-colors">Staff Login</a>
                    </div>
                </div>

            </div>
        </footer>

    </div>

    <!-- ==================== GLOBAL IMAGE LIGHTBOX PREVIEW MODAL ==================== -->
    <div x-data="{ open: false, src: '', title: '' }"
         @open-lightbox.window="open = true; src = $event.detail.src; title = $event.detail.title || 'Workshop Facility Inspection'"
         @keydown.escape.window="open = false"
         x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[10000] bg-slate-950/90 backdrop-blur-md flex items-center justify-center p-4 sm:p-8 select-none"
         style="display: none;">
        
        <div class="relative max-w-5xl w-full flex flex-col items-center" @click.outside="open = false">
            <button type="button" @click="open = false" 
                    class="self-end mb-3 px-3 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold uppercase tracking-wider flex items-center gap-1.5 transition-colors cursor-pointer">
                <span>Close (Esc)</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="rounded-3xl overflow-hidden shadow-2xl border border-slate-700 max-h-[80vh] flex items-center justify-center bg-black">
                <img :src="src" :alt="title" class="max-h-[75vh] w-auto max-w-full object-contain" />
            </div>
            <p x-text="title" class="mt-3 text-sm font-semibold text-white/90 text-center tracking-wide font-heading"></p>
        </div>
    </div>

    @livewireScripts
</body>
</html>
