@extends('layouts.admin')
@section('title', 'Edit Testimonial')
@section('content')
<div class="row"><div class="col-lg-8 mx-auto"><div class="card my-4">
<div class="card-body"><form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST">@csrf @method('PUT')
<div class="input-group input-group-outline mb-3 is-filled"><label class="form-label">Author Name *</label>
<input type="text" class="form-control" name="author_name" value="{{ $testimonial->author_name }}" required></div>
<div class="input-group input-group-outline mb-3 {{ $testimonial->author_title ? 'is-filled' : '' }}"><label class="form-label">Author Title</label>
<input type="text" class="form-control" name="author_title" value="{{ $testimonial->author_title }}"></div>
<div class="input-group input-group-outline mb-3 {{ $testimonial->author_company ? 'is-filled' : '' }}"><label class="form-label">Author Company</label>
<input type="text" class="form-control" name="author_company" value="{{ $testimonial->author_company }}"></div>
<div class="input-group input-group-outline mb-3 is-filled"><label class="form-label">Content *</label>
<textarea class="form-control" name="content" rows="4" required>{{ $testimonial->content }}</textarea></div>
<div class="mb-3"><label>Rating *</label><select class="form-control" name="rating" required>
<option value="5" {{ $testimonial->rating == 5 ? 'selected' : '' }}>5 Stars</option>
<option value="4" {{ $testimonial->rating == 4 ? 'selected' : '' }}>4 Stars</option>
<option value="3" {{ $testimonial->rating == 3 ? 'selected' : '' }}>3 Stars</option></select></div>
<div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ $testimonial->is_featured ? 'checked' : '' }}>
<label class="form-check-label">Featured</label></div>
<div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $testimonial->is_active ? 'checked' : '' }}>
<label class="form-check-label">Active</label></div>
<button type="submit" class="btn btn-primary">Update</button>
<a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form></div></div></div></div>
@endsection
