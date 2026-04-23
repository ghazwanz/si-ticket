@extends('layouts.organizer')
@section('title', 'Pengaturan Akun')
@section('page-title', 'Pengaturan Akun')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Info Organisasi --}}
    <div class="lg:col-span-2 rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Profil & Organisasi</h2>
        <form class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap PIC</label>
                <input type="text" value="Artha Pradana" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Bisnis</label>
                <input type="email" value="artha@karsacreative.id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Organisasi</label>
                <input type="text" value="Karsa Creative Network" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Organisasi</label>
                <textarea rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">Jl. Senopati No. 45, Kebayoran Baru, Jakarta Selatan, 12110</textarea>
            </div>
            <div class="pt-2 flex items-center gap-3">
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-xl hover:from-purple-700 hover:to-indigo-700 shadow-sm">Simpan Perubahan</button>
                <button type="button" class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium">Batal</button>
            </div>
        </form>
    </div>

    {{-- Status & Keamanan --}}
    <div class="space-y-6">
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
            <h3 class="font-semibold text-gray-900 mb-3">Status Akun</h3>
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-sm"><span class="w-2.5 h-2.5 rounded-full bg-green-500"></span> Aktif</div>
                <div class="flex items-center gap-2 text-sm"><span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span> Premium</div>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
            <h3 class="font-semibold text-gray-900 mb-3">Keamanan</h3>
            <form class="space-y-3">
                <input type="password" placeholder="Kata sandi lama" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                <input type="password" placeholder="Kata sandi baru" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                <p class="text-xs text-gray-400">Min. 8 karakter</p>
                <button type="submit" class="w-full py-2.5 bg-purple-600 text-white font-medium rounded-xl hover:bg-purple-700">Perbarui Password</button>
            </form>
        </div>
    </div>
</div>
@endsection