@extends('layouts.fsdk-user.app')

@section('title', 'Dashboard')

@section('content')

<style>
   .user-dashboard {
    min-height: 100vh;
    padding-top: 120px;
    padding-bottom: 80px;
    background-color: #08005e;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}

.dashboard-container {
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.dashboard-section {
    padding: 30px;
}

.dashboard-divider {
    border-top: 1px solid  #d9dee5;
}

.dashboard-welcome {
    background: linear-gradient(
        135deg, #ffffff, #f5f8ff
    );
}

.welcome-icon {
    width: 60px;
    height: 60px;
    min-width: 60px;
    border-radius: 14px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #eef2ff;
    color: #3351f8;

    font-size: 28px;
}

.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
}

.stat-item {
    padding: 25px 30px;
    min-height: 120px;
    display: flex;
    align-items: center;
    border-left: 1px solid #d9dee5;
}

.stat-item:first-child {
    border-left: none;
}

.stat-icon {
    width: 50px;
    height: 50px;
    min-width: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 23px;
}


.dashboard-table th {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.4px;

    color: #6c757d;
    font-weight: 600;
}

.dashboard-table td {
    padding-top: 16px;
    padding-bottom: 16px;
}


.quick-actions {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
}

.action-item {
    padding: 25px 30px;
}

.action-item + .action-item {
    border-left: 1px solid #eeeeee;
}

.action-icon {
    width: 55px;
    height: 55px;
    min-width: 55px;

    border-radius: 14px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 25px;
}

.empty-dashboard {
    padding: 40px 20px;
}

@media (max-width: 991px) {

    .dashboard-stats {
        grid-template-columns: repeat(2, 1fr);
    }

   .stat-item:nth-child(3) {
    border-left: none;
    border-top: 1px solid #d9dee5;
}

.stat-item:nth-child(4) {
    border-top: 1px solid #d9dee5;
}

}

@media (max-width: 767px) {

    .user-dashboard {
        padding-top: 100px;
    }

    .dashboard-container {
        border-radius: 16px;
    }

    .dashboard-section {
        padding: 25px 20px;
    }

    .dashboard-stats {
        grid-template-columns: 1fr;
    }

    .stat-item {
        border-left: none !important;
        border-top: 1px solid #eeeeee;
    }

    .stat-item:first-child {
        border-top: none;
    }

    .quick-actions {
        grid-template-columns: 1fr;
    }

    .action-item + .action-item {
        border-left: none;
        border-top: 1px solid #eeeeee;
    }

}
</style>

<section class="user-dashboard">
    <div class="container">
        <div class="dashboard-container">        
            <div class="dashboard-section dashboard-welcome">

                <div class="d-flex align-items-center">

                    <div class="welcome-icon me-3">
                        <i class="bi bi-person-check"></i>
                    </div>

                    <div>
                        <h2 class="fw-bold mb-1">
                            Welcome,
                            {{ session('fsdk_user_name') }}
                        </h2>
                        <p class="text-muted mb-0">
                            Welcome to your e-Maintain@FSDK dashboard.
                            Manage and monitor your facility and equipment complaints here.
                        </p>
                    </div>
                </div>
            </div>
        
            <div class="dashboard-divider">
                <div class="dashboard-stats">                
                    <div class="stat-item">
                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">
                                    Total Complaints
                                </p>
                                <h3 class="fw-bold mb-0">
                                    {{ $totalComplaints }}
                                </h3>
                            </div>

                            <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-clipboard-data"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-item">
                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">
                                    Pending
                                </p>

                                <h3 class="fw-bold mb-0">
                                    {{ $pendingComplaints }}
                                </h3>
                            </div>

                            <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                <i class="bi bi-clock-history"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-item">
                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">
                                    In Progress
                                </p>
                                <h3 class="fw-bold mb-0">
                                    {{ $inProgressComplaints }}
                                </h3>
                            </div>

                            <div class="stat-icon bg-info bg-opacity-10 text-info">
                                <i class="bi bi-tools"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">
                                    Resolved
                                </p>
                                <h3 class="fw-bold mb-0">
                                    {{ $resolvedComplaints }}
                                </h3>
                            </div>
                            <div class="stat-icon bg-success bg-opacity-10 text-success">
                                <i class="bi bi-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="dashboard-section dashboard-divider">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">
                            My Recent Complaints
                        </h4>
                        <p class="text-muted mb-0">
                            Recently submitted complaints.
                        </p>
                    </div>
                    <a href="{{ route('user.complaints') }}" class="btn btn-primary">
                        <i class="bi bi-list-check me-1"></i>
                        View All
                    </a>
                </div>

                @if ($recentComplaints->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 dashboard-table">
                            <thead>
                                <tr>
                                    <th class="px-3">Complaint Code</th>
                                    <th>Issue</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentComplaints as $complaint)
                                    <tr>
                                        <td class="px-3">
                                            <span class="fw-bold text-primary">
                                                {{ $complaint->complaint_code }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold">
                                                {{ $complaint->issue_title }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $complaint->location_name ?? '-' }}
                                        </td>
                                        <td>
                                            @if ($complaint->status == 'pending')
                                                <span class="badge bg-warning text-dark">
                                                    Pending
                                                </span>
                                            @elseif ($complaint->status == 'assigned')
                                                <span class="badge bg-info text-dark">
                                                    Assigned
                                                </span>
                                            @elseif ($complaint->status == 'in_progress')
                                                <span class="badge bg-primary">
                                                    In Progress
                                                </span>
                                            @elseif ($complaint->status == 'resolved')
                                                <span class="badge bg-success">
                                                    Resolved
                                                </span>
                                            @elseif ($complaint->status == 'rejected')
                                                <span class="badge bg-danger">
                                                    Rejected
                                                </span>
                                            @elseif ($complaint->status == 'closed')
                                                <span class="badge bg-secondary">
                                                    Closed
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    {{ ucfirst($complaint->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            {{ \Carbon\Carbon::parse($complaint->submitted_at)->format('d M Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-dashboard text-center">
                        <i class="bi bi-clipboard-x fs-1 text-muted"></i>
                        <p class="fw-semibold mb-1 mt-3">
                            No complaints available yet.
                        </p>
                        <p class="text-muted mb-3">
                            You have not submitted any complaints.
                        </p>
                        <a href="{{ route('user.report-issue') }}"
                           class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i>
                            Report an Issue
                        </a>
                    </div>
                @endif
            </div>

            <div class="dashboard-divider">
                <div class="quick-actions">
                    {{-- Report an Issue --}}
                    <div class="action-item">
                        <div class="d-flex align-items-center mb-4">
                            <div class="action-icon bg-primary bg-opacity-10 text-primary me-3">
                                <i class="bi bi-plus-circle"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1">
                                    Report an Issue
                                </h4>
                                <p class="text-muted mb-0">
                                    Found a facility or equipment problem?
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('user.report-issue') }}" class="btn btn-primary">
                            <i class="bi bi-send me-1"></i>
                            Submit Complaint
                        </a>
                    </div>

                    {{-- My Complaints --}}
                    <div class="action-item">
                        <div class="d-flex align-items-center mb-4">
                            <div class="action-icon bg-info bg-opacity-10 text-info me-3">
                                <i class="bi bi-list-check"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1">
                                    My Complaints
                                </h4>
                                <p class="text-muted mb-0">
                                    Track the progress of your complaints.
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('user.complaints') }}" class="btn btn-outline-primary">                            
                            <i class="bi bi-list-check"></i>
                            View Complaints
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection