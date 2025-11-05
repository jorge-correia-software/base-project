@extends('layouts.admin')
@section('title', 'Edit Program')

@section('content')
<div class="row"><div class="col-lg-8 mx-auto"><div class="card my-4">
<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
<h6 class="text-white text-capitalize ps-3">Edit Program</h6></div></div>
<div class="card-body"><form action="{{ route('admin.programs.update', $program) }}" method="POST">@csrf @method('PUT')
<div class="input-group input-group-outline mb-3 is-filled"><label class="form-label">Title *</label>
<input type="text" class="form-control" name="title" value="{{ old('title', $program->title) }}" required></div>
<div class="input-group input-group-outline mb-3 is-filled"><label class="form-label">Slug</label>
<input type="text" class="form-control" name="slug" value="{{ old('slug', $program->slug) }}"></div>
<div class="input-group input-group-outline mb-3 is-filled"><label class="form-label">Description *</label>
<textarea class="form-control" name="description" rows="4" required>{{ old('description', $program->description) }}</textarea></div>
<div class="input-group input-group-outline mb-3 is-filled"><label class="form-label">Icon</label>
<input type="text" class="form-control" name="icon" value="{{ old('icon', $program->icon) }}"></div>
<div class="input-group input-group-outline mb-3 {{ $program->link_url ? 'is-filled' : '' }}"><label class="form-label">Link URL</label>
<input type="text" class="form-control" name="link_url" value="{{ old('link_url', $program->link_url) }}"></div>
<div class="input-group input-group-outline mb-3 is-filled"><label class="form-label">Link Text</label>
<input type="text" class="form-control" name="link_text" value="{{ old('link_text', $program->link_text) }}"></div>
<div class="input-group input-group-outline mb-3 is-filled"><label class="form-label">Order</label>
<input type="number" class="form-control" name="order" value="{{ old('order', $program->order) }}"></div>
<div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $program->is_active) ? 'checked' : '' }}>
<label class="form-check-label">Active</label></div>
<button type="submit" class="btn btn-primary">Update Program</button>
<a href="{{ route('admin.programs.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form></div></div></div></div>
@endsection
