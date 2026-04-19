<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-semibold text-foreground tracking-tight">
                {{ __('Kode QR') }}
            </h1>
        </div>
    </x-slot>
    <div class="min-h-screen bg-[#F8F8FA]">
        {{-- Header Section --}}
        <div class="border-b border-[#E0E0E8] bg-white sticky top-0 z-40">
            <div class=" mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-[#111118]">Tiket QR Anda</h1>
                        <p class="text-[#6B6B80] text-sm mt-1">Soundwave Festival Jakarta - 12 Juli 2026</p>
                    </div>
                    <a href="{{ route('profile.order-detail', $orderId ?? 'order-id') }}"
                        class="text-[#7C3AED] hover:text-[#6d28d9] font-medium">
                        ← Kembali ke Detail Pesanan
                    </a>
                </div>
            </div>
        </div>

        {{-- Important Info --}}
        <div class="border-b border-[#E0E0E8] bg-white">
            <div class=" mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-[#F97316] flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div class="text-sm">
                        <p class="font-medium text-[#111118]">Penting: Simpan dan Tunjukkan QR Code Ini</p>
                        <p class="text-[#6B6B80] mt-1">QR code tidak dapat dibagikan. Hanya pemegang tiket yang dapat
                            memasuki venue. Setiap QR hanya dapat dipindai satu kali.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class=" mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Download Options --}}
            <div class="flex gap-4 mb-8 flex-wrap">
                <button
                    class="inline-flex items-center px-6 py-3 bg-[#7C3AED] text-white font-medium rounded-lg hover:bg-[#6d28d9] transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    Unduh Semua QR
                </button>
                <button
                    class="inline-flex items-center px-6 py-3 border border-[#7C3AED] text-[#7C3AED] font-medium rounded-lg hover:bg-[#EDE9FE] transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                        </path>
                    </svg>
                    Unduh sebagai PDF
                </button>
                <button
                    class="inline-flex items-center px-6 py-3 border border-[#E0E0E8] text-[#111118] font-medium rounded-lg hover:bg-[#F8F8FA] transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.684 13.342C9.589 12.438 10 11.414 10 10c0-1.657-.895-3.095-2.236-3.863m0 6.364l-.464-.464m7.208-8.147h.016V6h-.016m4 0h.016V6h-.016M15 10c0 1.657.895 3.095 2.236 3.863m0-6.726v.015h.016v-.015m-4.579 8.147h.016v.015h-.016m-4 0h.016v.015h-.016">
                        </path>
                    </svg>
                    Bagikan
                </button>
            </div>

            {{-- QR Code Grid (2 Tiket) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                {{-- VIP Ticket QR --}}
                <div class="bg-white rounded-xl border border-[#E0E0E8] overflow-hidden">
                    {{-- Header --}}
                    <div class="bg-gradient-to-r from-[#7C3AED] to-[#6d28d9] px-6 py-4">
                        <p class="text-white font-bold">VIP Ticket</p>
                        <p class="text-white/80 text-sm">Budi Santoso</p>
                    </div>

                    {{-- Content --}}
                    <div class="p-8">
                        {{-- QR Code Display --}}
                        <div class="mb-6 flex justify-center">
                            <div class="p-4 bg-[#F2F2F7] rounded-lg border border-[#E0E0E8]">
                                <div
                                    class="w-56 h-56 bg-white rounded flex items-center justify-center border-2 border-[#7C3AED]">
                                    <svg class="w-40 h-40 text-[#7C3AED]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 11h8V3H3v8zm0 10h8v-8H3v8zm10 0h8v-8h-8v8zm0-18v8h8V3h-8z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Ticket Details --}}
                        <div class="space-y-4 mb-6 pb-6 border-b border-[#E0E0E8]">
                            <div class="flex justify-between">
                                <span class="text-[#6B6B80] text-sm">Pemegang Tiket</span>
                                <span class="font-medium text-[#111118]">Budi Santoso</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#6B6B80] text-sm">ID Tiket</span>
                                <span class="font-mono text-[#111118]">#TKT-VIP-001234</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#6B6B80] text-sm">Kategori</span>
                                <span class="font-medium text-[#111118]">VIP</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#6B6B80] text-sm">Status</span>
                                <span
                                    class="inline-flex items-center px-3 py-1 bg-[#DEF7EC] text-[#16A34A] text-xs font-medium rounded-full">
                                    ✓ Valid
                                </span>
                            </div>
                        </div>

                        {{-- Event Info --}}
                        <div class="space-y-3 mb-6 pb-6 border-b border-[#E0E0E8]">
                            <div>
                                <p class="text-[#6B6B80] text-xs mb-1">ACARA</p>
                                <p class="font-bold text-[#111118]">Soundwave Festival Jakarta</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[#6B6B80] text-xs mb-1">TANGGAL</p>
                                    <p class="font-medium text-[#111118]">12 Juli 2026</p>
                                </div>
                                <div>
                                    <p class="text-[#6B6B80] text-xs mb-1">WAKTU</p>
                                    <p class="font-medium text-[#111118]">18:00</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-[#6B6B80] text-xs mb-1">LOKASI</p>
                                <p class="font-medium text-[#111118]">Istora Senayan, Jakarta</p>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex gap-3">
                            <button
                                class="flex-1 px-4 py-2 border border-[#7C3AED] text-[#7C3AED] font-medium rounded-lg hover:bg-[#EDE9FE] transition-colors text-sm">
                                Unduh
                            </button>
                            <button
                                class="flex-1 px-4 py-2 border border-[#E0E0E8] text-[#111118] font-medium rounded-lg hover:bg-[#F8F8FA] transition-colors text-sm">
                                Bagikan
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Regular Ticket QR --}}
                <div class="bg-white rounded-xl border border-[#E0E0E8] overflow-hidden">
                    {{-- Header --}}
                    <div class="bg-gradient-to-r from-[#3b82f6] to-[#1d4ed8] px-6 py-4">
                        <p class="text-white font-bold">Regular Ticket</p>
                        <p class="text-white/80 text-sm">Ani Wijaya</p>
                    </div>

                    {{-- Content --}}
                    <div class="p-8">
                        {{-- QR Code Display --}}
                        <div class="mb-6 flex justify-center">
                            <div class="p-4 bg-[#F2F2F7] rounded-lg border border-[#E0E0E8]">
                                <div
                                    class="w-56 h-56 bg-white rounded flex items-center justify-center border-2 border-[#3b82f6]">
                                    <svg class="w-40 h-40 text-[#3b82f6]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 11h8V3H3v8zm0 10h8v-8H3v8zm10 0h8v-8h-8v8zm0-18v8h8V3h-8z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Ticket Details --}}
                        <div class="space-y-4 mb-6 pb-6 border-b border-[#E0E0E8]">
                            <div class="flex justify-between">
                                <span class="text-[#6B6B80] text-sm">Pemegang Tiket</span>
                                <span class="font-medium text-[#111118]">Ani Wijaya</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#6B6B80] text-sm">ID Tiket</span>
                                <span class="font-mono text-[#111118]">#TKT-REG-001235</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#6B6B80] text-sm">Kategori</span>
                                <span class="font-medium text-[#111118]">Regular</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#6B6B80] text-sm">Status</span>
                                <span
                                    class="inline-flex items-center px-3 py-1 bg-[#DEF7EC] text-[#16A34A] text-xs font-medium rounded-full">
                                    ✓ Valid
                                </span>
                            </div>
                        </div>

                        {{-- Event Info --}}
                        <div class="space-y-3 mb-6 pb-6 border-b border-[#E0E0E8]">
                            <div>
                                <p class="text-[#6B6B80] text-xs mb-1">ACARA</p>
                                <p class="font-bold text-[#111118]">Soundwave Festival Jakarta</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[#6B6B80] text-xs mb-1">TANGGAL</p>
                                    <p class="font-medium text-[#111118]">12 Juli 2026</p>
                                </div>
                                <div>
                                    <p class="text-[#6B6B80] text-xs mb-1">WAKTU</p>
                                    <p class="font-medium text-[#111118]">18:00</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-[#6B6B80] text-xs mb-1">LOKASI</p>
                                <p class="font-medium text-[#111118]">Istora Senayan, Jakarta</p>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex gap-3">
                            <button
                                class="flex-1 px-4 py-2 border border-[#3b82f6] text-[#3b82f6] font-medium rounded-lg hover:bg-[#E3F2FD] transition-colors text-sm">
                                Unduh
                            </button>
                            <button
                                class="flex-1 px-4 py-2 border border-[#E0E0E8] text-[#111118] font-medium rounded-lg hover:bg-[#F8F8FA] transition-colors text-sm">
                                Bagikan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Merchandise Info --}}
            <div class="bg-white rounded-xl border border-[#E0E0E8] overflow-hidden">
                <div class="border-b border-[#E0E0E8] bg-gradient-to-r from-[#F97316] to-[#ea580c] px-8 py-6">
                    <h2 class="text-xl font-bold text-white">Merchandise Pre-order</h2>
                    <p class="text-white/80 text-sm mt-1">Gunakan QR tiket untuk mengambil merchandise di counter acara
                    </p>
                </div>
                <div class="p-8">
                    <div class="space-y-3">
                        <div class="p-4 bg-[#FFF0E6] rounded-lg border border-[#F97316]/20">
                            <p class="font-medium text-[#111118]">Kaos Festival Soundwave - L, Putih</p>
                            <p class="text-sm text-[#F97316] mt-1">Qty: 1</p>
                        </div>
                        <div class="p-4 bg-[#FFF0E6] rounded-lg border border-[#F97316]/20">
                            <p class="font-medium text-[#111118]">Topi Festival</p>
                            <p class="text-sm text-[#F97316] mt-1">Qty: 1</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>