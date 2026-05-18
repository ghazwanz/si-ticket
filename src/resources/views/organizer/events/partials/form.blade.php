@php
    $event ??= null;
    $method ??= 'POST';
    $submitLabel ??= 'Simpan Acara';
    $ticketRows = old('tickets')
        ?? ($event?->ticketCategories?->map(fn ($ticket) => [
            'id' => (string) $ticket->id,
            'name' => $ticket->name,
            'price' => $ticket->price,
            'quota' => $ticket->quota,
        ])->values()->all() ?: [[
            'id' => 'ticket-1',
            'name' => '',
            'price' => 0,
            'quota' => 100,
        ]]);
@endphp

<div class="max-w-4xl mx-auto">
    <form method="POST" action="{{ $action }}" class="space-y-6" x-data="{
        tickets: @js($ticketRows),
        addTicket() {
            this.tickets.push({ id: `ticket-${Date.now()}`, name: '', price: 0, quota: 100 });
        },
        removeTicket(index) {
            if (this.tickets.length > 1) {
                this.tickets.splice(index, 1);
            }
        }
    }">
        @csrf
        @if($method !== 'POST')
            @method($method)
        @endif

        <div class="glass-panel rounded-2xl p-6 shadow-sm border border-white/60 dark:border-white/10">
            <h3 class="text-lg font-extrabold tracking-tight text-slate-950 dark:text-white mb-4">Informasi Dasar</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Nama Acara</label>
                    <input type="text" name="name" value="{{ old('name', $event?->name) }}" required class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
                    @error('name')<p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Kategori Acara</label>
                    <select name="category_id" required class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
                        <option value="">Pilih kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $event?->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Deskripsi Acara</label>
                <textarea name="description" rows="4" required class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">{{ old('description', $event?->description) }}</textarea>
                @error('description')<p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="glass-panel rounded-2xl p-6 shadow-sm border border-white/60 dark:border-white/10">
            <h3 class="text-lg font-extrabold tracking-tight text-slate-950 dark:text-white mb-4">Lokasi dan Waktu Pelaksanaan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Nama Tempat</label>
                    <input type="text" name="venue_name" value="{{ old('venue_name', $event?->venue_name) }}" placeholder="Misal: GBK Hall A" required class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
                    @error('venue_name')<p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Kota</label>
                    <input type="text" name="city" value="{{ old('city', $event?->city) }}" placeholder="Misal: Jakarta Pusat" required class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
                    @error('city')<p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Alamat Lengkap Tempat</label>
                <input type="text" name="address" value="{{ old('address', $event?->address) }}" required class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
                @error('address')<p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Tanggal Acara</label>
                    <input type="date" name="event_date" value="{{ old('event_date', $event?->event_date?->format('Y-m-d')) }}" required class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
                    @error('event_date')<p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Waktu Mulai</label>
                    <input type="time" name="start_time" value="{{ old('start_time', $event?->start_time ? substr((string) $event->start_time, 0, 5) : null) }}" required class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
                    @error('start_time')<p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Waktu Selesai</label>
                    <input type="time" name="end_time" value="{{ old('end_time', $event?->end_time ? substr((string) $event->end_time, 0, 5) : null) }}" required class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
                    @error('end_time')<p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="glass-panel rounded-2xl p-6 shadow-sm border border-white/60 dark:border-white/10">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-extrabold tracking-tight text-slate-950 dark:text-white">Kategori Tiket</h3>
                <button type="button" @click="addTicket()" class="text-sm font-bold text-violet-600 hover:text-violet-800 dark:text-violet-400 flex items-center gap-1">
                    <x-heroicon-o-plus class="w-4 h-4" />
                    Tambah Tiket
                </button>
            </div>
            <div class="space-y-4">
                <template x-for="(ticket, index) in tickets" :key="ticket.id">
                    <div class="grid grid-cols-12 gap-3 p-4 rounded-xl border border-slate-100 dark:border-slate-800 bg-white/70 dark:bg-white/5 items-end">
                        <div class="col-span-12 md:col-span-4">
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Nama Kategori</label>
                            <input type="text" :name="`tickets[${index}][name]`" x-model="ticket.name" required class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500" placeholder="Misal: VIP, Festival">
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Harga (Rp)</label>
                            <input type="number" min="0" :name="`tickets[${index}][price]`" x-model="ticket.price" required class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500" placeholder="0 untuk gratis">
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Kuota</label>
                            <input type="number" min="1" :name="`tickets[${index}][quota]`" x-model="ticket.quota" required class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
                        </div>
                        <div class="col-span-12 md:col-span-2 flex justify-end">
                            <button type="button" @click="removeTicket(index)" x-show="tickets.length > 1" class="text-rose-500 hover:text-rose-700 p-2 rounded-lg hover:bg-rose-500/10">
                                <x-heroicon-o-trash class="w-5 h-5" />
                            </button>
                        </div>
                    </div>
                </template>
                @error('tickets')<p class="text-xs font-semibold text-rose-500">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between glass-panel rounded-2xl p-6 shadow-sm border border-white/60 dark:border-white/10">
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Status Penerbitan</label>
                <select name="status" class="rounded-xl border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900/80 text-slate-900 dark:text-white shadow-sm focus:border-violet-500 focus:ring-violet-500">
                    <option value="draft" {{ old('status', $event?->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Simpan sebagai draf</option>
                    <option value="published" {{ old('status', $event?->status) === 'published' ? 'selected' : '' }}>Terbitkan langsung</option>
                </select>
                @error('status')<p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p>@enderror
            </div>
            <div class="flex gap-3">
                <a href="{{ route('organizer.events.index') }}" data-link class="px-5 py-2.5 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-white/5 font-bold">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-bold rounded-xl hover:from-violet-700 hover:to-indigo-700 shadow-sm">{{ $submitLabel }}</button>
            </div>
        </div>
    </form>
</div>
