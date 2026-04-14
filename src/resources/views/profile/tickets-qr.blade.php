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
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-[#111118]">Tiket QR Anda</h1>
                        <p class="text-[#6B6B80] text-sm mt-1">Soundwave Festival Jakarta - 12 Juli 2026</p>
                    </div>
                    <a href="{{ route('profile.order-detail', 'order-id') }}"
                        class="text-[#7C3AED] hover:text-[#6d28d9] font-medium">
                        ← Kembali ke Detail Pesanan
                    </a>
                </div>
            </div>
        </div>

        {{-- Important Info --}}
        <div class="border-b border-[#E0E0E8] bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
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
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Download Options --}}
            <div class="flex gap-4 mb-8 flex-wrap">
                <button
                    class="inline-flex items-center px-6 py-3 bg-[#7C3AED] text-white font-medium rounded-lg hover:bg-[#6d28d9] transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    Unduh QR Code
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

            {{-- Main QR Display --}}
            <div class="bg-white rounded-xl border border-[#E0E0E8] overflow-hidden mb-8">
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        {{-- QR Code Section --}}
                        <div class="lg:col-span-1 flex flex-col items-center">
                            <div class="mb-4">
                                <h2 class="text-lg font-bold text-[#111118] text-center">QR Code Anda</h2>
                                <p class="text-[#6B6B80] text-sm text-center mt-1">Scan untuk check-in & ambil
                                    merchandise</p>
                            </div>

                            <div class="p-6 bg-[#F2F2F7] rounded-lg border border-[#E0E0E8]">
                                <div
                                    class="w-56 h-56 bg-white rounded flex items-center justify-center border-2 border-[#7C3AED]">
                                    <svg class="w-40 h-40 text-[#7C3AED]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 11h8V3H3v8zm0 10h8v-8H3v8zm10 0h8v-8h-8v8zm0-18v8h8V3h-8z"></path>
                                    </svg>
                                </div>
                            </div>

                            <p class="text-[#6B6B80] text-xs text-center mt-4 max-w-xs">QR Code ini unik dan personal.
                                Jangan bagikan kepada orang lain.</p>
                        </div>

                        {{-- Details Section --}}
                        <div class="lg:col-span-2">
                            <h3 class="text-lg font-bold text-[#111118] mb-6">Detail Pesanan</h3>

                            {{-- Order Info --}}
                            <div class="space-y-4 mb-6 pb-6 border-b border-[#E0E0E8]">
                                <div class="flex justify-between">
                                    <span class="text-[#6B6B80]">Nomor Pesanan</span>
                                    <span class="font-medium text-[#111118]">#ORD-2026001230</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-[#6B6B80]">Event</span>
                                    <span class="font-medium text-[#111118]">Soundwave Festival Jakarta</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-[#6B6B80]">Tanggal</span>
                                    <span class="font-medium text-[#111118]">12 Juli 2026, 18:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-[#6B6B80]">Lokasi</span>
                                    <span class="font-medium text-[#111118]">Istora Senayan, Jakarta</span>
                                </div>
                            </div>

                            {{-- Tickets --}}
                            <div class="mb-6 pb-6 border-b border-[#E0E0E8]">
                                <h4 class="font-bold text-[#111118] mb-3">Tiket</h4>
                                <div class="space-y-2">
                                    <div class="p-3 bg-[#F2F2F7] rounded-lg">
                                        <div class="flex justify-between items-center">
                                            <span class="font-medium text-[#111118]">VIP Ticket</span>
                                            <span
                                                class="text-xs bg-[#EDE9FE] text-[#7C3AED] px-2 py-1 rounded">TKT-VIP-001234</span>
                                        </div>
                                        <p class="text-sm text-[#6B6B80] mt-1">Budi Santoso</p>
                                    </div>
                                    <div class="p-3 bg-[#F2F2F7] rounded-lg">
                                        <div class="flex justify-between items-center">
                                            <span class="font-medium text-[#111118]">Regular Ticket</span>
                                            <span
                                                class="text-xs bg-[#E3F2FD] text-[#3b82f6] px-2 py-1 rounded">TKT-REG-001235</span>
                                        </div>
                                        <p class="text-sm text-[#6B6B80] mt-1">Ani Wijaya</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Merchandise --}}
                            <div>
                                <h4 class="font-bold text-[#111118] mb-3">Merchandise Pre-order</h4>
                                <div class="space-y-2">
                                    <div class="p-3 bg-[#FFF0E6] rounded-lg border border-[#F97316]/20">
                                        <p class="font-medium text-[#111118]">Kaos Festival Soundwave - L, Putih</p>
                                        <p class="text-sm text-[#F97316] mt-1">Qty: 1</p>
                                    </div>
                                    <div class="p-3 bg-[#FFF0E6] rounded-lg border border-[#F97316]/20">
                                        <p class="font-medium text-[#111118]">Topi Festival</p>
                                        <p class="text-sm text-[#F97316] mt-1">Qty: 1</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Usage Instructions --}}
                <div class="border-t border-[#E0E0E8] bg-[#F8F8FA] px-8 py-6">
                    <h3 class="font-bold text-[#111118] mb-4">Cara Menggunakan QR Code</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 bg-[#7C3AED] text-white rounded-full flex items-center justify-center flex-shrink-0 font-bold text-sm">
                                    1</div>
                                <div>
                                    <h4 class="font-medium text-[#111118]">Check-in di Gate</h4>
                                    <p class="text-sm text-[#6B6B80] mt-1">Tampilkan QR code ini kepada petugas di gate
                                        untuk check-in acara.</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 bg-[#F97316] text-white rounded-full flex items-center justify-center flex-shrink-0 font-bold text-sm">
                                    2</div>
                                <div>
                                    <h4 class="font-medium text-[#111118]">Ambil Merchandise</h4>
                                    <p class="text-sm text-[#6B6B80] mt-1">Gunakan QR code yang sama di merchandise
                                        counter untuk mengambil pre-order.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>