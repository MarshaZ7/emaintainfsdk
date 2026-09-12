@extends('layouts.admin.app')

@section('title', 'Assignment Detail')

@section('content')

<div class="page-header">

    <h3 class="fw-bold mb-3">
        Assignment Detail
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
            <a href="{{ route('admin.assignments') }}">
                Assignments
            </a>
        </li>

        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>

        <li class="nav-item">
            <a href="#">
                Detail
            </a>
        </li>
    </ul>
</div>


{{-- Back Button --}}
<div class="mb-3">
    <a href="{{ route('admin.assignments') }}"
        class="btn btn-light">
        <i class="fas fa-arrow-left me-1"></i>
        Back to Assignments
    </a>
</div>


{{-- Assignment Information --}}
<div class="card card-round mb-4">

    <div class="card-header">
        <h4 class="card-title fw-bold mb-1">
            Assignment Information
        </h4>

        <p class="text-muted mb-0">
            Information about the maintenance assignment.
        </p>
    </div>

    <div class="card-body">

        <div class="row g-4">

            {{-- Assignment ID --}}
            <div class="col-md-6">
                <label class="form-label text-muted d-block">
                    Assignment ID
                </label>

                <span class="fw-semibold">
                    #{{ $assignment->assignments_id }}
                </span>
            </div>


            {{-- Complaint Code --}}
            <div class="col-md-6">
                <label class="form-label text-muted d-block">
                    Complaint Code
                </label>

                <span class="fw-semibold">
                    {{ $assignment->complaint_code }}
                </span>
            </div>


            {{-- Technician --}}
            <div class="col-md-6">
                <label class="form-label text-muted d-block">
                    Technician
                </label>

                <span class="fw-semibold">
                    <i class="fas fa-user-cog me-1 text-muted"></i>
                    {{ $assignment->technician_name }}
                </span>
            </div>


            {{-- Technician University ID --}}
            <div class="col-md-6">
                <label class="form-label text-muted d-block">
                    Technician University ID
                </label>

                <span class="fw-semibold">
                    {{ $assignment->technician_university_id ?? '-' }}
                </span>
            </div>


            {{-- Priority --}}
            <div class="col-md-6">
                <label class="form-label text-muted d-block">
                    Priority
                </label>

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
                        Not Set
                    </span>

                @endif
            </div>


            {{-- Assignment Status --}}
            <div class="col-md-6">
                <label class="form-label text-muted d-block">
                    Assignment Status
                </label>

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
                        {{ ucfirst(str_replace('_', ' ', $assignment->assignment_status)) }}
                    </span>

                @endif
            </div>


            {{-- Assigned By --}}
            <div class="col-md-6">
                <label class="form-label text-muted d-block">
                    Assigned By
                </label>

                <span class="fw-semibold">
                    {{ $assignment->admin_name ?? '-' }}
                </span>
            </div>


            {{-- Assigned At --}}
            <div class="col-md-6">
                <label class="form-label text-muted d-block">
                    Assigned At
                </label>

                <span class="fw-semibold">
                    {{ date('d M Y, H:i', strtotime($assignment->assigned_at)) }}
                </span>
            </div>


            {{-- Assignment Note --}}
            <div class="col-md-12">

                <label class="form-label text-muted d-block">
                    Assignment Note
                </label>

                <div class="bg-light rounded p-3">

                    @if($assignment->assignment_note)

                        <span>
                            {{ $assignment->assignment_note }}
                        </span>

                    @else

                        <span class="text-muted">
                            No assignment note provided by admin.
                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>
</div>


