@props([
    'name',
    'label',
    'value' => '',
    'rows' => 3,
    'required' => false,
    'help' => null,
    'filled' => false,
    'mb' => 'mb-2'
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
            <textarea
                id="{{ $name }}"
                name="{{ $name }}"
                class="form-control"
                rows="{{ $rows }}"
                {{ $required ? 'required' : '' }}
                {{ $attributes }}
            >{{ old($name, $value) }}</textarea>
        </div>
        @if($help)
            <small class="text-muted text-xs d-block mb-3">{{ $help }}</small>
        @endif
        @error($name)
            <p class="text-danger text-xs mt-2">{{ $message }}</p>
        @enderror
    </div>
</div>
