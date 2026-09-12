<!-- Sidebar -->
<div class="sidebar-wrapper" id="sidebar">
    <!-- Brand -->
    <a href="{{ route('technician.dashboard') }}"
        class="sidebar-brand">
        <i class="bi bi-tools"></i>
        <span>
            e-Maintain@FSDK
        </span>
    </a>

    <!-- Navigation -->
    <div class="flex-grow-1 overflow-y-auto">
        <!-- Menu -->
        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">
                Menu
            </div>
            <ul class="sidebar-menu-list">
                <!-- Dashboard -->
                <li class="sidebar-menu-item">
                    <a href="{{ route('technician.dashboard') }}"
                        class="sidebar-menu-link {{ request()->routeIs('technician.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-fill"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Maintenance -->
        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">
                Maintenance
            </div>
            <ul class="sidebar-menu-list">

                <!-- Assignments -->
                <li class="sidebar-menu-item">
                    <a href="{{ route('technician.assignments') }}"
                        class="sidebar-menu-link {{ request()->routeIs('technician.assignments*') ? 'active' : '' }}">
                        <i class="bi bi-clipboard-check"></i>
                        <span>
                            Assignments
                        </span>
                    </a>
                </li>


                <!-- Maintenance Records -->
                <li class="sidebar-menu-item">
                    <a href="{{ route('technician.maintenance.records') }}"
                        class="sidebar-menu-link {{ request()->routeIs('technician.maintenance.records*') ? 'active' : '' }}">
                        <i class="bi bi-journal-text"></i>
                        <span>
                            Maintenance Records
                        </span>
                    </a>
                </li>


                <!-- Reports -->
                <li class="sidebar-menu-item">
                    <a href="{{ route('technician.reports') }}"
                        class="sidebar-menu-link {{ request()->routeIs('technician.reports*') ? 'active' : '' }}">
                        <i class="bi bi-bar-chart-line"></i>
                        <span>
                            Reports
                        </span>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>
<!-- End Sidebar -->