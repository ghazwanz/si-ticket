<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - JoinFest</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --purple: #7C3AED;
            --purple-hover: #6D28D9;
            --purple-light: #F5F3FF;
            --text-primary: #111827;
            --text-secondary: #6B7280;
            --border: #E5E7EB;
            --bg: #F3F4F6;
            --white: #FFFFFF;
            --badge-paid-bg: #D1FAE5;
            --badge-paid-text: #065F46;
            --badge-pending-bg: #FEF3C7;
            --badge-pending-text: #92400E;
            --badge-cancelled-bg: #FEE2E2;
            --badge-cancelled-text: #991B1B;
            --badge-failed-bg: #F3F4F6;
            --badge-failed-text: #374151;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── NAVBAR ── */
        nav {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-left { display: flex; align-items: center; gap: 2rem; }

        .logo {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--purple);
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .nav-links { display: flex; align-items: center; gap: 1.5rem; }

        .nav-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            text-decoration: none;
            padding-bottom: 2px;
            border-bottom: 2px solid transparent;
            transition: color 0.2s, border-color 0.2s;
        }

        .nav-link:hover { color: var(--text-primary); }

        .nav-link.active {
            color: var(--purple);
            border-bottom-color: var(--purple);
            font-weight: 600;
        }

        .nav-right { display: flex; align-items: center; gap: 1rem; }

        .nav-icon-btn {
            width: 36px; height: 36px;
            border-radius: 50%;
            border: 1px solid var(--border);
            background: var(--white);
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: var(--text-secondary);
            transition: background 0.2s, color 0.2s;
            text-decoration: none;
        }

        .nav-icon-btn:hover { background: var(--bg); color: var(--text-primary); }

        /* ── MAIN ── */
        main {
            flex: 1;
            max-width: 780px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 4rem;
            width: 100%;
        }

        .page-header { margin-bottom: 1.75rem; }

        .page-header h1 {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin-top: 0.3rem;
        }

        /* ── FILTER TABS ── */
        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .tab-btn {
            padding: 0.45rem 1.1rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            border: 1px solid var(--border);
            background: var(--white);
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.2s;
        }

        .tab-btn:hover { border-color: var(--purple); color: var(--purple); }

        .tab-btn.active {
            background: var(--purple);
            border-color: var(--purple);
            color: var(--white);
        }

        /* ── ORDER GRID ── */
        .orders-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* ── ORDER CARD ── */
        .order-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .order-card:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }

        .card-top { display: flex; gap: 0.85rem; align-items: flex-start; }

        .event-img {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            object-fit: cover;
            flex-shrink: 0;
            background: #1a1a2e;
        }

        .event-img-placeholder {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            background: linear-gradient(135deg, #1a1a2e, #2d1b69);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .card-info { flex: 1; min-width: 0; }

        .card-title-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 0.5rem;
            margin-bottom: 0.4rem;
        }

        .event-name {
            font-size: 0.9rem;
            font-weight: 700;
            line-height: 1.3;
            color: var(--text-primary);
        }

        /* Badges */
        .badge {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 0.2rem 0.55rem;
            border-radius: 4px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .badge-paid     { background: var(--badge-paid-bg);      color: var(--badge-paid-text); }
        .badge-pending  { background: var(--badge-pending-bg);   color: var(--badge-pending-text); }
        .badge-cancelled{ background: var(--badge-cancelled-bg); color: var(--badge-cancelled-text); }
        .badge-failed   { background: var(--badge-failed-bg);    color: var(--badge-failed-text); }

        .event-meta {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.775rem;
            color: var(--text-secondary);
        }

        .meta-item svg { flex-shrink: 0; }

        /* Card bottom */
        .card-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .order-price {
            font-size: 1rem;
            font-weight: 800;
            color: var(--purple);
        }

        .detail-link {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.2rem;
            transition: color 0.2s;
        }

        .detail-link:hover { color: var(--purple); }

        /* Empty state */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 1rem;
            color: var(--text-secondary);
        }

        .empty-state svg { margin-bottom: 1rem; opacity: 0.4; }
        .empty-state h3 { font-size: 1rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.3rem; }
        .empty-state p { font-size: 0.875rem; }

        /* ── FOOTER ── */
        footer {
            background: var(--white);
            border-top: 1px solid var(--border);
            padding: 1.25rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-left {}
        .footer-logo { font-size: 1rem; font-weight: 800; color: var(--purple); }
        .footer-copy { font-size: 0.75rem; color: var(--text-secondary); margin-top: 0.1rem; }

        .footer-links { display: flex; gap: 1.25rem; }

        .footer-link {
            font-size: 0.8rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-link:hover { color: var(--purple); }

        @media (max-width: 640px) {
            .orders-grid { grid-template-columns: 1fr; }
            nav { padding: 0 1rem; }
            .nav-links { display: none; }
            footer { flex-direction: column; gap: 1rem; align-items: flex-start; }
        }
    </style>
</head>
<body>

{{-- ── NAVBAR ── --}}
<nav>
    <div class="nav-left">
        <a href="{{ url('/') }}" class="logo">JoinFest</a>
        <div class="nav-links">
            <a href="{{ url('/') }}" class="nav-link">Beranda</a>
            <a href="{{ url('/events') }}" class="nav-link">Jelajahi Event</a>
            <a href="{{ route('pesanan.index') }}" class="nav-link active">Pesanan Saya</a>
        </div>
    </div>
    <div class="nav-right">
        <a href="{{ url('/notifications') }}" class="nav-icon-btn" title="Notifikasi">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
        </a>
        <a href="{{ url('/profile') }}" class="nav-icon-btn" title="Profil">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </a>
    </div>
</nav>

{{-- ── MAIN ── --}}
<main>
    <div class="page-header">
        <h1>Pesanan Saya</h1>
        <p>Kelola dan pantau semua tiket event Anda dalam satu tempat.</p>
    </div>

    {{-- Filter Tabs --}}
    <div class="filter-tabs">
        @php
            $filters = ['semua' => 'Semua', 'pending' => 'Pending', 'paid' => 'Paid', 'cancelled' => 'Cancelled', 'failed' => 'Failed'];
            $activeFilter = request('status', 'semua');
        @endphp

        @foreach($filters as $value => $label)
            <a
                href="{{ route('pesanan.index', $value !== 'semua' ? ['status' => $value] : []) }}"
                class="tab-btn {{ $activeFilter === $value ? 'active' : '' }}"
            >
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- Orders Grid --}}
    <div class="orders-grid">
        @forelse($pesanan as $item)
            <div class="order-card">
                <div class="card-top">
                    {{-- Gambar Event --}}
                    @if($item->gambar)
                        <img
                            src="{{ asset('images/' . $item->gambar) }}"
                            alt="{{ $item->nama_event }}"
                            class="event-img"
                        >
                    @else
                        <div class="event-img-placeholder">🎪</div>
                    @endif

                    <div class="card-info">
                        <div class="card-title-row">
                            <div class="event-name">{{ $item->nama_event }}</div>
                            @php
                                $badgeClass = match(strtolower($item->status)) {
                                    'paid'      => 'badge-paid',
                                    'pending'   => 'badge-pending',
                                    'cancelled' => 'badge-cancelled',
                                    'failed'    => 'badge-failed',
                                    default     => 'badge-failed',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ strtoupper($item->status) }}</span>
                        </div>

                        <div class="event-meta">
                            <div class="meta-item">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                            </div>
                            <div class="meta-item">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <path d="M3 9h18M9 21V9"/>
                                </svg>
                                ID: #{{ $item->kode_order }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-bottom">
                    <div class="order-price">Rp {{ number_format($item->total, 0, ',', '.') }}</div>
                    <a href="{{ route('pesanan.show', $item->id) }}" class="detail-link">
                        Lihat Detail
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                </svg>
                <h3>Belum ada pesanan</h3>
                <p>Pesanan dengan status ini tidak ditemukan.</p>
            </div>
        @endforelse
    </div>
</main>

{{-- ── FOOTER ── --}}
<footer>
    <div class="footer-left">
        <div class="footer-logo">JoinFest</div>
        <div class="footer-copy">© {{ date('Y') }} JoinFest Ticketing. All rights reserved.</div>
    </div>
    <div class="footer-links">
        <a href="#" class="footer-link">Bantuan</a>
        <a href="#" class="footer-link">Syarat &amp; Ketentuan</a>
        <a href="#" class="footer-link">Kebijakan Privasi</a>
        <a href="#" class="footer-link">Kontak Kami</a>
    </div>
</footer>

</body>
</html>