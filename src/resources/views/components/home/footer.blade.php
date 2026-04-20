<footer class="border-t border-slate-200 bg-white px-4 py-10 md:px-6 lg:mt-20 mt-12">
    <div class="mx-auto grid w-full max-w-7xl gap-8 md:grid-cols-2 xl:grid-cols-[1.2fr_0.8fr_0.8fr_1fr]">
        <div class="grid gap-4">
            <div class="inline-flex items-center gap-3 text-lg font-extrabold tracking-tight text-violet-600">
                <img src="{{ asset('img/EOLogo.png') }}" alt="JoinFest logo" class="h-9 w-9 rounded-full object-cover">
                <span>{{ config('app.name') }}</span>
            </div>
            <p class="max-w-sm text-sm leading-7 text-slate-500">Platform tiket event dengan pengalaman pemesanan yang ringkas, aman, dan cepat untuk pengguna maupun organizer.</p>
            <div class="flex items-center gap-3 text-slate-400">
                <a href="#" class="transition hover:text-violet-600" aria-label="Instagram"><svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" /><circle cx="12" cy="12" r="4" /><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none" /></svg></a>
                <a href="#" class="transition hover:text-violet-600" aria-label="Facebook"><svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3.5l.5-4H14V7a1 1 0 0 1 1-1h3z" /></svg></a>
                <a href="#" class="transition hover:text-violet-600" aria-label="X"><svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4l16 16M20 4L4 20" /></svg></a>
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
            <p class="mb-3 text-sm leading-7 text-slate-500">Dapatkan update event pilihan dan promo tiket terbaru setiap minggu.</p>
            <form class="grid gap-2" action="#" method="get">
                <input type="email" name="email" placeholder="Alamat email kamu" class="h-11 rounded-xl border border-slate-300 bg-white px-3 text-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10">
                <button type="submit" class="inline-flex h-11 items-center justify-center rounded-xl bg-violet-600 px-4 text-sm font-semibold text-white transition hover:bg-violet-700">Langganan</button>
            </form>
        </div>
    </div>

    <div class="mx-auto mt-8 w-full max-w-6xl border-t border-slate-200 pt-4 text-center text-xs text-slate-400">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</div>
</footer>
