<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - JoinFest</title>
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
            --green: #10B981;
            --green-bg: #D1FAE5;
            --green-text: #065F46;
            --orange-bg: #FEF3C7;
            --orange-text: #92400E;
            --red-bg: #FEE2E2;
            --red-text: #991B1B;
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
            transition: background 0.2s;
            text-decoration: none;
        }

        .nav-icon-btn:hover { background: var(--bg); }

        /* ── MAIN ── */
        main {
            flex: 1;
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem 1.5rem 4rem;
            width: 100%;
        }

        /* Back link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-decoration: none;
            margin-bottom: 1rem;
            transition: color 0.2s;
        }

        .back-link:hover { color: var(--purple); }

        /* Page header */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .header-left h1 {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .header-meta {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.4rem;
            flex-wrap: wrap;
        }

        .order-id {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-secondary);
        }

        .dot { color: var(--border); font-size: 1rem; }

        .order-date {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.82rem;
            color: var(--text-secondary);
        }

        /* Status badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.78rem;
            font-weight: 700;
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
        }

        .badge-paid      { background: var(--green-bg); color: var(--green-text); border: 1px solid #6EE7B7; }
        .badge-pending   { background: var(--orange-bg); color: var(--orange-text); border: 1px solid #FCD34D; }
        .badge-cancelled { background: var(--red-bg); color: var(--red-text); border: 1px solid #FCA5A5; }
        .badge-failed    { background: #F3F4F6; color: #374151; border: 1px solid var(--border); }

        /* ── LAYOUT GRID ── */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 1.25rem;
            align-items: start;
        }

        /* ── CARD ── */
        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 1.25rem;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border);
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            font-weight: 700;
        }

        .card-title svg { color: var(--purple); }

        .count-badge {
            background: var(--purple-light);
            color: var(--purple);
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
        }

        /* ── TIKET TABLE ── */
        .tiket-table { width: 100%; border-collapse: collapse; }

        .tiket-table th {
            padding: 0.65rem 1.25rem;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-secondary);
            text-align: left;
            background: var(--bg);
            border-bottom: 1px solid var(--border);
        }

        .tiket-table td {
            padding: 0.9rem 1.25rem;
            font-size: 0.875rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .tiket-table tr:last-child td { border-bottom: none; }

        .tiket-nama { font-weight: 700; font-size: 0.875rem; }
        .tiket-id   { font-size: 0.75rem; color: var(--text-secondary); margin-top: 0.1rem; }

        .kategori-badge {
            display: inline-block;
            background: var(--purple-light);
            color: var(--purple);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.65rem;
            border-radius: 6px;
        }

        .status-checkin {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-checkin.sudah { color: var(--green); }
        .status-checkin.belum { color: var(--text-secondary); }

        .btn-etiket {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--purple);
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .btn-etiket:hover { opacity: 0.7; }

        /* ── MERCHANDISE ── */
        .merch-list { padding: 1rem 1.25rem; display: flex; flex-direction: column; gap: 1rem; }

        .merch-item {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .merch-img {
            width: 72px;
            height: 72px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid var(--border);
            background: #1a1a2e;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .merch-info { flex: 1; }

        .merch-name {
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
        }

        .merch-varian {
            font-size: 0.78rem;
            color: var(--text-secondary);
            margin-bottom: 0.4rem;
        }

        .merch-status {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
        }

        .merch-status.diambil   { background: var(--green-bg); color: var(--green-text); }
        .merch-status.belum     { background: var(--orange-bg); color: var(--orange-text); }

        .btn-qr {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-secondary);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.45rem 0.85rem;
            text-decoration: none;
            background: var(--white);
            transition: border-color 0.2s, color 0.2s;
            white-space: nowrap;
        }

        .btn-qr:hover { border-color: var(--purple); color: var(--purple); }

        /* ── SUMMARY CARD ── */
        .summary-card {
            position: sticky;
            top: 76px;
        }

        .summary-header {
            background: var(--purple);
            padding: 1rem 1.25rem;
            border-radius: 14px 14px 0 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .summary-header span {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--white);
        }

        .summary-body {
            background: var(--white);
            border: 1px solid var(--border);
            border-top: none;
            padding: 1.1rem 1.25rem;
            border-radius: 0 0 14px 14px;
        }

        .cost-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.35rem 0;
        }

        .cost-label { font-size: 0.845rem; color: var(--text-secondary); }
        .cost-value { font-size: 0.845rem; font-weight: 500; }

        .summary-divider { border: none; border-top: 1px solid var(--border); margin: 0.75rem 0; }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .total-label { font-size: 0.95rem; font-weight: 700; }
        .total-value { font-size: 1.3rem; font-weight: 800; color: var(--purple); }

        /* Payment method */
        .payment-method {
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            margin-bottom: 1rem;
        }

        .payment-icon {
            width: 36px; height: 36px;
            background: var(--purple-light);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .payment-info {}
        .payment-label { font-size: 0.7rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em; }
        .payment-name  { font-size: 0.875rem; font-weight: 700; }

        /* Action buttons */
        .btn-invoice {
            width: 100%;
            background: var(--purple);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 0.8rem 1rem;
            font-size: 0.875rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
            margin-bottom: 0.65rem;
            transition: background 0.2s, transform 0.1s;
        }

        .btn-invoice:hover { background: var(--purple-hover); transform: translateY(-1px); }

        .btn-bantuan {
            width: 100%;
            background: var(--white);
            color: var(--text-secondary);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
            margin-bottom: 1rem;
            transition: border-color 0.2s, color 0.2s;
        }

        .btn-bantuan:hover { border-color: var(--purple); color: var(--purple); }

        /* Info note */
        .info-note {
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            display: flex;
            gap: 0.5rem;
            font-size: 0.78rem;
            color: #1E40AF;
            line-height: 1.5;
        }

        .info-note svg { flex-shrink: 0; margin-top: 1px; }

        /* ── FOOTER ── */
        footer {
            background: var(--white);
            border-top: 1px solid var(--border);
            padding: 1.25rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

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

        @media (max-width: 700px) {
            .content-grid { grid-template-columns: 1fr; }
            .summary-card { position: static; }
            nav { padding: 0 1rem; }
            .nav-links { display: none; }
            .tiket-table th:nth-child(2),
            .tiket-table td:nth-child(2) { display: none; }
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
        <a href="{{ url('/notifications') }}" class="nav-icon-btn">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
        </a>
        <a href="{{ url('/profile') }}" class="nav-icon-btn">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </a>
    </div>
</nav>

{{-- ── MAIN ── --}}
<main>
    <a href="{{ route('pesanan.index') }}" class="back-link">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Pesanan
    </a>

    {{-- Page Header --}}
    <div class="page-header">
        <div class="header-left">
            <h1>Detail Pesanan</h1>
            <div class="header-meta">
                <span class="order-id">ORDER ID: {{ $pesanan->kode_order }}</span>
                <span class="dot">•</span>
                <span class="order-date">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    {{ \Carbon\Carbon::parse($pesanan->tanggal)->translatedFormat('d F Y') }}, {{ $pesanan->jam ?? '14:30' }} WIB
                </span>
            </div>
        </div>

        @php
            $badgeClass = match(strtolower($pesanan->status)) {
                'paid'      => 'badge-paid',
                'pending'   => 'badge-pending',
                'cancelled' => 'badge-cancelled',
                default     => 'badge-failed',
            };
            $badgeLabel = match(strtolower($pesanan->status)) {
                'paid'      => 'Lunas (Paid)',
                'pending'   => 'Menunggu Pembayaran',
                'cancelled' => 'Dibatalkan',
                default     => 'Gagal',
            };
        @endphp

        <span class="badge {{ $badgeClass }}">
            @if(strtolower($pesanan->status) === 'paid')
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M20 6L9 17l-5-5"/>
                </svg>
            @endif
            {{ $badgeLabel }}
        </span>
    </div>

    <div class="content-grid">
        {{-- LEFT COLUMN --}}
        <div>
            {{-- Tiket Event --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v2z"/>
                        </svg>
                        Tiket Event
                    </div>
                    <span class="count-badge">{{ count($pesanan->tikets) }} TIKET</span>
                </div>

                <table class="tiket-table">
                    <thead>
                        <tr>
                            <th>Pemegang Tiket</th>
                            <th>Kategori</th>
                            <th>Status Check-in</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->tikets as $tiket)
                            <tr>
                                <td>
                                    <div class="tiket-nama">{{ $tiket->nama }}</div>
                                    <div class="tiket-id">ID: {{ $tiket->id_tiket }}</div>
                                </td>
                                <td>
                                    <span class="kategori-badge">{{ $tiket->kategori }}</span>
                                </td>
                                <td>
                                    @if($tiket->sudah_checkin)
                                        <span class="status-checkin sudah">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path d="M20 6L9 17l-5-5"/>
                                            </svg>
                                            Sudah Check-in
                                        </span>
                                    @else
                                        <span class="status-checkin belum">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10"/>
                                                <line x1="12" y1="8" x2="12" y2="12"/>
                                                <line x1="12" y1="16" x2="12.01" y2="16"/>
                                            </svg>
                                            Belum Check-in
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ $tiket->url_etiket ?? '#' }}" class="btn-etiket" target="_blank">
                                        Lihat E-Tiket
                                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                            <polyline points="15 3 21 3 21 9"/>
                                            <line x1="10" y1="14" x2="21" y2="3"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Merchandise --}}
            @if(count($pesanan->merchandises) > 0)
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                <line x1="3" y1="6" x2="21" y2="6"/>
                                <path d="M16 10a4 4 0 0 1-8 0"/>
                            </svg>
                            Merchandise &amp; Add-ons
                        </div>
                    </div>

                    <div class="merch-list">
                        @foreach($pesanan->merchandises as $merch)
                            <div class="merch-item">
                                @if($merch->gambar)
                                    <img src="{{ asset('images/' . $merch->gambar) }}" alt="{{ $merch->nama }}" class="merch-img">
                                @else
                                    <div class="merch-img">👕</div>
                                @endif

                                <div class="merch-info">
                                    <div class="merch-name">{{ $merch->nama }}</div>
                                    <div class="merch-varian">Varian: {{ $merch->varian }} &nbsp;•&nbsp; Qty: {{ $merch->qty }}</div>
                                    @if($merch->sudah_diambil)
                                        <span class="merch-status diambil">
                                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path d="M20 6L9 17l-5-5"/>
                                            </svg>
                                            Sudah Diambil
                                        </span>
                                    @else
                                        <span class="merch-status belum">
                                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10"/>
                                                <line x1="12" y1="8" x2="12" y2="12"/>
                                                <line x1="12" y1="16" x2="12.01" y2="16"/>
                                            </svg>
                                            Belum Diambil
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ $merch->url_qr ?? '#' }}" class="btn-qr" target="_blank">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                                        <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="3" height="3"/>
                                    </svg>
                                    Lihat QR Merch
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- RIGHT COLUMN: Summary --}}
        <div class="summary-card">
            <div class="summary-header">
                <svg width="17" height="17" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                    <line x1="1" y1="10" x2="23" y2="10"/>
                </svg>
                <span>Ringkasan Pembayaran</span>
            </div>

            <div class="summary-body">
                <div class="cost-row">
                    <span class="cost-label">Subtotal ({{ count($pesanan->tikets) }} Tiket)</span>
                    <span class="cost-value">Rp {{ number_format($pesanan->subtotal_tiket ?? 1500000, 0, ',', '.') }}</span>
                </div>
                <div class="cost-row">
                    <span class="cost-label">Subtotal ({{ count($pesanan->merchandises) }} Merchandise)</span>
                    <span class="cost-value">Rp {{ number_format($pesanan->subtotal_merch ?? 650000, 0, ',', '.') }}</span>
                </div>
                <div class="cost-row">
                    <span class="cost-label">Pajak (11%)</span>
                    <span class="cost-value">Rp {{ number_format($pesanan->pajak ?? 236500, 0, ',', '.') }}</span>
                </div>
                <div class="cost-row">
                    <span class="cost-label">Biaya Layanan</span>
                    <span class="cost-value">Rp {{ number_format($pesanan->biaya_layanan ?? 25000, 0, ',', '.') }}</span>
                </div>

                <hr class="summary-divider">

                <div class="total-row">
                    <span class="total-label">Total Bayar</span>
                    <span class="total-value">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                </div>

                {{-- Payment Method --}}
                <div class="payment-method">
                    <div class="payment-icon">
                        <svg width="16" height="16" fill="none" stroke="#7C3AED" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                            <line x1="1" y1="10" x2="23" y2="10"/>
                        </svg>
                    </div>
                    <div class="payment-info">
                        <div class="payment-label">Metode Pembayaran</div>
                        <div class="payment-name">{{ $pesanan->metode_pembayaran ?? 'BCA Virtual Account' }}</div>
                    </div>
                </div>

                {{-- Actions --}}
                <a href="{{ route('pesanan.invoice', $pesanan->id) }}" class="btn-invoice">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    Unduh Invoice (PDF)
                </a>

                <a href="{{ url('/bantuan') }}" class="btn-bantuan">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                    Butuh Bantuan?
                </a>

                <div class="info-note">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    E-Tiket dapat dipindai saat gerbang dibuka. Pastikan Anda membawa kartu identitas asli yang sesuai dengan nama pemegang tiket.
                </div>
            </div>
        </div>
    </div>
</main>

{{-- ── FOOTER ── --}}
<footer>
    <div>
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