<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{
          darkMode: localStorage.getItem('darkMode') === 'true',
          sidebarOpen: window.innerWidth > 768,
          sidebarMini: localStorage.getItem('organizerSidebarMini') === 'true',
          scrolled: false
      }"
      x-init="
          $watch('darkMode', value => localStorage.setItem('darkMode', value));
          $watch('sidebarMini', value => localStorage.setItem('organizerSidebarMini', value));
          if (window.innerWidth > 768 && window.innerWidth < 1024 && localStorage.getItem('organizerSidebarMini') === null) {
              sidebarMini = true;
          }
      "
      :class="{ 'dark': darkMode }"
      @scroll.window="scrolled = window.pageYOffset > 20">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Konsol penyelenggara JoinFest untuk mengelola acara, tiket, merchandise, dan pemindaian QR secara terpadu.">
    <title>@yield('title', 'Konsol Penyelenggara JoinFest')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        [x-cloak] { display: none !important; }
        .page-fade-in { animation: fadeIn 0.4s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 font-sans antialiased selection:bg-violet-500/30">
    <div id="spa-loader" class="fixed top-0 left-0 w-full h-1 z-[9999] hidden">
        <div class="h-full bg-violet-600 animate-progress shadow-[0_0_10px_rgba(124,58,237,0.5)]"></div>
    </div>

    <x-organizer.sidebar />

    <div :class="[
            sidebarMini ? 'lg:pl-20' : 'lg:pl-64',
            sidebarOpen ? '' : 'pl-0'
        ]" class="sidebar-transition min-h-screen flex flex-col">
        <header :class="scrolled ? 'glass-panel shadow-sm py-2' : 'bg-transparent py-4'"
                class="sticky top-0 z-40 px-6 flex items-center justify-between transition-all duration-300">
            <div class="flex items-center gap-4">
                <button type="button" @click="if (window.innerWidth > 1024) { sidebarMini = !sidebarMini } else { sidebarOpen = !sidebarOpen }" class="p-2 rounded-xl text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    <x-heroicon-o-bars-3 class="w-6 h-6" />
                </button>
                <div class="hidden md:block" id="spa-header">
                    <h1 class="text-sm font-bold text-slate-400 uppercase tracking-widest">
                        @yield('page-title', 'Ringkasan Penyelenggara')
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="relative hidden sm:block">
                    <input type="text" placeholder="Cari cepat..."
                           class="w-64 pl-10 pr-4 py-2 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500/20 transition-all">
                    <x-heroicon-o-magnifying-glass class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" />
                </div>

                <button type="button" @click="darkMode = !darkMode" class="p-2 rounded-xl text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    <x-heroicon-o-moon x-show="!darkMode" class="w-5 h-5" />
                    <x-heroicon-o-sun x-show="darkMode" class="w-5 h-5" />
                </button>

                <button type="button" class="p-2 rounded-xl text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors relative">
                    <x-heroicon-o-bell class="w-5 h-5" />
                    <span class="absolute top-2 right-2 w-2 h-2 bg-emerald-500 rounded-full border-2 border-white dark:border-slate-950"></span>
                </button>

                <div class="relative ml-2" x-data="{ open: false }" @click.away="open = false">
                    <button type="button" @click="open = !open" class="flex items-center gap-3 p-1 rounded-2xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <div class="w-8 h-8 rounded-xl bg-violet-500 flex items-center justify-center font-bold text-white text-xs">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="hidden sm:block text-left">
                            <div class="text-[11px] font-bold text-slate-900 dark:text-white leading-none">{{ Auth::user()->name }}</div>
                            <div class="text-[10px] text-slate-400 font-medium mt-0.5 uppercase tracking-tighter">Penyelenggara</div>
                        </div>
                        <x-heroicon-m-chevron-down class="w-4 h-4 text-slate-400" />
                    </button>

                    <div x-show="open" x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         class="absolute right-0 mt-3 w-52 glass-panel rounded-2xl shadow-xl py-2 z-50">
                        <a href="{{ route('profile.index') }}" data-link class="flex items-center gap-3 px-4 py-2 text-sm text-slate-600 dark:text-slate-300 hover:bg-violet-500 hover:text-white transition-colors">
                            <x-heroicon-o-user class="w-4 h-4" />
                            Profil Saya
                        </a>
                        <a href="{{ route('organizer.settings') }}" data-link class="flex items-center gap-3 px-4 py-2 text-sm text-slate-600 dark:text-slate-300 hover:bg-violet-500 hover:text-white transition-colors">
                            <x-heroicon-o-cog-6-tooth class="w-4 h-4" />
                            Pengaturan
                        </a>
                        <div class="border-t border-slate-100 dark:border-slate-800 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-rose-500 hover:bg-rose-500 hover:text-white transition-colors">
                                <x-heroicon-o-arrow-right-on-rectangle class="w-4 h-4" />
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-6 page-fade-in">
            @yield('content')
        </main>

        <footer class="px-6 py-4 border-t border-slate-100 dark:border-slate-800 text-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">&copy; {{ date('Y') }} Ekosistem JoinFest. Dibangun untuk penyelenggaraan acara yang presisi.</p>
        </footer>
    </div>

    <div id="spa-modals">
        @stack('modals')
    </div>
    @stack('scripts')
</body>
</html>