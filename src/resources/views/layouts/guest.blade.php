<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SI Ticket') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Bangers&display=swap" rel="stylesheet">

        <style>
            :root {
                --page-bg: #d9d9d9;
                --surface: #f4f4f5;
                --text: #23252b;
                --line: #ced2da;
                --input-line: #aeb3bc;
                --dark: #1f2329;
                --jf-blue: #78a8f3;
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
                    radial-gradient(circle at 50% 80%, rgba(157, 186, 255, 0.2), transparent 48%),
                    linear-gradient(180deg, #f8f7fb 0%, #f6f4fd 48%, #ecf4ff 100%);
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
                color: rgba(27, 31, 41, 0.72);
            }

            .firework-wrap {
                width: 100%;
                display: grid;
                place-items: center;
            }

            .firework-svg {
                width: min(76vw, 320px);
                height: auto;
                opacity: 0.92;
            }

            .joinfest-word {
                font-family: "Bangers", cursive;
                font-size: clamp(66px, 11vw, 122px);
                line-height: 0.88;
                letter-spacing: 0.02em;
                color: var(--jf-blue);
                transform: skew(-7deg);
                text-shadow:
                    -6px 0 0 #fff,
                    6px 0 0 #1d2230,
                    0 6px 0 rgba(0, 0, 0, 0.18);
                position: relative;
            }

            .joinfest-word::before {
                content: "JoinFest";
                position: absolute;
                inset: 0;
                color: transparent;
                -webkit-text-stroke: 5px #1d2230;
                z-index: -1;
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
                background: linear-gradient(180deg, #9ec1ff, #7caaf5);
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
                background: #8aa0c4;
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

            .auth-card {
                width: min(380px, 100%);
            }

            .auth-title {
                margin: 0 0 20px;
                font-size: clamp(36px, 4vw, 54px);
                line-height: 0.95;
                letter-spacing: -0.03em;
            }

            .auth-status,
            .auth-errors {
                border: 1px solid var(--line);
                background: #fff;
                border-radius: 10px;
                padding: 10px 12px;
                margin-bottom: 12px;
                font-size: 12px;
            }

            .auth-status { color: #1f5f3a; }
            .auth-errors { color: #b42318; }

            .auth-field { margin-bottom: 12px; }

            .auth-field label {
                display: block;
                font-size: 12px;
                margin-bottom: 5px;
                color: #2f3238;
            }

            .auth-field input[type="text"],
            .auth-field input[type="email"],
            .auth-field input[type="password"] {
                width: 100%;
                height: 40px;
                border: 1px solid var(--input-line);
                border-radius: 3px;
                padding: 0 12px;
                font-size: 14px;
                outline: none;
                background: #fff;
            }

            .auth-field input:focus {
                border-color: #5f6672;
                box-shadow: 0 0 0 2px rgba(95, 102, 114, 0.15);
            }

            .auth-action-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 8px;
                margin-top: 10px;
                margin-bottom: 8px;
                font-size: 12px;
                color: #5b5f67;
            }

            .btn {
                width: 100%;
                border: 1px solid transparent;
                border-radius: 4px;
                height: 38px;
                font-size: 13px;
                font-weight: 500;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                transition: 0.2s ease;
                text-decoration: none;
            }

            .btn-dark {
                background: var(--dark);
                color: #fff;
            }

            .btn-dark:hover { background: #13161b; }

            .btn-light {
                margin-top: 8px;
                border-color: #c8ccd3;
                background: #fff;
                color: #2d3137;
            }

            .btn-light:hover { background: #f3f4f7; }

            .inline-link {
                color: #2d3137;
                font-weight: 600;
                text-decoration: underline;
                text-underline-offset: 2px;
                font-size: 12px;
            }

            .tiny-note {
                display: block;
                text-align: center;
                margin-top: 12px;
                font-size: 11px;
                color: #686d76;
            }

            @media (max-width: 980px) {
                .shell { grid-template-columns: 1fr; }
                .left { min-height: 460px; }
                .joinfest-word { font-size: clamp(58px, 18vw, 108px); }
            }
        </style>
    </head>
    <body>
        <main class="page">
            <section class="shell" aria-label="Authentication layout">
                <div class="left">
                    <div class="left-stack" aria-hidden="true">
                        <div class="jf-year">2026</div>

                        <div class="firework-wrap">
                            <svg class="firework-svg" viewBox="0 0 300 180" xmlns="http://www.w3.org/2000/svg">
                                <g fill="none" stroke-linecap="round">
                                    <path d="M150 140 C130 90 90 60 58 36" stroke="#87bce8" stroke-width="6"/>
                                    <path d="M150 140 C138 88 122 55 110 24" stroke="#f5c24d" stroke-width="6"/>
                                    <path d="M150 140 C153 88 160 56 172 20" stroke="#87bce8" stroke-width="7"/>
                                    <path d="M150 140 C168 92 196 60 232 32" stroke="#f5c24d" stroke-width="7"/>
                                    <path d="M150 140 C182 104 228 92 270 86" stroke="#87bce8" stroke-width="6"/>
                                    <path d="M150 140 C112 108 68 96 30 98" stroke="#f5c24d" stroke-width="6"/>
                                </g>
                                <g fill="#f5c24d">
                                    <circle cx="58" cy="36" r="4"/>
                                    <circle cx="110" cy="24" r="4"/>
                                    <circle cx="232" cy="32" r="4"/>
                                    <circle cx="270" cy="86" r="4"/>
                                    <circle cx="30" cy="98" r="4"/>
                                </g>
                                <g fill="#87bce8">
                                    <polygon points="172,20 176,29 186,29 178,35 181,45 172,39 163,45 166,35 158,29 168,29"/>
                                    <polygon points="58,36 62,43 70,43 64,48 66,56 58,51 50,56 52,48 46,43 54,43"/>
                                    <polygon points="232,32 236,39 244,39 238,44 240,52 232,47 224,52 226,44 220,39 228,39"/>
                                </g>
                            </svg>
                        </div>

                        <div class="joinfest-word">JoinFest</div>

                        <div class="music-row">
                            <div class="speaker"></div>
                            <svg class="mic-svg" viewBox="0 0 46 66" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="micBody" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0" stop-color="#2c3037"/>
                                        <stop offset="1" stop-color="#5b6372"/>
                                    </linearGradient>
                                </defs>
                                <rect x="18" y="20" width="10" height="34" rx="5" fill="url(#micBody)"/>
                                <ellipse cx="23" cy="16" rx="12" ry="12" fill="#333842"/>
                                <ellipse cx="23" cy="16" rx="8" ry="8" fill="#596171"/>
                                <rect x="10" y="56" width="26" height="4" rx="2" fill="#3a3f48"/>
                            </svg>
                            <div class="speaker"></div>
                        </div>

                        <div class="audio-bars"><span></span><span></span><span></span><span></span><span></span></div>

                        <svg class="boombox-svg" viewBox="0 0 320 120" xmlns="http://www.w3.org/2000/svg">
                            <rect x="12" y="16" width="296" height="94" rx="14" fill="#ff4fa0" stroke="#222" stroke-width="4"/>
                            <rect x="34" y="0" width="110" height="24" rx="8" fill="#66b4ff" stroke="#222" stroke-width="4"/>
                            <rect x="30" y="34" width="120" height="16" rx="4" fill="#ffe06f" stroke="#222" stroke-width="3"/>
                            <rect x="168" y="34" width="122" height="16" rx="4" fill="#ffe06f" stroke="#222" stroke-width="3"/>
                            <circle cx="72" cy="78" r="26" fill="#3a3f48" stroke="#222" stroke-width="4"/>
                            <circle cx="72" cy="78" r="14" fill="#7fb4ff"/>
                            <circle cx="248" cy="78" r="26" fill="#3a3f48" stroke="#222" stroke-width="4"/>
                            <circle cx="248" cy="78" r="14" fill="#7fb4ff"/>
                            <rect x="142" y="64" width="36" height="20" rx="3" fill="#2a2f37" stroke="#222" stroke-width="3"/>
                        </svg>
                    </div>
                </div>

                <div class="right">
                    <div class="auth-card">
                        {{ $slot }}
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
