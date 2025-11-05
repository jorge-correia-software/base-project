@props([
    'title' => 'Create New Item',
    'action' => '#',
    'method' => 'POST',
    'cancelRoute' => '#',
])

<div class="row">
    <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-2-5 pb-2-5">
                    <h6 class="text-white text-capitalize ps-3 mb-0">{{ $title }}</h6>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    @if(strtoupper($method) !== 'POST')
                        @method($method)
                    @endif

                    {{ $slot }}

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ $cancelRoute }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn bg-gradient-primary">
                            {{ $submitButton ?? 'Create' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Toggle between focus state (blue) and static label state (gray) for date inputs
    $('.native-date-input').on('focus', function() {
        $(this).closest('.input-group').removeClass('has-static-label').addClass('is-filled');
    }).on('blur', function() {
        $(this).closest('.input-group').removeClass('is-focused is-filled').addClass('has-static-label');
    });

    // Handle textarea focus/blur for Material Design floating labels
    $('.input-group-outline textarea.form-control').on('focus', function() {
        $(this).closest('.input-group').addClass('is-focused');
    }).on('blur', function() {
        $(this).closest('.input-group').removeClass('is-focused');
        // Keep is-filled if textarea has content
        if ($(this).val().trim() !== '') {
            $(this).closest('.input-group').addClass('is-filled');
        } else {
            $(this).closest('.input-group').removeClass('is-filled');
        }
    });
});
</script>
@endpush
