<header x-data="{ open: false }" data-site-header data-scrolled="false"
    class="sticky top-0 z-30 border-b border-slate-200/80 bg-white/85 backdrop-blur transition-all duration-300 data-[scrolled=true]:border-violet-200 data-[scrolled=true]:bg-white/95 data-[scrolled=true]:shadow-[0_12px_30px_rgba(15,23,42,0.08)]">
    <div class="w-full items-center justify-between gap-3 px-4 py-4 md:px-6">
        <div class="max-w-7xl flex w-full items-center justify-between gap-6 mx-auto">

            <a href="{{ url('/') }}"
                class="inline-flex items-center gap-3 text-base font-extrabold tracking-tight text-slate-900 sm:text-lg">
                <img src="{{ asset('img/EOLogo.png') }}" alt="JoinFest logo" class="h-9 w-9 rounded-full object-cover">
                <span>{{ config('app.name') }}</span>
            </a>

            <div class="hidden min-w-0 flex-1 items-center justify-center px-4 lg:flex">
                <div class="relative w-full max-w-md">
                    <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>
                    <input type="text" placeholder="Cari event, konser, atau artis..."
                        class="h-11 w-full rounded-full border border-slate-200 bg-slate-50 py-2 pl-9 pr-4 text-sm text-slate-700 outline-none transition focus:border-violet-500 focus:bg-white focus:ring-4 focus:ring-violet-500/10">
                </div>
            </div>

            <nav class="hidden items-stretch gap-6 text-sm font-semibold md:flex">
                <x-nav-link href="{{ url('/') }}" :active="request()->is('/')">
                    Beranda
                </x-nav-link>
                <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index') || request()->routeIs('events.show')">
                    Jelajahi Event
                </x-nav-link>

                @auth
                    <x-nav-link :href="url('/dashboard')" :active="request()->is('dashboard*') || request()->is('profile*')">
                        Dashboard
                    </x-nav-link>
                @else
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        Masuk
                    </x-nav-link>
                    <div class="flex items-center ml-2">
                        <a href="{{ route('register') }}"
                            class="inline-flex h-9 items-center justify-center rounded-full bg-violet-600 px-4 text-white transition hover:-translate-y-0.5 hover:bg-violet-700">Daftar</a>
                    </div>
                @endauth
            </nav>

            <button @click="open = !open" type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 transition hover:border-violet-200 hover:text-violet-600 focus:outline-none focus:ring-2 focus:ring-violet-500/30 md:hidden"
                aria-controls="mobile-menu" :aria-expanded="open.toString()">
                <svg x-show="!open" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6l-12 12" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu" x-show="open" x-transition
            class="border-t border-slate-200 bg-white px-4 pb-4 pt-3 md:hidden">
            <div class="grid gap-2">
                <x-responsive-nav-link href="{{ url('/#kategori') }}" :active="request()->routeIs('landing')">
                    Beranda
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                    Jelajahi Event
                </x-responsive-nav-link>
                @auth
                    <x-responsive-nav-link :href="url('/dashboard')" :active="request()->is('dashboard*') || request()->is('profile*')">
                        Dashboard
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        Masuk
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        Daftar
                    </x-responsive-nav-link>
                @endauth
            </div>
        </div>
    </div>
</header>
