@props([
    'href',
    'label',
    'variant' => 'primary',
    'icon' => null,
    'iconText' => null,
    'badge' => null,
    'class' => '',
])

@php
    $variantClasses = [
        'primary' => 'btn-primary',
        'danger' => 'btn-danger',
        'secondary' => 'btn-secondary',
        'success' => 'btn-success',
        'warning' => 'btn-warning',
        'info' => 'btn-info',
    ];

    $buttonClass = $variantClasses[$variant] ?? 'btn-primary';
@endphp

<a href="{{ $href }}" class="btn {{ $buttonClass }} btn-sm {{ $class }}">
    @if($icon)
        <i class="material-symbols-rounded" style="font-size: 0.8rem; vertical-align: middle; line-height: 1; transform: translateY(-1px); display: inline-block;">{{ $icon }}</i>
    @endif

    @if($iconText)
        <span style="font-size: 1rem; font-weight: bold; line-height: 1; vertical-align: middle; transform: translateY(-2px); display: inline-block;">{{ $iconText }}</span>
    @endif

    {{ $label }}

    @if($badge !== null && $badge > 0)
        <span class="badge bg-white text-dark rounded-circle ms-2" style="width: 14px; height: 14px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.5rem; font-weight: 600;">{{ $badge }}</span>
    @endif
</a>
