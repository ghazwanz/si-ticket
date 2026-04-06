<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'JoinFest') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-foreground antialiased bg-secondary/30">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-6 text-center">
                <a href="/" class="inline-flex flex-col items-center gap-3">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary shadow-sm hover:opacity-90 transition-opacity">
                        <x-heroicon-s-command-line class="h-6 w-6 text-primary-foreground" />
                    </div>
                    <span class="font-bold text-2xl text-foreground tracking-tight">{{ config('app.name', 'JoinFest') }}</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-8 bg-card border border-border/60 shadow-sm sm:rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
