<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-foreground tracking-tight">
            {{ __('Profil Administrator') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 sm:px-6 lg:px-8 space-y-6 mx-auto">

            {{-- 1. Kartu Informasi Profil Utama --}}
            <div class="overflow-hidden rounded-3xl border border-border/60 bg-card shadow-sm">
                <div class="relative h-32 bg-gradient-to-r from-red-600 to-rose-600">
                    {{-- Hiasan latar aksen --}}
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
                </div>

                <div class="relative px-6 pb-6 pt-8 sm:px-8 sm:pb-8">
                    {{-- Avatar --}}
                    <div class="absolute -top-16 flex h-24 w-24 items-center justify-center rounded-2xl bg-white p-1.5 shadow-lg border border-border/40">
                        <div class="flex h-full w-full items-center justify-center rounded-xl bg-red-100 text-3xl font-bold text-red-600">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mt-8 sm:mt-0">
                        <div>
                            <h1 class="text-2xl font-extrabold tracking-tight text-card-foreground">
                                {{ $user->name }}
                            </h1>
                            <p class="text-sm font-medium text-muted-foreground mt-1 flex items-center gap-2">
                                <x-heroicon-s-envelope class="h-4 w-4 text-red-500" />
                                {{ $user->email }}
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 font-mono text-[10px] font-bold uppercase tracking-widest text-red-700 dark:bg-red-500/20 dark:text-red-400">
                                {{ $user->role->label() }}
                            </span>
                            @if($user->is_active)
                            <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 font-mono text-[10px] font-bold uppercase tracking-widest text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">
                                Aktif
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Sistem / Panel Admin Ringkas --}}
            <div class="rounded-3xl border border-border/60 bg-card p-6 shadow-sm sm:p-8">
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-card-foreground">Akses Cepat Sistem</h2>
                        <p class="text-sm text-muted-foreground mt-1">Gunakan panel ini untuk mengawasi fitur platform.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.users.index') }}" class="group rounded-2xl border border-dashed border-border/80 bg-secondary/50 hover:bg-secondary/80 p-6 flex flex-col items-center justify-center text-center transition">
                       <x-heroicon-o-users class="h-8 w-8 text-red-500 mb-2 group-hover:scale-110 transition-transform" />
                       <h3 class="font-bold text-foreground">Kelola Pengguna</h3>
                       <p class="text-xs text-muted-foreground mt-1">Supervisi akun pengguna dan organizer.</p>
                    </a>
                    <a href="{{ route('admin.events.index') }}" class="group rounded-2xl border border-dashed border-border/80 bg-secondary/50 hover:bg-secondary/80 p-6 flex flex-col items-center justify-center text-center transition">
                       <x-heroicon-o-calendar-days class="h-8 w-8 text-red-500 mb-2 group-hover:scale-110 transition-transform" />
                       <h3 class="font-bold text-foreground">Validasi Event</h3>
                       <p class="text-xs text-muted-foreground mt-1">Tinjau event yang masuk ke dalam sistem.</p>
                    </a>
                </div>
            </div>

            {{-- 3. Pengaturan Akun Dasar --}}
            <div class="rounded-3xl border border-border/60 bg-card p-6 shadow-sm sm:p-8">
                <div class="mb-6">
                    <h2 class="text-xl font-bold tracking-tight text-card-foreground">Pengaturan Akun</h2>
                    <p class="text-sm text-muted-foreground mt-1">Kelola data keamanan profil Anda.</p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <a href="{{ route('profile.edit') }}" class="group flex items-start gap-4 rounded-2xl border border-border/60 bg-background p-4 transition-all hover:border-red-300 hover:shadow-md hover:shadow-red-500/5">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600 dark:bg-red-500/20 dark:text-red-400">
                            <x-heroicon-o-user-circle class="h-5 w-5" />
                        </div>
                        <div>
                            <h3 class="font-bold text-foreground group-hover:text-red-600 transition-colors">Edit Informasi Akun</h3>
                            <p class="mt-1 text-xs text-muted-foreground">Ubah detail personal admin.</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
