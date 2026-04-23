@extends('layouts.organizer')
@section('title', 'Dashboard')
@section('page-title', 'Ringkasan Dashboard')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Selamat datang, {{ Auth::user()->name }}!</h2>
            <p class="text-gray-500">Pantau performa event Anda hari ini.</p>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Penjualan -->
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">Total Penjualan</p>
                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-2xl font-bold text-gray-900 mt-3">Rp 142.8M</p>
            <p class="text-xs text-green-600 mt-1">+12% vs bulan lalu</p>
        </div>
    </div>

    <!-- Recent Events & Ticket Distribution -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Event Terbaru</h3>
                <a href="{{ route('organizer.events.index') }}" class="text-sm text-purple-600 hover:text-purple-800 font-medium">Lihat Semua →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3 font-medium">Event</th>
                            <th class="px-4 py-3 font-medium">Tanggal</th>
                            <th class="px-4 py-3 font-medium">Status</th>
                            <th class="px-4 py-3 font-medium">Penjualan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(range(1,3) as $i)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">Neon Night Festival 2024</div>
                                <div class="text-xs text-gray-500">Jakarta International Expo</div>
                            </td>
                            <td class="px-4 py-3 text-gray-600">15 Okt 2024</td>
                            <td class="px-4 py-3"><span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span></td>
                            <td class="px-4 py-3 text-gray-900 font-medium">850/1000 Tiket</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Distribusi Tiket -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold mb-4">Distribusi Tiket</h3>
            <div class="space-y-3">
                <div class="flex items-center"><div class="w-3 h-3 rounded-full bg-purple-500 mr-2"></div><span class="text-sm">VIP Pass</span><span class="ml-auto font-medium">45%</span></div>
                <div class="flex items-center"><div class="w-3 h-3 rounded-full bg-pink-400 mr-2"></div><span class="text-sm">Early Bird</span><span class="ml-auto font-medium">30%</span></div>
                <div class="flex items-center"><div class="w-3 h-3 rounded-full bg-blue-400 mr-2"></div><span class="text-sm">Reguler</span><span class="ml-auto font-medium">25%</span></div>
            </div>
        </div>
    </div>

    {{-- Grafik dan Tabel Pendapatan 7 Hari Terakhir --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Tren Pendapatan 7 Hari Terakhir</h3>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Grafik Batang -->
            <div>
                <canvas id="revenueBarChart" class="w-full h-64"></canvas>
            </div>
            <!-- Tabel Pendapatan -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3 font-medium">Hari</th>
                            <th class="px-4 py-3 font-medium">Pendapatan (Rp)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php
                            $days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                            $revenues = [1200000, 1500000, 1000000, 1800000, 1700000, 2000000, 1900000];
                        @endphp
                        @foreach($days as $index => $day)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $day }}</td>
                            <td class="px-4 py-3 text-gray-900 font-medium">Rp {{ number_format($revenues[$index], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxBar = document.getElementById('revenueBarChart').getContext('2d');
        const revenueBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: [1200000, 1500000, 1000000, 1800000, 1700000, 2000000, 1900000],
                    backgroundColor: 'rgba(99, 102, 241, 0.8)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
    @endpush

</div>
@endsection