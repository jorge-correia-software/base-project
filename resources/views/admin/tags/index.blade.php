@extends('layouts.admin')

@section('title', 'Tags')
@section('breadcrumb', 'Tags')
@section('page-title', 'All Tags')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="text-white text-capitalize ps-3">Tags Management</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.tags.create') }}" class="btn btn-sm btn-light me-3">
                                <i class="material-icons-round opacity-10">add</i> Add New Tag
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Posts Count</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tags as $tag)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $tag->name }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $tag->slug }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $tag->posts_count }}</span>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-link text-dark px-3 mb-0">
                                        <i class="material-icons-round text-sm me-2">edit</i>Edit
                                    </a>
                                    <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0">
                                            <i class="material-icons-round text-sm me-2">delete</i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    <p class="text-sm text-secondary mb-0">No tags found. <a href="{{ route('admin.tags.create') }}">Create your first tag</a></p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-3 mt-3">
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
