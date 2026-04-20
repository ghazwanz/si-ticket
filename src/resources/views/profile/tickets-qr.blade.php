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
            <div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-[#111118]">Tiket & Klaim QR Anda</h1>
                        <p class="text-[#6B6B80] text-sm mt-1">{{ $order->event->name ?? 'Informasi Event' }} - {{ \Carbon\Carbon::parse($order->event->event_date)->translatedFormat('d F Y') }}</p>
                    </div>
                    <a href="{{ route('profile.order-detail', $order->id) }}"
                        class="text-[#7C3AED] hover:text-[#6d28d9] font-medium inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Detail Pesanan
                    </a>
                </div>
            </div>
        </div>

        {{-- Important Info --}}
        <div class="border-b border-[#E0E0E8] bg-white">
            <div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-[#F97316] flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div class="text-sm">
                        <p class="font-medium text-[#111118]">Penting: Simpan dan Tunjukkan QR Code Ini</p>
                        <p class="text-[#6B6B80] mt-1">QR code tidak dapat dibagikan. Hanya pemegang tiket yang dapat
                            memasuki venue. Setiap QR hanya dapat dipindai satu kali, begitu pula untuk merchandise.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Tiket Masuk --}}
            @if($order->tickets->isNotEmpty())
            <h2 class="text-xl font-bold text-foreground mb-6">Tiket Masuk ({{ $order->tickets->count() }})</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach($order->tickets as $idx => $ticket)
                <div class="bg-white rounded-xl border border-[#E0E0E8] overflow-hidden shadow-sm hover:shadow-md transition">
                    {{-- Header --}}
                    <div class="bg-gradient-to-r {{ $ticket->is_checked_in ? 'from-emerald-500 to-emerald-600' : 'from-[#7C3AED] to-[#6d28d9]' }} px-6 py-4 flex justify-between items-center">
                        <div>
                            <p class="text-white font-bold">{{ $ticket->ticketCategory?->name ?? 'Regular Tier' }}</p>
                            <p class="text-white/80 text-xs mt-0.5">Akses Venue</p>
                        </div>
                        <span class="text-white/40 text-xs font-mono">#{{ $idx + 1 }}</span>
                    </div>

                    {{-- Content --}}
                    <div class="p-6 relative">
                        @if($ticket->is_checked_in)
                            <div class="absolute inset-x-0 top-0 bottom-36 bg-white/80 backdrop-blur-sm flex flex-col justify-center items-center z-10">
                                <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center mb-2">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <span class="font-bold text-emerald-700">Telah Dipindai</span>
                            </div>
                        @endif

                        {{-- QR Code Display --}}
                        <div class="mb-6 flex justify-center">
                            <div class="p-3 bg-[#F2F2F7] rounded-lg border border-[#E0E0E8]">
                                <div class="w-48 h-48 bg-white rounded flex items-center justify-center border-[3px] border-[#7C3AED] overflow-hidden">
                                     <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=TIK-{{ $ticket->id }}" alt="QR Code" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>

                        {{-- Ticket Details --}}
                        <div class="space-y-3 mb-6 pb-6 border-b border-[#E0E0E8]">
                            <div class="flex justify-between">
                                <span class="text-[#6B6B80] text-xs">ID Tiket</span>
                                <span class="font-mono text-[#111118] text-xs">TIK-{{ strtoupper(substr($ticket->id, 0, 8)) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#6B6B80] text-xs">Status</span>
                                @if($ticket->is_checked_in)
                                    <span class="text-[#16A34A] text-xs font-bold font-mono">USED</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 bg-[#DEF7EC] text-[#16A34A] text-[10px] font-bold uppercase tracking-wider rounded-full">
                                        ✓ Valid
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Event Info --}}
                        <div class="space-y-3">
                            <div>
                                <p class="text-[#6B6B80] text-[10px] uppercase font-bold mb-0.5">Acara</p>
                                <p class="font-bold text-[#111118] text-sm">{{ $order->event->name ?? 'Event' }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[#6B6B80] text-[10px] uppercase font-bold mb-0.5">Waktu</p>
                                    <p class="font-medium text-[#111118] text-xs">{{ substr($order->event->start_time ?? '18:00', 0, 5) }}</p>
                                </div>
                                <div>
                                    <p class="text-[#6B6B80] text-[10px] uppercase font-bold mb-0.5">Lokasi</p>
                                    <p class="font-medium text-[#111118] text-xs truncate">{{ $order->event->venue_name ?? 'Venue' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Merchandise --}}
            @if($order->merchandise->isNotEmpty())
            <h2 class="text-xl font-bold text-foreground mb-6">Barang Klaim Merchandise ({{ $order->merchandise->count() }})</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($order->merchandise as $idx => $merch)
                <div class="bg-white rounded-xl border border-[#E0E0E8] overflow-hidden shadow-sm hover:shadow-md transition">
                    {{-- Header --}}
                    <div class="bg-gradient-to-r {{ $merch->is_picked_up ? 'from-blue-500 to-blue-600' : 'from-indigo-600 to-indigo-800' }} px-6 py-4 flex justify-between items-center">
                        <div>
                            <p class="text-white font-bold tracking-tight">Klaim Merchandise</p>
                            <p class="text-white/80 text-xs mt-0.5">Kuantitas: {{ $merch->quantity }} pcs</p>
                        </div>
                        <span class="text-white bg-white/20 px-2 py-1 rounded-md text-xs font-bold shadow-sm">QTY: {{ $merch->quantity }}</span>
                    </div>

                    {{-- Content --}}
                    <div class="p-6 relative">
                        @if($merch->is_picked_up)
                            <div class="absolute inset-x-0 top-0 bottom-24 bg-white/80 backdrop-blur-sm flex flex-col justify-center items-center z-10">
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mb-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </div>
                                <span class="font-bold text-blue-700">Telah Diambil</span>
                            </div>
                        @endif

                        {{-- QR Code Display --}}
                        <div class="mb-6 flex justify-center">
                            <div class="p-3 bg-[#F2F2F7] rounded-lg border border-[#E0E0E8]">
                                <div class="w-48 h-48 bg-white rounded flex items-center justify-center border-[3px] border-indigo-600 overflow-hidden">
                                     <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=MER-{{ $merch->id }}" alt="QR Code" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>

                        {{-- Merch Details --}}
                        <div class="space-y-3 mb-6 pb-6 border-b border-[#E0E0E8]">
                            <div class="flex justify-between">
                                <span class="text-[#6B6B80] text-xs">ID Klaim</span>
                                <span class="font-mono text-[#111118] text-xs">MER-{{ strtoupper(substr($merch->id, 0, 8)) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#6B6B80] text-xs">Status Pengambilan</span>
                                @if($merch->is_picked_up)
                                    <span class="text-[#2563EB] text-xs font-bold font-mono">CLAIMED</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 bg-indigo-50 text-indigo-700 text-[10px] font-bold uppercase tracking-wider rounded-full">
                                        Menunggu Klaim
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Item Info --}}
                        <div class="space-y-2">
                            <div>
                                <p class="text-[#6B6B80] text-[10px] uppercase font-bold mb-0.5">Detail Barang</p>
                                <p class="font-bold text-[#111118] text-sm">{{ $merch->merchandiseVariant?->item?->name ?? 'Merchandise Item' }}</p>
                                <p class="text-[#6B6B80] text-xs mt-0.5">Varian: {{ $merch->merchandiseVariant?->name ?? 'Standard' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
