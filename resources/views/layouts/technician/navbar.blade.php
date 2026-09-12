<!-- Navbar -->
<header class="navbar-custom">
    <!-- Left -->
    <div class="navbar-left">
        <!-- Desktop Sidebar Toggle -->
        <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
            id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">
            <i class="bi bi-chevron-bar-left"></i>

        </button>

        <!-- Mobile Sidebar Toggle -->
        <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
            <i class="bi bi-list"></i>
        </button>

        <!-- Page Name -->
        <div class="d-none d-md-block">
            <span class="fw-semibold">
                Technician Panel
            </span>

        </div>

    </div>


    <!-- Search -->
    <div class="navbar-search-wrapper">
        <input type="text" class="navbar-search-input" placeholder="Search assignments..." id="main-search">
        <button class="navbar-search-btn" aria-label="Search">
            <i class="bi bi-search"></i>
        </button>
    </div>


    <!-- Right -->
    <div class="navbar-actions">
        <!-- Notification -->
        <div class="dropdown">
            <button class="navbar-action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false" id="btn-notifications">
                <i class="bi bi-bell"></i>
                <span class="navbar-action-badge"></span>
            </button>

            <div class="dropdown-menu dropdown-menu-end dropdown-menu-notification p-0">
                <div class="notification-header">
                    <h6 class="notification-title">
                        Notifications
                    </h6>

                    <button class="btn-clear-all" type="button">
                        Mark all read
                    </button>
                </div>

                <div class="notification-list">
                    <!-- Assignment Notification -->
                    <a href="#" class="notification-item">
                        <div class="notification-icon bg-primary text-white">
                            <i class="bi bi-clipboard-check"></i>
                        </div>
                        <div class="notification-content">
                            <p class="notification-text">
                                New maintenance assignment received.
                            </p>
                            <span class="notification-time">
                                Just now
                            </span>
                        </div>
                        <span class="notification-unread-dot"></span>
                    </a>

                    <!-- Maintenance Notification -->
                    <a href="#" class="notification-item">
                        <div class="notification-icon bg-warning text-dark">
                            <i class="bi bi-wrench"></i>
                        </div>
                        <div class="notification-content">
                            <p class="notification-text">
                                Maintenance task requires attention.
                            </p>
                            <span class="notification-time">
                                1 hour ago
                            </span>
                        </div>
                    </a>
                </div>
                <a href="#" class="notification-footer">
                    View All Notifications
                </a>
            </div>
        </div>

        <!-- Profile -->
        <div class="dropdown ms-2">

            <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false" id="profile-dropdown">
                <img src="{{ asset('tech-template/assets/images/avatar.png') }}" alt="Profile Image"
                    class="navbar-profile-img">
                <span class="navbar-profile-name d-none d-md-inline">
                    Technician
                </span>
                <i class="bi bi-chevron-down navbar-profile-caret"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile">
                <li class="dropdown-header">
                    Welcome!
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-person"></i>
                        My Account
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-gear"></i>
                        Settings
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                   <form action="{{ route('technician.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
<!-- End Navbar -->