<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <span class="text-white fw-bold">
                    e-Maintain@FSDK
                </span>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>

                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>

            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>


    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-eye"></i>
                    </span>
                    <h4 class="text-section">
                        Overview
                    </h4>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-tasks"></i>
                    </span>
                    <h4 class="text-section">
                        Complaint Management
                    </h4>
                </li>
                
                <li class="nav-item {{ request()->routeIs('admin.complaints*') ? 'active' : '' }}">
                    <a href="{{ route('admin.complaints') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>
                            Complaints
                        </p>
                    </a>
                </li>
                
                <li class="nav-item {{ request()->routeIs('admin.assignments*') ? 'active' : '' }}">
                    <a href="{{ route('admin.assignments') }}">
                        <i class="fas fa-tasks"></i>
                        <p>
                            Assignments
                        </p>
                    </a>
                </li>
                
                <li class="nav-item {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                    <a href="{{ route('admin.reports') }}">
                        <i class="fas fa-chart-bar"></i>
                        <p>
                            Reports
                        </p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-database"></i>
                    </span>
                    <h4 class="text-section">
                        Master Data
                    </h4>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.locations*') ? 'active' : '' }}">
                    <a href="{{ route('admin.locations') }}">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>
                            Locations
                        </p>
                    </a>
                </li>
                
                <li class="nav-item {{ request()->routeIs('admin.facility.types*') ? 'active' : '' }}">
                    <a href="{{ route('admin.facility.types') }}">
                        <i class="fas fa-building"></i>
                        <p>
                            Facility Types
                        </p>
                    </a>
                </li>                
                <li class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users') }}">
                        <i class="fas fa-users"></i>
                        <p>
                            User Management
                        </p>
                    </a>
                </li>                        
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->