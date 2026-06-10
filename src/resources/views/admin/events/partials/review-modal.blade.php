<x-admin-panel 
    name="review-event-{{ $event->id }}" 
    title="Audit Kualitas Acara" 
    description="Lakukan verifikasi mendalam terhadap konten acara dan legitimasi penyelenggara."
    width="4xl"
>

    <div class="space-y-12">
        {{-- Bagian umum --}}
        <section id="summary-{{ $event->id }}" class="space-y-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-4 bg-violet-500 rounded-full"></div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Informasi Umum</h3>
                </div>
                <span class="px-2.5 py-0.5 rounded-lg bg-slate-100 text-[10px] font-bold text-slate-600 dark:bg-slate-800 dark:text-slate-400 uppercase border border-slate-200 dark:border-slate-700">
                    {{ $event->category->name }}
                </span>
            </div>

            <div class="grid grid-cols-2 gap-8">
                <div class="space-y-4">
                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Data Waktu</p>
                        <div class="flex items-center gap-2 text-sm font-bold text-slate-900 dark:text-white">
                            <x-heroicon-o-calendar-days class="w-4 h-4 text-violet-500" />
                            {{ $event->event_date->format('l, d F Y') }}
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Data Geografis</p>
                        <div class="flex items-center gap-2 text-sm font-bold text-slate-900 dark:text-white">
                            <x-heroicon-o-map-pin class="w-4 h-4 text-rose-500" />
                            {{ $event->city }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Deskripsi Acara</p>
                <div class="p-6 rounded-2xl glass-panel !bg-transparent text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    {!! $event->description !!}
                </div>
            </div>
        </section>

        {{-- Bagian media --}}
        <section id="media-{{ $event->id }}" class="space-y-6">
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-4 bg-violet-500 rounded-full"></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Aset Media</h3>
            </div>
            <div class="aspect-video rounded-3xl overflow-hidden bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 relative group">
                @if($event->banner_image)
                    <img src="{{ asset('storage/' . $event->banner_image) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                        <x-heroicon-o-photo class="w-16 h-16" />
                    </div>
                @endif
                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <button class="px-4 py-2 rounded-xl bg-white/20 backdrop-blur-md text-white text-xs font-bold uppercase tracking-widest border border-white/30">Lihat Resolusi Penuh</button>
                </div>
            </div>
        </section>

        {{-- Bagian penyelenggara --}}
        <section id="organizer-{{ $event->id }}" class="space-y-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-4 bg-violet-500 rounded-full"></div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Kredensial Penyelenggara</h3>
                </div>
                <a href="{{ route('admin.users.show', $event->organizer) }}" data-link class="text-[10px] font-black text-violet-500 uppercase tracking-widest hover:underline transition-all">Lihat Profil Lengkap</a>
            </div>
            <div class="flex items-center gap-4 p-6 rounded-3xl glass-panel !bg-transparent border border-slate-200 dark:border-slate-800">
                <div class="w-12 h-12 rounded-2xl bg-violet-500 flex items-center justify-center font-bold text-white text-lg">
                    {{ substr($event->organizer->name, 0, 1) }}
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">{{ $event->organizer->name }}</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">{{ $event->organizer->email }}</p>
                </div>
                <div class="ml-auto">
                    <span class="inline-flex items-center px-3 py-1 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold uppercase tracking-wider border border-emerald-500/20">
                        Anggota Terverifikasi
                    </span>
                </div>
            </div>
        </section>
    </div>

    <x-slot name="footer">
        <form method="POST" action="{{ route('admin.events.update-status', $event) }}" class="flex items-center gap-4">
            @csrf
            @method('PUT')
            
            <div class="flex-1 max-w-xs">
                @if($event->status === 'published')
                    <div class="mb-2 p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-start gap-2">
                        <x-heroicon-o-information-circle class="w-4 h-4 text-amber-500 shrink-0 mt-0.5" />
                        <p class="text-[9px] font-bold text-amber-600 dark:text-amber-400 uppercase tracking-widest leading-tight">
                            Kunci Status: Acara telah dipublikasikan. Perubahan status dibatasi hanya ke selesai atau dibatalkan.
                        </p>
                    </div>
                @endif

                <select name="status" class="block w-full glass-panel !bg-transparent rounded-2xl border-slate-200 dark:border-slate-800 text-sm font-bold focus:ring-violet-500/20 py-3">
                    @if($event->status !== 'published')
                        <option value="pending" {{ $event->status === 'pending' ? 'selected' : '' }}>Menunggu Tinjauan</option>
                        <option value="published" {{ $event->status === 'published' ? 'selected' : '' }}>Setujui dan Publikasikan</option>
                        <option value="draft" {{ $event->status === 'draft' ? 'selected' : '' }}>Kembalikan ke Draf</option>
                        <option value="cancelled" {{ $event->status === 'cancelled' ? 'selected' : '' }}>Tolak Acara</option>
                    @else
                        <option value="completed">Tandai Selesai</option>
                        <option value="cancelled">Batalkan Acara</option>
                    @endif
                </select>
            </div>
            
            <div class="ml-auto flex items-center gap-3">
                <button type="button" x-on:click="close()" class="px-6 py-3 rounded-2xl text-sm font-bold text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 transition-colors">
                    Batal Audit
                </button>
                <x-primary-button class="rounded-2xl bg-violet-600 px-8 py-3 text-xs font-bold uppercase tracking-widest shadow-lg shadow-violet-600/20">
                    {{ __('Finalisasi Keputusan') }}
                </x-primary-button>
            </div>
        </form>
    </x-slot>
</x-admin-panel>
