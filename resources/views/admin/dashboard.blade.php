@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <h3 class="fw-bold mb-3">
            Dashboard
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
                    Dashboard
                </a>
            </li>
        </ul>
    </div>

    <!-- Welcome -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h4 class="card-title">
                                Welcome to e-Maintain@FSDK
                            </h4>
                            <p class="card-category">
                                Facility and Laboratory Maintenance Management System
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row">
    <!-- Total Complaints -->
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>

                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">
                                Complaints
                            </p>
                            <h4 class="card-title">
                                {{ $totalComplaints }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Pending -->
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                    </div>

                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">
                                Pending
                            </p>
                            <h4 class="card-title">
                                {{ $pendingComplaints }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- In Progress -->
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fas fa-wrench"></i>
                        </div>
                    </div>

                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">
                                In Progress
                            </p>
                            <h4 class="card-title">
                                {{ $inProgressComplaints }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Resolved -->
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="fas fa-check-double"></i>
                        </div>
                    </div>

                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">
                                Resolved
                            </p>
                            <h4 class="card-title">
                                {{ $resolvedComplaints }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Main Dashboard Content -->
    <div class="row">
        <!-- Recent Complaints -->
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">
                            Recent Complaints
                        </div>
                        <a href="{{ route('admin.complaints') }}" class="btn btn-primary btn-sm ms-auto">
                          View All
                      </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        Complaint ID
                                    </th>
                                    <th>
                                        Reporter
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                            </thead>
                           <tbody>
                                @forelse($recentComplaints as $complaint)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">
                                                {{ $complaint->complaint_code }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $complaint->reporter_name }}
                                        </td>

                                        <td>
                                            {{ $complaint->facility_type_name ?? '-' }}
                                        </td>

                                        <td>
                                            @if($complaint->status == 'pending')
                                                <span class="badge badge-warning">
                                                    Pending
                                                </span>
                                            @elseif($complaint->status == 'assigned')
                                                <span class="badge badge-info">
                                                    Assigned
                                                </span>
                                            @elseif($complaint->status == 'in_progress')
                                                <span class="badge badge-primary">
                                                    In Progress
                                                </span>
                                            @elseif($complaint->status == 'resolved')
                                                <span class="badge badge-success">
                                                    Resolved
                                                </span>
                                            @elseif($complaint->status == 'rejected')
                                                <span class="badge badge-danger">
                                                    Rejected
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">
                                                    {{ ucfirst($complaint->status) }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <i class="fas fa-clipboard-list fa-2x mb-2"></i>
                                            <p class="mb-0">
                                                No complaints available.
                                            </p>
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