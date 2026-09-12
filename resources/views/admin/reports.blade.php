@extends('layouts.admin.app')

@section('title', 'Reports')

@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <h3 class="fw-bold mb-3">
            Reports
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
                <a href="#">Reports</a>
            </li>
        </ul>
    </div>


    <!-- Report Summary -->
    <div class="row">
        <!-- Total Complaints -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">

                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>

                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">
                                    Total Complaints
                                </p>

                                <h4 class="card-title">
                                    {{ $totalComplaints }}
                                </h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- Resolved -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">

                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>

                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">
                                    Resolved
                                </p>

                                <h4 class="card-title">
                                    {{ $resolvedComplaints }}
                                </h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- Average Resolution Time -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">

                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-stopwatch"></i>
                            </div>
                        </div>

                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">
                                    Avg. Resolution Time
                                </p>

                                <h4 class="card-title">
                                    {{ $averageResolutionTime }} Days
                                </h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- Completion Rate -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">

                        <div class="col-icon">
                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>

                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">
                                    Completion Rate
                                </p>

                                <h4 class="card-title">
                                     {{ $completionRate }}%
                                </h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Report Filter -->
    <div class="row">
        <div class="col-md-12">

            <div class="card card-round">
                <div class="card-header">
                    <div class="card-title">
                        Report Filter
                    </div>
                </div>

                <div class="card-body">
                    <form method="GET" action="{{ route('admin.reports') }}">
                        <div class="row align-items-end">
                            {{-- Start Date --}}
                            <div class="col-md-3">
                                <label class="form-label">
                                    Start Date
                                </label>
                                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                            </div>

                            {{-- End Date --}}
                            <div class="col-md-3">
                                <label class="form-label">
                                    End Date
                                </label>

                                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                            </div>

                            {{-- Status --}}
                            <div class="col-md-2">
                                <label class="form-label">
                                    Status
                                </label>

                                <select name="status" class="form-select">
                                    <option value="">
                                        All Status
                                    </option>

                                    <option value="pending"  {{ $filterStatus === 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="assigned" {{ $filterStatus === 'assigned' ? 'selected' : '' }}>
                                        Assigned
                                    </option>

                                    <option value="in_progress" {{ $filterStatus === 'in_progress' ? 'selected' : '' }}>
                                        In Progress
                                    </option>

                                    <option value="resolved" {{ $filterStatus === 'resolved' ? 'selected' : '' }}>
                                        Resolved
                                    </option>

                                    <option value="rejected" {{ $filterStatus === 'rejected' ? 'selected' : '' }}>
                                        Rejected
                                    </option>
                                </select>
                            </div>

                            {{-- Category --}}
                            <div class="col-md-2">
                                <label class="form-label">
                                    Category
                                </label>

                                <select name="category" class="form-select">
                                    <option value="">
                                        All Categories
                                    </option>
                                    @foreach($facilityTypes as $facilityType)
                                        <option
                                            value="{{ $facilityType->facility_type_id }}"
                                            {{ $filterCategory == $facilityType->facility_type_id ? 'selected' : '' }}>
                                            {{ $facilityType->facility_type_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Filter Button --}}
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter me-1"></i>
                                    Apply Filter
                                </button>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>


    <!-- Report Overview -->
    <div class="row">
        <!-- Complaints by Category -->
        <div class="col-md-6">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">
                            Complaints by Category
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="complaintsByCategoryChart"></canvas>
                    </div>

                </div>

            </div>

        </div>


        <!-- Complaints by Status -->
        <div class="col-md-6">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-title">
                        Complaints by Status
                    </div>
                </div>

                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="complaintsByStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Technician Performance -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-title mb-0">
                            Technician Performance
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.reports.technician-performance.pdf', array_merge(request()->query(), ['download' => 0])) }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-print"></i>
                                Print
                            </a>

                            <a href="{{ route('admin.reports.technician-performance.pdf', array_merge(request()->query(), ['download' => 1])) }}"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-file-pdf"></i>
                                Download PDF
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Technician</th>
                                    <th>Total Assignments</th>
                                    <th>Completed</th>
                                    <th>In Progress</th>
                                    <th>Pending</th>
                                    <th>Completion Rate</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($technicianPerformance as $technician)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">
                                                {{ $technician->technician_name }}
                                            </div>
                                        </td>
                                        <td>{{ $technician->total_assignments }}</td>
                                        <td>{{ $technician->completed }}</td>
                                        <td>{{ $technician->in_progress }}</td>
                                        <td>{{ $technician->pending }}</td>
                                        <td>
                                            <span class="fw-semibold">
                                                {{ $technician->completion_rate }}%
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5">
                                            <div class="mb-2">
                                                <i class="fas fa-user-cog fa-2x"></i>
                                            </div>

                                            <h6 class="mb-1">
                                                No technician data available
                                            </h6>

                                            <p class="mb-0">
                                                Technician performance data will appear here.
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Maintenance Report -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div>
                            <div class="card-title">
                                Maintenance Report
                            </div>
                            <p class="text-muted mb-0">
                                Summary of maintenance activities and complaint resolution.
                            </p>
                        </div>

                        <div class="d-flex gap-2 ms-auto">
                            <a href="{{ route('admin.reports.maintenance.pdf', array_merge(request()->query(), ['download' => 0])) }}"
                                target="_blank" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-print"></i>
                                Print
                            </a>

                            <a href="{{ route('admin.reports.maintenance.pdf', array_merge(request()->query(), ['download' => 1])) }}"
                                class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-file-pdf"></i>
                                Download PDF
                            </a>
                        </div>

                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Complaint Code</th>
                                    <th>Category</th>
                                    <th>Technician</th>
                                    <th>Priority</th>
                                    <th>Assigned Date</th>
                                    <th>Completed Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($maintenanceReport as $maintenance)
                                <tr>
                                    <td>
                                        <span class="fw-semibold">
                                            {{ $maintenance->complaint_code }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $maintenance->facility_type_name }}
                                    </td>

                                    <td>
                                        {{ $maintenance->technician_name }}
                                    </td>

                                    <td>
                                        @if($maintenance->priority === 'high')
                                            <span class="badge bg-danger">
                                                High
                                            </span>
                                        @elseif($maintenance->priority === 'medium')
                                            <span class="badge bg-warning text-dark">
                                                Medium
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                Low
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($maintenance->assigned_at)->format('d M Y') }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($maintenance->completed_at)->format('d M Y') }}
                                    </td>

                                    <td>
                                        @if($maintenance->status === 'resolved')
                                            <span class="badge bg-success">
                                                Resolved
                                            </span>
                                        @elseif($maintenance->status === 'in_progress')
                                            <span class="badge bg-info">
                                                In Progress
                                            </span>
                                        @elseif($maintenance->status === 'assigned')
                                            <span class="badge bg-primary">
                                                Assigned
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                {{ ucwords(str_replace('_', ' ', $maintenance->status)) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">
                                        <div class="mb-2">
                                            <i class="fas fa-file-alt fa-2x"></i>
                                        </div>

                                        <h6 class="mb-1">
                                            No maintenance records available
                                        </h6>

                                        <p class="mb-0">
                                            Maintenance report data will appear here.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Complaint Outcome & Feedback -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">

                <div class="card-header">
                    <div class="card-head-row">
                        <div>
                            <div class="card-title">
                                Complaint Outcome & Feedback
                            </div>

                            <p class="text-muted mb-0">
                                Overview of rejected complaints and user feedback.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Rejected Complaints -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <h5 class="mb-1">
                                    Rejected Complaints
                                </h5>

                                <p class="text-muted mb-0">
                                    Complaints that were rejected by the administrator.
                                </p>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.reports.rejected-complaints.pdf', array_merge(request()->query(), ['download' => 0])) }}"
                                    target="_blank" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-print"></i>
                                    Print
                                </a>

                                <a href="{{ route('admin.reports.rejected-complaints.pdf', array_merge(request()->query(), ['download' => 1])) }}"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-file-pdf"></i>
                                    Download PDF
                                </a>

                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Complaint Code</th>
                                        <th>Issue</th>
                                        <th>Category</th>
                                        <th>Rejection Reason</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($rejectedComplaints as $complaint)
                                        <tr>
                                            <td>
                                                <span class="fw-semibold">
                                                    {{ $complaint->complaint_code }}
                                                </span>
                                            </td>
                                            <td>{{ $complaint->issue_title }}</td>
                                            <td>{{ $complaint->facility_type_name }}</td>
                                            <td>{{ $complaint->rejection_reason ?: '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                No rejected complaints available.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>


                    <!-- User Feedback -->
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <h5 class="mb-1">
                                    User Feedback
                                </h5>
                                <p class="text-muted mb-0">
                                    Ratings and comments submitted by users.
                                </p>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.reports.user-feedback.pdf', array_merge(request()->query(), ['download' => 0])) }}"
                                    target="_blank" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-print"></i>
                                    Print
                                </a>

                                <a href="{{ route('admin.reports.user-feedback.pdf', array_merge(request()->query(), ['download' => 1])) }}"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-file-pdf"></i>
                                    Download PDF
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">

                                <thead>
                                    <tr>
                                        <th>Complaint Code</th>
                                        <th>Category</th>
                                        <th>Rating</th>
                                        <th>Comment</th>
                                        <th>Submitted</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($userFeedback as $feedback)

                                        <tr>
                                            <td>
                                                <span class="fw-semibold">
                                                    {{ $feedback->complaint_code }}
                                                </span>
                                            </td>

                                            <td>
                                                {{ $feedback->facility_type_name }}
                                            </td>

                                            <td>
                                                <span class="text-warning">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $feedback->rating)
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </span>

                                                <span class="ms-1">
                                                    ({{ $feedback->rating }}/5)
                                                </span>
                                            </td>

                                            <td>
                                                {{ $feedback->comment ?: '-' }}
                                            </td>

                                            <td>
                                                {{ \Carbon\Carbon::parse($feedback->submitted_at)->format('d M Y') }}
                                            </td>
                                        </tr>

                                    @empty

                                        <tr>
                                            <td
                                                colspan="5"
                                                class="text-center text-muted py-4"
                                            >
                                                No user feedback available.
                                            </td>
                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const categoryLabels = @json(
        $complaintsByCategory->pluck('facility_type_name')
    );

    const categoryData = @json(
        $complaintsByCategory->pluck('total')
    );

    const statusLabels = @json(
        $complaintsByStatus->pluck('status')->map(function ($status) {
            return ucwords(
                str_replace('_', ' ', $status)
            );
        })
    );

    const statusData = @json(
        $complaintsByStatus->pluck('total')
    );


    new Chart(
        document.getElementById('complaintsByCategoryChart'),
        {
            type: 'doughnut',

            data: {
                labels: categoryLabels,

                datasets: [{
                    data: categoryData
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        }
    );


    new Chart(
        document.getElementById('complaintsByStatusChart'),
        {
            type: 'doughnut',

            data: {
                labels: statusLabels,

                datasets: [{
                    data: statusData
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        }
    );
</script>
@endsection