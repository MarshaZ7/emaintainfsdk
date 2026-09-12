@extends('layouts.technician.app')

@section('title', 'Complete Assignment')

@section('content')

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Complete Assignment</h1>
            <p class="page-subtitle">
                Complete the maintenance assignment by providing the maintenance details and completion photo.
            </p>
        </div>

        <div>
            <a href="{{ route('technician.assignment.detail', $assignment->assignments_id) }}"
                class="btn btn-light">
                <i class="bi bi-arrow-left me-1"></i>
                Back to Assignment
            </a>
        </div>
    </div>


    {{-- Validation Error --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please check the following:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="row g-4">

        {{-- Assignment Information --}}
        <div class="col-12">
            <div class="card card-round">

                <div class="card-header">
                    <div>
                        <div class="card-title">
                            Assignment Information
                        </div>

                        <p class="text-muted mb-0">
                            Review the complaint and assignment details before completing the maintenance.
                        </p>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-4">                        
                        <div class="col-md-6">
                            <label class="form-label text-muted">
                                Complaint Code
                            </label>

                            <div class="fw-semibold">
                                {{ $assignment->complaint_code }}
                            </div>
                        </div>                    

                        {{-- Issue --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted">
                                Issue
                            </label>

                            <div>
                                {{ $assignment->issue_title }}
                            </div>
                        </div>

                        {{-- Facility --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted">
                                Facility
                            </label>

                            <div>
                                {{ $assignment->facility_type_name }}
                            </div>
                        </div>

                        {{-- Priority --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted">
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

                        {{-- Location --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted">
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

                        {{-- Assignment Note --}}
                        <div class="col-6">
                            <label class="form-label text-muted">
                                Assignment Note
                            </label>

                            <div>
                                @if($assignment->assignment_note)
                                    {{ $assignment->assignment_note }}
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
        </div>


        {{-- Maintenance Form --}}
        <div class="col-12">
            <div class="card card-round">

                <div class="card-header">
                    <div>
                        <div class="card-title">
                            Maintenance Details
                        </div>

                        <p class="text-muted mb-0">
                            Provide the details of the maintenance activity performed.
                        </p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('technician.maintenance.store', $assignment->assignments_id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- Maintenance Note --}}
                        <div class="mb-4">
                            <label for="maintenance_note" class="form-label fw-semibold">
                                Maintenance Note
                                <span class="text-danger">*</span>
                            </label>

                            <textarea name="maintenance_note" id="maintenance_note"
                                class="form-control" rows="5"
                                placeholder="Describe the maintenance action performed, issue resolution, replaced components, or other relevant details."
                                required>{{ old('maintenance_note') }}</textarea>

                            <small class="text-muted">
                                Explain what was checked, repaired, replaced, or resolved.
                            </small>

                        </div>


                        {{-- Completion Photo --}}
                        <div class="mb-4">
                            <label for="completion_photo" class="form-label fw-semibold">
                                Completion Photo
                                <span class="text-danger">*</span>
                            </label>

                            <input type="file" name="completion_photo" id="completion_photo"
                                class="form-control" accept="image/*" required>
                            <small class="text-muted">
                                Upload a photo as proof that the maintenance has been completed.
                                JPG, JPEG, PNG, or WEBP. Maximum size: 5 MB.
                            </small>
                        </div>

                        {{-- Warning --}}
                        <div class="alert alert-warning d-flex align-items-start" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2 mt-1"></i>
                            <div>
                                <strong>Before completing the assignment</strong>
                                <div class="mt-1">
                                    Make sure the maintenance information and completion photo
                                    are correct. Once submitted, the assignment will be marked
                                    as <strong>Completed</strong> and the complaint will be marked
                                    as <strong>Resolved</strong>.
                                </div>
                            </div>

                        </div>


                        {{-- Buttons --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('technician.assignment.detail', $assignment->assignments_id) }}"
                                class="btn btn-light px-4">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-check-circle me-1"></i>
                                Complete Assignment
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection