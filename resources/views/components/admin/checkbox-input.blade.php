@props([
    'name',
    'label',
    'value' => '1',
    'checked' => false
])

<div class="form-check mb-3">
    <input
        class="form-check-input"
        type="checkbox"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
        {{ old($name, $checked) ? 'checked' : '' }}
        {{ $attributes }}
    >
    <label class="form-check-label" for="{{ $name }}">
        {{ $label }}
    </label>
</div>
