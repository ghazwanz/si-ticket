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

                @if($event->status !== 'completed')
                    <button x-on:click="$dispatch('open-panel', 'review-event-{{ $event->id }}')" 
                            class="px-5 py-2.5 rounded-2xl glass-panel text-xs font-bold text-violet-500 hover:bg-violet-500 hover:text-white transition-all">
                        Perbarui Status
                    </button>
                @endif
            </div>
        </div>

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
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
            {{-- Intelijen Penjualan --}}
            <section class="lg:col-span-1 glass-panel p-8 rounded-[2rem] space-y-6 flex flex-col relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-5">
                    <x-heroicon-o-chart-bar class="w-24 h-24" />
                </div>

                <div class="flex items-center gap-2 mb-2">
                    <div class="w-1.5 h-4 bg-emerald-500 rounded-full"></div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Sales Performance</h3>
                </div>

                <div class="space-y-6 flex-1">
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-1">Gross Pendapatan</div>
                        <div class="text-4xl font-black text-slate-900 dark:text-white">{{ $intelligence['revenue']['formatted_gross'] }}</div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800">
                            <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Fill Rate</div>
                            <div class="text-xl font-black text-violet-500">{{ $intelligence['ticketing']['fill_rate'] }}%</div>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800">
                            <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tickets Sold</div>
                            <div class="text-xl font-black text-slate-900 dark:text-white">{{ number_format($intelligence['ticketing']['total_sold']) }}</div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                        <div class="flex justify-between items-center text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">
                            <span>Projection After Fees</span>
                            <span class="text-slate-600 dark:text-slate-300">Rp {{ number_format($intelligence['revenue']['payout_projection'], 0, ',', '.') }}</span>
                        </div>
                        <div class="w-full h-1.5 bg-slate-100 dark:bg-slate-900 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $intelligence['ticketing']['fill_rate'] }}%"></div>
                        </div>
                    </div>
                </div>
            </section>

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
                                                 style="width: {{ ($cat['sold'] / $cat['quota']) * 100 }}%"></div>
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
        </div>

        {{-- Merchandise & Activity Row --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Merchandise Items --}}
            <section class="lg:col-span-1 space-y-4">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-4 bg-fuchsia-500 rounded-full"></div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Merchandise Inventory</h3>
                </div>

                @if($event->merchandiseItems->count() > 0)
                    <div class="space-y-4">
                        @foreach($intelligence['merchandise']['items'] as $item)
                            <div class="glass-panel p-4 rounded-3xl flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-fuchsia-500/10 text-fuchsia-500 flex items-center justify-center font-bold">
                                    <x-heroicon-o-shopping-bag class="w-6 h-6" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ $item['name'] }}</div>
                                    <div class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-0.5">Rp {{ number_format($item['base_price'], 0, ',', '.') }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs font-black text-slate-900 dark:text-white">{{ $item['total_stock'] }}</div>
                                    <div class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">Stock</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="glass-panel p-12 rounded-3xl text-center opacity-40">
                        <span class="text-3xl mb-2 block">👕</span>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Belum ada merchandise terdaftar</p>
                    </div>
                @endif
            </section>

            {{-- Recent Activity / Pesanan --}}
            <section class="lg:col-span-2 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-4 bg-amber-500 rounded-full"></div>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Aliran Aktivitas Terbaru</h3>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">10 Transaksi Terakhir</span>
                </div>

                <div class="glass-panel rounded-[2rem] overflow-hidden">
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
        @include('admin.events.partials.review-modal', ['event' => $event])
    @endpush
</x-admin-layout>
