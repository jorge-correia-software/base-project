@extends('layouts.admin')
@section('title', 'Support Areas')
@section('content')
<div class="row"><div class="col-12"><div class="card my-4">
<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3"><div class="row"><div class="col-6">
<h6 class="text-white ps-3">Support Areas</h6></div><div class="col-6 text-end">
<a href="{{ route('admin.support-areas.create') }}" class="btn btn-sm btn-light me-3"><i class="material-icons-round">add</i> Add New</a>
</div></div></div></div>
<div class="card-body px-0 pb-2"><table class="table align-items-center mb-0">
<thead><tr><th class="text-xxs font-weight-bolder opacity-7">Title</th><th class="text-center text-xxs font-weight-bolder">Order</th>
<th class="text-center text-xxs font-weight-bolder">Status</th><th></th></tr></thead><tbody>
@forelse($supportAreas as $area)<tr><td><div class="px-2"><h6 class="mb-0 text-sm">{{ $area->title }}</h6></div></td>
<td class="align-middle text-center">{{ $area->order }}</td>
<td class="align-middle text-center">@if($area->is_active)<span class="badge bg-gradient-success">Active</span>@else<span class="badge bg-gradient-secondary">Inactive</span>@endif</td>
<td><a href="{{ route('admin.support-areas.edit', $area) }}" class="btn btn-link text-dark px-3">Edit</a>
<form action="{{ route('admin.support-areas.destroy', $area) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')
<button type="submit" class="btn btn-link text-danger px-3">Delete</button></form></td></tr>
@empty<tr><td colspan="4" class="text-center py-4">No support areas found.</td></tr>@endforelse
</tbody></table></div></div></div></div>
@endsection
