@extends('layouts.admin')
@section('title', 'Hero Sections')
@section('content')
<div class="row"><div class="col-12"><div class="card my-4">
<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3"><div class="row"><div class="col-6">
<h6 class="text-white ps-3">Hero Sections</h6></div><div class="col-6 text-end">
<a href="{{ route('admin.hero-sections.create') }}" class="btn btn-sm btn-light me-3">Add New</a>
</div></div></div></div>
<div class="card-body"><table class="table"><thead><tr><th>Title</th><th>Order</th><th>Status</th><th></th></tr></thead><tbody>
@forelse($heroSections as $section)<tr><td>{{ $section->title }}</td><td>{{ $section->order }}</td>
<td>@if($section->is_active)<span class="badge bg-gradient-success">Active</span>@endif</td>
<td><a href="{{ route('admin.hero-sections.edit', $section) }}" class="btn btn-link text-dark">Edit</a>
<form action="{{ route('admin.hero-sections.destroy', $section) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')
<button type="submit" class="btn btn-link text-danger">Delete</button></form></td></tr>
@empty<tr><td colspan="4" class="text-center py-4">No hero sections found.</td></tr>@endforelse
</tbody></table></div></div></div></div>
@endsection
