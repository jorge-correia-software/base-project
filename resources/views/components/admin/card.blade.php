@props([
    'title',
    'position' => 'subsequent',  // 'first' or 'subsequent'
    'bodyClass' => 'pb-1',
    'spacing' => null  // Optional: override auto spacing
])

@php
    // Auto-determine spacing based on position
    if ($spacing) {
        $cardSpacing = $spacing;
    } else {
        $cardSpacing = $position === 'first' ? 'mt-4' : 'my-5';
    }
@endphp

<div class="card {{ $cardSpacing }}">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-2-5 pb-2-5">
            <h6 class="text-white text-capitalize ps-3 mb-0">{{ $title }}</h6>
        </div>
    </div>
    <div class="card-body {{ $bodyClass }}">
        {{ $slot }}
    </div>
</div>
