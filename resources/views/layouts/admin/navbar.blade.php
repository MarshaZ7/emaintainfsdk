<!-- Main Header -->
<div class="main-header">

    <!-- Logo Header -->
    <div class="main-header-logo">

        <div class="logo-header" data-background-color="dark">

            <a href="{{ route('admin.dashboard') }}" class="logo">

                <span class="text-white fw-bold">
                    E-Maintain@FSDK
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

    </div>
    <!-- End Logo Header -->


    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">        
            <!-- Right Navbar -->
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <!-- Mobile Search -->
                <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                        href="#" role="button" aria-expanded="false">
                        <i class="fa fa-search"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-search animated fadeIn">
                        <form class="navbar-left navbar-form nav-search">
                            <div class="input-group">
                                <input type="text" placeholder="Search..." class="form-control"/>
                            </div>
                        </form>
                    </ul>
                </li>

                <!-- Notification -->
                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#"
                        id="notificationDropdown" role="button" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notificationDropdown">
                        <li>
                            <div class="dropdown-title">
                                Notifications
                            </div>
                        </li>

                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    <a href="#">
                                        <div class="notif-icon notif-primary">
                                            <i class="fa fa-info"></i>
                                        </div>
                                        <div class="notif-content">
                                            <span class="block">
                                                No new notifications
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Profile -->
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown"
                        href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ asset('admin-template/assets/img/profile.jpg') }}" alt="Profile"
                                class="avatar-img rounded-circle"/>
                        </div>
                        <span class="profile-username">
                            <span class="op-7">
                                Hi,
                            </span>
                            <span class="navbar-profile-name">
                                {{ session('admin_name') }}
                            </span>
                        </span>
                    </a>

                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img src="{{ asset('admin-template/assets/img/profile.jpg') }}"
                                            alt="Profile" class="avatar-img rounded"/>
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ session('admin_name') }}</h4>
                                        <p class="text-muted mb-0">{{ session('admin_role') }}</p>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="dropdown-divider"></div>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('admin.settings') }}">
                                    <i class="fas fa-cog me-2"></i>
                                    Account Settings
                                </a>
                            </li>

                            <li>
                                <div class="dropdown-divider"></div>
                            </li>

                            <li>
                                <form action="{{ route('admin.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
<!-- End Main Header -->