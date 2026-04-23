@extends('layouts.organizer')
@section('title', 'Buat Event Baru')
@section('page-title', 'Buat Event Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <form method="POST" action="{{ route('organizer.events.store') }}" class="space-y-6" x-data="{
            tickets: [{ id: 1, name: '', price: 0, quota: 100 }],
            addTicket() {
                this.tickets.push({ id: Date.now(), name: '', price: 0, quota: 100 });
            },
            removeTicket(index) {
                if (this.tickets.length > 1) {
                    this.tickets.splice(index, 1);
                }
            }
        }">
        @csrf

        {{-- Informasi Dasar --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Event</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Event</label>
                    <select name="category_id" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Event</label>
                <textarea name="description" rows="4" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">{{ old('description') }}</textarea>
            </div>
        </div>

        {{-- Lokasi & Waktu --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Lokasi & Waktu Pelaksanaan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Tempat (Venue)</label>
                    <input type="text" name="venue_name" value="{{ old('venue_name') }}" placeholder="Misal: GBK Hall A" required
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                    <input type="text" name="city" value="{{ old('city') }}" placeholder="Misal: Jakarta Pusat" required
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap Venue</label>
                <input type="text" name="address" value="{{ old('address') }}" required
                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Event</label>
                    <input type="date" name="event_date" value="{{ old('event_date') }}" required
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai</label>
                    <input type="time" name="start_time" value="{{ old('start_time') }}" required
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai</label>
                    <input type="time" name="end_time" value="{{ old('end_time') }}" required
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                </div>
            </div>
        </div>

        {{-- Kategori Tiket --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Kategori Tiket</h3>
                <button type="button" @click="addTicket()" class="text-sm font-medium text-purple-600 hover:text-purple-800 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Tiket
                </button>
            </div>
            <div class="space-y-4">
                <template x-for="(ticket, index) in tickets" :key="ticket.id">
                    <div class="grid grid-cols-12 gap-3 p-4 rounded-xl border border-gray-100 bg-gray-50/50 items-end">
                        <div class="col-span-12 md:col-span-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                            <input type="text" :name="`tickets[${index}][name]`" x-model="ticket.name" required
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" placeholder="Misal: VIP, Festival">
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                            <input type="number" min="0" :name="`tickets[${index}][price]`" x-model="ticket.price" required
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" placeholder="0 untuk gratis">
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kuota</label>
                            <input type="number" min="1" :name="`tickets[${index}][quota]`" x-model="ticket.quota" required
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        </div>
                        <div class="col-span-12 md:col-span-2 flex justify-end">
                            <button type="button" @click="removeTicket(index)" x-show="tickets.length > 1"
                                    class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        {{-- Status & Submit --}}
        <div class="flex items-center justify-between bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status Publish</label>
                <select name="status" class="rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    <option value="draft">Simpan sbg Draft</option>
                    <option value="published">Langsung Publish</option>
                </select>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('organizer.events.index') }}" class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-xl hover:from-purple-700 hover:to-indigo-700 shadow-sm">Simpan Event</button>
            </div>
        </div>
    </form>
</div>
@endsection