<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Katalog Event - {{ config('app.name', 'JoinFest') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    </head>
    <body class="min-h-screen bg-[radial-gradient(circle_at_4%_4%,_#f8f4ff,_transparent_35%),_#ecedf1] font-[Poppins,sans-serif] text-slate-900">
        <main class="mx-auto my-3 w-[calc(100%-24px)] max-w-[1240px] overflow-hidden rounded-[24px] border border-slate-200 bg-slate-50 shadow-[0_20px_40px_rgba(18,23,34,0.08)]">
            <header data-site-header data-scrolled="false" class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 bg-white/80 px-4 py-4 backdrop-blur transition-all duration-300 md:h-[74px] md:px-6 data-[scrolled=true]:border-violet-200 data-[scrolled=true]:bg-white/95 data-[scrolled=true]:shadow-[0_12px_30px_rgba(15,23,42,0.08)]">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-lg font-bold tracking-tight text-slate-900">
                    <img src="{{ asset('img/EOLogo.png') }}" alt="JoinFest logo" class="h-9 w-9 rounded-full">
                    <span>JoinFest</span>
                </a>

                <div class="inline-flex items-center gap-2">
                    <a href="{{ url('/') }}" class="inline-flex h-10 items-center justify-center rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-violet-50 hover:text-violet-700">Kembali ke Landing</a>
                </div>
            </header>

            <section class="px-4 py-6 md:px-6" data-reveal data-reveal-delay="0">
                <div class="mb-4 flex flex-col gap-2">
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Katalog Event</h1>
                    <p class="text-sm text-slate-500">Pilih event favoritmu lalu lihat detail lengkapnya.</p>
                </div>

                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($events as $event)
                        <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white transition duration-200 hover:-translate-y-1 hover:shadow-[0_16px_26px_rgba(32,38,52,0.12)] opacity-0 translate-y-6 scale-[0.98] blur-sm transition-all duration-700 ease-out" data-reveal data-reveal-delay="{{ $loop->index * 80 + 80 }}">
                            <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}" class="aspect-[16/9] w-full object-cover">
                            <div class="p-4">
                                <span class="mb-2 inline-flex rounded-full bg-violet-500/10 px-3 py-1 text-xs font-semibold text-violet-600">{{ $event['category'] }}</span>
                                <h2 class="text-[15px] font-semibold text-slate-900">{{ $event['title'] }}</h2>
                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    {{ $event['location'] }}<br>
                                    {{ $event['date'] }}
                                </p>
                                <div class="mt-4 flex items-center justify-between gap-3">
                                    <span class="text-sm font-bold text-violet-600">{{ $event['price'] }}</span>
                                    <a href="{{ route('events.show', $event['slug']) }}" class="inline-flex h-8 items-center rounded-lg border border-slate-200 bg-white px-3 text-xs font-semibold text-slate-700 transition hover:bg-violet-50 hover:text-violet-700">Lihat Detail</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            @include('partials.footer')
        </main>
    </body>
</html>
