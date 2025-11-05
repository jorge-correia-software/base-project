@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')
<x-page-header
    icon="category"
    title="Create Category"
    subtitle="Create a new category for organizing content"
    :backRoute="route('admin.categories.index')"
/>

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-2-5 pb-2-5">
                    <h6 class="text-white text-capitalize ps-3 mb-0">Create New Category</h6>
                </div>
            </div>
            <div class="card-body pb-2">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <fieldset class="form-fieldset mb-4">
                        <legend>Category Details</legend>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-outline mb-3 {{ old('name') ? 'is-filled' : '' }}">
                                    <label class="form-label">Category Name <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                                </div>
                                @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-outline mb-2 {{ old('slug') ? 'is-filled' : '' }}">
                                    <label class="form-label">Slug</label>
                                    <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') }}" readonly style="pointer-events: none; cursor: not-allowed; background-color: #f8f9fa;">
                                </div>
                                <small class="text-muted text-xs d-block mb-3">Auto-generated from category name</small>
                                @error('slug')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-outline mb-3 {{ old('description') ? 'is-filled' : '' }}">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="form-fieldset mb-2">
                        <legend>Category Settings</legend>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                        <option value="">No parent (top level)</option>
                                        @foreach($parentCategories as $parent)
                                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                                {{ $parent->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="d-flex gap-2 justify-content-end mt-3">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                        <button type="submit" class="btn bg-gradient-primary btn-sm">Create Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Make Select2 match Material Dashboard form-control styling */
.select2-container--default .select2-selection--single {
    border: 1px solid #d2d6da !important;
    border-radius: 0.375rem !important;
    height: 40px !important;
    padding: 0.375rem 0.75rem !important;
    font-size: 0.875rem !important;
    line-height: 1.5 !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #495057 !important;
    line-height: 24px !important;
    padding-left: 0 !important;
    font-size: 0.875rem !important;
}

.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #6c757d !important;
    font-size: 0.875rem !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 38px !important;
}

.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #3A416F !important;
}

/* Make Select2 dropdown results match form-control font size */
.select2-results__option {
    font-size: 0.875rem !important;
}

.select2-dropdown {
    border: 1px solid #d2d6da !important;
    border-radius: 0.375rem !important;
}

.select2-results__message {
    font-size: 0.875rem !important;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2 for Parent Category single-select
    $('#parent_id').select2({
        placeholder: 'Select Parent Category',
        allowClear: true,
        width: '100%'
    });
});
</script>
@endpush