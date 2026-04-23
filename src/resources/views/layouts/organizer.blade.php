<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'JoinFest Organizer Console')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Syne:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-display { font-family: 'Syne', sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="bg-[#F8F9FC] text-gray-900 antialiased">

    <div class="flex h-screen overflow-hidden">
        <!-- SIDEBAR -->
        <x-organizer.sidebar />

        <!-- MAIN CONTENT -->
        <div class="flex flex-col flex-1 overflow-hidden ml-64">
            <!-- TOP BAR -->
            <header class="bg-white border-b border-gray-200/70 h-16 flex items-center justify-between px-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <h1 class="text-lg font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center gap-4">
                    <button class="p-1.5 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </button>
                    <div class="flex items-center gap-2 border-l pl-4">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-600 to-indigo-800 flex items-center justify-center text-white text-xs font-bold">KC</div>
                        <div class="hidden sm:block">
                            <p class="text-sm font-medium text-gray-700">Karsa Creative</p>
                            <p class="text-xs text-gray-500">Organizer Terverifikasi</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>