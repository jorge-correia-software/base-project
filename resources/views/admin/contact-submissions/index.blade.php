@extends('layouts.admin')
@section('title', 'Contact Submissions')
@section('content')
<div class="row"><div class="col-12"><div class="card my-4">
<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
<h6 class="text-white ps-3">Contact Submissions</h6></div></div>
<div class="card-body"><table class="table"><thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Status</th><th>Date</th><th></th></tr></thead><tbody>
@forelse($submissions as $submission)<tr><td>{{ $submission->name }}</td><td>{{ $submission->email }}</td>
<td>{{ Str::limit($submission->subject, 30) }}</td>
<td>@if($submission->status == 'new')<span class="badge bg-gradient-info">New</span>
@elseif($submission->status == 'read')<span class="badge bg-gradient-secondary">Read</span>
@else<span class="badge bg-gradient-success">Replied</span>@endif</td>
<td>{{ $submission->created_at->format('M d, Y') }}</td>
<td><a href="{{ route('admin.contact-submissions.show', $submission) }}" class="btn btn-link text-dark">View</a></td></tr>
@empty<tr><td colspan="6" class="text-center py-4">No submissions found.</td></tr>@endforelse
</tbody></table>
<div class="px-3 mt-3">{{ $submissions->links() }}</div>
</div></div></div></div>
@endsection
