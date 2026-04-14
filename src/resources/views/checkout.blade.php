<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout - JoinFest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-slate-100 font-[Plus_Jakarta_Sans,sans-serif] text-slate-900">
    <nav data-site-header data-scrolled="false" class="sticky top-0 z-50 flex h-16 items-center justify-between border-b border-slate-200 bg-white px-4 shadow-sm transition-all duration-300 md:px-8 data-[scrolled=true]:border-violet-200 data-[scrolled=true]:bg-white/95 data-[scrolled=true]:shadow-[0_12px_30px_rgba(15,23,42,0.08)]">
        <div class="flex items-center gap-5">
            <a href="{{ url('/') }}" class="text-xl font-extrabold tracking-tight text-violet-600">JoinFest</a>
            <div class="relative hidden items-center md:flex">
                <svg class="pointer-events-none absolute left-3 h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <input type="text" placeholder="Cari event, konser, atau artis..." class="w-72 rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-9 pr-4 text-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15">
            </div>
        </div>

        <div class="flex items-center gap-4 text-sm font-medium">
            <a href="{{ url('/') }}" class="text-slate-700 transition hover:text-violet-600">Beranda</a>
            <a href="{{ url('/events') }}" class="text-slate-700 transition hover:text-violet-600">Jelajahi Event</a>
            <span class="hidden h-6 w-px bg-slate-200 md:block"></span>
            <a href="{{ route('login') }}" class="text-slate-700 transition hover:text-violet-600">Masuk</a>
            <a href="{{ route('register') }}" class="inline-flex h-10 items-center justify-center rounded-xl bg-violet-600 px-4 text-white transition hover:bg-violet-700">Daftar Sekarang</a>
        </div>
    </nav>

    <main class="mx-auto grid max-w-7xl gap-8 px-4 py-8 lg:grid-cols-[minmax(0,1fr)_380px] lg:px-8 lg:pb-12" data-reveal data-reveal-delay="0">
        <header class="lg:col-span-2 opacity-0 translate-y-6 scale-[0.98] blur-sm transition-all duration-700 ease-out" data-reveal data-reveal-delay="60">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Checkout</h1>
            <p class="mt-1 text-sm text-slate-500">Selesaikan pesanan Anda untuk pengalaman yang tak terlupakan.</p>
        </header>

        <section class="space-y-4 opacity-0 translate-y-6 scale-[0.98] blur-sm transition-all duration-700 ease-out" data-reveal data-reveal-delay="140">
            @if(session('success'))
                <div class="flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/></svg>
                    <span>Mohon periksa kembali data yang Anda masukkan.</span>
                </div>
            @endif

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-6 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-violet-50 text-violet-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Data Pemesan</h2>
                        <p class="text-sm text-slate-500">Masukkan detail pemesanan yang valid.</p>
                    </div>
                </div>

                <form id="checkoutForm" method="POST" action="{{ route('checkout.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="nama_lengkap" class="mb-2 block text-sm font-medium text-slate-700">Nama Lengkap</label>
                        <input id="nama_lengkap" type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required placeholder="Masukkan nama lengkap sesuai identitas" class="w-full rounded-2xl border {{ $errors->has('nama_lengkap') ? 'border-red-300' : 'border-slate-300' }} bg-white px-4 py-3 text-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15">
                        <p class="mt-2 text-xs {{ $errors->has('nama_lengkap') ? 'text-red-600' : 'text-slate-500' }}">{{ $errors->first('nama_lengkap') ?? 'Nama lengkap wajib diisi.' }}</p>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Alamat Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" class="w-full rounded-2xl border {{ $errors->has('email') ? 'border-red-300' : 'border-slate-300' }} bg-white px-4 py-3 text-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15">
                            <p class="mt-2 text-xs {{ $errors->has('email') ? 'text-red-600' : 'text-slate-500' }}">{{ $errors->first('email') ?? 'Alamat email tidak valid.' }}</p>
                        </div>

                        <div>
                            <label for="no_telepon" class="mb-2 block text-sm font-medium text-slate-700">No. Telepon</label>
                            <input id="no_telepon" type="tel" name="no_telepon" value="{{ old('no_telepon') }}" required placeholder="0812xxxx" class="w-full rounded-2xl border {{ $errors->has('no_telepon') ? 'border-red-300' : 'border-slate-300' }} bg-white px-4 py-3 text-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15">
                            <p class="mt-2 text-xs {{ $errors->has('no_telepon') ? 'text-red-600' : 'text-slate-500' }}">{{ $errors->first('no_telepon') ?? 'Nomor telepon wajib diisi.' }}</p>
                        </div>
                    </div>

                    <input type="hidden" name="order_id" value="{{ $order->id ?? '' }}">
                </form>
            </div>
        </section>

        <aside class="lg:sticky lg:top-24 lg:self-start opacity-0 translate-y-6 scale-[0.98] blur-sm transition-all duration-700 ease-out" data-reveal data-reveal-delay="220">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-5">
                    <h2 class="text-lg font-bold text-slate-900">Ringkasan Pesanan</h2>
                    <p class="text-sm text-slate-500">Periksa item dan total sebelum membayar.</p>
                </div>

                @if(isset($tikets) && $tikets->count())
                    <p class="mb-3 inline-flex rounded-full bg-violet-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.08em] text-violet-600">Tiket Utama</p>
                    <div class="space-y-3">
                        @foreach($tikets as $tiket)
                            <div class="flex items-center gap-3 rounded-2xl border border-slate-200 p-3">
                                <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-slate-100">
                                    <img src="{{ asset('img/tiket.png') }}" alt="Festival" class="h-full w-full object-cover">
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-semibold text-slate-900">{{ $tiket->nama }}</p>
                                    <p class="text-xs text-slate-500">x{{ $tiket->qty }} Tiket</p>
                                </div>
                                <p class="text-sm font-semibold text-violet-600">Rp {{ number_format($tiket->harga * $tiket->qty, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mb-3 inline-flex rounded-full bg-violet-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.08em] text-violet-600">Tiket Utama</p>
                    <div class="flex items-center gap-3 rounded-2xl border border-slate-200 p-3">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-slate-900 text-sm text-violet-300">🎤</div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-semibold text-slate-900">Festival (Standing)</p>
                            <p class="text-xs text-slate-500">x1 Tiket</p>
                        </div>
                        <p class="text-sm font-semibold text-violet-600">Rp 750.000</p>
                    </div>
                @endif

                <div class="my-5 h-px bg-slate-200"></div>

                @if(isset($merchandises) && $merchandises->count())
                    <p class="mb-3 inline-flex rounded-full bg-violet-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.08em] text-violet-600">Merchandise</p>
                    <div class="space-y-3">
                        @foreach($merchandises as $merch)
                            <div class="flex items-center gap-3 rounded-2xl border border-slate-200 p-3">
                                <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-slate-100">
                                    @if($merch->nama == 'Kaos Official')
                                        <img src="{{ asset('img/KaosOfficial.png') }}" alt="Kaos Official" class="h-full w-full object-cover">
                                    @elseif($merch->nama == 'Tote Bag')
                                        <img src="{{ asset('img/ToteBag.png') }}" alt="Tote Bag" class="h-full w-full object-cover">
                                    @else
                                        <span class="text-sm">🛍️</span>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-semibold text-slate-900">{{ $merch->nama }}</p>
                                    <p class="text-xs text-slate-500">x{{ $merch->qty }} • {{ $merch->varian }}</p>
                                </div>
                                <p class="text-sm font-semibold text-violet-600">Rp {{ number_format($merch->harga * $merch->qty, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mb-3 inline-flex rounded-full bg-violet-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.08em] text-violet-600">Merchandise</p>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 rounded-2xl border border-slate-200 p-3">
                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-lg">👕</div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold text-slate-900">Kaos Official</p>
                                <p class="text-xs text-slate-500">x1 • Size L</p>
                            </div>
                            <p class="text-sm font-semibold text-violet-600">Rp 249.000</p>
                        </div>
                        <div class="flex items-center gap-3 rounded-2xl border border-slate-200 p-3">
                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-lg">👜</div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold text-slate-900">Tote Bag</p>
                                <p class="text-xs text-slate-500">x1 • Black</p>
                            </div>
                            <p class="text-sm font-semibold text-violet-600">Rp 129.000</p>
                        </div>
                    </div>
                @endif

                <div class="my-5 h-px bg-slate-200"></div>

                <div class="space-y-3 text-sm">
                    <div class="flex items-center justify-between gap-3 text-slate-600">
                        <span>Subtotal</span>
                        <span class="font-medium text-slate-900">Rp {{ number_format($subtotal ?? 1128000, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3 text-slate-600">
                        <span>Biaya Layanan</span>
                        <span class="font-medium text-slate-900">Rp {{ number_format($biaya_layanan ?? 15000, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3 text-slate-600">
                        <span>Pajak (10%)</span>
                        <span class="font-medium text-slate-900">Rp {{ number_format($pajak ?? 112800, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-5 rounded-2xl bg-violet-50 px-4 py-4">
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-sm font-semibold text-violet-700">Total Bayar</span>
                        <span class="text-lg font-extrabold text-violet-700">Rp {{ number_format($total ?? 1255800, 0, ',', '.') }}</span>
                    </div>
                </div>

                <button type="submit" form="checkoutForm" class="mt-5 inline-flex h-12 w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-violet-600 to-violet-500 px-4 text-sm font-semibold text-white shadow-[0_12px_20px_rgba(109,40,217,0.25)] transition hover:-translate-y-0.5 hover:shadow-[0_16px_24px_rgba(109,40,217,0.3)]">
                    Bayar Sekarang
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>

                <p class="mt-4 flex items-center justify-center gap-2 text-center text-xs text-slate-500">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Transaksi aman &amp; terenkripsi oleh JoinFest Security
                </p>
            </div>
        </aside>
    </main>

    <footer class="border-t border-slate-200 bg-white px-4 py-5 text-sm text-slate-500 md:px-8">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="font-bold tracking-tight text-slate-900">JoinFest<span class="text-violet-600">Events</span></div>
                <div>© {{ date('Y') }} {{ config('app.name') }}. Premium Curated Experiences.</div>
            </div>
            <div class="flex flex-wrap gap-4">
                <a href="#" class="transition hover:text-violet-600">Privacy Policy</a>
                <a href="#" class="transition hover:text-violet-600">Terms of Service</a>
                <a href="#" class="transition hover:text-violet-600">Help Center</a>
                <a href="#" class="transition hover:text-violet-600">Contact Support</a>
            </div>
        </div>
    </footer>
</body>
</html>
