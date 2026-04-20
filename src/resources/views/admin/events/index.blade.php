<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-foreground tracking-tight">
            {{ __('Manajemen Event') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="rounded-3xl border border-border/60 bg-card p-6 shadow-sm">
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-card-foreground">Validasi & Status Event</h2>
                        <p class="text-sm text-muted-foreground mt-1">Tinjau dan setujui status event yang didaftarkan oleh organizer.</p>
                    </div>
                </div>

                @if(session('status'))
                    <div class="mb-4 rounded-xl bg-emerald-100 p-4 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-muted-foreground">
                        <thead class="border-b border-border/60 bg-secondary/30 text-xs uppercase text-muted-foreground">
                            <tr>
                                <th scope="col" class="px-4 py-3 font-semibold">Event</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Organizer</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Kategori</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Waktu</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Status</th>
                                <th scope="col" class="px-4 py-3 text-right font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border/60">
                            @forelse($events as $event)
                            <tr class="transition-colors hover:bg-muted/50">
                                <td class="px-4 py-4">
                                    <div class="font-bold text-foreground line-clamp-1">{{ $event->name }}</div>
                                    <div class="text-xs text-muted-foreground mt-0.5">{{ $event->venue_name }}, {{ $event->city }}</div>
                                </td>
                                <td class="px-4 py-4">
                                    {{ $event->organizer->organizerProfile->organization_name ?? $event->organizer->name ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-4">
                                    {{ $event->category->name ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    {{ $event->event_date?->format('d M Y') }} <br>
                                    <span class="text-xs">{{ $event->start_time }} - {{ $event->end_time }}</span>
                                </td>
                                <td class="px-4 py-4">
                                    @php
                                        $badge = match($event->status) {
                                            'published' => 'bg-emerald-100 text-emerald-700',
                                            'draft' => 'bg-slate-100 text-slate-700',
                                            'completed' => 'bg-blue-100 text-blue-700',
                                            'cancelled' => 'bg-red-100 text-red-700',
                                            default => 'bg-slate-100 text-slate-700',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold uppercase tracking-wider {{ $badge }}">
                                        {{ $event->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="inline-flex items-center text-sm font-medium text-muted-foreground hover:text-foreground">
                                                Aksi
                                                <x-heroicon-s-chevron-down class="ml-1 h-4 w-4" />
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link
                                                x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'update-status-{{ $event->id }}')"
                                                class="cursor-pointer">
                                                Update Status
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>

                                    {{-- Modal Update Status --}}
                                    <x-modal name="update-status-{{ $event->id }}" focusable>
                                        <form method="post" action="{{ route('admin.events.update-status', $event) }}" class="p-6 text-left">
                                            @csrf
                                            @method('put')

                                            <h2 class="text-lg font-bold text-foreground">
                                                Update Status "{{ $event->name }}"
                                            </h2>

                                            <div class="mt-4">
                                                <x-input-label for="status" value="Status Event" />
                                                <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 mt-1 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300">
                                                    <option value="draft" {{ $event->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="published" {{ $event->status === 'published' ? 'selected' : '' }}>Published (Approved)</option>
                                                    <option value="completed" {{ $event->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="cancelled" {{ $event->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                            </div>

                                            <div class="mt-6 flex justify-end gap-3">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    Batal
                                                </x-secondary-button>
                                                <x-primary-button class="bg-red-600 hover:bg-red-700 focus:bg-red-700 active:bg-red-900">
                                                    Simpan Status
                                                </x-primary-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-muted-foreground">Belum ada event terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $events->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
