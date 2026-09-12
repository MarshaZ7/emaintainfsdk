@extends('layouts.fsdk-user.app')

@section('title', 'My Complaints')

@section('content')

<style>
    .user-complaints {
    min-height: 100vh;
    padding-top: 120px;
    padding-bottom: 80px;
    background-color: #08005e;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    }

    .complaint-card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        background: #ffffff;
    }

    .complaint-table {
        background: #ffffff;
    }

    .complaint-header {
        padding: 25px;
        background: #ffffff;
        border-bottom: 1px solid #eeeeee;
    }

    .complaint-header h2 {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .complaint-header p {
        color: #6c757d;
        margin-bottom: 0;
    }
   
    .complaint-table th {
        padding: 16px 18px;
        border-bottom: 1px solid #eeeeee;
        color: #495057;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .complaint-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #f1f1f1;
        vertical-align: middle;
    }

    .complaint-table tbody tr {
        transition: 0.2s ease;
    }

    .complaint-table tbody tr:hover {
        background: #f8faff;
    }

    .complaint-id {
        font-weight: 700;
        color: #3351f8;
    }

    .complaint-title {
        font-weight: 600;
        color: #343a40;
    }

    .complaint-content {
    min-height: 650px;
    display: flex;
    flex-direction: column;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-default {
        background: #fff3cd;
        color: #856404;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-assigned {
    background: #cfe2ff;
    color: #084298;
    }

    .status-in-progress {
        background: #cff4fc;
        color: #055160;
    }

    .status-resolved {
        background: #d1e7dd;
        color: #0f5132;
    }

    .status-rejected {
        background: #f8d7da;
        color: #842029;
    } 

    .empty-state {
        padding: 65px 20px;
        text-align: center;
        background: #ffffff;
    }

    .empty-icon {
        width: 75px;
        height: 75px;
        margin: 0 auto 18px;
        border-radius: 50%;
        background: #f1f4f8;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-icon i {
        font-size: 34px;
        color: #8a94a6;
    }

    .empty-state h5 {
        font-weight: 700;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: #6c757d;
        margin-bottom: 20px;
    }
    .complaint-pagination {
    padding: 20px 25px;
    border-top: 1px solid #eeeeee;
    background: #ffffff;
    }

    .complaint-pagination .pagination {
        margin-bottom: 0;
        justify-content: center;
    }

    .feedback-indicator {
    display: block;
    width: fit-content;
    margin-top: 7px;
    font-size: 11px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
}

.feedback-pending {
    color: #b77900;
}

.feedback-pending:hover {
    color: #8f5e00;
    text-decoration: underline;
}

.feedback-done {
    color: #198754;
}
</style>

<section class="user-complaints">
    <div class="container">

        <div class="row">
            <div class="col-12" data-aos="fade-up">

                <div class="card complaint-card">

                    <!-- Header -->
                    <div class="complaint-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div>
                                <h2>My Complaints</h2>
                                <p>
                                    View and monitor the complaints you have submitted.
                                </p>
                            </div>

                            <a href="{{ route('user.report-issue') }}"
                               class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i>
                                Report New Issue
                            </a>

                        </div>
                                        </div>

                    <div class="complaint-content">

                        {{-- Search & Filter --}}
                        <div class="px-4 pt-4 pb-3">

                            <form method="GET"
                                  action="{{ route('user.complaints') }}">

                                <div class="row g-2 align-items-center">

                                    {{-- Search --}}
                                    <div class="col-md-7">

                                        <div class="input-group">

                                            <span class="input-group-text bg-white">
                                                <i class="bi bi-search"></i>
                                            </span>

                                            <input
                                                type="text"
                                                name="search"
                                                class="form-control"
                                                placeholder="Search by complaint code, issue title, or location..."
                                                value="{{ $search ?? '' }}"
                                            >

                                        </div>

                                    </div>


                                    {{-- Status Filter --}}
                                    <div class="col-md-3">
                                        <select name="status" class="form-select">
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

                                        </select>

                                    </div>

                                    {{-- Search & Reset Button --}}
                                    <div class="col-md-2">
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary flex-grow-1">
                                                <i class="bi bi-search me-1"></i>
                                                Search
                                            </button>

                                            @if(!empty($search) || ($status ?? 'all') !== 'all')
                                                <a href="{{ route('user.complaints') }}"
                                                    class="btn btn-outline-secondary"
                                                    title="Reset">
                                                    <i class="bi bi-arrow-counterclockwise"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    <!-- Complaint Table -->
                    @if ($complaints->count() > 0)

                        <div class="table-responsive complaint-table">

                            <table class="table table-hover align-middle mb-0">

                                <thead>
                                    <tr>
                                        <th class="ps-4">
                                            Complaint Code
                                        </th>

                                        <th>
                                            Issue Title
                                        </th>

                                        <th>
                                            Category
                                        </th>

                                        <th>
                                            Location
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th>
                                            Submitted
                                        </th>

                                        <th class="text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($complaints as $complaint)
                                        <tr>

                                            <td class="ps-4">
                                                <span class="complaint-id">
                                                    {{ $complaint->complaint_code }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="complaint-title">
                                                    {{ $complaint->issue_title }}
                                                </span>
                                            </td>

                                            <td class="text-nowrap">
                                                {{ $complaint->facility_type_name ?? '-' }}
                                            </td>

                                            <td class="text-nowrap">
                                                {{ $complaint->location_name ?? '-' }}
                                            </td>

                                            <td>
                                                @php
                                                    $status = strtolower(
                                                        str_replace(
                                                            '_',
                                                            '-',
                                                            $complaint->status
                                                        )
                                                    );
                                                @endphp

                                                <span class="status-badge
                                                    @if ($status === 'pending')
                                                        status-pending
                                                    @elseif ($status === 'assigned')
                                                        status-assigned
                                                    @elseif ($status === 'in-progress')
                                                        status-in-progress
                                                    @elseif ($status === 'resolved')
                                                        status-resolved
                                                    @elseif ($status === 'rejected')
                                                        status-rejected
                                                    @endif
                                                ">
                                                    {{ ucwords(
                                                        str_replace(
                                                            ['_', '-'],
                                                            ' ',
                                                            $complaint->status
                                                        )
                                                    ) }}
                                                </span>

                                                {{-- Feedback Indicator --}}
                                                @if ($status === 'resolved')

                                                    @if ($complaint->feedback_id)

                                                        <div class="feedback-indicator feedback-done">
                                                            <i class="bi bi-check-circle-fill"></i>
                                                            Rated
                                                        </div>

                                                    @else

                                                        <a
                                                            href="{{ route('user.complaints.detail', $complaint->complaint_id) }}"
                                                            class="feedback-indicator feedback-pending"
                                                        >
                                                            <i class="bi bi-star-fill"></i>
                                                            Rate now
                                                        </a>

                                                    @endif

                                                @endif

                                            </td>

                                            <td class="text-nowrap">
                                                {{ \Carbon\Carbon::parse($complaint->submitted_at)->format('d M Y') }}
                                            </td>

                                            <td class="text-center text-nowrap">
                                                <a href="{{ route('user.complaints.detail', $complaint->complaint_id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                    Detail
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <div class="complaint-pagination d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <small class="text-muted">
                                Showing
                                {{ $complaints->firstItem() ?? 0 }}
                                to
                                {{ $complaints->lastItem() ?? 0 }}
                                of
                                {{ $complaints->total() }}
                                complaints
                            </small>
                            {{ $complaints->links() }}
                        </div>
                    @else

                        <!-- Empty State -->
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-clipboard-x"></i>
                            </div>

                            <h5>
                                No Complaints Found
                            </h5>

                            <p>
                                You have not submitted any complaints yet.
                            </p>

                            <a href="{{ route('user.report-issue') }}"
                               class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i>
                                Submit Your First Complaint
                            </a>
                        </div>

                    @endif
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection