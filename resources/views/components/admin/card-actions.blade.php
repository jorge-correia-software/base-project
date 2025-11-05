{{--
    Card Actions Component - Standardized Button Wrapper

    Provides consistent spacing for buttons at the bottom of cards
    Built-in spacing: mt-3 mb-0 (gap from content above, flush with card bottom)

    Usage Examples:
    - Single button: <x-admin.card-actions buttonText="Add to Menu" buttonId="addBtn" />
    - Slot content: <x-admin.card-actions><button>Custom</button></x-admin.card-actions>
--}}

@props([
    'buttonText' => null,
    'buttonId' => null,
    'buttonType' => 'button',
    'buttonClass' => 'btn bg-gradient-primary btn-sm',
    'align' => 'end'  // 'start', 'center', 'end'
])

<div class="d-flex justify-content-{{ $align }} mt-3 mb-0">
    @if($buttonText)
        <button type="{{ $buttonType }}" @if($buttonId) id="{{ $buttonId }}" @endif class="{{ $buttonClass }}">
            {{ $buttonText }}
        </button>
    @else
        {{ $slot }}
    @endif
</div>
