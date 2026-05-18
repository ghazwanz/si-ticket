@extends('layouts.organizer')
@section('title', 'Pengaturan Akun')
@section('page-title', 'Pengaturan Akun')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 glass-panel rounded-2xl p-6 shadow-sm border border-white/60 dark:border-white/10">
        <div class="flex items-center gap-3 mb-6">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-violet-500/10 text-violet-600 dark:text-violet-400">
                <x-heroicon-o-building-office-2 class="w-5 h-5" />
            </span>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Profil Organisasi</p>
                <h2 class="text-lg font-extrabold tracking-tight text-slate-950 dark:text-white">Informasi Penanggung Jawab</h2>
            </div>
        </div>

        <form class="space-y-4">
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Nama Lengkap Penanggung Jawab</label>
                <input type="text" value="Artha Pradana" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
            </div>
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Email Bisnis</label>
                <input type="email" value="artha@karsacreative.id" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
            </div>
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Nama Organisasi</label>
                <input type="text" value="Karsa Creative Network" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
            </div>
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Alamat Organisasi</label>
                <textarea rows="3" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">Jl. Senopati No. 45, Kebayoran Baru, Jakarta Selatan, 12110</textarea>
            </div>
            <div class="pt-2 flex items-center gap-3">
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-bold rounded-xl hover:from-violet-700 hover:to-indigo-700 shadow-sm">
                    <x-heroicon-o-check class="w-4 h-4" />
                    Simpan Perubahan
                </button>
                <button type="button" class="px-5 py-2.5 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-white/5 font-bold">Batal</button>
            </div>
        </form>
    </div>

    <div class="space-y-6">
        <div class="glass-panel rounded-2xl p-6 shadow-sm border border-white/60 dark:border-white/10">
            <h3 class="font-extrabold tracking-tight text-slate-950 dark:text-white mb-3">Status Akun</h3>
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-sm text-slate-700 dark:text-slate-300"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Aktif</div>
                <div class="flex items-center gap-2 text-sm text-slate-700 dark:text-slate-300"><span class="w-2.5 h-2.5 rounded-full bg-violet-500"></span> Premium</div>
            </div>
        </div>

        <div class="glass-panel rounded-2xl p-6 shadow-sm border border-white/60 dark:border-white/10">
            <h3 class="font-extrabold tracking-tight text-slate-950 dark:text-white mb-3">Keamanan</h3>
            <form class="space-y-3">
                <input type="password" placeholder="Kata sandi lama" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
                <input type="password" placeholder="Kata sandi baru" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
                <p class="text-xs text-slate-400">Minimal 8 karakter.</p>
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-violet-600 text-white font-bold rounded-xl hover:bg-violet-700">
                    <x-heroicon-o-shield-check class="w-4 h-4" />
                    Perbarui Kata Sandi
                </button>
            </form>
        </div>
    </div>
</div>
@endsection