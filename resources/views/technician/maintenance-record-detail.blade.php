@extends('layouts.technician.app')

@section('title', 'Maintenance Record Detail')

@section('content')

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">
                Maintenance Record Detail
            </h1>
            <p class="page-subtitle">
                View the details of the completed maintenance record.
            </p>
        </div>

        <div>
            <a href="{{ route('technician.maintenance.records') }}"
                class="btn btn-light">
                <i class="bi bi-arrow-left me-1"></i>
                Back to Maintenance Records
            </a>
        </div>
    </div>


    {{-- Maintenance Information --}}
    <div class="row g-4">

        <div class="col-12">

            <div class="card card-round">

                <div class="card-header">
                    <div>
                        <div class="card-title">
                            Maintenance Information
                        </div>

                        <p class="text-muted mb-0">
                            Information about the completed maintenance record.
                        </p>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row g-4">

                        {{-- Record ID --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted">
                                Record ID
                            </label>

                            <div class="fw-semibold">
                                #MR-{{ str_pad($record->maintenance_id, 3, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>


                        {{-- Complaint Code --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted">
                                Complaint Code
                            </label>

                            <div class="fw-semibold">
                                {{ $record->complaint_code }}
                            </div>
                        </div>


                        {{-- Issue --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted">
                                Issue
                            </label>

                            <div>
                                {{ $record->issue_title }}
                            </div>
                        </div>


                        {{-- Facility --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted">
                                Facility
                            </label>

                            <div>
                                {{ $record->facility_type_name }}
                            </div>
                        </div>


                        {{-- Location --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted">
                                Location
                            </label>

                            <div>
                                {{ $record->location_name }}
                            </div>

                            @if($record->location_description)
                                <small class="text-muted">
                                    {{ $record->location_description }}
                                </small>
                            @endif
                        </div>


                        {{-- Priority --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted">
                                Priority
                            </label>

                            <div>
                                @if($record->priority === 'high')
                                    <span class="badge bg-danger">
                                        High
                                    </span>
                                @elseif($record->priority === 'medium')
                                    <span class="badge bg-warning text-dark">
                                        Medium
                                    </span>
                                @elseif($record->priority === 'low')
                                    <span class="badge bg-info text-dark">
                                        Low
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        {{ ucfirst($record->priority) }}
                                    </span>
                                @endif

                            </div>
                        </div>


                        {{-- Status --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted">
                                Status
                            </label>

                            <div>
                                <span class="badge-table success">
                                    Completed
                                </span>
                            </div>
                        </div>

                        {{-- Completed Date --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted">
                                Completed Date
                            </label>
                            <div>
                                {{ \Carbon\Carbon::parse($record->completed_at)->format('d M Y, H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Maintenance Details --}}
        <div class="col-12">
            <div class="card card-round">
                <div class="card-header">
                    <div>
                        <div class="card-title">
                            Maintenance Details
                        </div>
                        <p class="text-muted mb-0">
                            Details of the maintenance activity performed.
                        </p>
                    </div>
                </div>

                <div class="card-body">
                    {{-- Maintenance Note --}}
                    <div class="mb-4">
                        <label class="form-label text-muted">
                            Maintenance Note
                        </label>
                        <div style="white-space: pre-line;">
                            {{ $record->maintenance_note }}
                        </div>
                    </div>

                    {{-- Assignment Note --}}
                    <div>
                        <label class="form-label text-muted">
                            Assignment Note
                        </label>
                        @if($record->assignment_note)
                            <div style="white-space: pre-line;">
                                {{ $record->assignment_note }}
                            </div>
                        @else
                            <div class="text-muted">
                                No assignment note provided by admin.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Completion Photo --}}
        <div class="col-12">
            <div class="card card-round">
                <div class="card-header">
                    <div>
                        <div class="card-title">
                            Completion Photo
                        </div>
                        <p class="text-muted mb-0">
                            Photo uploaded as proof of completed maintenance.
                        </p>
                    </div>
                </div>

                <div class="card-body">
                    @if($record->completion_photo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $record->completion_photo) }}"
                                alt="Maintenance completion photo" class="img-fluid rounded border"
                                style="max-width: 600px; max-height: 450px; object-fit: contain;">
                        </div>
                    @else
                        <div class="text-muted">
                            <i class="bi bi-image me-1"></i>
                            No completion photo was uploaded.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Complaint Details --}}
        <div class="col-12">
            <div class="card card-round">
                <div class="card-header">
                    <div>
                        <div class="card-title">
                            Complaint Details
                        </div>

                        <p class="text-muted mb-0">
                            Original complaint information related to this maintenance record.
                        </p>
                    </div>
                </div>

                <div class="card-body">
                    {{-- Issue Description --}}
                    <div class="mb-4">
                        <label class="form-label text-muted">
                            Issue Description
                        </label>
                        <div style="white-space: pre-line;">
                            {{ $record->issue_description }}
                        </div>
                    </div>

                    {{-- Defect Photo --}}
                    <div>
                        <label class="form-label text-muted d-block">
                            Defect Photo
                        </label>
                        @if($record->defect_photo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $record->defect_photo) }}" 
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
    </div>
@endsection