<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-semibold text-foreground tracking-tight">
                {{ __('Organizer Dashboard') }}
            </h1>
            <button class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-md bg-primary text-primary-foreground hover:bg-primary/90 transition-colors cursor-pointer shadow-sm">
                <x-heroicon-o-plus-circle class="h-4 w-4" />
                Create Event
            </button>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="px-4 sm:px-6 lg:px-8 lg:space-y-12 space-y-6">
            <div class="space-y-6">
                <div>
                    <h2 class="text-2xl font-medium tracking-tight text-foreground">Welcome, {{ Auth::user()->name }}!</h2>
                    <p class="text-base text-muted-foreground">Manage your events, analyze tickets sold, and oversee operations.</p>
                </div>

                {{-- Dashboard Cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- Total Sales --}}
                    <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-muted-foreground">Total Sales</p>
                            <x-heroicon-o-currency-dollar class="h-4 w-4 text-muted-foreground" />
                        </div>
                        <div class="mt-2">
                            <p class="text-2xl font-bold text-card-foreground">Rp 125M</p>
                            <p class="text-xs text-muted-foreground mt-1">+15.3% from last month</p>
                        </div>
                    </div>

                    {{-- Tickets Sold --}}
                    <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-muted-foreground">Tickets Sold</p>
                            <x-heroicon-o-ticket class="h-4 w-4 text-muted-foreground" />
                        </div>
                        <div class="mt-2">
                            <p class="text-2xl font-bold text-card-foreground">2,450</p>
                            <p class="text-xs text-muted-foreground mt-1">+23.1% from last month</p>
                        </div>
                    </div>

                    {{-- Active Events --}}
                    <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-muted-foreground">Active Events</p>
                            <x-heroicon-o-presentation-chart-line class="h-4 w-4 text-muted-foreground" />
                        </div>
                        <div class="mt-2">
                            <p class="text-2xl font-bold text-card-foreground">2</p>
                            <p class="text-xs text-emerald-600 mt-1">Live & Selling</p>
                        </div>
                    </div>

                    {{-- Merchandise --}}
                    <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-muted-foreground">Merchandise Sales</p>
                            <x-heroicon-o-shopping-bag class="h-4 w-4 text-muted-foreground" />
                        </div>
                        <div class="mt-2">
                            <p class="text-2xl font-bold text-card-foreground">340</p>
                            <p class="text-xs text-muted-foreground mt-1">Rp 45M Total Revenue</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- My Events --}}
            <div class="rounded-2xl border border-border/60 bg-card shadow-sm overflow-hidden">
                <div class="p-6 border-b border-border/60 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-foreground tracking-tight">Active Events</h3>
                        <p class="text-sm text-muted-foreground mt-1">Ongoing events managed by your organization.</p>
                    </div>
                    <button class="text-sm font-medium text-primary hover:text-primary/80 transition">View All</button>
                </div>
                <div class="p-0">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-muted/50 text-muted-foreground">
                            <tr>
                                <th class="px-6 py-3 font-medium">Event Name</th>
                                <th class="px-6 py-3 font-medium">Date</th>
                                <th class="px-6 py-3 font-medium">Tickets Sold</th>
                                <th class="px-6 py-3 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border/60 text-card-foreground">
                            <tr class="hover:bg-muted/30 transition-colors">
                                <td class="px-6 py-4 font-medium">JoinFest Night's World Tour</td>
                                <td class="px-6 py-4">Oct 26, 2026</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="h-1.5 w-16 bg-muted rounded-full overflow-hidden">
                                            <div class="h-full bg-primary w-[80%] rounded-full"></div>
                                        </div>
                                        <span class="text-xs text-muted-foreground">80%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-primary hover:text-primary/80 font-medium">Details</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-muted/30 transition-colors">
                                <td class="px-6 py-4 font-medium">JoinFest Future Talks</td>
                                <td class="px-6 py-4">Nov 10, 2026</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="h-1.5 w-16 bg-muted rounded-full overflow-hidden">
                                            <div class="h-full bg-amber-500 w-[45%] rounded-full"></div>
                                        </div>
                                        <span class="text-xs text-muted-foreground">45%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-primary hover:text-primary/80 font-medium">Details</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
