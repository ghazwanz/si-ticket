<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-foreground tracking-tight">
            {{ __('Manajemen Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="rounded-3xl border border-border/60 bg-card p-6 shadow-sm">
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-card-foreground">Daftar Pengguna & Event Organizer</h2>
                        <p class="text-sm text-muted-foreground mt-1">Supervisi, kelola peran, dan ubah status akun dari pengguna aplikasi.</p>
                    </div>

                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-user')" class="inline-flex items-center gap-2 rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700">
                        <x-heroicon-o-plus class="h-4 w-4" /> Tambah Pengguna
                    </button>
                </div>

                @if(session('status'))
                    <div class="mb-4 rounded-xl bg-emerald-100 p-4 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 rounded-xl bg-red-100 p-4 text-red-800 dark:bg-red-500/20 dark:text-red-400">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-muted-foreground">
                        <thead class="border-b border-border/60 bg-secondary/30 text-xs uppercase text-muted-foreground">
                            <tr>
                                <th scope="col" class="px-4 py-3 font-semibold">Nama</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Email</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Role</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Status</th>
                                <th scope="col" class="px-4 py-3 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border/60">
                            @forelse($users as $user)
                            <tr class="transition-colors hover:bg-muted/50">
                                <td class="px-4 py-4 font-semibold text-foreground">
                                    {{ $user->name }}
                                </td>
                                <td class="px-4 py-4 text-muted-foreground">
                                    {{ $user->email }}
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-bold uppercase tracking-wider text-slate-700 dark:bg-slate-800 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                                        {{ $user->role->label() }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    @if($user->is_active)
                                    <span class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-bold uppercase tracking-wider text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">
                                        Aktif
                                    </span>
                                    @else
                                    <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-bold uppercase tracking-wider text-red-700 dark:bg-red-500/20 dark:text-red-400">
                                        Nonaktif
                                    </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <div class="flex items-center justify-end gap-3 text-xs">
                                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-user-{{ $user->id }}')" class="text-blue-500 font-bold hover:text-blue-700 transition">
                                            Edit
                                        </button>
                                        <span class="text-border/50">|</span>
                                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete-user-{{ $user->id }}')" class="text-red-500 font-bold hover:text-red-700 transition">
                                            Delete
                                        </button>
                                    </div>

                                    {{-- Modal Edit User --}}
                                    <x-modal name="edit-user-{{ $user->id }}" focusable>
                                        <form method="post" action="{{ route('admin.users.update', $user) }}" class="p-6 text-left">
                                            @csrf
                                            @method('put')

                                            <h2 class="text-lg font-bold text-foreground">Detail Pengguna</h2>

                                            <div class="mt-4 grid gap-4">
                                                <div>
                                                    <x-input-label for="name" value="Nama Lengkap" />
                                                    <x-text-input name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $user->name) }}" required />
                                                </div>
                                                <div>
                                                    <x-input-label for="email" value="Ubah Email" />
                                                    <x-text-input name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $user->email) }}" required />
                                                </div>
                                                <div>
                                                    <x-input-label for="password" value="Ubah Kata Sandi Baru (Kosongkan bila tiada ubahan)" />
                                                    <x-text-input name="password" type="password" class="mt-1 block w-full" />
                                                </div>
                                                <div class="grid grid-cols-2 gap-4">
                                                    <div>
                                                        <x-input-label for="role" value="Role Akses" />
                                                        <select name="role" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 mt-1 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" required>
                                                            <option value="user" {{ $user->role->value === 'user' ? 'selected' : '' }}>Reguler User</option>
                                                            <option value="organizer" {{ $user->role->value === 'organizer' ? 'selected' : '' }}>Event Organizer</option>
                                                            <option value="admin" {{ $user->role->value === 'admin' ? 'selected' : '' }}>Administrator</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <x-input-label for="is_active" value="Status Akun" />
                                                        <select name="is_active" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 mt-1 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" required>
                                                            <option value="1" {{ $user->is_active ? 'selected' : '' }}>Aktif</option>
                                                            <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Nonaktifkan / Banned</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-6 flex justify-end gap-3">
                                                <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
                                                <x-primary-button class="bg-red-600 hover:bg-red-700 focus:bg-red-700 active:bg-red-900">Perbarui Detail</x-primary-button>
                                            </div>
                                        </form>
                                    </x-modal>

                                    {{-- Modal Delete User --}}
                                    <x-modal name="delete-user-{{ $user->id }}" focusable>
                                        <form method="post" action="{{ route('admin.users.destroy', $user) }}" class="p-6 text-left">
                                            @csrf
                                            @method('delete')
                                            <h2 class="text-lg font-bold text-foreground">Hapus Akun Pengguna</h2>
                                            <p class="mt-2 text-sm text-muted-foreground">Apakah Anda yakin ingin menghapus <strong>{{ $user->name }}</strong>? Data yang terhubung mungkin akan ikut terhapus.</p>

                                            <div class="mt-6 flex justify-end gap-3">
                                                <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
                                                <x-danger-button>Ya, Hapus Permanen</x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-muted-foreground">Belum ada pengguna.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>

            {{-- Modal Create User --}}
            <x-modal name="create-user" focusable>
                <form method="post" action="{{ route('admin.users.store') }}" class="p-6 text-left">
                    @csrf

                    <h2 class="text-lg font-bold text-foreground">Tambah Pengguna Baru</h2>

                    <div class="mt-4 grid gap-4">
                        <div>
                            <x-input-label for="name" value="Nama Lengkap" />
                            <x-text-input name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}" required />
                        </div>
                        <div>
                            <x-input-label for="email" value="Alamat Email" />
                            <x-text-input name="email" type="email" class="mt-1 block w-full" value="{{ old('email') }}" required />
                        </div>
                        <div>
                            <x-input-label for="password" value="Kata Sandi Awalan" />
                            <x-text-input name="password" type="password" class="mt-1 block w-full" required />
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="role" value="Role Akses" />
                                <select name="role" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 mt-1 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" required>
                                    <option value="user">Reguler User</option>
                                    <option value="organizer">Event Organizer</option>
                                    <option value="admin">Administrator</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="is_active" value="Status Akun" />
                                <select name="is_active" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 mt-1 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" required>
                                    <option value="1" selected>Aktif</option>
                                    <option value="0">Nonaktifkan / Banned</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
                        <x-primary-button class="bg-red-600 hover:bg-red-700 focus:bg-red-700 active:bg-red-900">Tambahkan</x-primary-button>
                    </div>
                </form>
            </x-modal>

        </div>
    </div>
</x-app-layout>
