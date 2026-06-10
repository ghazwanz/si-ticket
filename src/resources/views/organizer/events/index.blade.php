@extends('layouts.organizer')
@section('title', 'Manajemen Acara')
@section('page-title', 'Manajemen Acara')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-organizer.stat-card label="Total Acara" value="24" meta="Bertambah 3 acara bulan ini" icon="calendar-days" tone="violet" />
        <x-organizer.stat-card label="Tiket Terjual" value="12,4 Ribu" meta="Naik 18% dibanding minggu lalu" icon="ticket" tone="emerald" />
        <x-organizer.stat-card label="Pendapatan Kotor" value="Rp 842 Juta" meta="Estimasi omzet seluruh acara" icon="banknotes" tone="sky" />
        <x-organizer.stat-card label="Acara Mendatang" value="3" meta="Dalam 30 hari ke depan" icon="clock" tone="amber" />
    </div>

    <div class="glass-panel rounded-2xl shadow-sm border border-white/60 dark:border-white/10 overflow-hidden">
        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Katalog Acara</p>
                <h3 class="mt-1 text-lg font-extrabold tracking-tight text-slate-950 dark:text-white">Daftar Acara</h3>
            </div>
            <a href="{{ route('organizer.events.create') }}" data-link class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-bold rounded-xl hover:from-violet-700 hover:to-indigo-700 transition-all shadow-sm">
                <x-heroicon-o-plus class="w-4 h-4" />
                Buat Acara Baru
            </a>
        </div>

        @if(session('status'))
            <div class="mx-6 mt-4 p-4 bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 rounded-xl border border-emerald-500/20">
                {{ session('status') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 dark:bg-slate-900/60 text-slate-500 text-xs uppercase tracking-widest">
                    <tr>
                        <th class="px-6 py-3 font-bold">Acara</th>
                        <th class="px-6 py-3 font-bold">Tanggal & Waktu</th>
                        <th class="px-6 py-3 font-bold">Lokasi</th>
                        <th class="px-6 py-3 font-bold">Okupansi</th>
                        <th class="px-6 py-3 font-bold">Status</th>
                        <th class="px-6 py-3 text-right font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($events as $event)
                    <tr class="hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900 dark:text-white">{{ $event->name }}</div>
                            <div class="text-xs text-slate-500 mt-0.5">Dibuat: {{ $event->created_at->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-slate-600 dark:text-slate-300">
                            {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}<br>
                            <span class="text-xs text-slate-500">{{ substr($event->start_time, 0, 5) }} - {{ substr($event->end_time, 0, 5) }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                            <div>{{ $event->venue_name }}</div>
                            <div class="text-xs text-slate-500">{{ $event->city }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="h-1.5 w-16 bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
                                    <div class="h-full bg-violet-600 rounded-full" style="width: {{ rand(40, 100) }}%"></div>
                                </div>
                                <span class="text-xs text-slate-500">85%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $badgeClasses = [
                                    'published' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                                    'draft' => 'bg-slate-500/10 text-slate-600 dark:text-slate-300',
                                    'awaiting_approval' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
                                    'completed' => 'bg-sky-500/10 text-sky-600 dark:text-sky-400',
                                    'awaiting_cancellation' => 'bg-orange-500/10 text-orange-600 dark:text-orange-400',
                                    'cancelled' => 'bg-rose-500/10 text-rose-600 dark:text-rose-400',
                                ];
                                $statusLabel = [
                                    'published' => 'Terbit',
                                    'draft' => 'Draf',
                                    'awaiting_approval' => 'Ditinjau',
                                    'completed' => 'Selesai',
                                    'awaiting_cancellation' => 'Proses Batal',
                                    'cancelled' => 'Dibatalkan',
                                ];
                                $badge = $badgeClasses[$event->status] ?? 'bg-slate-500/10 text-slate-600 dark:text-slate-300';
                                $label = $statusLabel[$event->status] ?? $event->status;
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold {{ $badge }}">
                                {{ $label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex items-center justify-end gap-3">
                                <a href="{{ route('organizer.events.show', $event) }}" data-link class="inline-flex items-center justify-end gap-1 text-sky-600 hover:text-sky-800 dark:text-sky-400 dark:hover:text-sky-300 font-bold">
                                    <x-heroicon-o-chart-bar class="w-4 h-4" />
                                    Detail
                                </a>
                                
                                @if(in_array($event->status, ['completed', 'cancelled', 'awaiting_cancellation']))
                                    <a href="{{ route('organizer.events.edit', $event) }}" data-link class="inline-flex items-center justify-end gap-1 text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300 font-bold">
                                        <x-heroicon-o-eye class="w-4 h-4" />
                                        Lihat
                                    </a>
                                    @if(in_array($event->status, ['completed', 'cancelled']))
                                        <x-organizer.confirm-delete
                                            :id="$event->id"
                                            :action="route('organizer.events.destroy', $event)"
                                            :name="$event->name"
                                        />
                                    @endif
                                @else
                                    <a href="{{ route('organizer.events.edit', $event) }}" data-link class="inline-flex items-center justify-end gap-1 text-violet-600 hover:text-violet-800 dark:text-violet-400 dark:hover:text-violet-300 font-bold">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                        Edit
                                    </a>
                                    <x-organizer.confirm-delete
                                        :id="$event->id"
                                        :action="route('organizer.events.destroy', $event)"
                                        :name="$event->name"
                                    />
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <x-heroicon-o-calendar-days class="mx-auto h-12 w-12 text-slate-300" />
                            <p class="mt-3 text-sm font-bold text-slate-500">Belum ada acara terdaftar.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100 dark:border-slate-800">
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection