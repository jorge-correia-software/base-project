@props([
    'column' => '',
    'label' => '',
    'class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7',
])

@php
    $currentSort = request('sort_by');
    $currentDir = request('sort_dir', 'asc');
    $isActive = $currentSort === $column;
    $nextDir = $isActive && $currentDir === 'asc' ? 'desc' : 'asc';

    // Build query parameters preserving existing ones
    $queryParams = array_merge(request()->except(['sort_by', 'sort_dir']), [
        'sort_by' => $column,
        'sort_dir' => $nextDir,
    ]);

    // Check if centered
    $isCentered = str_contains($class, 'text-center');
    $flexClass = $isCentered ? 'd-flex align-items-center justify-content-center' : 'd-flex align-items-center';
@endphp

<th class="{{ $class }} cursor-pointer" {{ $attributes }}>
    <a href="{{ request()->url() }}?{{ http_build_query($queryParams) }}" class="text-secondary text-decoration-none {{ $flexClass }}">
        <span>{{ $label }}</span>
        @if($isActive)
            @if($currentDir === 'asc')
                <i class="material-symbols-rounded text-xs ms-1">arrow_upward</i>
            @else
                <i class="material-symbols-rounded text-xs ms-1">arrow_downward</i>
            @endif
        @else
            <i class="material-symbols-rounded text-xs ms-1 opacity-3">unfold_more</i>
        @endif
    </a>
</th>
