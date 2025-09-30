<!-- Menu -->
<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner">
            <!-- Dashboards -->
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Dashboards">Dashboards</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-pie-chart-alt-2"></i>
                            <div data-i18n="Analytics">Analytics</div>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Layouts -->
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-layout"></i>
                    <div data-i18n="Administration">Administration</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('user.register') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="User Management">User Management</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('role.register') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user-minus"></i>
                            <div data-i18n="Roles & Permissions">Roles & Permissions</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('branch.register') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-git-branch"></i>
                            <div data-i18n="Branch Management">Branch Management</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('user.login.log') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div data-i18n="Login Log">Login Log</div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
<!-- / Menu -->