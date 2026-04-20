<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-foreground tracking-tight">
            {{ __('Profil Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 sm:px-6 lg:px-8 space-y-6 mx-auto">

            {{-- 1. Kartu Informasi Profil Utama --}}
            <div class="overflow-hidden rounded-3xl border border-border/60 bg-card shadow-sm">
                <div class="relative h-32 bg-gradient-to-r from-violet-600 to-indigo-600">
                    {{-- Hiasan latar aksen --}}
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
                </div>

                <div class="relative px-6 pb-6 pt-8 sm:px-8 sm:pb-8">
                    {{-- Avatar --}}
                    <div class="absolute -top-16 flex h-24 w-24 items-center justify-center rounded-2xl bg-white p-1.5 shadow-lg border border-border/40">
                        <div class="flex h-full w-full items-center justify-center rounded-xl bg-violet-100 text-3xl font-bold text-violet-600">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mt-8 sm:mt-0">
                        <div>
                            <h1 class="text-2xl font-extrabold tracking-tight text-card-foreground">
                                {{ $user->name }}
                            </h1>
                            <p class="text-sm font-medium text-muted-foreground mt-1 flex items-center gap-2">
                                <x-heroicon-s-envelope class="h-4 w-4 text-violet-500" />
                                {{ $user->email }}
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center rounded-full bg-violet-100 px-3 py-1 font-mono text-[10px] font-bold uppercase tracking-widest text-violet-700 dark:bg-violet-500/20 dark:text-violet-400">
                                {{ $user->role->label() }}
                            </span>
                            @if($user->is_active)
                            <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 font-mono text-[10px] font-bold uppercase tracking-widest text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">
                                Aktif
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="border-t border-border/60 border-dashed mt-6 pt-6 grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div class="bg-secondary/50 rounded-2xl p-4 border border-border/30">
                            <p class="text-muted-foreground mb-1 text-xs uppercase tracking-wider font-semibold">Total Order</p>
                            <p class="text-lg font-extrabold text-foreground">{{ $recentOrders->count() }}</p>
                        </div>
                        <div class="bg-secondary/50 rounded-2xl p-4 border border-border/30">
                            <p class="text-muted-foreground mb-1 text-xs uppercase tracking-wider font-semibold">Member Sejak</p>
                            <p class="text-foreground font-semibold">{{ $user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Section Pesanan Saya (Aktifitas Pembelian Terakhir) --}}
            <div class="rounded-3xl border border-border/60 bg-card p-6 shadow-sm sm:p-8">
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-card-foreground">Aktivitas Pembelian Terakhir</h2>
                        <p class="text-sm text-muted-foreground mt-1">Riwayat pesanan tiket event Anda akhir-akhir ini.</p>
                    </div>
                    <a href="{{ route('pesanan.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-violet-50 px-4 py-2 text-sm font-semibold text-violet-700 transition hover:bg-violet-100 hover:text-violet-800 dark:bg-violet-500/10 dark:text-violet-400 dark:hover:bg-violet-500/20">
                        Lihat Semua
                        <x-heroicon-o-arrow-right class="h-4 w-4" />
                    </a>
                </div>

                @if($recentOrders->isEmpty())
                <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-border/80 bg-secondary/50 py-12 text-center">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-violet-100 text-violet-500 dark:bg-violet-500/20 mb-4">
                        <x-heroicon-o-ticket class="h-8 w-8" />
                    </div>
                    <h3 class="text-base font-bold text-foreground">Belum Ada Transaksi</h3>
                    <p class="mt-2 max-w-sm text-sm text-muted-foreground">Anda belum melakukan pembelian tiket apapun. Temukan event menarik sekarang.</p>
                    <a href="{{ route('events.index') }}" class="mt-5 inline-flex items-center justify-center rounded-xl bg-violet-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-violet-700">
                        Jelajahi Event
                    </a>
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-muted-foreground">
                        <thead class="border-b border-border/60 bg-secondary/30 text-xs uppercase text-muted-foreground">
                            <tr>
                                <th scope="col" class="px-4 py-3 font-semibold">Event</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Tanggal</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Status</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Total</th>
                                <th scope="col" class="px-4 py-3 text-right font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border/60">
                            @foreach($recentOrders as $order)
                            @php
                                $badgeClass = match(strtolower($order->status)) {
                                    'paid', 'sukses', 'success' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400',
                                    'pending' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400',
                                    'cancelled', 'batal' => 'bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400',
                                    default => 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300',
                                };
                            @endphp
                            <tr class="transition-colors hover:bg-muted/50">
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-secondary overflow-hidden">
                                            @if($order->event?->banner_image)
                                                <img src="{{ asset('img/' . $order->event->banner_image) }}" alt="" class="h-full w-full object-cover">
                                            @else
                                                <span class="text-lg">🎫</span>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-foreground line-clamp-1">{{ $order->event->name ?? 'Event Dihapus' }}</div>
                                            <div class="text-xs text-muted-foreground font-mono mt-0.5">#{{ $order->midtrans_order_id ?? strtoupper(substr($order->id, 0, 8)) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4">
                                    {{ $order->created_at->translatedFormat('d M Y') }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-4">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold uppercase tracking-wider {{ $badgeClass }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 font-semibold text-foreground">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-right">
                                    <a href="#" class="inline-flex items-center justify-center rounded-lg border border-border bg-background px-3 py-1.5 text-xs font-semibold text-foreground shadow-sm transition-colors hover:bg-secondary hover:text-violet-600">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            {{-- 3. Pengaturan Akun Dasar (Shortcut) --}}
            <div class="rounded-3xl border border-border/60 bg-card p-6 shadow-sm sm:p-8">
                <div class="mb-6">
                    <h2 class="text-xl font-bold tracking-tight text-card-foreground">Pengaturan Akun</h2>
                    <p class="text-sm text-muted-foreground mt-1">Kelola data keamanan dan preferensi profil Anda.</p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <a href="{{ route('profile.edit') }}" class="group flex items-start gap-4 rounded-2xl border border-border/60 bg-background p-4 transition-all hover:border-violet-300 hover:shadow-md hover:shadow-violet-500/5">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-violet-100 text-violet-600 dark:bg-violet-500/20 dark:text-violet-400">
                            <x-heroicon-o-user-circle class="h-5 w-5" />
                        </div>
                        <div>
                            <h3 class="font-bold text-foreground group-hover:text-violet-600 transition-colors">Edit Informasi Akun</h3>
                            <p class="mt-1 text-xs text-muted-foreground">Ubah nama, email, atau detail personal lainnya.</p>
                        </div>
                    </a>

                    <a href="{{ route('profile.edit') }}#password" class="group flex items-start gap-4 rounded-2xl border border-border/60 bg-background p-4 transition-all hover:border-violet-300 hover:shadow-md hover:shadow-violet-500/5">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-400">
                            <x-heroicon-o-lock-closed class="h-5 w-5" />
                        </div>
                        <div>
                            <h3 class="font-bold text-foreground group-hover:text-emerald-600 transition-colors">Keamanan Password</h3>
                            <p class="mt-1 text-xs text-muted-foreground">Perbarui kata sandi untuk menjaga keamanan akun.</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
