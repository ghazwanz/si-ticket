<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'JoinFest') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body class="min-h-screen bg-[radial-gradient(circle_at_10%_8%,_#f7f2ff,_transparent_30%),_#eceef5] font-[Poppins,sans-serif] text-slate-900">
        <main class="grid min-h-screen place-items-center px-4 py-6">
            <section
                id="authCard"
                data-tilt
                data-reveal
                data-reveal-delay="0"
                aria-label="JoinFest authentication"
                class="w-full max-w-[620px] rounded-[20px] border border-slate-200 bg-white p-6 shadow-[0_20px_36px_rgba(20,25,38,0.1)] transition-transform duration-200 sm:p-10 opacity-0 translate-y-6 scale-[0.98] blur-sm"
            >
                {{ $slot }}
            </section>
        </main>
    </body>
</html>
