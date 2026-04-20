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

        <x-home.header />

        <main class="px-4 py-8 md:px-6 lg:py-12">
            <div class="grid gap-8 mx-auto w-full max-w-7xl lg:grid-cols-[1fr_360px] xl:gap-12">

                <!-- Kiri: Info Event & Hero -->
                <div class="space-y-8">
                    <!-- Image Banner -->
                    <section class="opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98]" data-reveal data-reveal-delay="0">
                        <div class="relative overflow-hidden rounded-[24px] bg-slate-900 shadow-[0_16px_34px_rgba(15,23,42,0.12)]">
                            <div class="relative isolate h-[320px] w-full md:h-[400px]">
                                <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}" class="absolute inset-0 h-full w-full object-cover opacity-80" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent"></div>

                                <div class="absolute inset-x-0 bottom-0 p-6 md:p-8">
                                    <div class="flex flex-wrap items-center gap-2 text-[11px] font-bold uppercase tracking-[0.15em] text-white/80">
                                        <span class="inline-flex rounded-md border border-white/20 bg-white/10 px-2.5 py-1 backdrop-blur-sm">{{ $event['category'] }}</span>
                                    </div>
                                    <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-white md:text-4xl lg:text-5xl">{{ $event['title'] }}</h1>
                                </div>
                            </div>
                        </div>
                    </section>

                        <section class="opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98] grid gap-4 rounded-[22px] border border-slate-200 bg-white p-5 shadow-[0_10px_24px_rgba(15,23,42,0.05)]" data-reveal data-reveal-delay="100">
                            <div class="flex items-center gap-3">
                                <span class="h-6 w-1 rounded-full bg-violet-600"></span>
                                <h2 class="text-lg font-semibold tracking-tight text-slate-900">Tentang Event</h2>
                            </div>

                            <p class="max-w-3xl text-sm leading-7 text-slate-600">
                                {{ $event['description'] }} Event ini dirancang untuk menghadirkan pengalaman yang tertata, visual yang kuat, dan alur masuk yang jelas untuk setiap pengunjung.
                            </p>

                            <div class="grid gap-3 sm:grid-cols-3">
                                <div class="rounded-2xl bg-violet-50/50 p-4 border border-violet-100/50">
                                    <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-violet-600">Tanggal</p>
                                    <p class="mt-2 text-sm font-semibold text-slate-900">{{ $event['date'] }}</p>
                                </div>
                                <div class="rounded-2xl bg-violet-50/50 p-4 border border-violet-100/50">
                                    <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-violet-600">Lokasi</p>
                                    <p class="mt-2 text-sm font-semibold text-slate-900">{{ $event['location'] }}</p>
                                </div>
                                <div class="rounded-2xl bg-violet-50/50 p-4 border border-violet-100/50">
                                    <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-violet-600">Kategori</p>
                                    <p class="mt-2 text-sm font-semibold text-slate-900">{{ $event['category'] }}</p>
                                </div>
                            </div>
                        </section>

                        <section class="opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98] space-y-4" data-reveal data-reveal-delay="150">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <h2 class="text-lg font-semibold tracking-tight text-slate-900">Merchandise Resmi</h2>
                                    <p class="text-sm text-slate-500">Lengkapi pengalaman event dengan koleksi resmi.</p>
                                </div>
                            </div>

                            <div class="grid gap-4 md:grid-cols-3">
                                @foreach ($merchandise as $item)
                                    <article class="opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98] overflow-hidden rounded-[20px] border border-slate-200 bg-white shadow-[0_10px_24px_rgba(15,23,42,0.05)] hover:-translate-y-1 hover:shadow-[0_16px_30px_rgba(15,23,42,0.10)]" data-reveal data-reveal-delay="{{ $loop->index * 80 + 150 }}">
                                        <div class="relative">
                                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="h-48 w-full object-cover">
                                            <div class="absolute left-3 top-3 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-700 shadow-sm backdrop-blur-sm">Official</div>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="text-sm font-semibold text-slate-900">{{ $item['name'] }}</h3>
                                            <p class="mt-1 text-sm font-bold text-violet-600">{{ $item['price'] }}</p>
                                            <button type="button" class="mt-4 inline-flex h-9 w-full items-center justify-center rounded-xl border border-violet-200 bg-violet-50 text-sm font-semibold text-violet-600 transition hover:border-violet-600 hover:bg-violet-600 hover:text-white">{{ $item['cta'] }}</button>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>

                        <section class="opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98] space-y-4" data-reveal data-reveal-delay="200">
                            <div class="flex items-center gap-3">
                                <span class="h-6 w-1 rounded-full bg-violet-600"></span>
                                <h2 class="text-lg font-semibold tracking-tight text-slate-900">Syarat & Ketentuan</h2>
                            </div>

                            <div class="grid gap-3">
                                @foreach ($rules as $rule)
                                    <div class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-[0_8px_22px_rgba(15,23,42,0.04)]">
                                        <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-violet-600/10 text-violet-600 font-bold">•</span>
                                        <p class="text-sm leading-6 text-slate-600">{{ $rule }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </section>

                        <section class="opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98] space-y-4" data-reveal data-reveal-delay="250">
                            <div class="flex items-center gap-3">
                                <span class="h-6 w-1 rounded-full bg-violet-600"></span>
                                <h2 class="text-lg font-semibold tracking-tight text-slate-900">Peta Lokasi</h2>
                            </div>

                            <div class="overflow-hidden rounded-[22px] border border-slate-200 bg-slate-200 shadow-[0_10px_24px_rgba(15,23,42,0.05)]">
                                <div class="relative min-h-[240px] bg-[linear-gradient(135deg,#e2e8f0_0%,#cbd5e1_100%)]">
                                    <div class="absolute inset-0 opacity-40 [background-image:radial-gradient(circle_at_1px_1px,white_1px,transparent_0)] [background-size:20px_20px]"></div>
                                    <div class="absolute inset-x-0 top-1/2 h-px bg-white/40"></div>
                                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rounded-[20px] border border-white/60 bg-white/95 px-5 py-4 text-center shadow-[0_14px_26px_rgba(15,23,42,0.12)] backdrop-blur-md">
                                        <p class="text-sm font-bold text-slate-900">{{ $event['location'] }}</p>
                                        <p class="mt-1 text-xs text-slate-500">{{ $event['date'] }}</p>
                                        <a href="#" class="mt-3 inline-flex text-[13px] font-bold text-violet-600 hover:text-violet-700 transition">Buka di Maps &rarr;</a>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98] space-y-4" data-reveal data-reveal-delay="300">
                            <div class="flex items-center gap-3">
                                <span class="h-6 w-1 rounded-full bg-violet-600"></span>
                                <h2 class="text-lg font-semibold tracking-tight text-slate-900">Pertanyaan Singkat</h2>
                            </div>

                            <div class="grid gap-3 md:grid-cols-2">
                                @foreach ($faqShort as $faq)
                                    <article class="rounded-[20px] border border-slate-200 bg-white p-4 shadow-[0_8px_20px_rgba(15,23,42,0.03)] hover:shadow-md transition">
                                        <h3 class="text-[13px] font-bold text-slate-900">{{ $faq['q'] }}</h3>
                                        <p class="mt-2 text-[13px] leading-6 text-slate-600">{{ $faq['a'] }}</p>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    </div>

                    <!-- Kanan: Checkout Card Sticky -->
                    <aside class="opacity-0 blur-sm transition-all duration-700 ease-out translate-y-6 scale-[0.98] lg:sticky lg:top-24 h-max" data-reveal data-reveal-delay="200">
                        <form action="{{ route('checkout.index') }}" method="GET"
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

                                <input type="hidden" name="qty" x-bind:value="qty">
                                <input type="hidden" name="ticketType" x-bind:value="ticketType">
                                <button type="submit" class="inline-flex h-12 w-full items-center justify-center rounded-2xl bg-violet-600 px-4 text-sm font-semibold text-white shadow-[0_16px_28px_rgba(109,40,217,0.28)] transition hover:-translate-y-0.5 hover:bg-violet-700 focus:outline-none focus:ring-4 focus:ring-violet-500/20">
                                    Beli Tiket Sekarang
                                </button>

                                <div class="rounded-2xl border border-violet-100 bg-violet-50/50 p-4 text-[12px] leading-5 text-slate-500 text-center">
                                    Aman dan Bergaransi, didukung oleh standar enkripsi terbaik.
                                </div>
                            </div>
                        </form>
                    </aside>
            </div>
        </main>

        <x-home.footer />
    </body>
</html>
