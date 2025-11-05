@extends('layouts.admin')

@section('title', 'Create Tag')

@section('content')
<x-page-header
    icon="label"
    title="Create Tag"
    subtitle="Create a new tag for organizing content"
    :backRoute="route('admin.tags.index')"
/>

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-2-5 pb-2-5">
                    <h6 class="text-white text-capitalize ps-3 mb-0">Create New Tag</h6>
                </div>
            </div>
            <div class="card-body pb-1">
                <form action="{{ route('admin.tags.store') }}" method="POST">
                    @csrf

                    <fieldset class="form-fieldset mb-2">
                        <legend>Tag Details</legend>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-outline mb-3 {{ old('name') ? 'is-filled' : '' }}">
                                    <label class="form-label">Tag Name <span class="text-danger">*</span></label>
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
                                <small class="text-muted text-xs d-block mb-3">Auto-generated from tag name</small>
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

                    <div class="d-flex gap-2 justify-content-end mt-3">
                        <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                        <button type="submit" class="btn bg-gradient-primary btn-sm">Create Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection