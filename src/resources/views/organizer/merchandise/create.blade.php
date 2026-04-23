@extends('layouts.organizer')
@section('title', 'Tambah Merchandise Baru')
@section('page-title', 'Tambah Merchandise Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <form method="POST" action="{{ route('organizer.merchandise.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        {{-- Informasi Dasar --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar</h3>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Merchandise</label>
                <input type="text" placeholder="Contoh: Kaos Festival Soundwave" required
                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea placeholder="Jelaskan detail merchandise..." rows="4"
                          class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Merchandise</label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center hover:bg-gray-50 transition-colors cursor-pointer">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="text-gray-900 font-medium">Seret gambar atau klik untuk upload</p>
                    <p class="text-gray-500 text-sm mt-1">JPG, PNG (Max 5MB)</p>
                    <input type="file" class="hidden" accept="image/*">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga Dasar (Rp)</label>
                <input type="number" placeholder="150000"
                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
        </div>

        {{-- Varian & Stok --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Varian & Stok</h3>
                <button type="button" onclick="addVariantGroup()"
                        class="inline-flex items-center px-4 py-2 bg-purple-100 text-purple-700 font-medium rounded-xl hover:bg-purple-200 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Grup Varian
                </button>
            </div>
            <div id="variantContainer" class="space-y-6">
                {{-- placeholder awal, JavaScript akan menambah --}}
            </div>
        </div>

        {{-- Status --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 flex items-center gap-4">
            <input type="checkbox" id="isAvailable" checked class="w-5 h-5 text-purple-600 rounded border-gray-300 focus:ring-purple-500">
            <label for="isAvailable" class="text-gray-900 font-medium">Merchandise Tersedia</label>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('organizer.merchandise.index') }}" class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium">Batal</a>
            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-xl hover:from-purple-700 hover:to-indigo-700 shadow-sm">Simpan Merchandise</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function addVariantGroup() {
        const container = document.getElementById('variantContainer');
        const newGroup = document.createElement('div');
        newGroup.className = 'border border-gray-100 rounded-xl p-4';
        newGroup.innerHTML = `
            <div class="flex justify-between items-center mb-4">
                <input type="text" placeholder="Nama Grup Varian (Contoh: Warna)" 
                       class="flex-1 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 mr-2">
                <button type="button" onclick="this.closest('div').parentElement.remove()" class="text-red-500 hover:text-red-700 font-medium">Hapus Grup</button>
            </div>
            <div class="space-y-3 mb-4">
                <div class="flex gap-3">
                    <input type="text" placeholder="Varian" class="flex-1 px-4 py-2 border border-gray-200 rounded-lg focus:ring-purple-500">
                    <input type="number" placeholder="Stok" class="w-24 px-4 py-2 border border-gray-200 rounded-lg focus:ring-purple-500">
                    <input type="number" placeholder="Selisih Harga" class="w-28 px-4 py-2 border border-gray-200 rounded-lg focus:ring-purple-500">
                    <button type="button" class="text-red-500 hover:text-red-700 font-medium">Hapus</button>
                </div>
            </div>
            <button type="button" class="px-4 py-2 border border-purple-500 text-purple-600 font-medium rounded-lg hover:bg-purple-50 text-sm">Tambah Varian</button>
        `;
        container.appendChild(newGroup);
    }
</script>
@endpush