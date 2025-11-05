@props([
    'name',
    'label',
    'value' => '',
    'required' => false,
    'readonly' => false,
    'help' => null,
    'filled' => false,
    'mb' => 'mb-3'
])

<div class="row">
    <div class="col-md-12">
        <div class="input-group input-group-outline {{ $mb }} {{ $filled || old($name, $value) ? 'is-filled' : '' }}">
            <label class="form-label">
                {{ $label }}
                @if($required)
                    <span class="text-danger ms-1">*</span>
                @endif
            </label>
            <input
                type="text"
                id="{{ $name }}"
                name="{{ $name }}"
                class="form-control"
                value="{{ old($name, $value) }}"
                {{ $required ? 'required' : '' }}
                {{ $readonly ? 'readonly disabled' : '' }}
                {{ $attributes }}
            >
        </div>
        @if($help)
            <small class="text-muted text-xs d-block mb-3">{{ $help }}</small>
        @endif
        @error($name)
            <p class="text-danger text-xs mt-2">{{ $message }}</p>
        @enderror
    </div>
</div>
