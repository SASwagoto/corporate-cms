<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \App\Models\Setting::get('site_name', 'Nordroy CMS') }} - Authentication</title>

    <!-- Dynamic Favicon (Adaptive Light & Dark Mode) -->
    @php
        $siteIconLight = \App\Models\Setting::get('site_icon', 'assets/images/icon.png');
        $siteIconDark = \App\Models\Setting::get('site_icon_dark', 'assets/images/icon-dark.png') ?: $siteIconLight;
    @endphp
    <link rel="icon" type="image/png" href="{{ asset($siteIconLight) }}" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" href="{{ asset($siteIconDark) }}" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" href="{{ asset($siteIconLight) }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Anti-FOUC Theme Script -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 antialiased font-sans">
    {{ $slot }}

    @livewireScripts
</body>
</html>