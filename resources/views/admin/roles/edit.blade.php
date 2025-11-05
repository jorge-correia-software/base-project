@extends('layouts.admin')

@section('title', 'Edit Role')
@section('breadcrumb', 'Edit Role')
@section('page-title', 'Edit Role: ' . $role->name)

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Role Details</h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3 is-filled">
                                <label class="form-label">Role Name *</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $role->name) }}" required>
                            </div>
                            @error('name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3 is-filled">
                                <label class="form-label">Slug</label>
                                <input type="text" class="form-control" name="slug" value="{{ old('slug', $role->slug) }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group input-group-outline mb-3 {{ $role->description ? 'is-filled' : '' }}">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="2">{{ old('description', $role->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <h6 class="mt-4 mb-3">Permissions</h6>
                    <div class="row">
                        @php
                            $currentPermissions = is_string($role->permissions) ? json_decode($role->permissions, true) : $role->permissions;
                            $currentPermissions = $currentPermissions ?? [];
                        @endphp
                        @foreach($availablePermissions as $module => $perms)
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body py-3">
                                    <h6 class="mb-2">{{ ucwords(str_replace('_', ' ', $module)) }}</h6>
                                    @foreach($perms as $perm)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $module }}.{{ $perm }}"
                                            {{ in_array($module . '.' . $perm, $currentPermissions) || in_array('*', $currentPermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label text-sm">{{ ucfirst($perm) }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Update Role</button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if(!in_array($role->slug, ['admin', 'editor', 'author']))
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-danger shadow-danger border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Danger Zone</h6>
                </div>
            </div>
            <div class="card-body">
                <p class="text-sm text-secondary mb-3">Deleting this role cannot be undone.</p>
                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Role</button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
