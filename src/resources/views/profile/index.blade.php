<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-semibold text-foreground tracking-tight">
                {{ __('Profil') }}
            </h1>
        </div>
    </x-slot>
    <div class="min-h-screen bg-[#F8F8FA]">
        {{-- Header Section --}}
        <div class="border-b border-[#E0E0E8] bg-white sticky top-0 z-40">
            <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <h1 class="text-2xl font-bold text-[#111118]">Profil Saya</h1>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Profile Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                {{-- Left: Profile Card --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl border border-[#E0E0E8] p-8">
                        {{-- Avatar --}}
                        <div class="flex justify-center mb-6">
                            <div class="w-20 h-20 rounded-full bg-[#7C3AED] flex items-center justify-center">
                                <span class="text-3xl font-bold text-white">BS</span>
                            </div>
                        </div>

                        <h2 class="text-xl font-bold text-[#111118] text-center mb-1">Budi Santoso</h2>
                        <p class="text-[#6B6B80] text-center text-sm mb-6">budi.santoso@email.com</p>

                        {{-- Stats --}}
                        <div class="border-t border-[#E0E0E8] pt-6 space-y-4">
                            <div class="text-center">
                                <p class="text-2xl font-bold text-[#111118]">5</p>
                                <p class="text-sm text-[#6B6B80]">Pesanan Selesai</p>
                            </div>
                            <div class="border-t border-[#E0E0E8] pt-4">
                                <p class="text-2xl font-bold text-[#111118]">12</p>
                                <p class="text-sm text-[#6B6B80]">Tiket Digunakan</p>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <button
                            class="w-full mt-6 px-4 py-3 border border-[#7C3AED] text-[#7C3AED] font-medium rounded-lg hover:bg-[#EDE9FE] transition-colors">
                            <a href="{{ route('profile.edit') }}" class="block w-full text-center">
                                Edit Profil
                            </a>
                        </button>
                        <button
                            class="w-full mt-3 px-4 py-3 border border-[#E0E0E8] text-[#111118] font-medium rounded-lg hover:bg-[#F8F8FA] transition-colors">
                            Ubah Kata Sandi
                        </button>
                        <button
                            class="w-full mt-3 px-4 py-3 border border-[#DC2626] text-[#DC2626] font-medium rounded-lg hover:bg-red-50 transition-colors">
                            Logout
                        </button>
                    </div>
                </div>

                {{-- Middle: Profile Information --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl border border-[#E0E0E8] p-8 mb-8">
                        <h3 class="text-lg font-bold text-[#111118] mb-6">Informasi Akun</h3>

                        <div class="space-y-6">
                            {{-- Name --}}
                            <div>
                                <label class="block text-sm font-medium text-[#111118] mb-2">Nama Lengkap</label>
                                <p class="text-[#111118] py-2">Budi Santoso</p>
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-sm font-medium text-[#111118] mb-2">Email</label>
                                <p class="text-[#111118] py-2">budi.santoso@email.com</p>
                                <p class="text-xs text-[#16A34A] mt-1">✓ Terverifikasi</p>
                            </div>

                            {{-- Phone --}}
                            <div>
                                <label class="block text-sm font-medium text-[#111118] mb-2">Nomor Telepon</label>
                                <p class="text-[#111118] py-2">+62 812 3456 7890</p>
                            </div>

                            {{-- Member Since --}}
                            <div>
                                <label class="block text-sm font-medium text-[#111118] mb-2">Bergabung Sejak</label>
                                <p class="text-[#111118] py-2">5 Januari 2025</p>
                            </div>
                        </div>

                        <div class="border-t border-[#E0E0E8] mt-6 pt-6">
                            <button
                                class="px-6 py-2 border border-[#7C3AED] text-[#7C3AED] font-medium rounded-lg hover:bg-[#EDE9FE] transition-colors">
                                Edit Informasi
                            </button>
                        </div>
                    </div>

                    {{-- Payment Methods --}}
                    <div class="bg-white rounded-xl border border-[#E0E0E8] p-8">
                        <h3 class="text-lg font-bold text-[#111118] mb-6">Informasi Pembayaran</h3>

                        <div class="space-y-4">
                            <div class="p-4 border border-[#E0E0E8] rounded-lg">
                                <p class="text-sm text-[#6B6B80] mb-2">Metode Pembayaran Default</p>
                                <p class="font-medium text-[#111118]">GoPay</p>
                                <p class="text-xs text-[#6B6B80] mt-1">Diperbarui 3 Desember 2025</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Orders Section --}}
            <div class="bg-white rounded-xl border border-[#E0E0E8] overflow-hidden">
                <div class="border-b border-[#E0E0E8] px-8 py-6">
                    <h2 class="text-lg font-bold text-[#111118]">Pesanan Saya</h2>
                </div>

                {{-- Tabs --}}
                <div class="border-b border-[#E0E0E8] flex">
                    <button
                        class="flex-1 px-6 py-3 border-b-2 border-[#7C3AED] text-[#7C3AED] font-medium hover:bg-[#F8F8FA]">
                        Semua Pesanan
                    </button>
                    <button
                        class="flex-1 px-6 py-3 border-b-2 border-transparent text-[#6B6B80] font-medium hover:bg-[#F8F8FA]">
                        Akan Datang
                    </button>
                    <button
                        class="flex-1 px-6 py-3 border-b-2 border-transparent text-[#6B6B80] font-medium hover:bg-[#F8F8FA]">
                        Selesai
                    </button>
                </div>

                {{-- Orders List --}}
                <div class="divide-y divide-[#E0E0E8]">
                    @foreach(range(1, 4) as $i)
                        <div class="p-8 hover:bg-[#F8F8FA] transition-colors">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        <h3 class="text-lg font-bold text-[#111118]">Soundwave Festival Jakarta</h3>
                                        @if($i == 1)
                                            <span
                                                class="inline-flex items-center px-3 py-1 bg-[#EDE9FE] text-[#7C3AED] text-sm font-medium rounded-full">
                                                Akan Datang
                                            </span>
                                        @elseif($i <= 2)
                                            <span
                                                class="inline-flex items-center px-3 py-1 bg-[#DEF7EC] text-[#16A34A] text-sm font-medium rounded-full">
                                                Berhasil
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 bg-[#F2F2F7] text-[#6B6B80] text-sm font-medium rounded-full">
                                                Selesai
                                            </span>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                        <div>
                                            <p class="text-xs text-[#6B6B80] mb-1">Nomor Pesanan</p>
                                            <p class="font-medium text-[#111118]">#ORD-{{ 2026001230 + $i }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-[#6B6B80] mb-1">Tanggal</p>
                                            <p class="font-medium text-[#111118]">12 Juli {{ 2026 + min($i, 0) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-[#6B6B80] mb-1">Total</p>
                                            <p class="font-medium text-[#111118]">Rp
                                                {{ number_format(350000 + ($i * 100000), 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-[#6B6B80] mb-1">Item</p>
                                            <p class="font-medium text-[#111118]">{{ $i + 1 }} Tiket + Merchandise</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-2 md:flex-col">
                                    <button
                                        class="flex-1 md:flex-none px-4 py-2 border border-[#7C3AED] text-[#7C3AED] font-medium rounded-lg hover:bg-[#EDE9FE] transition-colors text-sm">
                                        <a href="{{ route('profile.order-detail', $i) }}"
                                            class="block w-full text-center">Lihat Detail</a>
                                    </button>
                                    <button
                                        class="flex-1 md:flex-none px-4 py-2 bg-[#7C3AED] text-white font-medium rounded-lg hover:bg-[#6d28d9] transition-colors text-sm">
                                        <a href="{{ route('profile.tickets-qr', $i) }}" class="block w-full text-center">
                                            {{ $i == 1 ? 'Lihat Tiket' : 'Ulang' }}
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>