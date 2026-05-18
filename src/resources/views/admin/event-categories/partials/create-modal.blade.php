{{-- Create Category Panel --}}
<x-admin-panel 
    name="create-category" 
    title="Klasifikasi Baru" 
    description="Tambahkan kategori acara baru untuk memperluas taksonomi pencarian platform."
    width="2xl"
>
    <form id="create-category-form" method="POST" action="{{ route('admin.event-categories.store') }}" class="space-y-8">
        @csrf

        {{-- Identity Section --}}
        <section class="space-y-6">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-1.5 h-4 bg-violet-500 rounded-full"></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Identitas Kategori</h3>
            </div>
            
            <div class="grid gap-6">
                <div class="space-y-2">
                    <x-input-label for="new_name" :value="__('Nama Tampilan')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                    <x-text-input id="new_name" name="name" type="text" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('name')" placeholder="mis. Musik dan Konser" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <p class="text-[10px] text-slate-500 font-medium italic ml-1">Sistem akan membuat slug URL unik untuk kategori ini secara otomatis.</p>
                </div>
            </div>
        </section>

        <hr class="border-slate-100 dark:border-slate-800">

        {{-- Guidance Section --}}
        <section class="p-5 bg-violet-500/5 rounded-2xl border border-violet-500/10">
            <div class="flex items-center gap-3 mb-2">
                <x-heroicon-o-information-circle class="w-5 h-5 text-violet-500" />
                <p class="text-[10px] font-bold text-violet-600 dark:text-violet-400 uppercase tracking-widest">Catatan Platform</p>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                Kategori terlihat secara publik dan digunakan untuk pencarian acara, penyaringan, serta optimasi SEO. Gunakan nama yang deskriptif dan berbeda.
            </p>
        </section>
    </form>

    <x-slot name="footer">
        <div class="flex items-center justify-end gap-3">
            <button x-on:click="close()" class="px-6 py-3 rounded-2xl text-sm font-bold text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 transition-colors">
                Batal
            </button>
            <x-primary-button form="create-category-form" class="rounded-2xl bg-violet-600 px-8 py-3 text-xs font-bold uppercase tracking-widest shadow-lg shadow-violet-600/20">
                {{ __('Daftarkan Kategori') }}
            </x-primary-button>
        </div>
    </x-slot>
</x-admin-panel>
