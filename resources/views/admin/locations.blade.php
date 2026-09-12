@extends('layouts.admin.app')

@section('title', 'Locations')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">
        Locations
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
                Locations
            </a>
        </li>
    </ul>
</div>


<div class="card card-round">
    <div class="card-header">
        <div class="card-head-row">
            <div>
                <h4 class="card-title">
                    Location Management
                </h4>
                <p class="card-category">
                    Manage locations available in FSDK facilities.
                </p>
            </div>
            <a href="{{ route('admin.locations.create') }}" class="btn btn-primary btn-sm ms-auto">
                <i class="fas fa-plus"></i>
                Add Location
            </a>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success m-3">
        <i class="fas fa-check-circle me-1"></i>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger m-3">
            <i class="fas fa-exclamation-circle me-1"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Location</th>
                        <th>Description</th>
                         <th>Available Facilities</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($locations as $location)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $location->location_name }}
                                </strong>
                            </td>

                            <td>
                                {{ $location->description ?? '-' }}
                            </td>

                            {{-- Available Facilities --}}
                            <td>
                                @if($location->available_facilities->count() > 0)

                                    @foreach($location->available_facilities as $facility)
                                        <span class="badge bg-light text-dark border me-1 mb-1">
                                            {{ $facility->facility_type_name }}
                                        </span>
                                    @endforeach

                                @else

                                    <span class="text-muted">
                                        No facilities assigned
                                    </span>

                                @endif
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($location->status === 'active')
                                    <span class="badge bg-success">
                                        Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="text-center">
                                <a href="{{ route('admin.locations.edit', $location->location_id) }}"
                                    class="btn btn-sm btn-outline-warning"
                                    title="Edit Location">
                                    Edit
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="fas fa-map-marker-alt fa-2x mb-3"></i>

                                <h6>
                                    No locations available
                                </h6>

                                <p class="mb-0">
                                    Add a location to start managing facility locations.
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