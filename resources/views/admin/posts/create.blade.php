@extends('layouts.admin')

@section('title', 'Create Post')

@section('content')
<x-page-header
    icon="article"
    title="Create Post"
    subtitle="Create a new blog post or article"
    :backRoute="route('admin.posts.index')"
/>

<div class="row">
    <div class="col-12 col-xl-8 mx-auto">
        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf

            <div class="row">
                <!-- Left Column: Post Details -->
                <div class="col-lg-8">
                    <x-admin.card title="Create New Post" position="first">
                        <x-admin.form-fieldset legend="Post Details">
                            <x-admin.text-input
                                name="title"
                                label="Post Title"
                                required
                            />

                            <x-admin.text-input
                                name="slug"
                                label="Slug"
                                readonly
                                help="Auto-generated from title"
                                mb="mb-2"
                            />

                            <x-admin.textarea-input
                                name="excerpt"
                                label="Post Summary"
                                help="Brief summary of the post"
                            />

                            <x-admin.quill-editor
                                name="content"
                                label="Post Content"
                                required
                            />
                        </x-admin.form-fieldset>
                    </x-admin.card>
                </div>

                <!-- Right Column: Sidebar Cards -->
                <div class="col-lg-4">
                    <!-- Publish Card -->
                    <x-admin.card title="Publish" mt="mt-4">
                        <x-admin.form-fieldset legend="Post Status" mb="mb-4">
                            <div class="mb-2">
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="">Select Status</option>
                                    <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="scheduled" {{ old('status') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </x-admin.form-fieldset>

                        <x-admin.form-fieldset legend="Post Date">
                            <x-admin.datetime-input
                                name="published_at"
                                help="Leave blank to publish immediately"
                            />
                        </x-admin.form-fieldset>

                        <x-admin.form-actions
                            :cancelRoute="route('admin.posts.index')"
                            submitText="Create Post"
                        />
                    </x-admin.card>

                    <!-- Organisation Card -->
                    <x-admin.card title="Organisation">
                        <x-admin.form-fieldset legend="Category" mb="mb-4">
                            <div class="mb-3">
                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </x-admin.form-fieldset>

                        <x-admin.form-fieldset legend="Featured Image" mb="mb-4">
                            <div class="mb-3">
                                <select name="featured_image_id" id="featured_image_id" class="form-control @error('featured_image_id') is-invalid @enderror" required>
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

                        <x-admin.form-fieldset legend="Tags">
                            <div class="mb-2">
                                <select name="tags[]" id="tags" class="form-control @error('tags') is-invalid @enderror" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted text-xs d-block mb-3">Hold Ctrl/Cmd to select multiple tags</small>
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
    // Initialize Select2 for Tags multi-select
    $('#tags').select2({
        placeholder: 'Select Tags',
        allowClear: true,
        width: '100%'
    });

    // Initialize Select2 for Status single-select
    $('#status').select2({
        placeholder: 'Select Status',
        allowClear: true,
        width: '100%'
    });

    // Initialize Select2 for Category single-select
    $('#category_id').select2({
        placeholder: 'Select Category',
        allowClear: true,
        width: '100%'
    });

    // Initialize Select2 for Featured Image single-select
    $('#featured_image_id').select2({
        placeholder: 'Select Featured Image',
        allowClear: true,
        width: '100%'
    });
});
</script>
@endpush
