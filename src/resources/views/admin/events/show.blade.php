<x-admin-layout>
    <x-slot name="title">Intelijen Acara - {{ $event->name }}</x-slot>
    <x-slot name="header">EVENT INTELLIGENCE</x-slot>

    <div class="space-y-8 animate-fade-in">
        {{-- Navigation & Quick Tindakan --}}
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.events.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors group" data-link>
                <div class="p-2 rounded-xl glass-panel group-hover:scale-110 transition-transform">
                    <x-heroicon-o-chevron-left class="w-4 h-4" />
                </div>
                <span class="text-xs font-bold uppercase tracking-widest">Kembali ke Direktori</span>
            </a>
            
            <div class="flex items-center gap-3">
                @if($event->status === 'completed')
                    @if(!$event->payout()->exists())
                        <form action="{{ route('admin.payouts.initialize', $event) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="px-5 py-2.5 rounded-2xl bg-violet-600 text-white text-xs font-bold hover:bg-violet-700 transition-all shadow-lg shadow-violet-500/20">
                                Mulai Pencairan Dana
                            </button>
                        </form>
                    @else
                        <a href="{{ route('admin.payouts.show', $event->payout) }}" data-link
                           class="px-5 py-2.5 rounded-2xl bg-emerald-600 text-white text-xs font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-500/20">
                            Lihat Intelijen Pencairan Dana
                        </a>
                    @endif
                @endif

                @if(!in_array($event->status, ['completed', 'cancelled']))
                    @if($event->status === 'awaiting_cancellation')
                        <button x-on:click="$dispatch('open-panel', 'review-cancellation-{{ $event->latestCancellationRequest?->id }}')" 
                                class="px-5 py-2.5 rounded-2xl glass-panel text-xs font-bold text-rose-500 hover:bg-rose-500 hover:text-white transition-all">
                            Tinjau Pembatalan
                        </button>
                    @else
                        <button x-on:click="$dispatch('open-panel', 'review-event-{{ $event->id }}')" 
                                class="px-5 py-2.5 rounded-2xl glass-panel text-xs font-bold text-violet-500 hover:bg-violet-500 hover:text-white transition-all">
                            Perbarui Status
                        </button>
                    @endif
                @endif
            </div>
        </div>

        @if($event->latestCancellationRequest)
            {{-- Status Pembatalan Card --}}
            <div class="glass-panel border-rose-500/30 bg-rose-500/5 p-6 rounded-[2rem] relative overflow-hidden animate-fade-in">
                <div class="flex items-start gap-4 relative z-10">
                    <div class="p-3 rounded-2xl bg-rose-500/10 text-rose-600 dark:text-rose-400 mt-1">
                        <x-heroicon-o-exclamation-triangle class="w-6 h-6" />
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-1">
                            <h3 class="text-lg font-black tracking-tight text-slate-900 dark:text-white">Status Pembatalan: {{ ucfirst($event->latestCancellationRequest->status) }}</h3>
                            <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-wider bg-rose-100 text-rose-600 dark:bg-rose-500/20 dark:text-rose-400">
                                {{ $event->latestCancellationRequest->created_at->format('d M Y') }}
                            </span>
                        </div>
                        <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mt-2 mb-4 leading-relaxed">
                            <strong class="text-slate-900 dark:text-white block mb-1 text-xs uppercase tracking-widest">Alasan Pengajuan:</strong>
                            {{ $event->latestCancellationRequest->reason }}
                        </p>

                        @if($event->latestCancellationRequest->status === 'rejected' && $event->latestCancellationRequest->rejection_reason)
                            <div class="p-4 rounded-xl bg-white/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800">
                                <strong class="text-slate-900 dark:text-white block mb-1 text-[10px] uppercase tracking-widest text-rose-500">Alasan Penolakan (Admin):</strong>
                                <p class="text-sm text-slate-600 dark:text-slate-400">{{ $event->latestCancellationRequest->rejection_reason }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        {{-- Event Hero --}}
        <div class="glass-panel p-8 rounded-[2.5rem] relative overflow-hidden">
            {{-- Decorative Background --}}
            <div class="absolute top-0 right-0 w-96 h-96 bg-violet-600/5 blur-[120px] -mr-48 -mt-48"></div>
            
            <div class="flex flex-col lg:flex-row gap-10 relative">
                <div class="w-full lg:w-[400px] aspect-video lg:aspect-square rounded-[2.5rem] overflow-hidden bg-slate-100 dark:bg-slate-900 shrink-0 shadow-2xl shadow-violet-500/10">
                    @if($event->banner_image)
                        <img src="{{ asset('storage/' . $event->banner_image) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <x-heroicon-o-photo class="w-20 h-20" />
                        </div>
                    @endif
                </div>
                
                <div class="flex-1 space-y-6">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 rounded-xl bg-violet-500/10 text-violet-500 text-[10px] font-black uppercase tracking-widest">{{ $event->category->name }}</span>
                            <span class="px-3 py-1 rounded-xl border {{ $event->status === 'published' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20' }} text-[10px] font-black uppercase tracking-widest">{{ $event->status }}</span>
                        </div>
                        <h1 class="text-4xl lg:text-5xl font-black tracking-tight text-slate-900 dark:text-white">{{ $event->name }}</h1>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="p-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500">
                                    <x-heroicon-o-map-pin class="w-4 h-4" />
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Intelijen Lokasi</div>
                                    <div class="text-sm font-bold text-slate-700 dark:text-slate-300 leading-relaxed">{{ $event->venue_name }}</div>
                                    <div class="text-xs text-slate-500 mt-1">{{ $event->city }}, {{ $event->address }}</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="p-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500">
                                    <x-heroicon-o-calendar class="w-4 h-4" />
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Jadwal Acara</div>
                                    <div class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $event->event_date->format('l, d F Y') }}</div>
                                    <div class="text-xs text-slate-500 mt-1">{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }} WIB</div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="p-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500">
                                    <x-heroicon-o-user class="w-4 h-4" />
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Penyelenggara Entity</div>
                                    <a href="{{ route('admin.users.show', $event->organizer) }}" class="text-sm font-bold text-violet-500 hover:underline">
                                        {{ $event->organizer->organizerProfile->organization_name ?? $event->organizer->name }}
                                    </a>
                                    <div class="text-xs text-slate-500 mt-1">Direct verification available in user intelligence</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Analytics & Performance Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch mb-8">
            {{-- Intelijen Penjualan --}}
            <section class="lg:col-span-3 glass-panel p-8 rounded-[2rem] space-y-6 flex flex-col relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-5">
                    <x-heroicon-o-chart-bar class="w-24 h-24" />
                </div>

                <div class="flex items-center gap-2 mb-2 relative z-10">
                    <div class="w-1.5 h-4 bg-emerald-500 rounded-full"></div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Sales Performance</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative z-10 items-center">
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-1">Gross Pendapatan</div>
                        <div class="text-4xl font-black text-slate-900 dark:text-white">{{ $intelligence['revenue']['formatted_gross'] }}</div>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 flex flex-col justify-center">
                        <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tickets Sold</div>
                        <div class="text-2xl font-black text-slate-900 dark:text-white">{{ number_format($intelligence['ticketing']['total_sold']) }} <span class="text-xs text-slate-400 font-medium ml-1">/ {{ number_format($intelligence['ticketing']['total_quota']) }}</span></div>
                    </div>
                    
                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 flex flex-col justify-center">
                        <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Merchandise Sold</div>
                        <div class="text-2xl font-black text-slate-900 dark:text-white">{{ number_format($intelligence['merchandise']['total_sold'] ?? 0) }} <span class="text-xs text-slate-400 font-medium ml-1">items</span></div>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 flex flex-col justify-center h-full">
                        <div class="flex justify-between items-center text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-2">
                            <span>Projection After Fees</span>
                            <span class="text-slate-600 dark:text-slate-300">Rp {{ number_format($intelligence['revenue']['payout_projection'], 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1 mt-2">
                            <span>Ticketing Fill Rate</span>
                            <span class="text-violet-500">{{ $intelligence['ticketing']['fill_rate'] }}%</span>
                        </div>
                        <div class="w-full h-1.5 bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $intelligence['ticketing']['fill_rate'] }}%"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        {{-- Inventory Row --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            {{-- Ticketing Categories --}}
            <section class="lg:col-span-2 glass-panel p-8 rounded-[2rem] space-y-6 flex flex-col">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-4 bg-blue-500 rounded-full"></div>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Ticketing Registry</h3>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $event->ticketCategories->count() }} Tiers Aktif</span>
                </div>

                <div class="flex-1 overflow-hidden">
                    @if($event->ticketCategories->count() > 0)
                        <div class="grid md:grid-cols-2 gap-4">
                            @foreach($intelligence['ticketing']['categories'] as $cat)
                                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 group hover:border-violet-500/30 transition-all">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <div class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-violet-500 transition-colors">{{ $cat['name'] }}</div>
                                            <div class="text-xs font-bold text-slate-500 mt-0.5">Rp {{ number_format($cat['price'], 0, ',', '.') }}</div>
                                        </div>
                                        @if($cat['is_sold_out'])
                                            <span class="px-2 py-0.5 rounded-lg bg-rose-500 text-white text-[8px] font-black uppercase tracking-widest">Sold Out</span>
                                        @endif
                                    </div>
                                    
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-[9px] font-bold uppercase tracking-widest">
                                            <span class="text-slate-400">Status Inventaris</span>
                                            <span class="text-slate-600 dark:text-slate-300">{{ $cat['sold'] }} / {{ $cat['quota'] }}</span>
                                        </div>
                                        <div class="w-full h-1 bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
                                            <div class="h-full {{ $cat['is_sold_out'] ? 'bg-rose-500' : 'bg-blue-500' }} rounded-full" 
                                                 style="width: {{ $cat['quota'] > 0 ? ($cat['sold'] / $cat['quota']) * 100 : 0 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center h-full opacity-40 py-12">
                            <span class="text-4xl mb-2">🎟️</span>
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Belum ada kategori tiket tertaut</p>
                        </div>
                    @endif
                </div>
            </section>

            {{-- Merchandise Items --}}
            <section class="lg:col-span-1 glass-panel p-8 rounded-[2rem] space-y-6 flex flex-col">
                <div class="flex items-center gap-2 mb-2">
                    <div class="w-1.5 h-4 bg-fuchsia-500 rounded-full"></div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Merchandise Inventory</h3>
                </div>

                <div class="flex-1 overflow-y-auto">
                    @if($event->merchandiseItems->count() > 0)
                        <div class="space-y-4">
                            @foreach($intelligence['merchandise']['items'] as $item)
                                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 group hover:border-fuchsia-500/30 transition-all">
                                    <div class="flex items-center gap-4 mb-4">
                                        <div class="w-10 h-10 rounded-xl bg-fuchsia-500/10 text-fuchsia-500 flex items-center justify-center font-bold shrink-0">
                                            <x-heroicon-o-shopping-bag class="w-5 h-5" />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-bold text-slate-900 dark:text-white truncate group-hover:text-fuchsia-500 transition-colors">{{ $item['name'] }}</div>
                                            <div class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-0.5">Rp {{ number_format($item['base_price'], 0, ',', '.') }}</div>
                                        </div>
                                        @if($item['total_stock'] > 0 && $item['sold'] >= $item['total_stock'])
                                            <span class="px-2 py-0.5 rounded-lg bg-rose-500 text-white text-[8px] font-black uppercase tracking-widest shrink-0">Sold Out</span>
                                        @endif
                                    </div>

                                    <div class="space-y-2">
                                        <div class="flex justify-between text-[9px] font-bold uppercase tracking-widest">
                                            <span class="text-slate-400">Terjual</span>
                                            <span class="text-slate-600 dark:text-slate-300">{{ $item['sold'] }} / {{ $item['total_stock'] }}</span>
                                        </div>
                                        <div class="w-full h-1 bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
                                            <div class="h-full {{ ($item['total_stock'] > 0 && $item['sold'] >= $item['total_stock']) ? 'bg-rose-500' : 'bg-fuchsia-500' }} rounded-full" 
                                                 style="width: {{ $item['total_stock'] > 0 ? ($item['sold'] / $item['total_stock']) * 100 : 0 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center h-full opacity-40 py-12">
                            <span class="text-4xl mb-2">👕</span>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Belum ada merchandise terdaftar</p>
                        </div>
                    @endif
                </div>
            </section>
        </div>

        {{-- Activity Row --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Recent Activity / Pesanan --}}
            <section class="lg:col-span-3 glass-panel p-8 rounded-[2rem] space-y-6 flex flex-col">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-4 bg-amber-500 rounded-full"></div>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Aliran Aktivitas Terbaru</h3>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">10 Transaksi Terakhir</span>
                </div>

                <div class="border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden">
                    @if($intelligence['activity']->count() > 0)
                        <div class="divide-y divide-slate-100 dark:divide-slate-800">
                            @foreach($intelligence['activity'] as $order)
                                <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-900/50 transition-colors flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900 flex items-center justify-center text-xs font-bold text-slate-500">
                                            {{ substr($order->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-slate-900 dark:text-white">{{ $order->user->name }}</div>
                                            <div class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">Order #{{ substr($order->id, 0, 8) }} • {{ $order->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-black text-slate-900 dark:text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[8px] font-black uppercase tracking-widest
                                            {{ $order->status === 'paid' ? 'bg-emerald-500/10 text-emerald-500' : 'bg-amber-500/10 text-amber-500' }}">
                                            {{ $order->status }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-12 text-center opacity-40">
                            <span class="text-4xl mb-2 block">📉</span>
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Menunggu Transaksi Pertama</p>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>

    @push('modals')
        @if($event->status === 'awaiting_cancellation' && $event->latestCancellationRequest)
            @include('admin.cancellations.partials.review-modal', ['cancellation' => $event->latestCancellationRequest])
        @else
            @include('admin.events.partials.review-modal', ['event' => $event])
        @endif
    @endpush
</x-admin-layout>