{{-- Technician Information --}}
<div class="card card-round mb-4">
    <div class="card-header">
        <h4 class="card-title fw-bold mb-1">
            Technician Information
        </h4>

        <p class="text-muted mb-0">
            Contact information of the assigned technician.
        </p>
    </div>

    <div class="card-body">

        <div class="row g-4">

            {{-- Name --}}
            <div class="col-md-6">

                <label class="form-label text-muted d-block">
                    Name
                </label>

                <span class="fw-semibold">
                    {{ $assignment->technician_name }}
                </span>

            </div>


            {{-- University ID --}}
            <div class="col-md-6">

                <label class="form-label text-muted d-block">
                    University ID
                </label>

                <span class="fw-semibold">
                    {{ $assignment->technician_university_id ?? '-' }}
                </span>

            </div>


            {{-- Email --}}
            <div class="col-md-12">

                <label class="form-label text-muted d-block">
                    Email
                </label>

                <span class="fw-semibold">
                    {{ $assignment->technician_email ?? '-' }}
                </span>

            </div>

        </div>

    </div>
</div>



{{-- Complaint Information --}}
<div class="card card-round mb-4">

    <div class="card-header">
        <h4 class="card-title fw-bold mb-1">
            Complaint Information
        </h4>

        <p class="text-muted mb-0">
            Details of the complaint related to this assignment.
        </p>
    </div>

    <div class="card-body">

        <div class="row g-4">

            {{-- Reporter --}}
            <div class="col-md-6">

                <label class="form-label text-muted d-block">
                    Reporter
                </label>

                <span class="fw-semibold">
                    {{ $assignment->complainant_name }}
                </span>

            </div>


            {{-- University ID --}}
            <div class="col-md-6">

                <label class="form-label text-muted d-block">
                    Reporter University ID
                </label>

                <span class="fw-semibold">
                    {{ $assignment->complainant_university_id ?? '-' }}
                </span>

            </div>


            {{-- Email --}}
            <div class="col-md-12">

                <label class="form-label text-muted d-block">
                    Reporter Email
                </label>

                <span class="fw-semibold">
                    {{ $assignment->complainant_email ?? '-' }}
                </span>

            </div>


            {{-- Issue Title --}}
            <div class="col-md-6">

                <label class="form-label text-muted d-block">
                    Issue Title
                </label>

                <span class="fw-semibold">
                    {{ $assignment->issue_title }}
                </span>

            </div>


            {{-- Facility --}}
            <div class="col-md-6">

                <label class="form-label text-muted d-block">
                    Facility Type
                </label>

                <span class="fw-semibold">
                    {{ $assignment->facility_type_name }}
                </span>

            </div>


            {{-- Location --}}
            <div class="col-md-6">

                <label class="form-label text-muted d-block">
                    Location
                </label>

                <span class="fw-semibold">
                    <i class="fas fa-map-marker-alt me-1 text-muted"></i>
                    {{ $assignment->location_name }}
                </span>

            </div>


            {{-- Submitted --}}
            <div class="col-md-6">

                <label class="form-label text-muted d-block">
                    Submitted At
                </label>

                <span class="fw-semibold">
                    {{ date('d M Y, H:i', strtotime($assignment->submitted_at)) }}
                </span>

            </div>


            {{-- Location Description --}}
            <div class="col-md-12">

                <label class="form-label text-muted d-block">
                    Location Description
                </label>

                <div class="bg-light rounded p-3">
                    <span>
                        {{ $assignment->location_description ?? '-' }}
                    </span>
                </div>
            </div>

            {{-- Issue Description --}}
            <div class="col-md-12">
                <label class="form-label text-muted d-block">
                    Issue Description
                </label>

                <div class="bg-light rounded p-3">
                    <span>
                        {{ $assignment->issue_description }}
                    </span>
                </div>
            </div>


            {{-- Defect Photo --}}
            <div class="col-md-12">

                <label class="form-label text-muted d-block">
                    Defect Photo
                </label>

                @if($assignment->defect_photo)

                    <div class="mt-2">

                        <img src="{{ asset('storage/' . $assignment->defect_photo) }}"
                        alt="Complaint defect photo" class="img-fluid rounded border"
                            style="max-width: 500px; max-height: 350px; object-fit: contain;">
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
</div>



