@extends('layouts.technician.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">
                Dashboard
            </h1>
            <p class="page-subtitle">
                Manage your maintenance assignments efficiently.
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
                    All assigned tasks
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="col-md-6 col-xl-3">
            <div class="card card-stat">
                <div class="card-header">
                    <span class="stat-label">
                        Pending
                    </span>
                </div>
                <div class="stat-value">
                    {{ $pendingAssignments }}
                </div>
                <div class="text-muted">
                    Tasks waiting to start
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
                    Currently being handled
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
                    Successfully completed
                </div>
            </div>
        </div>
    </div>
  
    <!-- Main Content -->
    <div class="row g-4">
        <!-- Recent Assignments -->
        <div class="col-xl-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div>
                            <div class="card-title">
                                Recent Assignments
                            </div>
                            <p class="text-muted mb-0">
                                Your latest maintenance assignments.
                            </p>
                        </div>
                        <a href="{{ route('technician.assignments') }}"
                        class="btn btn-primary btn-sm ms-auto">
                            View All
                        </a>
                    </div>
                </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Complaint Code</th>
                                <th>Location</th>
                                <th>Priority</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($recentAssignments as $assignment)
                            <tr>                                
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $assignment->complaint_code }}
                                </td>                                
                                <td>
                                    <i class="bi bi-geo-alt me-1"></i>
                                    {{ $assignment->location_name }}
                                </td>                                
                                <td>
                                    @if($assignment->priority === 'high')
                                        <span class="badge bg-danger">
                                            High
                                        </span>
                                    @elseif($assignment->priority === 'medium')
                                        <span class="badge bg-warning text-dark">
                                            Medium
                                        </span>
                                    @elseif($assignment->priority === 'low')
                                        <span class="badge bg-info text-dark">
                                            Low
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($assignment->priority) }}
                                        </span>
                                    @endif
                                </td>                                
                                <td>
                                    @if($assignment->assignment_status === 'pending')
                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>
                                    @elseif($assignment->assignment_status === 'in_progress')
                                        <span class="badge bg-info text-dark">
                                            In Progress
                                        </span>
                                    @elseif($assignment->assignment_status === 'completed')
                                        <span class="badge bg-success">
                                            Completed
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ ucwords(str_replace('_', ' ', $assignment->assignment_status)) }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                    No assignments available.
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