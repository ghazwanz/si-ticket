<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout - JoinFest</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --purple: #7C3AED;
            --purple-hover: #6D28D9;
            --purple-light: #F5F3FF;
            --purple-tag: #EDE9FE;
            --purple-tag-text: #7C3AED;
            --text-primary: #111827;
            --text-secondary: #6B7280;
            --border: #E5E7EB;
            --bg: #F9FAFB;
            --white: #FFFFFF;
            --input-focus: #7C3AED;
            --total-color: #7C3AED;
            --error: #EF4444;
            --success: #10B981;
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
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-left { display: flex; align-items: center; gap: 1.25rem; }

        .logo {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--purple);
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .search-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-wrap svg {
            position: absolute;
            left: 12px;
            color: var(--text-secondary);
            pointer-events: none;
        }

        .search-input {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.45rem 1rem 0.45rem 2.4rem;
            font-size: 0.875rem;
            font-family: inherit;
            width: 270px;
            color: var(--text-primary);
            background: var(--bg);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--purple);
            box-shadow: 0 0 0 3px rgba(124,58,237,0.1);
        }

        .nav-right { display: flex; align-items: center; gap: 1.5rem; }

        .nav-link {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-primary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .nav-link:hover { color: var(--purple); }

        .nav-divider { width: 1px; height: 22px; background: var(--border); }

        .btn-masuk {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .btn-masuk:hover { color: var(--purple); }

        .btn-daftar {
            background: var(--purple);
            color: var(--white);
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.2rem;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s, transform 0.1s;
            display: inline-block;
        }

        .btn-daftar:hover { background: var(--purple-hover); transform: translateY(-1px); }

        /* ── MAIN LAYOUT ── */
        main {
            flex: 1;
            max-width: 1100px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 4rem;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 2rem;
            align-items: start;
        }

        /* ── PAGE HEADER ── */
        .page-header { grid-column: 1 / -1; margin-bottom: 0.25rem; }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }

        /* ── CARD ── */
        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.75rem;
        }

        /* ── FORM SECTION ── */
        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1.5rem;
        }

        .section-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--purple-light);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section-icon svg { color: var(--purple); }

        .form-group { margin-bottom: 1.25rem; }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.45rem;
        }

        .form-control {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
            font-family: inherit;
            color: var(--text-primary);
            background: var(--white);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control::placeholder { color: #9CA3AF; }

        .form-control:focus {
            outline: none;
            border-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(124,58,237,0.1);
        }

        .form-control.is-invalid { border-color: var(--error); }

        .invalid-feedback {
            font-size: 0.78rem;
            color: var(--error);
            margin-top: 0.3rem;
            display: none;
        }

        .was-validated .form-control:invalid + .invalid-feedback,
        .form-control.is-invalid + .invalid-feedback { display: block; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* ── ORDER SUMMARY ── */
        .summary-card { position: sticky; top: 84px; }

        .summary-title {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
        }

        .summary-tag {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--purple-tag-text);
            background: var(--purple-tag);
            padding: 0.25rem 0.6rem;
            border-radius: 4px;
            margin-bottom: 0.75rem;
            display: inline-block;
        }

        .summary-item {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            padding: 0.6rem 0;
        }

        .item-img {
            width: 52px;
            height: 52px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border);
            background: var(--bg);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .item-info { flex: 1; }

        .item-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .item-meta {
            font-size: 0.78rem;
            color: var(--text-secondary);
            margin-top: 0.1rem;
        }

        .item-price {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
            white-space: nowrap;
        }

        .summary-divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 1rem 0;
        }

        .summary-section { margin-bottom: 1rem; }

        .cost-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.3rem 0;
        }

        .cost-label {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .cost-value {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .total-box {
            background: var(--bg);
            border-radius: 10px;
            padding: 1rem 1.1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
        }

        .total-label {
            font-size: 0.95rem;
            font-weight: 700;
        }

        .total-value {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--total-color);
        }

        .btn-bayar {
            width: 100%;
            background: var(--purple);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 0.9rem 1rem;
            font-size: 1rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
        }

        .btn-bayar:hover {
            background: var(--purple-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(124,58,237,0.3);
        }

        .btn-bayar:active { transform: translateY(0); }

        .secure-note {
            text-align: center;
            font-size: 0.78rem;
            color: var(--text-secondary);
            margin-top: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
        }

        /* ── FOOTER ── */
        footer {
            background: var(--white);
            border-top: 1px solid var(--border);
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-logo { font-size: 1.1rem; font-weight: 800; }
        .footer-logo span { color: var(--purple); }

        .footer-copy {
            font-size: 0.78rem;
            color: var(--text-secondary);
            margin-top: 0.15rem;
        }

        .footer-links { display: flex; gap: 1.5rem; }

        .footer-link {
            font-size: 0.82rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-link:hover { color: var(--purple); }

        /* ── ALERTS ── */
        .alert {
            padding: 0.85rem 1rem;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-success { background: #D1FAE5; color: #065F46; }
        .alert-error { background: #FEE2E2; color: #991B1B; }

        @media (max-width: 768px) {
            main {
                grid-template-columns: 1fr;
                padding: 1.5rem 1rem 3rem;
            }

            .page-header { grid-column: 1; }
            .summary-card { position: static; }
            .form-row { grid-template-columns: 1fr; }

            nav { padding: 0 1rem; }
            .search-input { width: 180px; }
            .footer-links { display: none; }
        }
    </style>
</head>
<body>

{{-- ── NAVBAR ── --}}
<nav>
    <div class="nav-left">
        <a href="{{ url('/') }}" class="logo">JoinFest</a>
        <div class="search-wrap">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
            <input type="text" class="search-input" placeholder="Cari event, konser, atau artis...">
        </div>
    </div>

    <div class="nav-right">
        <a href="{{ url('/') }}" class="nav-link">Beranda</a>
        <a href="{{ url('/events') }}" class="nav-link">Jelajahi Event</a>
        <div class="nav-divider"></div>
        <a href="{{ route('login') }}" class="btn-masuk">Masuk</a>
        <a href="{{ route('register') }}" class="btn-daftar">Daftar Sekarang</a>
    </div>
</nav>

{{-- ── MAIN CONTENT ── --}}
<main>
    <div class="page-header">
        <h1>Checkout</h1>
        <p>Selesaikan pesanan Anda untuk pengalaman yang tak terlupakan.</p>
    </div>

    {{-- Left: Buyer Form --}}
    <div>
        @if(session('success'))
            <div class="alert alert-success">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                Mohon periksa kembali data yang Anda masukkan.
            </div>
        @endif

        <div class="card">
            <div class="section-title">
                <div class="section-icon">
                    <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </div>
                Data Pemesan
            </div>

            <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
                @csrf

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input
                        type="text"
                        id="nama_lengkap"
                        name="nama_lengkap"
                        class="form-control {{ $errors->has('nama_lengkap') ? 'is-invalid' : '' }}"
                        placeholder="Masukkan nama lengkap sesuai identitas"
                        value="{{ old('nama_lengkap') }}"
                        required
                    >
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_lengkap') ?? 'Nama lengkap wajib diisi.' }}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            placeholder="nama@email.com"
                            value="{{ old('email') }}"
                            required
                        >
                        <div class="invalid-feedback">
                            {{ $errors->first('email') ?? 'Alamat email tidak valid.' }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="no_telepon">No. Telepon</label>
                        <input
                            type="tel"
                            id="no_telepon"
                            name="no_telepon"
                            class="form-control {{ $errors->has('no_telepon') ? 'is-invalid' : '' }}"
                            placeholder="0812xxxx"
                            value="{{ old('no_telepon') }}"
                            required
                        >
                        <div class="invalid-feedback">
                            {{ $errors->first('no_telepon') ?? 'Nomor telepon wajib diisi.' }}
                        </div>
                    </div>
                </div>

                {{-- Hidden fields for order data --}}
                <input type="hidden" name="order_id" value="{{ $order->id ?? '' }}">
            </form>
        </div>
    </div>

    {{-- Right: Order Summary --}}
    <div class="summary-card">
        <div class="card">
            <div class="summary-title">Ringkasan Pesanan</div>

            {{-- Tiket Utama --}}
            @if(isset($tikets) && $tikets->count())
                <div class="summary-tag">Tiket Utama</div>

                @foreach($tikets as $tiket)
                    <div class="summary-item">
                        <div class="item-img">
                            <img src="{{ asset('img/tiket.png') }}" alt="Festival" 
                                style="width:100%; height:100%; object-fit:cover; border-radius:8px;">
                        </div>
                        <div class="item-info">
                            <div class="item-name">{{ $tiket->nama }}</div>
                            <div class="item-meta">x{{ $tiket->qty }} Tiket</div>
                        </div>
                        <div class="item-price">Rp {{ number_format($tiket->harga * $tiket->qty, 0, ',', '.') }}</div>
                    </div>
                @endforeach
            @else
                {{-- Fallback / dummy data jika variabel tidak ada --}}
                <div class="summary-tag">Tiket Utama</div>
                <div class="summary-item">
                    <div class="item-img" style="background:#1a1a2e;">
                        <span style="font-size:0.7rem;color:#a78bfa;">🎤</span>
                    </div>
                    <div class="item-info">
                        <div class="item-name">Festival (Standing)</div>
                        <div class="item-meta">x1 Tiket</div>
                    </div>
                    <div class="item-price">Rp 750.000</div>
                </div>
            @endif

            <hr class="summary-divider">

            {{-- Merchandise --}}
            @if(isset($merchandises) && $merchandises->count())
                <div class="summary-tag">Merchandise</div>

                @foreach($merchandises as $merch)
                    <div class="summary-item">
                        @if ($merch->nama == 'Kaos Official')
                            <div class="item-img">
                                <img src="{{ asset('img/KaosOfficial.png') }}" alt="Kaos Official" 
                                    style="width:100%; height:100%; object-fit:cover; border-radius:8px;">
                            </div>
                        @elseif ($merch->nama == 'Tote Bag')
                            <div class="item-img">
                                <img src="{{ asset('img/ToteBag.png') }}" alt="Tote Bag" 
                                    style="width:100%; height:100%; object-fit:cover; border-radius:8px;">
                            </div>
                        @endif
                        <div class="item-info">
                            <div class="item-name">{{ $merch->nama }}</div>
                            <div class="item-meta">x{{ $merch->qty }} • {{ $merch->varian }}</div>
                        </div>
                        <div class="item-price">Rp {{ number_format($merch->harga * $merch->qty, 0, ',', '.') }}</div>
                    </div>
                @endforeach
            @else
                {{-- Fallback --}}
                <div class="summary-tag">Merchandise</div>
                <div class="summary-item">
                    <div class="item-img">👕</div>
                    <div class="item-info">
                        <div class="item-name">Kaos Official</div>
                        <div class="item-meta">x1 • Size L</div>
                    </div>
                    <div class="item-price">Rp 249.000</div>
                </div>
                <div class="summary-item">
                    <div class="item-img">👜</div>
                    <div class="item-info">
                        <div class="item-name">Tote Bag</div>
                        <div class="item-meta">x1 • Black</div>
                    </div>
                    <div class="item-price">Rp 129.000</div>
                </div>
            @endif

            <hr class="summary-divider">

            {{-- Cost Breakdown --}}
            <div class="summary-section">
                <div class="cost-row">
                    <span class="cost-label">Subtotal</span>
                    <span class="cost-value">Rp {{ number_format($subtotal ?? 1128000, 0, ',', '.') }}</span>
                </div>
                <div class="cost-row">
                    <span class="cost-label">Biaya Layanan</span>
                    <span class="cost-value">Rp {{ number_format($biaya_layanan ?? 15000, 0, ',', '.') }}</span>
                </div>
                <div class="cost-row">
                    <span class="cost-label">Pajak (10%)</span>
                    <span class="cost-value">Rp {{ number_format($pajak ?? 112800, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="total-box">
                <span class="total-label">Total Bayar</span>
                <span class="total-value">Rp {{ number_format($total ?? 1255800, 0, ',', '.') }}</span>
            </div>

            <button type="submit" form="checkoutForm" class="btn-bayar">
                Bayar Sekarang
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </button>

            <p class="secure-note">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                Transaksi aman &amp; terenkripsi oleh JoinFest Security
            </p>
        </div>
    </div>
</main>

{{-- ── FOOTER ── --}}
<footer>
    <div>
        <div class="footer-logo">JoinFest<span>Events</span></div>
        <div class="footer-copy">© {{ date('Y') }} VentureEvents. Premium Curated Experiences.</div>
    </div>
    <div class="footer-links">
        <a href="#" class="footer-link">Privacy Policy</a>
        <a href="#" class="footer-link">Terms of Service</a>
        <a href="#" class="footer-link">Help Center</a>
        <a href="#" class="footer-link">Contact Support</a>
    </div>
</footer>

</body>
</html>