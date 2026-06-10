@props(['label', 'sort' => null])

@php
    $currentSort = request()->query('sort');
    $currentOrder = request()->query('order', 'desc');
    $isActive = $currentSort === $sort;
    $nextOrder = ($isActive && $currentOrder === 'asc') ? 'desc' : 'asc';
    
    $url = $sort 
        ? request()->fullUrlWithQuery(array_merge(request()->except('page'), ['sort' => $sort, 'order' => $nextOrder])) 
        : null;
@endphp

<th {{ $attributes->merge(['class' => 'px-8 py-5 text-[10px] font-bold tracking-[0.2em] text-slate-400 uppercase']) }}>
    @if($sort)
        <a href="{{ $url }}" data-link class="group inline-flex items-center gap-1 hover:text-slate-900 dark:hover:text-white transition-colors">
            {{ $label }}
            <div class="flex flex-col ml-1 {{ $isActive ? 'opacity-100' : 'opacity-20 group-hover:opacity-60' }} transition-opacity">
                @if($isActive && $currentOrder === 'asc')
                    <x-heroicon-s-chevron-up class="w-3 h-3 text-violet-500" />
                @elseif($isActive && $currentOrder === 'desc')
                    <x-heroicon-s-chevron-down class="w-3 h-3 text-violet-500" />
                @else
                    <x-heroicon-s-chevron-up-down class="w-3 h-3" />
                @endif
            </div>
        </a>
    @else
        {{ $label }}
    @endif
</th>
