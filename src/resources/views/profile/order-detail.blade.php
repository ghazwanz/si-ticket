<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-semibold text-foreground tracking-tight">
                {{ __('Dashboard') }}
            </h1>
            <button
                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-md bg-primary text-primary-foreground hover:bg-primary/90 transition-colors cursor-pointer">
                <x-heroicon-o-plus-circle class="h-4 w-4" />
                Quick Create
            </button>
        </div>
    </x-slot>
    <div class="min-h-screen bg-[#F8F8FA]">
        {{-- Header Section --}}
        <div class="border-b border-[#E0E0E8] bg-white sticky top-0 z-40">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-center gap-4">
                    <a href="{{ route('profile.index') }}" class="text-[#6B6B80] hover:text-[#111118]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-[#111118]">Detail Pesanan</h1>
                        <p class="text-[#6B6B80] text-sm mt-1">#ORD-2026-001234</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Status Card --}}
            <div class="bg-[#DEF7EC] border border-[#16A34A] rounded-xl p-6 mb-8">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-[#16A34A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="font-bold text-[#16A34A]">Pembayaran Berhasil</p>
                        <p class="text-sm text-[#16A34A] opacity-75">Pesanan dikonfirmasi pada 10 Juli 2026 pukul 14:32
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Main Content --}}
                <div class="md:col-span-2">
                    {{-- Event Information --}}
                    <div class="bg-white rounded-xl border border-[#E0E0E8] p-8 mb-6">
                        <h2 class="text-lg font-bold text-[#111118] mb-6">Informasi Acara</h2>

                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-[#6B6B80]">Nama Acara</p>
                                <p class="text-lg font-bold text-[#111118]">Soundwave Festival Jakarta</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-[#6B6B80]">Tanggal & Waktu</p>
                                    <p class="font-medium text-[#111118]">12 Juli 2026</p>
                                    <p class="text-sm text-[#6B6B80]">Pukul 18:00 - 23:00</p>
                                </div>
                                <div>
                                    <p class="text-sm text-[#6B6B80]">Lokasi</p>
                                    <p class="font-medium text-[#111118]">Istora Senayan Jakarta</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tickets --}}
                    <div class="bg-white rounded-xl border border-[#E0E0E8] p-8 mb-6">
                        <h2 class="text-lg font-bold text-[#111118] mb-6">Tiket Anda</h2>

                        <div class="space-y-4">
                            @foreach(['VIP' => 'Budi Santoso', 'Regular' => 'Ani Wijaya'] as $category => $holder)
                                <div class="border border-[#E0E0E8] rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <p class="font-bold text-[#111118]">{{ $category }} Ticket</p>
                                            <p class="text-sm text-[#6B6B80]">Pemegang: {{ $holder }}</p>
                                        </div>
                                        <span
                                            class="inline-flex items-center px-3 py-1 bg-[#EDE9FE] text-[#7C3AED] text-sm font-medium rounded-full">
                                            QR Tersedia
                                        </span>
                                    </div>
                                    <p class="text-xs text-[#6B6B80] mb-3">ID Tiket: #TKT-{{ rand(100000, 999999) }}</p>
                                    <button class="text-[#7C3AED] hover:text-[#6d28d9] font-medium text-sm">
                                        Lihat QR Code →
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <button
                            class="w-full mt-6 px-4 py-3 bg-[#7C3AED] text-white font-medium rounded-lg hover:bg-[#6d28d9] transition-colors">
                            Lihat Semua Tiket QR
                        </button>
                    </div>

                    {{-- Merchandise --}}
                    <div class="bg-white rounded-xl border border-[#E0E0E8] p-8 mb-6">
                        <h2 class="text-lg font-bold text-[#111118] mb-6">Merchandise</h2>

                        <div class="space-y-4">
                            @foreach([['name' => 'Kaos Festival Soundwave', 'variant' => 'L, Putih', 'qty' => 1, 'status' => 'Pending'], ['name' => 'Topi Festival', 'variant' => 'Standar', 'qty' => 1, 'status' => 'Pending']] as $item)
                                <div class="border border-[#E0E0E8] rounded-lg p-4 flex justify-between items-start">
                                    <div>
                                        <p class="font-bold text-[#111118]">{{ $item['name'] }}</p>
                                        <p class="text-sm text-[#6B6B80] mt-1">{{ $item['variant'] }} • Qty:
                                            {{ $item['qty'] }}</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center px-3 py-1 bg-[#FFF0E6] text-[#F97316] text-sm font-medium rounded-full">
                                        {{ $item['status'] }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 p-4 bg-[#FFF0E6] rounded-lg border border-[#F97316]">
                            <p class="text-sm font-medium text-[#F97316]">💡 Merchandise akan siap diambil di counter
                                saat acara berlangsung. Tunjukkan QR code pesanan Anda untuk pengambilan.</p>
                        </div>
                    </div>
                </div>

                {{-- Sidebar: Order Summary --}}
                <div class="md:col-span-1">
                    <div class="bg-white rounded-xl border border-[#E0E0E8] p-8 sticky top-24">
                        <h3 class="text-lg font-bold text-[#111118] mb-6">Ringkasan Pesanan</h3>

                        <div class="space-y-4 pb-6 border-b border-[#E0E0E8]">
                            {{-- Tickets Subtotal --}}
                            <div>
                                <p class="text-sm text-[#6B6B80] mb-2">2x Tiket</p>
                                <div class="space-y-1">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-[#111118]">VIP</span>
                                        <span class="text-[#111118]">Rp 500.000</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-[#111118]">Regular</span>
                                        <span class="text-[#111118]">Rp 350.000</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Merchandise Subtotal --}}
                            <div>
                                <p class="text-sm text-[#6B6B80] mb-2">2x Merchandise</p>
                                <div class="space-y-1">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-[#111118]">Kaos</span>
                                        <span class="text-[#111118]">Rp 150.000</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-[#111118]">Topi</span>
                                        <span class="text-[#111118]">Rp 120.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 pt-6 pb-6 border-b border-[#E0E0E8]">
                            <div class="flex justify-between">
                                <span class="text-[#6B6B80]">Subtotal</span>
                                <span class="font-medium text-[#111118]">Rp 1.120.000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#6B6B80]">Biaya Admin</span>
                                <span class="font-medium text-[#111118]">Rp 5.000</span>
                            </div>
                        </div>

                        <div class="text-center py-4">
                            <p class="text-2xl font-bold text-[#111118]">Rp 1.125.000</p>
                            <p class="text-xs text-[#6B6B80] mt-1">Total Pembayaran</p>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="space-y-3" id="actionButtons">
                            <button
                                class="w-full px-4 py-3 bg-[#7C3AED] text-white font-medium rounded-lg hover:bg-[#6d28d9] transition-colors">
                                Unduh Invoice
                            </button>
                            <button
                                class="w-full px-4 py-3 border border-[#E0E0E8] text-[#111118] font-medium rounded-lg hover:bg-[#F8F8FA] transition-colors">
                                Hubungi Support
                            </button>
                        </div>

                        {{-- Invoice Details --}}
                        <div class="mt-8 pt-6 border-t border-[#E0E0E8]">
                            <p class="text-sm text-[#6B6B80]">Referensi Transaksi</p>
                            <p class="font-mono text-[#111118] mt-2 break-all">
                                {{ strtoupper('ORD' . \Illuminate\Support\Str::random(16)) }}</p>

                            <p class="text-sm text-[#6B6B80] mt-4">Metode Pembayaran</p>
                            <p class="font-medium text-[#111118] mt-1">GoPay</p>

                            <p class="text-sm text-[#6B6B80] mt-4">Tanggal Pembayaran</p>
                            <p class="font-medium text-[#111118] mt-1">10 Juli 2026, 14:32</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>