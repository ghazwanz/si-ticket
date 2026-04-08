<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'SI Ticket') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Bangers&display=swap" rel="stylesheet">

        <style>
            :root {
                --page-bg: #d9d9d9;
                --surface: #f4f4f5;
                --text: #23252b;
                --dark: #1f2329;
                --accent: #8b5cf6;
                --accent-strong: #6d28d9;
            }

            * { box-sizing: border-box; }

            html,
            body {
                margin: 0;
                min-height: 100%;
                font-family: "Poppins", sans-serif;
                background: var(--page-bg);
                color: var(--text);
            }

            .page {
                min-height: 100vh;
                padding: 18px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .shell {
                width: min(1200px, 100%);
                min-height: min(760px, calc(100vh - 36px));
                display: grid;
                grid-template-columns: 1fr 1fr;
                background: var(--surface);
                overflow: hidden;
            }

            .left,
            .right {
                padding: clamp(30px, 5vw, 68px);
            }

            .left {
                background:
                    radial-gradient(circle at 20% 15%, rgba(255, 255, 255, 0.8), transparent 34%),
                    radial-gradient(circle at 82% 12%, rgba(255, 255, 255, 0.7), transparent 32%),
                    radial-gradient(circle at 50% 80%, rgba(167, 139, 250, 0.24), transparent 48%),
                    linear-gradient(180deg, #f8f7fb 0%, #f6f0ff 48%, #f0eaff 100%);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .left-stack {
                width: min(100%, 540px);
                display: grid;
                justify-items: center;
                gap: 14px;
                position: relative;
            }

            .jf-year {
                font-weight: 700;
                letter-spacing: 0.2em;
                font-size: 13px;
                color: rgba(76, 29, 149, 0.72);
            }

            .firework-wrap {
                width: 100%;
                display: grid;
                place-items: center;
            }

            .firework-image {
                width: min(76vw, 320px);
                height: auto;
                opacity: 0.92;
                display: block;
            }

            .joinfest-logo {
                width: clamp(210px, 38vw, 460px);
                height: auto;
                display: block;
            }

            .music-row {
                width: 100%;
                display: flex;
                align-items: flex-end;
                justify-content: center;
                gap: 12px;
            }

            .audio-bars {
                display: flex;
                align-items: flex-end;
                gap: 5px;
            }

            .audio-bars span {
                width: 7px;
                border-radius: 8px;
                background: linear-gradient(180deg, #c4b5fd, #8b5cf6);
            }

            .audio-bars span:nth-child(1) { height: 16px; }
            .audio-bars span:nth-child(2) { height: 26px; }
            .audio-bars span:nth-child(3) { height: 14px; }
            .audio-bars span:nth-child(4) { height: 30px; }
            .audio-bars span:nth-child(5) { height: 18px; }

            .speaker {
                width: 38px;
                height: 56px;
                border-radius: 10px;
                background: #2b2f36;
                position: relative;
                box-shadow: 0 8px 18px rgba(0, 0, 0, 0.16);
            }

            .speaker::before,
            .speaker::after {
                content: "";
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                border-radius: 999px;
                background: #b8a3ff;
            }

            .speaker::before {
                top: 9px;
                width: 11px;
                height: 11px;
            }

            .speaker::after {
                bottom: 8px;
                width: 16px;
                height: 16px;
            }

            .mic-svg {
                width: 46px;
                height: 66px;
            }

            .boombox-svg {
                width: min(76vw, 300px);
                height: auto;
                margin-top: -4px;
            }

            .right {
                background: #f7f7f7;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .panel {
                width: min(380px, 100%);
            }

            .title {
                margin: 0 0 14px;
                font-size: clamp(34px, 4vw, 52px);
                line-height: 0.95;
                letter-spacing: -0.03em;
            }

            .subtitle {
                margin: 0 0 24px;
                color: #666a73;
                font-size: 14px;
            }

            .btn {
                width: 100%;
                border: 1px solid transparent;
                border-radius: 4px;
                height: 42px;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                transition: 0.2s ease;
                text-decoration: none;
                margin-bottom: 10px;
            }

            .btn-dark {
                background: var(--accent-strong);
                color: #fff;
            }

            .btn-dark:hover { background: #5b21b6; }

            .btn-light {
                background: #fff;
                border-color: #c8ccd3;
                color: #2d3137;
            }

            .btn-light:hover { background: #f3f4f7; }

            .hint {
                margin-top: 12px;
                text-align: center;
                font-size: 12px;
                color: #666a73;
            }

            .hint a {
                color: var(--accent-strong);
                font-weight: 600;
                text-decoration: underline;
                text-underline-offset: 2px;
            }

            @media (max-width: 980px) {
                .shell { grid-template-columns: 1fr; }
                .left { min-height: 460px; }
                .joinfest-logo { width: clamp(190px, 62vw, 380px); }
            }
        </style>
    </head>
    <body>
        <main class="page">
            <section class="shell" aria-label="Welcome screen">
                <div class="left">
                    <div class="left-stack" aria-hidden="true">
                        <div class="jf-year">2026</div>

                        <div class="firework-wrap">
                            <img class="firework-image" src="{{ asset('img/Mercon01.png') }}" alt="Mercon JoinFest">
                        </div>

                        <img class="joinfest-logo" src="{{ asset('img/JoinFestBubble.png') }}" alt="JoinFest">

                        <div class="music-row">
                            <div class="speaker"></div>
                            <svg class="mic-svg" viewBox="0 0 46 66" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="micBodyW" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0" stop-color="#4c1d95"/>
                                        <stop offset="1" stop-color="#8b5cf6"/>
                                    </linearGradient>
                                </defs>
                                <rect x="18" y="20" width="10" height="34" rx="5" fill="url(#micBodyW)"/>
                                <ellipse cx="23" cy="16" rx="12" ry="12" fill="#43246f"/>
                                <ellipse cx="23" cy="16" rx="8" ry="8" fill="#a78bfa"/>
                                <rect x="10" y="56" width="26" height="4" rx="2" fill="#5b21b6"/>
                            </svg>
                            <div class="speaker"></div>
                        </div>

                        <div class="audio-bars"><span></span><span></span><span></span><span></span><span></span></div>

                        <svg class="boombox-svg" viewBox="0 0 320 120" xmlns="http://www.w3.org/2000/svg">
                            <rect x="12" y="16" width="296" height="94" rx="14" fill="#d946ef" stroke="#222" stroke-width="4"/>
                            <rect x="34" y="0" width="110" height="24" rx="8" fill="#a78bfa" stroke="#222" stroke-width="4"/>
                            <rect x="30" y="34" width="120" height="16" rx="4" fill="#ffe06f" stroke="#222" stroke-width="3"/>
                            <rect x="168" y="34" width="122" height="16" rx="4" fill="#ffe06f" stroke="#222" stroke-width="3"/>
                            <circle cx="72" cy="78" r="26" fill="#3a3f48" stroke="#222" stroke-width="4"/>
                            <circle cx="72" cy="78" r="14" fill="#c4b5fd"/>
                            <circle cx="248" cy="78" r="26" fill="#3a3f48" stroke="#222" stroke-width="4"/>
                            <circle cx="248" cy="78" r="14" fill="#c4b5fd"/>
                            <rect x="142" y="64" width="36" height="20" rx="3" fill="#2a2f37" stroke="#222" stroke-width="3"/>
                        </svg>
                    </div>
                </div>

                <div class="right">
                    <div class="panel">
                        <h2 class="title">Welcome</h2>
                        <p class="subtitle">Sign in to continue to the SI Ticket dashboard.</p>

                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-dark">Login</a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-light">Create account</a>
                        @endif

                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-light">Go to dashboard</a>
                        @endauth

                        @if (Route::has('password.request'))
                            <p class="hint">Forgot password? <a href="{{ route('password.request') }}">Reset here</a></p>
                        @endif
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
