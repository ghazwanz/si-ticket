<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Login - JoinFest</title>

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

            * {
                box-sizing: border-box;
            }

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

            .logo {
                margin: 0;
                font-size: 14px;
                letter-spacing: 0.2em;
                color: var(--accent);
                font-weight: 700;
            }

            h1 {
                margin: 10px 0 6px;
                font-size: clamp(30px, 5vw, 44px);
                letter-spacing: -0.03em;
                line-height: 1;
            }

            .subtitle {
                margin: 0 0 22px;
                color: var(--muted);
                font-size: 14px;
            }

            .auth-status,
            .auth-errors {
                border: 1px solid var(--line);
                border-radius: 10px;
                padding: 10px 12px;
                font-size: 12px;
                margin-bottom: 12px;
                background: #fff;
            }

            .auth-status {
                color: #216244;
            }

            .auth-errors {
                color: #b42318;
            }

            .field {
                margin-bottom: 14px;
            }

            .field label {
                display: block;
                margin-bottom: 6px;
                font-size: 12px;
                font-weight: 600;
            }

            .field input[type="email"],
            .field input[type="password"] {
                width: 100%;
                height: 44px;
                border-radius: 10px;
                border: 1px solid #bbc2d1;
                outline: none;
                padding: 0 12px;
                font-size: 14px;
            }

            .field input:focus {
                border-color: var(--accent-2);
                box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
            }

            .row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
                margin: 4px 0 16px;
                font-size: 12px;
            }

            .row a {
                color: var(--accent);
                font-weight: 600;
                text-decoration: none;
            }

            .submit-btn {
                width: 100%;
                height: 46px;
                border: 0;
                border-radius: 12px;
                cursor: pointer;
                background: linear-gradient(90deg, var(--accent), var(--accent-2));
                color: #fff;
                font-size: 14px;
                font-weight: 700;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                box-shadow: 0 12px 20px rgba(109, 40, 217, 0.25);
            }

            .submit-btn:hover {
                transform: translateY(-1px);
                box-shadow: 0 16px 24px rgba(109, 40, 217, 0.3);
            }

            .tiny-note {
                margin-top: 14px;
                text-align: center;
                font-size: 12px;
                color: var(--muted);
            }

            .tiny-note a {
                color: var(--accent);
                font-weight: 600;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <main class="page">
            <section class="auth-card" id="authCard" aria-label="Login JoinFest">
                <p class="logo">JoinFest</p>
                <h1>Login</h1>
                <p class="subtitle">Masuk untuk melanjutkan ke akun JoinFest kamu.</p>

                @if (session('status'))
                    <div class="auth-status">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="auth-errors">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password">
                    </div>

                    <div class="row">
                        <label>
                            <input id="remember_me" type="checkbox" name="remember">
                            Ingat saya
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Lupa password?</a>
                        @endif
                    </div>

                    <button type="submit" class="submit-btn">Masuk ke JoinFest</button>
                </form>

                @if (Route::has('register'))
                    <div class="tiny-note">
                        Belum punya akun?
                        <a href="{{ route('register') }}">Daftar sekarang</a>
                    </div>
                @endif
            </section>
        </main>

        <script>
            const authCard = document.getElementById('authCard');
            window.addEventListener('mousemove', (event) => {
                if (!authCard || window.innerWidth < 860) {
                    return;
                }

                const x = (event.clientX / window.innerWidth - 0.5) * 8;
                const y = (event.clientY / window.innerHeight - 0.5) * -8;
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
