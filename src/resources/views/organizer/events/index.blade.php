@extends('layouts.organizer')
@section('title', 'Manajemen Event')
@section('page-title', 'Manajemen Event')

@section('content')
<div class="space-y-6">
    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-2xl bg-white p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Total Event</p>
            <p class="text-2xl font-bold text-gray-900 mt-2">24</p>
            <p class="text-xs text-gray-400 mt-1">+3 bulan ini</p>
        </div>
        <div class="rounded-2xl bg-white p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Tiket Terjual</p>
            <p class="text-2xl font-bold text-gray-900 mt-2">12.4k</p>
            <p class="text-xs text-green-600 mt-1">18% vs minggu lalu</p>
        </div>
        <div class="rounded-2xl bg-white p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Pendapatan Kotor</p>
            <p class="text-2xl font-bold text-gray-900 mt-2">Rp 842M</p>
            <p class="text-xs text-gray-400 mt-1">Estimasi total omset</p>
        </div>
        <div class="rounded-2xl bg-white p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Event Mendatang</p>
            <p class="text-2xl font-bold text-gray-900 mt-2">3</p>
            <p class="text-xs text-gray-400 mt-1">Dalam 30 hari</p>
        </div>
    </div>

    {{-- Daftar Event --}}
    <div class="rounded-2xl bg-white shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Event</h3>
            <a href="{{ route('organizer.events.create') }}" class="inline-flex items-center gap-1.5 px-3 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-sm font-medium rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Buat Event Baru
            </a>
        </div>

        @if(session('status'))
            <div class="mx-6 mt-4 p-4 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-200">
                {{ session('status') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                    <tr>
                        <th class="px-6 py-3 font-medium">Event</th>
                        <th class="px-6 py-3 font-medium">Tanggal & Waktu</th>
                        <th class="px-6 py-3 font-medium">Lokasi</th>
                        <th class="px-6 py-3 font-medium">Okupansi</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 text-right font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($events as $event)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $event->name }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">Dibuat: {{ $event->created_at->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}<br>
                            <span class="text-xs text-gray-500">{{ substr($event->start_time, 0, 5) }} - {{ substr($event->end_time, 0, 5) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div>{{ $event->venue_name }}</div>
                            <div class="text-xs text-gray-500">{{ $event->city }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="h-1.5 w-16 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-purple-600 rounded-full" style="width: {{ rand(40, 100) }}%"></div>
                                </div>
                                <span class="text-xs text-gray-500">85%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $badgeClasses = [
                                    'published' => 'bg-emerald-100 text-emerald-700',
                                    'draft' => 'bg-gray-100 text-gray-700',
                                    'completed' => 'bg-blue-100 text-blue-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                ];
                                $statusLabel = [
                                    'published' => 'Aktif',
                                    'draft' => 'Draft',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                ];
                                $badge = $badgeClasses[$event->status] ?? 'bg-gray-100 text-gray-700';
                                $label = $statusLabel[$event->status] ?? $event->status;
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $badge }}">
                                {{ $label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="text-purple-600 hover:text-purple-800 font-medium">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-400">Belum ada event terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection