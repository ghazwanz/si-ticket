@extends('layouts.organizer')
@section('title', 'Pusat Pemindaian')
@section('page-title', 'Pusat Pemindaian')

@section('content')
<div class="space-y-6">
    <x-organizer.page-hero
        eyebrow="Validasi Lapangan"
        title="Pusat Pemindaian Tiket dan Merchandise"
        description="Gunakan modul pemindaian untuk memverifikasi pengunjung, mencatat check-in, dan mengonfirmasi klaim produk secara cepat."
        icon="qr-code" />

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="glass-panel rounded-2xl p-6 shadow-sm border border-white/60 dark:border-white/10"
             x-data="{
                 token: '',
                 status: null,
                 handleScan() {
                     if (!this.token.trim()) {
                         return;
                     }

                     this.status = this.token.includes('ERR') ? 'error' : 'success';
                     setTimeout(() => this.status = null, this.status === 'error' ? 3000 : 5000);
                     this.token = '';
                 }
             }">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-violet-500/10 flex items-center justify-center text-violet-600 dark:text-violet-400">
                    <x-heroicon-o-ticket class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="font-extrabold tracking-tight text-slate-950 dark:text-white">Verifikasi Gerbang</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Pemindai tiket acara</p>
                </div>
            </div>

            <div class="relative w-full bg-slate-950 rounded-2xl overflow-hidden border-2 border-violet-500 aspect-video flex items-center justify-center cursor-pointer shadow-inner"
                 x-on:click="$refs.checkinInput.focus()">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-violet-500/10 to-transparent"></div>
                <div class="text-center z-10">
                    <x-heroicon-o-camera class="w-12 h-12 text-violet-300 mx-auto mb-2 animate-pulse" />
                    <p class="text-white font-extrabold">Menunggu Kode QR</p>
                    <p class="text-violet-200/80 text-xs mt-1">Arahkan kamera ke kode QR tiket.</p>
                </div>
            </div>
            <input type="text" x-ref="checkinInput" x-model="token" @keyup.enter="handleScan()" class="opacity-0 h-0 w-0 pointer-events-none" aria-label="Token tiket tersembunyi">

            <div x-cloak x-show="status === 'success'" x-transition class="mt-4 p-4 bg-emerald-500/10 rounded-xl border border-emerald-500/20">
                <div class="flex items-start gap-2">
                    <x-heroicon-o-check-circle class="w-5 h-5 text-emerald-500 mt-0.5" />
                    <div>
                        <p class="font-bold text-slate-950 dark:text-white">Check-in berhasil.</p>
                        <p class="text-sm text-slate-600 dark:text-slate-300">Budi Santoso</p>
                    </div>
                </div>
            </div>

            <div x-cloak x-show="status === 'error'" x-transition class="mt-4 p-4 bg-rose-500/10 rounded-xl border border-rose-500/20">
                <div class="flex items-start gap-2">
                    <x-heroicon-o-x-circle class="w-5 h-5 text-rose-500 mt-0.5" />
                    <div>
                        <p class="font-bold text-slate-950 dark:text-white">Kode QR tidak valid.</p>
                        <p class="text-sm text-slate-600 dark:text-slate-300">Tiket sudah dipindai atau tidak ditemukan.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-panel rounded-2xl p-6 shadow-sm border border-white/60 dark:border-white/10"
             x-data="{
                 token: '',
                 showResult: false,
                 handleScan() {
                     if (!this.token.trim()) {
                         return;
                     }

                     this.showResult = true;
                     setTimeout(() => this.showResult = false, 8000);
                     this.token = '';
                 }
             }">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400">
                    <x-heroicon-o-shopping-bag class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="font-extrabold tracking-tight text-slate-950 dark:text-white">Pemindaian Merchandise</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Klaim produk pengunjung</p>
                </div>
            </div>

            <div class="relative w-full bg-slate-950 rounded-2xl overflow-hidden border-2 border-amber-500 aspect-video flex items-center justify-center cursor-pointer shadow-inner"
                 x-on:click="$refs.merchInput.focus()">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-amber-500/10 to-transparent"></div>
                <div class="text-center z-10">
                    <x-heroicon-o-camera class="w-12 h-12 text-amber-300 mx-auto mb-2 animate-pulse" />
                    <p class="text-white font-extrabold">Menunggu Kode QR</p>
                    <p class="text-amber-200/80 text-xs mt-1">Arahkan kamera ke kode QR klaim.</p>
                </div>
            </div>
            <input type="text" x-ref="merchInput" x-model="token" @keyup.enter="handleScan()" class="opacity-0 h-0 w-0 pointer-events-none" aria-label="Token merchandise tersembunyi">

            <div x-cloak x-show="showResult" x-transition class="mt-4 p-4 bg-amber-500/10 rounded-xl border border-amber-500/20">
                <h4 class="font-bold text-slate-950 dark:text-white">Detail Pengambilan</h4>
                <p class="text-sm text-slate-600 dark:text-slate-300">Budi Santoso</p>
                <div class="mt-2 text-sm space-y-1 text-slate-600 dark:text-slate-300">
                    <span class="block">Kaos Festival (L) × 1</span>
                    <span class="block">Topi Festival × 1</span>
                </div>
                <button type="button" class="w-full mt-3 py-2 bg-emerald-500 text-white rounded-xl hover:bg-emerald-600 font-bold">Konfirmasi Pengambilan</button>
            </div>
        </div>
    </div>

    <div class="glass-panel rounded-2xl p-6 shadow-sm border border-white/60 dark:border-white/10">
        <h3 class="font-extrabold tracking-tight text-slate-950 dark:text-white mb-4">Aktivitas Terkini</h3>
        <div class="space-y-3 max-h-60 overflow-y-auto custom-scrollbar">
            @foreach(range(1, 5) as $i)
            <div class="flex justify-between items-center text-sm p-3 bg-white/70 dark:bg-white/5 rounded-xl">
                <div>
                    <p class="font-bold text-slate-950 dark:text-white">Pengunjung #{{ $i }}</p>
                    <p class="text-slate-500 dark:text-slate-400">{{ $i % 2 == 0 ? 'Check-in berhasil • VIP' : 'Klaim kaos • Ukuran L' }}</p>
                </div>
                <span class="text-emerald-600 dark:text-emerald-400 font-bold">14:{{ 30 - $i }}:00</span>
            </div>
            @endforeach
        </div>
        <div class="mt-4 text-right">
            <a href="#" data-link class="inline-flex items-center gap-1 text-sm font-bold text-violet-600 hover:text-violet-800 dark:text-violet-400 dark:hover:text-violet-300">
                Lihat Semua Log
                <x-heroicon-o-arrow-right class="w-4 h-4" />
            </a>
        </div>
        <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-between text-xs text-slate-400">
            <span>Server: Singapura (SG-1)</span>
            <span>Sinkronisasi otomatis: Aktif</span>
        </div>
    </div>
</div>
@endsection
