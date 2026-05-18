@extends('layouts.organizer')
@section('title', 'Merchandise')
@section('page-title', 'Merchandise')

@section('content')
<div class="space-y-6">
    <x-organizer.page-hero
        eyebrow="Inventaris Eksklusif"
        title="Kelola Katalog Merchandise"
        description="Pantau stok, atur harga, dan siapkan produk pendukung acara dengan tampilan operasional yang konsisten."
        icon="shopping-bag">
        <x-slot:actions></x-slot:actions>
    </x-organizer.page-hero>

    <div class="flex justify-end -mt-20 relative z-10 px-8">
        <a href="{{ route('organizer.merchandise.create') }}" data-link class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-violet-700 font-bold rounded-xl shadow-lg hover:bg-slate-50 transition whitespace-nowrap">
            <x-heroicon-o-plus class="w-4 h-4" />
            Tambah Merchandise
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <x-organizer.stat-card label="Nilai Inventaris" value="Rp 128,45 Juta" meta="Estimasi seluruh stok aktif" icon="archive-box" tone="violet" />
        <x-organizer.stat-card label="Stok Rendah" value="12 Produk" meta="Memerlukan penambahan stok" icon="exclamation-triangle" tone="rose" />
        <x-organizer.stat-card label="Terjual Bulan Ini" value="458 Pcs" meta="Termasuk klaim bundling tiket" icon="shopping-cart" tone="emerald" />
    </div>

    <div class="flex flex-wrap gap-2">
        <button type="button" class="px-4 py-2 bg-violet-600 text-white text-sm font-bold rounded-full shadow-sm">Semua Kategori</button>
        <button type="button" class="px-4 py-2 glass-panel text-slate-600 dark:text-slate-300 text-sm font-bold rounded-full border border-white/60 dark:border-white/10 hover:text-violet-600">Pakaian</button>
        <button type="button" class="px-4 py-2 glass-panel text-slate-600 dark:text-slate-300 text-sm font-bold rounded-full border border-white/60 dark:border-white/10 hover:text-violet-600">Aksesori</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach(range(1, 6) as $item)
        <div class="glass-panel rounded-2xl shadow-sm border border-white/60 dark:border-white/10 overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all">
            <div class="h-48 bg-slate-950 flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(124,58,237,0.35),transparent_45%)]"></div>
                <x-heroicon-o-photo class="relative w-12 h-12 text-violet-200" />
                <span class="absolute top-3 right-3 px-2.5 py-1 bg-emerald-500/10 text-emerald-300 text-xs font-bold rounded-full border border-emerald-500/20">Tersedia</span>
            </div>
            <div class="p-5">
                <h3 class="font-extrabold tracking-tight text-slate-950 dark:text-white">Hoodie VibeFest</h3>
                <p class="text-xl font-extrabold text-violet-600 dark:text-violet-400 mt-1">Rp 399.000</p>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Stok: 24 · Pakaian</p>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('organizer.merchandise.edit', $item) }}" data-link class="flex-1 inline-flex items-center justify-center gap-1 px-4 py-2 border border-violet-500 text-violet-600 dark:text-violet-400 text-sm font-bold rounded-xl hover:bg-violet-500/10 transition">
                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                        Edit
                    </a>
                    <button type="button" class="flex-1 inline-flex items-center justify-center gap-1 px-4 py-2 border border-rose-400 text-rose-500 text-sm font-bold rounded-xl hover:bg-rose-500/10 transition">
                        <x-heroicon-o-trash class="w-4 h-4" />
                        Hapus
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if(false)
    <div class="flex flex-col items-center justify-center h-96 mt-8 glass-panel rounded-2xl border border-white/60 dark:border-white/10">
        <x-heroicon-o-shopping-bag class="w-24 h-24 text-slate-300 mb-4" />
        <h3 class="text-xl font-extrabold tracking-tight text-slate-950 dark:text-white mb-2">Belum ada merchandise</h3>
        <p class="text-slate-500 mb-6">Mulai dengan membuat merchandise pertama Anda.</p>
        <a href="{{ route('organizer.merchandise.create') }}" data-link class="px-6 py-3 bg-violet-600 text-white font-bold rounded-xl hover:bg-violet-700 transition">Buat Merchandise</a>
    </div>
    @endif
</div>
@endsection