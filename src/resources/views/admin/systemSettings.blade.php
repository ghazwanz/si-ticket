@extends('layouts.admin')

@section('title', 'System Settings - JoinFest Admin')
@section('search_placeholder', 'Cari pengaturan...')

@section('topbar_badge')
    <span class="ml-2 text-[10px] font-bold px-2.5 py-0.5 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300">ADMIN PANEL</span>
@endsection

@section('content')
<div x-data="{
    showOldPass: false,
    showNewPass: false,
    showConfirmPass: false,
    toast: {{ session('success') ? 'true' : 'false' }},
}" class="max-w-5xl mx-auto bg-gray-950 min-h-screen -m-6 p-6">

    {{-- Toast --}}
    <div x-show="toast" x-cloak
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed bottom-6 right-6 z-50 bg-gray-800 border border-green-500/30 rounded-2xl p-4 flex items-center gap-3 shadow-2xl max-w-xs"
         x-init="if(toast) setTimeout(() => toast = false, 4000)">
        <div class="w-8 h-8 rounded-xl bg-green-500 flex items-center justify-center flex-shrink-0">
            <svg width="14" height="14" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
        </div>
        <div>
            <div class="text-white font-bold text-sm">Berhasil Diperbarui</div>
            <div class="text-gray-400 text-xs">Data profil Anda telah disimpan dengan aman.</div>
        </div>
        <button @click="toast = false" class="text-gray-500 hover:text-gray-300 ml-2">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
    </div>

    {{-- Page Header --}}
    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="font-display text-4xl font-bold text-white">Profil Admin</h1>
            <p class="text-gray-400 mt-1.5 text-sm">Manage your account credentials and personal information.</p>
        </div>
        <span class="flex items-center gap-2 bg-brand/20 border border-brand/30 text-brand text-xs font-bold px-4 py-2 rounded-full">
            <span class="w-1.5 h-1.5 rounded-full bg-brand animate-pulse"></span>
            ROLE: SUPER ADMIN
        </span>
    </div>

    <div class="grid grid-cols-2 gap-5">
        {{-- LEFT COLUMN --}}
        <div class="space-y-5">
            {{-- Personal Info --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
                <div class="flex items-start gap-4 mb-6">
                    <div class="relative">
                        <div class="w-16 h-16 rounded-2xl overflow-hidden bg-gray-700">
                            <div class="w-full h-full bg-gradient-to-br from-gray-600 to-gray-800 flex items-center justify-center text-2xl font-bold text-white">A</div>
                        </div>
                        <button class="absolute -bottom-1 -right-1 w-6 h-6 bg-brand rounded-full flex items-center justify-center hover:bg-brand-hover transition-colors">
                            <svg width="10" height="10" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </button>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-white text-base">Informasi Pribadi</h3>
                        <p class="text-gray-400 text-xs mt-0.5">Update your public facing profile information.</p>
                    </div>
                </div>

                <form action="{{ route('admin.settings.profile') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <label class="block text-[10px] font-bold tracking-wider text-gray-400 mb-1.5">NAMA LENGKAP</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $admin->nama_lengkap ?? 'Aris Setiawan') }}"
                                   class="w-full bg-gray-800 border border-gray-700 text-white text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand/40 focus:border-brand/50 transition-all placeholder-gray-600">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold tracking-wider text-gray-400 mb-1.5">NO. HP</label>
                            <input type="tel" name="no_hp" value="{{ old('no_hp', $admin->no_hp ?? '+62 812-3456-7890') }}"
                                   class="w-full bg-gray-800 border border-gray-700 text-white text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand/40 focus:border-brand/50 transition-all placeholder-gray-600">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="block text-[10px] font-bold tracking-wider text-gray-400 mb-1.5">ALAMAT EMAIL</label>
                        <input type="email" name="email" value="{{ old('email', $admin->email ?? 'aris.setiawan@joinfest.com') }}"
                               class="w-full bg-gray-800 border border-gray-700 text-white text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand/40 focus:border-brand/50 transition-all placeholder-gray-600">
                    </div>

                    <button type="submit"
                            class="bg-brand hover:bg-brand-hover text-white font-bold text-sm px-6 py-2.5 rounded-xl transition-all hover:shadow-lg hover:shadow-brand/30">
                        Simpan Perubahan
                    </button>
                </form>
            </div>

            {{-- 2FA Card --}}
            <div class="bg-gray-900 border border-brand/30 rounded-2xl p-6 flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-brand/20 flex items-center justify-center flex-shrink-0">
                    <svg width="18" height="18" fill="none" stroke="#6C47FF" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="M9 12l2 2 4-4"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-display font-bold text-white text-sm mb-1">Two-Factor Authentication</h4>
                    <p class="text-gray-400 text-xs leading-relaxed">
                        Your account is currently protected by 2FA. We recommend keeping this enabled to ensure maximum security for the JoinFest ecosystem.
                    </p>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-9 h-9 rounded-xl bg-brand/10 flex items-center justify-center">
                    <svg width="16" height="16" fill="none" stroke="#6C47FF" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21.5 2l-9.5 9.5M15 2h6.5v6.5M10 7H4a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-6"/>
                    </svg>
                </div>
                <h3 class="font-display font-bold text-white text-base">Ganti Kata Sandi</h3>
            </div>

            <form action="{{ route('admin.settings.password') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Old Password --}}
                <div class="mb-4">
                    <label class="block text-[10px] font-bold tracking-wider text-gray-400 mb-1.5">KATA SANDI LAMA</label>
                    <div class="relative">
                        <input :type="showOldPass ? 'text' : 'password'" name="current_password"
                               class="w-full bg-gray-800 border border-gray-700 text-white text-sm rounded-xl px-4 py-2.5 pr-10 focus:outline-none focus:ring-2 focus:ring-brand/40 focus:border-brand/50 transition-all"
                               placeholder="••••••••">
                        <button type="button" @click="showOldPass = !showOldPass"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-200 transition-colors">
                            <svg x-show="!showOldPass" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg x-show="showOldPass" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- New Password --}}
                <div class="mb-4">
                    <label class="block text-[10px] font-bold tracking-wider text-gray-400 mb-1.5">KATA SANDI BARU</label>
                    <div class="relative">
                        <input :type="showNewPass ? 'text' : 'password'" name="password"
                               class="w-full bg-gray-800 border border-gray-700 text-white text-sm rounded-xl px-4 py-2.5 pr-10 focus:outline-none focus:ring-2 focus:ring-brand/40 focus:border-brand/50 transition-all"
                               placeholder="Entri sandi baru">
                        <button type="button" @click="showNewPass = !showNewPass"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-200 transition-colors">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div class="mb-5">
                    <label class="block text-[10px] font-bold tracking-wider text-gray-400 mb-1.5">KONFIRMASI KATA SANDI BARU</label>
                    <div class="relative">
                        <input :type="showConfirmPass ? 'text' : 'password'" name="password_confirmation"
                               class="w-full bg-gray-800 border border-gray-700 text-white text-sm rounded-xl px-4 py-2.5 pr-10 focus:outline-none focus:ring-2 focus:ring-brand/40 focus:border-brand/50 transition-all"
                               placeholder="Ulangi sandi baru">
                        <button type="button" @click="showConfirmPass = !showConfirmPass"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-200 transition-colors">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                <polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit"
                        class="w-full bg-gray-700 hover:bg-gray-600 text-white font-bold text-sm py-3 rounded-xl transition-all mb-5">
                    Update Kata Sandi
                </button>

                {{-- Requirements --}}
                <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-2.5">
                        <span class="w-3 h-3 rounded-full bg-brand animate-pulse"></span>
                        <span class="text-[10px] font-bold tracking-wider text-gray-400">PASSWORD REQUIREMENTS</span>
                    </div>
                    <ul class="space-y-1.5 text-xs text-gray-400 list-disc list-inside">
                        <li>Minimum 12 characters</li>
                        <li>At least one uppercase and one lowercase letter</li>
                        <li>At least one numeric and one special character</li>
                    </ul>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection