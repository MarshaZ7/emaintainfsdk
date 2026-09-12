@extends('layouts.technician.app')

@section('title', 'Assignment Detail')

@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">
                Assignment Detail
            </h1>
            <p class="page-subtitle">
                View detailed information about this maintenance task.
            </p>
        </div>

        <a href="{{ route('technician.assignments') }}" class="btn btn-light">
            <i class="bi bi-arrow-left me-1"></i>
            Back to Assignments
        </a>
    </div>

    <!-- Assignment Information -->
    <div class="card card-round mb-4">
        <div class="card-header">
            <div>
                <div class="card-title">
                    Assignment Information
                </div>

                <p class="text-muted mb-0">
                    Information about this assigned maintenance task.
                </p>
            </div>
        </div>

        <div class="card-body">
            <div class="row g-4">
                <!-- Assignment ID -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Assignment ID
                    </label>

                    <div>
                        {{ $assignment->assignments_id }}
                    </div>
                </div>

                <!-- Complaint Code -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Complaint Code
                    </label>

                    <div>
                        {{ $assignment->complaint_code }}
                    </div>
                </div>

                <!-- Facility -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Facility
                    </label>

                    <div>
                        {{ $assignment->facility_type_name }}
                    </div>
                </div>

                <!-- Issue -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Issue
                    </label>

                    <div>
                        {{ $assignment->issue_title }}
                    </div>
                </div>

                <!-- Location -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Location
                    </label>

                    <div>
                        {{ $assignment->location_name }}
                    </div>

                    @if($assignment->location_description)
                        <small class="text-muted">
                            {{ $assignment->location_description }}
                        </small>
                    @endif
                </div>


                <!-- Priority -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Priority
                    </label>

                    <div>
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
                    </div>
                </div>


                <!-- Status -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Assignment Status
                    </label>

                    <div>
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
                    </div>
                </div>


                <!-- Assigned Date -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Assigned Date
                    </label>

                    <div>
                        {{ \Carbon\Carbon::parse($assignment->assigned_at)->format('M d, Y H:i') }}
                    </div>
                </div>


                <!-- Submitted Date -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Complaint Submitted
                    </label>

                    <div>
                        {{ \Carbon\Carbon::parse($assignment->submitted_at)->format('M d, Y H:i') }}
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Complaint Details -->
    <div class="card card-round mb-4">

        <div class="card-header">
            <div class="card-title">
                Complaint Details
            </div>
        </div>

        <div class="card-body">
            <div class="mb-4">
                <label class="form-label text-muted">
                    Issue Title
                </label>
                <div class="fw-semibold">
                    {{ $assignment->issue_title }}
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label text-muted">
                    Description
                </label>
                <div>
                    {{ $assignment->issue_description }}
                </div>
            </div>

            <!-- Defect Photo -->
            <div>
                <label class="form-label text-muted d-block">
                    Defect Photo
                </label>
                @if($assignment->defect_photo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $assignment->defect_photo) }}" alt="Complaint defect photo"
                            class="img-fluid rounded border" style="max-width: 500px; max-height: 350px; object-fit: contain;">
                    </div>

                @else
                    <div class="text-muted">
                        <i class="bi bi-image me-1"></i>
                        No defect photo was provided.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Complainant Information -->
    <div class="card card-round mb-4">
        <div class="card-header">
            <div class="card-title">
                Complainant Information
            </div>
        </div>

        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4">
                    <label class="form-label text-muted">
                        Name
                    </label>
                    <div class="fw-semibold">
                        {{ $assignment->complainant_name }}
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted">
                        University ID
                    </label>
                    <div class="fw-semibold">
                        {{ $assignment->complainant_university_id }}
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted">
                        Email
                    </label>
                    <div class="fw-semibold">
                        {{ $assignment->complainant_email }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Assignment Note -->
    <div class="card card-round mb-4">
        <div class="card-header">
            <div class="card-title">
                Assignment Note
            </div>
        </div>
        <div class="card-body">
            @if($assignment->assignment_note)
                <div>
                    {{ $assignment->assignment_note }}
                </div>
            @else
                <div class="text-muted">
                    No assignment note provided by admin.
                </div>
            @endif
        </div>
    </div>

    <!-- Assignment Action -->
    @if($assignment->assignment_status === 'pending')
        <div class="card card-round">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">
                            Ready to start?
                        </h5>
                        <p class="text-muted mb-0">
                            Start this assignment when you are ready to begin the maintenance work.
                        </p>
                    </div>

                    <form action="{{ route('technician.assignment.start', $assignment->assignments_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Start Assignment
                        </button>
                    </form>
                </div>
            </div>
        </div>

    @elseif($assignment->assignment_status === 'in_progress')
        <div class="card card-round">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">
                            Maintenance in progress
                        </h5>
                        <p class="text-muted mb-0">
                            Complete the maintenance task by providing a maintenance note and completion photo.
                        </p>
                    </div>

                    <a href="{{ route('technician.maintenance.create', $assignment->assignments_id) }}" class="btn btn-success px-4">
                        Complete Assignment
                    </a>

                </div>

            </div>

        </div>

    @endif

@endsection