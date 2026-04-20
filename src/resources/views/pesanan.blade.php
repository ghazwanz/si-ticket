<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-foreground tracking-tight">
            {{ __('Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="mb-6">
                <p class="text-sm text-muted-foreground">Kelola dan pantau semua tiket event Anda dalam satu tempat.</p>
            </div>

            @php
                $filters = ['semua' => 'Semua', 'pending' => 'Pending', 'paid' => 'Paid', 'cancelled' => 'Cancelled', 'failed' => 'Failed'];
                $activeFilter = request('status', 'semua');
            @endphp

            <div class="mb-6 flex flex-wrap gap-2">
                @foreach($filters as $value => $label)
                    <a href="{{ route('pesanan.index', $value !== 'semua' ? ['status' => $value] : []) }}" class="inline-flex items-center justify-center rounded-full border px-4 py-2 text-sm font-semibold transition {{ $activeFilter === $value ? 'border-primary bg-primary text-primary-foreground' : 'border-border bg-card text-muted-foreground hover:border-primary hover:text-primary' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                @forelse($pesanan as $item)
                    @php
                        $badgeClass = match(strtolower($item->status)) {
                            'paid' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400',
                            'pending' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400',
                            'cancelled' => 'bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400',
                            'failed' => 'bg-secondary text-muted-foreground',
                            default => 'bg-secondary text-muted-foreground',
                        };
                    @endphp

                    <article class="flex flex-col gap-4 rounded-3xl border border-border/60 bg-card p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                        <div class="flex items-start gap-3">
                            @if($item->gambar)
                                <img src="{{ asset('images/' . $item->gambar) }}" alt="{{ $item->nama_event }}" class="h-20 w-20 shrink-0 rounded-2xl object-cover">
                            @else
                                <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-secondary text-2xl">🎪</div>
                            @endif

                            <div class="min-w-0 flex-1">
                                <div class="flex items-start justify-between gap-2">
                                    <h2 class="truncate text-base font-bold text-card-foreground">{{ $item->nama_event }}</h2>
                                    <span class="inline-flex shrink-0 rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.08em] {{ $badgeClass }}">{{ strtoupper($item->status) }}</span>
                                </div>

                                <div class="mt-3 space-y-1 text-xs text-muted-foreground">
                                    <div class="flex items-center gap-2">
                                        <x-heroicon-o-calendar class="h-3.5 w-3.5 shrink-0" />
                                        <span>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <x-heroicon-o-ticket class="h-3.5 w-3.5 shrink-0" />
                                        <span>ID: #{{ $item->kode_order }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-3 border-t border-border/60 pt-4">
                            <div class="text-lg font-extrabold text-primary">Rp {{ number_format($item->total, 0, ',', '.') }}</div>
                            <a href="{{ route('pesanan.show', $item->id) }}" class="inline-flex items-center gap-1 rounded-xl border border-border/60 bg-card px-4 py-2 text-sm font-semibold text-foreground transition hover:border-primary hover:text-primary">
                                Lihat Detail
                                <x-heroicon-o-chevron-right class="h-3.5 w-3.5" />
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl border border-dashed border-border bg-card p-10 text-center md:col-span-2">
                        <x-heroicon-o-inbox class="mx-auto mb-4 h-12 w-12 text-muted-foreground" />
                        <h3 class="text-lg font-bold text-card-foreground">Belum ada pesanan</h3>
                        <p class="mt-1 text-sm text-muted-foreground">Pesanan dengan status ini tidak ditemukan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
