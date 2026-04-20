<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-foreground tracking-tight">
            {{ __('Profil Event Organizer') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 sm:px-6 lg:px-8 space-y-6 mx-auto">

            {{-- 1. Kartu Informasi Profil Utama --}}
            <div class="overflow-hidden rounded-3xl border border-border/60 bg-card shadow-sm">
                <div class="relative h-32 bg-gradient-to-r from-blue-600 to-cyan-600">
                    {{-- Hiasan latar aksen --}}
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
                </div>

                <div class="relative px-6 pb-6 pt-8 sm:px-8 sm:pb-8">
                    {{-- Avatar --}}
                    <div class="absolute -top-16 flex h-24 w-24 items-center justify-center rounded-2xl bg-white p-1.5 shadow-lg border border-border/40">
                        <div class="flex h-full w-full items-center justify-center rounded-xl bg-blue-100 text-3xl font-bold text-blue-600">
                            {{ substr($user->organizerProfile?->organization_name ?? $user->name, 0, 1) }}
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mt-8 sm:mt-0">
                        <div>
                            <h1 class="text-2xl font-extrabold tracking-tight text-card-foreground">
                                {{ $user->organizerProfile?->organization_name ?? $user->name }}
                            </h1>
                            <p class="text-sm font-medium text-muted-foreground mt-1 flex items-center gap-2">
                                <x-heroicon-s-envelope class="h-4 w-4 text-blue-500" />
                                {{ $user->email }}
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 font-mono text-[10px] font-bold uppercase tracking-widest text-blue-700 dark:bg-blue-500/20 dark:text-blue-400">
                                {{ $user->role->label() }}
                            </span>
                            @if($user->is_active)
                            <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 font-mono text-[10px] font-bold uppercase tracking-widest text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">
                                Aktif
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="border-t border-border/60 border-dashed mt-6 pt-6 grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div class="bg-secondary/50 rounded-2xl p-4 border border-border/30">
                            <p class="text-muted-foreground mb-1 text-xs uppercase tracking-wider font-semibold">Total Event</p>
                            <p class="text-lg font-extrabold text-foreground">{{ $recentEvents->count() ?? 0 }}</p>
                        </div>
                        <div class="bg-secondary/50 rounded-2xl p-4 border border-border/30">
                            <p class="text-muted-foreground mb-1 text-xs uppercase tracking-wider font-semibold">Bergabung Sejak</p>
                            <p class="text-foreground font-semibold">{{ $user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Section Event Terakhir --}}
            <div class="rounded-3xl border border-border/60 bg-card p-6 shadow-sm sm:p-8">
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-card-foreground">Event Terbaru Anda</h2>
                        <p class="text-sm text-muted-foreground mt-1">Daftar event yang Anda selenggarakan.</p>
                    </div>
                </div>

                @if($recentEvents->isEmpty())
                <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-border/80 bg-secondary/50 py-12 text-center">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-500 dark:bg-blue-500/20 mb-4">
                        <x-heroicon-o-megaphone class="h-8 w-8" />
                    </div>
                    <h3 class="text-base font-bold text-foreground">Sistem Event Terintegrasi</h3>
                    <p class="mt-2 max-w-sm text-sm text-muted-foreground">Anda belum membuat event apapun. Mari ciptakan event spektakuler Anda!</p>
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-muted-foreground">
                        <thead class="border-b border-border/60 bg-secondary/30 text-xs uppercase text-muted-foreground">
                            <tr>
                                <th scope="col" class="px-4 py-3 font-semibold">Event</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Venue</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Status</th>
                                <th scope="col" class="px-4 py-3 text-right font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border/60">
                            @foreach($recentEvents as $event)
                            <tr class="transition-colors hover:bg-muted/50">
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-secondary overflow-hidden">
                                            @if($event->banner_image)
                                                <img src="{{ asset('img/' . $event->banner_image) }}" alt="" class="h-full w-full object-cover">
                                            @else
                                                <span class="text-lg">🎪</span>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-foreground line-clamp-1">{{ $event->name }}</div>
                                            <div class="text-xs text-muted-foreground mt-0.5">{{ $event->event_date?->translatedFormat('d M Y') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4">
                                    <span class="block text-foreground font-semibold">{{ $event->venue_name }}</span>
                                    <span class="block text-xs">{{ $event->city }}</span>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4">
                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-bold uppercase tracking-wider text-blue-700">
                                        {{ $event->status }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-right">
                                    <a href="#" class="inline-flex items-center justify-center rounded-lg border border-border bg-background px-3 py-1.5 text-xs font-semibold text-foreground shadow-sm transition-colors hover:bg-secondary hover:text-blue-600">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            {{-- 3. Pengaturan Akun Dasar --}}
            <div class="rounded-3xl border border-border/60 bg-card p-6 shadow-sm sm:p-8">
                <div class="mb-6">
                    <h2 class="text-xl font-bold tracking-tight text-card-foreground">Pengaturan Organizer</h2>
                    <p class="text-sm text-muted-foreground mt-1">Kelola data keamanan dan profil lembaga Anda.</p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <a href="{{ route('profile.edit') }}" class="group flex items-start gap-4 rounded-2xl border border-border/60 bg-background p-4 transition-all hover:border-blue-300 hover:shadow-md hover:shadow-blue-500/5">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-500/20 dark:text-blue-400">
                            <x-heroicon-o-user-circle class="h-5 w-5" />
                        </div>
                        <div>
                            <h3 class="font-bold text-foreground group-hover:text-blue-600 transition-colors">Edit Detail & Bank</h3>
                            <p class="mt-1 text-xs text-muted-foreground">Ubah informasi kontak atau rekening penarikan.</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
