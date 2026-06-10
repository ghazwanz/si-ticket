<x-admin-layout>
    <x-slot name="title">Pencairan Dana - Admin JoinFest</x-slot>
    <x-slot name="header">FINANCIAL DISBURSEMENTS</x-slot>

    <div class="space-y-6">
        {{-- Page Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Manajemen Pencairan Dana</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm font-medium">Tinjau dan proses pencairan dana acara kepada penyelenggara.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-4 py-2 rounded-2xl glass-panel text-xs font-bold text-slate-600 dark:text-slate-300">
                    <x-heroicon-o-clock class="w-4 h-4 mr-2 text-violet-500" />
                    Menunggu: {{ $payouts->where('status', 'pending')->count() }}
                </span>
            </div>
        </div>

        {{-- Filters & Search --}}
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 bg-white/50 dark:bg-slate-900/50 p-4 rounded-3xl border border-slate-200 dark:border-slate-800">
            <div class="flex items-center gap-2 overflow-x-auto scrollbar-hide">
                <a href="{{ route('admin.payouts.index', request()->except('page','status')) }}" data-link
                   class="px-5 py-2.5 rounded-2xl text-xs font-bold transition-all whitespace-nowrap {{ !$status ? 'bg-violet-600 text-white shadow-lg shadow-violet-600/20' : 'glass-panel text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Semua Pencairan Dana
                </a>
                <a href="{{ route('admin.payouts.index', array_merge(request()->except('page'), ['status' => 'pending'])) }}" data-link
                   class="px-5 py-2.5 rounded-2xl text-xs font-bold transition-all whitespace-nowrap {{ $status === 'pending' ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/20' : 'glass-panel text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Menunggu Persetujuan
                </a>
                <a href="{{ route('admin.payouts.index', array_merge(request()->except('page'), ['status' => 'processing'])) }}" data-link
                   class="px-5 py-2.5 rounded-2xl text-xs font-bold transition-all whitespace-nowrap {{ $status === 'processing' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'glass-panel text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Diproses
                </a>
                <a href="{{ route('admin.payouts.index', array_merge(request()->except('page'), ['status' => 'completed'])) }}" data-link
                   class="px-5 py-2.5 rounded-2xl text-xs font-bold transition-all whitespace-nowrap {{ $status === 'completed' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/20' : 'glass-panel text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
                    Selesai
                </a>
            </div>

            <div class="relative w-full lg:w-72" x-data="{ 
                search: '{{ request()->query('search') }}',
                updateSearch() {
                    const url = new URL(window.location.href);
                    url.searchParams.set('search', this.search);
                    url.searchParams.delete('page');
                    window.loadPage(url.toString(), true);
                }
            }">
                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400">
                    <x-heroicon-o-magnifying-glass class="w-4 h-4" />
                </div>
                <input type="text" 
                       id="payout-search"
                       x-model="search"
                       x-on:input.debounce.300ms="updateSearch()"
                       placeholder="Cari pencairan dana..." 
                       class="w-full bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-800 rounded-2xl pl-10 pr-4 py-2.5 text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all dark:text-white">
            </div>
        </div>

        @if(session('success'))
            <div class="glass-panel border-emerald-500/30 bg-emerald-500/5 p-4 rounded-2xl flex items-center gap-3 text-emerald-600 dark:text-emerald-400 text-sm font-bold animate-fade-in">
                <x-heroicon-o-check class="w-5 h-5" />
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="glass-panel border-rose-500/30 bg-rose-500/5 p-4 rounded-2xl flex items-center gap-3 text-rose-600 dark:text-rose-400 text-sm font-bold animate-fade-in">
                <x-heroicon-o-exclamation-triangle class="w-5 h-5" />
                {{ session('error') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="glass-panel rounded-[2rem] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                            <x-table-header label="Konten Acara" />
                            <x-table-header label="Penyelenggara" />
                            <x-table-header label="Net Jumlah" sort="net_amount" />
                            <x-table-header label="Status" sort="status" />
                            <th class="px-8 py-5 text-[10px] font-bold tracking-[0.2em] text-slate-400 uppercase text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                        @forelse($payouts as $payout)
                        <tr class="group hover:bg-slate-50/80 dark:hover:bg-slate-900/50 transition-colors">
                            <td class="px-8 py-5">
                                <div class="text-sm font-bold text-slate-900 dark:text-white">{{ $payout->event->name }}</div>
                                <div class="text-[11px] text-slate-400 font-medium">Dibuat: {{ $payout->created_at->format('d M Y, H:i') }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <a href="{{ route('admin.users.show', $payout->organizer) }}" class="flex flex-col group/org" data-link>
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300 group-hover/org:text-violet-500 transition-colors">{{ $payout->organizer->organizerProfile->organization_name ?? $payout->organizer->name }}</span>
                                </a>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-sm font-black text-slate-900 dark:text-white">Rp {{ number_format($payout->net_amount, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="inline-flex items-center px-3 py-1 rounded-xl text-[10px] font-bold uppercase tracking-wider border
                                    {{ $payout->status === 'completed' ? 'bg-emerald-100 text-emerald-600 border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20' : 
                                       ($payout->status === 'pending' ? 'bg-amber-100 text-amber-600 border-amber-200 dark:bg-amber-500/10 dark:text-amber-400 dark:border-amber-500/20' : 
                                       'bg-blue-100 text-blue-600 border-blue-200 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20') }}">
                                    {{ ucfirst($payout->status) }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <a href="{{ route('admin.payouts.show', $payout) }}" data-link
                                   class="px-4 py-2 rounded-xl glass-panel text-[11px] font-bold text-violet-600 dark:text-violet-400 hover:bg-violet-600 hover:text-white transition-all">
                                    Tinjau
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center">
                                <div class="flex flex-col items-center opacity-40">
                                    <span class="text-4xl mb-2">💰</span>
                                    <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Tidak ada pencairan dana ditemukan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-8 py-6 bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-200 dark:border-slate-800">
                {{ $payouts->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
