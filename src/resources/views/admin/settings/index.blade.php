<x-admin-layout>
    <x-slot name="title">Pengaturan - Admin JoinFest</x-slot>
    <x-slot name="header">KONFIGURASI SISTEM</x-slot>

    <div class="space-y-6">
        {{-- Header halaman --}}
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Pengaturan Admin</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm font-medium">Perbarui kredensial administratif dan preferensi keamanan akun Anda.</p>
        </div>

        {{-- Informasi profil --}}
        <div class="glass-panel p-8 rounded-[2rem]">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            {{ __('Informasi Profil') }}
                        </h2>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            {{ __('Perbarui informasi profil dan alamat email akun Anda.') }}
                        </p>
                    </header>

                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div class="space-y-2">
                            <x-input-label for="name" :value="__('Nama')" class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="email" :value="__('Email')" class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800" :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div>
                                    <p class="text-sm mt-2 text-slate-800 dark:text-slate-200">
                                        {{ __('Alamat email Anda belum diverifikasi.') }}

                                        <button form="send-verification" class="underline text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-slate-800">
                                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="rounded-xl bg-violet-600 hover:bg-violet-700 px-6 py-2.5 text-xs font-bold uppercase tracking-widest">{{ __('Simpan Perubahan') }}</x-primary-button>

                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-slate-600 dark:text-slate-400"
                                >{{ __('Tersimpan.') }}</p>
                            @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>

        {{-- Perbarui kata sandi --}}
        <div class="glass-panel p-8 rounded-[2rem]">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            {{ __('Perbarui Kata Sandi') }}
                        </h2>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang, acak, dan aman.') }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div class="space-y-2">
                            <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')" class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1" />
                            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800" autocomplete="current-password" />
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1" />
                            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1" />
                            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="rounded-xl bg-violet-600 hover:bg-violet-700 px-6 py-2.5 text-xs font-bold uppercase tracking-widest">{{ __('Perbarui Keamanan') }}</x-primary-button>

                            @if (session('status') === 'password-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-slate-600 dark:text-slate-400"
                                >{{ __('Keamanan diperbarui.') }}</p>
                            @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-admin-layout>
