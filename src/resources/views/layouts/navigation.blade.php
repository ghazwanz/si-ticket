{{-- Sidebar Navigation --}}
<aside
    data-reveal
    data-reveal-delay="0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-56 bg-background border-r border-border flex flex-col transition-transform duration-200 ease-in-out md:translate-x-0 opacity-0 translate-y-6 scale-[0.98] blur-sm"
>
    {{-- Brand --}}
    <div class="flex items-center gap-2 px-4 h-14 border-b border-border shrink-0">
        <div class="flex items-center justify-center w-7 h-7 rounded-md bg-primary">
            <x-heroicon-s-command-line class="h-4 w-4 text-primary-foreground" />
        </div>
        <span class="font-semibold text-sm text-foreground tracking-tight">{{ config('app.name', 'JoinFest') }}</span>

        {{-- Mobile close button --}}
        <button @click="sidebarOpen = false" class="ml-auto md:hidden p-1 rounded-md text-muted-foreground hover:text-foreground hover:bg-secondary cursor-pointer">
            <x-heroicon-o-x-mark class="h-4 w-4" />
        </button>
    </div>

    {{-- Navigation Links --}}
    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-6">
        @if(auth()->user()->role->value === 'admin' || auth()->user()->role->value === 'organizer')
        {{-- Home Section --}}
        <div>
            <p class="px-3 mb-1 text-xs font-semibold text-muted-foreground uppercase tracking-wider">Home</p>
            <div class="space-y-0.5">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md transition-colors cursor-pointer {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') || request()->routeIs('organizer.dashboard') ? 'bg-secondary text-foreground' : 'text-muted-foreground hover:text-foreground hover:bg-secondary' }}">
                    <x-heroicon-o-squares-2x2 class="h-4 w-4 shrink-0" />
                    Dashboard
                </a>
                <a href="#"
                   class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md text-muted-foreground hover:text-foreground hover:bg-secondary transition-colors cursor-pointer">
                    <x-heroicon-o-calendar class="h-4 w-4 shrink-0" />
                    Event
                </a>
                <a href="#"
                   class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md text-muted-foreground hover:text-foreground hover:bg-secondary transition-colors cursor-pointer">
                    <x-heroicon-o-ticket class="h-4 w-4 shrink-0" />
                    Kategori Tiket
                </a>
                @if(auth()->user()->role->value === 'organizer')
                <a href="{{ route('organizer.merchandise.index') }}"
                   class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md text-muted-foreground hover:text-foreground hover:bg-secondary transition-colors cursor-pointer">
                    <x-heroicon-o-shopping-bag class="h-4 w-4 shrink-0" />
                    Merchandise
                </a>
                <a href="{{ route('organizer.scanner.index') }}"
                   class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md text-muted-foreground hover:text-foreground hover:bg-secondary transition-colors cursor-pointer">
                    <x-heroicon-o-qr-code class="h-4 w-4 shrink-0" />
                    QR-Scanner
                </a>
                @endif
                <a href="#"
                   class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md text-muted-foreground hover:text-foreground hover:bg-secondary transition-colors cursor-pointer">
                    <x-heroicon-o-document-text class="h-4 w-4 shrink-0" />
                    Laporan
                </a>
            </div>
        </div>
        @else
        {{-- User Section --}}
        <div>
            <p class="px-3 mb-1 text-xs font-semibold text-muted-foreground uppercase tracking-wider">My Profile</p>
            <div class="space-y-0.5">
                <a href="{{ route('profile.index') }}"
                   class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md transition-colors cursor-pointer {{ request()->routeIs('profile.index') || request()->routeIs('profile.edit') ? 'bg-secondary text-foreground' : 'text-muted-foreground hover:text-foreground hover:bg-secondary' }}">
                    <x-heroicon-o-user class="h-4 w-4 shrink-0" />
                    My Information
                </a>
                <a href="{{ route('pesanan.index') }}"
                   class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md transition-colors cursor-pointer {{ request()->routeIs('pesanan.index') || request()->routeIs('pesanan.show') ? 'bg-secondary text-foreground' : 'text-muted-foreground hover:text-foreground hover:bg-secondary' }}">
                    <x-heroicon-o-shopping-bag class="h-4 w-4 shrink-0" />
                    My Orders
                </a>
                <a href="{{ route('events.index') }}"
                   class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md transition-colors cursor-pointer {{ request()->routeIs('events.index') ? 'bg-secondary text-foreground' : 'text-muted-foreground hover:text-foreground hover:bg-secondary' }}">
                    <x-heroicon-o-calendar class="h-4 w-4 shrink-0" />
                    Browse Events
                </a>
            </div>
        </div>
        @endif
    </nav>

    {{-- Bottom section --}}
    <div class="border-t border-border p-3 space-y-0.5 shrink-0">
        <a href="#"
           class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md text-muted-foreground hover:text-foreground hover:bg-secondary transition-colors cursor-pointer">
            <x-heroicon-o-cog-6-tooth class="h-4 w-4 shrink-0" />
            Settings
        </a>
        <a href="#"
           class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md text-muted-foreground hover:text-foreground hover:bg-secondary transition-colors cursor-pointer">
            <x-heroicon-o-magnifying-glass class="h-4 w-4 shrink-0" />
            Search
        </a>
    </div>

    {{-- User section --}}
    <div class="border-t border-border p-3 shrink-0">
        <x-dropdown align="top-start" width="48">
            <x-slot name="trigger">
                <button class="w-full flex items-center gap-3 px-3 py-2 text-sm rounded-md hover:bg-secondary transition-colors cursor-pointer">
                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-primary text-primary-foreground text-xs font-semibold shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </span>
                    <div class="flex-1 min-w-0 text-left">
                        <p class="text-sm font-medium text-foreground leading-none truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-muted-foreground truncate mt-0.5">{{ Auth::user()->email }}</p>
                    </div>
                    <x-heroicon-o-ellipsis-horizontal class="h-4 w-4 text-muted-foreground shrink-0" />
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.index')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</aside>
