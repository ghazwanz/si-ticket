<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - JoinFest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-slate-100 font-[Plus_Jakarta_Sans,sans-serif] text-slate-900">
    <nav data-site-header data-scrolled="false" class="sticky top-0 z-50 flex h-16 items-center justify-between border-b border-slate-200 bg-white px-4 shadow-sm transition-all duration-300 md:px-8 data-[scrolled=true]:border-violet-200 data-[scrolled=true]:bg-white/95 data-[scrolled=true]:shadow-[0_12px_30px_rgba(15,23,42,0.08)]">
        <div class="flex items-center gap-5">
            <a href="{{ url('/') }}" class="text-xl font-extrabold tracking-tight text-violet-600">JoinFest</a>
            <div class="hidden items-center gap-6 md:flex">
                <a href="{{ url('/') }}" class="text-sm font-medium text-slate-500 transition hover:text-violet-600">Beranda</a>
                <a href="{{ url('/events') }}" class="text-sm font-medium text-slate-500 transition hover:text-violet-600">Jelajahi Event</a>
                <a href="{{ route('pesanan.index') }}" class="text-sm font-medium text-slate-500 transition hover:text-violet-600">Pesanan Saya</a>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ url('/notifications') }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-900">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            </a>
            <a href="{{ url('/profile') }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-900">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </a>
        </div>
    </nav>

    <main class="mx-auto max-w-6xl px-4 py-8 md:px-8 md:py-10" data-reveal data-reveal-delay="0">
        <a href="{{ route('pesanan.index') }}" class="mb-5 inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-violet-600 opacity-0 translate-y-6 scale-[0.98] blur-sm transition-all duration-700 ease-out" data-reveal data-reveal-delay="60">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali ke Daftar Pesanan
        </a>

        <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between opacity-0 translate-y-6 scale-[0.98] blur-sm transition-all duration-700 ease-out" data-reveal data-reveal-delay="120">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Detail Pesanan</h1>
                <div class="mt-2 flex flex-wrap items-center gap-2 text-sm text-slate-500">
                    <span class="font-semibold uppercase tracking-[0.08em]">ORDER ID: {{ $pesanan->kode_order }}</span>
                    <span>•</span>
                    <span class="inline-flex items-center gap-1">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ \Carbon\Carbon::parse($pesanan->tanggal)->translatedFormat('d F Y') }}, {{ $pesanan->jam ?? '14:30' }} WIB
                    </span>
                </div>
            </div>

            @php
                $badgeClass = match(strtolower($pesanan->status)) {
                    'paid' => 'bg-emerald-100 text-emerald-700',
                    'pending' => 'bg-amber-100 text-amber-700',
                    'cancelled' => 'bg-red-100 text-red-700',
                    default => 'bg-slate-100 text-slate-700',
                };
                $badgeLabel = match(strtolower($pesanan->status)) {
                    'paid' => 'Lunas (Paid)',
                    'pending' => 'Menunggu Pembayaran',
                    'cancelled' => 'Dibatalkan',
                    default => 'Gagal',
                };
            @endphp

            <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-bold {{ $badgeClass }}">
                @if(strtolower($pesanan->status) === 'paid')
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                @endif
                {{ $badgeLabel }}
            </span>
        </div>

        <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_320px]">
            <section class="space-y-6 opacity-0 translate-y-6 scale-[0.98] blur-sm transition-all duration-700 ease-out" data-reveal data-reveal-delay="180">
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                    <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                        <div class="flex items-center gap-2 text-base font-bold text-slate-900">
                            <svg class="h-4.5 w-4.5 text-violet-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v2z"/></svg>
                            Tiket Event
                        </div>
                        <span class="rounded-full bg-violet-50 px-3 py-1 text-xs font-bold uppercase tracking-[0.08em] text-violet-600">{{ count($pesanan->tikets) }} Tiket</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                            <thead class="bg-slate-50 text-xs uppercase tracking-[0.08em] text-slate-500">
                                <tr>
                                    <th class="px-5 py-3 font-semibold">Pemegang Tiket</th>
                                    <th class="px-5 py-3 font-semibold">Kategori</th>
                                    <th class="px-5 py-3 font-semibold">Status Check-in</th>
                                    <th class="px-5 py-3 font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white">
                                @foreach($pesanan->tikets as $tiket)
                                    <tr>
                                        <td class="px-5 py-4 align-middle">
                                            <div class="font-semibold text-slate-900">{{ $tiket->nama }}</div>
                                            <div class="text-xs text-slate-500">ID: {{ $tiket->id_tiket }}</div>
                                        </td>
                                        <td class="px-5 py-4 align-middle">
                                            <span class="inline-flex rounded-lg bg-violet-50 px-3 py-1 text-xs font-semibold text-violet-600">{{ $tiket->kategori }}</span>
                                        </td>
                                        <td class="px-5 py-4 align-middle">
                                            @if($tiket->sudah_checkin)
                                                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                                                    Sudah Check-in
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-2 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                                    Belum Check-in
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4 align-middle">
                                            <a href="{{ $tiket->url_etiket ?? '#' }}" target="_blank" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 transition hover:border-violet-600 hover:text-violet-600">
                                                Lihat E-Tiket
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(count($pesanan->merchandises) > 0)
                    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                        <div class="flex items-center gap-2 border-b border-slate-200 px-5 py-4 text-base font-bold text-slate-900">
                            <svg class="h-4.5 w-4.5 text-violet-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                            Merchandise &amp; Add-ons
                        </div>

                        <div class="space-y-3 p-5">
                            @foreach($pesanan->merchandises as $merch)
                                <div class="flex items-center gap-3 rounded-2xl border border-slate-200 p-3">
                                    @if($merch->gambar)
                                        <img src="{{ asset('images/' . $merch->gambar) }}" alt="{{ $merch->nama }}" class="h-14 w-14 rounded-xl object-cover">
                                    @else
                                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-slate-100 text-lg">👕</div>
                                    @endif

                                    <div class="min-w-0 flex-1">
                                        <div class="font-semibold text-slate-900">{{ $merch->nama }}</div>
                                        <div class="text-xs text-slate-500">Varian: {{ $merch->varian }} &nbsp;•&nbsp; Qty: {{ $merch->qty }}</div>
                                        @if($merch->sudah_diambil)
                                            <span class="mt-2 inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                                                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                                                Sudah Diambil
                                            </span>
                                        @else
                                            <span class="mt-2 inline-flex items-center gap-2 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                                Belum Diambil
                                            </span>
                                        @endif
                                    </div>

                                    <a href="{{ $merch->url_qr ?? '#' }}" target="_blank" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 transition hover:border-violet-600 hover:text-violet-600">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="3" height="3"/></svg>
                                        Lihat QR Merch
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </section>

            <aside class="lg:sticky lg:top-24 lg:self-start opacity-0 translate-y-6 scale-[0.98] blur-sm transition-all duration-700 ease-out" data-reveal data-reveal-delay="240">
                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-5 flex items-center gap-2 rounded-2xl bg-violet-600 px-4 py-3 text-white">
                        <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                        <span class="text-sm font-semibold">Ringkasan Pembayaran</span>
                    </div>

                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-slate-500">Subtotal ({{ count($pesanan->tikets) }} Tiket)</span>
                            <span class="font-semibold text-slate-900">Rp {{ number_format($pesanan->subtotal_tiket ?? 1500000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-slate-500">Subtotal ({{ count($pesanan->merchandises) }} Merchandise)</span>
                            <span class="font-semibold text-slate-900">Rp {{ number_format($pesanan->subtotal_merch ?? 650000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-slate-500">Pajak (11%)</span>
                            <span class="font-semibold text-slate-900">Rp {{ number_format($pesanan->pajak ?? 236500, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-slate-500">Biaya Layanan</span>
                            <span class="font-semibold text-slate-900">Rp {{ number_format($pesanan->biaya_layanan ?? 25000, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="my-5 h-px bg-slate-200"></div>

                    <div class="rounded-2xl bg-violet-50 px-4 py-4">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-sm font-semibold text-violet-700">Total Bayar</span>
                            <span class="text-xl font-extrabold text-violet-700">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </main>
</body>
</html>
