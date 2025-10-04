<!-- Menu -->
@php
use Spatie\Menu\Link;
@endphp
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
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-layout"></i>
                    <div data-i18n="Administration">Administration</div>
                </a>
                <ul class="menu-sub">
                    @if(Auth::user()->can('user-list'))
                    <li class="menu-item">
                        <a href="{{ route('user.register') }}" class="menu-link">
                            <div data-i18n="User Management">User Management</div>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->can('role-list'))
                    <li class="menu-item">
                        <a href="{{ route('role.register') }}" class="menu-link">
                            <div data-i18n="Roles & Permissions">Roles & Permissions</div>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->can('branch-list'))
                    <li class="menu-item">
                        <a href="{{ route('branch.register') }}" class="menu-link">
                            <div data-i18n="Branch Management">Branch Management</div>
                        </a>
                    </li>
                    @endif
                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
                            <div data-i18n="Project Management">Project Management</div>
                        </a>
                        <ul class="menu-sub">
                            @if(Auth::user()->can('project-list'))
                            <li class="menu-item">
                                <a href="{{ route('project.register') }}" class="menu-link">
                                    <div data-i18n="Project Register">Project Register</div>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('director-list'))
                            <li class="menu-item">
                                <a href="{{ route('director.register') }}" class="menu-link">
                                    <div data-i18n="Director Register">Director Register</div>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('project-director-list'))
                            <li class="menu-item">
                                <a href="{{ route('project.director.register') }}" class="menu-link">
                                    <div data-i18n="Project Director Register">Project Director Register</div>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-rupee"></i>
                    <div data-i18n="Accounts">Accounts</div>
                </a>
                <ul class="menu-sub">
                    @if(Auth::user()->can('head-list'))
                    <li class="menu-item">
                        <a href="{{ route('head.register') }}" class="menu-link">
                            <div data-i18n="Heads">Heads</div>
                        </a>
                    </li>
                    @endif
                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
                            <div data-i18n="Income & Expense">Income & Expense</div>
                        </a>
                        <ul class="menu-sub">
                            @if(Auth::user()->can('income-expense-list'))
                            <li class="menu-item">
                                <a href="{{ route('ie.register', 'Income') }}" class="menu-link">
                                    <div data-i18n="Income">Income</div>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('income-expense-list'))
                            <li class="menu-item">
                                <a href="{{ route('ie.register', 'Expense') }}" class="menu-link">
                                    <div data-i18n="Expense">Expense</div>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('bank-transfer-list'))
                            <li class="menu-item">
                                <a href="{{ route('btransfer.register') }}" class="menu-link">
                                    <div data-i18n="Bank Transfer">Bank Transfer</div>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-package"></i>
                    <div data-i18n="Product">Product</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons fa fa-prescription'></i>
                    <div data-i18n="Pharmacy">Pharmacy</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bx-file'></i>
                    <div data-i18n="Reports">Reports</div>
                </a>
                {{
                    Menu::new()->addClass('menu-sub')
                    ->linkIfCan('login-log', route('user.login.log'), '<i class="menu-icon tf-icons bx bx-file"></i> Login Log')->addItemClass('menu-link')->addItemParentClass('menu-item');
                }}
            </li>
        </ul>
    </div>
</aside>
<!-- / Menu -->