@props([
    'name',
    'label' => null,
    'value' => '',
    'required' => false,
    'help' => null,
    'mb' => 'mb-2'
])

<div class="input-group input-group-outline {{ $mb }}">
    @if($label)
        <label for="{{ $name }}" class="form-label sr-only">{{ $label }}</label>
    @endif
    <input
        type="datetime-local"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control native-date-input @error($name) is-invalid @enderror"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
@if($help)
    <small class="text-muted text-xs d-block mb-3">{{ $help }}</small>
@endif
