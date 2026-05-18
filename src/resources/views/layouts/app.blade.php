<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'JoinFest') }}</title>

        <!-- Scripts -->
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
    </head>
    <body class="font-sans antialiased text-foreground" 
          x-data="{ 
              sidebarOpen: false,
              sidebarMini: localStorage.getItem('sidebarMini_app') === 'true'
          }"
          x-init="$watch('sidebarMini', val => localStorage.setItem('sidebarMini_app', val))">
        {{-- SPA Loader --}}
        <div id="spa-loader" class="fixed top-0 left-0 w-full h-1 z-[9999] hidden">
            <div class="h-full bg-violet-600 animate-progress shadow-[0_0_10px_rgba(124,58,237,0.5)]"></div>
        </div>
            <div class="min-h-screen bg-background">
            {{-- Mobile sidebar overlay --}}
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-black/50 md:hidden" @click="sidebarOpen = false" x-cloak></div>

            {{-- Sidebar --}}
            @include('layouts.navigation')

            {{-- Main content area --}}
            <div class="md:pl-56">
                {{-- Top header bar --}}
                <header data-site-header data-scrolled="false" class="sticky top-0 z-20 border-b border-border bg-background/95 backdrop-blur transition-all duration-300 supports-[backdrop-filter]:bg-background/60 data-[scrolled=true]:border-violet-200 data-[scrolled=true]:shadow-[0_12px_30px_rgba(15,23,42,0.08)]">
                    <div class="flex items-center justify-between h-14 px-4 sm:px-6 lg:px-8">
                        {{-- Mobile hamburger --}}
                        <button @click="sidebarOpen = true" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-muted-foreground hover:text-foreground hover:bg-secondary transition-colors cursor-pointer">
                            <x-heroicon-o-bars-3 class="h-5 w-5" />
                        </button>

                        {{-- Page Heading --}}
                        <div class="flex-1 min-w-0" id="spa-header">
                            @isset($header)
                                {{ $header }}
                            @endisset
                        </div>
                    </div>
                </header>

                {{-- Page Content --}}
                <main data-page-shell class="page-fade-in">
                    <div data-reveal data-reveal-delay="80" class="transition-all duration-700 ease-out">
                        <!-- @yield('content') -->
                         {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
        <div id="spa-modals">
            @stack('modals')
        </div>
    </body>
</html>
