<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'JoinFest') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    </head>
    <body class="min-h-screen bg-[radial-gradient(circle_at_10%_10%,_#f8f4ff,_transparent_28%),_linear-gradient(180deg,_#f8fafc_0%,_#eef2ff_100%)] font-[Plus_Jakarta_Sans,sans-serif] text-slate-900">
        <main class="mx-auto w-full max-w-[1240px] px-3 py-3 md:px-4 md:py-4">
            <div class="overflow-hidden rounded-[26px] border border-slate-200 bg-white/70 shadow-[0_20px_40px_rgba(18,23,34,0.08)] backdrop-blur-sm">
                <header data-site-header data-scrolled="false" class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 bg-white/75 px-4 py-4 backdrop-blur transition-all duration-300 md:h-[74px] md:px-6 data-[scrolled=true]:border-violet-200 data-[scrolled=true]:bg-white/95 data-[scrolled=true]:shadow-[0_12px_30px_rgba(15,23,42,0.08)]">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-lg font-extrabold tracking-tight text-slate-900">
                        <img src="{{ asset('img/EOLogo.png') }}" alt="JoinFest logo" class="h-9 w-9 rounded-full object-cover">
                        <span>{{ config('app.name') }}</span>
                    </a>

                    <div class="hidden min-w-0 flex-1 items-center justify-center px-4 md:flex">
                        <div class="relative w-full max-w-[420px]">
                            <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="m21 21-4.35-4.35"/>
                            </svg>
                            <input type="text" placeholder="Cari event, konser, atau artis..." class="w-full rounded-full border border-slate-200 bg-slate-50 py-2.5 pl-9 pr-4 text-sm outline-none transition focus:border-violet-500 focus:bg-white focus:ring-4 focus:ring-violet-500/10">
                        </div>
                    </div>

                    <div class="flex items-center gap-2 rounded-full border border-slate-200 bg-white/90 p-1 shadow-sm text-sm font-semibold">
                        <a href="#kategori" class="rounded-full px-3 py-2 text-violet-600 transition hover:bg-violet-50 hover:text-violet-700">Beranda</a>
                        <a href="{{ route('events.index') }}" class="rounded-full px-3 py-2 text-slate-600 transition hover:bg-slate-50 hover:text-violet-600">Jelajahi Event</a>
                        <a href="{{ route('login') }}" class="rounded-full px-3 py-2 text-slate-600 transition hover:bg-slate-50 hover:text-violet-600">Masuk</a>
                        <a href="{{ route('register') }}" class="inline-flex h-9 items-center justify-center rounded-full bg-violet-600 px-4 text-white transition hover:bg-violet-700">Daftar</a>
                    </div>
                </header>

                <section class="px-4 pb-6 pt-5 md:px-6" data-reveal data-reveal-delay="0">
                    <div class="overflow-hidden rounded-[24px] border border-slate-200 bg-slate-900 shadow-[0_12px_30px_rgba(15,23,42,0.18)]">
                        <div class="relative isolate min-h-[330px] overflow-hidden lg:min-h-[360px]" data-hero>
                            <img src="{{ asset('img/eobanner.png') }}" alt="JoinFest hero" class="absolute inset-0 h-full w-full object-cover opacity-90 transition-transform duration-300 will-change-transform" data-parallax="0.07">
                            <div class="absolute inset-0 bg-[linear-gradient(95deg,rgba(4,6,15,0.92)_0%,rgba(4,6,15,0.5)_42%,rgba(4,6,15,0.18)_72%,rgba(4,6,15,0.28)_100%)]"></div>
                            <div class="absolute inset-0 bg-[radial-gradient(circle_at_78%_50%,rgba(255,255,255,0.12),transparent_22%)]" data-parallax="0.03"></div>

                            <div class="relative z-10 flex min-h-[330px] items-end p-5 md:p-8 lg:min-h-[360px] lg:p-10">
                                <div class="max-w-xl text-white">
                                    <div class="inline-flex rounded-full border border-violet-400/30 bg-violet-500/15 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-violet-200 opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="60">{{ config('app.name') }} Platform</div>
                                    <h1 class="mt-4 max-w-lg text-4xl font-extrabold leading-[0.95] tracking-tight sm:text-5xl lg:text-6xl opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="140">Temukan Pengalaman Tak Terlupakan</h1>
                                    <p class="mt-4 max-w-md text-sm leading-7 text-white/78 sm:text-base opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="220">Dapatkan akses mudah ke tiket konser, festival, dan merchandise resmi dengan alur pemesanan yang cepat dan jelas.</p>
                                    <div class="mt-6 flex flex-wrap items-center gap-3 opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="300">
                                        <a href="{{ route('events.index') }}" class="inline-flex h-12 items-center justify-center rounded-2xl bg-violet-600 px-5 text-sm font-semibold text-white shadow-[0_16px_28px_rgba(109,40,217,0.32)] transition hover:-translate-y-0.5 hover:bg-violet-700">Beli Tiket Sekarang</a>
                                        <div class="flex items-center gap-2 text-sm text-white/70">
                                            <span class="h-2 w-2 rounded-full bg-white/70"></span>
                                            <span>Temukan event terpopuler minggu ini</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="kategori" class="px-4 py-4 md:px-6" data-reveal data-reveal-delay="80">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="h-6 w-1 rounded-full bg-violet-600"></span>
                        <h2 class="text-lg font-semibold tracking-tight text-slate-900">Kategori Event</h2>
                    </div>

                    <div class="grid gap-3 grid-cols-[repeat(6,minmax(0,1fr))] max-[1100px]:grid-cols-3 max-[640px]:grid-cols-2">
                        @php
                            $categories = [
                                ['name' => 'Konser', 'image' => 'img/eobanner.png'],
                                ['name' => 'Seminar', 'image' => 'img/EOLogo.png'],
                                ['name' => 'Olahraga', 'image' => 'img/Tiket.png'],
                                ['name' => 'Teater', 'image' => 'img/KaosOfficial.png'],
                                ['name' => 'Seni', 'image' => 'img/ToteBag.png'],
                                ['name' => 'Film', 'image' => 'img/JoinFestBubble.png'],
                            ];
                        @endphp

                        @foreach ($categories as $category)
                            <article class="group relative overflow-hidden rounded-[18px] border border-slate-200 bg-slate-900 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-[0_16px_24px_rgba(15,23,42,0.15)] opacity-0 blur-sm translate-y-6 scale-[0.98] transition-all duration-700 ease-out" data-reveal data-reveal-delay="{{ $loop->index * 80 + 120 }}">
                                <img src="{{ asset($category['image']) }}" alt="{{ $category['name'] }}" class="h-36 w-full object-cover opacity-80 transition duration-300 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                                <div class="absolute inset-x-0 bottom-0 p-3">
                                    <p class="text-sm font-semibold text-white">{{ $category['name'] }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <section class="px-4 py-6 md:px-6" data-reveal data-reveal-delay="100">
                    <div class="mb-4 flex items-end justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-semibold tracking-tight text-slate-900">Acara Populer</h2>
                            <p class="text-sm text-slate-500">Event yang sedang ramai dilihat minggu ini.</p>
                        </div>
                        <a href="{{ route('events.index') }}" class="text-xs font-semibold text-violet-600 transition hover:text-violet-700">Lihat Semua</a>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                        @php
                            $popularEvents = [
                                ['title' => 'Neon Nights World Tour', 'location' => 'Sleman City Hall', 'date' => '4 Desember 2026', 'price' => 'Rp 150.000', 'image' => 'img/eobanner.png', 'tag' => 'Populer'],
                                ['title' => 'Future Tech Summit 2026', 'location' => 'Bandung Convention Center', 'date' => '10 November 2026', 'price' => 'Rp 750.000', 'image' => 'img/Tiket.png', 'tag' => 'Tech'],
                                ['title' => 'The Grand Open Harnet', 'location' => 'JoinFest Arena', 'date' => '26 Oktober 2026', 'price' => 'Rp 425.000', 'image' => 'img/KaosOfficial.png', 'tag' => 'Live'],
                            ];
                        @endphp

                        @foreach ($popularEvents as $event)
                            <article class="overflow-hidden rounded-[20px] border border-slate-200 bg-white shadow-[0_8px_24px_rgba(15,23,42,0.08)] transition hover:-translate-y-1 hover:shadow-[0_16px_30px_rgba(15,23,42,0.12)] opacity-0 blur-sm translate-y-6 scale-[0.98] transition-all duration-700 ease-out" data-reveal data-reveal-delay="{{ $loop->index * 100 + 140 }}">
                                <div class="relative">
                                    <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}" class="h-52 w-full object-cover">
                                    <div class="absolute left-3 top-3 inline-flex rounded-full bg-white/90 px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.12em] text-slate-700">{{ $event['tag'] }}</div>
                                </div>
                                <div class="p-4">
                                    <h3 class="text-sm font-semibold text-slate-900">{{ $event['title'] }}</h3>
                                    <div class="mt-2 space-y-1 text-xs text-slate-500">
                                        <div class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-violet-600"></span>{{ $event['date'] }}</div>
                                        <div class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-slate-300"></span>{{ $event['location'] }}</div>
                                    </div>
                                    <div class="mt-4 flex items-center justify-between gap-3">
                                        <span class="text-sm font-semibold text-violet-600">{{ $event['price'] }}</span>
                                        <a href="{{ route('checkout.index') }}" class="inline-flex h-8 items-center rounded-lg border border-violet-200 bg-violet-50 px-3 text-xs font-semibold text-violet-600 transition hover:border-violet-600 hover:bg-violet-600 hover:text-white">Lihat Detail</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <section class="px-4 py-8 md:px-6" data-reveal data-reveal-delay="120">
                    <div class="mb-8 text-center">
                        <h2 class="text-xl font-semibold tracking-tight text-slate-900">Fitur Unggulan</h2>
                        <p class="mx-auto mt-2 max-w-xl text-sm text-slate-500">Dirancang untuk membantu pengguna menemukan event dan bertransaksi lebih nyaman setiap hari.</p>
                    </div>

                    <div class="grid gap-4 lg:grid-cols-[1.15fr_1fr]">
                        <article class="rounded-[24px] bg-gradient-to-br from-violet-600 to-violet-500 p-6 text-white shadow-[0_20px_40px_rgba(109,40,217,0.25)] opacity-0 blur-sm translate-y-6 scale-[0.98] transition-all duration-700 ease-out" data-reveal data-reveal-delay="160">
                            <div class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-white/15">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3"/><path d="M12 22a10 10 0 1 0-10-10"/><path d="M12 12l7-7"/></svg>
                            </div>
                            <h3 class="mt-6 text-2xl font-semibold tracking-tight">Solusi Tiket Masa Depan</h3>
                            <p class="mt-3 max-w-md text-sm leading-7 text-white/78">Platform modern yang memudahkan tiap langkah: temukan event, pilih kategori, dan pesan tiket dalam satu alur yang ringkas.</p>
                            <div class="mt-8 flex items-center gap-2 text-xs text-white/70">
                                <span class="h-2.5 w-2.5 rounded-full bg-white/70"></span>
                                <span>Terhubung dengan organizer terpercaya</span>
                            </div>
                        </article>

                        <div class="grid gap-4 sm:grid-cols-2">
                            @php
                                $features = [
                                    ['title' => 'Pemesanan Instan', 'desc' => 'Alur checkout yang singkat dan jelas untuk semua event.'],
                                    ['title' => 'E-Tiket Aman', 'desc' => 'QR dan tiket digital tersimpan rapi di akun pengguna.'],
                                    ['title' => 'Pembayaran Aman', 'desc' => 'Dukungan pembayaran yang aman dan mudah dipantau.'],
                                    ['title' => 'Dukungan 24/7', 'desc' => 'Bantuan cepat untuk pertanyaan, refund, dan pesanan.'],
                                ];
                            @endphp

                            @foreach ($features as $feature)
                                <article class="rounded-[20px] border border-slate-200 bg-white p-5 shadow-[0_8px_24px_rgba(15,23,42,0.06)] opacity-0 blur-sm translate-y-6 scale-[0.98] transition-all duration-700 ease-out" data-reveal data-reveal-delay="{{ $loop->index * 90 + 220 }}">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-violet-50 text-violet-600">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3"/></svg>
                                    </div>
                                    <h3 class="mt-4 text-sm font-semibold text-slate-900">{{ $feature['title'] }}</h3>
                                    <p class="mt-2 text-sm leading-6 text-slate-500">{{ $feature['desc'] }}</p>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section class="px-4 py-8 md:px-6" data-reveal data-reveal-delay="140">
                    <div class="mb-8 text-center">
                        <h2 class="text-xl font-semibold tracking-tight text-slate-900">Pertanyaan Umum</h2>
                        <p class="mx-auto mt-2 max-w-xl text-sm text-slate-500">Informasi dasar yang paling sering ditanyakan pengguna JoinFest.</p>
                    </div>

                    <div class="mx-auto max-w-3xl space-y-3">
                        @php
                            $faqs = [
                                ['question' => 'Bagaimana cara mendapatkan e-tiket setelah pembayaran?', 'answer' => 'E-tiket akan muncul di akun pengguna setelah pembayaran berhasil dan bisa diakses dari halaman pesanan.'],
                                ['question' => 'Apakah saya bisa mengubah data pemesanan?', 'answer' => 'Data dasar pemesanan bisa dicek ulang sebelum pembayaran. Setelah pembayaran, perubahan mengikuti kebijakan event.'],
                                ['question' => 'Metode pembayaran apa saja yang tersedia?', 'answer' => 'Metode pembayaran mengikuti ketersediaan gateway pada checkout dan dapat diperluas sesuai kebutuhan event.'],
                                ['question' => 'Bagaimana jika saya kehilangan akses tiket?', 'answer' => 'Silakan masuk ke akun dan buka detail pesanan untuk melihat ulang e-tiket atau hubungi dukungan.'],
                            ];
                        @endphp

                        @foreach ($faqs as $index => $faq)
                            <details class="group rounded-2xl border border-slate-200 bg-white p-4 shadow-sm opacity-0 blur-sm translate-y-6 scale-[0.98] transition-all duration-700 ease-out" data-reveal data-reveal-delay="{{ $loop->index * 90 + 160 }}">
                                <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-sm font-semibold text-slate-900">
                                    <span>{{ $faq['question'] }}</span>
                                    <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-violet-50 text-violet-600 transition group-open:rotate-45">+</span>
                                </summary>
                                <p class="mt-3 text-sm leading-7 text-slate-500">{{ $faq['answer'] }}</p>
                            </details>
                        @endforeach
                    </div>
                </section>

                <footer class="border-t border-slate-200 bg-white px-4 py-8 md:px-6" data-reveal data-reveal-delay="160">
                    <div class="grid gap-8 md:grid-cols-[1.2fr_0.7fr_0.7fr_1fr]">
                        <div class="space-y-4">
                            <div class="inline-flex items-center gap-3 text-lg font-extrabold tracking-tight text-violet-600">
                                <img src="{{ asset('img/EOLogo.png') }}" alt="JoinFest logo" class="h-9 w-9 rounded-full object-cover">
                                <span>{{ config('app.name') }}</span>
                            </div>
                            <p class="max-w-xs text-sm leading-7 text-slate-500">Platform tiket, festival, dan merchandise resmi untuk pengalaman event yang cepat, aman, dan mudah diakses.</p>
                            <div class="flex gap-3 text-slate-400">
                                <a href="#" class="transition hover:text-violet-600" aria-label="Instagram"><svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg></a>
                                <a href="#" class="transition hover:text-violet-600" aria-label="Facebook"><svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3.5l.5-4H14V7a1 1 0 0 1 1-1h3z"/></svg></a>
                                <a href="#" class="transition hover:text-violet-600" aria-label="X"><svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4l16 16M20 4L4 20"/></svg></a>
                            </div>
                        </div>

                        <div>
                            <h3 class="mb-3 text-sm font-semibold text-slate-900">Perusahaan</h3>
                            <div class="grid gap-2 text-sm text-slate-500">
                                <a href="#" class="transition hover:text-violet-600">Tentang Kami</a>
                                <a href="#" class="transition hover:text-violet-600">Misi Kami</a>
                                <a href="#" class="transition hover:text-violet-600">Media & Press</a>
                            </div>
                        </div>

                        <div>
                            <h3 class="mb-3 text-sm font-semibold text-slate-900">Dukungan</h3>
                            <div class="grid gap-2 text-sm text-slate-500">
                                <a href="#" class="transition hover:text-violet-600">Pusat Bantuan</a>
                                <a href="#" class="transition hover:text-violet-600">Bantuan Pemesanan</a>
                                <a href="#" class="transition hover:text-violet-600">Syarat & Ketentuan</a>
                            </div>
                        </div>

                        <div>
                            <h3 class="mb-3 text-sm font-semibold text-slate-900">Newsletter</h3>
                            <p class="mb-3 text-sm leading-7 text-slate-500">Berlangganan untuk info event terbaru, promo tiket, dan merchandise.</p>
                            <form class="grid gap-2" action="#" method="get">
                                <input type="email" name="email" placeholder="Alamat email kamu" class="h-11 rounded-xl border border-slate-300 bg-white px-3 text-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10">
                                <button type="submit" class="inline-flex h-11 items-center justify-center rounded-xl bg-violet-600 px-4 text-sm font-semibold text-white transition hover:bg-violet-700">Langganan</button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-8 border-t border-slate-200 pt-4 text-center text-xs text-slate-400">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</div>
                </footer>
            </div>
        </main>
    </body>
</html>
