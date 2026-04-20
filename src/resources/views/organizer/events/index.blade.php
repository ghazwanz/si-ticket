<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-foreground tracking-tight">
            {{ __('Manajemen Event Anda') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="rounded-3xl border border-border/60 bg-card p-6 shadow-sm">
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-card-foreground">Daftar Event</h2>
                        <p class="text-sm text-muted-foreground mt-1">Kelola dan lihat status acara serta ketersediaan tiket yang telah Anda buat.</p>
                    </div>

                    <a href="{{ route('organizer.events.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                        <x-heroicon-o-plus class="h-4 w-4" /> Buat Event Baru
                    </a>
                </div>

                @if(session('status'))
                    <div class="mb-4 rounded-xl bg-emerald-100 p-4 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-muted-foreground">
                        <thead class="border-b border-border/60 bg-secondary/30 text-xs uppercase text-muted-foreground">
                            <tr>
                                <th scope="col" class="px-4 py-3 font-semibold">Event</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Kategori</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Lokasi</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Waktu</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Status</th>
                                <th scope="col" class="px-4 py-3 text-right font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border/60">
                            @forelse($events as $event)
                            <tr class="transition-colors hover:bg-muted/50">
                                <td class="px-4 py-4">
                                    <div class="font-bold text-foreground line-clamp-1">{{ $event->name }}</div>
                                    <div class="text-xs text-muted-foreground mt-0.5">Dibuat: {{ $event->created_at->format('d M Y') }}</div>
                                </td>
                                <td class="px-4 py-4">
                                    {{ $event->category->name ?? 'Umum' }}
                                </td>
                                <td class="px-4 py-4">
                                    <div class="font-medium text-foreground">{{ $event->venue_name }}</div>
                                    <div class="text-xs text-muted-foreground">{{ $event->city }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }} <br>
                                    <span class="text-xs">{{ substr($event->start_time, 0, 5) }} - {{ substr($event->end_time, 0, 5) }}</span>
                                </td>
                                <td class="px-4 py-4">
                                    @php
                                        $badge = match($event->status) {
                                            'published' => 'bg-emerald-100 text-emerald-700',
                                            'draft' => 'bg-slate-100 text-slate-700',
                                            'completed' => 'bg-blue-100 text-blue-700',
                                            'cancelled' => 'bg-red-100 text-red-700',
                                            default => 'bg-slate-100 text-slate-700',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold uppercase tracking-wider {{ $badge }}">
                                        {{ $event->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-right">
                                    {{-- Placeholder Aksi Lainnya --}}
                                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-muted-foreground">Belum ada event terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $events->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
