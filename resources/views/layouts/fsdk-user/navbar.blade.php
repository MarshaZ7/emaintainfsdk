<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <!-- Logo -->
        <a href="{{ route('user.dashboard') }}" class="logo d-flex align-items-center">
            <h1 class="sitename">e-Maintain@FSDK</h1>
        </a>

        <!-- Navigation -->
        <nav id="navmenu" class="navmenu">
            <ul>
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('user.dashboard') }}"
                       class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                </li>

                <!-- My Complaints -->
                <li>
                    <a href="{{ route('user.complaints') }}"
                       class="{{ request()->routeIs('user.complaints*') ? 'active' : '' }}">
                        My Complaints
                    </a>
                </li>

                <!-- Report Issue -->
                <li>
                    <a href="{{ route('user.report-issue') }}"
                       class="{{ request()->routeIs('user.report-issue') ? 'active' : '' }}">
                        Report Issue
                    </a>
                </li>

                <!-- FAQ -->
                <li>
                    <a href="{{ route('user.faqlogin') }}"
                       class="{{ request()->routeIs('user.faqlogin') ? 'active' : '' }}">
                        FAQ
                    </a>
                </li>

                <!-- Profile Dropdown -->
                <li class="dropdown profile-menu">
                    <a href="#" class="profile-toggle">
                        <i class="bi bi-person-circle me-1"></i>
                        <span>{{ session('fsdk_user_name') }}</span>
                        <i class="bi bi-chevron-down ms-1"></i>
                    </a>

                    <ul class="profile-dropdown">
                        <!-- Profile Header -->
                        <li class="profile-header">
                            <div class="profile-icon">
                                <i class="bi bi-person"></i>
                            </div>

                            <div class="profile-info">
                                <strong>{{ session('fsdk_user_name') }}</strong>
                                <small>{{ session('fsdk_user_role') }}</small>
                            </div>
                        </li>

                        <li class="dropdown-divider"></li>

                        <!-- My Profile -->
                        <li>
                            <a href="{{ route('user.profile') }}" class="profile-item">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>

                        <!-- Logout -->
                        <li>
                            <form action="{{ route('user.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="profile-item logout-item">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Mobile Navigation -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>

<style>
.profile-menu {
    position: relative;
}

#header .navmenu .profile-menu > .profile-dropdown {
    left: auto !important;
    right: 0 !important;
    min-width: 230px;
    padding: 8px;
    margin: 0;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.profile-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
}

.profile-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border-radius: 50%;
    background: #eef2ff;
    color: #3351f8;
    font-size: 20px;
}

.profile-info {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.profile-info strong {
    color: #212529;
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 150px;
}

.profile-info small {
    color: #6c757d;
    font-size: 12px;
    margin-top: 2px;
}

.profile-dropdown .dropdown-divider {
    margin: 6px 4px;
    border-top: 1px solid #eee;
}

.profile-item {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 8px;
    color: #343a40;
    background: transparent;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.2s ease;
}

.profile-item i {
    width: 20px;
    font-size: 16px;
    text-align: center;
}

.profile-item:hover {
    background: #f1f4ff;
    color: #3351f8;
}

.profile-menu form {
    margin: 0;
}

.profile-menu .logout-item {
    border: none;
    cursor: pointer;
    text-align: left;
    font-family: inherit;
}

.profile-menu .logout-item:hover {
    background: #fff1f1;
    color: #dc3545;
}
</style>