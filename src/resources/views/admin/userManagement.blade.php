@extends('layouts.admin')

@section('title', 'User Management - JoinFest Admin')
@section('search_placeholder', 'Cari pengguna...')

@section('content')
<div x-data="{
    activeTab: 'pembeli',
    showModal: false,
    selectedUser: null,
    selectUser(user) { this.selectedUser = user; this.showModal = true; }
}" class="max-w-5xl mx-auto">

    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="font-display text-3xl font-bold text-gray-900 dark:text-white">Kelola Pengguna</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm">Manajemen akun pembeli, Event Organizer, dan admin platform.</p>
    </div>

    {{-- Sub Tabs --}}
    <div class="flex gap-2 mb-5">
        @foreach(['pembeli' => 'Pembeli / User', 'eo' => 'Event Organizer', 'admin' => 'Admin & Tim Ops'] as $key => $label)
        <button @click="activeTab = '{{ $key }}'"
                :class="activeTab === '{{ $key }}' ? 'bg-brand text-white shadow-lg shadow-brand/20' : 'bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-gray-700'"
                class="px-4 py-2 rounded-xl text-xs font-bold transition-all">
            {{ $label }}
        </button>
        @endforeach
    </div>

    {{-- Daftar Pembeli --}}
    <div x-show="activeTab === 'pembeli'">
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden mb-5">
            <div class="px-5 py-3.5 border-b border-gray-100 dark:border-gray-800">
                <h3 class="font-display font-bold text-base">Daftar Pembeli</h3>
            </div>
            <div class="grid grid-cols-4 px-5 py-2.5 text-[10px] font-bold tracking-wider text-gray-400 border-b border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/30">
                <span>NAMA</span><span>STATUS</span><span>NO. HP</span><span>REG. AT</span>
            </div>
            @php
            $users = [
                ['nama' => 'Aditya Herlambang', 'email' => 'aditya.h@email.com', 'status' => 'Active', 'hp' => '+62 812-3456-7890', 'reg' => 'Okt 2023', 'joined' => 'Oct 2023', 'lokasi' => 'Jakarta Selatan, Indonesia', 'tiket' => 12, 'transaksi' => 'Rp 4.5M'],
                ['nama' => 'Rina Nurhasanah', 'email' => 'rina.n@email.com', 'status' => 'Active', 'hp' => '+62 856-1122-3344', 'reg' => 'Mar 2023', 'joined' => 'Mar 2023', 'lokasi' => 'Bandung, Indonesia', 'tiket' => 7, 'transaksi' => 'Rp 2.1M'],
                ['nama' => 'Budi Prasetyo', 'email' => 'budi.p@email.com', 'status' => 'Suspended', 'hp' => '+62 821-9988-7766', 'reg' => 'Jan 2024', 'joined' => 'Jan 2024', 'lokasi' => 'Surabaya, Indonesia', 'tiket' => 3, 'transaksi' => 'Rp 750K'],
            ];
            @endphp
            @foreach($users as $user)
            <div @click="selectUser({{ json_encode($user) }})"
                 class="grid grid-cols-4 items-center px-5 py-3 border-b border-gray-50 dark:border-gray-800/50 last:border-0 hover:bg-gray-50 dark:hover:bg-gray-800/30 cursor-pointer transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand/30 to-purple-500/30 flex items-center justify-center text-xs font-bold text-brand flex-shrink-0">
                        {{ strtoupper(substr($user['nama'], 0, 1)) }}
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $user['nama'] }}</div>
                        <div class="text-xs text-gray-400">{{ $user['email'] }}</div>
                    </div>
                </div>
                <span class="text-xs font-bold px-2 py-0.5 rounded-full w-fit
                    {{ $user['status'] === 'Active' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-500' }}">
                    {{ $user['status'] }}
                </span>
                <span class="text-xs text-gray-500">{{ $user['hp'] }}</span>
                <span class="text-xs text-gray-400">{{ $user['reg'] }}</span>
            </div>
            @endforeach
            <div class="px-5 py-3 bg-gray-50 dark:bg-gray-800/30 text-xs text-gray-400">
                Menampilkan 1 - 10 dari 1,248 pembeli
            </div>
        </div>
    </div>

    {{-- EO Section --}}
    <div x-show="activeTab === 'eo'">
        <div class="mb-5">
            <h3 class="font-display font-bold text-base mb-3">Menunggu Verifikasi EO</h3>
            @php
            $eoList = [
                ['nama' => 'Spectra Jakarta', 'company' => 'PT. Spectra Kreasi Bangsa', 'submitted' => '24 Nov 2023', 'email' => 'legal@spectra.id', 'status' => 'PENDING'],
                ['nama' => 'Stellar Creative', 'company' => 'CV. Stellar Media Group', 'submitted' => '19 Nov 2023', 'email' => 'info@stellarcreative.co', 'status' => 'PENDING'],
            ];
            @endphp
            <div class="space-y-3">
                @foreach($eoList as $eo)
                <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand to-purple-700 flex items-center justify-center text-white text-xs font-bold">
                            {{ strtoupper(substr($eo['nama'], 0, 2)) }}
                        </div>
                        <div>
                            <div class="font-semibold text-sm text-gray-800 dark:text-gray-200">{{ $eo['nama'] }}</div>
                            <div class="text-xs text-gray-400 italic">{{ $eo['company'] }}</div>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500">
                        <div>Submitted: {{ $eo['submitted'] }}</div>
                        <div>Email: {{ $eo['email'] }}</div>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-orange-100 text-orange-600">{{ $eo['status'] }}</span>
                    <div class="flex gap-2">
                        <button class="bg-brand text-white text-xs font-bold px-4 py-2 rounded-xl hover:bg-brand-hover transition-all">Tinjau Dokumen</button>
                        <button class="w-8 h-8 border border-gray-200 dark:border-gray-700 rounded-xl flex items-center justify-center text-gray-400 hover:text-gray-600">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="12" cy="19" r="2"/></svg>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Admin Section --}}
    <div x-show="activeTab === 'admin'">
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6 text-center text-gray-400">
            <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" class="mx-auto mb-2 opacity-40">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Daftar Admin & Tim Ops</p>
            <p class="text-xs mt-1">Belum ada data yang ditampilkan.</p>
        </div>
    </div>

    {{-- ── USER DETAIL MODAL ── --}}
    <div x-show="showModal" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-end"
         @click.self="showModal = false">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="showModal = false"></div>
        <div x-show="showModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="relative bg-white dark:bg-gray-900 w-96 h-full overflow-y-auto shadow-2xl z-50">

            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100 dark:border-gray-800 sticky top-0 bg-white dark:bg-gray-900">
                <h3 class="font-display font-bold text-lg">Detail Pengguna</h3>
                <button @click="showModal = false" class="w-8 h-8 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 flex items-center justify-center text-gray-500 transition-colors">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="px-6 py-6">
                {{-- Avatar + Name --}}
                <div class="flex flex-col items-center mb-6">
                    <div class="relative mb-3">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center text-2xl font-bold text-white">
                            <span x-text="selectedUser ? selectedUser.nama[0] : ''"></span>
                        </div>
                        <span class="absolute bottom-1 right-1 w-4 h-4 rounded-full bg-green-400 border-2 border-white"></span>
                    </div>
                    <h4 class="font-display font-bold text-lg" x-text="selectedUser?.nama"></h4>
                    <p class="text-xs text-gray-400" x-text="'Joined: ' + (selectedUser?.joined || '')"></p>
                </div>

                {{-- Info Cards --}}
                <div class="space-y-2.5 mb-5">
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl px-4 py-3 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-brand/10 flex items-center justify-center flex-shrink-0">
                            <svg width="14" height="14" fill="none" stroke="#6C47FF" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-[10px] font-bold tracking-wider text-gray-400">EMAIL UTAMA</div>
                            <div class="text-sm font-semibold text-gray-800 dark:text-gray-200" x-text="selectedUser?.email"></div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl px-4 py-3 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                            <svg width="14" height="14" fill="none" stroke="#16a34a" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
                                <line x1="12" y1="18" x2="12.01" y2="18"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-[10px] font-bold tracking-wider text-gray-400">NOMOR WHATSAPP</div>
                            <div class="text-sm font-semibold text-gray-800 dark:text-gray-200" x-text="selectedUser?.hp"></div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl px-4 py-3 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <svg width="14" height="14" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-[10px] font-bold tracking-wider text-gray-400">LOKASI TERDAFTAR</div>
                            <div class="text-sm font-semibold text-gray-800 dark:text-gray-200" x-text="selectedUser?.lokasi"></div>
                        </div>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="text-[10px] font-bold tracking-wider text-gray-400 mb-2.5">STATISTIK AKTIVITAS</div>
                <div class="grid grid-cols-2 gap-2.5 mb-6">
                    <div class="bg-violet-50 dark:bg-violet-950/30 rounded-xl px-4 py-3">
                        <div class="font-display text-2xl font-bold text-brand" x-text="selectedUser?.tiket"></div>
                        <div class="text-[10px] font-bold tracking-wider text-brand/60 mt-0.5">TIKET DIBELI</div>
                    </div>
                    <div class="bg-violet-50 dark:bg-violet-950/30 rounded-xl px-4 py-3">
                        <div class="font-display text-xl font-bold text-brand" x-text="selectedUser?.transaksi"></div>
                        <div class="text-[10px] font-bold tracking-wider text-brand/60 mt-0.5">TOTAL TRANSAKSI</div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="space-y-2.5">
                    <button class="w-full py-3 rounded-xl bg-red-50 dark:bg-red-950/30 text-red-500 font-bold text-sm hover:bg-red-100 dark:hover:bg-red-950/50 transition-all">
                        Suspend User
                    </button>
                    <button class="w-full py-3 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 font-bold text-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition-all">
                        Reset Password
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection