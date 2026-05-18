<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'JoinFest') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased min-h-screen bg-slate-50 text-slate-900">
        <main class="grid min-h-screen place-items-center px-4 py-6 sm:px-6 lg:px-8">
            <section
                class="w-full max-w-2xl rounded-2xl border border-slate-200/60 bg-white p-6 shadow-sm sm:p-10"
            >
                {{ $slot }}
            </section>
        </main>
    </body>
</html>
