@extends('layouts.admin')
@section('title', 'Testimonials')
@section('content')
<div class="row"><div class="col-12"><div class="card my-4">
<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3"><div class="row"><div class="col-6">
<h6 class="text-white ps-3">Testimonials</h6></div><div class="col-6 text-end">
<a href="{{ route('admin.testimonials.create') }}" class="btn btn-sm btn-light me-3"><i class="material-icons-round">add</i> Add New</a>
</div></div></div></div>
<div class="card-body"><table class="table"><thead><tr><th>Author</th><th>Rating</th><th>Featured</th><th></th></tr></thead><tbody>
@forelse($testimonials as $testimonial)<tr><td><h6 class="text-sm">{{ $testimonial->author_name }}</h6>
<p class="text-xs text-secondary">{{ $testimonial->author_company }}</p></td>
<td>{{ $testimonial->rating }}/5</td>
<td>@if($testimonial->is_featured)<span class="badge bg-gradient-warning">Featured</span>@endif</td>
<td><a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-link text-dark">Edit</a>
<form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')
<button type="submit" class="btn btn-link text-danger">Delete</button></form></td></tr>
@empty<tr><td colspan="4" class="text-center py-4">No testimonials found.</td></tr>@endforelse
</tbody></table></div></div></div></div>
@endsection
