<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $event['title'] }} - {{ config('app.name', 'JoinFest') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    </head>
    <body class="min-h-screen bg-[radial-gradient(circle_at_8%_4%,_#f8f4ff,_transparent_28%),_linear-gradient(180deg,_#f8fafc_0%,_#eef2ff_100%)] font-[Plus_Jakarta_Sans,sans-serif] text-slate-900">
        @php
            $ticketPrice = (int) preg_replace('/[^0-9]/', '', $event['price']);
            $serviceFee = 25000;
            $taxRate = 0.11;

            $merchandise = [
                [
                    'name' => config('app.name') . ' Official Tee',
                    'price' => 'Rp 250.000',
                    'image' => 'img/KaosOfficial.png',
                    'cta' => 'Tambah ke Pesanan',
                ],
                [
                    'name' => config('app.name') . ' Hoodie',
                    'price' => 'Rp 450.000',
                    'image' => 'img/ToteBag.png',
                    'cta' => 'Tambah ke Pesanan',
                ],
                [
                    'name' => 'Festival Tote Bag',
                    'price' => 'Rp 90.000',
                    'image' => 'img/Tiket.png',
                    'cta' => 'Tambah ke Pesanan',
                ],
            ];

            $rules = [
                'Tiket hanya berlaku untuk tanggal dan sesi yang tertera pada pesanan.',
                'Pembeli wajib menunjukkan e-tiket dan identitas yang sesuai saat masuk area acara.',
                'Dilarang membawa barang berbahaya, minuman keras, dan benda terlarang lainnya.',
                'Organizer berhak menolak masuk jika ketentuan event tidak dipatuhi.',
            ];

            $faqShort = [
                ['q' => 'Bagaimana saya menerima e-tiket?', 'a' => 'E-tiket akan tersedia di akun setelah pembayaran berhasil.'],
                ['q' => 'Apakah merchandise bisa dibeli terpisah?', 'a' => 'Bisa, merchandise dapat ditambahkan ke pesanan tiket sebelum checkout.'],
            ];
        @endphp

        <main class="mx-auto w-full max-w-[1240px] px-3 py-3 md:px-4 md:py-4">
            <div class="overflow-hidden rounded-[26px] border border-slate-200 bg-white/80 shadow-[0_20px_40px_rgba(18,23,34,0.08)] backdrop-blur-sm">
                <header data-site-header data-scrolled="false" class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 bg-white/80 px-4 py-4 backdrop-blur transition-all duration-300 md:h-[74px] md:px-6 data-[scrolled=true]:border-violet-200 data-[scrolled=true]:bg-white/95 data-[scrolled=true]:shadow-[0_12px_30px_rgba(15,23,42,0.08)]">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-lg font-extrabold tracking-tight text-slate-900">
                        <img src="{{ asset('img/EOLogo.png') }}" alt="{{ config('app.name') }} logo" class="h-9 w-9 rounded-full object-cover">
                        <span>{{ config('app.name') }}</span>
                    </a>

                    <div class="hidden min-w-0 flex-1 items-center justify-center px-4 md:flex">
                        <div class="relative w-full max-w-[420px]">
                            <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="m21 21-4.35-4.35"/>
                            </svg>
                            <input type="text" value="{{ $event['title'] }}" class="w-full rounded-full border border-slate-200 bg-slate-50 py-2.5 pl-9 pr-4 text-sm outline-none transition focus:border-violet-500 focus:bg-white focus:ring-4 focus:ring-violet-500/10" readonly>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-sm font-semibold">
                        <a href="{{ route('events.index') }}" class="text-slate-600 transition hover:text-violet-600">Katalog</a>
                        <a href="{{ route('checkout.index') }}" class="inline-flex h-9 items-center justify-center rounded-lg bg-violet-600 px-3.5 text-white transition hover:bg-violet-700">Pesan Sekarang</a>
                    </div>
                </header>

                <section class="px-4 pb-6 pt-5 md:px-6" data-reveal data-reveal-delay="0">
                    <div class="overflow-hidden rounded-[24px] border border-slate-200 bg-slate-900 shadow-[0_16px_34px_rgba(15,23,42,0.18)]">
                        <div class="relative isolate min-h-[360px] overflow-hidden lg:min-h-[420px]" data-hero>
                            <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}" class="absolute inset-0 h-full w-full object-cover opacity-90 transition-transform duration-300 will-change-transform" data-parallax="0.07">
                            <div class="absolute inset-0 bg-[linear-gradient(95deg,rgba(4,6,15,0.94)_0%,rgba(4,6,15,0.62)_42%,rgba(4,6,15,0.22)_72%,rgba(4,6,15,0.28)_100%)]"></div>
                            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_48%,rgba(255,255,255,0.12),transparent_22%)]" data-parallax="0.03"></div>

                            <div class="relative z-10 flex min-h-[360px] flex-col justify-end p-5 md:p-8 lg:min-h-[420px] lg:p-10">
                                <div class="max-w-3xl text-white">
                                    <div class="flex flex-wrap items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-white/70">
                                        <span class="inline-flex rounded-full border border-violet-400/30 bg-violet-500/15 px-3 py-1 text-violet-200 opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="60">{{ $event['category'] }}</span>
                                        <span class="inline-flex rounded-full border border-white/15 bg-white/10 px-3 py-1 opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="120">{{ $event['location'] }}</span>
                                    </div>
                                    <h1 class="mt-4 max-w-2xl text-4xl font-extrabold leading-[0.94] tracking-tight sm:text-5xl lg:text-6xl opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="180">{{ $event['title'] }}</h1>
                                    <p class="mt-4 max-w-2xl text-sm leading-7 text-white/78 sm:text-base opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="240">{{ $event['description'] }}</p>

                                    <div class="mt-6 flex flex-wrap items-center gap-3 opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="300">
                                        <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 backdrop-blur">
                                            <p class="text-[11px] uppercase tracking-[0.18em] text-white/55">Tanggal</p>
                                            <p class="mt-1 text-sm font-semibold text-white">{{ $event['date'] }}</p>
                                        </div>
                                        <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 backdrop-blur">
                                            <p class="text-[11px] uppercase tracking-[0.18em] text-white/55">Harga Mulai</p>
                                            <p class="mt-1 text-sm font-semibold text-white">{{ $event['price'] }}</p>
                                        </div>
                                        <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 backdrop-blur">
                                            <p class="text-[11px] uppercase tracking-[0.18em] text-white/55">Lokasi</p>
                                            <p class="mt-1 text-sm font-semibold text-white">{{ $event['location'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="grid gap-6 px-4 pb-8 md:px-6 lg:grid-cols-[minmax(0,1fr)_340px]">
                    <div class="space-y-6">
                        <section class="grid gap-4 rounded-[22px] border border-slate-200 bg-white p-5 shadow-[0_10px_24px_rgba(15,23,42,0.05)]" data-reveal data-reveal-delay="120">
                            <div class="flex items-center gap-3">
                                <span class="h-6 w-1 rounded-full bg-violet-600"></span>
                                <h2 class="text-lg font-semibold tracking-tight text-slate-900">Tentang Event</h2>
                            </div>

                            <p class="max-w-3xl text-sm leading-7 text-slate-600">
                                {{ $event['description'] }} Event ini dirancang untuk menghadirkan pengalaman yang tertata, visual yang kuat, dan alur masuk yang jelas untuk setiap pengunjung.
                            </p>

                            <div class="grid gap-3 sm:grid-cols-3">
                                <div class="rounded-2xl bg-violet-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-violet-600">Tanggal</p>
                                    <p class="mt-2 text-sm font-semibold text-slate-900">{{ $event['date'] }}</p>
                                </div>
                                <div class="rounded-2xl bg-violet-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-violet-600">Lokasi</p>
                                    <p class="mt-2 text-sm font-semibold text-slate-900">{{ $event['location'] }}</p>
                                </div>
                                <div class="rounded-2xl bg-violet-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-violet-600">Kategori</p>
                                    <p class="mt-2 text-sm font-semibold text-slate-900">{{ $event['category'] }}</p>
                                </div>
                            </div>
                        </section>

                        <section class="space-y-4" data-reveal data-reveal-delay="180">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <h2 class="text-lg font-semibold tracking-tight text-slate-900">Merchandise Resmi</h2>
                                    <p class="text-sm text-slate-500">Lengkapi pengalaman event dengan koleksi resmi.</p>
                                </div>
                            </div>

                            <div class="grid gap-4 md:grid-cols-3">
                                @foreach ($merchandise as $item)
                                    <article class="overflow-hidden rounded-[20px] border border-slate-200 bg-white shadow-[0_10px_24px_rgba(15,23,42,0.05)] transition hover:-translate-y-1 hover:shadow-[0_16px_30px_rgba(15,23,42,0.10)]" data-reveal data-reveal-delay="{{ $loop->index * 80 + 120 }}">
                                        <div class="relative">
                                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="h-52 w-full object-cover">
                                            <div class="absolute left-3 top-3 rounded-full bg-white/90 px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.14em] text-slate-700">Official</div>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="text-sm font-semibold text-slate-900">{{ $item['name'] }}</h3>
                                            <p class="mt-1 text-sm font-semibold text-violet-600">{{ $item['price'] }}</p>
                                            <a href="{{ route('checkout.index') }}" class="mt-4 inline-flex h-9 w-full items-center justify-center rounded-xl border border-violet-200 bg-violet-50 text-sm font-semibold text-violet-600 transition hover:border-violet-600 hover:bg-violet-600 hover:text-white">{{ $item['cta'] }}</a>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>

                        <section class="space-y-4" data-reveal data-reveal-delay="240">
                            <div class="flex items-center gap-3">
                                <span class="h-6 w-1 rounded-full bg-violet-600"></span>
                                <h2 class="text-lg font-semibold tracking-tight text-slate-900">Syarat & Ketentuan</h2>
                            </div>

                            <div class="grid gap-3">
                                @foreach ($rules as $rule)
                                    <div class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-[0_8px_22px_rgba(15,23,42,0.04)]">
                                        <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-violet-50 text-violet-600">•</span>
                                        <p class="text-sm leading-7 text-slate-600">{{ $rule }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </section>

                        <section class="space-y-4" data-reveal data-reveal-delay="300">
                            <div class="flex items-center gap-3">
                                <span class="h-6 w-1 rounded-full bg-violet-600"></span>
                                <h2 class="text-lg font-semibold tracking-tight text-slate-900">Peta Lokasi</h2>
                            </div>

                            <div class="overflow-hidden rounded-[22px] border border-slate-200 bg-slate-200 shadow-[0_10px_24px_rgba(15,23,42,0.05)]">
                                <div class="relative min-h-[260px] bg-[linear-gradient(135deg,#d8dee9_0%,#bfc9d6_46%,#a9b7c8_100%)]">
                                    <div class="absolute inset-0 opacity-35 [background-image:radial-gradient(circle_at_1px_1px,rgba(255,255,255,0.65)_1px,transparent_0)] [background-size:22px_22px]"></div>
                                    <div class="absolute inset-x-0 top-1/2 h-px bg-white/20"></div>
                                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rounded-[22px] border border-white/70 bg-white/95 px-5 py-4 text-center shadow-[0_14px_26px_rgba(15,23,42,0.14)]">
                                        <p class="text-sm font-semibold text-slate-900">{{ $event['location'] }}</p>
                                        <p class="mt-1 text-xs text-slate-500">{{ $event['date'] }}</p>
                                        <a href="#" class="mt-3 inline-flex text-xs font-semibold text-violet-600">Buka di Maps</a>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="space-y-4" data-reveal data-reveal-delay="340">
                            <div class="flex items-center gap-3">
                                <span class="h-6 w-1 rounded-full bg-violet-600"></span>
                                <h2 class="text-lg font-semibold tracking-tight text-slate-900">Pertanyaan Singkat</h2>
                            </div>

                            <div class="grid gap-3 md:grid-cols-2">
                                @foreach ($faqShort as $faq)
                                    <article class="rounded-2xl border border-slate-200 bg-white p-4 shadow-[0_8px_22px_rgba(15,23,42,0.04)]">
                                        <h3 class="text-sm font-semibold text-slate-900">{{ $faq['q'] }}</h3>
                                        <p class="mt-2 text-sm leading-7 text-slate-500">{{ $faq['a'] }}</p>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    </div>

                    <aside class="lg:sticky lg:top-4" data-reveal data-reveal-delay="180">
                        <div
                            x-data="{
                                qty: 1,
                                ticketType: 'standard',
                                price: {{ $ticketPrice }},
                                serviceFee: {{ $serviceFee }},
                                taxRate: {{ $taxRate }},
                                format(value) {
                                    return new Intl.NumberFormat('id-ID').format(value)
                                },
                                get multiplier() {
                                    return this.ticketType === 'vip' ? 1.35 : 1
                                },
                                get subtotal() {
                                    return Math.round(this.price * this.qty * this.multiplier)
                                },
                                get tax() {
                                    return Math.round((this.subtotal + this.serviceFee) * this.taxRate)
                                },
                                get total() {
                                    return this.subtotal + this.serviceFee + this.tax
                                },
                            }"
                            class="rounded-[24px] border border-slate-200 bg-white p-5 shadow-[0_14px_32px_rgba(15,23,42,0.08)]"
                        >
                            <div class="mb-4">
                                <p class="text-sm font-semibold text-slate-900">Pesan Tiket</p>
                                <p class="mt-1 text-xs text-slate-500">Pilih kategori tiket dan jumlah pesanan.</p>
                            </div>

                            <div class="space-y-4">
                                <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">
                                    Jenis Tiket
                                    <select x-model="ticketType" class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm outline-none transition focus:border-violet-500 focus:bg-white focus:ring-4 focus:ring-violet-500/10">
                                        <option value="standard">Standard - {{ $event['price'] }}</option>
                                        <option value="vip">VIP Access - {{ $event['price'] }}</option>
                                    </select>
                                </label>

                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">Jumlah Tiket</p>
                                    <div class="mt-2 flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 p-2">
                                        <button type="button" @click="qty = Math.max(1, qty - 1)" class="flex h-10 w-10 items-center justify-center rounded-lg bg-white text-lg font-semibold text-slate-700 transition hover:bg-violet-50 hover:text-violet-700">−</button>
                                        <span class="text-sm font-semibold text-slate-900" x-text="qty"></span>
                                        <button type="button" @click="qty = qty + 1" class="flex h-10 w-10 items-center justify-center rounded-lg bg-white text-lg font-semibold text-slate-700 transition hover:bg-violet-50 hover:text-violet-700">+</button>
                                    </div>
                                </div>

                                <div class="space-y-2 rounded-2xl bg-slate-50 p-4 text-sm text-slate-600">
                                    <div class="flex items-center justify-between gap-4">
                                        <span>Subtotal Tiket</span>
                                        <span class="font-semibold text-slate-900" x-text="'Rp ' + format(subtotal)"></span>
                                    </div>
                                    <div class="flex items-center justify-between gap-4">
                                        <span>Biaya Layanan</span>
                                        <span class="font-semibold text-slate-900">Rp {{ number_format($serviceFee, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex items-center justify-between gap-4">
                                        <span>Pajak</span>
                                        <span class="font-semibold text-slate-900" x-text="'Rp ' + format(tax)"></span>
                                    </div>
                                    <div class="border-t border-slate-200 pt-2 flex items-center justify-between gap-4">
                                        <span class="font-semibold text-slate-900">Total Bayar</span>
                                        <span class="text-lg font-extrabold tracking-tight text-violet-600" x-text="'Rp ' + format(total)"></span>
                                    </div>
                                </div>

                                <a href="{{ route('checkout.index') }}" class="inline-flex h-12 w-full items-center justify-center rounded-2xl bg-violet-600 px-4 text-sm font-semibold text-white shadow-[0_16px_28px_rgba(109,40,217,0.28)] transition hover:-translate-y-0.5 hover:bg-violet-700">Beli Tiket Sekarang</a>

                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-xs leading-6 text-slate-500">
                                    Pembelian tiket dan merchandise akan diproses pada halaman checkout dengan ringkasan pesanan yang jelas.
                                </div>
                            </div>
                        </div>
                    </aside>
                </section>

                <footer class="border-t border-slate-200 bg-white px-4 py-8 md:px-6" data-reveal data-reveal-delay="380">
                    <div class="grid gap-8 md:grid-cols-[1.2fr_0.7fr_0.7fr_1fr]">
                        <div class="space-y-4">
                            <div class="inline-flex items-center gap-3 text-lg font-extrabold tracking-tight text-violet-600">
                                <img src="{{ asset('img/EOLogo.png') }}" alt="{{ config('app.name') }} logo" class="h-9 w-9 rounded-full object-cover">
                                <span>{{ config('app.name') }}</span>
                            </div>
                            <p class="max-w-xs text-sm leading-7 text-slate-500">Platform tiket, festival, dan merchandise resmi untuk pengalaman event yang cepat, aman, dan mudah diakses.</p>
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
