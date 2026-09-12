@extends('layouts.technician.app')

@section('title', 'Assignments')

@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">
                Assignments
            </h1>
            <p class="page-subtitle">
                View and manage your assigned maintenance tasks.
            </p>
        </div>        
    </div>

    <!-- Assignments Table -->
    <div class="card card-round">
        <!-- Card Header -->
        <div class="card-header">
            <div class="card-head-row">
                <div>
                    <div class="card-title">
                        My Assignments
                    </div>
                    <p class="text-muted mb-0">
                        Maintenance tasks assigned to you.
                    </p>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <!-- Filter -->
            <form method="GET" action="{{ route('technician.assignments') }}">
                <div class="row g-2 mb-3">
                    <!-- Search Input -->
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>

                            <input type="text" name="search" class="form-control"
                                placeholder="Search assignments..." value="{{ $search ?? '' }}">
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i>
                            Search
                        </button>
                    </div>
                </div>

                <!-- Filter Row -->
                <div class="row g-2 mb-4">                    
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="all"
                                {{ ($status ?? 'all') === 'all' ? 'selected' : '' }}>
                                All Status
                            </option>

                            <option value="pending"
                                {{ ($status ?? '') === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="in_progress"
                                {{ ($status ?? '') === 'in_progress' ? 'selected' : '' }}>
                                In Progress
                            </option>

                            <option value="completed"
                                {{ ($status ?? '') === 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>
                        </select>
                    </div>

                    <!-- Priority Filter -->
                    <div class="col-md-4">
                        <select name="priority" class="form-select">
                            <option value="all"
                                {{ ($priority ?? 'all') === 'all' ? 'selected' : '' }}>
                                All Priority
                            </option>

                            <option value="low"
                                {{ ($priority ?? '') === 'low' ? 'selected' : '' }}>
                                Low
                            </option>

                            <option value="medium"
                                {{ ($priority ?? '') === 'medium' ? 'selected' : '' }}>
                                Medium
                            </option>

                            <option value="high"
                                {{ ($priority ?? '') === 'high' ? 'selected' : '' }}>
                                High
                            </option>
                        </select>
                    </div>

                    <!-- Reset -->
                    <div class="col-md-2">
                        <a href="{{ route('technician.assignments') }}" class="btn btn-light w-100" title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Complaint Code</th>
                            <th>Facility / Issue</th>
                            <th>Location</th>
                            <th>Priority</th>
                            <th>Assigned Date</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($assignments as $assignment)
                        <tr>                            
                            <td>{{ $assignments->firstItem() + $loop->index }}</td>                       
                            <td>
                                {{ $assignment->complaint_code }}
                            </td>                            
                            <td class="table-product-name">
                                <div>
                                    <strong>
                                        {{ $assignment->facility_type_name }}
                                    </strong>
                                    <div class="text-muted small">
                                        {{ $assignment->issue_title }}
                                    </div>
                                </div>
                            </td>                            
                            <td>
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
                                {{ \Carbon\Carbon::parse($assignment->assigned_at)->format('M d, Y') }}
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
                            <td>
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <a href="{{ route('technician.assignment.detail', $assignment->assignments_id) }}"
                                        class="btn btn-sm btn-outline-primary px-3" title="View assignment details">
                                        Detail
                                    </a>
                                    
                                   @if($assignment->assignment_status === 'pending')
                                    <form action="{{ route('technician.assignment.start', $assignment->assignments_id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary px-3">
                                            Start
                                        </button>
                                    </form>

                                @elseif($assignment->assignment_status === 'in_progress')                                    
                                    <button type="button"
                                        class="btn btn-sm btn-success px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#completeModal{{ $assignment->assignments_id }}">
                                        Complete
                                    </button>
                                    
                                    <div class="modal fade" id="completeModal{{ $assignment->assignments_id }}"
                                        tabindex="-1" aria-labelledby="completeModalLabel{{ $assignment->assignments_id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
                                            <div class="modal-content">
                                                {{-- Modal Header --}}
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="completeModalLabel{{ $assignment->assignments_id }}">
                                                        <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>
                                                        Complete Assignment
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>

                                                {{-- Modal Body --}}
                                                <div class="modal-body">
                                                    <p class="mb-2"
                                                        style="white-space: normal; overflow-wrap: break-word; word-break: normal;">
                                                        Are you sure you want to complete this assignment?
                                                    </p>
                                                    <p class="text-muted mb-0"
                                                        style="white-space: normal; overflow-wrap: break-word; word-break: normal;">
                                                        You will need to provide the maintenance note and
                                                        completion photo before the assignment can be marked
                                                        as completed.
                                                    </p>

                                                </div>

                                                {{-- Modal Footer --}}
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <a href="{{ route('technician.maintenance.create', $assignment->assignments_id) }}"
                                                        class="btn btn-primary">
                                                        Continue
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                No assignments available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
            </div>
            {{-- Pagination --}}
            @if($assignments->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $assignments->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection