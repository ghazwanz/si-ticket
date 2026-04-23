<aside class="w-64 bg-gradient-to-b from-[#2D1B69] to-[#1A0A3E] text-white flex flex-col fixed inset-y-0 left-0 z-50 shadow-2xl">
    <div class="px-6 py-6 border-b border-white/10">
        <h1 class="text-2xl font-bold tracking-tight bg-gradient-to-r from-purple-300 to-pink-200 bg-clip-text text-transparent">
            JoinFest
        </h1>
        <p class="text-xs text-purple-300 mt-1">ORGANIZER CONSOLE</p>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
        <x-organizer.nav-link href="{{ route('organizer.dashboard') }}" icon="dashboard" :active="request()->routeIs('organizer.dashboard')">
            Dashboard
        </x-organizer.nav-link>
        <x-organizer.nav-link href="{{ route('organizer.events.index') }}" icon="events" :active="request()->routeIs('organizer.events.*')">
            Events
        </x-organizer.nav-link>
        <x-organizer.nav-link href="{{ route('organizer.merchandise.index') }}" icon="merchandise" :active="request()->routeIs('organizer.merchandise.*')">
            Merchandise
        </x-organizer.nav-link>
        <x-organizer.nav-link href="{{ route('organizer.scanner.index') }}" icon="scanner" :active="request()->routeIs('organizer.scanner.*')">
            QR Scanner
        </x-organizer.nav-link>
        <x-organizer.nav-link href="{{ route('organizer.settings') }}" icon="settings" :active="request()->routeIs('organizer.settings')">
            Settings
        </x-organizer.nav-link>
    </nav>

    <div class="px-4 py-4 border-t border-white/10">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full px-4 py-2.5 text-sm text-purple-200 hover:bg-white/10 rounded-xl transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Logout
            </button>
        </form>
    </div>
</aside>