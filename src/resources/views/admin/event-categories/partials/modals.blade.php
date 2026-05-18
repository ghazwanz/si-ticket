{{-- Panel Ubah Kategori --}}
<x-admin-panel 
    name="edit-category-{{ $category->id }}" 
    title="Ubah Klasifikasi" 
    description="Perbarui nama dan properti kategori {{ $category->name }}."
    width="2xl"
>
    <form id="edit-category-form-{{ $category->id }}" method="POST" action="{{ route('admin.event-categories.update', $category) }}" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- Informasi dasar --}}
        <section class="space-y-6">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-1.5 h-4 bg-violet-500 rounded-full"></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Identitas Umum</h3>
            </div>
            
            <div class="grid gap-6">
                <div class="space-y-2">
                    <x-input-label for="edit_name_{{ $category->id }}" :value="__('Nama Kategori')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                    <x-text-input id="edit_name_{{ $category->id }}" name="name" type="text" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('name', $category->name)" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <p class="text-[10px] text-slate-500 font-medium italic ml-1">Slug URL akan dibuat ulang secara otomatis berdasarkan nama ini.</p>
                </div>
            </div>
        </section>

        <hr class="border-slate-100 dark:border-slate-800">

        {{-- Metadata / statistik --}}
        <section class="space-y-6">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-1.5 h-4 bg-blue-500 rounded-full"></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Registri Penggunaan</h3>
            </div>

            <div class="p-5 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Acara Aktif</p>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white mt-1">{{ number_format($category->events_count ?? $category->events()->count()) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 shadow-sm flex items-center justify-center text-slate-400">
                    <x-heroicon-o-calendar class="w-6 h-6" />
                </div>
            </div>
        </section>
    </form>

    <x-slot name="footer">
        <div class="flex items-center justify-end gap-3">
            <button x-on:click="close()" class="px-6 py-3 rounded-2xl text-sm font-bold text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 transition-colors">
                Batalkan Perubahan
            </button>
            <x-primary-button form="edit-category-form-{{ $category->id }}" class="rounded-2xl bg-violet-600 px-8 py-3 text-xs font-bold uppercase tracking-widest shadow-lg shadow-violet-600/20">
                {{ __('Perbarui Klasifikasi') }}
            </x-primary-button>
        </div>
    </x-slot>
</x-admin-panel>

{{-- Modal Hapus Kategori --}}
<x-modal name="delete-category-{{ $category->id }}" maxWidth="md">
    <div class="p-8 text-center">
        @php
            $hasEvents = $category->events()->exists();
        @endphp

        <div class="w-16 h-16 rounded-3xl bg-rose-500/10 text-rose-500 flex items-center justify-center mx-auto mb-6">
            <x-heroicon-o-exclamation-triangle class="w-8 h-8" />
        </div>

        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Arsipkan Kategori?</h2>
        <p class="text-sm text-slate-500 mt-2 px-4 leading-relaxed">
            Konfirmasikan pengarsipan <b>{{ $category->name }}</b>. Kategori ini tetap mempertahankan registri aktif dan dipindahkan ke filter audit terhapus.
        </p>

        @if($hasEvents)
            <div class="mt-6 p-4 rounded-2xl bg-rose-500/5 border border-rose-500/20 text-rose-600 text-[10px] font-bold flex flex-col gap-2 text-left uppercase tracking-widest">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-lock-closed class="w-4 h-4" />
                    Arsip Diblokir: Terdapat Dependensi
                </div>
                <p class="font-medium normal-case tracking-normal text-xs text-rose-500">Kategori ini masih dipetakan ke acara yang ada. Alihkan taksonomi acara sebelum mengarsipkannya.</p>
            </div>
        @endif

        <div class="mt-8 flex flex-col gap-3">
            <form method="POST" action="{{ route('admin.event-categories.destroy', $category) }}">
                @csrf
                @method('DELETE')
                <x-danger-button 
                    :disabled="$hasEvents"
                    class="w-full justify-center py-4 rounded-2xl text-xs font-bold uppercase tracking-widest bg-rose-600 hover:bg-rose-700 shadow-lg shadow-rose-600/20 transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-slate-500 disabled:shadow-none"
                >
                    {{ __('Konfirmasi Arsip') }}
                </x-danger-button>
            </form>
            <x-secondary-button x-on:click="$dispatch('close')" class="justify-center py-4 rounded-2xl dark:text-black border-slate-200 dark:border-slate-800 text-xs font-bold uppercase tracking-widest">
                {{ __('Batalkan Permintaan') }}
            </x-secondary-button>
        </div>
    </div>
</x-modal>
