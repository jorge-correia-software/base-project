@extends('layouts.admin')
@section('title', 'View Submission')
@section('content')
<div class="row"><div class="col-lg-8 mx-auto"><div class="card my-4"><div class="card-body">
<h5>{{ $submission->subject }}</h5>
<p class="text-sm text-secondary">From: {{ $submission->name }} ({{ $submission->email }})</p>
@if($submission->phone)<p class="text-sm text-secondary">Phone: {{ $submission->phone }}</p>@endif
<p class="text-sm text-secondary">Date: {{ $submission->created_at->format('F d, Y \a\t g:i A') }}</p>
<hr>
<p>{{ $submission->message }}</p>
<hr>
<form action="{{ route('admin.contact-submissions.mark-as-read', $submission) }}" method="POST" class="d-inline">
@csrf <button type="submit" class="btn btn-secondary">Mark as Read</button></form>
<form action="{{ route('admin.contact-submissions.mark-as-replied', $submission) }}" method="POST" class="d-inline">
@csrf <button type="submit" class="btn btn-success">Mark as Replied</button></form>
<form action="{{ route('admin.contact-submissions.destroy', $submission) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?');">
@csrf @method('DELETE') <button type="submit" class="btn btn-danger">Delete</button></form>
<a href="{{ route('admin.contact-submissions.index') }}" class="btn btn-outline-secondary">Back</a>
</div></div></div></div>
@endsection
