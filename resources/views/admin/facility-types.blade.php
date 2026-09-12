@extends('layouts.admin.app')

@section('title', 'Facility Types')

@section('content')

<div class="page-header">

    <h3 class="fw-bold mb-3">
        Facility Types
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
                Facility Types
            </a>
        </li>
    </ul>
</div>


<div class="card card-round">
    <div class="card-header">
        <div class="card-head-row">
            <div>
                <h4 class="card-title">
                    Facility Type Management
                </h4>
                <p class="card-category">
                    Manage facility types available at each location.
                </p>
            </div>
            <a href="{{ route('admin.facility.types.create') }}" class="btn btn-primary btn-sm ms-auto">
                <i class="fas fa-plus"></i>
                Add Facility
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Facility Type</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($facilityTypes as $facility)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            <strong>
                                {{ $facility->facility_type_name }}
                            </strong>
                        </td>
                        <td>
                            {{ $facility->description ?? '-' }}
                        </td>
                        <td>
                            @if($facility->status === 'active')
                                <span class="badge badge-success">
                                    Active
                                </span>
                            @else
                                <span class="badge badge-secondary">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.facility.types.edit', $facility->facility_type_id) }}"
                                class="btn btn-sm btn-outline-warning" title="Edit">
                                Edit <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            <i class="fas fa-building fa-2x mb-3"></i>
                            <h6>
                                No facility types available
                            </h6>
                            <p class="mb-0">
                                Add a facility type to start managing facilities.
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