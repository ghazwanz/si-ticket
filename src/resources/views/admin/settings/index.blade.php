<x-admin-layout>
    <x-slot name="title">Pengaturan - Admin JoinFest</x-slot>
    <x-slot name="header">KONFIGURASI SISTEM</x-slot>

    <div class="space-y-6">
        {{-- Header halaman --}}
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Pengaturan Admin</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm font-medium">Kelola informasi profil, preferensi, dan keamanan akun Anda.</p>
        </div>

        {{-- Read-only Profile Information --}}
        <div class="glass-panel p-8 rounded-[2rem]">
            <div class="flex items-center gap-6">
                <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-violet-600 to-indigo-600 flex items-center justify-center shadow-lg shadow-violet-600/20 text-4xl font-bold text-white shrink-0">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div class="flex-1">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $user->name }}</h3>
                            <p class="text-slate-500 dark:text-slate-400 font-medium">{{ $user->email }}</p>
                        </div>
                        <span class="px-3 py-1 bg-violet-500/10 text-violet-600 dark:text-violet-400 text-xs font-bold uppercase tracking-widest rounded-full border border-violet-500/20">
                            Administrator
                        </span>
                    </div>
                    
                    <div class="mt-6 flex flex-wrap gap-4">
                        <button x-data @click="$dispatch('open-panel', 'update-profile')" class="flex items-center gap-2 px-4 py-2 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-xl text-sm font-bold hover:bg-slate-800 dark:hover:bg-slate-100 transition-colors">
                            <x-heroicon-s-pencil-square class="w-4 h-4" />
                            Perbarui Informasi
                        </button>
                        <button x-data @click="$dispatch('open-panel', 'update-password')" class="flex items-center gap-2 px-4 py-2 glass-panel text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white rounded-xl text-sm font-bold transition-colors border border-slate-200 dark:border-slate-800">
                            <x-heroicon-s-key class="w-4 h-4" />
                            Ubah Kata Sandi
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 pt-8 border-t border-slate-200 dark:border-slate-800 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Peran Akses</span>
                    <p class="text-sm font-medium text-slate-900 dark:text-white">Administrator Sistem</p>
                </div>
                <div>
                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tanggal Bergabung</span>
                    <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->created_at->translatedFormat('d F Y') }}</p>
                </div>
                <div>
                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Status Verifikasi</span>
                    @if ($user->hasVerifiedEmail())
                        <div class="flex items-center gap-1.5 text-emerald-500 font-medium text-sm">
                            <x-heroicon-s-check-circle class="w-4 h-4" />
                            Terverifikasi
                        </div>
                    @else
                        <div class="flex items-center gap-1.5 text-amber-500 font-medium text-sm">
                            <x-heroicon-s-exclamation-triangle class="w-4 h-4" />
                            Belum Terverifikasi
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('modals')
    {{-- Update Profile Modal --}}
    <div x-data="{ open: false }" 
         @open-panel.window="if ($event.detail === 'update-profile') open = true"
         @keydown.escape.window="open = false"
         x-show="open" 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6" x-cloak>
        
        <div x-show="open" 
             x-transition.opacity 
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" 
             @click="open = false"></div>
        
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="glass-panel w-full max-w-lg rounded-[2rem] shadow-2xl relative overflow-hidden z-10 border border-slate-200 dark:border-slate-800">
             
            <div class="p-6 sm:p-8">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Perbarui Informasi</h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Ubah nama dan alamat email profil Anda.</p>
                    </div>
                    <button @click="open = false" class="p-2 text-slate-400 hover:text-slate-900 dark:hover:text-white bg-slate-100 dark:bg-slate-800 rounded-xl transition-colors">
                        <x-heroicon-o-x-mark class="w-5 h-5" />
                    </button>
                </div>

                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div class="space-y-2">
                        <x-input-label for="name" :value="__('Nama Lengkap')" class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="email" :value="__('Alamat Email')" class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-2 p-3 bg-amber-50 dark:bg-amber-500/10 rounded-xl border border-amber-200 dark:border-amber-500/20">
                                <p class="text-sm text-amber-800 dark:text-amber-200">
                                    Alamat email Anda belum diverifikasi.
                                    <button form="send-verification" class="underline font-bold hover:text-amber-900 dark:hover:text-amber-100">
                                        Kirim ulang verifikasi.
                                    </button>
                                </p>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-1 font-medium text-xs text-emerald-600 dark:text-emerald-400">
                                        Tautan verifikasi baru telah dikirim!
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100 dark:border-slate-800 mt-6">
                        <button type="button" @click="open = false" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors">
                            Batal
                        </button>
                        <x-primary-button class="rounded-xl bg-violet-600 hover:bg-violet-700 px-6 py-2.5 text-sm font-bold uppercase tracking-widest text-white border-none">
                            Simpan Perubahan
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Update Password Modal --}}
    <div x-data="{ open: false }" 
         @open-panel.window="if ($event.detail === 'update-password') open = true"
         @keydown.escape.window="open = false"
         x-show="open" 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6" x-cloak>
        
        <div x-show="open" 
             x-transition.opacity 
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" 
             @click="open = false"></div>
        
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="glass-panel w-full max-w-lg rounded-[2rem] shadow-2xl relative overflow-hidden z-10 border border-slate-200 dark:border-slate-800">
             
            <div class="p-6 sm:p-8">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Ubah Kata Sandi</h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Pastikan Anda menggunakan kata sandi yang kuat dan unik.</p>
                    </div>
                    <button @click="open = false" class="p-2 text-slate-400 hover:text-slate-900 dark:hover:text-white bg-slate-100 dark:bg-slate-800 rounded-xl transition-colors">
                        <x-heroicon-o-x-mark class="w-5 h-5" />
                    </button>
                </div>

                <form method="post" action="{{ route('password.update') }}" class="space-y-6">
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
                        <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1" />
                        <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100 dark:border-slate-800 mt-6">
                        <button type="button" @click="open = false" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors">
                            Batal
                        </button>
                        <x-primary-button class="rounded-xl bg-violet-600 hover:bg-violet-700 px-6 py-2.5 text-sm font-bold uppercase tracking-widest text-white border-none">
                            Perbarui Keamanan
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @endpush
</x-admin-layout>
