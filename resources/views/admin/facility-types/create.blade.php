@extends('layouts.admin.app')

@section('title', 'Add Facility Type')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">
        Add Facility Type
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
            <a href="{{ route('admin.facility.types') }}">
                Facility Types
            </a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">
                Add Facility Type
            </a>
        </li>
    </ul>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card card-round">
            <div class="card-header">
                <h4 class="card-title">
                    Add Facility Type
                </h4>
                <p class="card-category">
                    Add a new facility type to the system.
                </p>
            </div>

            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        Please fix the following errors:
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.facility.types.store') }}" method="POST">
                    @csrf
                    <!-- Facility Type Name -->
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold">
                            Facility Type
                        </label>
                        <input type="text" name="facility_type_name" class="form-control" placeholder="Example: Air Conditioner"
                            value="{{ old('facility_type_name') }}" required>
                        <small class="form-text text-muted">
                            Enter the name of the facility type.
                        </small>
                    </div>

                    <!-- Description -->
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold">
                            Description
                        </label>
                        <textarea name="description" class="form-control"
                            rows="4" placeholder="Describe this facility type...">{{ old('description') }}</textarea>
                        <small class="form-text text-muted">
                            Provide additional information about the facility.
                        </small>
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">
                            Status
                        </label>
                        <select name="status" class="form-select" required>
                            <option value="active"
                                {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive"
                                {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                        <small class="form-text text-muted">
                            Inactive facility types will not be available when submitting a complaint.
                        </small>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.facility.types') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-1"></i>
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Save Facility Type
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
                    Facility Type Information
                </h4>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start mb-3">
                    <div class="me-3 text-primary">
                        <i class="fas fa-building fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">
                            What is a Facility Type?
                        </h6>
                        <p class="text-muted mb-0">
                            A facility type represents the type of equipment
                            or facility that can be reported by FSDK users.
                        </p>
                    </div>
                </div>
                <hr>
                <div class="d-flex align-items-start">
                    <div class="me-3 text-warning">
                        <i class="fas fa-info-circle fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">
                            Example
                        </h6>
                        <p class="text-muted mb-0">
                            Air Conditioner, Projector, Computer,
                            Laboratory Equipment, Printer, and so on.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection