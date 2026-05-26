<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
      :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' - ' . config('app.name', 'JoinFest') : config('app.name', 'JoinFest') }}</title>

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            [x-cloak] { display: none !important; }
            .page-fade-in {
                animation: fadeIn 0.4s ease-out;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(8px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
        @stack('head')
    </head>
    <body class="font-sans antialiased bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 min-h-screen flex flex-col transition-colors duration-300">
        {{-- Background Ambient Glows --}}
        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
            <div class="absolute -top-40 right-0 w-[500px] h-[500px] rounded-full bg-violet-600/5 dark:bg-violet-600/10 blur-3xl"></div>
            <div class="absolute top-[40%] -left-20 w-[400px] h-[400px] rounded-full bg-emerald-600/5 dark:bg-emerald-600/5 blur-3xl"></div>
        </div>

        {{-- SPA Loader --}} 
        <div id="spa-loader" class="fixed top-0 left-0 w-full h-1 z-[9999] hidden">
            <div class="h-full bg-violet-600 animate-progress shadow-[0_0_10px_rgba(124,58,237,0.5)]"></div>
        </div>

        {{-- Header --}}
        <x-home.header />

        {{-- Main Page Content --}}
        <main data-page-shell class="flex-1 page-fade-in">
            <div data-reveal data-reveal-delay="80" class="transition-all duration-700 ease-out">
                {{ $slot }}
            </div>
        </main>

        {{-- Footer --}}
        <x-home.footer />

        {{-- Modals and Scripts --}}
        <div id="spa-modals">
            @stack('modals')
        </div>
        @stack('scripts')
    </body>
</html>
