{{-- Edit User Panel --}}
<x-admin-panel 
    name="edit-user-{{ $user->id }}" 
    title="Ubah Akun" 
    description="Perbarui detail profil dan hak akses untuk {{ $user->name }}."
    width="3xl"
>

    <form id="edit-user-form-{{ $user->id }}" method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- Identity Section --}}
        <section id="edit-identity-{{ $user->id }}" class="space-y-6">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-1.5 h-4 bg-violet-500 rounded-full"></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Identitas Pribadi</h3>
            </div>
            
            <div class="grid gap-6">
                <div class="space-y-2">
                    <x-input-label for="edit_name_{{ $user->id }}" :value="__('Nama Lengkap')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                    <x-text-input id="edit_name_{{ $user->id }}" name="name" type="text" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('name', $user->name)" required />
                </div>

                <div class="space-y-2">
                    <x-input-label for="edit_email_{{ $user->id }}" :value="__('Alamat Email')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                    <x-text-input id="edit_email_{{ $user->id }}" name="email" type="email" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('email', $user->email)" required />
                </div>

                <div class="p-5 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-800">
                    <div class="flex items-center gap-2 mb-3">
                        <x-heroicon-o-lock-closed class="w-4 h-4 text-amber-500" />
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pembaruan Keamanan</p>
                    </div>
                    <x-text-input name="password" type="password" placeholder="Kosongkan jika tidak ingin mengubah kata sandi" class="block w-full !bg-transparent rounded-xl border-slate-200 dark:border-slate-800 py-2 text-sm" />
                </div>
            </div>
        </section>

        <hr class="border-slate-100 dark:border-slate-800">

        {{-- Access Section --}}
        <section id="edit-access-{{ $user->id }}" class="space-y-6">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-1.5 h-4 bg-violet-500 rounded-full"></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Izin dan Status</h3>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <x-input-label for="edit_role_{{ $user->id }}" :value="__('Assigned Peran')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                    <select id="edit_role_{{ $user->id }}" name="role" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 text-sm focus:ring-violet-500/20 py-3">
                        <option value="user" {{ $user->role->value === 'user' ? 'selected' : '' }}>Pengguna / Pembeli</option>
                        <option value="organizer" {{ $user->role->value === 'organizer' ? 'selected' : '' }}>Event Penyelenggara</option>
                        <option value="admin" {{ $user->role->value === 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>
                <div class="space-y-2" x-data="{ active: '{{ $user->is_active ? 1 : 0 }}' }">
                    <x-input-label for="edit_active_{{ $user->id }}" :value="__('Status Akun')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                    <select id="edit_active_{{ $user->id }}" name="is_active" x-model="active"
                            class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 text-sm focus:ring-violet-500/20 py-3">
                        <option value="1">Aktif Account</option>
                        <option value="0">Ditangguhkan / Restricted</option>
                    </select>
                    
                    @if($user->hasActivePaidOrders())
                        <template x-if="active == '0'">
                            <div class="mt-3 p-4 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-start gap-3 animate-fade-in">
                                <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" />
                                <div>
                                    <p class="text-[11px] font-bold text-amber-600 dark:text-amber-400 uppercase tracking-widest">Caution: Aktif Obligations</p>
                                    <p class="text-[10px] text-amber-500 mt-1 leading-relaxed">Penyelenggara ini memiliki acara aktif dengan pesanan berbayar. Penangguhan dapat mengganggu akses tiket dan penyelesaian dana.</p>
                                </div>
                            </div>
                        </template>
                    @endif
                </div>
            </div>
        </section>

        @if($user->role->value === 'organizer')
            <hr class="border-slate-100 dark:border-slate-800">

            {{-- Penyelenggara Profile Section --}}
            <section id="edit-organizer-{{ $user->id }}" class="space-y-6">
                <div class="flex items-center gap-2 mb-2">
                    <div class="w-1.5 h-4 bg-blue-500 rounded-full"></div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Penyelenggara Profile</h3>
                </div>

                <div class="grid gap-6">
                    <div class="space-y-2">
                        <x-input-label for="edit_org_name_{{ $user->id }}" :value="__('Nama Organisasi')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                        <x-text-input id="edit_org_name_{{ $user->id }}" name="organization_name" type="text" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('organization_name', $user->organizerProfile?->organization_name)" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="edit_phone_{{ $user->id }}" :value="__('Nomor Kontak')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                        <x-text-input id="edit_phone_{{ $user->id }}" name="phone" type="text" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('phone', $user->organizerProfile?->phone)" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <x-input-label for="edit_bank_name_{{ $user->id }}" :value="__('Nama Bank')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                            <x-text-input id="edit_bank_name_{{ $user->id }}" name="bank_name" type="text" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 text-slate-400 dark:border-slate-800 py-3" :value="old('bank_name', $user->organizerProfile?->bank_name)" />
                        </div>
                        <div class="space-y-2">
                            <x-input-label for="edit_bank_acc_{{ $user->id }}" :value="__('Nomor Rekening')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                            <x-text-input id="edit_bank_acc_{{ $user->id }}" name="bank_account_number" type="text" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('bank_account_number', $user->organizerProfile?->bank_account_number)" />
                        </div>
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="edit_bank_acc_name_{{ $user->id }}" :value="__('Nama Pemilik Rekening')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                        <x-text-input id="edit_bank_acc_name_{{ $user->id }}" name="bank_account_name" type="text" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 py-3" :value="old('bank_account_name', $user->organizerProfile?->bank_account_name)" />
                    </div>
                </div>
            </section>
        @endif
    </form>

    <x-slot name="footer">
        <div class="flex items-center justify-end gap-3">
            <button x-on:click="close()" class="px-6 py-3 rounded-2xl text-sm font-bold text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 transition-colors">
                Batalkan Perubahan
            </button>
            <x-primary-button form="edit-user-form-{{ $user->id }}" class="rounded-2xl bg-violet-600 px-8 py-3 text-xs font-bold uppercase tracking-widest shadow-lg shadow-violet-600/20">
                {{ __('Commit Changes') }}
            </x-primary-button>
        </div>
    </x-slot>
</x-admin-panel>

{{-- Termination / Suspension Modal --}}
<x-modal name="delete-user-{{ $user->id }}" maxWidth="md">
    @php
        $hasHistory = $user->role->value === 'organizer' && $user->events()->whereHas('orders')->exists();
        $isBlocked = $user->role->value === 'organizer' && ($user->hasPublishedEvents() || $user->hasPendingPayouts());
        $showSuspendInstead = $user->is_active && ($hasHistory || $isBlocked);
    @endphp

    <div class="p-8 text-center">
        @if($showSuspendInstead)
            <div class="w-16 h-16 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center mx-auto mb-6">
                <x-heroicon-o-shield-exclamation class="w-8 h-8" />
            </div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Batasi Akun?</h2>
            <p class="text-sm text-slate-500 mt-2 px-4">
                Deletion is blocked due to {{ $isBlocked ? 'active obligations' : 'audit history' }}. 
                Suspending <b>{{ $user->name }}</b> will restrict their access while preserving data integrity.
            </p>
        @else
            <div class="w-16 h-16 rounded-3xl bg-rose-500/10 text-rose-500 flex items-center justify-center mx-auto mb-6">
                <x-heroicon-o-exclamation-triangle class="w-8 h-8" />
            </div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $user->is_active ? 'Arsipkan Akun?' : 'Pulihkan Akses?' }}</h2>
            <p class="text-sm text-slate-500 mt-2 px-4">
                @if($user->is_active)
                    This will archive <b>{{ $user->name }}</b> and hide the account from active admin views while keeping audit records intact.
                @else
                    This will restore full access for <b>{{ $user->name }}</b> to the platform.
                @endif
            </p>
        @endif

        @if($user->role->value === 'organizer' && $user->is_active)
            <div class="mt-4 px-4">
                @if($user->hasPublishedEvents())
                    <div class="p-3 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-500 text-[10px] font-bold uppercase tracking-widest flex items-center gap-2">
                        <x-heroicon-o-x-circle class="w-4 h-4" />
                        Blocked: Aktif Dipublikasikan Events
                    </div>
                @elseif($user->hasPendingPayouts())
                    <div class="p-3 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-500 text-[10px] font-bold uppercase tracking-widest flex items-center gap-2">
                        <x-heroicon-o-x-circle class="w-4 h-4" />
                        Diblokir: Pencairan Dana Tertunda
                    </div>
                @elseif($hasHistory)
                    <div class="p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-600 text-[10px] font-bold uppercase tracking-widest flex items-start gap-2 text-left">
                        <x-heroicon-o-information-circle class="w-4 h-4 mt-0.5 shrink-0" />
                        <span>Kebutuhan Audit: Riwayat transaksi ditemukan. Gunakan penangguhan, bukan penghapusan.</span>
                    </div>
                @elseif($user->events()->exists())
                    <div class="p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-600 text-[10px] font-bold uppercase tracking-widest flex items-center gap-2">
                        <x-heroicon-o-information-circle class="w-4 h-4" />
                        Note: Historical event data remains linked for audit.
                    </div>
                @endif
            </div>
        @endif

        <div class="mt-8 flex flex-col gap-3">
            @if($showSuspendInstead || !$user->is_active)
                <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="w-full justify-center py-4 rounded-md text-xs font-bold uppercase tracking-widest transition-all active:scale-95 shadow-lg
                            {{ $user->is_active ? 'bg-amber-500 hover:bg-amber-600 text-white shadow-amber-500/20' : 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-600/20' }}">
                        {{ $user->is_active ? __('Confirm Suspension') : __('Confirm Restoration') }}
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                    @csrf
                    @method('DELETE')
                    <x-danger-button 
                        :disabled="$isBlocked"
                        class="w-full justify-center py-4 rounded-md text-xs font-bold uppercase tracking-widest bg-rose-600 hover:bg-rose-700 shadow-lg shadow-rose-600/20 transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-slate-500 disabled:shadow-none"
                    >
                        {{ __('Konfirmasi Arsip') }}
                    </x-danger-button>
                </form>
            @endif

            <x-secondary-button x-on:click="$dispatch('close')" class="justify-center py-4 rounded-2xl dark:text-black border-slate-200 dark:border-slate-800 text-xs font-bold uppercase tracking-widest">
                {{ __('Batalkan') }}
            </x-secondary-button>
        </div>
    </div>
</x-modal>
