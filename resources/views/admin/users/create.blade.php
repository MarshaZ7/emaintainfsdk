@extends('layouts.admin.app')

@section('title', 'Add User')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">
        Add User
    </h3>
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
            <a href="{{ route('admin.users') }}">
                User Management
            </a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">
                Add User
            </a>
        </li>
    </ul>
</div>

<div class="row">
    <!-- Form -->
    <div class="col-md-8">
        <div class="card card-round">
            <div class="card-header">
                <h4 class="card-title">
                    Create User Account
                </h4>
                <p class="card-category">
                    Create a new user account for the e-Maintain@FSDK system.
                </p>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        Please fix the following errors:
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <!-- Role -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">
                            User Role
                        </label>
                        <select name="role_id" class="form-select" required>
                            <option value="">
                                Select Role
                            </option>
                            @foreach($roles as $role)
                                <option
                                    value="{{ $role->role_id }}"
                                    {{ old('role_id') == $role->role_id ? 'selected' : '' }}>
                                    {{ $role->role_name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">
                            Select the role that determines the user's access and responsibilities.
                        </small>
                    </div>

                    <!-- University ID -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">
                            University ID
                        </label>
                        <input type="text" name="university_id" class="form-control" placeholder="Enter university ID" value="{{ old('university_id') }}" required>
                        <small class="form-text text-muted">
                            Enter the user's official university identification number.
                        </small>
                    </div>

                    <!-- Name -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">
                            Full Name
                        </label>
                        <input type="text" name="name" class="form-control" placeholder="Enter full name"
                            value="{{ old('name') }}" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">
                            Email Address
                        </label>
                        <input type="email" name="email" class="form-control"
                            placeholder="user@example.com" value="{{ old('email') }}" required>
                    </div>

                    <!-- Phone -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">
                            Phone Number
                        </label>
                        <input type="text" name="phone" class="form-control"
                            placeholder="Enter phone number" value="{{ old('phone') }}">
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">
                            Password
                        </label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Enter password" required>
                        <small class="form-text text-muted">
                            Password must contain at least 8 characters.
                        </small>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">
                            Confirm Password
                        </label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">
                            Account Status
                        </label>

                        <select name="status" class="form-select" required>
                            <option value="active"
                                {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
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
                            <i class="fas fa-user-plus me-1"></i>
                            Create User
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
                <h4 class="card-title">
                    User Information
                </h4>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start mb-4">
                    <div class="me-3 text-primary">
                        <i class="fas fa-user-shield fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">
                            User Role
                        </h6>
                        <p class="text-muted mb-0">
                            The selected role determines which
                            features and pages the user can access.
                        </p>
                    </div>
                </div>
                <hr>
                <div class="d-flex align-items-start mb-4">
                    <div class="me-3 text-info">
                        <i class="fas fa-id-card fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">
                            University ID
                        </h6>
                        <p class="text-muted mb-0">
                            Each user should have a unique
                            university identification number.
                        </p>
                    </div>
                </div>
                <hr>
                <div class="d-flex align-items-start">
                    <div class="me-3 text-warning">
                        <i class="fas fa-toggle-on fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">
                            Account Status
                        </h6>
                        <p class="text-muted mb-0">
                            Inactive accounts can be disabled
                            without deleting their records.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection