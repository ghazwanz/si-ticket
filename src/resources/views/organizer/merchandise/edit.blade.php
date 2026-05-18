@extends('layouts.organizer')
@section('title', isset($merchandise) ? 'Edit Merchandise' : 'Tambah Merchandise Baru')
@section('page-title', isset($merchandise) ? 'Edit Merchandise' : 'Tambah Merchandise Baru')

@section('content')
<div class="max-w-3xl mx-auto" x-data="{
    variantGroups: {{ isset($merchandise) ? "[{ id: 1, name: 'Ukuran', variants: [{ id: 11, name: 'S', stock: 10, priceDiff: 0 }, { id: 12, name: 'M', stock: 15, priceDiff: 0 }] }, { id: 2, name: 'Warna', variants: [{ id: 21, name: 'Hitam', stock: 5, priceDiff: 0 }] }]" : '[]' }},
    addGroup() {
        this.variantGroups.push({ id: Date.now(), name: '', variants: [{ id: Date.now() + 1, name: '', stock: '', priceDiff: '' }] });
    },
    removeGroup(index) {
        this.variantGroups.splice(index, 1);
    },
    addVariant(groupIndex) {
        this.variantGroups[groupIndex].variants.push({ id: Date.now(), name: '', stock: '', priceDiff: '' });
    },
    removeVariant(groupIndex, variantIndex) {
        this.variantGroups[groupIndex].variants.splice(variantIndex, 1);
    }
}">
    <form method="POST" action="{{ isset($merchandise) ? route('organizer.merchandise.update', $merchandise->id) : route('organizer.merchandise.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @isset($merchandise)
            @method('PUT')
        @endisset

        <div class="glass-panel rounded-2xl p-6 shadow-sm border border-white/60 dark:border-white/10">
            <h3 class="text-lg font-extrabold tracking-tight text-slate-950 dark:text-white mb-4">Informasi Dasar</h3>
            <div class="mb-4">
                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Nama Merchandise</label>
                <input type="text" value="{{ isset($merchandise) ? 'Kaos Festival Soundwave' : '' }}" placeholder="Contoh: Kaos Festival Soundwave" required class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
            </div>
            <div class="mb-4">
                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Deskripsi</label>
                <textarea placeholder="Jelaskan detail merchandise." rows="4" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">{{ isset($merchandise) ? 'Kaos eksklusif dengan desain minimalis.' : '' }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Gambar Merchandise</label>
                @isset($merchandise)
                <div class="mb-3 w-full h-48 bg-slate-950 rounded-2xl flex items-center justify-center">
                    <x-heroicon-o-photo class="w-12 h-12 text-violet-200" />
                </div>
                @endisset
                <div class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl p-8 text-center hover:bg-slate-50 dark:hover:bg-white/5 transition-colors cursor-pointer">
                    <x-heroicon-o-photo class="w-12 h-12 text-slate-400 mx-auto mb-2" />
                    <p class="text-slate-900 dark:text-white font-bold">{{ isset($merchandise) ? 'Ganti gambar' : 'Seret gambar atau klik untuk unggah' }}</p>
                    <p class="text-slate-500 text-sm mt-1">JPG, PNG (maksimal 5 MB)</p>
                    <input type="file" class="hidden" accept="image/*">
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Harga Dasar (Rp)</label>
                <input type="number" value="{{ isset($merchandise) ? '150000' : '' }}" placeholder="150000" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
            </div>
        </div>

        <div class="glass-panel rounded-2xl p-6 shadow-sm border border-white/60 dark:border-white/10">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-extrabold tracking-tight text-slate-950 dark:text-white">Varian dan Stok</h3>
                <button type="button" x-on:click="addGroup()" class="inline-flex items-center gap-2 px-4 py-2 bg-violet-500/10 text-violet-700 dark:text-violet-300 font-bold rounded-xl hover:bg-violet-500/20 transition">
                    <x-heroicon-o-plus class="w-4 h-4" />
                    Tambah Grup Varian
                </button>
            </div>

            <div class="space-y-6">
                <template x-for="(group, groupIndex) in variantGroups" :key="group.id">
                    <div class="border border-slate-100 dark:border-slate-800 rounded-xl p-4 bg-white/70 dark:bg-white/5">
                        <div class="flex justify-between items-center mb-4">
                            <input type="text" x-model="group.name" placeholder="Nama grup varian (contoh: warna)" class="flex-1 px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 mr-2">
                            <button type="button" x-on:click="removeGroup(groupIndex)" class="text-rose-500 hover:text-rose-700 font-bold">Hapus Grup</button>
                        </div>

                        <div class="space-y-3 mb-4">
                            <template x-for="(variant, variantIndex) in group.variants" :key="variant.id">
                                <div class="flex gap-3">
                                    <input type="text" x-model="variant.name" placeholder="Varian" class="flex-1 px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white rounded-lg focus:ring-violet-500">
                                    <input type="number" x-model="variant.stock" placeholder="Stok" class="w-24 px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white rounded-lg focus:ring-violet-500">
                                    <input type="number" x-model="variant.priceDiff" placeholder="Selisih harga" class="w-32 px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white rounded-lg focus:ring-violet-500">
                                    <button type="button" x-on:click="removeVariant(groupIndex, variantIndex)" class="text-rose-500 hover:text-rose-700 font-bold">Hapus</button>
                                </div>
                            </template>
                        </div>
                        <button type="button" x-on:click="addVariant(groupIndex)" class="px-4 py-2 border border-violet-500 text-violet-600 dark:text-violet-400 font-bold rounded-lg hover:bg-violet-500/10 text-sm">Tambah Varian</button>
                    </div>
                </template>
            </div>
        </div>

        <div class="glass-panel rounded-2xl p-6 shadow-sm border border-white/60 dark:border-white/10 flex items-center gap-4">
            <input type="checkbox" id="isAvailable" checked class="w-5 h-5 text-violet-600 rounded border-slate-300 focus:ring-violet-500">
            <label for="isAvailable" class="text-slate-900 dark:text-white font-bold">Merchandise tersedia</label>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('organizer.merchandise.index') }}" data-link class="px-5 py-2.5 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-white/5 font-bold">Batal</a>
            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-bold rounded-xl hover:from-violet-700 hover:to-indigo-700 shadow-sm">{{ isset($merchandise) ? 'Simpan Perubahan' : 'Simpan Merchandise' }}</button>
        </div>
    </form>
</div>
@endsection
