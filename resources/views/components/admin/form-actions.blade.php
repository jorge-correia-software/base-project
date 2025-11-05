@props([
    'cancelRoute',
    'submitText' => 'Submit',
    'cancelText' => 'Cancel'
])

<div class="d-flex gap-2 justify-content-end mt-3 mb-0">
    <a href="{{ $cancelRoute }}" class="btn btn-secondary btn-sm">{{ $cancelText }}</a>
    <button type="submit" class="btn bg-gradient-primary btn-sm">{{ $submitText }}</button>
</div>
