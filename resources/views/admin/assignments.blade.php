@extends('layouts.admin.app')

@section('title', 'Assignments')

@section('content')

<div class="page-header">

    <h3 class="fw-bold mb-3">
        Assignments
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
                Assignments
            </a>
        </li>
    </ul>
</div>

<div class="card card-round">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <div>
                <h4 class="card-title mb-1">
                    Assignment Management
                </h4>
                <p class="text-muted mb-0">
                    Manage maintenance assignments for technicians.
                </p>
            </div>
            <a href="{{ route('admin.assignments.create') }}" class="btn btn-primary btn-round ms-auto">
                <i class="fa fa-plus"></i>
                Add Assignment
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mx-3 mt-3">
            <i class="fas fa-check-circle me-1"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Complaint</th>
                        <th>Issue</th>
                        <th>Location</th>
                        <th>Facility</th>
                        <th>Priority</th>
                        <th>Technician</th>
                        <th>Status</th>
                        <th>Assigned At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignments as $assignment)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>                                
                                {{ $assignment->complaint_code }}
                            </td>
                            <td>
                                {{ $assignment->issue_title }}
                            </td>
                            <td>
                                <i class="fas fa-map-marker-alt me-1 text-muted"></i>
                                {{ $assignment->location_name }}
                            </td>
                            <td>
                                {{ $assignment->facility_type_name }}
                            </td>
                            <td>
                                @if($assignment->priority == 'high')
                                    <span class="badge bg-danger">
                                        High
                                    </span>
                                @elseif($assignment->priority == 'medium')
                                    <span class="badge bg-warning text-dark">
                                        Medium
                                    </span>
                                @elseif($assignment->priority == 'low')
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
                                <i class="fas fa-user-cog me-1 text-muted"></i>
                                {{ $assignment->technician_name }}
                            </td>
                            <td>
                                @if($assignment->assignment_status == 'pending')
                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>
                                @elseif($assignment->assignment_status == 'in_progress')
                                    <span class="badge bg-info text-dark">
                                        In Progress
                                    </span>
                                @elseif($assignment->assignment_status == 'completed')
                                    <span class="badge bg-success">
                                        Completed
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        {{ ucfirst(str_replace('_', ' ', $assignment->assignment_status)) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                {{ date('d M Y, H:i', strtotime($assignment->assigned_at)) }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.assignments.detail', $assignment->assignments_id) }}"
                                    class="btn btn-sm btn-info">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10"
                                class="text-center text-muted py-5">
                                <div class="mb-2">
                                    <i class="fas fa-tasks fa-2x"></i>
                                </div>
                                <h6 class="mb-1">
                                    No assignments available
                                </h6>
                                <p class="mb-0">
                                    No maintenance assignments have been created yet.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection