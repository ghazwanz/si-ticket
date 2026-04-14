<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'JoinFest') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-foreground" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen bg-background">
            {{-- Mobile sidebar overlay --}}
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-black/50 md:hidden" @click="sidebarOpen = false" x-cloak></div>

            {{-- Sidebar --}}
            @include('layouts.navigation')

            {{-- Main content area --}}
            <div class="md:pl-56">
                {{-- Top header bar --}}
                <header class="sticky top-0 z-20 border-b border-border bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
                    <div class="flex items-center justify-between h-14 px-4 sm:px-6 lg:px-8">
                        {{-- Mobile hamburger --}}
                        <button @click="sidebarOpen = true" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-muted-foreground hover:text-foreground hover:bg-secondary transition-colors cursor-pointer">
                            <x-heroicon-o-bars-3 class="h-5 w-5" />
                        </button>

                        {{-- Page Heading --}}
                        @isset($header)
                            <div class="flex-1 min-w-0">
                                {{ $header }}
                            </div>
                        @endisset
                    </div>
                </header>

                {{-- Page Content --}}
                <main>
                    <!-- @yield('content') -->
                     {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
