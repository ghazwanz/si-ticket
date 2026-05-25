<header x-data="{ open: false }" data-site-header data-scrolled="false"
    class="sticky top-0 z-30 border-b border-slate-200/80 dark:border-slate-800/80 bg-white/85 dark:bg-slate-950/85 backdrop-blur transition-all duration-300 data-[scrolled=true]:border-violet-200 data-[scrolled=true]:dark:border-violet-900/50 data-[scrolled=true]:bg-white/95 data-[scrolled=true]:dark:bg-slate-950/95 data-[scrolled=true]:shadow-[0_12px_30px_rgba(15,23,42,0.08)] data-[scrolled=true]:dark:shadow-[0_12px_30px_rgba(0,0,0,0.5)]">
    <div class="w-full items-center justify-between gap-3 px-4 py-4 md:px-6">
        <div class="max-w-7xl flex w-full items-center justify-between gap-6 mx-auto">

            <a href="{{ url('/') }}" data-link
                class="inline-flex items-center gap-3 text-base font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-lg">
                <img src="{{ asset('img/EOLogo.png') }}" alt="JoinFest logo" class="h-9 w-9 rounded-full object-cover">
                <span>{{ config('app.name') }}</span>
            </a>

            <div class="hidden min-w-0 flex-1 items-center justify-center px-4 lg:flex">
                <div class="relative w-full max-w-md">
                    <x-heroicon-o-magnifying-glass class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400 dark:text-slate-500" />
                    <input type="text" placeholder="Cari event, konser, atau artis..."
                        class="h-11 w-full rounded-full border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 py-2 pl-9 pr-4 text-sm text-slate-700 dark:text-slate-200 outline-none transition focus:border-violet-500 dark:focus:border-violet-500 focus:bg-white dark:focus:bg-slate-955 focus:ring-4 focus:ring-violet-500/10 dark:focus:ring-violet-500/5">
                </div>
            </div>

            <div class="flex items-center gap-3">
                {{-- Dark Mode Toggle --}}
                <button @click="darkMode = !darkMode" type="button"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 transition hover:border-violet-200 dark:hover:border-violet-800 hover:text-violet-600 dark:hover:text-violet-400 focus:outline-none focus:ring-2 focus:ring-violet-500/30"
                    aria-label="Toggle Dark Mode">
                    <x-heroicon-o-moon x-show="!darkMode" class="w-5 h-5" />
                    <x-heroicon-o-sun x-show="darkMode" class="w-5 h-5" />
                </button>

                {{-- Desktop Navigation --}}
                <nav class="hidden items-center gap-6 text-sm font-semibold md:flex">
                    <x-nav-link href="{{ url('/') }}" data-link :active="request()->is('/')">
                        Beranda
                    </x-nav-link>
                    <x-nav-link :href="route('events.index')" data-link :active="request()->routeIs('events.index') || request()->routeIs('events.show')">
                        Jelajahi Acara
                    </x-nav-link>

                    @auth
                        <x-nav-link :href="url('/dashboard')" data-link :active="request()->is('dashboard*') || request()->is('profile*')">
                            Dashboard
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('login')" data-link :active="request()->routeIs('login')">
                            Masuk
                        </x-nav-link>
                        <div class="flex items-center ml-2">
                            <a href="{{ route('register') }}" data-link
                                class="inline-flex h-9 items-center justify-center rounded-full bg-violet-600 px-4 text-white transition hover:-translate-y-0.5 hover:bg-violet-700 shadow-md shadow-violet-600/10">Daftar</a>
                        </div>
                    @endauth
                </nav>

                {{-- Mobile Menu Button --}}
                <button @click="open = !open" type="button"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 transition hover:border-violet-200 dark:hover:border-violet-800 hover:text-violet-600 dark:hover:text-violet-400 focus:outline-none focus:ring-2 focus:ring-violet-500/30 md:hidden"
                    aria-controls="mobile-menu" :aria-expanded="open.toString()">
                    <x-heroicon-o-bars-3 x-show="!open" class="h-5 w-5" />
                    <x-heroicon-o-x-mark x-show="open" x-cloak class="h-5 w-5" />
                </button>
            </div>
        </div>

        {{-- Mobile Navigation Dropdown --}}
        <div id="mobile-menu" x-show="open" x-transition
            class="border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-4 pb-4 pt-3 md:hidden rounded-2xl mt-2 shadow-lg">
            <div class="grid gap-2">
                <x-responsive-nav-link href="{{ url('/') }}" data-link :active="request()->is('/')">
                    Beranda
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('events.index')" data-link :active="request()->routeIs('events.index')">
                    Jelajahi Acara
                </x-responsive-nav-link>
                @auth
                    <x-responsive-nav-link :href="url('/dashboard')" data-link :active="request()->is('dashboard*') || request()->is('profile*')">
                        Dashboard
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('login')" data-link :active="request()->routeIs('login')">
                        Masuk
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" data-link :active="request()->routeIs('register')">
                        Daftar
                    </x-responsive-nav-link>
                @endauth
            </div>
        </div>
    </div>
</header>
