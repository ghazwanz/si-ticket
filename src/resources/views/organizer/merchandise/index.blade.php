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
    <div class="min-h-screen bg-white">
        {{-- Header Section --}}
        <div class="border-b border-[#E0E0E8] bg-white sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-[#111118]">Manajemen Merchandise</h1>
                        <p class="text-[#6B6B80] mt-2">Kelola merchandise untuk Soundwave Festival Jakarta</p>
                    </div>
                    <a href="{{ route('organizer.merchandise.create') }}"
                        class="inline-flex items-center px-6 py-3 bg-[#7C3AED] text-white font-medium rounded-lg hover:bg-[#6d28d9] transition-colors shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Tambah Merchandise
                    </a>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Filters --}}
            <div class="mb-8 flex gap-4 flex-wrap">
                <div class="flex-1 min-w-[250px]">
                    <input type="text" placeholder="Cari merchandise..."
                        class="w-full px-4 py-2 border border-[#E0E0E8] rounded-lg text-[#111118] placeholder-[#6B6B80] focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent">
                </div>
                <select
                    class="px-4 py-2 border border-[#E0E0E8] rounded-lg text-[#111118] focus:outline-none focus:ring-2 focus:ring-[#7C3AED]">
                    <option value="">Semua Status</option>
                    <option value="available">Tersedia</option>
                    <option value="unavailable">Tidak Tersedia</option>
                </select>
            </div>

            {{-- Merchandise Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(range(1, 6) as $item)
                    <div
                        class="bg-white border border-[#E0E0E8] rounded-xl overflow-hidden hover:shadow-lg transition-shadow">
                        {{-- Image --}}
                        <div class="relative h-48 bg-[#F2F2F7] overflow-hidden">
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-[#6B6B80]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div
                                class="absolute top-3 right-3 inline-flex items-center px-3 py-1 bg-[#EDE9FE] text-[#7C3AED] text-sm font-medium rounded-full">
                                Tersedia
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-[#111118] mb-2">Kaos Festival Soundwave {{ $item }}</h3>
                            <p class="text-[#6B6B80] text-sm mb-4 line-clamp-2">Kaos eksklusif dengan desain minimalis dari
                                Soundwave Festival Jakarta 2026.</p>

                            {{-- Price --}}
                            <div class="mb-4">
                                <p class="text-2xl font-bold text-[#7C3AED]">Rp 150.000</p>
                                <p class="text-xs text-[#6B6B80] mt-1">Harga dasar</p>
                            </div>

                            {{-- Variants Summary --}}
                            <div class="mb-6 p-3 bg-[#F2F2F7] rounded-lg">
                                <p class="text-sm font-medium text-[#111118] mb-2">Varian & Stok:</p>
                                <div class="space-y-1">
                                    <div class="flex justify-between text-xs text-[#6B6B80]">
                                        <span>S: 15 unit</span>
                                        <span>M: 20 unit</span>
                                    </div>
                                    <div class="flex justify-between text-xs text-[#6B6B80]">
                                        <span>L: 25 unit</span>
                                        <span>XL: 18 unit</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="flex gap-3">
                                <a href="{{ route('organizer.merchandise.edit', $item) }}"
                                    class="flex-1 px-4 py-2 border border-[#7C3AED] text-[#7C3AED] font-medium rounded-lg hover:bg-[#EDE9FE] transition-colors text-center">
                                    Edit
                                </a>
                                <button
                                    class="flex-1 px-4 py-2 border border-[#DC2626] text-[#DC2626] font-medium rounded-lg hover:bg-red-50 transition-colors">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Empty State --}}
            @if(false)
                <div class="flex flex-col items-center justify-center h-96">
                    <svg class="w-24 h-24 text-[#E0E0E8] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a2 2 0 00-1.414.586l-2 2a2 2 0 01-2.828 0l-2-2a2 2 0 00-1.414-.586H4">
                        </path>
                    </svg>
                    <h3 class="text-xl font-bold text-[#111118] mb-2">Belum ada merchandise</h3>
                    <p class="text-[#6B6B80] mb-6">Mulai dengan membuat merchandise pertama Anda</p>
                    <a href="{{ route('organizer.merchandise.create') }}"
                        class="px-6 py-3 bg-[#7C3AED] text-white font-medium rounded-lg hover:bg-[#6d28d9] transition-colors">
                        Buat Merchandise
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>