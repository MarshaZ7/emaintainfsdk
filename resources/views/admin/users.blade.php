@extends('layouts.admin.app')

@section('title', 'User Management')

@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <h3 class="fw-bold mb-3">
            User Management
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
                <a href="#">
                    User Management
                </a>
            </li>
        </ul>
    </div>


    <!-- User Statistics -->
    <div class="row">
        <!-- Total Users -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Users</p>
                                <h4 class="card-title">{{ $totalUsers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FSDK Users -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">FSDK Users</p>
                                <h4 class="card-title">{{ $totalRegularUsers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- IT Admins -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                <i class="fas fa-user-shield"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">IT Admins</p>
                                <h4 class="card-title">{{ $admins }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Technicians -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-user-cog"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Technicians</p>
                                <h4 class="card-title">{{ $technicians }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- User Management Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <!-- Card Header -->
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h4 class="card-title mb-1">
                                Users
                            </h4>
                            <p class="text-muted mb-0">
                                Manage registered users and their account status.
                            </p>
                        </div>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i>
                            Add User
                        </a>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <!-- Search & Filter -->
                    <div class="row mb-4">
                        <!-- Search -->
                        <form action="{{ route('admin.users') }}" method="GET">
                            <div class="row mb-4">
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        <input type="text" name="search" class="form-control"
                                            value="{{ request('search') }}"
                                            placeholder="Search by name or university ID...">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <select name="role" class="form-select">
                                        <option value="">All Roles</option>
                                        <option value="Student" {{ request('role') == 'Student' ? 'selected' : '' }}>Student</option>
                                        <option value="Lecturer" {{ request('role') == 'Lecturer' ? 'selected' : '' }}>Lecturer/Staff</option>
                                        <option value="Technician" {{ request('role') == 'Technician' ? 'selected' : '' }}>Technician</option>
                                        <option value="IT Admin" {{ request('role') == 'IT Admin' ? 'selected' : '' }}>IT Admin</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select name="status" class="form-select">
                                        <option value="">All Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-outline-primary w-100">
                                        <i class="fa fa-filter"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Role Filter -->
                        <div class="col-md-3">
                            <select class="form-select">
                                <option value="">
                                    All Roles
                                </option>
                                <option value="student">
                                    Student
                                </option>
                                <option value="lecturer">
                                    Lecturer/Staff
                                </option>
                                <option value="technician">
                                    Technician
                                </option>
                                <option value="admin">
                                    IT Admin
                                </option>
                            </select>
                        </div>

                        <!-- Status Filter -->
                        <div class="col-md-2">
                            <select class="form-select">
                                <option value="">
                                    All Status
                                </option>
                                <option value="active">
                                    Active
                                </option>
                                <option value="inactive">
                                    Inactive
                                </option>
                            </select>
                        </div>

                        <!-- Filter Button -->
                        <div class="col-md-2">
                            <button class="btn btn-outline-primary w-100">
                                <i class="fa fa-filter"></i>
                                Filter
                            </button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>University ID</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->university_id }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->role_name == 'user')
                                                <span class="badge badge-info">FSDK User</span>
                                            @elseif($user->role_name == 'admin')
                                                <span class="badge badge-primary">Admin</span>
                                            @elseif($user->role_name == 'technician')
                                                <span class="badge badge-secondary">Technician</span>
                                            @else
                                                <span class="badge badge-secondary">No Role</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Active</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">                                                
                                                <a href="{{ route('admin.users.edit', $user->user_id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <div class="mb-2">
                                                <i class="fas fa-users fa-2x"></i>
                                            </div>
                                            <h6 class="mb-1">No users available</h6>
                                            <p class="mb-0">No user data has been added yet.</p>
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