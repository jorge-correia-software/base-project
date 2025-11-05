@extends('layouts.admin')

@section('title', 'Create Menu')

@section('content')
<x-page-header
    icon="menu"
    title="Create Menu"
    subtitle="Create a new navigation menu"
    :backRoute="route('admin.menus.index')"
/>

<div class="row">
    <div class="col-12 col-xl-6 mx-auto">
        <form action="{{ route('admin.menus.store') }}" method="POST">
            @csrf

            <x-admin.card title="Create New Menu" position="first">
                <x-admin.form-fieldset legend="Menu Details">
                    <x-admin.text-input
                        name="name"
                        label="Menu Name"
                        required
                    />

                    <x-admin.text-input
                        name="slug"
                        label="Slug"
                        readonly
                        help="Auto-generated from name"
                        mb="mb-3"
                    />

                    <x-admin.form-fieldset legend="Menu Location" mb="mb-3">
                        <div class="mb-2">
                            <select name="location" id="location" class="form-control @error('location') is-invalid @enderror" required>
                                <option value="">Select Location</option>
                                <option value="header" {{ old('location') === 'header' ? 'selected' : '' }}>Header</option>
                                <option value="footer" {{ old('location') === 'footer' ? 'selected' : '' }}>Footer</option>
                                <option value="sidebar" {{ old('location') === 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                            </select>
                            @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </x-admin.form-fieldset>

                    <x-admin.checkbox-input
                        name="is_active"
                        label="Active Menu"
                        :checked="true"
                        mb="mb-0"
                    />
                </x-admin.form-fieldset>

                <x-admin.form-actions
                    :cancelRoute="route('admin.menus.index')"
                    submitText="Create Menu"
                />
            </x-admin.card>
        </form>
    </div>
</div>

<x-admin.select2-styles />

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-generate slug from name
    $('input[name="name"]').on('keyup', function() {
        const name = $(this).val();
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        $('input[name="slug"]').val(slug);
    });

    // Initialize Select2 for Location
    $('#location').select2({
        placeholder: 'Select Location',
        allowClear: true,
        width: '100%'
    });
});
</script>
@endpush
