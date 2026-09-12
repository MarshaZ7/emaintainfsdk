@extends('layouts.admin.app')

@section('title', 'Account Settings')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Account Settings</h3>
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
            <a href="#">Account Settings</a>
        </li>
    </ul>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle me-1"></i>
        {{ session('success') }}
    </div>
@endif

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

<!-- Profile Information -->
<div class="row">
    <div class="col-md-8">
        <div class="card card-round">
            <div class="card-header">
                <h4 class="card-title mb-1">Profile Information</h4>
                <p class="text-muted mb-0">
                    Update your personal account information.
                </p>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- University ID -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">University ID</label>
                        <input type="text" class="form-control"
                            value="{{ $user->university_id }}" disabled>
                        <small class="form-text text-muted">
                            University ID cannot be changed.
                        </small>
                    </div>

                    <!-- Full Name -->
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

                    <!-- Role -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">Role</label>
                        <input type="text" class="form-control"
                            value="{{ $user->role_name }}" disabled>
                        <small class="form-text text-muted">
                            Your account role is managed by the system.
                        </small>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Account Information -->
    <div class="col-md-4">
        <div class="card card-round">
            <div class="card-header">
                <h4 class="card-title">Account Information</h4>
            </div>

            <div class="card-body">
                <div class="mb-4">
                    <label class="form-label">Account Status</label>
                    <div>
                        @if($user->status == 'active')
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-danger">Inactive</span>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">User ID</label>
                    <p class="mb-0">{{ $user->user_id }}</p>
                </div>

                <div class="mb-4">
                    <label class="form-label">Account Created</label>
                    <p class="mb-0 text-muted">
                        {{ $user->created_at ? date('d M Y, H:i', strtotime($user->created_at)) : '-' }}
                    </p>
                </div>

                <div>
                    <label class="form-label">Last Updated</label>
                    <p class="mb-0 text-muted">
                        {{ $user->updated_at ? date('d M Y, H:i', strtotime($user->updated_at)) : '-' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Password -->
<div class="row">
    <div class="col-md-8">
        <div class="card card-round">
            <div class="card-header">
                <h4 class="card-title mb-1">Change Password</h4>
                <p class="text-muted mb-0">
                    Update your account password.
                </p>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.settings.password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Current Password -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">Current Password</label>
                        <input type="password" name="current_password"
                            class="form-control"
                            placeholder="Enter current password" required>
                    </div>

                    <!-- New Password -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">New Password</label>
                        <input type="password" name="password"
                            class="form-control"
                            placeholder="Enter new password" required>
                        <small class="form-text text-muted">
                            Password must contain at least 8 characters.
                        </small>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">Confirm New Password</label>
                        <input type="password" name="password_confirmation"
                            class="form-control"
                            placeholder="Confirm new password" required>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key me-1"></i>
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection