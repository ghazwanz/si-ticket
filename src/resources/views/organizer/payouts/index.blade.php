@extends('layouts.organizer')
@section('title', 'Pencairan Dana (Payout)')
@section('page-title', 'Pencairan Dana (Payout)')

@section('content')
<div class="space-y-6">
    @if($eventsWithMissingBank->isNotEmpty())
        <div class="p-4 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 text-sm font-bold flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-start gap-3">
                <x-heroicon-o-exclamation-triangle class="w-6 h-6 flex-shrink-0 mt-0.5" />
                <div>
                    <div class="font-extrabold uppercase tracking-wide">Pencairan Tertunda — Rekening Bank Belum Lengkap!</div>
                    <div class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-0.5">
                        Pencairan dana akhir untuk acara berikut diblokir karena rekening bank Anda tidak lengkap saat pencairan dibuat:
                        <ul class="list-disc list-inside mt-1 font-bold">
                            @foreach($eventsWithMissingBank as $eb)
                                <li>{{ $eb->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <a href="{{ route('organizer.settings') }}" data-link
               class="px-4 py-2 rounded-xl bg-rose-600 text-white hover:bg-rose-700 text-xs font-bold transition-all whitespace-nowrap self-start md:self-center">
                Lengkapi Data Rekening &rarr;
            </a>
        </div>
    @endif

    <div class="glass-panel rounded-2xl shadow-sm border border-white/60 dark:border-white/10 overflow-hidden">
        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex flex-col md:flex-row gap-4 items-start md:items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400">Keuangan Acara</p>
                <h3 class="mt-1 text-lg font-extrabold tracking-tight text-slate-950 dark:text-white">Status Pencairan Dana & Uang Muka</h3>
            </div>
            
            <form method="GET" action="{{ route('organizer.payouts.index') }}" class="flex flex-col sm:flex-row gap-3 w-full md:w-auto" x-data="{
                submitForm() {
                    $el.closest('form').submit();
                }
            }">
                <!-- Search Input -->
                <div class="relative w-full sm:w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <x-heroicon-o-magnifying-glass class="w-4 h-4" />
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari acara..." 
                           class="w-full pl-9 pr-3 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-medium text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition-all"
                           @change="submitForm">
                </div>

                <!-- Status Filter -->
                <select name="status" @change="submitForm" class="w-full sm:w-auto px-3 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-medium text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition-all appearance-none pr-8 relative">
                    <option value="">Semua Status</option>
                    <option value="{{ \App\Enums\EventStatus::Published->value }}" {{ request('status') === \App\Enums\EventStatus::Published->value ? 'selected' : '' }}>Dipublikasi</option>
                    <option value="{{ \App\Enums\EventStatus::Completed->value }}" {{ request('status') === \App\Enums\EventStatus::Completed->value ? 'selected' : '' }}>Selesai</option>
                    <option value="{{ \App\Enums\EventStatus::Cancelled->value }}" {{ request('status') === \App\Enums\EventStatus::Cancelled->value ? 'selected' : '' }}>Dibatalkan</option>
                </select>

                <!-- Sort Filter -->
                <select name="sort" @change="submitForm" class="w-full sm:w-auto px-3 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-medium text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition-all appearance-none pr-8 relative">
                    <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="date_desc" {{ request('sort') === 'date_desc' ? 'selected' : '' }}>Acara Terjauh</option>
                    <option value="date_asc" {{ request('sort') === 'date_asc' ? 'selected' : '' }}>Acara Terdekat</option>
                    <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                    <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                </select>
                
                <button type="submit" class="sr-only">Kirim</button>
            </form>
        </div>

        @if(session('success'))
            <div class="mx-6 mt-4 p-4 bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 rounded-xl border border-emerald-500/20 text-sm font-bold flex items-center gap-2">
                <x-heroicon-o-check class="w-5 h-5 text-emerald-500" />
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mx-6 mt-4 p-4 bg-rose-500/10 text-rose-700 dark:text-rose-300 rounded-xl border border-rose-500/20 text-sm font-bold flex items-center gap-2">
                <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-rose-500" />
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead class="bg-slate-50 dark:bg-slate-900/60 text-slate-500 text-xs uppercase tracking-widest border-b border-slate-100 dark:border-slate-800">
                    <tr>
                        <th class="px-6 py-4 font-bold">Nama Acara</th>
                        <th class="px-6 py-4 font-bold">Pendapatan Kotor</th>
                        <th class="px-6 py-4 font-bold">Uang Muka Diterima</th>
                        <th class="px-6 py-4 font-bold">Status Keuangan</th>
                        <th class="px-6 py-4 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                    @forelse($events as $event)
                        @php
                            $summary = $event->payout_summary;
                            $statusLabel = 'Belum Mencapai ';
                            $statusColor = 'text-slate-400 bg-slate-400/10 border-slate-500/20';

                            if ($event->manual_settlement_required) {
                                $statusLabel = 'Manual Settlement Required';
                                $statusColor = 'text-rose-500 bg-rose-500/10 border-rose-500/20';
                            } elseif ($event->status === \App\Enums\EventStatus::Cancelled || $event->status === 'cancelled') {
                                $statusLabel = 'Acara Dibatalkan';
                                $statusColor = 'text-slate-400 bg-slate-400/10 border-slate-500/20';
                            } elseif ($event->status === \App\Enums\EventStatus::Completed || $event->status === 'completed') {
                                $finalPayout = $event->finalPayout;
                                if ($finalPayout) {
                                    $statusLabel = match($finalPayout->status) {
                                        \App\Enums\PayoutStatus::Completed => 'Selesai',
                                        \App\Enums\PayoutStatus::Processing => 'Dicairkan (Sedang Diproses)',
                                        \App\Enums\PayoutStatus::Failed => 'Gagal (Hubungi Admin)',
                                        \App\Enums\PayoutStatus::Pending => 'Menunggu Tinjauan Akhir',
                                        default => 'Menunggu Tinjauan Akhir',
                                    };
                                    $statusColor = match($finalPayout->status) {
                                        \App\Enums\PayoutStatus::Completed => 'text-emerald-500 bg-emerald-500/10 border-emerald-500/20',
                                        \App\Enums\PayoutStatus::Processing => 'text-blue-500 bg-blue-500/10 border-blue-500/20',
                                        \App\Enums\PayoutStatus::Failed => 'text-rose-500 bg-rose-500/10 border-rose-500/20',
                                        default => 'text-amber-500 bg-amber-500/10 border-amber-500/20',
                                    };
                                } else {
                                    $statusLabel = 'Menunggu Tinjauan Akhir';
                                    $statusColor = 'text-amber-500 bg-amber-500/10 border-amber-500/20';
                                }
                            } elseif ($event->status === \App\Enums\EventStatus::Published || $event->status === 'published') {
                                if ($event->isStarted()) {
                                    $statusLabel = 'Menunggu Tinjauan Akhir';
                                    $statusColor = 'text-amber-500 bg-amber-500/10 border-amber-500/20';
                                } else {
                                    // Check active advance payouts
                                    $pendingAdvance = $event->payouts()->where('payout_type', \App\Enums\PayoutType::Advance)->where('status', \App\Enums\PayoutStatus::Pending)->exists();
                                    $processingAdvance = $event->payouts()->where('payout_type', \App\Enums\PayoutType::Advance)->where('status', \App\Enums\PayoutStatus::Processing)->exists();

                                    if ($pendingAdvance) {
                                        $statusLabel = 'Dana Muka (Dalam Tinjauan)';
                                        $statusColor = 'text-amber-500 bg-amber-500/10 border-amber-500/20';
                                    } elseif ($processingAdvance) {
                                        $statusLabel = 'Dana Muka (Sedang Diproses)';
                                        $statusColor = 'text-blue-500 bg-blue-500/10 border-blue-500/20';
                                    } else {
                                        $completedAdvances = $event->payouts()->where('payout_type', \App\Enums\PayoutType::Advance)->where('status', \App\Enums\PayoutStatus::Completed)->exists();
                                        if ($summary['gross_sales'] > 0) {
                                            if ($summary['available_advance_amount'] > 0) {
                                                $statusLabel = $completedAdvances ? 'Lunas (Bisa Ajukan Dana Muka)' : 'Bisa Ajukan Dana Muka';
                                                $statusColor = 'text-violet-500 bg-violet-500/10 border-violet-500/20';
                                            } else {
                                                $statusLabel = 'Lunas (Dana Muka Sudah Diajukan)';
                                                $statusColor = 'text-emerald-500 bg-emerald-500/10 border-emerald-500/20';
                                            }
                                        } else {
                                            $statusLabel = 'Belum Memenuhi Syarat (Tidak ada Penjualan)';
                                            $statusColor = 'text-slate-400 bg-slate-400/10 border-slate-500/20';
                                        }
                                    }
                                }
                            }
                        @endphp
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/40 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900 dark:text-white">{{ $event->name }}</div>
                                <div class="text-[11px] text-slate-400 font-medium mt-0.5">Tanggal Acara: {{ $event->event_date->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-4 font-black text-slate-900 dark:text-white">
                                Rp {{ number_format($summary['gross_sales'], 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-700 dark:text-slate-300">
                                Rp {{ number_format($summary['completed_advance_total'], 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-[10px] font-bold uppercase tracking-wider border {{ $statusColor }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('organizer.payouts.show', $event) }}" data-link class="inline-flex items-center justify-center px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-800 text-xs font-bold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-900 hover:text-violet-600 dark:hover:text-violet-400 transition-all">
                                    Rincian Keuangan
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center opacity-40">
                                    <span class="text-4xl mb-2">💰</span>
                                    <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Tidak ada acara ditemukan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($events->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-800">
                {{ $events->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
