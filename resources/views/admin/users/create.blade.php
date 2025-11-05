@extends('layouts.admin')

@section('title', 'Create User')

@section('content')
<x-page-header
    icon="person_add"
    title="Create User"
    subtitle="Create a new user account"
    :backRoute="route('admin.users.index')"
/>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="row">
                <!-- Left Column: User Details -->
                <div class="col-lg-8">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-2-5 pb-2-5">
                                <h6 class="text-white text-capitalize ps-3 mb-0">Create New User</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <fieldset class="form-fieldset mb-4">
                                <legend>Account Details</legend>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group input-group-outline mb-3 {{ old('name') ? 'is-filled' : '' }}">
                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                        </div>
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group input-group-outline mb-3 {{ old('email') ? 'is-filled' : '' }}">
                                            <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                        </div>
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="form-fieldset mb-2">
                                <legend>Security</legend>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                        @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
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
                                        <input class="form-check-input" type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}" {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
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
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="d-flex gap-2 justify-content-end mt-3">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                                <button type="submit" class="btn bg-gradient-primary btn-sm">Create User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection