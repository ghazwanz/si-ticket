<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'JoinFest') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        <style>
            :root {
                --bg: #eceef5;
                --card: #ffffff;
                --text: #202634;
                --muted: #636a7a;
                --line: #d7dbe6;
                --accent: #6d28d9;
                --accent-2: #8b5cf6;
            }

            * { box-sizing: border-box; }

            html,
            body {
                margin: 0;
                min-height: 100%;
                font-family: "Poppins", sans-serif;
                background: radial-gradient(circle at 10% 8%, #f7f2ff, transparent 30%), var(--bg);
                color: var(--text);
            }

            .page {
                min-height: 100vh;
                display: grid;
                place-items: center;
                padding: 20px;
            }

            .auth-card {
                width: min(620px, 100%);
                background: var(--card);
                border: 1px solid var(--line);
                border-radius: 20px;
                padding: clamp(24px, 4.5vw, 42px);
                box-shadow: 0 20px 36px rgba(20, 25, 38, 0.1);
                transform-style: preserve-3d;
                transition: transform 0.22s ease;
            }

            .auth-brand {
                margin: 0;
                font-size: 14px;
                letter-spacing: 0.2em;
                color: var(--accent);
                font-weight: 700;
                text-transform: uppercase;
            }

            .auth-title {
                margin: 10px 0 6px;
                font-size: clamp(30px, 5vw, 44px);
                line-height: 1;
                letter-spacing: -0.03em;
            }

            .auth-subtitle {
                margin: 0 0 22px;
                color: var(--muted);
                font-size: 14px;
            }

            .auth-status,
            .auth-errors {
                border: 1px solid var(--line);
                border-radius: 10px;
                padding: 10px 12px;
                margin-bottom: 12px;
                background: #fff;
                font-size: 12px;
            }

            .auth-status { color: #216244; }
            .auth-errors { color: #b42318; }

            .auth-field { margin-bottom: 14px; }

            .auth-field label {
                display: block;
                margin-bottom: 6px;
                font-size: 12px;
                font-weight: 600;
                color: #2f3238;
            }

            .auth-field input[type="text"],
            .auth-field input[type="email"],
            .auth-field input[type="password"] {
                width: 100%;
                height: 44px;
                border: 1px solid #bbc2d1;
                border-radius: 10px;
                padding: 0 12px;
                font-size: 14px;
                outline: none;
                background: #fff;
            }

            .auth-field input:focus {
                border-color: var(--accent-2);
                box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
            }

            .auth-action-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 8px;
                margin: 4px 0 16px;
                font-size: 12px;
                color: #5b5f67;
            }

            .btn {
                width: 100%;
                border: 1px solid transparent;
                border-radius: 12px;
                height: 46px;
                font-size: 14px;
                font-weight: 700;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
                text-decoration: none;
            }

            .btn-dark {
                background: linear-gradient(90deg, var(--accent), var(--accent-2));
                color: #fff;
                box-shadow: 0 12px 20px rgba(109, 40, 217, 0.25);
            }

            .btn-dark:hover {
                transform: translateY(-1px);
                box-shadow: 0 16px 24px rgba(109, 40, 217, 0.3);
            }

            .btn-light {
                margin-top: 8px;
                border-color: #c8ccd3;
                background: #fff;
                color: #2d3137;
            }

            .btn-light:hover { background: #f3f4f7; }

            .inline-link {
                color: var(--accent);
                font-weight: 600;
                text-decoration: underline;
                text-underline-offset: 2px;
                font-size: 12px;
            }

            .tiny-note {
                display: block;
                text-align: center;
                margin-top: 12px;
                font-size: 12px;
                color: var(--muted);
            }

            @media (max-width: 640px) {
                .page { padding: 16px; }
                .auth-card {
                    padding: 20px;
                    border-radius: 18px;
                }
            }
        </style>
    </head>
    <body>
        <main class="page">
            <section class="auth-card" id="authCard" aria-label="JoinFest authentication">
                {{ $slot }}
            </section>
        </main>

        <script>
            const authCard = document.getElementById('authCard');
            window.addEventListener('mousemove', (event) => {
                if (!authCard || window.innerWidth < 860) {
                    return;
                }

                const x = (event.clientX / window.innerWidth - 0.5) * 6;
                const y = (event.clientY / window.innerHeight - 0.5) * -6;
                authCard.style.transform = `rotateY(${x}deg) rotateX(${y}deg)`;
            });

            window.addEventListener('mouseleave', () => {
                if (!authCard) {
                    return;
                }

                authCard.style.transform = 'rotateY(0deg) rotateX(0deg)';
            });
        </script>
    </body>
</html>
