@extends('layouts.admin')

@section('title', 'Event Oversight - JoinFest Admin')
@section('search_placeholder', 'Cari event...')

@section('content')
<div x-data="{ activeTab: 'semua', selectedEvent: null, showModal: false }" class="max-w-6xl mx-auto">

    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="font-display text-3xl font-bold text-gray-900 dark:text-white leading-tight">Manajemen Publikasi<br>Event</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm max-w-md">Kurasi dan validasi pengajuan event dari Event Organizer untuk menjaga kualitas ekosistem JoinFest.</p>
    </div>

    {{-- Top Section: Stats Card + Event Table --}}
    <div class="grid grid-cols-5 gap-5 mb-6">
        {{-- Stats Card --}}
        <div class="col-span-2 bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6 flex flex-col justify-between min-h-[280px]">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-2 h-2 rounded-full bg-brand animate-pulse"></span>
                    <span class="text-[10px] font-bold tracking-widest text-gray-400">KEBUTUHAN REVIEW</span>
                </div>
                <h2 class="font-display text-2xl font-bold text-white leading-tight mb-3">
                    12 Event Menunggu Persetujuan Anda Hari Ini.
                </h2>
                <p class="text-gray-400 text-xs leading-relaxed">Pastikan aset visual dan deskripsi sesuai dengan standar editorial JoinFest.</p>
            </div>
            <div>
                <button class="bg-brand hover:bg-brand-hover text-white font-bold text-sm px-5 py-2.5 rounded-xl transition-all hover:shadow-lg hover:shadow-brand/30 mb-5">
                    Mulai Review Cepat
                </button>
                <div class="flex gap-8 pt-4 border-t border-white/10">
                    <div>
                        <div class="text-[10px] text-gray-500 font-bold tracking-wider">TOTAL EVENT</div>
                        <div class="font-display text-2xl font-bold text-white mt-0.5">1,284</div>
                    </div>
                    <div>
                        <div class="text-[10px] text-gray-500 font-bold tracking-wider">LIVE NOW</div>
                        <div class="font-display text-2xl font-bold text-brand mt-0.5">452</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Event Table --}}
        <div class="col-span-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden">
            {{-- Filter Tabs --}}
            <div class="flex border-b border-gray-100 dark:border-gray-800 px-1 pt-1">
                @foreach(['semua' => 'Semua', 'review' => 'Menunggu Review', 'aktif' => 'Aktif', 'ditolak' => 'Ditolak', 'selesai' => 'Selesai'] as $key => $label)
                <button @click="activeTab = '{{ $key }}'"
                        :class="activeTab === '{{ $key }}' ? 'bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white font-semibold' : 'text-gray-400 hover:text-gray-600'"
                        class="text-xs px-3 py-2 rounded-lg mx-0.5 mb-1 transition-all">{{ $label }}</button>
                @endforeach
            </div>

            {{-- Table Header --}}
            <div class="grid grid-cols-4 px-4 py-2.5 text-[10px] font-bold tracking-wider text-gray-400 border-b border-gray-100 dark:border-gray-800">
                <span class="col-span-2">EVENT</span>
                <span>PENYELENGGARA</span>
                <span class="text-right pr-2">STATUS</span>
            </div>

            {{-- Table Rows --}}
            @php
            $events = [
                ['img' => null, 'emoji' => '🎵', 'bg' => 'from-purple-900 to-indigo-900',
                 'nama' => 'Neo-Soul Night Vol. 4', 'tanggal' => '24 Sep 2024',
                 'penyelenggara' => 'Vibe Creators Co.', 'tier' => 'Gold Partner',
                 'kategori' => 'KONSER', 'status' => 'REVIEW', 'status_color' => 'bg-orange-100 text-orange-600'],
                ['img' => null, 'emoji' => '💻', 'bg' => 'from-blue-900 to-cyan-900',
                 'nama' => 'Tech Summit 2024', 'tanggal' => '12 Okt 2024',
                 'penyelenggara' => 'InnoVent Indonesia', 'tier' => 'New EO',
                 'kategori' => 'WEBINAR', 'status' => 'AKTIF', 'status_color' => 'bg-green-100 text-green-600'],
                ['img' => null, 'emoji' => '🍜', 'bg' => 'from-yellow-900 to-orange-900',
                 'nama' => 'Bazaar Kuliner Nusantara', 'tanggal' => '05 Nov 2024',
                 'penyelenggara' => 'PT. Rasa Nusantara', 'tier' => 'Silver Partner',
                 'kategori' => 'FESTIVAL', 'status' => 'DITOLAK', 'status_color' => 'bg-red-100 text-red-600'],
            ];
            @endphp
            @foreach($events as $event)
            <div class="grid grid-cols-4 px-4 py-3 border-b border-gray-50 dark:border-gray-800/50 last:border-0 items-center hover:bg-gray-50 dark:hover:bg-gray-800/30 cursor-pointer transition-colors">
                <div class="col-span-2 flex items-center gap-3">
                    <div class="w-11 h-11 rounded-lg bg-gradient-to-br {{ $event['bg'] }} flex items-center justify-center text-lg flex-shrink-0">
                        {{ $event['emoji'] }}
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-900 dark:text-white leading-tight">{{ $event['nama'] }}</div>
                        <div class="text-xs text-gray-400 mt-0.5">{{ $event['tanggal'] }}</div>
                    </div>
                </div>
                <div>
                    <div class="text-xs font-semibold text-gray-700 dark:text-gray-300">{{ $event['penyelenggara'] }}</div>
                    <div class="text-xs text-gray-400 italic">{{ $event['tier'] }}</div>
                </div>
                <div class="flex items-center justify-end gap-1.5 pr-2">
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-purple-100 text-purple-600">{{ $event['kategori'] }}</span>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded {{ $event['status_color'] }}">{{ $event['status'] }}</span>
                </div>
            </div>
            @endforeach

            {{-- Pagination --}}
            <div class="flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-gray-800/30">
                <span class="text-xs text-gray-400">Menampilkan 3 dari 1,284 event</span>
                <div class="flex items-center gap-1">
                    <button class="w-7 h-7 rounded-lg flex items-center justify-center text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
                    </button>
                    <button class="w-7 h-7 rounded-lg bg-brand text-white text-xs font-bold">1</button>
                    <button class="w-7 h-7 rounded-lg text-gray-400 text-xs hover:bg-gray-200 dark:hover:bg-gray-700">2</button>
                    <button class="w-7 h-7 rounded-lg flex items-center justify-center text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom: Preview + Checklist --}}
    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6">
        <div class="grid grid-cols-2 gap-8">
            {{-- Preview --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <svg width="18" height="18" fill="none" stroke="#6C47FF" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <h3 class="font-display font-bold text-base">Preview Publikasi</h3>
                </div>

                <div class="rounded-xl overflow-hidden mb-4 bg-gray-900 h-44 flex items-center justify-center text-4xl">
                    🎵
                </div>

                <h4 class="font-display font-bold text-lg mb-2">Neo-Soul Night Vol. 4</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed mb-4">
                    Nikmati malam yang penuh dengan harmoni dan soul dari musisi-musisi lokal ternama. Event ini akan diselenggarakan di Jakarta Theater dengan kapasitas terbatas...
                </p>
                <div class="flex items-center gap-5 text-xs text-gray-500">
                    <span class="flex items-center gap-1.5">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        24 Sep 2024, 19:00
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Jakarta Theater
                    </span>
                </div>
            </div>

            {{-- Checklist --}}
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-display font-bold text-base">Automated Review Checklist</h3>
                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-green-100 text-green-600">AI SCANNED</span>
                </div>

                @php
                $checks = [
                    ['ok' => true, 'title' => 'Resolusi Gambar Sesuai', 'desc' => 'Thumbnail memenuhi syarat minimum 1200×800px.'],
                    ['ok' => true, 'title' => 'Kelengkapan Deskripsi', 'desc' => 'Deskripsi memiliki lebih dari 300 karakter.'],
                    ['ok' => false, 'title' => 'Verifikasi Legalitas Penyelenggara', 'desc' => 'Membutuhkan konfirmasi manual untuk sertifikat event.'],
                    ['ok' => true, 'title' => 'Kategori Relevan', 'desc' => "Tag 'Konser' sesuai dengan konten deskripsi."],
                ];
                @endphp

                <div class="space-y-3 mb-6">
                    @foreach($checks as $check)
                    <div class="flex items-start gap-3 p-3.5 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700/50">
                        @if($check['ok'])
                            <span class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg width="12" height="12" fill="none" stroke="#16a34a" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                            </span>
                        @else
                            <span class="w-6 h-6 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg width="12" height="12" fill="none" stroke="#d97706" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                                    <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                                </svg>
                            </span>
                        @endif
                        <div>
                            <div class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $check['title'] }}</div>
                            <div class="text-xs text-gray-400 mt-0.5">{{ $check['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Action Buttons --}}
                <div class="grid grid-cols-2 gap-3">
                    <button class="py-3 rounded-xl border-2 border-red-300 text-red-500 font-bold text-sm hover:bg-red-50 dark:hover:bg-red-950/30 transition-all">
                        Tolak Pengajuan
                    </button>
                    <button class="py-3 rounded-xl bg-green-600 hover:bg-green-700 text-white font-bold text-sm transition-all hover:shadow-lg hover:shadow-green-600/30">
                        Publikasikan Event
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection