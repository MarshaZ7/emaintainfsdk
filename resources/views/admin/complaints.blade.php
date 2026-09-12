@extends('layouts.admin.app')

@section('title', 'Complaints')

@section('content')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">Complaints</h3>
            <p class="text-muted mb-0">
                Manage and review facility and equipment complaints.
            </p>
        </div>
    </div>


    <!-- Statistics -->
    <div class="row mb-4">
        <!-- Total -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">
                                Total Complaints
                            </p>
                            <h3 class="fw-bold mb-0">
                                {{ $totalComplaints }}
                            </h3>
                        </div>

                        <div class="fs-1 text-primary">
                            <i class="bi bi-clipboard-data"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Pending -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">
                                Pending
                            </p>
                            <h3 class="fw-bold mb-0">
                                {{ $pendingComplaints }}
                            </h3>
                        </div>

                        <div class="fs-1 text-warning">
                            <i class="bi bi-clock-history"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- In Progress -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">
                                In Progress
                            </p>
                            <h3 class="fw-bold mb-0">
                                {{ $inProgressComplaints }}
                            </h3>
                        </div>

                        <div class="fs-1 text-info">
                            <i class="bi bi-tools"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Resolved -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">
                                Resolved
                            </p>
                            <h3 class="fw-bold mb-0">
                                {{ $resolvedComplaints }}
                            </h3>
                        </div>
                        <div class="fs-1 text-success">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Complaint List -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <!-- Table Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold mb-1">
                        Complaint List
                    </h5>
                    <p class="text-muted mb-0">
                        List of complaints submitted by FSDK users.
                    </p>
                </div>

            </div>

            <!-- Search & Filter -->
            <form method="GET" action="{{ route('admin.complaints') }}">
                <div class="row mb-4">

                    <!-- Search -->
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>

                            <input type="text" name="search" class="form-control" placeholder="Search complaints..."
                                value="{{ $search ?? '' }}">
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="col-md-3">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="all"
                                {{ ($status ?? 'all') === 'all' ? 'selected' : '' }}>
                                All Status
                            </option>

                            <option value="pending"
                                {{ ($status ?? '') === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="assigned"
                                {{ ($status ?? '') === 'assigned' ? 'selected' : '' }}>
                                Assigned
                            </option>

                            <option value="in_progress"
                                {{ ($status ?? '') === 'in_progress' ? 'selected' : '' }}>
                                In Progress
                            </option>

                            <option value="resolved"
                                {{ ($status ?? '') === 'resolved' ? 'selected' : '' }}>
                                Resolved
                            </option>

                            <option value="rejected"
                                {{ ($status ?? '') === 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>

                            <option value="closed"
                                {{ ($status ?? '') === 'closed' ? 'selected' : '' }}>
                                Closed
                            </option>
                        </select>
                    </div>

                    <!-- Search Button -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search me-1"></i>
                            Search
                        </button>
                    </div>

                    <!-- Reset -->
                    <div class="col-md-2">
                        <a href="{{ route('admin.complaints') }}" class="btn btn-light border w-100">
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            <!-- Complaint Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Complaint Code</th>
                            <th>Reporter</th>
                            <th>Issue</th>
                            <th>Location</th>
                            <th>Priority</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
                            <tr>
                                <td>
                                    <span class="fw-bold">
                                         {{ $complaint->complaint_code }}
                                    </span>
                                </td>

                                <td>
                                    {{ $complaint->reporter_name }}
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $complaint->issue_title }}
                                    </div>                                    
                                </td>

                                <td>
                                    {{ $complaint->location_name ?? '-' }}
                                </td>

                                <td>
                                    @if($complaint->priority === 'high')
                                        <span class="badge badge-danger">
                                            High
                                        </span>
                                    @elseif($complaint->priority === 'medium')
                                        <span class="badge badge-warning">
                                            Medium
                                        </span>
                                    @elseif($complaint->priority === 'low')
                                        <span class="badge badge-success">
                                            Low
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">
                                            Not Set
                                        </span>
                                    @endif
                                </td>
                                
                                <td>
                                    {{ date('d M Y', strtotime($complaint->submitted_at)) }}
                                </td>
                                <td>
                                    @if($complaint->status == 'pending')
                                        <span class="badge badge-warning">
                                            Pending
                                        </span>
                                    @elseif($complaint->status == 'assigned')
                                        <span class="badge badge-info">
                                            Assigned
                                        </span>
                                    @elseif($complaint->status == 'in_progress')
                                        <span class="badge badge-primary">
                                            In Progress
                                        </span>
                                    @elseif($complaint->status == 'resolved')
                                        <span class="badge badge-success">
                                            Resolved
                                        </span>
                                    @elseif($complaint->status == 'rejected')
                                        <span class="badge badge-danger">
                                            Rejected
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">
                                            {{ ucfirst($complaint->status) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <button type="button"
                                        class="btn btn-sm btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#complaintDetailModal"
                                        data-id="{{ $complaint->complaint_id }}"
                                        data-code="{{ $complaint->complaint_code }}"
                                        data-reporter="{{ $complaint->reporter_name }}"
                                        data-university-id="{{ $complaint->university_id }}"
                                        data-email="{{ $complaint->reporter_email }}"
                                        data-title="{{ $complaint->issue_title }}"
                                        data-category="{{ $complaint->facility_type_name ?? '-' }}"
                                        data-location="{{ $complaint->location_name ?? '-' }}"
                                        data-description="{{ $complaint->issue_description }}"
                                        data-status="{{ $complaint->status }}"
                                        data-submitted="{{ date('d M Y, H:i', strtotime($complaint->submitted_at)) }}"
                                        data-photo="{{ $complaint->defect_photo }}"
                                        data-priority="{{ $complaint->priority }}"
                                        data-assignment-id="{{ $complaint->assignments_id }}"
                                        data-rejection-reason="{{ $complaint->rejection_reason }}">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-clipboard-list fa-2x mb-2"></i>
                                    <h6 class="mb-1">No complaints available</h6>
                                    <p class="mb-0">
                                        No complaints have been submitted yet.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">
                    Showing {{ $complaints->firstItem() ?? 0 }}
                    to {{ $complaints->lastItem() ?? 0 }}
                    of {{ $complaints->total() }} complaints
                </small>

                {{ $complaints->links() }}
            </div>
        </div>
    </div>
</div>
@include('admin.complaint-detail')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('complaintDetailModal');

    modal.addEventListener('show.bs.modal', function (event) {

        const button = event.relatedTarget;

        const complaintId = button.dataset.id;
        const status = button.dataset.status;
        const priority = button.dataset.priority;
        const assignmentId = button.dataset.assignmentId;
        const rejectionReason = button.dataset.rejectionReason;

        document.getElementById('modalComplaintId').textContent =
            button.dataset.code;

        document.getElementById('modalReporter').textContent =
            button.dataset.reporter || '-';

        document.getElementById('modalUniversityId').textContent =
            button.dataset.universityId || '-';

        document.getElementById('modalEmail').textContent =
            button.dataset.email || '-';

        document.getElementById('modalIssueTitle').textContent =
            button.dataset.title || '-';

        document.getElementById('modalCategory').textContent =
            button.dataset.category || '-';

        document.getElementById('modalLocation').textContent =
            button.dataset.location || '-';

        document.getElementById('modalSubmitted').textContent =
            button.dataset.submitted || '-';

        document.getElementById('modalDescription').textContent =
            button.dataset.description || '-';
        
                   
        const photoContainer =
        document.getElementById('modalEvidenceContainer');

        if (button.dataset.photo) {
            photoContainer.innerHTML = `
                <img src="{{ asset('storage') }}/${button.dataset.photo}"
                    alt="Complaint Evidence"
                    class="img-fluid rounded border"
                    style="max-width: 100%; max-height: 350px; object-fit: contain;">
            `;

        } else {
            photoContainer.innerHTML = `
                <span class="text-muted">
                    No evidence photo uploaded.
                </span>
            `;
        }

        // Status
        let statusBadge = '';

        if (status === 'pending') {
            statusBadge = '<span class="badge badge-warning">Pending</span>';
        } else if (status === 'assigned') {
            statusBadge = '<span class="badge badge-info">Assigned</span>';
        } else if (status === 'in_progress') {
            statusBadge = '<span class="badge badge-primary">In Progress</span>';
        } else if (status === 'resolved') {
            statusBadge = '<span class="badge badge-success">Resolved</span>';
        } else if (status === 'rejected') {
            statusBadge = '<span class="badge badge-danger">Rejected</span>';
        } else {
            statusBadge = '<span class="badge badge-secondary">' +
                status.replace('_', ' ') +
                '</span>';
        }


        // Rejection Information
        const rejectionInfoSection =
            document.getElementById('rejectionInfoSection');

        const modalRejectionReason =
            document.getElementById('modalRejectionReason');

        if (status === 'rejected') {

            rejectionInfoSection.style.display = 'block';

            modalRejectionReason.textContent =
                rejectionReason || 'No rejection reason provided.';

        } else {

            rejectionInfoSection.style.display = 'none';

            modalRejectionReason.textContent = '-';

        }

        // Assignment Shortcut
        const assignmentSection =
            document.getElementById('assignmentSection');

        const viewAssignmentButton =
            document.getElementById('viewAssignmentButton');

        if (assignmentId && (
            status === 'assigned' ||
            status === 'in_progress' ||
            status === 'resolved'
        )) {

            assignmentSection.style.display = 'block';

            viewAssignmentButton.href =
                `{{ url('/admin/assignments') }}/${assignmentId}`;

        } else {

            assignmentSection.style.display = 'none';

            viewAssignmentButton.href = '#';

        }
        document.getElementById('modalStatus').innerHTML = statusBadge;
        
        // Priority
        const prioritySelect = document.getElementById('modalPriority');
        const priorityForm = document.getElementById('priorityForm');

        prioritySelect.value = priority || '';

        priorityForm.action =
            `{{ url('/admin/complaints') }}/${complaintId}/priority`;

        if (status === 'pending') {
            prioritySelect.disabled = false;
            priorityForm.querySelector(
                'button[type="submit"]'
            ).disabled = false;

        } else {
            prioritySelect.disabled = true;
            priorityForm.querySelector(
                'button[type="submit"]'
            ).disabled = true;

        }

        // Reject Complaint
        const rejectSection =
            document.getElementById('rejectSection');

        const rejectForm =
            document.getElementById('rejectComplaintForm');

        if (status === 'pending') {

            rejectSection.style.display = 'block';

            rejectForm.action =
                `{{ url('/admin/complaints') }}/${complaintId}/reject`;

        } else {

            rejectSection.style.display = 'none';

            rejectForm.action = '';

        }
    });

});
</script>

@endsection