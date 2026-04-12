<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $organizer->nama }} - JoinFest</title>
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
            --bg: #F9FAFB;
            --white: #FFFFFF;
            --star: #F59E0B;
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
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-left { display: flex; align-items: center; gap: 2rem; }

        .logo {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--text-primary);
            text-decoration: none;
        }

        .nav-links { display: flex; gap: 1.5rem; }

        .nav-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .nav-link:hover { color: var(--text-primary); }

        .nav-right { display: flex; align-items: center; gap: 0.75rem; }

        .nav-icon {
            width: 34px; height: 34px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--text-secondary);
            text-decoration: none;
            transition: background 0.2s;
        }

        .nav-icon:hover { background: var(--bg); }

        /* ── HERO BANNER ── */
        .hero-banner {
            width: 100%;
            height: 260px;
            background: #0f0f1a;
            overflow: hidden;
            position: relative;
        }

        .hero-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.85;
        }

        .hero-banner-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #0f0f1a 0%, #1a0533 40%, #2d1b69 70%, #1a0533 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ── PROFILE SECTION ── */
        .profile-section {
            background: var(--white);
            border-bottom: 1px solid var(--border);
        }

        .profile-inner {
            max-width: 860px;
            margin: 0 auto;
            padding: 0 2rem 1.5rem;
            position: relative;
        }

        .profile-avatar-wrap {
            position: relative;
            display: inline-block;
            margin-top: -44px;
            margin-bottom: 1rem;
        }

        .profile-avatar {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            border: 4px solid var(--white);
            background: var(--bg);
            object-fit: cover;
            display: block;
        }

        .profile-avatar-placeholder {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            border: 4px solid var(--white);
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            font-weight: 700;
            color: var(--text-secondary);
            letter-spacing: 0.05em;
            text-align: center;
            line-height: 1.3;
        }

        .profile-main {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .profile-info {}

        .profile-name-row {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            margin-bottom: 0.5rem;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.3px;
        }

        .verified-icon { color: var(--purple); flex-shrink: 0; }

        .profile-bio {
            font-size: 0.845rem;
            color: var(--text-secondary);
            line-height: 1.6;
            max-width: 520px;
        }

        .profile-actions { display: flex; gap: 0.65rem; flex-shrink: 0; }

        .btn-ikuti {
            background: var(--purple);
            color: var(--white);
            border: none;
            border-radius: 8px;
            padding: 0.55rem 1.4rem;
            font-size: 0.875rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }

        .btn-ikuti:hover { background: var(--purple-hover); transform: translateY(-1px); }

        .btn-hubungi {
            background: var(--white);
            color: var(--text-primary);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.55rem 1.4rem;
            font-size: 0.875rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: border-color 0.2s;
        }

        .btn-hubungi:hover { border-color: var(--purple); color: var(--purple); }

        /* ── STATS ── */
        .stats-bar {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            max-width: 860px;
            margin: 1.5rem auto;
            padding: 1.5rem 2rem;
            display: flex;
            gap: 3rem;
        }

        .stat-item {}

        .stat-value {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--purple);
            line-height: 1;
            margin-bottom: 0.3rem;
        }

        .stat-value.neutral { color: var(--text-primary); }

        .stat-value.rating {
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .stat-value.rating svg { color: var(--star); }

        .stat-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: var(--text-secondary);
        }

        /* ── TABS ── */
        .tabs-wrap {
            max-width: 860px;
            margin: 0 auto;
            padding: 0 0 0;
            border-bottom: 2px solid var(--border);
            display: flex;
            gap: 0;
        }

        .tab-link {
            font-size: 0.925rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-decoration: none;
            padding: 0.75rem 0;
            margin-right: 2rem;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            transition: color 0.2s, border-color 0.2s;
        }

        .tab-link:hover { color: var(--text-primary); }
        .tab-link.active { color: var(--text-primary); border-bottom-color: var(--text-primary); font-weight: 700; }

        /* ── EVENTS GRID ── */
        .section-wrap {
            max-width: 860px;
            margin: 2rem auto;
            padding: 0 0;
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
        }

        .event-card { text-decoration: none; color: inherit; }

        .event-img-wrap {
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            height: 200px;
            background: #1a1a2e;
            margin-bottom: 0.85rem;
        }

        .event-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .event-card:hover .event-img-wrap img { transform: scale(1.04); }

        .event-img-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1a1a2e, #2d1b69);
        }

        .event-tag {
            position: absolute;
            top: 10px;
            left: 10px;
            background: var(--white);
            border-radius: 999px;
            padding: 0.2rem 0.65rem;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            color: var(--text-primary);
        }

        .event-name {
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .event-meta {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .event-meta-item {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.78rem;
            color: var(--text-secondary);
        }

        /* ── TESTIMONIALS ── */
        .testimonials-wrap {
            background: var(--white);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 3rem 2rem;
            margin-top: 2rem;
        }

        .testimonials-inner { max-width: 860px; margin: 0 auto; }

        .testimonials-title {
            font-size: 1.1rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .testimonial-card {
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.25rem;
        }

        .stars { display: flex; gap: 0.2rem; margin-bottom: 0.75rem; }

        .star { color: var(--star); }

        .testimonial-text {
            font-size: 0.845rem;
            color: var(--text-secondary);
            font-style: italic;
            line-height: 1.65;
            margin-bottom: 1rem;
        }

        .reviewer {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .reviewer-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            background: var(--bg);
            flex-shrink: 0;
        }

        .reviewer-avatar-placeholder {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--purple-light), #ddd6fe);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--purple);
            flex-shrink: 0;
        }

        .reviewer-name {
            font-size: 0.845rem;
            font-weight: 700;
        }

        .reviewer-role {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--text-secondary);
        }

        /* ── FOOTER ── */
        footer {
            background: var(--white);
            border-top: 1px solid var(--border);
            padding: 3rem 2rem 2rem;
            margin-top: auto;
        }

        .footer-inner {
            max-width: 860px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr auto auto;
            gap: 4rem;
            margin-bottom: 2rem;
        }

        .footer-brand .footer-logo {
            font-size: 1.1rem;
            font-weight: 800;
            margin-bottom: 0.65rem;
        }

        .footer-brand p {
            font-size: 0.82rem;
            color: var(--text-secondary);
            line-height: 1.6;
            max-width: 220px;
        }

        .footer-col-title {
            font-size: 0.82rem;
            font-weight: 700;
            margin-bottom: 0.85rem;
        }

        .footer-col-links { display: flex; flex-direction: column; gap: 0.55rem; }

        .footer-col-link {
            font-size: 0.82rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-col-link:hover { color: var(--purple); }

        .social-icons { display: flex; gap: 0.65rem; }

        .social-icon {
            width: 34px; height: 34px;
            border: 1px solid var(--border);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--text-secondary);
            text-decoration: none;
            transition: border-color 0.2s, color 0.2s;
        }

        .social-icon:hover { border-color: var(--purple); color: var(--purple); }

        .footer-bottom {
            max-width: 860px;
            margin: 0 auto;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
            text-align: center;
            font-size: 0.78rem;
            color: var(--text-secondary);
        }

        @media (max-width: 700px) {
            .events-grid { grid-template-columns: 1fr; }
            .testimonials-grid { grid-template-columns: 1fr; }
            .footer-inner { grid-template-columns: 1fr; gap: 2rem; }
            .stats-bar { gap: 1.5rem; flex-wrap: wrap; }
            nav { padding: 0 1rem; }
            .nav-links { display: none; }
            .profile-inner { padding: 0 1rem 1.5rem; }
        }
    </style>
</head>
<body>

{{-- ── NAVBAR ── --}}
<nav>
    <div class="nav-left">
        <a href="{{ url('/') }}" class="logo">JoinFest</a>
        <div class="nav-links">
            <a href="{{ url('/discover') }}" class="nav-link">Discover</a>
            <a href="{{ url('/calendar') }}" class="nav-link">Calendar</a>
            <a href="{{ route('pesanan.index') }}" class="nav-link">Orders</a>
        </div>
    </div>
    <div class="nav-right">
        <a href="{{ url('/notifications') }}" class="nav-icon">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
        </a>
        <a href="{{ url('/profile') }}" class="nav-icon">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </a>
    </div>
</nav>

{{-- ── HERO BANNER ── --}}
<div class="hero-banner">
        <img src="../img/eobanner.png">
    {{-- @else
        <div class="hero-banner-placeholder"></div>
    @endif --}}
</div>

{{-- ── PROFILE SECTION ── --}}
<div class="profile-section">
    <div class="profile-inner">
        <div class="profile-avatar-wrap">
            <img src="../img/EOLogo.png" class="profile-avatar">
            {{-- @if($organizer->avatar)
                <img src="{{ asset('image/' . $organizer->avatar) }}" alt="{{ $organizer->nama }}" class="profile-avatar">
            @else
                <div class="profile-avatar-placeholder">COMPANY</div>
            @endif --}}
        </div>

        <div class="profile-main">
            <div class="profile-info">
                <div class="profile-name-row">
                    <h1 class="profile-name">{{ $organizer->nama }}</h1>
                    @if($organizer->terverifikasi)
                        <svg class="verified-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0 1 12 2.944a11.955 11.955 0 0 1-8.618 3.04A12.02 12.02 0 0 0 3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    @endif
                </div>
                <p class="profile-bio">{{ $organizer->bio }}</p>
            </div>

            <div class="profile-actions">
                <form action="{{ route('organizer.ikuti', $organizer->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-ikuti">Ikuti</button>
                </form>
                <a href="{{ route('organizer.hubungi', $organizer->id) }}" class="btn-hubungi">Hubungi</a>
            </div>
        </div>
    </div>
</div>

{{-- ── STATS BAR ── --}}
<div style="max-width:860px; margin:0 auto; padding:0 2rem;">
    <div class="stats-bar">
        <div class="stat-item">
            <div class="stat-value">{{ $organizer->event_aktif }}</div>
            <div class="stat-label">Event Aktif</div>
        </div>
        <div class="stat-item">
            <div class="stat-value neutral">{{ number_format($organizer->pengikut / 1000, 1) }}k</div>
            <div class="stat-label">Pengikut</div>
        </div>
        <div class="stat-item">
            <div class="stat-value rating">
                {{ number_format($organizer->rating, 1) }}
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
            <div class="stat-label">Rating Rata-rata</div>
        </div>
    </div>
</div>

{{-- ── TABS ── --}}
@php $activeTab = request('tab', 'aktif'); @endphp
<div style="max-width:860px; margin:0 auto; padding:0 2rem;">
    <div class="tabs-wrap">
        <a href="{{ route('organizer.show', [$organizer->id, 'tab' => 'aktif']) }}"
           class="tab-link {{ $activeTab === 'aktif' ? 'active' : '' }}">
            Event Aktif
        </a>
        <a href="{{ route('organizer.show', [$organizer->id, 'tab' => 'lampau']) }}"
           class="tab-link {{ $activeTab === 'lampau' ? 'active' : '' }}">
            Event Lampau
        </a>
    </div>
</div>

{{-- ── EVENTS GRID ── --}}
<div style="max-width:860px; margin:0 auto; padding:0 2rem;">
    <div class="section-wrap">
       
            <div class="events-grid">
                            {{-- <span class="event-tag">{{ strtoupper($event->kategori) }}</span> --}}
                        </div>
                        {{-- <div class="event-name">{{ $event->nama }}</div> --}}
                        <div class="event-meta">
                            <div class="event-meta-item">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                {{-- {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }} --}}
                            </div>
                            <div class="event-meta-item">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                {{-- {{ $event->lokasi }} --}}
                            </div>
                        </div>
                    </a>
            </div>
        {{-- @else
            <div style="text-align:center; padding:3rem 0; color:var(--text-secondary);">
                <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 1rem; display:block; opacity:0.4;">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                <p style="font-weight:600; color:var(--text-primary);">Belum ada event</p>
                <p style="font-size:0.85rem; margin-top:0.25rem;">Tidak ada event yang tersedia saat ini.</p>
            </div>
        @endif --}}
    </div>
