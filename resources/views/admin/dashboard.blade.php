@extends('layouts.admin')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons-round opacity-10">description</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Pages</p>
                    <h4 class="mb-0">{{ $stats['pages'] }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><a href="{{ route('admin.pages.index') }}" class="text-success text-sm font-weight-bolder">View all pages</a></p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons-round opacity-10">article</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Posts</p>
                    <h4 class="mb-0">{{ $stats['posts'] }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><a href="{{ route('admin.posts.index') }}" class="text-success text-sm font-weight-bolder">View all posts</a></p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons-round opacity-10">perm_media</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Media Files</p>
                    <h4 class="mb-0">{{ $stats['media'] }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><a href="{{ route('admin.media.index') }}" class="text-success text-sm font-weight-bolder">View media library</a></p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons-round opacity-10">people</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Users</p>
                    <h4 class="mb-0">{{ $stats['users'] }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><a href="{{ route('admin.users.index') }}" class="text-success text-sm font-weight-bolder">View all users</a></p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Recent Posts</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-check text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">Latest published content</span>
                        </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm mb-0">+ New Post</a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Post</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Author</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPosts as $post)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ Str::limit($post->title, 40) }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $post->author->name }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($post->status === 'published')
                                        <span class="badge badge-sm bg-gradient-success">Published</span>
                                    @elseif($post->status === 'draft')
                                        <span class="badge badge-sm bg-gradient-secondary">Draft</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-warning">Scheduled</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $post->created_at->format('M d, Y') }}</span>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit post">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <p class="text-sm text-secondary mb-0">No posts yet. <a href="{{ route('admin.posts.create') }}">Create your first post</a></p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0">
                <h6>Contact Submissions</h6>
                <p class="text-sm">
                    <i class="fa fa-envelope text-primary me-1" aria-hidden="true"></i>
                    <span class="font-weight-bold">{{ $stats['contact_submissions'] }}</span> new messages
                </p>
            </div>
            <div class="card-body p-3">
                <div class="timeline timeline-one-side">
                    @forelse($recentSubmissions as $submission)
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="material-icons-round text-{{ $submission->status === 'new' ? 'success' : 'secondary' }} text-gradient">mail</i>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $submission->name }}</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ Str::limit($submission->message, 50) }}</p>
                            <p class="text-sm mt-3 mb-2">
                                {{ $submission->created_at->diffForHumans() }}
                            </p>
                            <a href="{{ route('admin.contact-submissions.show', $submission) }}" class="text-primary text-sm font-weight-bold">View</a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <p class="text-sm text-secondary mb-0">No submissions yet</p>
                    </div>
                    @endforelse
                </div>
                @if($recentSubmissions->count() > 0)
                <div class="text-center mt-4">
                    <a href="{{ route('admin.contact-submissions.index') }}" class="btn btn-outline-primary btn-sm">View All</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">Quick Actions</h6>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-md-3 mb-md-0 mb-4">
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-outline-primary btn-block w-100">
                            <i class="material-icons-round opacity-10">add_circle</i>
                            <span class="ms-1">New Page</span>
                        </a>
                    </div>
                    <div class="col-md-3 mb-md-0 mb-4">
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-outline-primary btn-block w-100">
                            <i class="material-icons-round opacity-10">add_circle</i>
                            <span class="ms-1">New Post</span>
                        </a>
                    </div>
                    <div class="col-md-3 mb-md-0 mb-4">
                        <a href="{{ route('admin.media.create') }}" class="btn btn-outline-primary btn-block w-100">
                            <i class="material-icons-round opacity-10">upload</i>
                            <span class="ms-1">Upload Media</span>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-primary btn-block w-100">
                            <i class="material-icons-round opacity-10">settings</i>
                            <span class="ms-1">Settings</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
