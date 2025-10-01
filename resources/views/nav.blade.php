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
                {{
                    Menu::new()->addClass('menu-sub')
                    ->linkIfCan('user-list', route('user.register'), '<i class="menu-icon tf-icons bx bx-user"></i> User Management')->addItemClass('menu-link')->addItemParentClass('menu-item')
                    ->linkIfCan('role-list', route('role.register'), '<i class="menu-icon tf-icons bx bx-user-minus"></i> Roles & Permissions')->addItemClass('menu-link')->addItemParentClass('menu-item')
                    ->linkIfCan('branch-list', route('branch.register'), '<i class="menu-icon tf-icons bx bx-git-branch"></i> Branch Management')->addItemClass('menu-link')->addItemParentClass('menu-item')
                    ->linkIfCan('login-log', route('user.login.log'), '<i class="menu-icon tf-icons bx bx-file"></i> Login Log')->addItemClass('menu-link')->addItemParentClass('menu-item');
                }}
            </li>
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-rupee"></i>
                    <div data-i18n="Accounts">Accounts</div>
                </a>
                {{
                    Menu::new()->addClass('menu-sub')
                    ->add(Menu::submenu(Link::to('#', 'Heads')->addClass('menu-link menu-toggle')->addParentClass('menu-item'), Menu::new()
                    ->addClass('menu-sub')->linkIfCan('user-list', route('user.register'), 'User Management')->addItemClass('menu-link')->addItemParentClass('menu-item')
                    ->linkIfCan('user-list', route('user.register'), 'User Management')->addItemClass('menu-link')->addItemParentClass('menu-item'))->addItemParentClass('menu-item'))->addItemParentClass('menu-item')
                    
                }}
                {{
                    Menu::new()->addClass('menu-sub')
                    ->add(
                    Menu::submenu(Link::to('#', 'Heads')->addClass('menu-link menu-toggle')->addParentClass('menu-item'), Menu::new()->addClass('menu-sub')
                        ->linkIfCan('user-list', route('user.register'), 'User Management')->addItemClass('menu-link')->addItemParentClass('menu-item')
                        ->linkIfCan('user-list', route('user.register'), 'User Management')->addItemClass('menu-link')->addItemParentClass('menu-item')
                        ->linkIfCan('user-list', route('user.register'), 'User Management')->addItemClass('menu-link')->addItemParentClass('menu-item')
                    )->addItemParentClass('menu-item'))->addItemParentClass('menu-item')
                    
                }}
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
        </ul>
    </div>
</aside>
<!-- / Menu -->