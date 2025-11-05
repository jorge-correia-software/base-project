@extends('layouts.admin')
@section('title', 'Create Program')

@section('content')
<div class="row"><div class="col-lg-8 mx-auto"><div class="card my-4">
<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
<h6 class="text-white text-capitalize ps-3">Program Details</h6></div></div>
<div class="card-body"><form action="{{ route('admin.programs.store') }}" method="POST">@csrf
<div class="input-group input-group-outline mb-3"><label class="form-label">Title *</label>
<input type="text" class="form-control" name="title" value="{{ old('title') }}" required></div>
<div class="input-group input-group-outline mb-3"><label class="form-label">Slug</label>
<input type="text" class="form-control" name="slug" value="{{ old('slug') }}"></div>
<div class="input-group input-group-outline mb-3"><label class="form-label">Description *</label>
<textarea class="form-control" name="description" rows="4" required>{{ old('description') }}</textarea></div>
<div class="input-group input-group-outline mb-3"><label class="form-label">Icon (Material icon name)</label>
<input type="text" class="form-control" name="icon" value="{{ old('icon', 'rocket_launch') }}"></div>
<div class="input-group input-group-outline mb-3"><label class="form-label">Link URL</label>
<input type="text" class="form-control" name="link_url" value="{{ old('link_url') }}"></div>
<div class="input-group input-group-outline mb-3"><label class="form-label">Link Text</label>
<input type="text" class="form-control" name="link_text" value="{{ old('link_text', 'Learn more') }}"></div>
<div class="input-group input-group-outline mb-3"><label class="form-label">Order</label>
<input type="number" class="form-control" name="order" value="{{ old('order', 0) }}"></div>
<div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
<label class="form-check-label">Active</label></div>
<button type="submit" class="btn btn-primary">Create Program</button>
<a href="{{ route('admin.programs.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form></div></div></div></div>
@endsection
