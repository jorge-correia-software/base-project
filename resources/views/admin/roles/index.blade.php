@extends('layouts.admin')

@section('title', 'Roles')
@section('breadcrumb', 'Roles & Permissions')
@section('page-title', 'Roles & Permissions')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="text-white text-capitalize ps-3">Roles Management</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-light me-3">
                                <i class="material-icons-round opacity-10">add</i> Add New Role
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Users</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $role->name }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $role->slug }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-normal mb-0">{{ Str::limit($role->description, 50) }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $role->users_count }}</span>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-link text-dark px-3 mb-0">
                                        <i class="material-icons-round text-sm me-2">edit</i>Edit
                                    </a>
                                    @if(!in_array($role->slug, ['admin', 'editor', 'author']))
                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0">
                                            <i class="material-icons-round text-sm me-2">delete</i>Delete
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <p class="text-sm text-secondary mb-0">No roles found.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
