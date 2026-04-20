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
    <body class="min-h-screen bg-[radial-gradient(circle_at_10%_10%,_#f8f4ff,_transparent_30%),_linear-gradient(180deg,_#f8fafc_0%,_#eef2ff_100%)] font-[Plus_Jakarta_Sans,sans-serif] text-slate-900">
        <x-home.header />

        <main class=" px-4 py-6 md:px-6 md:py-10">
            <div class="max-w-7xl w-full mx-auto lg:space-y-40 sm:space-y-32 space-y-16">
                <section class="overflow-hidden rounded-[26px] border border-slate-200 bg-slate-900 shadow-[0_20px_40px_rgba(18,23,34,0.14)]" data-reveal data-reveal-delay="0">
                    <div class="relative isolate min-h-[500px] overflow-hidden" data-hero>
                        <img src="{{ asset('img/eobanner.png') }}" alt="JoinFest hero" class="absolute inset-0 h-full w-full object-cover opacity-90 transition-transform duration-300 will-change-transform" data-parallax="0.07">
                        <div class="absolute inset-0 bg-[linear-gradient(95deg,rgba(4,6,15,0.9)_0%,rgba(4,6,15,0.45)_48%,rgba(4,6,15,0.2)_100%)]"></div>
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_75%_35%,rgba(167,139,250,0.25),transparent_25%)]" data-parallax="0.03"></div>

                        <div class="relative z-10 flex min-h-[380px] items-end p-6 sm:p-8 lg:p-12">
                            <div class="max-w-2xl text-white">
                                <div class="inline-flex rounded-full border border-violet-300/40 bg-violet-500/20 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-violet-100 opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="80">{{ config('app.name') }} Platform</div>
                                <h1 class="mt-4 text-3xl font-extrabold leading-tight tracking-tight sm:text-5xl lg:text-6xl opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="140">Homepage Profesional, Modern, dan Minimalis untuk Event Experience</h1>
                                <p class="mt-4 max-w-xl text-sm leading-7 text-white/80 sm:text-base opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="220">Temukan konser, festival, hingga seminar premium dalam satu tempat dengan alur pemesanan yang cepat, rapi, dan nyaman di semua perangkat.</p>
                                <div class="mt-6 flex flex-wrap items-center gap-3 opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="300">
                                    <a href="{{ route('events.index') }}" class="inline-flex h-12 items-center justify-center rounded-2xl bg-violet-600 px-5 text-sm font-semibold text-white shadow-[0_16px_28px_rgba(109,40,217,0.32)] transition hover:-translate-y-0.5 hover:bg-violet-700">Jelajahi Event</a>
                                    <a href="{{ route('register') }}" class="inline-flex h-12 items-center justify-center rounded-2xl border border-white/30 bg-white/10 px-5 text-sm font-semibold text-white transition hover:bg-white/20">Buat Akun</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="kategori" data-reveal data-reveal-delay="90" class="lg:space-y-16 space-y-8">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="h-6 w-1 rounded-full bg-violet-600"></span>
                        <h2 class="lg:text-4xl text-2xl font-semibold tracking-tight text-slate-900">Kategori Event</h2>
                    </div>

                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">
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
                            <article class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-slate-900 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-[0_16px_24px_rgba(15,23,42,0.15)] opacity-0 blur-sm translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="{{ $loop->index * 70 + 120 }}">
                                <a href="{{ route('events.index') }}">
                                    <img src="{{ asset($category['image']) }}" alt="{{ $category['name'] }}" class="h-52 w-full object-cover opacity-80 transition duration-300 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                                    <div class="absolute inset-x-0 bottom-0 p-3">
                                        <p class="text-sm font-semibold text-white">{{ $category['name'] }}</p>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </section>

                <section data-reveal data-reveal-delay="110" class="lg:space-y-16 space-y-8">
                    <div class="mb-5 flex items-end justify-between gap-4">
                        <div>
                            <h2 class="lg:text-4xl text-2xl font-semibold tracking-tight text-slate-900">Acara Populer</h2>
                            <p class="text-sm text-slate-500">Pilihan event yang paling diminati minggu ini.</p>
                        </div>
                        <a href="{{ route('events.index') }}" class="text-sm font-semibold text-violet-600 transition hover:text-violet-700">Lihat Semua</a>
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
                            <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_8px_24px_rgba(15,23,42,0.08)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_16px_30px_rgba(15,23,42,0.12)] opacity-0 blur-sm translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="{{ $loop->index * 90 + 130 }}">
                            <a href="{{ route('events.show', 'joinfest-nights-world-tour') }}">
                            <div class="relative">
                                    <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}" class="h-52 w-full object-cover">
                                    <div class="absolute left-3 top-3 inline-flex rounded-full bg-white/90 px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.12em] text-slate-700">{{ $event['tag'] }}</div>
                                </div>
                                <div class="p-4">
                                    <h3 class="text-sm font-semibold text-slate-900">{{ $event['title'] }}</h3>
                                    <div class="mt-2 grid gap-1 text-xs text-slate-500">
                                        <div class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-violet-600"></span>{{ $event['date'] }}</div>
                                        <div class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-slate-300"></span>{{ $event['location'] }}</div>
                                    </div>
                                    <div class="mt-4 flex items-center justify-between gap-3">
                                        <span class="text-sm font-semibold text-violet-600">{{ $event['price'] }}</span>
                                    </div>
                                </div>
                            </a>
                            </article>
                        @endforeach
                    </div>
                </section>

                <section class="lg:space-y-16 space-y-8 rounded-[24px] border border-slate-200 bg-white p-5 shadow-[0_10px_30px_rgba(15,23,42,0.06)] lg:p-8" data-reveal data-reveal-delay="130">
                    <div class="space-y-4 text-center">
                        <h2 class="lg:text-4xl text-2xl font-semibold tracking-tight text-slate-900">Fitur yang Membuatmu Nyaman</h2>
                        <p class="text-sm text-slate-500">Fitur yang membuatmu nyaman dalam bertransaksi event: proses cepat, informasi jelas, dan dukungan pengguna yang responsif.</p>
                    </div>
                    <div class="grid gap-4 lg:grid-cols-[1.1fr_1fr]">
                        <article class="rounded-2xl bg-gradient-to-br min-h-[50vh] from-violet-600 to-violet-500 p-6 text-white shadow-[0_20px_40px_rgba(109,40,217,0.25)] opacity-0 blur-sm translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="170">
                            <h3 class="text-2xl font-semibold tracking-tight">Pengalaman Tiket Tanpa Ribet</h3>
                            <p class="mt-3 max-w-md text-sm leading-7 text-white/80">Semua fitur penting untuk transaksi event modern: proses cepat, informasi jelas, dan dukungan pengguna yang responsif.</p>
                            <div class="mt-6 grid gap-2 text-sm text-white/80">
                                <p class="inline-flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-white/80"></span>E-tiket langsung tersedia setelah pembayaran</p>
                                <p class="inline-flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-white/80"></span>Status pesanan real-time dan mudah dipantau</p>
                            </div>
                        </article>

                        <div class="grid gap-3 sm:grid-cols-2">
                            @php
                                $features = [
                                    ['title' => 'Pemesanan Instan', 'desc' => 'Checkout singkat dengan alur yang jelas.'],
                                    ['title' => 'E-Tiket Aman', 'desc' => 'Tiket digital tersimpan rapi di akun.'],
                                    ['title' => 'Pembayaran Aman', 'desc' => 'Metode pembayaran modern dan tepercaya.'],
                                    ['title' => 'Dukungan 24/7', 'desc' => 'Tim support siap membantu kapan saja.'],
                                ];
                            @endphp

                            @foreach ($features as $feature)
                                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-4 opacity-0 blur-sm translate-y-6 scale-[0.98] transition-all duration-700 ease-out" data-reveal data-reveal-delay="{{ $loop->index * 80 + 230 }}">
                                    <div class="h-2 w-10 rounded-full bg-violet-500"></div>
                                    <h3 class="mt-3 text-sm font-semibold text-slate-900">{{ $feature['title'] }}</h3>
                                    <p class="mt-1 text-sm leading-6 text-slate-500">{{ $feature['desc'] }}</p>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section data-reveal data-reveal-delay="150" class="lg:space-y-16 space-y-8">
                        <div class="mb-6 text-center space-y-4">
                            <h2 class="lg:text-4xl text-2xl font-semibold tracking-tight text-slate-900">Pertanyaan Umum</h2>
                            <p class="mx-auto max-w-xl text-sm text-slate-500">Informasi cepat seputar pemesanan tiket di {{ config('app.name') }}.</p>
                        </div>

                        <div class="mx-auto grid max-w-5xl gap-3">
                            @php
                                $faqs = [
                                    ['question' => 'Bagaimana cara mendapatkan e-tiket setelah pembayaran?', 'answer' => 'E-tiket akan muncul otomatis di akun pengguna setelah pembayaran berhasil diverifikasi.'],
                                    ['question' => 'Apakah saya bisa mengubah data pemesanan?', 'answer' => 'Perubahan data mengikuti kebijakan event dan dapat dilakukan sebelum pembayaran final.'],
                                    ['question' => 'Metode pembayaran apa saja yang tersedia?', 'answer' => 'Metode pembayaran menyesuaikan gateway aktif di halaman checkout.'],
                                    ['question' => 'Bagaimana jika saya kehilangan akses tiket?', 'answer' => 'Silakan login kembali untuk mengakses tiket di halaman pesanan atau hubungi dukungan.'],
                                ];
                            @endphp

                            @foreach ($faqs as $faq)
                                <details class="group rounded-2xl border border-slate-200 bg-slate-50 p-4 opacity-0 blur-sm translate-y-6 scale-[0.98] transition-all duration-700 ease-out" data-reveal data-reveal-delay="{{ $loop->index * 80 + 180 }}">
                                    <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-sm font-semibold text-slate-900">
                                        <span>{{ $faq['question'] }}</span>
                                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-violet-100 text-violet-600 transition group-open:rotate-45">+</span>
                                    </summary>
                                    <p class="mt-3 text-sm leading-7 text-slate-500">{{ $faq['answer'] }}</p>
                                </details>
                            @endforeach
                        </div>
                </section>
            </div>
        </main>

        <x-home.footer />
    </body>
</html>
