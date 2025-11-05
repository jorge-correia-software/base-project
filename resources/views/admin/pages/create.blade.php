@extends('layouts.admin')

@section('title', 'Create Page')

@section('content')
<x-page-header
    icon="article"
    title="Create Page"
    subtitle="Create a new static page"
    :backRoute="route('admin.pages.index')"
/>

<div class="row">
    <div class="col-12 col-xl-8 mx-auto">
        <form action="{{ route('admin.pages.store') }}" method="POST">
            @csrf

            <div class="row">
                <!-- Left Column: Page Details -->
                <div class="col-lg-8">
                    <x-admin.card title="Create New Page" position="first">
                        <x-admin.form-fieldset legend="Page Details">
                            <x-admin.text-input
                                name="title"
                                label="Page Title"
                                required
                            />

                            <x-admin.text-input
                                name="slug"
                                label="Slug"
                                readonly
                                help="Auto-generated from title"
                                mb="mb-2"
                            />

                            <x-admin.quill-editor
                                name="content"
                                label="Page Content"
                                required
                            />
                        </x-admin.form-fieldset>
                    </x-admin.card>

                    <x-admin.card title="SEO Settings">
                        <x-admin.form-fieldset legend="Meta Information" mb="mb-2">
                            <x-admin.text-input
                                name="seo[meta_title]"
                                label="Meta Title"
                            />

                            <x-admin.textarea-input
                                name="seo[meta_description]"
                                label="Meta Description"
                                rows="3"
                                mb="mb-0"
                            />
                        </x-admin.form-fieldset>
                    </x-admin.card>
                </div>

                <!-- Right Column: Sidebar Cards -->
                <div class="col-lg-4">
                    <!-- Publish Card -->
                    <x-admin.card title="Publish" position="first">
                        <x-admin.form-fieldset legend="Page Status" mb="mb-4">
                            <div class="mb-2">
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="">Select Status</option>
                                    <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </x-admin.form-fieldset>

                        <x-admin.form-fieldset legend="Page Template" mb="mb-4">
                            <div class="mb-2">
                                <select name="template" id="template" class="form-control @error('template') is-invalid @enderror">
                                    <option value="">Select Template</option>
                                    <option value="default" {{ old('template', 'default') === 'default' ? 'selected' : '' }}>Default</option>
                                    <option value="full-width" {{ old('template') === 'full-width' ? 'selected' : '' }}>Full Width</option>
                                    <option value="landing" {{ old('template') === 'landing' ? 'selected' : '' }}>Landing Page</option>
                                </select>
                                @error('template')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </x-admin.form-fieldset>

                        <x-admin.checkbox-input
                            name="is_home"
                            label="Set as Homepage"
                        />

                        <x-admin.form-actions
                            :cancelRoute="route('admin.pages.index')"
                            submitText="Create Page"
                        />
                    </x-admin.card>

                    <!-- Featured Image Card -->
                    <x-admin.card title="Featured Image">
                        <x-admin.form-fieldset legend="Featured Image">
                            <div class="mb-2">
                                <select name="featured_image_id" id="featured_image_id" class="form-control @error('featured_image_id') is-invalid @enderror">
                                    <option value="">Select Featured Image</option>
                                    @foreach($media as $image)
                                        <option value="{{ $image->id }}" {{ old('featured_image_id') == $image->id ? 'selected' : '' }}>
                                            {{ $image->file_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('featured_image_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </x-admin.form-fieldset>
                    </x-admin.card>

                    <!-- Page Hierarchy Card -->
                    <x-admin.card title="Page Hierarchy">
                        <x-admin.form-fieldset legend="Page Hierarchy">
                            <div class="mb-2">
                                <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                    <option value="">No parent (top level)</option>
                                    @foreach($parentPages as $parentPage)
                                        <option value="{{ $parentPage->id }}" {{ old('parent_id') == $parentPage->id ? 'selected' : '' }}>
                                            {{ $parentPage->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </x-admin.form-fieldset>
                    </x-admin.card>
                </div>
            </div>
        </form>
    </div>
</div>

<x-admin.select2-styles />

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2 for Status single-select
    $('#status').select2({
        placeholder: 'Select Status',
        allowClear: true,
        width: '100%'
    });

    // Initialize Select2 for Template single-select
    $('#template').select2({
        placeholder: 'Select Template',
        allowClear: true,
        width: '100%'
    });

    // Initialize Select2 for Featured Image single-select
    $('#featured_image_id').select2({
        placeholder: 'Select Featured Image',
        allowClear: true,
        width: '100%'
    });

    // Initialize Select2 for Parent Page single-select
    $('#parent_id').select2({
        placeholder: 'Select Parent Page',
        allowClear: true,
        width: '100%'
    });
});
</script>
@endpush
