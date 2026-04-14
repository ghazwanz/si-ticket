<footer class="site-footer" aria-label="JoinFest footer">
    <style>
        .site-footer {
            margin: 10px 24px 24px;
            padding: 24px;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(10px);
        }

        .site-footer-grid {
            display: grid;
            grid-template-columns: 1.3fr 0.8fr 0.8fr 1fr;
            gap: 20px;
        }

        .site-footer-brand {
            display: grid;
            gap: 12px;
            align-content: start;
        }

        .site-footer-logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--text);
            text-decoration: none;
            font-size: 18px;
            font-weight: 800;
        }

        .site-footer-logo img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
        }

        .site-footer p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .site-footer-col h3 {
            margin: 0 0 12px;
            font-size: 14px;
            letter-spacing: -0.01em;
        }

        .site-footer-links {
            display: grid;
            gap: 10px;
        }

        .site-footer-links a {
            color: var(--muted);
            text-decoration: none;
            font-size: 13px;
        }

        .site-footer-links a:hover {
            color: var(--accent);
        }

        .site-footer-newsletter {
            display: grid;
            gap: 10px;
        }

        .site-footer-newsletter input {
            width: 100%;
            height: 42px;
            border-radius: 10px;
            border: 1px solid var(--line);
            padding: 0 12px;
            font: inherit;
            outline: none;
        }

        .site-footer-newsletter input:focus {
            border-color: var(--accent-2);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
        }

        .site-footer-newsletter button {
            height: 42px;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--accent), var(--accent-2));
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }

        .site-footer-bottom {
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            color: var(--muted);
            font-size: 12px;
        }

        @media (max-width: 980px) {
            .site-footer {
                margin-left: 14px;
                margin-right: 14px;
                padding: 18px;
            }

            .site-footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .site-footer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="site-footer-grid">
        <div class="site-footer-brand">
            <a href="{{ url('/') }}" class="site-footer-logo">
                <img src="{{ asset('img/EOLogo.png') }}" alt="JoinFest logo">
                <span>JoinFest</span>
            </a>
            <p>
                Platform tiket, festival, dan merchandise resmi untuk pengalaman event yang cepat, aman, dan mudah diakses.
            </p>
        </div>

        <div class="site-footer-col">
            <h3>Menu</h3>
            <div class="site-footer-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ route('checkout.index') }}">Event</a>
                <a href="{{ route('pesanan.index') }}">Pesanan</a>
            </div>
        </div>

        <div class="site-footer-col">
            <h3>Bantuan</h3>
            <div class="site-footer-links">
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
                <a href="{{ route('checkout.index') }}">Checkout</a>
            </div>
        </div>

        <div class="site-footer-col">
            <h3>Newsletter</h3>
            <p>Dapatkan info event dan promo terbaru JoinFest langsung ke inbox kamu.</p>
            <form class="site-footer-newsletter" action="#" method="get">
                <input type="email" name="email" placeholder="Alamat email kamu">
                <button type="submit">Langganan</button>
            </form>
        </div>
    </div>

    <div class="site-footer-bottom">
        <span>© {{ date('Y') }} JoinFest. All rights reserved.</span>
        <span>Built for concerts, festivals, and creator events.</span>
    </div>
</footer>
