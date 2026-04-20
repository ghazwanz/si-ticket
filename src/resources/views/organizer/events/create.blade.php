<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-foreground tracking-tight">
            {{ __('Buat Event Baru') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="rounded-3xl border border-border/60 bg-card p-6 shadow-sm">
                <div class="mb-6">
                    <h2 class="text-xl font-bold tracking-tight text-card-foreground">Informasi & Tiket Event</h2>
                    <p class="text-sm text-muted-foreground mt-1">Lengkapi formulir di bawah ini untuk mempublikasikan acara Anda secara detail.</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 rounded-xl bg-red-100 p-4 text-red-800 dark:bg-red-500/20 dark:text-red-400">
                        <ul class="list-disc pl-5 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('organizer.events.store') }}" class="space-y-8" x-data="{
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

                    <!-- 1. Detail Event -->
                    <div class="space-y-4 rounded-2xl bg-secondary/30 p-5 border border-border/50">
                        <h3 class="text-lg font-bold text-foreground border-b border-border/60 pb-2 mb-4">Informasi Dasar</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="name" value="Nama Event" />
                                <x-text-input name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}" required />
                            </div>
                            <div>
                                <x-input-label for="category_id" value="Kategori Event" />
                                <select name="category_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 mt-1 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="description" value="Deskripsi Event" />
                            <textarea name="description" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 mt-1 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" required>{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- 2. Lokasi & Waktu -->
                    <div class="space-y-4 rounded-2xl bg-secondary/30 p-5 border border-border/50">
                        <h3 class="text-lg font-bold text-foreground border-b border-border/60 pb-2 mb-4">Lokasi & Waktu Pelaksanaan</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="venue_name" value="Nama Tempat (Venue)" />
                                <x-text-input name="venue_name" type="text" class="mt-1 block w-full" value="{{ old('venue_name') }}" placeholder="Misal: GBK Hall A" required />
                            </div>
                            <div>
                                <x-input-label for="city" value="Kota" />
                                <x-text-input name="city" type="text" class="mt-1 block w-full" value="{{ old('city') }}" placeholder="Misal: Jakarta Pusat" required />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="address" value="Alamat Lengkap Venue" />
                            <x-text-input name="address" type="text" class="mt-1 block w-full" value="{{ old('address') }}" required />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="event_date" value="Tanggal Event" />
                                <x-text-input name="event_date" type="date" class="mt-1 block w-full" value="{{ old('event_date') }}" required />
                            </div>
                            <div>
                                <x-input-label for="start_time" value="Waktu Mulai" />
                                <x-text-input name="start_time" type="time" class="mt-1 block w-full" value="{{ old('start_time') }}" required />
                            </div>
                            <div>
                                <x-input-label for="end_time" value="Waktu Selesai" />
                                <x-text-input name="end_time" type="time" class="mt-1 block w-full" value="{{ old('end_time') }}" required />
                            </div>
                        </div>
                    </div>

                    <!-- 3. Kategori Tiket -->
                    <div class="space-y-4 rounded-2xl bg-secondary/30 p-5 border border-border/50">
                        <div class="border-b border-border/60 pb-2 mb-4 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-foreground">Kategori Tiket</h3>
                            <button type="button" @click="addTicket()" class="text-xs font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                <x-heroicon-o-plus class="w-4 h-4"/> Tambah Tiket
                            </button>
                        </div>

                        <div class="space-y-3">
                            <template x-for="(ticket, index) in tickets" :key="ticket.id">
                                <div class="grid grid-cols-12 gap-3 relative bg-card p-4 rounded-xl border border-border items-end">
                                    <div class="col-span-12 md:col-span-4">
                                        <label class="block text-sm font-medium text-foreground">Nama Kategori</label>
                                        <input type="text" x-bind:name="`tickets[${index}][name]`" x-model="ticket.name" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:ring-blue-500 dark:bg-gray-900 overflow-hidden" placeholder="Misal: VIP, Festival">
                                    </div>
                                    <div class="col-span-12 md:col-span-4">
                                        <label class="block text-sm font-medium text-foreground">Harga (Rp)</label>
                                        <input type="number" min="0" x-bind:name="`tickets[${index}][price]`" x-model="ticket.price" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:ring-blue-500 dark:bg-gray-900" placeholder="0 untuk gratis">
                                    </div>
                                    <div class="col-span-12 md:col-span-3">
                                        <label class="block text-sm font-medium text-foreground">Kuota</label>
                                        <input type="number" min="1" x-bind:name="`tickets[${index}][quota]`" x-model="ticket.quota" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:ring-blue-500 dark:bg-gray-900">
                                    </div>
                                    <div class="col-span-12 md:col-span-1 flex justify-end md:justify-center mb-1">
                                        <button type="button" @click="removeTicket(index)" x-show="tickets.length > 1" class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-neutral-100 transition">
                                            <x-heroicon-o-trash class="w-5 h-5"/>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- 4. Submit & Setup -->
                    <div class="flex items-center justify-between border-t border-border pt-6">
                        <div>
                            <x-input-label for="status" value="Status Publish" />
                            <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 mt-1 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300">
                                <option value="draft">Simpan sbg Draft</option>
                                <option value="published">Langsung Publish</option>
                            </select>
                        </div>
                        <div class="flex gap-4">
                            <a href="{{ route('organizer.events.index') }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                Batal
                            </a>
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                                Simpan Event
                            </x-primary-button>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
