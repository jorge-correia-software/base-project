@extends('layouts.admin')
@section('title', 'Edit Support Area')
@section('content')
<div class="row"><div class="col-lg-8 mx-auto"><div class="card my-4">
<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3"><h6 class="text-white ps-3">Edit Support Area</h6></div></div>
<div class="card-body"><form action="{{ route('admin.support-areas.update', $supportArea) }}" method="POST">@csrf @method('PUT')
<div class="input-group input-group-outline mb-3 is-filled"><label class="form-label">Title *</label>
<input type="text" class="form-control" name="title" value="{{ $supportArea->title }}" required></div>
<div class="input-group input-group-outline mb-3 is-filled"><label class="form-label">Description *</label>
<textarea class="form-control" name="description" rows="3" required>{{ $supportArea->description }}</textarea></div>
<div class="input-group input-group-outline mb-3 is-filled"><label class="form-label">Icon</label>
<input type="text" class="form-control" name="icon" value="{{ $supportArea->icon }}"></div>
<div class="input-group input-group-outline mb-3 is-filled"><label class="form-label">Order</label>
<input type="number" class="form-control" name="order" value="{{ $supportArea->order }}"></div>
<div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $supportArea->is_active ? 'checked' : '' }}>
<label class="form-check-label">Active</label></div>
<button type="submit" class="btn btn-primary">Update</button>
<a href="{{ route('admin.support-areas.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form></div></div></div></div>
@endsection
