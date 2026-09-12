@extends('layouts.technician.app')

@section('title', 'Maintenance Records')

@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">
                Maintenance Records
            </h1>
            <p class="page-subtitle">
                View and manage your completed maintenance records.
            </p>
        </div>
    </div>


    <!-- Statistics -->
    <div class="row g-4 mb-4">

        <!-- Total Records -->
        <div class="col-md-6 col-xl-4">
            <div class="card card-stat">
                <div class="card-header">
                    <span class="stat-label">
                        Total Records
                    </span>
                </div>

                <div class="stat-value">
                    {{ $totalRecords }}
                </div>

                <div class="text-muted">
                    All maintenance records
                </div>
            </div>
        </div>


        <!-- Completed -->
        <div class="col-md-6 col-xl-4">
            <div class="card card-stat">
                <div class="card-header">
                    <span class="stat-label">
                        Completed
                    </span>
                </div>

                <div class="stat-value">
                    {{ $completedRecords }}
                </div>

                <div class="text-muted">
                    Successfully completed
                </div>
            </div>
        </div>


        <!-- This Month -->
        <div class="col-md-6 col-xl-4">
            <div class="card card-stat">
                <div class="card-header">
                    <span class="stat-label">
                        This Month
                    </span>
                </div>

                <div class="stat-value">
                    {{ $thisMonth }}
                </div>

                <div class="text-muted">
                    Records this month
                </div>
            </div>
        </div>

    </div>

    <!-- Maintenance Records Table -->
    <div class="card card-round">
        <div class="card-header">
            <div class="card-head-row">
                <div>
                    <div class="card-title">
                        Maintenance Records
                    </div>
                    <p class="text-muted mb-0">
                        History of maintenance activities performed.
                    </p>
                </div>                
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Complaint Code</th>
                            <th>Issue</th>
                            <th>Location</th>
                            <th>Maintenance Date</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($records as $record)
                            <tr>
                                <td class="table-order-id">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $record->complaint_code }}
                                </td>

                                <td class="table-product-name">
                                    {{ $record->issue_title }}
                                </td>

                                <td>
                                    {{ $record->location_name }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($record->completed_at)->format('d M Y') }}
                                </td>
                                
                                <td>
                                    <span class="badge-table success">
                                        Completed
                                    </span>
                                </td>                                
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('technician.maintenance.detail', $record->maintenance_id) }}"
                                            class="table-btn-action px-3 py-2" style="min-width: 85px;" title="View details">
                                            Details
                                        </a>                                       
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-clipboard-x fs-2 d-block mb-2"></i>

                                        <div class="fw-semibold">
                                            No maintenance records found.
                                        </div>

                                        <small>
                                            Completed maintenance records will appear here.
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