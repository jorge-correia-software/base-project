@extends('layouts.admin')

@section('title', 'Create Role')
@section('breadcrumb', 'Create Role')
@section('page-title', 'Create New Role')

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
                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Role Name *</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            </div>
                            @error('name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Slug (leave blank to auto-generate)</label>
                                <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="2">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <h6 class="mt-4 mb-3">Permissions</h6>
                    <div class="row">
                        @foreach($availablePermissions as $module => $perms)
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body py-3">
                                    <h6 class="mb-2">{{ ucwords(str_replace('_', ' ', $module)) }}</h6>
                                    @foreach($perms as $perm)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $module }}.{{ $perm }}">
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
                            <button type="submit" class="btn btn-primary">Create Role</button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
