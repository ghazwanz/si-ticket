@props(['active', 'icon'])

<a {{ $attributes->merge(['class' => 'flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-colors ' . ($active ? 'bg-white/10 text-white' : 'text-purple-200 hover:bg-white/5 hover:text-white')]) }}>
    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        @switch($icon)
            @case('dashboard')
                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
                @break
            @case('events')
                <rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>
                @break
            @case('merchandise')
                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18M16 10a4 4 0 11-8 0"/>
                @break
            @case('scanner')
                <path d="M12 4v1m6 11h2m-6 0h-2m4 0v-5a2 2 0 00-2-2h-2a2 2 0 00-2 2v5m4 0h-4m-4 2v-4m0 0V6a2 2 0 012-2h4a2 2 0 012 2v7m-8 4h8m-4-8v.01"/>
                @break
            @case('settings')
                <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 00-14.14 0M4.93 19.07a10 10 0 0014.14 0M19.07 19.07a10 10 0 000-14.14M4.93 4.93a10 10 0 000 14.14"/>
                @break
        @endswitch
    </svg>
    {{ $slot }}
</a>