<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: false, sidebarOpen: true }" :class="darkMode ? 'dark' : ''">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'JoinFest Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Syne', 'sans-serif'],
                        body: ['DM Sans', 'sans-serif'],
                    },
                    colors: {
                        sidebar: '#0f0f1a',
                        'sidebar-hover': '#1a1a2e',
                        brand: '#6C47FF',
                        'brand-hover': '#5535e0',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        h1,h2,h3,.font-display { font-family: 'Syne', sans-serif; }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #374151; border-radius: 4px; }
        .nav-link-active { background: linear-gradient(90deg, #6C47FF22 0%, transparent 100%); border-left: 3px solid #6C47FF; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white min-h-screen flex">

{{-- ── SIDEBAR ── --}}
<aside class="w-56 bg-sidebar flex flex-col min-h-screen fixed left-0 top-0 bottom-0 z-40">
    {{-- Logo --}}
    <div class="px-5 pt-6 pb-5 border-b border-white/5">
        <div class="font-display font-bold text-white text-lg leading-tight">JoinFest<span class="text-brand">Admin</span></div>
        <div class="text-xs text-gray-400 font-semibold tracking-widest mt-0.5">SUPER USER</div>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 px-3 py-4 space-y-0.5">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
                  {{ request()->routeIs('admin.dashboard') ? 'nav-link-active text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
            </svg>
            Dashboard
        </a>
        <a href="{{ route('admin.users') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
                  {{ request()->routeIs('admin.users*') ? 'nav-link-active text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            User Management
        </a>
        <a href="{{ route('admin.events') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
                  {{ request()->routeIs('admin.events*') ? 'nav-link-active text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            Event Oversight
        </a>
        <a href="{{ route('admin.settings') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
                  {{ request()->routeIs('admin.settings*') ? 'nav-link-active text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.07 4.93a10 10 0 0 0-14.14 0M4.93 19.07a10 10 0 0 0 14.14 0M19.07 19.07a10 10 0 0 0 0-14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
            </svg>
            System Settings
        </a>
    </nav>

    {{-- Quick Action --}}
    <div class="px-3 pb-4">
        <button class="w-full bg-brand hover:bg-brand-hover text-white font-bold text-sm py-2.5 rounded-xl transition-all hover:shadow-lg hover:shadow-brand/30">
            Quick Action
        </button>
        <div class="mt-4 space-y-0.5">
            <a href="#" class="flex items-center gap-2.5 px-3 py-2 text-gray-400 hover:text-white text-sm transition-colors">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                Support
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2.5 px-3 py-2 text-gray-400 hover:text-white text-sm transition-colors w-full">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- ── MAIN WRAPPER ── --}}
<div class="ml-56 flex-1 flex flex-col min-h-screen">

    {{-- TOPBAR --}}
    <header class="h-14 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between px-6 sticky top-0 z-30">
        <div class="flex items-center gap-3">
            <span class="font-display font-bold text-base">JoinFest Control</span>
            @hasSection('topbar_badge')
                @yield('topbar_badge')
            @endif
        </div>
        <div class="flex items-center gap-3">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                </svg>
                <input type="text" placeholder="@yield('search_placeholder', 'Cari...')"
                       class="pl-9 pr-4 py-1.5 text-sm bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand/30 w-52">
            </div>
            <button class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
            </button>
            <button class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
            </button>
            <button @click="darkMode = !darkMode" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
                <svg x-show="!darkMode" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                </svg>
                <svg x-show="darkMode" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                    <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
                </svg>
            </button>
            <div class="flex items-center gap-2">
                <div class="hidden sm:block text-right">
                    <div class="text-sm font-semibold leading-tight">Admin Utama</div>
                    <div class="text-xs text-gray-400">Administrator</div>
                </div>
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand to-purple-800 flex items-center justify-center text-white text-xs font-bold">A</div>
            </div>
        </div>
    </header>

    {{-- PAGE CONTENT --}}
    <main class="flex-1 p-6 dark:bg-gray-950">
        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>