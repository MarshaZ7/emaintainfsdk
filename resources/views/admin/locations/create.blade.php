@extends('layouts.admin.app')

@section('title', 'Add Location')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">
        Add Location
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
            <a href="{{ route('admin.locations') }}">
                Locations
            </a>
        </li>

        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>

        <li class="nav-item">
            <a href="#">
                Add Location
            </a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card card-round">
            <div class="card-header">
                <div class="card-title">
                    Add New Location
                </div>
                <p class="card-category">
                    Add a new location available in FSDK facilities.
                </p>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.locations.store') }}" method="POST">
                    @csrf
                    <!-- Location Name -->
                    <div class="form-group mb-3">
                        <label for="location_name">
                            Location Name
                        </label>
                        <input type="text" name="location_name" id="location_name" class="form-control"
                            placeholder="Example: Computer Laboratory 1" value="{{ old('location_name') }}" required>
                    </div>

                    <!-- Description -->
                    <div class="form-group mb-3">
                        <label for="description">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="4" class="form-control"
                            placeholder="Enter location description">{{ old('description') }}</textarea>
                    </div>

                    <!-- Available Facility Types -->
                    <div class="form-group mb-4">
                        <label class="mb-2">
                            Available Facility Types
                        </label>

                        <div class="border rounded p-3 bg-light">
                            <div class="row">
                                @foreach($facilityTypes as $facility)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input
                                                type="checkbox" name="available_facility_types[]"
                                                value="{{ $facility->facility_type_id }}"
                                                id="facility_{{ $facility->facility_type_id }}"
                                                class="form-check-input"
                                                {{ in_array($facility->facility_type_id, old('facility_types', [])) ? 'checked' : '' }}
                                            >

                                            <label class="form-check-label" for="facility_{{ $facility->facility_type_id }}">
                                                {{ $facility->facility_type_name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <small class="text-muted">
                            Select the facility types available at this location.
                        </small>
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-4">
                        <label>
                            Status
                        </label>
                        <div class="form-control bg-light">
                            <span class="badge badge-success">
                                Active
                            </span>
                            <small class="text-muted ms-2">
                                New locations are active by default.
                            </small>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.locations') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Save Location
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection