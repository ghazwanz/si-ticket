<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $event['title'] }} - {{ config('app.name', 'JoinFest') }}</title>

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
                --radius-xl: 24px;
            }

            * { box-sizing: border-box; }

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

            .btn-outline {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                height: 38px;
                padding: 0 16px;
                border-radius: 10px;
                border: 1px solid var(--line);
                text-decoration: none;
                font-size: 13px;
                font-weight: 600;
                color: var(--text);
                background: #fff;
            }

            .btn-outline:hover { background: #f4f6ff; }

            .content {
                padding: 22px 24px;
                display: grid;
                grid-template-columns: 1.2fr 0.8fr;
                gap: 16px;
            }

            .hero-image {
                width: 100%;
                border-radius: 14px;
                border: 1px solid var(--line);
                object-fit: cover;
                aspect-ratio: 16 / 9;
            }

            .panel {
                background: var(--card);
                border: 1px solid var(--line);
                border-radius: 14px;
                padding: 18px;
            }

            .chip {
                display: inline-flex;
                padding: 4px 10px;
                border-radius: 999px;
                font-size: 11px;
                color: var(--accent);
                background: rgba(109, 40, 217, 0.1);
                margin-bottom: 10px;
                font-weight: 600;
            }

            h1 {
                margin: 0 0 10px;
                font-size: clamp(24px, 3.3vw, 34px);
                letter-spacing: -0.02em;
            }

            .meta {
                margin: 0 0 12px;
                color: var(--muted);
                font-size: 13px;
                line-height: 1.7;
            }

            .desc {
                margin: 0;
                font-size: 14px;
                line-height: 1.8;
            }

            .buy-box {
                display: grid;
                gap: 12px;
                align-content: start;
            }

            .price {
                font-size: 26px;
                font-weight: 800;
                color: var(--accent);
                margin: 0;
            }

            .buy-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                text-decoration: none;
                height: 44px;
                border-radius: 10px;
                background: linear-gradient(90deg, var(--accent), var(--accent-2));
                color: #fff;
                font-size: 14px;
                font-weight: 700;
            }

            .buy-btn:hover { filter: brightness(0.96); }

            @media (max-width: 980px) {
                .content {
                    grid-template-columns: 1fr;
                    padding: 18px 14px;
                }

                .topbar {
                    padding: 12px 14px;
                    height: auto;
                    flex-wrap: wrap;
                    justify-content: center;
                    gap: 10px;
                }
            }
        </style>
    </head>
    <body>
        <main class="page">
            <header class="topbar">
                <a href="{{ url('/') }}" class="brand">
                    <img src="{{ asset('img/EOLogo.png') }}" alt="JoinFest logo">
                    <span>JoinFest</span>
                </a>
                <a href="{{ route('events.index') }}" class="btn-outline">Kembali ke Katalog</a>
            </header>

            <section class="content">
                <div class="panel">
                    <img class="hero-image" src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}">
                    <div style="margin-top:14px;">
                        <span class="chip">{{ $event['category'] }}</span>
                        <h1>{{ $event['title'] }}</h1>
                        <p class="meta">
                            Lokasi: {{ $event['location'] }}<br>
                            Tanggal: {{ $event['date'] }}
                        </p>
                        <p class="desc">{{ $event['description'] }}</p>
                    </div>
                </div>

                <aside class="panel buy-box">
                    <p style="margin:0;color:var(--muted);font-size:13px;">Harga Mulai</p>
                    <p class="price">{{ $event['price'] }}</p>
                    <a href="{{ route('checkout.index') }}" class="buy-btn">Pesan Tiket</a>
                    <a href="{{ route('events.index') }}" class="btn-outline" style="height:40px;">Lihat Event Lain</a>
                </aside>
            </section>

            @include('partials.footer')
        </main>
    </body>
</html>
