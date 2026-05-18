<x-admin-panel 
    name="create-user" 
    title="Buat Akun Baru" 
    description="Provision a new identity within the platform directory."
    width="3xl"
>

    <form id="create-user-form" x-data="{ role: 'user' }" method="POST" action="{{ route('admin.users.store') }}" class="space-y-8">
        @csrf

        {{-- Identity Section --}}
        <section id="general" class="space-y-6">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-1.5 h-4 bg-violet-500 rounded-full"></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Identitas Pribadi</h3>
            </div>
            
            <div class="grid gap-6">
                <div class="space-y-2">
                    <x-input-label for="create_name" :value="__('Nama Lengkap')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                    <x-text-input id="create_name" name="name" type="text" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('name')" required placeholder="mis. Budi Santoso" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="space-y-2">
                    <x-input-label for="create_email" :value="__('Alamat Email')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                    <x-text-input id="create_email" name="email" type="email" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('email')" required placeholder="john@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="space-y-2">
                    <x-input-label for="create_password" :value="__('Security Key (Password)')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                    <x-text-input id="create_password" name="password" type="password" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" required placeholder="Minimal 8 karakter" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>
        </section>

        <hr class="border-slate-100 dark:border-slate-800">

        {{-- Access Section --}}
        <section id="access" class="space-y-6">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-1.5 h-4 bg-violet-500 rounded-full"></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Izin dan Status</h3>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <x-input-label for="create_role" :value="__('Assigned Peran')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                    <select id="create_role" name="role" x-model="role" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 text-sm focus:ring-violet-500/20 py-3">
                        <option value="user">Pengguna / Pembeli</option>
                        <option value="organizer">Penyelenggara Acara</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <x-input-label for="create_active" :value="__('Status Akses')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                    <select id="create_active" name="is_active" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 text-sm focus:ring-violet-500/20 py-3">
                        <option value="1">Akun Aktif</option>
                        <option value="0">Ditangguhkan / Restricted</option>
                    </select>
                </div>
            </div>
        </section>

        {{-- Penyelenggara Profile Section --}}
        <section id="organizer-info" x-show="role === 'organizer'" x-transition class="space-y-6">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-1.5 h-4 bg-blue-500 rounded-full"></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Penyelenggara Profile</h3>
            </div>

            <div class="grid gap-6">
                <div class="space-y-2">
                    <x-input-label for="organization_name" :value="__('Nama Organisasi')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                    <x-text-input id="organization_name" name="organization_name" type="text" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('organization_name')" placeholder="mis. Produksi Festival Nusantara" />
                    <x-input-error :messages="$errors->get('organization_name')" class="mt-2" />
                </div>

                <div class="space-y-2">
                    <x-input-label for="phone" :value="__('Nomor Kontak')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                    <x-text-input id="phone" name="phone" type="text" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('phone')" placeholder="+62..." />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <x-input-label for="bank_name" :value="__('Nama Bank')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                        <x-text-input id="bank_name" name="bank_name" type="text" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('bank_name')" placeholder="e.g. BCA" />
                    </div>
                    <div class="space-y-2">
                        <x-input-label for="bank_account_number" :value="__('Nomor Rekening')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                        <x-text-input id="bank_account_number" name="bank_account_number" type="text" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('bank_account_number')" placeholder="00000000" />
                    </div>
                </div>

                <div class="space-y-2">
                    <x-input-label for="bank_account_name" :value="__('Nama Pemilik Rekening')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                    <x-text-input id="bank_account_name" name="bank_account_name" type="text" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('bank_account_name')" placeholder="Nama pada buku tabungan" />
                </div>
            </div>
        </section>
    </form>

    <x-slot name="footer">
        <div class="flex items-center justify-end gap-3">
            <button x-on:click="close()" class="px-6 py-3 rounded-2xl text-sm font-bold text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 transition-colors">
                Batalkan Perubahan
            </button>
            <x-primary-button form="create-user-form" class="rounded-2xl bg-violet-600 px-8 py-3 text-xs font-bold uppercase tracking-widest shadow-lg shadow-violet-600/20">
                {{ __('Buat Akun') }}
            </x-primary-button>
        </div>
    </x-slot>
</x-admin-panel>
