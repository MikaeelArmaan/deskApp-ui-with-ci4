<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
            <img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div
            class="sidebar-menu icon-style-{{ !isset($this->sesstion['sitesetting']) ? env('menu_icon') : $this->sesstion['sitesetting']->menu_icon }} icon-list-style-{{ !isset($this->sesstion['sitesetting']) ? env('menu_icon_list') : $this->sesstion['sitesetting']->menu_icon_list }}">
            <ul id="accordion-menu" class="">
                <!-- Nav Item - Dashboard -->
                <li>
                    <a href="{{ route_to('dashboard.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-calendar1"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <!-- Heading -->
                <li>
                    <div class="sidebar-small-cap">Main Menu</div>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-group"></span><span class="mtext">Account</span>
                    </a>
                    <ul class="submenu">
                        @if (defender()->canDo('account.users.index'))
                            <li><a class="collapse-item" href="{{ route_to('users.index') }}">
                                    Users</a></li>
                        @endif
                    </ul>
                </li>

                <!-- Access -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-lock"></span><span class="mtext">Access</span>
                    </a>
                    <ul class="submenu">
                        @if (defender()->canDo('access.roles.index'))
                            <li><a class="collapse-item" href="{{ route_to('roles.index') }}">Roles</a></li>
                        @endif
                        @if (defender()->canDo('access.permissions.index'))
                            <li><a class="collapse-item" href="{{ route_to('permissions.index') }}">Permissions</a></li>
                        @endif
                    </ul>
                </li>

                <!-- System -->
                @if (defender()->canDo('system.activity.index'))
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-settings2"></span><span class="mtext">System</span>
                        </a>
                        <ul class="submenu">

                            <li><a class="collapse-item" href="{{ route_to('activity.index') }}">User Activity</a></li>

                        </ul>
                    </li>
                @endif
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <!-- Modules -->
                <li>
                    <div class="sidebar-small-cap">Modules</div>
                </li>
                @if (defender()->canDo('orders.activity.index'))
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-shopping-cart micon"></span><span class="mtext">Orders</span>
                        </a>
                        <ul class="submenu">
                            <li><a class="collapse-item" href="{{ route_to('orders.index') }}">Orders List</a></li>

                        </ul>
                    </li>
                @endif
                @if (defender()->canDo('products.activity.index'))
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-product-hunt micon"></span><span class="mtext">Products</span>
                        </a>
                        <ul class="submenu">
                            <li><a class="collapse-item" href="{{ route_to('products.index') }}">Products List</a></li>

                        </ul>
                    </li>
                @endif
                @if (defender()->canDo('address.activity.index'))
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-map-marker micon"></span><span class="mtext">Address</span>
                        </a>
                        <ul class="submenu">
                            <li><a class="collapse-item" href="{{ route_to('address.index') }}">Address List</a></li>

                        </ul>
                    </li>
                @endif
                @if (defender()->canDo('brands.activity.index'))
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon fa fa-bitcoin"></span><span class="mtext">Brands</span>
                        </a>
                        <ul class="submenu">
                            <li><a class="collapse-item" href="{{ route_to('brands.index') }}">Brands List</a></li>

                        </ul>
                    </li>
                @endif
                @if (defender()->canDo('categories.activity.index'))
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon fa fa-list-ol"></span><span class="mtext">Categories</span>
                        </a>
                        <ul class="submenu">
                            <li><a class="collapse-item" href="{{ route_to('categories.index') }}">Categories List</a>
                            </li>

                        </ul>
                    </li>
                @endif
                @if (defender()->canDo('company.activity.index'))
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon fa fa-industry"></span><span class="mtext">Company</span>
                        </a>
                        <ul class="submenu">
                            <li><a class="collapse-item" href="{{ route_to('company.index') }}">Company List</a></li>

                        </ul>
                    </li>
                @endif
                @if (defender()->canDo('customers.activity.index'))
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon fa fa-group"></span><span class="mtext">Customers</span>
                        </a>
                        <ul class="submenu">
                            <li><a class="collapse-item" href="{{ route_to('customers.index') }}">Customer List</a>
                            </li>

                        </ul>
                    </li>
                @endif
                @if (defender()->canDo('sitesettings.activity.index'))
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon fa fa-cogs"></span><span class="mtext">Site Setting</span>
                        </a>
                        <ul class="submenu">
                            <li><a class="collapse-item" href="{{ route_to('sitesettings.index') }}">Site Setting
                                    List</a>
                            </li>

                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
