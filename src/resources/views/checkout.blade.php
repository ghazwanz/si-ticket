<x-store-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-extrabold text-foreground tracking-tight">
            {{ __('Checkout Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 lg:grid-cols-[minmax(0,1fr)_380px] lg:px-8 text-foreground">

            <section class="space-y-4">
                @if(session('success'))
                    <div class="flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-500/20 dark:border-emerald-500/30 dark:text-emerald-400">
                        <x-heroicon-o-check-circle class="mt-0.5 h-4 w-4 shrink-0" />
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:bg-red-500/20 dark:border-red-500/30 dark:text-red-400">
                        <x-heroicon-o-exclamation-circle class="mt-0.5 h-4 w-4 shrink-0" />
                        <span>Mohon periksa kembali data yang Anda masukkan.</span>
                    </div>
                @endif

                <div class="rounded-3xl border border-border/60 bg-card p-6 shadow-sm">
                    <div class="mb-6 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-primary">
                            <x-heroicon-o-user class="h-5 w-5" />
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-card-foreground">Data Pemesan</h2>
                            <p class="text-sm text-muted-foreground">Masukkan detail pemesanan yang valid.</p>
                        </div>
                    </div>

                    <form id="checkoutForm" method="POST" action="{{ route('checkout.store') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="nama_lengkap" class="mb-2 block text-sm font-medium text-foreground">Nama Lengkap</label>
                            <input id="nama_lengkap" type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required placeholder="Masukkan nama lengkap sesuai identitas" class="w-full rounded-2xl border {{ $errors->has('nama_lengkap') ? 'border-red-300 focus:border-red-500 focus:ring-red-500/15' : 'border-border/60 focus:border-primary focus:ring-primary/15' }} bg-background px-4 py-3 text-sm outline-none transition focus:ring-4">
                            <p class="mt-2 text-xs {{ $errors->has('nama_lengkap') ? 'text-red-600 dark:text-red-400' : 'text-muted-foreground' }}">{{ $errors->first('nama_lengkap') ?? 'Nama lengkap wajib diisi.' }}</p>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label for="email" class="mb-2 block text-sm font-medium text-foreground">Alamat Email</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" class="w-full rounded-2xl border {{ $errors->has('email') ? 'border-red-300 focus:border-red-500 focus:ring-red-500/15' : 'border-border/60 focus:border-primary focus:ring-primary/15' }} bg-background px-4 py-3 text-sm outline-none transition focus:ring-4">
                                <p class="mt-2 text-xs {{ $errors->has('email') ? 'text-red-600 dark:text-red-400' : 'text-muted-foreground' }}">{{ $errors->first('email') ?? 'Alamat email tidak valid.' }}</p>
                            </div>

                            <div>
                                <label for="no_telepon" class="mb-2 block text-sm font-medium text-foreground">No. Telepon</label>
                                <input id="no_telepon" type="tel" name="no_telepon" value="{{ old('no_telepon') }}" required placeholder="0812xxxx" class="w-full rounded-2xl border {{ $errors->has('no_telepon') ? 'border-red-300 focus:border-red-500 focus:ring-red-500/15' : 'border-border/60 focus:border-primary focus:ring-primary/15' }} bg-background px-4 py-3 text-sm outline-none transition focus:ring-4">
                                <p class="mt-2 text-xs {{ $errors->has('no_telepon') ? 'text-red-600 dark:text-red-400' : 'text-muted-foreground' }}">{{ $errors->first('no_telepon') ?? 'Nomor telepon wajib diisi.' }}</p>
                            </div>
                        </div>

                        <input type="hidden" name="order_id" value="{{ $order->id ?? '' }}">
                    </form>
                </div>
            </section>

            <aside class="lg:sticky lg:top-24 lg:self-start">
                <div class="rounded-3xl border border-border/60 bg-card p-6 shadow-sm">
                    <div class="mb-5">
                        <h2 class="text-lg font-bold text-card-foreground">Ringkasan Pesanan</h2>
                        <p class="text-sm text-muted-foreground">Periksa item dan total sebelum membayar.</p>
                    </div>

                    @if(isset($tikets) && $tikets->count())
                        <p class="mb-3 inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.08em] text-primary">Tiket Utama</p>
                        <div class="space-y-3">
                            @foreach($tikets as $tiket)
                                <div class="flex items-center gap-3 rounded-2xl border border-border/60 p-3">
                                    <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-secondary">
                                        <img src="{{ asset('img/tiket.png') }}" alt="Festival" class="h-full w-full object-cover">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-semibold text-card-foreground">{{ $tiket->nama }}</p>
                                        <p class="text-xs text-muted-foreground">x{{ $tiket->qty }} Tiket</p>
                                    </div>
                                    <p class="text-sm font-semibold text-primary">Rp {{ number_format($tiket->harga * $tiket->qty, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="mb-3 inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.08em] text-primary">Tiket Utama</p>
                        <div class="flex items-center gap-3 rounded-2xl border border-border/60 p-3">
                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-secondary text-sm text-muted-foreground">🎤</div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold text-card-foreground">Festival (Standing)</p>
                                <p class="text-xs text-muted-foreground">x1 Tiket</p>
                            </div>
                            <p class="text-sm font-semibold text-primary">Rp 750.000</p>
                        </div>
                    @endif

                    <div class="my-5 h-px bg-border/60 border-dashed"></div>

                    @if(isset($merchandises) && $merchandises->count())
                        <p class="mb-3 inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.08em] text-primary">Merchandise</p>
                        <div class="space-y-3">
                            @foreach($merchandises as $merch)
                                <div class="flex items-center gap-3 rounded-2xl border border-border/60 p-3">
                                    <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-secondary">
                                        @if($merch->nama == 'Kaos Official')
                                            <img src="{{ asset('img/KaosOfficial.png') }}" alt="Kaos Official" class="h-full w-full object-cover">
                                        @elseif($merch->nama == 'Tote Bag')
                                            <img src="{{ asset('img/ToteBag.png') }}" alt="Tote Bag" class="h-full w-full object-cover">
                                        @else
                                            <span class="text-sm">🛍️</span>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-semibold text-card-foreground">{{ $merch->nama }}</p>
                                        <p class="text-xs text-muted-foreground">x{{ $merch->qty }} • {{ $merch->varian }}</p>
                                    </div>
                                    <p class="text-sm font-semibold text-primary">Rp {{ number_format($merch->harga * $merch->qty, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="my-5 h-px bg-border/60 border-dashed"></div>
                    @endif

                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between gap-3 text-muted-foreground">
                            <span>Subtotal</span>
                            <span class="font-medium text-foreground">Rp {{ number_format($subtotal ?? 1128000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between gap-3 text-muted-foreground">
                            <span>Biaya Layanan</span>
                            <span class="font-medium text-foreground">Rp {{ number_format($biaya_layanan ?? 15000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between gap-3 text-muted-foreground">
                            <span>Pajak (10%)</span>
                            <span class="font-medium text-foreground">Rp {{ number_format($pajak ?? 112800, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-5 rounded-2xl bg-secondary px-4 py-4">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-sm font-semibold text-foreground">Total Bayar</span>
                            <span class="text-lg font-extrabold text-primary">Rp {{ number_format($total ?? 1255800, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" form="checkoutForm" class="mt-5 inline-flex h-12 w-full items-center justify-center gap-2 rounded-2xl bg-primary px-4 text-sm font-semibold text-primary-foreground transition hover:bg-primary/90">
                        Bayar Sekarang
                        <x-heroicon-o-arrow-right class="h-4 w-4" />
                    </button>

                    <p class="mt-4 flex items-center justify-center gap-2 text-center text-xs text-muted-foreground">
                        <x-heroicon-o-lock-closed class="h-3.5 w-3.5" />
                        Transaksi aman &amp; terenkripsi
                    </p>
                </div>
            </aside>

        </div>
    </div>
</x-store-layout>