{{-- Maintenance Information --}}
<div class="card card-round mb-4">

    <div class="card-header">
        <h4 class="card-title fw-bold mb-1">
            Maintenance Information
        </h4>

        <p class="text-muted mb-0">
            Maintenance results recorded by the technician.
        </p>
    </div>

    <div class="card-body">
        @if($assignment->maintenance_id)
            <div class="row g-4">
                {{-- Maintenance Status --}}
                <div class="col-md-6">
                    <label class="form-label text-muted d-block">
                        Maintenance Status
                    </label>
                    <span class="badge bg-success">
                        Completed
                    </span>
                </div>

                {{-- Completed At --}}
                <div class="col-md-6">
                    <label class="form-label text-muted d-block">
                        Completed At
                    </label>
                    <span class="fw-semibold">
                        {{ date('d M Y, H:i', strtotime($assignment->completed_at)) }}
                    </span>
                </div>


                {{-- Maintenance Note --}}
                <div class="col-md-12">

                    <label class="form-label text-muted d-block">
                        Maintenance Note
                    </label>

                    <div class="bg-light rounded p-3">

                        <span>
                            {{ $assignment->maintenance_note ?? '-' }}
                        </span>

                    </div>

                </div>


                {{-- Completion Photo --}}
                <div class="col-md-12">

                    <label class="form-label text-muted d-block">
                        Completion Photo
                    </label>

                    @if($assignment->completion_photo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $assignment->completion_photo) }}"
                                alt="Maintenance completion photo" class="img-fluid rounded border"
                                style="max-width: 500px; max-height: 350px; object-fit: contain;">
                        </div>
                    @else
                        <div class="text-muted">
                            <i class="bi bi-image me-1"></i>
                            No completion photo was provided.
                        </div>

                    @endif
                </div>
            </div>
        @else
            <div class="text-center py-4">
                <div class="mb-2">
                    <i class="fas fa-tools fa-2x text-muted"></i>
                </div>

                <h6 class="fw-semibold mb-1">
                    No Maintenance Record Yet
                </h6>
                <p class="text-muted mb-0">
                    The technician has not completed this assignment yet.
                </p>
            </div>

        @endif

    </div>
</div>

{{-- User Feedback --}}
<div class="card card-round mb-4">
    <div class="card-header">
        <h4 class="card-title fw-bold mb-1">
            User Feedback
        </h4>

        <p class="text-muted mb-0">
            Feedback submitted by the user after the maintenance was completed.
        </p>
    </div>

    <div class="card-body">
        @if($assignment->feedback_id)
            <div class="row g-4">
                {{-- Rating --}}
                <div class="col-md-6">
                    <label class="form-label text-muted d-block">
                        Rating
                    </label>
                    <div class="fs-4">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $assignment->feedback_rating)
                                <span class="text-warning">★</span>
                            @else
                                <span class="text-muted">☆</span>
                            @endif
                        @endfor
                        <span class="fs-6 text-muted ms-2">
                            {{ $assignment->feedback_rating }}/5
                        </span>
                    </div>
                </div>

                {{-- Submitted At --}}
                <div class="col-md-6">
                    <label class="form-label text-muted d-block">
                        Submitted At
                    </label>

                    <span class="fw-semibold">
                        {{ date('d M Y, H:i', strtotime($assignment->feedback_submitted_at)) }}
                    </span>
                </div>

                {{-- Comment --}}
                <div class="col-md-12">
                    <label class="form-label text-muted d-block">
                        Comment
                    </label>
                    <div class="bg-light rounded p-3">
                        @if($assignment->feedback_comment)
                            <span>
                                {{ $assignment->feedback_comment }}
                            </span>
                        @else
                            <span class="text-muted">
                                No comment provided.
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-4">
                <div class="mb-2">
                    <i class="fas fa-comment-slash fa-2x text-muted"></i>
                </div>
                <h6 class="fw-semibold mb-1">
                    No Feedback Yet
                </h6>
                <p class="text-muted mb-0">
                    The user has not submitted feedback for this maintenance yet.
                </p>
            </div>
        @endif
    </div>
</div>

{{-- Bottom Action --}}
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.assignments') }}"
        class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>
        Back to Assignments
    </a>

</div>

@endsection