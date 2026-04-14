<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Katalog Event - {{ config('app.name', 'JoinFest') }}</title>

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

            .actions {
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

            .btn-outline:hover { background: #f4f6ff; }

            .section {
                padding: 22px 24px;
            }

            .headline {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                margin-bottom: 16px;
            }

            .headline h1 {
                margin: 0;
                font-size: clamp(24px, 3.2vw, 34px);
                letter-spacing: -0.02em;
            }

            .headline p {
                margin: 0;
                color: var(--muted);
                font-size: 13px;
            }

            .grid {
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

            .card img {
                width: 100%;
                aspect-ratio: 16 / 9;
                object-fit: cover;
            }

            .card-body {
                padding: 14px;
            }

            .chip {
                display: inline-flex;
                padding: 4px 10px;
                border-radius: 999px;
                font-size: 11px;
                color: var(--accent);
                background: rgba(109, 40, 217, 0.1);
                margin-bottom: 8px;
                font-weight: 600;
            }

            .title {
                margin: 0;
                font-size: 15px;
            }

            .meta {
                margin: 8px 0 12px;
                font-size: 12px;
                color: var(--muted);
                line-height: 1.6;
            }

            .foot {
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

            .detail-btn {
                border: 1px solid var(--line);
                background: #fff;
                color: var(--text);
                border-radius: 9px;
                height: 32px;
                padding: 0 12px;
                text-decoration: none;
                font-size: 12px;
                font-weight: 600;
                display: inline-flex;
                align-items: center;
            }

            .detail-btn:hover { background: #f1f4ff; }

            @media (max-width: 980px) {
                .grid { grid-template-columns: 1fr; }
                .section { padding: 18px 14px; }
                .topbar {
                    padding: 12px 14px;
                    height: auto;
                    flex-wrap: wrap;
                    justify-content: center;
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

                <div class="actions">
                    <a href="{{ url('/') }}" class="btn-link btn-outline">Kembali ke Landing</a>
                </div>
            </header>

            <section class="section">
                <div class="headline">
                    <div>
                        <h1>Katalog Event</h1>
                        <p>Pilih event favoritmu lalu lihat detail lengkapnya.</p>
                    </div>
                </div>

                <div class="grid">
                    @foreach ($events as $event)
                        <article class="card">
                            <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}">
                            <div class="card-body">
                                <span class="chip">{{ $event['category'] }}</span>
                                <h2 class="title">{{ $event['title'] }}</h2>
                                <p class="meta">
                                    {{ $event['location'] }}<br>
                                    {{ $event['date'] }}
                                </p>
                                <div class="foot">
                                    <span class="price">{{ $event['price'] }}</span>
                                    <a href="{{ route('events.show', $event['slug']) }}" class="detail-btn">Lihat Detail</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            @include('partials.footer')
        </main>
    </body>
</html>
