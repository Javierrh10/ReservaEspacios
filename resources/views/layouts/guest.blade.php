<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Outfit', sans-serif; }
            .noise {
                position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                pointer-events: none; opacity: 0.03; z-index: 9999;
                background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body class="antialiased selection:bg-purple-500/30 bg-[#030712] text-gray-100 min-h-screen">
        <div class="noise"></div>
        
        @include('layouts.navigation')

        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 pb-12">
            <div class="mt-12 mb-8">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-indigo-500 drop-shadow-[0_0_15px_rgba(99,102,241,0.5)]" />
                </a>
            </div>

            <div class="w-full sm:max-w-md glass-card rounded-3xl p-8 mx-4">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
