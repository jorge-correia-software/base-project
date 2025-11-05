@props([
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => 'Select...',
    'required' => false,
    'multiple' => false,
    'help' => null,
    'mb' => 'mb-3',
    'select2' => true
])

<div class="{{ $mb }}">
    @if($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <select
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        id="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror"
        {{ $required ? 'required' : '' }}
        {{ $multiple ? 'multiple' : '' }}
        {{ $attributes }}
    >
        @if(!$multiple && $placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        {{ $slot }}
    </select>

    @if($help)
        <small class="text-muted text-xs d-block mb-3">{{ $help }}</small>
    @endif

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if($select2)
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#{{ $name }}').select2({
                    placeholder: '{{ $placeholder }}',
                    allowClear: true,
                    width: '100%'
                });
            });
        </script>
    @endpush
@endif
