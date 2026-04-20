<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-foreground tracking-tight">
            {{ __('Detail Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="mb-6 flex items-center gap-3 text-sm text-muted-foreground">
                <a href="{{ route('pesanan.index') }}" class="flex items-center gap-1.5 transition hover:text-primary">
                    <x-heroicon-o-arrow-left class="h-4 w-4" />
                    Kembali
                </a>
                <span>/</span>
                <span class="font-medium text-foreground">#{{ $pesanan->kode_order }}</span>
            </div>

            @php
                $badgeClass = match(strtolower($pesanan->status)) {
                    'paid' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400',
                    'pending' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400',
                    'cancelled' => 'bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400',
                    default => 'bg-secondary text-muted-foreground',
                };
            @endphp

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="space-y-6 lg:col-span-2">
                    <div class="overflow-hidden rounded-3xl border border-border/60 bg-card shadow-sm">
                        <div class="flex items-start gap-4 border-b border-border/60 p-6 sm:gap-6">
                            @if($pesanan->gambar)
                                <img src="{{ asset('images/' . $pesanan->gambar) }}" alt="{{ $pesanan->nama_event }}" class="h-24 w-24 shrink-0 rounded-2xl object-cover sm:h-32 sm:w-32">
                            @else
                                <div class="flex h-24 w-24 shrink-0 items-center justify-center rounded-2xl bg-secondary text-4xl sm:h-32 sm:w-32">🎪</div>
                            @endif

                            <div class="min-w-0 flex-1 py-1">
                                <span class="mb-2 inline-flex shrink-0 rounded-full px-3 py-1 font-mono text-[10px] font-bold uppercase tracking-[0.1em] {{ $badgeClass }}">
                                    {{ $pesanan->status }}
                                </span>
                                <h1 class="mb-3 text-xl font-extrabold tracking-tight text-card-foreground sm:text-2xl">{{ $pesanan->nama_event }}</h1>
                                <div class="space-y-1.5 text-sm text-muted-foreground">
                                    <div class="flex items-center gap-2">
                                        <x-heroicon-o-calendar class="h-4 w-4 shrink-0 text-muted-foreground" />
                                        <span>{{ \Carbon\Carbon::parse($pesanan->tanggal)->translatedFormat('l, d F Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <x-heroicon-o-clock class="h-4 w-4 shrink-0 text-muted-foreground" />
                                        <span>{{ \Carbon\Carbon::parse($pesanan->jam)->format('H:i') }} WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(!empty($pesanan->tikets))
                            <div class="p-6">
                                <h2 class="mb-4 flex items-center gap-2 text-base font-bold text-card-foreground">
                                    <x-heroicon-o-ticket class="h-5 w-5 text-primary" />
                                    Tiket Event ({{ count($pesanan->tikets) }})
                                </h2>
                                <div class="grid gap-4 sm:grid-cols-2">
                                    @foreach($pesanan->tikets as $tiket)
                                        <div class="relative overflow-hidden rounded-2xl border border-border/60 bg-card p-4 transition hover:border-primary/50">
                                            <div class="mb-4 flex items-start justify-between gap-3">
                                                <div>
                                                    <p class="font-bold text-card-foreground">{{ $tiket->kategori }}</p>
                                                    <p class="text-sm text-muted-foreground">{{ $tiket->nama }}</p>
                                                </div>
                                                @if($tiket->sudah_checkin)
                                                    <span class="inline-flex rounded-full bg-emerald-100 px-2 py-0.5 text-xs font-bold text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">Used</span>
                                                @else
                                                    <span class="inline-flex rounded-full bg-primary/10 px-2 py-0.5 text-xs font-bold text-primary">Valid</span>
                                                @endif
                                            </div>
                                            <div class="flex items-center justify-between border-t border-border/60 border-dashed pt-3">
                                                <span class="font-mono text-xs font-medium text-muted-foreground">{{ $tiket->id_tiket }}</span>
                                                <button class="text-sm font-semibold text-primary hover:text-primary/80">E-Tiket</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if(!empty($pesanan->merchandises) && count($pesanan->merchandises) > 0)
                            <div class="border-t border-border/60 p-6">
                                <h2 class="mb-4 flex items-center gap-2 text-base font-bold text-card-foreground">
                                    <x-heroicon-o-shopping-bag class="h-5 w-5 text-amber-500" />
                                    Merchandise ({{ count($pesanan->merchandises) }})
                                </h2>
                                <div class="space-y-3">
                                    @foreach($pesanan->merchandises as $merch)
                                        <div class="flex items-center gap-4 rounded-2xl border border-border/60 bg-card p-3">
                                            <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-secondary text-xl">
                                                👕
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="truncate font-bold text-card-foreground">{{ $merch->nama }}</p>
                                                <p class="text-sm text-muted-foreground">{{ $merch->varian }} <span class="mx-1">•</span> Qty: {{ $merch->qty }}</p>
                                            </div>
                                            <div class="text-right">
                                                @if($merch->sudah_diambil)
                                                    <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-[10px] font-bold uppercase tracking-widest text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">Diambil</span>
                                                @else
                                                    <button class="inline-flex items-center gap-1.5 rounded-full border border-border/60 px-3 py-1.5 text-xs font-bold text-foreground hover:bg-secondary">
                                                        <x-heroicon-o-qr-code class="h-3.5 w-3.5" />
                                                        QR Code
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-3xl border border-border/60 bg-card p-6 shadow-sm">
                        <h3 class="mb-4 text-base font-bold text-card-foreground">Ringkasan Pembayaran</h3>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between text-muted-foreground">
                                <span>Status</span>
                                <span class="font-medium text-foreground">{{ ucfirst($pesanan->status) }}</span>
                            </div>
                            <div class="flex justify-between text-muted-foreground">
                                <span>Metode</span>
                                <span class="font-medium text-foreground">{{ $pesanan->metode_pembayaran }}</span>
                            </div>
                            <div class="flex justify-between text-muted-foreground">
                                <span>ID Order</span>
                                <span class="font-mono text-xs font-medium text-foreground sm:text-sm">{{ $pesanan->kode_order }}</span>
                            </div>
                        </div>

                        <div class="my-5 h-px border-t border-dashed border-border/60"></div>

                        <div class="space-y-3 text-sm">
                            @if($pesanan->subtotal_tiket > 0)
                                <div class="flex justify-between text-muted-foreground">
                                    <span>Total Tiket</span>
                                    <span class="font-medium text-foreground">Rp {{ number_format($pesanan->subtotal_tiket, 0, ',', '.') }}</span>
                                </div>
                            @endif

                            @if($pesanan->subtotal_merch > 0)
                                <div class="flex justify-between text-muted-foreground">
                                    <span>Total Merch</span>
                                    <span class="font-medium text-foreground">Rp {{ number_format($pesanan->subtotal_merch, 0, ',', '.') }}</span>
                                </div>
                            @endif

                            <div class="flex justify-between text-muted-foreground">
                                <span>Pajak</span>
                                <span class="font-medium text-foreground">Rp {{ number_format($pesanan->pajak, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between text-muted-foreground">
                                <span>Biaya Layanan</span>
                                <span class="font-medium text-foreground">Rp {{ number_format($pesanan->biaya_layanan, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="mt-5 rounded-2xl bg-secondary px-4 py-4">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <span class="text-sm font-semibold text-foreground">Total Bayar</span>
                                <span class="text-lg font-extrabold text-primary">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        @if($pesanan->status === 'paid')
                            <a href="{{ route('pesanan.invoice', $pesanan->id) }}" class="mt-5 flex w-full items-center justify-center gap-2 rounded-xl border border-border/60 bg-card py-3 text-sm font-bold text-foreground transition hover:bg-secondary">
                                <x-heroicon-o-document-arrow-down class="h-4 w-4" />
                                Unduh Invoice
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
