@extends('layouts.technician.app')

@section('title', 'Reports')

@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">
                Reports
            </h1>
            <p class="page-subtitle">
                View your maintenance performance and activity reports.
            </p>
        </div>        
    </div>


    <!-- Statistics -->
    <div class="row g-4 mb-4">
        <!-- Total Assignments -->
        <div class="col-md-6 col-xl-3">
            <div class="card card-stat">
                <div class="card-header">
                    <span class="stat-label">
                        Total Assignments
                    </span>
                </div>
                <div class="stat-value">
                    {{ $totalAssignments }}
                </div>
                <div class="text-muted">
                    Assigned to you
                </div>
            </div>
        </div>

        <!-- Completed -->
        <div class="col-md-6 col-xl-3">
            <div class="card card-stat">
                <div class="card-header">
                    <span class="stat-label">
                        Completed
                    </span>
                </div>
                <div class="stat-value">
                    {{ $completedAssignments }}
                </div>
                <div class="text-muted">
                    Completed assignments
                </div>
            </div>
        </div>

        <!-- In Progress -->
        <div class="col-md-6 col-xl-3">
            <div class="card card-stat">
                <div class="card-header">
                    <span class="stat-label">
                        In Progress
                    </span>
                </div>
                <div class="stat-value">
                    {{ $inProgressAssignments }}
                </div>
                <div class="text-muted">
                    Active assignments
                </div>
            </div>
        </div>

        <!-- Maintenance Records -->
        <div class="col-md-6 col-xl-3">
            <div class="card card-stat">
                <div class="card-header">
                    <span class="stat-label">
                        Maintenance Records
                    </span>
                </div>
                <div class="stat-value">
                    {{ $maintenanceRecords }}
                </div>
                <div class="text-muted">
                    Records created
                </div>
            </div>
        </div>
    </div>

    <!-- Report Content -->
    <div class="row g-4">
        <!-- Maintenance Performance -->
        <div class="col-xl-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div>
                            <div class="card-title">
                                Maintenance Performance
                            </div>
                            <p class="text-muted mb-0">
                                Overview of your maintenance activities.
                            </p>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <!-- Completion Rate -->
                    <div class="text-center py-4">
                        <div class="stat-value mb-2">
                            {{ $completionRate }}%
                        </div>

                        <h6>Assignment Completion Rate</h6>

                        <p class="text-muted mb-0">
                            Percentage of your assignments that have been completed.
                        </p>
                    </div>
                </div>
            </div>
        </div>        
    </div>

    <!-- Maintenance Activity -->
    <div class="card card-round mt-4">
        <div class="card-header">
            <div class="card-head-row">
                <div>
                    <div class="card-title">
                        Maintenance Activity
                    </div>
                    <p class="text-muted mb-0">
                        Recent maintenance activities performed.
                    </p>
                </div>                
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>
                                No
                            </th>
                            <th>
                                Complaint Code
                            </th>
                            <th>
                                Location
                            </th>
                            <th>
                                Maintenance Date
                            </th>
                            <th>
                                Status
                            </th>
                            <th class="text-center">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>                        
                        @forelse($recentActivities as $activity)
                        <tr>
                            <td class="table-order-id">{{ $loop->iteration }}</td>
                            <td>{{ $activity->complaint_code }}</td>
                            <td class="table-product-name">{{ $activity->location_name }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($activity->completed_at)->format('d M Y') }}
                            </td>
                            <td>
                                <span class="badge-table success">
                                    Completed
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('technician.maintenance.detail', $activity->maintenance_id) }}"
                                        class="table-btn-action px-3 py-2" style="min-width: 85px;" title="View details">
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-clipboard-x fs-2 d-block mb-2"></i>

                                            <div class="fw-semibold">
                                                No maintenance activity found.
                                            </div>

                                            <small>
                                                Completed maintenance activities will appear here.
                                            </small>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse                                           
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection