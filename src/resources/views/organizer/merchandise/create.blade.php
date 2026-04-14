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
                <a href="{{ route('organizer.merchandise.index') }}" class="text-[#6B6B80] hover:text-[#111118]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-[#111118]">Tambah Merchandise Baru</h1>
                    <p class="text-[#6B6B80] text-sm mt-1">Soundwave Festival Jakarta</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Content --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form class="space-y-6">
            {{-- Basic Information Section --}}
            <div class="bg-white rounded-xl border border-[#E0E0E8] p-8">
                <h2 class="text-lg font-bold text-[#111118] mb-6">Informasi Dasar</h2>
                
                {{-- Name --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-[#111118] mb-2">
                        Nama Merchandise
                    </label>
                    <input type="text" placeholder="Contoh: Kaos Festival Soundwave" 
                           class="w-full px-4 py-3 border border-[#E0E0E8] rounded-lg text-[#111118] placeholder-[#6B6B80] focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent">
                </div>

                {{-- Description --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-[#111118] mb-2">
                        Deskripsi
                    </label>
                    <textarea placeholder="Jelaskan detail merchandise..." rows="4"
                              class="w-full px-4 py-3 border border-[#E0E0E8] rounded-lg text-[#111118] placeholder-[#6B6B80] focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent resize-none"></textarea>
                </div>

                {{-- Image Upload --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-[#111118] mb-2">
                        Gambar Merchandise
                    </label>
                    <div class="border-2 border-dashed border-[#E0E0E8] rounded-lg p-8 text-center hover:bg-[#F8F8FA] transition-colors cursor-pointer">
                        <svg class="w-12 h-12 text-[#6B6B80] mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-[#111118] font-medium">Seret gambar atau klik untuk upload</p>
                        <p class="text-[#6B6B80] text-sm mt-1">JPG, PNG (Max 5MB)</p>
                        <input type="file" class="hidden" accept="image/*">
                    </div>
                </div>

                {{-- Price --}}
                <div>
                    <label class="block text-sm font-medium text-[#111118] mb-2">
                        Harga Dasar (Rp)
                    </label>
                    <input type="number" placeholder="150000" 
                           class="w-full px-4 py-3 border border-[#E0E0E8] rounded-lg text-[#111118] placeholder-[#6B6B80] focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent">
                </div>
            </div>

            {{-- Variants Section --}}
            <div class="bg-white rounded-xl border border-[#E0E0E8] p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-[#111118]">Varian & Stok</h2>
                    <button type="button" onclick="addVariantGroup()" 
                            class="inline-flex items-center px-4 py-2 bg-[#EDE9FE] text-[#7C3AED] font-medium rounded-lg hover:bg-[#ddd6fe] transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Grup Varian
                    </button>
                </div>

                <div id="variantContainer" class="space-y-8">
                    {{-- Variant Group 1 --}}
                    <div class="border border-[#E0E0E8] rounded-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <input type="text" placeholder="Nama Grup Varian (Contoh: Ukuran)" 
                                   class="flex-1 px-4 py-2 border border-[#E0E0E8] rounded-lg text-[#111118] placeholder-[#6B6B80] focus:outline-none focus:ring-2 focus:ring-[#7C3AED] mr-2">
                            <button type="button" class="text-[#DC2626] hover:text-red-700 font-medium">
                                Hapus Grup
                            </button>
                        </div>

                        {{-- Variant Items --}}
                        <div class="space-y-3 mb-4">
                            @foreach(['S', 'M', 'L', 'XL'] as $size)
                            <div class="flex gap-3">
                                <input type="text" placeholder="Varian (Contoh: {{ $size }})" value="{{ $size }}"
                                       class="flex-1 px-4 py-2 border border-[#E0E0E8] rounded-lg text-[#111118] focus:outline-none focus:ring-2 focus:ring-[#7C3AED]">
                                <input type="number" placeholder="Stok" value="{{ [15, 20, 25, 18][$loop->index] }}"
                                       class="w-24 px-4 py-2 border border-[#E0E0E8] rounded-lg text-[#111118] focus:outline-none focus:ring-2 focus:ring-[#7C3AED]">
                                <input type="number" placeholder="Selisih Harga" 
                                       class="w-28 px-4 py-2 border border-[#E0E0E8] rounded-lg text-[#111118] focus:outline-none focus:ring-2 focus:ring-[#7C3AED]">
                                <button type="button" class="text-[#DC2626] hover:text-red-700 font-medium min-w-max">
                                    Hapus
                                </button>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" 
                                class="px-4 py-2 border border-[#7C3AED] text-[#7C3AED] font-medium rounded-lg hover:bg-[#EDE9FE] transition-colors text-sm">
                            + Tambah Varian
                        </button>
                    </div>
                </div>
            </div>

            {{-- Status Section --}}
            <div class="bg-white rounded-xl border border-[#E0E0E8] p-8">
                <h2 class="text-lg font-bold text-[#111118] mb-6">Status</h2>
                
                <div class="flex items-center gap-4">
                    <input type="checkbox" id="isAvailable" checked class="w-5 h-5 text-[#7C3AED] rounded border-[#E0E0E8] focus:ring-[#7C3AED]">
                    <label for="isAvailable" class="text-[#111118] font-medium">
                        Merchandise Tersedia
                    </label>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex gap-4 justify-end">
                <a href="{{ route('organizer.merchandise.index') }}" 
                   class="px-6 py-3 border border-[#E0E0E8] text-[#111118] font-medium rounded-lg hover:bg-[#F8F8FA] transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-[#7C3AED] text-white font-medium rounded-lg hover:bg-[#6d28d9] transition-colors">
                    Simpan Merchandise
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function addVariantGroup() {
    const container = document.getElementById('variantContainer');
    const newGroup = document.createElement('div');
    newGroup.className = 'border border-[#E0E0E8] rounded-lg p-6';
    newGroup.innerHTML = `
        <div class="flex justify-between items-center mb-4">
            <input type="text" placeholder="Nama Grup Varian (Contoh: Warna)" 
                   class="flex-1 px-4 py-2 border border-[#E0E0E8] rounded-lg text-[#111118] placeholder-[#6B6B80] focus:outline-none focus:ring-2 focus:ring-[#7C3AED] mr-2">
            <button type="button" onclick="this.closest('div').parentElement.remove()" class="text-[#DC2626] hover:text-red-700 font-medium">
                Hapus Grup
            </button>
        </div>
        <div class="space-y-3 mb-4">
            <div class="flex gap-3">
                <input type="text" placeholder="Varian"
                       class="flex-1 px-4 py-2 border border-[#E0E0E8] rounded-lg text-[#111118] focus:outline-none focus:ring-2 focus:ring-[#7C3AED]">
                <input type="number" placeholder="Stok"
                       class="w-24 px-4 py-2 border border-[#E0E0E8] rounded-lg text-[#111118] focus:outline-none focus:ring-2 focus:ring-[#7C3AED]">
                <input type="number" placeholder="Selisih Harga" 
                       class="w-28 px-4 py-2 border border-[#E0E0E8] rounded-lg text-[#111118] focus:outline-none focus:ring-2 focus:ring-[#7C3AED]">
                <button type="button" class="text-[#DC2626] hover:text-red-700 font-medium min-w-max">
                    Hapus
                </button>
            </div>
        </div>
        <button type="button" 
                class="px-4 py-2 border border-[#7C3AED] text-[#7C3AED] font-medium rounded-lg hover:bg-[#EDE9FE] transition-colors text-sm">
            + Tambah Varian
        </button>
    `;
    container.appendChild(newGroup);
}
</script>
</x-app-layout>

