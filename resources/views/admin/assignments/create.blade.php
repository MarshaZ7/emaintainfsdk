@extends('layouts.admin.app')

@section('title', 'Add Assignment')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">
        Add Assignment
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
                Add Assignment
            </a>
        </li>
    </ul>
</div>


<div class="row">

    <!-- Create Assignment Form -->
    <div class="col-md-8">
        <div class="card card-round">

            <div class="card-header">
                <h4 class="card-title">
                    Create Assignment
                </h4>

                <p class="card-category">
                    Assign a complaint to an available technician.
                </p>
            </div>


            <div class="card-body">
                {{-- Validation Error --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        Please fix the following errors:
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Error Message --}}
                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        {{ session('error') }}
                    </div>
                @endif


                <form action="{{ route('admin.assignments.store') }}" method="POST">
                    @csrf
                    <!-- Complaint -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">
                            Complaint
                        </label>
                        <select name="complaint_id" class="form-select" required>
                            <option value="">
                                Select Complaint
                            </option>

                            @forelse($complaints as $complaint)

                                <option
                                    value="{{ $complaint->complaint_id }}"
                                    {{ old('complaint_id') == $complaint->complaint_id ? 'selected' : '' }}>

                                    {{ $complaint->complaint_code }}
                                    -
                                    {{ $complaint->issue_title }}
                                    |
                                    {{ $complaint->location_name }}
                                </option>
                            @empty
                                <option value="" disabled>
                                    No complaints available for assignment
                                </option>

                            @endforelse

                        </select>


                        <small class="form-text text-muted">
                            Select a pending complaint that needs to be handled by a technician.
                        </small>

                    </div>


                    <!-- Technician -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">
                            Technician
                        </label>

                        <select name="technician_id" class="form-select" required>
                            <option value="">
                                Select Technician
                            </option>
                            @forelse($technicians as $technician)
                                <option
                                    value="{{ $technician->user_id }}"
                                    {{ old('technician_id') == $technician->user_id ? 'selected' : '' }}>

                                    {{ $technician->name }}
                                    -
                                    {{ $technician->university_id }}
                                </option>
                            @empty
                                <option value="" disabled>
                                    No active technicians available
                                </option>
                            @endforelse
                        </select>

                        <small class="form-text text-muted">
                            Select an active technician responsible for this maintenance task.
                        </small>
                    </div>

                    <!-- Assignment Note -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">
                            Assignment Note
                        </label>

                        <textarea
                            name="assignment_note"
                            class="form-control"
                            rows="5"
                            placeholder="Add instructions or additional information for the technician...">{{ old('assignment_note') }}</textarea>

                        <small class="form-text text-muted">
                            Optional notes or instructions for the assigned technician.
                        </small>
                    </div>


                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.assignments') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-1"></i>
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-user-check me-1"></i>
                            Create Assignment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Information -->
    <div class="col-md-4">
        <div class="card card-round">
            <div class="card-header">
                <h4 class="card-title">
                    Assignment Information
                </h4>
            </div>

            <div class="card-body">
                <!-- Complaint Information -->
                <div class="d-flex align-items-start mb-4">
                    <div class="me-3 text-primary">
                        <i class="fas fa-clipboard-list fa-lg"></i>
                    </div>

                    <div>
                        <h6 class="fw-bold mb-1">
                            Complaint
                        </h6>
                        <p class="text-muted mb-0">
                            Select a pending complaint submitted by an FSDK user
                            that requires maintenance.
                        </p>
                    </div>
                </div>

                <hr>

                <!-- Technician Information -->
                <div class="d-flex align-items-start mb-4">
                    <div class="me-3 text-success">
                        <i class="fas fa-user-cog fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">
                            Technician
                        </h6>
                        <p class="text-muted mb-0">
                            Only active technicians are available
                            for assignment.
                        </p>
                    </div>
                </div>

                <hr>

                <!-- Status Information -->
                <div class="d-flex align-items-start">
                    <div class="me-3 text-warning">
                        <i class="fas fa-info-circle fa-lg"></i>
                    </div>

                    <div>
                        <h6 class="fw-bold mb-1">
                            Initial Status
                        </h6>
                        <p class="text-muted mb-0">
                            A new assignment starts with
                            <strong>Pending</strong> status.
                            The complaint status will change to
                            <strong>Assigned</strong>.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection