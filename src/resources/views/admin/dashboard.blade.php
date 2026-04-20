@extends('layouts.admin')

@section('title', 'Dashboard - JoinFest Admin')
@section('search_placeholder', 'Cari data...')

@section('content')
<div class="max-w-5xl mx-auto">

    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="font-display text-3xl font-bold text-gray-900 dark:text-white">Selamat Datang, Admin</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm">Overview performa platform JoinFest hari ini.</p>
    </div>

    {{-- Alert Cards --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        {{-- Event Review Alert --}}
        <div class="bg-orange-50 dark:bg-orange-950/30 border border-orange-200 dark:border-orange-900/50 rounded-2xl p-5 flex items-center justify-between">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-orange-500/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg width="18" height="18" fill="none" stroke="#f97316" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                        <rect x="9" y="3" width="6" height="4" rx="1"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 dark:text-white text-sm leading-snug">12 event menunggu persetujuanmu</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Tinjau sekarang sebelum batas waktu.</p>
                </div>
            </div>
            <a href="{{ route('admin.events') }}" class="text-orange-600 dark:text-orange-400 text-xs font-bold whitespace-nowrap flex items-center gap-1 hover:gap-2 transition-all">
                Tinjau Sekarang
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        {{-- EO Verification Alert --}}
        <div class="bg-violet-50 dark:bg-violet-950/30 border border-violet-200 dark:border-violet-900/50 rounded-2xl p-5 flex items-center justify-between">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-violet-500/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg width="18" height="18" fill="none" stroke="#8b5cf6" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 dark:text-white text-sm leading-snug">8 EO baru menunggu verifikasi</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Pastikan kelengkapan dokumen legal.</p>
                </div>
            </div>
            <a href="{{ route('admin.users') }}" class="text-violet-600 dark:text-violet-400 text-xs font-bold whitespace-nowrap flex items-center gap-1 hover:gap-2 transition-all">
                Verifikasi EO
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-4 gap-4 mb-6">
        @php
        $stats = [
            ['label' => 'TOTAL PENGGUNA', 'value' => '12,842', 'badge' => '+12%', 'badge_color' => 'text-green-600 bg-green-100', 'icon_color' => '#6C47FF',
             'icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>'],
            ['label' => 'EVENT REVIEW', 'value' => '12', 'badge' => 'Tinjau', 'badge_color' => 'text-orange-600 bg-orange-100', 'icon_color' => '#f97316',
             'icon' => '<path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>'],
            ['label' => 'EVENT AKTIF', 'value' => '342', 'badge' => 'Live', 'badge_color' => 'text-blue-600 bg-blue-100', 'icon_color' => '#3b82f6',
             'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>'],
            ['label' => 'EO PENDING', 'value' => '08', 'badge' => 'New', 'badge_color' => 'text-purple-600 bg-purple-100', 'icon_color' => '#8b5cf6',
             'icon' => '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>'],
        ];
        @endphp
        @foreach($stats as $stat)
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-4">
                <svg width="22" height="22" fill="none" stroke="{{ $stat['icon_color'] }}" stroke-width="1.8" viewBox="0 0 24 24">{!! $stat['icon'] !!}</svg>
                <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ $stat['badge_color'] }}">{{ $stat['badge'] }}</span>
            </div>
            <div class="text-[11px] font-bold tracking-wider text-gray-400 mb-1">{{ $stat['label'] }}</div>
            <div class="font-display text-2xl font-bold text-gray-900 dark:text-white">{{ $stat['value'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Bottom Row --}}
    <div class="grid grid-cols-3 gap-4">
        {{-- Activity Log --}}
        <div class="col-span-2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-5">
                <h3 class="font-display font-bold text-base">Recent Activity Log</h3>
                <a href="#" class="text-brand text-xs font-bold hover:underline">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-3 text-[10px] font-bold tracking-wider text-gray-400 pb-2 border-b border-gray-100 dark:border-gray-800 mb-1">
                <span>ACTION</span><span>USER</span><span>TIMESTAMP</span>
            </div>
            @php
            $logs = [
                ['icon' => '✓', 'color' => 'bg-green-100 text-green-600', 'action' => 'Event "Jakarta Tech Expo" approved', 'user' => 'Admin Utama', 'time' => '2 mins ago'],
                ['icon' => '👤', 'color' => 'bg-purple-100 text-purple-600', 'action' => 'New EO Registration: Stellar Creative', 'user' => 'System', 'time' => '15 mins ago'],
                ['icon' => '⚑', 'color' => 'bg-red-100 text-red-600', 'action' => 'Flagged review on "Jazz Night"', 'user' => 'Moderator B', 'time' => '42 mins ago'],
                ['icon' => '✎', 'color' => 'bg-blue-100 text-blue-600', 'action' => 'Updated system permissions', 'user' => 'Super Admin', 'time' => '1 hour ago'],
            ];
            @endphp
            @foreach($logs as $log)
            <div class="grid grid-cols-3 items-center py-3 border-b border-gray-50 dark:border-gray-800/50 last:border-0">
                <div class="flex items-center gap-2.5">
                    <span class="w-6 h-6 rounded-full {{ $log['color'] }} flex items-center justify-center text-[10px] font-bold flex-shrink-0">{{ $log['icon'] }}</span>
                    <span class="text-xs text-gray-700 dark:text-gray-300">{{ $log['action'] }}</span>
                </div>
                <span class="text-xs text-gray-500">{{ $log['user'] }}</span>
                <span class="text-xs text-gray-400">{{ $log['time'] }}</span>
            </div>
            @endforeach
        </div>

        {{-- Right Column --}}
        <div class="flex flex-col gap-4">
            {{-- Tiket Terjual --}}
            <div class="bg-brand rounded-2xl p-5">
                <div class="text-white/70 text-xs font-semibold mb-1">Tiket Terjual (24j)</div>
                <div class="font-display text-3xl font-bold text-white mb-2">1,204</div>
                <span class="bg-white/20 text-white text-xs font-bold px-3 py-1 rounded-full">↗ +18% Hari ini</span>
            </div>

            {{-- Distribusi Event --}}
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-5 flex-1">
                <h3 class="font-display font-bold text-sm mb-4">Distribusi Event</h3>
                @php
                $distribusi = [
                    ['label' => 'Music & Concerts', 'pct' => 45, 'color' => 'bg-brand'],
                    ['label' => 'Conferences', 'pct' => 30, 'color' => 'bg-blue-500'],
                    ['label' => 'Sports', 'pct' => 25, 'color' => 'bg-gray-300 dark:bg-gray-600'],
                ];
                @endphp
                @foreach($distribusi as $d)
                <div class="mb-3 last:mb-0">
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-gray-600 dark:text-gray-400">{{ $d['label'] }}</span>
                        <span class="font-semibold">{{ $d['pct'] }}%</span>
                    </div>
                    <div class="h-1.5 bg-gray-100 dark:bg-gray-800 rounded-full">
                        <div class="h-full {{ $d['color'] }} rounded-full" style="width:{{ $d['pct'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection