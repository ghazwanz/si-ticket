<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-semibold text-foreground tracking-tight">
                {{ __('Admin Dashboard') }}
            </h1>
            <button class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-md bg-primary text-primary-foreground hover:bg-primary/90 transition-colors cursor-pointer">
                <x-heroicon-o-plus-circle class="h-4 w-4" />
                Manage Platform
            </button>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="px-4 sm:px-6 lg:px-8 lg:space-y-12 space-y-6">
            <div class="space-y-6">
                <div>
                    <h2 class="text-2xl font-medium tracking-tight text-foreground">Overview, System Admin!</h2>
                    <p class="text-base text-muted-foreground">Platform-wide statistics and metrics.</p>
                </div>

                {{-- Admin KPI Cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    {{-- Total System Revenue --}}
                    <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-muted-foreground">Platform GMV</p>
                            <x-heroicon-o-banknotes class="h-4 w-4 text-muted-foreground" />
                        </div>
                        <div class="mt-2">
                            <p class="text-2xl font-bold text-card-foreground">Rp 9.5B</p>
                            <p class="text-xs text-muted-foreground mt-1">+12.5% vs last month</p>
                        </div>
                    </div>

                    {{-- Total Active Users --}}
                    <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-muted-foreground">Active Users</p>
                            <x-heroicon-o-users class="h-4 w-4 text-muted-foreground" />
                        </div>
                        <div class="mt-2">
                            <p class="text-2xl font-bold text-card-foreground">125K</p>
                            <p class="text-xs text-muted-foreground mt-1">+9% growth</p>
                        </div>
                    </div>

                    {{-- Live Events --}}
                    <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-muted-foreground">Live Events</p>
                            <x-heroicon-o-calendar-days class="h-4 w-4 text-muted-foreground" />
                        </div>
                        <div class="mt-2">
                            <p class="text-2xl font-bold text-card-foreground">342</p>
                            <p class="text-xs text-muted-foreground mt-1 text-emerald-600">All systems optimal</p>
                        </div>
                    </div>

                    {{-- Organizers --}}
                    <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-muted-foreground">Registered Organizers</p>
                            <x-heroicon-o-building-storefront class="h-4 w-4 text-muted-foreground" />
                        </div>
                        <div class="mt-2">
                            <p class="text-2xl font-bold text-card-foreground">89</p>
                            <p class="text-xs text-muted-foreground mt-1">Pending verification: 5</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Activity / Approvals --}}
            <div class="rounded-2xl border border-border/60 bg-card shadow-sm overflow-hidden">
                <div class="p-6 border-b border-border/60 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-foreground tracking-tight">Recent Organizer Signups</h3>
                        <p class="text-sm text-muted-foreground mt-1">Review and approve new event organizers.</p>
                    </div>
                    <button class="text-sm font-medium text-primary hover:text-primary/80 transition">View All</button>
                </div>
                <div class="p-0">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-muted/50 text-muted-foreground">
                            <tr>
                                <th class="px-6 py-3 font-medium">Organizer Name</th>
                                <th class="px-6 py-3 font-medium">Email</th>
                                <th class="px-6 py-3 font-medium">Status</th>
                                <th class="px-6 py-3 font-medium text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border/60 text-card-foreground">
                            <tr class="hover:bg-muted/30 transition-colors">
                                <td class="px-6 py-4 font-medium">Bintang Group</td>
                                <td class="px-6 py-4">bintang@organizer.com</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-amber-50 px-2 py-1 text-xs font-medium text-amber-700 ring-1 ring-inset ring-amber-600/20">Pending</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-primary hover:text-primary/80 font-medium">Review</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-muted/30 transition-colors">
                                <td class="px-6 py-4 font-medium">Festiva Pro</td>
                                <td class="px-6 py-4">hello@festivapro.id</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Approved</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-primary hover:text-primary/80 font-medium">Manage</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-muted/30 transition-colors">
                                <td class="px-6 py-4 font-medium">SoundCheck Live</td>
                                <td class="px-6 py-4">admin@soundcheck.live</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Approved</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-primary hover:text-primary/80 font-medium">Manage</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
