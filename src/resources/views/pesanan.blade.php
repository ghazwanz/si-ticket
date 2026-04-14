<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - JoinFest</title>
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
                <a href="{{ route('pesanan.index') }}" class="border-b-2 border-violet-600 pb-0.5 text-sm font-semibold text-violet-600">Pesanan Saya</a>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ url('/notifications') }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-900" title="Notifikasi">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            </a>
            <a href="{{ url('/profile') }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-900" title="Profil">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </a>
        </div>
    </nav>

    <main class="mx-auto max-w-5xl px-4 py-8 md:px-8 md:py-10" data-reveal data-reveal-delay="0">
        <div class="mb-6 opacity-0 translate-y-6 scale-[0.98] blur-sm transition-all duration-700 ease-out" data-reveal data-reveal-delay="60">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Pesanan Saya</h1>
            <p class="mt-1 text-sm text-slate-500">Kelola dan pantau semua tiket event Anda dalam satu tempat.</p>
        </div>

        @php
            $filters = ['semua' => 'Semua', 'pending' => 'Pending', 'paid' => 'Paid', 'cancelled' => 'Cancelled', 'failed' => 'Failed'];
            $activeFilter = request('status', 'semua');
        @endphp

        <div class="mb-6 flex flex-wrap gap-2 opacity-0 translate-y-6 scale-[0.98] blur-sm transition-all duration-700 ease-out" data-reveal data-reveal-delay="120">
            @foreach($filters as $value => $label)
                <a href="{{ route('pesanan.index', $value !== 'semua' ? ['status' => $value] : []) }}" class="inline-flex items-center justify-center rounded-full border px-4 py-2 text-sm font-semibold transition {{ $activeFilter === $value ? 'border-violet-600 bg-violet-600 text-white' : 'border-slate-200 bg-white text-slate-500 hover:border-violet-600 hover:text-violet-600' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            @forelse($pesanan as $item)
                @php
                    $badgeClass = match(strtolower($item->status)) {
                        'paid' => 'bg-emerald-100 text-emerald-700',
                        'pending' => 'bg-amber-100 text-amber-700',
                        'cancelled' => 'bg-red-100 text-red-700',
                        'failed' => 'bg-slate-100 text-slate-700',
                        default => 'bg-slate-100 text-slate-700',
                    };
                @endphp

                <article class="flex flex-col gap-4 rounded-3xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-[0_8px_28px_rgba(15,23,42,0.08)] opacity-0 translate-y-6 scale-[0.98] blur-sm transition-all duration-700 ease-out" data-reveal data-reveal-delay="{{ $loop->index * 80 + 180 }}">
                    <div class="flex items-start gap-3">
                        @if($item->gambar)
                            <img src="{{ asset('images/' . $item->gambar) }}" alt="{{ $item->nama_event }}" class="h-20 w-20 shrink-0 rounded-2xl object-cover">
                        @else
                            <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-slate-900 text-2xl">🎪</div>
                        @endif

                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-2">
                                <h2 class="truncate text-base font-bold text-slate-900">{{ $item->nama_event }}</h2>
                                <span class="inline-flex shrink-0 rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.08em] {{ $badgeClass }}">{{ strtoupper($item->status) }}</span>
                            </div>

                            <div class="mt-3 space-y-1 text-xs text-slate-500">
                                <div class="flex items-center gap-2">
                                    <svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    <span>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                                    <span>ID: #{{ $item->kode_order }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-3 border-t border-slate-200 pt-4">
                        <div class="text-lg font-extrabold text-violet-600">Rp {{ number_format($item->total, 0, ',', '.') }}</div>
                        <a href="{{ route('pesanan.show', $item->id) }}" class="inline-flex items-center gap-1 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-violet-600 hover:text-violet-600">
                            Lihat Detail
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center md:col-span-2">
                    <svg class="mx-auto mb-4 h-12 w-12 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/></svg>
                    <h3 class="text-lg font-bold text-slate-900">Belum ada pesanan</h3>
                    <p class="mt-1 text-sm text-slate-500">Pesanan dengan status ini tidak ditemukan.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="border-t border-slate-200 bg-white px-4 py-5 text-sm text-slate-500 md:px-8">
        <div class="mx-auto flex max-w-5xl flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="font-bold tracking-tight text-slate-900">JoinFest</div>
                <div>© {{ date('Y') }} JoinFest Ticketing. All rights reserved.</div>
            </div>
            <div class="flex flex-wrap gap-4">
                <a href="#" class="transition hover:text-violet-600">Bantuan</a>
                <a href="#" class="transition hover:text-violet-600">Syarat &amp; Ketentuan</a>
                <a href="#" class="transition hover:text-violet-600">Kebijakan Privasi</a>
                <a href="#" class="transition hover:text-violet-600">Kontak Kami</a>
            </div>
        </div>
    </footer>
</body>
</html>
