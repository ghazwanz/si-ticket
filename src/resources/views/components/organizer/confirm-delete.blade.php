@props([
    'id',
    'title' => 'Hapus Acara',
    'action',
    'name' => null,
])

<div x-data="{ open: false }" class="inline-flex">
    <button type="button" @click="open = true" class="inline-flex items-center justify-end gap-1 text-rose-600 hover:text-rose-800 dark:text-rose-400 dark:hover:text-rose-300 font-bold">
        <x-heroicon-o-trash class="w-4 h-4" />
        Hapus
    </button>

    <div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/70 px-4 backdrop-blur-sm">
        <div @click.outside="open = false" x-transition.scale.origin.center class="w-full max-w-md glass-panel rounded-2xl border border-white/60 dark:border-white/10 p-6 shadow-2xl">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-rose-500/10 text-rose-600 dark:text-rose-400">
                    <x-heroicon-o-trash class="h-6 w-6" />
                </div>
                <div class="min-w-0">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Konfirmasi Penghapusan</p>
                    <h3 class="mt-1 text-lg font-extrabold tracking-tight text-slate-950 dark:text-white">{{ $title }}</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">
                        Tindakan ini akan menghapus acara{{ $name ? ' “'.$name.'”' : '' }} dari daftar aktif. Data tetap tersimpan sebagai arsip sesuai kebijakan sistem.
                    </p>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" @click="open = false" class="px-5 py-2.5 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-white/5 font-bold">
                    Batal
                </button>
                <form method="POST" action="{{ $action }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-rose-600 text-white font-bold shadow-sm hover:bg-rose-700">
                        Hapus Acara
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