</div>

{{-- ── TESTIMONIALS ── --}}
@if($testimonials->count())
    <div class="testimonials-wrap">
        <div class="testimonials-inner">
            <h2 class="testimonials-title">Apa Kata Mereka tentang {{ $organizer->nama }}</h2>

            <div class="testimonials-grid">
                @foreach($testimonials as $t)
                    <div class="testimonial-card">
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="star" width="16" height="16" fill="{{ $i <= $t->rating ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="testimonial-text">"{{ $t->komentar }}"</p>
                        <div class="reviewer">
                            @if($t->avatar)
                                <img src="{{ asset('images/' . $t->avatar) }}" alt="{{ $t->nama }}" class="reviewer-avatar">
                            @else
                                <div class="reviewer-avatar-placeholder">{{ strtoupper(substr($t->nama, 0, 1)) }}</div>
                            @endif
                            <div>
                                <div class="reviewer-name">{{ $t->nama }}</div>
                                <div class="reviewer-role">{{ $t->jabatan }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

{{-- ── FOOTER ── --}}
<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <div class="footer-logo">JoinFest</div>
            <p>Platform terdepan untuk eksplorasi event dan pengalaman gaya hidup modern. Temukan akses ke dunia baru hari ini.</p>
        </div>

        <div>
            <div class="footer-col-title">Navigasi</div>
            <div class="footer-col-links">
                <a href="{{ url('/discover') }}" class="footer-col-link">Eksplorasi</a>
                <a href="{{ url('/about') }}" class="footer-col-link">Tentang Kami</a>
                <a href="{{ url('/help') }}" class="footer-col-link">Bantuan</a>
            </div>
        </div>

        <div>
            <div class="footer-col-title">Sosial Media</div>
            <div class="social-icons">
                <a href="#" class="social-icon" title="Share">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/>
                        <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/>
                        <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                    </svg>
                </a>
                <a href="#" class="social-icon" title="Settings">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M19.07 4.93a10 10 0 0 0-14.14 0M4.93 19.07a10 10 0 0 0 14.14 0"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        © {{ date('Y') }} JoinFest Productions. Hak Cipta Dilindungi.
    </div>
</footer>

</body>
</html>