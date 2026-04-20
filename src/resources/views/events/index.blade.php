<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Katalog Event - {{ config('app.name', 'JoinFest') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    </head>
    <body class="min-h-screen bg-[radial-gradient(circle_at_10%_10%,_#f8f4ff,_transparent_30%),_linear-gradient(180deg,_#f8fafc_0%,_#eef2ff_100%)] font-[Plus_Jakarta_Sans,sans-serif] text-slate-900">
        <x-home.header />

        <main class="w-full px-4 py-6 md:px-6 md:py-10">
            <div class="max-w-7xl mx-auto">
                <div class="mb-8 flex flex-col gap-2" data-reveal data-reveal-delay="0">
                    <h1 class="lg:text-4xl text-2xl font-semibold tracking-tight text-slate-900">Katalog Event</h1>
                    <p class="text-sm text-slate-500">Temukan event pilihanmu dan lanjutkan pemesanan dalam alur yang cepat.</p>
                </div>

                <div class="flex flex-col gap-8 lg:flex-row items-start">
                    <!-- Sidebar Filter -->
                    <aside class="w-full shrink-0 rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_8px_24px_rgba(15,23,42,0.04)] lg:sticky lg:top-24 lg:w-64 opacity-0 blur-sm translate-y-6 scale-[0.98] transition-all duration-700 ease-out" data-reveal data-reveal-delay="50">
                        <form action="{{ route('events.index') }}" method="GET" class="space-y-6">
                            <!-- Kategori Filter -->
                            <div>
                                <h3 class="text-sm font-bold text-slate-900">Kategori</h3>
                                <div class="mt-3 space-y-2">
                                    @foreach (['Konser', 'Seminar', 'Olahraga', 'Teater', 'Seni', 'Film'] as $cat)
                                        <label class="group flex cursor-pointer items-center gap-3">
                                            <input type="checkbox" name="category[]" value="{{ strtolower($cat) }}" class="h-4 w-4 rounded border-slate-300 text-violet-600 transition focus:ring-violet-600">
                                            <span class="text-sm font-medium text-slate-600 transition group-hover:text-slate-900">{{ $cat }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Waktu Pelaksanaan / Tanggal Filter -->
                            <div class="border-t border-slate-100 pt-6">
                                <h3 class="text-sm font-bold text-slate-900">Waktu Pelaksanaan</h3>
                                <div class="mt-3 space-y-2">
                                    @foreach (['Hari Ini', 'Besok', 'Minggu Ini', 'Bulan Ini', 'Bulan Depan'] as $time)
                                        <label class="group flex cursor-pointer items-center gap-3">
                                            <input type="radio" name="date" value="{{ strtolower(str_replace(' ', '-', $time)) }}" class="h-4 w-4 border-slate-300 text-violet-600 transition focus:ring-violet-600">
                                            <span class="text-sm font-medium text-slate-600 transition group-hover:text-slate-900">{{ $time }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Harga Filter -->
                            <div class="border-t border-slate-100 pt-6">
                                <h3 class="text-sm font-bold text-slate-900">Range Harga</h3>
                                <div class="mt-3 space-y-4">
                                    <label class="group flex cursor-pointer items-center gap-3">
                                        <input type="checkbox" name="is_free" value="true" class="h-4 w-4 rounded border-slate-300 text-violet-600 transition focus:ring-violet-600">
                                        <span class="text-sm font-medium text-slate-600 transition group-hover:text-slate-900">Gratis (Rp 0)</span>
                                    </label>

                                    <div class="grid grid-cols-2 gap-2">
                                        <div>
                                            <label class="sr-only" for="price_min">Minimal</label>
                                            <input type="number" id="price_min" name="price_min" placeholder="Min (Rp)" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs font-medium text-slate-900 outline-none transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/20">
                                        </div>
                                        <div>
                                            <label class="sr-only" for="price_max">Maksimal</label>
                                            <input type="number" id="price_max" name="price_max" placeholder="Max (Rp)" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs font-medium text-slate-900 outline-none transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/20">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-slate-100 pt-6">
                                <button type="submit" class="w-full rounded-xl bg-violet-600 py-2.5 text-sm font-bold tracking-wide text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-violet-700 hover:shadow-[0_8px_20px_rgba(109,40,217,0.32)]">Terapkan Filter</button>
                                <button type="reset" class="mt-2 w-full py-2 text-sm font-semibold text-slate-500 transition hover:text-slate-800">Reset Semua</button>
                            </div>
                        </form>
                    </aside>

                    <!-- Event Grid -->
                    <section class="w-full" data-reveal data-reveal-delay="100">
                        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($events as $event)
                            <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_8px_24px_rgba(15,23,42,0.08)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_16px_30px_rgba(15,23,42,0.12)] opacity-0 blur-sm translate-y-6 scale-[0.98] transition-all duration-700 ease-out" data-reveal data-reveal-delay="{{ $loop->index * 80 + 80 }}">
                                <a href="{{ route('events.show', $event['slug']) }}" class="block p-0">
                                    <div class="relative">
                                        <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}" class="h-52 w-full object-cover">
                                        <div class="absolute left-3 top-3 inline-flex rounded-full bg-white/90 px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.12em] text-slate-700">{{ $event['category'] }}</div>
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
                </div>
            </div>
        </main>

        <x-home.footer />

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const elements = document.querySelectorAll('[data-reveal]');
                elements.forEach(el => el.classList.add('reveal-node'));
                const observer = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            setTimeout(() => {
                                entry.target.classList.add('revealed');
                                entry.target.style.opacity = '1';
                                entry.target.style.filter = 'blur(0)';
                                entry.target.style.transform = 'translateY(0) scale(1)';
                            }, 50);
                            observer.unobserve(entry.target);
                        }
                    });
                }, { root: null, rootMargin: '0px 0px -50px 0px', threshold: 0.1 });
                elements.forEach(el => observer.observe(el));
            });
        </script>
    </body>
</html>
