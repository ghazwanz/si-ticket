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
                        <h1 class="text-2xl font-bold text-[#111118]">Pemindai QR</h1>
                        <p class="text-[#6B6B80] text-sm mt-1">Soundwave Festival Jakarta - 12 Juli 2026</p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-[#111118]">14:32</p>
                        <p class="text-[#6B6B80] text-sm">Waktu Real-time</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats Bar --}}
        <div class="border-b border-[#E0E0E8] bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="grid grid-cols-4 gap-4">
                    <div class="text-center">
                        <p class="text-[#6B6B80] text-sm font-medium">Check-in Hari Ini</p>
                        <p class="text-2xl font-bold text-[#111118]">342</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[#6B6B80] text-sm font-medium">Total Tiket</p>
                        <p class="text-2xl font-bold text-[#111118]">1,245</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[#6B6B80] text-sm font-medium">Persentase Check-in</p>
                        <p class="text-2xl font-bold text-[#16A34A]">27.5%</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[#6B6B80] text-sm font-medium">Merchandise Diambil</p>
                        <p class="text-2xl font-bold text-[#111118]">156</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Scanner Section (Side by Side) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                {{-- Check-in Scanner --}}
                <div class="bg-white rounded-xl border border-[#E0E0E8] p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-lg bg-[#EDE9FE] flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#7C3AED]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-[#111118]">Check-in Masuk</h2>
                            <p class="text-sm text-[#6B6B80]">Pindai tiket pengunjung</p>
                        </div>
                    </div>

                    {{-- QR Input --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-[#111118] mb-2">Pindai QR Tiket</label>
                        
                        {{-- Camera Scanner Visual --}}
                        <div class="relative w-full bg-[#111118] rounded-lg overflow-hidden border-2 border-[#7C3AED] aspect-video flex items-center justify-center cursor-pointer hover:border-[#6d28d9] transition-colors"
                            id="checkinScanner" onclick="document.getElementById('checkinInput').focus()">
                            {{-- Scanning Area --}}
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#7C3AED]/10 to-transparent"></div>
                            
                            {{-- Corner Markers --}}
                            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 400 300" fill="none">
                                {{-- Top Left --}}
                                <path d="M 20 20 L 20 80 M 20 20 L 80 20" stroke="#7C3AED" stroke-width="3" stroke-linecap="round"/>
                                {{-- Top Right --}}
                                <path d="M 380 20 L 380 80 M 380 20 L 320 20" stroke="#7C3AED" stroke-width="3" stroke-linecap="round"/>
                                {{-- Bottom Left --}}
                                <path d="M 20 280 L 20 220 M 20 280 L 80 280" stroke="#7C3AED" stroke-width="3" stroke-linecap="round"/>
                                {{-- Bottom Right --}}
                                <path d="M 380 280 L 380 220 M 380 280 L 320 280" stroke="#7C3AED" stroke-width="3" stroke-linecap="round"/>
                            </svg>

                            {{-- Content --}}
                            <div class="text-center z-10">
                                <svg class="w-16 h-16 text-[#7C3AED] mx-auto mb-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <p class="text-white font-bold">Arahkan Kamera</p>
                                <p class="text-[#7C3AED]/80 text-xs mt-1">ke QR Code</p>
                            </div>
                        </div>

                        {{-- Hidden Input untuk scan data --}}
                        <input type="text" id="checkinInput"
                            class="opacity-0 h-0 w-0 pointer-events-none"
                            placeholder="hidden">
                    </div>

                    {{-- Display Result --}}
                    <div id="checkinResult" class="mb-6 hidden">
                        <div class="bg-[#EDE9FE] rounded-lg p-6 border border-[#7C3AED]">
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-[#16A34A] flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="flex-1">
                                    <h3 class="font-bold text-[#111118]">Check-in Berhasil! ✓</h3>
                                    <div class="mt-3 space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-[#6B6B80]">Nama Pengunjung:</span>
                                            <span class="font-medium text-[#111118]" id="visitorName">Budi
                                                Santoso</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-[#6B6B80]">Kategori Tiket:</span>
                                            <span class="font-medium text-[#111118]" id="ticketCategory">VIP</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-[#6B6B80]">Jam Check-in:</span>
                                            <span class="font-medium text-[#111118]" id="checkinTime">14:32:15</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-[#6B6B80]">No. Tiket:</span>
                                            <span class="font-medium text-[#111118]"
                                                id="ticketNo">#ORD-2026-001234</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Error Result --}}
                    <div id="checkinError" class="mb-6 hidden">
                        <div class="bg-red-50 rounded-lg p-6 border border-[#DC2626]">
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-[#DC2626] flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="flex-1">
                                    <h3 class="font-bold text-[#111118]">QR Tidak Valid ✗</h3>
                                    <p class="text-sm text-[#6B6B80] mt-2" id="errorMessage">Tiket sudah dipindai
                                        sebelumnya atau tidak ditemukan.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Activity Log --}}
                    <div class="border-t border-[#E0E0E8] pt-6">
                        <h3 class="font-bold text-[#111118] mb-4">Aktivitas Terbaru</h3>
                        <div class="space-y-3 max-h-60 overflow-y-auto">
                            @foreach(range(1, 5) as $i)
                                <div class="flex justify-between items-center text-sm p-3 bg-[#F8F8FA] rounded-lg">
                                    <div>
                                        <p class="font-medium text-[#111118]">Pengunjung #{{ 5 - $i + 1 }}</p>
                                        <p class="text-[#6B6B80]">VIP Ticket</p>
                                    </div>
                                    <span class="text-[#16A34A] font-medium">14:{{ 30 - $i }}:00</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Merchandise Pickup Section --}}
                <div class="bg-white rounded-xl border border-[#E0E0E8] p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-lg bg-[#FFF0E6] flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#F97316]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a2 2 0 00-1.414.586l-2 2a2 2 0 01-2.828 0l-2-2a2 2 0 00-1.414-.586H4">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-[#111118]">Pengambilan Merchandise</h2>
                            <p class="text-sm text-[#6B6B80]">Pindai merchandise pengunjung</p>
                        </div>
                    </div>

                    {{-- QR Input --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-[#111118] mb-2">Pindai QR Merchandise</label>
                        
                        {{-- Camera Scanner Visual --}}
                        <div class="relative w-full bg-[#111118] rounded-lg overflow-hidden border-2 border-[#F97316] aspect-video flex items-center justify-center cursor-pointer hover:border-[#ea580c] transition-colors"
                            id="merchandiseScanner" onclick="document.getElementById('merchandiseInput').focus()">
                            {{-- Scanning Area --}}
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#F97316]/10 to-transparent"></div>
                            
                            {{-- Corner Markers --}}
                            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 400 300" fill="none">
                                {{-- Top Left --}}
                                <path d="M 20 20 L 20 80 M 20 20 L 80 20" stroke="#F97316" stroke-width="3" stroke-linecap="round"/>
                                {{-- Top Right --}}
                                <path d="M 380 20 L 380 80 M 380 20 L 320 20" stroke="#F97316" stroke-width="3" stroke-linecap="round"/>
                                {{-- Bottom Left --}}
                                <path d="M 20 280 L 20 220 M 20 280 L 80 280" stroke="#F97316" stroke-width="3" stroke-linecap="round"/>
                                {{-- Bottom Right --}}
                                <path d="M 380 280 L 380 220 M 380 280 L 320 280" stroke="#F97316" stroke-width="3" stroke-linecap="round"/>
                            </svg>

                            {{-- Content --}}
                            <div class="text-center z-10">
                                <svg class="w-16 h-16 text-[#F97316] mx-auto mb-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <p class="text-white font-bold">Arahkan Kamera</p>
                                <p class="text-[#F97316]/80 text-xs mt-1">ke QR Code</p>
                            </div>
                        </div>

                        {{-- Hidden Input untuk scan data --}}
                        <input type="text" id="merchandiseInput"
                            class="opacity-0 h-0 w-0 pointer-events-none"
                            placeholder="hidden">
                    </div>

                    {{-- Display Result --}}
                    <div id="merchandiseResult" class="mb-6 hidden">
                        <div class="bg-[#FFF0E6] rounded-lg p-6 border border-[#F97316]">
                            <div>
                                <h3 class="font-bold text-[#111118] mb-4">Detail Pengambilan Merchandise</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-[#6B6B80]">Pengunjung:</span>
                                        <span class="font-medium text-[#111118]" id="merchandiseVisitor">Budi
                                            Santoso</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-[#6B6B80]">No. Pesanan:</span>
                                        <span class="font-medium text-[#111118]"
                                            id="merchandiseOrder">#ORD-2026-001234</span>
                                    </div>
                                </div>

                                {{-- Merchandise Items --}}
                                <div class="mt-4 p-3 bg-white rounded border border-[#E0E0E8]">
                                    <p class="text-sm font-medium text-[#111118] mb-3">Item yang diambil:</p>
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-[#111118]">Kaos Festival (L, Putih)</span>
                                            <span class="text-[#6B6B80]">x1</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-[#111118]">Topi Festival</span>
                                            <span class="text-[#6B6B80]">x1</span>
                                        </div>
                                    </div>
                                </div>

                                <button
                                    class="w-full mt-4 py-2 bg-[#16A34A] text-white font-medium rounded-lg hover:bg-[#15803d] transition-colors">
                                    Konfirmasi Pengambilan
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Merchandise Pending --}}
                    <div class="border-t border-[#E0E0E8] pt-6">
                        <h3 class="font-bold text-[#111118] mb-4">Pengambilan Pending</h3>
                        <div class="space-y-3 max-h-60 overflow-y-auto">
                            @foreach(range(1, 5) as $i)
                                <div class="p-4 bg-[#FFF0E6] rounded-lg border border-[#F97316]">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium text-[#111118]">Pengunjung #{{ $i }}</p>
                                            <p class="text-xs text-[#6B6B80] mt-1">Kaos Festival (M), Topi</p>
                                        </div>
                                        <button class="text-[#F97316] hover:text-[#ea580c] font-medium text-sm">
                                            Lihat
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

                    {{-- Display Result --}}
                    <div id="checkinResult" class="mb-6 hidden">
                        <div class="bg-[#EDE9FE] rounded-lg p-6 border border-[#7C3AED]">
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-[#16A34A] flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="flex-1">
                                    <h3 class="font-bold text-[#111118]">Check-in Berhasil! ✓</h3>
                                    <div class="mt-3 space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-[#6B6B80]">Nama Pengunjung:</span>
                                            <span class="font-medium text-[#111118]" id="visitorName">Budi
                                                Santoso</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-[#6B6B80]">Kategori Tiket:</span>
                                            <span class="font-medium text-[#111118]" id="ticketCategory">VIP</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-[#6B6B80]">Jam Check-in:</span>
                                            <span class="font-medium text-[#111118]" id="checkinTime">14:32:15</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-[#6B6B80]">No. Tiket:</span>
                                            <span class="font-medium text-[#111118]"
                                                id="ticketNo">#ORD-2026-001234</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Error Result --}}
                    <div id="checkinError" class="mb-6 hidden">
                        <div class="bg-red-50 rounded-lg p-6 border border-[#DC2626]">
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-[#DC2626] flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="flex-1">
                                    <h3 class="font-bold text-[#111118]">QR Tidak Valid ✗</h3>
                                    <p class="text-sm text-[#6B6B80] mt-2" id="errorMessage">Tiket sudah dipindai
                                        sebelumnya atau tidak ditemukan.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    

    <script>
        { { --Check -in Logic-- } }
        document.getElementById('checkinInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                const value = this.value.trim();
                if (value) {
                    // Simulate QR scan
                    showCheckinResult(value);
                    this.value = '';
                }
            }
        });

        function showCheckinResult(token) {
            const result = document.getElementById('checkinResult');
            const error = document.getElementById('checkinError');

            // Simulate API response - in production this would call backend
            if (token.includes('ERR')) {
                error.classList.remove('hidden');
                result.classList.add('hidden');
                setTimeout(() => error.classList.add('hidden'), 3000);
            } else {
                result.classList.remove('hidden');
                error.classList.add('hidden');
                setTimeout(() => result.classList.add('hidden'), 5000);
            }
        }

        { { --Merchandise Logic-- } }
        document.getElementById('merchandiseInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                const value = this.value.trim();
                if (value) {
                    showMerchandiseResult(value);
                    this.value = '';
                }
            }
        });

        function showMerchandiseResult(token) {
            const result = document.getElementById('merchandiseResult');
            result.classList.remove('hidden');

            setTimeout(() => result.classList.add('hidden'), 8000);
        }
    </script>
</x-app-layout>