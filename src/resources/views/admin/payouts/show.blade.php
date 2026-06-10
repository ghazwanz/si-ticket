<x-admin-layout>
    <x-slot name="title">Tinjauan Pencairan Dana - {{ $payout->event->name }}</x-slot>
    <x-slot name="header">PAYOUT INTELLIGENCE</x-slot>

    <div class="space-y-8 animate-fade-in">
        {{-- Navigation --}}
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.payouts.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors group" data-link>
                <div class="p-2 rounded-xl glass-panel group-hover:scale-110 transition-transform">
                    <x-heroicon-o-chevron-left class="w-4 h-4" />
                </div>
                <span class="text-xs font-bold uppercase tracking-widest">Kembali ke Pencairan Dana</span>
            </a>
        </div>

        @if(session('success'))
            <div class="glass-panel border-emerald-500/30 bg-emerald-500/5 p-4 rounded-2xl flex items-center gap-3 text-emerald-600 dark:text-emerald-400 text-sm font-bold">
                <x-heroicon-o-check class="w-5 h-5" />
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="glass-panel border-rose-500/30 bg-rose-500/5 p-4 rounded-2xl flex items-center gap-3 text-rose-600 dark:text-rose-400 text-sm font-bold">
                <x-heroicon-o-exclamation-triangle class="w-5 h-5" />
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
            {{-- Detail Utama --}}
            <section class="lg:col-span-2 glass-panel p-8 rounded-[2rem] space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $payout->event->name }}</h2>
                        <div class="text-sm text-slate-500 mt-1">Penyelenggara: {{ $payout->organizer->organizerProfile->organization_name ?? $payout->organizer->name }}</div>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-xl text-[10px] font-bold uppercase tracking-wider border
                        {{ $payout->status === 'completed' ? 'bg-emerald-100 text-emerald-600 border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20' : 
                           ($payout->status === 'pending' ? 'bg-amber-100 text-amber-600 border-amber-200 dark:bg-amber-500/10 dark:text-amber-400 dark:border-amber-500/20' : 
                           'bg-blue-100 text-blue-600 border-blue-200 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20') }}">
                        {{ ucfirst($payout->status) }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-y border-slate-100 dark:border-slate-800 py-6">
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Gross Pendapatan</div>
                        <div class="text-xl font-bold text-slate-700 dark:text-slate-300">Rp {{ number_format($payout->gross_amount, 0, ',', '.') }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Platform Fee ({{ $payout->fee_percentage }}%)</div>
                        <div class="text-xl font-bold text-rose-500">-Rp {{ number_format($payout->platform_fee, 0, ',', '.') }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Net Disbursement</div>
                        <div class="text-2xl font-black text-emerald-500">Rp {{ number_format($payout->net_amount, 0, ',', '.') }}</div>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Snapshot Detail Bank</h3>
                    
                    @if($payout->missing_bank_details)
                        <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 text-sm font-medium">
                            <x-heroicon-o-exclamation-circle class="w-5 h-5 inline mr-2" />
                            Missing bank details. The organizer must update their profile before this payout can be approved.
                        </div>
                    @else
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800">
                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Nama Bank</div>
                                <div class="text-sm font-bold text-slate-900 dark:text-white">{{ $payout->payout_bank_name }}</div>
                            </div>
                            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800">
                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Pemilik Rekening</div>
                                <div class="text-sm font-bold text-slate-900 dark:text-white">{{ $payout->payout_account_holder }}</div>
                            </div>
                            <div class="col-span-2 p-4 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800">
                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Nomor Rekening</div>
                                <div class="text-lg font-mono font-bold text-slate-900 dark:text-white tracking-widest">{{ $payout->payout_account_number }}</div>
                            </div>
                        </div>
                    @endif
                </div>

                @if($payout->midtrans_reference)
                <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Midtrans/Transfer Reference</div>
                    <div class="text-sm font-mono text-slate-700 dark:text-slate-300">{{ $payout->midtrans_reference }}</div>
                </div>
                @endif
            </section>

            {{-- 4-Eyes Action Panel --}}
            <section class="lg:col-span-1 glass-panel p-8 rounded-[2rem] space-y-6">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-1.5 h-4 bg-violet-500 rounded-full"></div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">4-Eyes Riwayat Audit</h3>
                </div>

                <div class="space-y-6">
                    {{-- Step 1: Tinjau --}}
                    <div class="relative pl-6 pb-6 border-l-2 {{ $payout->reviewed_by ? 'border-emerald-500' : 'border-slate-200 dark:border-slate-800' }}">
                        <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full border-4 border-white dark:border-slate-900 {{ $payout->reviewed_by ? 'bg-emerald-500' : 'bg-slate-300 dark:bg-slate-700' }}"></div>
                        
                        <div class="text-sm font-bold text-slate-900 dark:text-white">Step 1: Setujui for Disbursement</div>
                        @if($payout->reviewed_by)
                            <div class="text-xs text-slate-500 mt-1">Setujuid by: {{ $payout->reviewer->name }}</div>
                            <div class="text-[10px] text-slate-400 mt-0.5">{{ $payout->reviewed_at->format('d M Y, H:i') }}</div>
                        @elseif($payout->status === 'pending')
                            <form action="{{ route('admin.payouts.approve', $payout) }}" method="POST" class="mt-3">
                                @csrf
                                @method('PUT')
                                <button type="submit" @disabled($payout->missing_bank_details) 
                                        class="w-full py-2.5 rounded-xl bg-violet-600 text-white text-xs font-bold hover:bg-violet-700 transition-all shadow-lg shadow-violet-500/20 disabled:opacity-50 disabled:cursor-not-allowed">
                                    Setujui Pencairan Dana
                                </button>
                            </form>
                        @endif
                    </div>

                    {{-- Step 2: Disburse --}}
                    <div class="relative pl-6 border-l-2 {{ $payout->disbursed_by ? 'border-emerald-500' : 'border-transparent' }}">
                        <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full border-4 border-white dark:border-slate-900 {{ $payout->disbursed_by ? 'bg-emerald-500' : 'bg-slate-300 dark:bg-slate-700' }}"></div>
                        
                        <div class="text-sm font-bold text-slate-900 dark:text-white">Step 2: Confirm Selesai</div>
                        @if($payout->disbursed_by)
                            <div class="text-xs text-slate-500 mt-1">Confirmed by: {{ $payout->disburser->name }}</div>
                            <div class="text-[10px] text-slate-400 mt-0.5">{{ $payout->disbursed_at->format('d M Y, H:i') }}</div>
                        @elseif($payout->status === 'processing')
                            <form action="{{ route('admin.payouts.confirm', $payout) }}" method="POST" class="mt-3 space-y-3">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Transfer Reference</label>
                                    <input type="text" name="midtrans_reference" required
                                           class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-violet-500/20 dark:text-white"
                                           placeholder="e.g. TRF-123456789">
                                </div>
                                <button type="submit" 
                                        class="w-full py-2.5 rounded-xl bg-emerald-600 text-white text-xs font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/20">
                                    Tandai Selesai
                                </button>
                            </form>
                        @else
                            <div class="text-xs text-slate-400 mt-1 italic">Menunggu persetujuan...</div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-admin-layout>
