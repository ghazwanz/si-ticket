@extends('layouts.organizer')
@section('title', 'Merchandise')
@section('page-title', 'Kelola Katalog Eksklusif Anda')

@section('content')
<div class="space-y-6">
    {{-- Hero Banner --}}
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl p-8 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">EDISI TERBATAS</h1>
            <p class="text-purple-100 mt-2 max-w-md">Pantau stok, atur harga, dan perbarui koleksi merchandise Anda dalam satu layar editorial.</p>
        </div>
        <a href="{{ route('organizer.merchandise.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-purple-700 font-medium rounded-xl shadow hover:bg-gray-100 transition whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Merchandise Baru
        </a>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="rounded-2xl bg-white p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Total Nilai Inventaris</p>
            <p class="text-2xl font-bold text-gray-900 mt-2">Rp 128.450.000</p>
        </div>
        <div class="rounded-2xl bg-white p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Stok Rendah</p>
            <p class="text-2xl font-bold text-red-600 mt-2">12 Item</p>
        </div>
        <div class="rounded-2xl bg-white p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Terjual (Bulan ini)</p>
            <p class="text-2xl font-bold text-gray-900 mt-2">458 Pcs</p>
        </div>
    </div>

    {{-- Filter Kategori --}}
    <div class="flex gap-2">
        <button class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-full">Semua Kategori</button>
        <button class="px-4 py-2 bg-white text-gray-500 text-sm font-medium rounded-full border border-gray-200 hover:bg-gray-50">Apparel</button>
        <button class="px-4 py-2 bg-white text-gray-500 text-sm font-medium rounded-full border border-gray-200 hover:bg-gray-50">Aksesoris</button>
    </div>

    {{-- Grid Produk --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach(range(1, 6) as $item)
        <div class="rounded-2xl bg-white shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="h-48 bg-gray-100 flex items-center justify-center relative">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span class="absolute top-3 right-3 px-2.5 py-1 bg-purple-100 text-purple-700 text-xs font-medium rounded-full">Tersedia</span>
            </div>
            <div class="p-5">
                <h3 class="font-semibold text-gray-900">Hoodie VibeFest</h3>
                <p class="text-xl font-bold text-purple-600 mt-1">Rp 399.000</p>
                <p class="text-sm text-gray-500 mt-1">Stok: 24 · Apparel</p>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('organizer.merchandise.edit', $item) }}" class="flex-1 px-4 py-2 text-center border border-purple-500 text-purple-600 text-sm font-medium rounded-xl hover:bg-purple-50 transition">Edit</a>
                    <button class="flex-1 px-4 py-2 border border-red-400 text-red-500 text-sm font-medium rounded-xl hover:bg-red-50 transition">Hapus</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Empty State (dipertahankan) --}}
    @if(false)
    <div class="flex flex-col items-center justify-center h-96 mt-8">
        <svg class="w-24 h-24 text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a2 2 0 00-1.414.586l-2 2a2 2 0 01-2.828 0l-2-2a2 2 0 00-1.414-.586H4"/></svg>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada merchandise</h3>
        <p class="text-gray-500 mb-6">Mulai dengan membuat merchandise pertama Anda</p>
        <a href="{{ route('organizer.merchandise.create') }}" class="px-6 py-3 bg-purple-600 text-white font-medium rounded-xl hover:bg-purple-700 transition">Buat Merchandise</a>
    </div>
    @endif
</div>
@endsection