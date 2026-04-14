<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'JoinFest') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <style>
            :root {
                --bg: #ecedf1;
                --panel: #f6f7fb;
                --card: #ffffff;
                --text: #202634;
                --muted: #5f6472;
                --line: #d8dbe4;
                --accent: #6d28d9;
                --accent-2: #8b5cf6;
                --dark: #121722;
                --radius-xl: 24px;
            }

            * {
                box-sizing: border-box;
            }

            html,
            body {
                margin: 0;
                min-height: 100%;
                font-family: "Poppins", sans-serif;
                color: var(--text);
                background: radial-gradient(circle at 4% 4%, #f8f4ff, transparent 35%), var(--bg);
            }

            .page {
                width: min(1240px, calc(100% - 24px));
                margin: 12px auto;
                background: var(--panel);
                border: 1px solid var(--line);
                border-radius: var(--radius-xl);
                overflow: hidden;
                box-shadow: 0 20px 40px rgba(18, 23, 34, 0.08);
            }

            .topbar {
                height: 74px;
                border-bottom: 1px solid var(--line);
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 24px;
                background: rgba(255, 255, 255, 0.75);
                backdrop-filter: blur(8px);
            }

            .brand {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                text-decoration: none;
                color: var(--text);
                font-weight: 700;
                font-size: 20px;
            }

            .brand img {
                width: 34px;
                height: 34px;
                border-radius: 50%;
            }

            .auth-links {
                display: inline-flex;
                align-items: center;
                gap: 10px;
            }

            .btn-link {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                height: 38px;
                padding: 0 16px;
                border-radius: 10px;
                border: 1px solid transparent;
                text-decoration: none;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
                transition: 0.2s ease;
            }

            .btn-outline {
                color: var(--text);
                border-color: var(--line);
                background: #fff;
            }

            .btn-outline:hover {
                background: #f4f6ff;
            }

            .btn-solid {
                color: #fff;
                background: linear-gradient(90deg, var(--accent), var(--accent-2));
                box-shadow: 0 10px 18px rgba(109, 40, 217, 0.22);
            }

            .btn-solid:hover {
                transform: translateY(-1px);
                box-shadow: 0 14px 24px rgba(109, 40, 217, 0.28);
            }

            .hero {
                padding: 20px 24px 0;
            }

            .hero-banner {
                position: relative;
                min-height: 320px;
                border-radius: 18px;
                overflow: hidden;
                display: grid;
                align-items: end;
                isolation: isolate;
            }

            .hero-banner::before {
                content: "";
                position: absolute;
                inset: 0;
                background: linear-gradient(105deg, rgba(10, 12, 22, 0.88) 12%, rgba(10, 12, 22, 0.2) 62%);
                z-index: 1;
            }

            .hero-banner > img {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                transform: scale(1.04);
                transition: transform 0.7s ease;
            }

            .hero-copy {
                position: relative;
                z-index: 2;
                width: min(540px, 100%);
                padding: 28px;
                color: #ffffff;
            }

            .hero-copy h1 {
                margin: 10px 0 8px;
                font-size: clamp(30px, 4vw, 48px);
                line-height: 1.08;
                letter-spacing: -0.02em;
            }

            .hero-copy p {
                margin: 0;
                font-size: 14px;
                color: rgba(255, 255, 255, 0.86);
            }

            .chip {
                display: inline-flex;
                align-items: center;
                padding: 6px 10px;
                border-radius: 999px;
                font-size: 11px;
                font-weight: 600;
                letter-spacing: 0.1em;
                background: rgba(139, 92, 246, 0.28);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .hero-cta {
                display: inline-flex;
                margin-top: 18px;
                text-decoration: none;
                color: #fff;
                background: #6d28d9;
                border-radius: 10px;
                padding: 11px 16px;
                font-size: 13px;
                font-weight: 600;
            }

            .hero-cta:hover {
                background: #5b21b6;
            }

            .section {
                padding: 22px 24px;
            }

            .section-head {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 14px;
            }

            .section-title {
                margin: 0;
                font-size: 22px;
                letter-spacing: -0.02em;
            }

            .section-link {
                font-size: 12px;
                font-weight: 600;
                text-decoration: none;
                color: var(--accent);
            }

            .cards {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 16px;
            }

            .card {
                background: var(--card);
                border: 1px solid var(--line);
                border-radius: 14px;
                overflow: hidden;
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 16px 26px rgba(32, 38, 52, 0.12);
            }

            .card-image {
                width: 100%;
                aspect-ratio: 16 / 9;
                object-fit: cover;
            }

            .card-body {
                padding: 14px;
            }

            .card-title {
                margin: 0;
                font-size: 14px;
            }

            .card-sub {
                margin: 6px 0 12px;
                color: var(--muted);
                font-size: 12px;
            }

            .card-foot {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
            }

            .price {
                font-size: 14px;
                font-weight: 700;
                color: var(--accent);
            }

            .mini-btn {
                border: 1px solid #d1d5e0;
                background: #fff;
                color: #1f2430;
                border-radius: 9px;
                height: 32px;
                padding: 0 12px;
                text-decoration: none;
                font-size: 12px;
                font-weight: 600;
                display: inline-flex;
                align-items: center;
            }

            .mini-btn:hover {
                background: #f1f4ff;
            }

            .merch-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }

            .feature-row {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 12px;
            }

            .feature {
                background: #fff;
                border: 1px solid var(--line);
                border-radius: 12px;
                padding: 14px;
            }

            .feature h4 {
                margin: 0 0 8px;
                font-size: 14px;
            }

            .feature p {
                margin: 0;
                font-size: 12px;
                color: var(--muted);
            }

            .sparkles {
                position: fixed;
                inset: 0;
                pointer-events: none;
                overflow: hidden;
            }

            .spark {
                position: absolute;
                width: 7px;
                height: 7px;
                border-radius: 999px;
                background: radial-gradient(circle, #fff, rgba(255, 255, 255, 0));
                animation: fall 4.8s linear forwards;
                opacity: 0;
            }

            @keyframes fall {
                0% {
                    opacity: 0;
                    transform: translateY(-20px) scale(0.5);
                }
                20% {
                    opacity: 1;
                }
                100% {
                    opacity: 0;
                    transform: translateY(105vh) scale(1.5);
                }
            }

            .reveal {
                opacity: 0;
                transform: translateY(28px);
                transition: 0.6s ease;
            }

            .reveal.show {
                opacity: 1;
                transform: translateY(0);
            }

            @media (max-width: 980px) {
                .cards,
                .feature-row {
                    grid-template-columns: 1fr;
                }

                .merch-grid {
                    grid-template-columns: 1fr;
                }

                .topbar {
                    padding: 0 14px;
                    height: auto;
                    gap: 12px;
                    flex-wrap: wrap;
                    justify-content: center;
                    padding-top: 12px;
                    padding-bottom: 12px;
                }

                .hero,
                .section {
                    padding-left: 14px;
                    padding-right: 14px;
                }

                .hero-copy {
                    padding: 18px;
                }
            }
        </style>
    </head>
    <body>
        <div class="sparkles" id="sparkles"></div>
        <main class="page">
            <header class="topbar">
                <a href="{{ url('/') }}" class="brand">
                    <img src="{{ asset('img/EOLogo.png') }}" alt="JoinFest logo">
                    <span>JoinFest</span>
                </a>

                <div class="auth-links">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-link btn-outline">Dashboard</a>
                    @else
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn-link btn-outline">Login</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-link btn-solid">Register</a>
                        @endif
                    @endauth
                </div>
            </header>

            <section class="hero reveal">
                <article class="hero-banner">
                    <img src="{{ asset('img/EOBanner.png') }}" alt="JoinFest main event">
                    <div class="hero-copy">
                        <span class="chip">WELCOME TO JOINFEST</span>
                        <h1>Temukan Pengalaman Tak Terlupakan</h1>
                        <p>Konser, festival, dan event kreatif favoritmu hadir dalam satu tempat.</p>
                        <a href="{{ route('checkout.index') }}" class="hero-cta">Lihat Event Sekarang</a>
                    </div>
                </article>
            </section>

            <section class="section reveal">
                <div class="section-head">
                    <h2 class="section-title">Acara Populer</h2>
                    <a href="{{ route('checkout.index') }}" class="section-link">Lihat Semua</a>
                </div>

                <div class="cards" id="popularCards">
                    <article class="card">
                        <img class="card-image" src="{{ asset('img/EOBanner.png') }}" alt="JoinFest Night Tour">
                        <div class="card-body">
                            <h3 class="card-title">JoinFest Night's World Tour</h3>
                            <p class="card-sub">Jakarta Convention Center, 26 October 2026</p>
                            <div class="card-foot">
                                <span class="price">Rp 150.000</span>
                                <a href="{{ route('checkout.index') }}" class="mini-btn">Lihat Detail</a>
                            </div>
                        </div>
                    </article>

                    <article class="card">
                        <img class="card-image" src="{{ asset('img/Tiket.png') }}" alt="JoinFest Future Talks">
                        <div class="card-body">
                            <h3 class="card-title">JoinFest Future Talks Summit</h3>
                            <p class="card-sub">Bandung Creative Hub, 10 November 2026</p>
                            <div class="card-foot">
                                <span class="price">Rp 75.000</span>
                                <a href="{{ route('checkout.index') }}" class="mini-btn">Lihat Detail</a>
                            </div>
                        </div>
                    </article>

                    <article class="card">
                        <img class="card-image" src="{{ asset('img/KaosOfficial.png') }}" alt="JoinFest grand opening">
                        <div class="card-body">
                            <h3 class="card-title">The Grand Opening JoinFest Arena</h3>
                            <p class="card-sub">Surabaya Hall, 5 December 2026</p>
                            <div class="card-foot">
                                <span class="price">Rp 425.000</span>
                                <a href="{{ route('checkout.index') }}" class="mini-btn">Lihat Detail</a>
                            </div>
                        </div>
                    </article>
                </div>
            </section>

            <section class="section reveal">
                <div class="section-head">
                    <h2 class="section-title">Merchandise JoinFest</h2>
                </div>

                <div class="merch-grid">
                    <article class="card">
                        <img class="card-image" src="{{ asset('img/KaosOfficial.png') }}" alt="Kaos resmi JoinFest">
                        <div class="card-body">
                            <h3 class="card-title">Official T-Shirt JoinFest</h3>
                            <p class="card-sub">Cotton premium, limited edition 2026.</p>
                            <div class="card-foot">
                                <span class="price">Rp 199.000</span>
                                <a href="{{ route('checkout.index') }}" class="mini-btn">Pesan</a>
                            </div>
                        </div>
                    </article>

                    <article class="card">
                        <img class="card-image" src="{{ asset('img/ToteBag.png') }}" alt="Tote bag resmi JoinFest">
                        <div class="card-body">
                            <h3 class="card-title">JoinFest Official Tote Bag</h3>
                            <p class="card-sub">Ringan, estetik, dan muat semua kebutuhan festivalmu.</p>
                            <div class="card-foot">
                                <span class="price">Rp 129.000</span>
                                <a href="{{ route('checkout.index') }}" class="mini-btn">Pesan</a>
                            </div>
                        </div>
                    </article>
                </div>
            </section>

            <section class="section reveal">
                <div class="section-head">
                    <h2 class="section-title">Kenapa JoinFest?</h2>
                </div>

                <div class="feature-row">
                    <article class="feature">
                        <h4>Tiket Aman dan Cepat</h4>
                        <p>Sistem pembayaran dan penerbitan tiket real-time untuk pengalaman checkout tanpa hambatan.</p>
                    </article>
                    <article class="feature">
                        <h4>Merch Resmi Event</h4>
                        <p>Dapatkan merchandise official langsung dari organizer favoritmu dalam satu transaksi.</p>
                    </article>
                    <article class="feature">
                        <h4>Event Terkurasi</h4>
                        <p>Pilihan konser, workshop, hingga komunitas kreatif yang sudah dikurasi tim JoinFest.</p>
                    </article>
                </div>
            </section>

            @include('partials.footer')
        </main>

        <script>
            const revealItems = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.18 });

            revealItems.forEach((item) => observer.observe(item));

            const heroImage = document.querySelector('.hero-banner > img');
            window.addEventListener('mousemove', (event) => {
                if (!heroImage) {
                    return;
                }

                const x = (event.clientX / window.innerWidth - 0.5) * 1.8;
                const y = (event.clientY / window.innerHeight - 0.5) * 1.2;
                heroImage.style.transform = `scale(1.04) translate(${x}px, ${y}px)`;
            });

            const sparkRoot = document.getElementById('sparkles');
            const createSpark = () => {
                if (!sparkRoot) {
                    return;
                }

                const spark = document.createElement('span');
                spark.className = 'spark';
                spark.style.left = `${Math.random() * 100}%`;
                spark.style.top = `${-8 - Math.random() * 16}px`;
                spark.style.animationDuration = `${4 + Math.random() * 2}s`;
                spark.style.opacity = '0.9';
                sparkRoot.appendChild(spark);

                window.setTimeout(() => {
                    spark.remove();
                }, 6000);
            };

            window.setInterval(createSpark, 260);

            const cards = document.querySelectorAll('#popularCards .card');
            cards.forEach((card) => {
                card.addEventListener('mousemove', (event) => {
                    const rect = card.getBoundingClientRect();
                    const moveX = (event.clientX - rect.left) / rect.width - 0.5;
                    const moveY = (event.clientY - rect.top) / rect.height - 0.5;
                    card.style.transform = `translateY(-5px) rotateX(${moveY * -4}deg) rotateY(${moveX * 5}deg)`;
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = '';
                });
            });
        </script>
    </body>
</html>
