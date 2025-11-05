@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<x-page-header
    icon="person"
    title="{{ $user->name }}"
    subtitle="Update user information and permissions"
    :backRoute="route('admin.users.index')"
/>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Left Column: User Details -->
                <div class="col-lg-8">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-2-5 pb-2-5">
                                <h6 class="text-white text-capitalize ps-3 mb-0">Edit User</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <fieldset class="form-fieldset mb-4">
                                <legend>Account Details</legend>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                                        </div>
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                                        </div>
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="form-fieldset mb-2">
                                <legend>Change Password</legend>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mb-2">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <small class="text-muted text-xs d-block mb-3">Leave blank to keep current password</small>
                                        @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control" name="password_confirmation">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    @if($user->id !== auth()->id())
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-danger shadow-danger border-radius-lg pt-2-5 pb-2-5">
                                <h6 class="text-white text-capitalize ps-3 mb-0">Danger Zone</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-sm text-secondary mb-3">Deleting this user cannot be undone.</p>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete User</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Column: Sidebar Cards -->
                <div class="col-lg-4">
                    <!-- Permissions Card -->
                    <div class="card mt-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-2-5 pb-2-5">
                                <h6 class="text-white text-capitalize ps-3 mb-0">Permissions</h6>
                            </div>
                        </div>
                        <div class="card-body pb-1">
                            <fieldset class="form-fieldset mb-4">
                                <legend>Roles</legend>

                                <div class="mb-3">
                                    @foreach($roles as $role)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}" {{ in_array($role->id, old('roles', $user->roles->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="role_{{ $role->id }}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                @error('roles')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </fieldset>

                            <fieldset class="form-fieldset mb-2">
                                <legend>Account Status</legend>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="mb-3">
                                <p class="text-sm mb-0">Created: <strong>{{ $user->created_at->format('d/m/Y') }}</strong></p>
                                <p class="text-sm mb-0">Updated: <strong>{{ $user->updated_at->format('d/m/Y') }}</strong></p>
                            </div>

                            <div class="d-flex gap-2 justify-content-end mt-3">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                                <button type="submit" class="btn bg-gradient-primary btn-sm">Update User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection