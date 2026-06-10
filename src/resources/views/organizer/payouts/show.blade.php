@extends('layouts.organizer')
@section('title', 'Rincian Keuangan: ' . $event->name)
@section('page-title', 'Rincian Keuangan Acara')

@section('content')
<div class="space-y-6 animate-fade-in">
    {{-- Back Link --}}
    <div>
        <a href="{{ route('organizer.payouts.index') }}" data-link class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors group">
            <div class="p-2 rounded-xl glass-panel group-hover:scale-110 transition-transform">
                <x-heroicon-o-chevron-left class="w-4 h-4" />
            </div>
            <span class="text-xs font-bold uppercase tracking-widest">Kembali ke Daftar Pencairan Dana</span>
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 rounded-xl border border-emerald-500/20 text-sm font-bold flex items-center gap-2">
            <x-heroicon-o-check class="w-5 h-5 text-emerald-500" />
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 bg-rose-500/10 text-rose-700 dark:text-rose-300 rounded-xl border border-rose-500/20 text-sm font-bold flex items-center gap-2">
            <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-rose-500" />
            {{ session('error') }}
        </div>
    @endif

    {{-- Manual Settlement Warning --}}
    @if($event->manual_settlement_required)
        <div class="p-4 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 text-sm font-bold flex items-center gap-3">
            <x-heroicon-o-exclamation-triangle class="w-6 h-6 flex-shrink-0" />
            <div>
                <div class="font-extrabold uppercase tracking-wide">Penyelesaian Keuangan Manual Diperlukan</div>
                <div class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-0.5">Acara ini telah dibatalkan setelah pembayaran uang muka selesai dicarikan. Hubungi admin JoinFest secara langsung untuk penyelesaian keuangan manual.</div>
            </div>
        </div>
    @endif

    {{-- Failed Payout Warning --}}
    @php
        $hasFailedPayout = $payouts->where('status', \App\Enums\PayoutStatus::Failed)->isNotEmpty();
    @endphp
    @if($hasFailedPayout)
        <div class="p-4 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 text-sm font-bold flex flex-col md:flex-row md:items-center justify-between gap-4 animate-fade-in">
            <div class="flex items-start gap-3">
                <x-heroicon-o-exclamation-circle class="w-6 h-6 flex-shrink-0 mt-0.5" />
                <div>
                    <div class="font-extrabold uppercase tracking-wide">Pencairan Dana Gagal!</div>
                    <div class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-0.5">Penyaluran dana ke rekening Anda mengalami kegagalan. Silakan periksa kembali data nomor rekening bank Anda di pengaturan, lalu hubungi Admin JoinFest jika detail bank Anda sudah benar.</div>
                </div>
            </div>
            <a href="{{ route('organizer.settings') }}" data-link
               class="px-4 py-2 rounded-xl bg-rose-600 text-white hover:bg-rose-700 text-xs font-bold transition-all whitespace-nowrap self-start md:self-center">
                Periksa Rekening Bank &rarr;
            </a>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">
        {{-- Financial Metrics Breakdown --}}
        <div class="lg:col-span-2 glass-panel p-6 rounded-2xl space-y-6">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400">Ringkasan Pendapatan</p>
                <h3 class="mt-1 text-lg font-extrabold tracking-tight text-slate-950 dark:text-white">Rincian Finansial Acara</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-y border-slate-100 dark:border-slate-800 py-6">
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-900/40 border border-slate-100 dark:border-slate-800">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Pendapatan Kotor</div>
                    <div class="text-xl font-black text-slate-900 dark:text-white">Rp {{ number_format($summary['gross_sales'], 0, ',', '.') }}</div>
                    <div class="text-[10px] text-slate-400 font-medium mt-1">Seluruh penjualan tiket berbayar yang lunas.</div>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-900/40 border border-slate-100 dark:border-slate-800">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Biaya Layanan ({{ $summary['fee_percentage'] }}%)</div>
                    <div class="text-xl font-black text-rose-500">Rp {{ number_format($summary['estimated_platform_fee'], 0, ',', '.') }}</div>
                    <div class="text-[10px] text-slate-400 font-medium mt-1">Potongan biaya layanan.</div>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-900/40 border border-slate-100 dark:border-slate-800">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Pendapatan Bersih (Net)</div>
                    <div class="text-xl font-black text-emerald-500">Rp {{ number_format($summary['estimated_net_sales'], 0, ',', '.') }}</div>
                    <div class="text-[10px] text-slate-400 font-medium mt-1">Total estimasi dana bersih yang akan diterima.</div>
                </div>
            </div>

            {{-- Advance Payout Math --}}
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-slate-600 dark:text-slate-400 uppercase tracking-widest">Detail Pencairan Uang Muka</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 rounded-xl bg-violet-600/5 border border-violet-500/15">
                        <div class="text-[9px] font-bold text-violet-400 uppercase tracking-widest mb-1">Maks. Batas Uang Muka ({{ $summary['advance_limit_percent'] }}%)</div>
                        <div class="text-lg font-bold text-slate-900 dark:text-white">Rp {{ number_format($summary['max_advance_limit'], 0, ',', '.') }}</div>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-900/40 border border-slate-100 dark:border-slate-800">
                        <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Uang Muka Diterima</div>
                        <div class="text-lg font-bold text-slate-700 dark:text-slate-300">Rp {{ number_format($summary['completed_advance_total'], 0, ',', '.') }}</div>
                    </div>
                    <div class="p-4 rounded-xl bg-emerald-600/5 border border-emerald-500/15">
                        <div class="text-[9px] font-bold text-emerald-500 uppercase tracking-widest mb-1">Uang Muka Tersedia</div>
                        <div class="text-lg font-black text-emerald-500">Rp {{ number_format($summary['available_advance_amount'], 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            {{-- Bank account snapshot details --}}
            @php
                $organizerProfile = $event->organizer->organizerProfile;
                $hasCompleteBank = !empty($organizerProfile?->bank_name) && !empty($organizerProfile?->bank_account_number) && !empty($organizerProfile?->bank_account_name);
            @endphp
            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-900/40 border border-slate-100 dark:border-slate-800 flex items-start gap-3">
                <x-heroicon-o-credit-card class="w-5 h-5 text-slate-400 mt-0.5" />
                <div class="space-y-1">
                    <div class="text-sm font-bold text-slate-900 dark:text-white">Informasi Rekening Penerima</div>
                    @if($hasCompleteBank)
                        <div class="text-sm text-slate-500 dark:text-slate-400">
                            {{ $organizerProfile->bank_name }} - No. Rekening: <span class="font-mono font-bold tracking-wider">{{ $organizerProfile->bank_account_number }}</span> (an. {{ $organizerProfile->bank_account_name }})
                        </div>
                        <div class="text-xs text-slate-500 italic">Untuk memperbarui rekening penerima, silakan perbarui lewat <a href="{{ route('organizer.settings') }}" class="text-violet-500 font-bold hover:underline" data-link>Halaman Pengaturan</a>.</div>
                    @else
                        <div class="text-xs text-rose-500 font-bold">Data rekening bank Anda belum lengkap!</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Pencairan uang muka tidak dapat dilakukan sebelum data rekening dilengkapi.</div>
                        <div class="mt-1">
                            <a href="{{ route('organizer.settings') }}" class="inline-flex text-xs font-bold text-violet-500 hover:underline" data-link>Lengkapi data rekening sekarang &rarr;</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Advance Request Action Form --}}
        <div class="lg:col-span-1 glass-panel p-6 rounded-2xl flex flex-col justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400">Aksi Finansial</p>
                <h3 class="mt-1 text-lg font-extrabold tracking-tight text-slate-950 dark:text-white">Ajukan Uang Muka</h3>
                
                @php
                    $isEligible = $event->status === \App\Enums\EventStatus::Published 
                        && !$event->isStarted()
                        && !$event->manual_settlement_required
                        && $summary['gross_sales'] > 0
                        && $summary['available_advance_amount'] > 0
                        && $hasCompleteBank
                        && $payouts->where('payout_type', \App\Enums\PayoutType::Advance)->whereIn('status', [\App\Enums\PayoutStatus::Pending, \App\Enums\PayoutStatus::Processing])->isEmpty();
                @endphp

                @if($isEligible)
                    <form action="{{ route('organizer.payouts.request-advance', $event) }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Jumlah Pengajuan (IDR)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 font-bold text-sm">Rp</span>
                                <input type="number" name="amount" required min="1" max="{{ $summary['available_advance_amount'] }}"
                                       class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl pl-9 pr-4 py-2.5 text-sm focus:ring-2 focus:ring-violet-500/20 dark:text-white"
                                       value="{{ old('amount', $summary['available_advance_amount']) }}">
                            </div>
                            @error('amount')
                                <p class="text-rose-500 text-[11px] mt-1 font-bold">{{ $message }}</p>
                            @enderror
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1 font-medium">Batas maksimum: Rp {{ number_format($summary['available_advance_amount'], 0, ',', '.') }}</p>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Alasan Pengajuan (Min. 20 Karakter)</label>
                            <textarea name="reason" required minlength="20" rows="4"
                                      class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-violet-500/20 dark:text-white"
                                      placeholder="Jelaskan kebutuhan operasional atau biaya persiapan acara...">{{ old('reason') }}</textarea>
                            @error('reason')
                                <p class="text-rose-500 text-[10px] mt-1 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-600 dark:text-amber-400 text-[10px] leading-relaxed font-semibold flex items-start gap-2">
                            <x-heroicon-o-exclamation-triangle class="w-4 h-4 flex-shrink-0 text-amber-500 mt-0.5" />
                            <div>
                                <span class="font-extrabold uppercase">Penting:</span> Pengajuan pembayaran awal (advance payout) tidak membebaskan Penyelenggara dari tanggung jawab atas pembatalan acara, komunikasi pembeli, atau kewajiban pengembalian dana penuh kepada pembeli tiket.
                            </div>
                        </div>

                        <button type="submit"
                                class="w-full py-3 rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-xs font-bold hover:from-violet-700 hover:to-indigo-700 transition-all shadow-md">
                            Ajukan Uang Muka Sekarang
                        </button>
                    </form>
                @else
                    <div class="mt-6 p-4 rounded-xl bg-slate-50 dark:bg-slate-900/60 border border-slate-100 dark:border-slate-800 text-xs text-slate-400 space-y-3 leading-relaxed">
                        <div class="font-bold uppercase tracking-wider text-slate-500">Kenapa tidak bisa mengajukan?</div>
                        <ul class="list-disc list-inside space-y-1 text-[11px]">
                            <li class="{{ $event->status === \App\Enums\EventStatus::Published ? 'text-emerald-500 font-bold' : 'text-slate-400' }}">Status Acara: Published</li>
                            <li class="{{ !$event->isStarted() ? 'text-emerald-500 font-bold' : 'text-rose-500 font-bold' }}">Acara Belum Dimulai</li>
                            <li class="{{ $summary['gross_sales'] > 0 ? 'text-emerald-500 font-bold' : 'text-slate-400' }}">Sudah Ada Tiket Terjual</li>
                            <li class="{{ $summary['available_advance_amount'] > 0 ? 'text-emerald-500 font-bold' : 'text-slate-400' }}">Uang Muka Tersedia > Rp 0</li>
                            <li class="{{ $hasCompleteBank ? 'text-emerald-500 font-bold' : 'text-rose-500 font-bold' }}">Data Rekening Bank Lengkap</li>
                            @php
                                $hasActiveAdvance = $payouts->where('payout_type', \App\Enums\PayoutType::Advance)->whereIn('status', [\App\Enums\PayoutStatus::Pending, \App\Enums\PayoutStatus::Processing])->isNotEmpty();
                            @endphp
                            <li class="{{ !$hasActiveAdvance ? 'text-emerald-500 font-bold' : 'text-rose-500 font-bold' }}">Tidak Ada Pengajuan Aktif</li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- History of all payouts requested --}}
    <div class="glass-panel p-6 rounded-2xl shadow-sm border border-white/60 dark:border-white/10 overflow-hidden">
        <div>
            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Riwayat Keuangan</p>
            <h3 class="mt-1 text-lg font-extrabold tracking-tight text-slate-950 dark:text-white">Riwayat Pengajuan Payout</h3>
        </div>

        <div class="overflow-x-auto mt-4">
            <table class="w-full text-left text-sm border-collapse">
                <thead class="bg-slate-50 dark:bg-slate-900/60 text-slate-500 text-xs uppercase tracking-widest border-b border-slate-100 dark:border-slate-800">
                    <tr>
                        <th class="px-6 py-3 font-bold">Tipe</th>
                        <th class="px-6 py-3 font-bold">Jumlah Diajukan</th>
                        <th class="px-6 py-3 font-bold">Jumlah Disetujui</th>
                        <th class="px-6 py-3 font-bold">Status</th>
                        <th class="px-6 py-3 font-bold">Midtrans / Ref Transfer</th>
                        <th class="px-6 py-3 font-bold">Tanggal Pengajuan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                    @forelse($payouts as $payout)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/40 transition-colors">
                            <td class="px-6 py-4 font-bold">
                                {{ $payout->payout_type?->label() ?? 'Final' }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-700 dark:text-slate-300">
                                {{ $payout->isAdvance() ? 'Rp ' . number_format($payout->requested_amount, 0, ',', '.') : '-' }}
                            </td>
                            <td class="px-6 py-4 font-black text-slate-900 dark:text-white">
                                Rp {{ number_format($payout->isAdvance() ? ($payout->approved_amount ?? 0) : $payout->net_amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-wider border {{ $payout->status->color() }}">
                                    {{ $payout->status->label() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-mono text-xs text-slate-600 dark:text-slate-400">
                                {{ $payout->midtrans_reference ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-slate-400 font-medium">
                                {{ $payout->created_at->format('d M Y, H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400 italic">
                                Belum ada riwayat pengajuan pencairan dana untuk acara ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
