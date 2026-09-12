@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Edit User</h3>
    <ul class="breadcrumbs mb-3">
        <li class="nav-home">
            <a href="{{ route('admin.dashboard') }}">
                <i class="icon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.users') }}">User Management</a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">Edit User</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card card-round">
            <div class="card-header">
                <h4 class="card-title">Edit User Account</h4>
                <p class="card-category">
                    Update the user's account information and access settings.
                </p>
            </div>

            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        Please fix the following errors:
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.users.update', $user->user_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Role -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">User Role</label>
                        <select name="role_id" class="form-select" required>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->role_id }}"
                                    {{ old('role_id', $user->role_id) == $role->role_id ? 'selected' : '' }}>
                                    {{ ucfirst($role->role_name) }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">
                            Select the role that determines the user's access and responsibilities.
                        </small>
                    </div>

                    <!-- University ID -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">University ID</label>
                        <input type="text" name="university_id" class="form-control"
                            value="{{ old('university_id', $user->university_id) }}" required>
                        <small class="form-text text-muted">
                            The user's official university identification number.
                        </small>
                    </div>

                    <!-- Name -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $user->name) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">Email Address</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $user->email) }}" required>
                    </div>

                    <!-- Phone -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">Phone Number</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone', $user->phone) }}"
                            placeholder="Enter phone number">
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">New Password</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Leave blank to keep current password">
                        <small class="form-text text-muted">
                            Leave this field blank if you do not want to change the password.
                        </small>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Confirm new password">
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">Account Status</label>
                        <select name="status" class="form-select" required>
                            <option value="active"
                                {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive"
                                {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                        <small class="form-text text-muted">
                            Inactive accounts cannot be used to access the system.
                        </small>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.users') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-1"></i>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Information -->
    <div class="col-md-4">
        <div class="card card-round">
            <div class="card-header">
                <h4 class="card-title">Account Information</h4>
            </div>

            <div class="card-body">
                <div class="d-flex align-items-start mb-4">
                    <div class="me-3 text-primary">
                        <i class="fas fa-user-shield fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">User Role</h6>
                        <p class="text-muted mb-0">
                            Changing the role will change the user's system access.
                        </p>
                    </div>
                </div>

                <hr>

                <div class="d-flex align-items-start mb-4">
                    <div class="me-3 text-info">
                        <i class="fas fa-key fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Password</h6>
                        <p class="text-muted mb-0">
                            Leave the password fields blank to keep the current password.
                        </p>
                    </div>
                </div>

                <hr>

                <div class="d-flex align-items-start">
                    <div class="me-3 text-warning">
                        <i class="fas fa-toggle-on fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Account Status</h6>
                        <p class="text-muted mb-0">
                            Set the account to inactive instead of deleting the user.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection