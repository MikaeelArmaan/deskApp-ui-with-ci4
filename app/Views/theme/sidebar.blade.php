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
        <div class="sidebar-menu">
            <ul id="accordion-menu">
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
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-settings2"></span><span class="mtext">System</span>
                    </a>
                    <ul class="submenu">
                        @if (defender()->canDo('system.activity.index'))
                            <li><a class="collapse-item" href="{{ route_to('activity.index') }}">User Activity</a></li>
                        @endif
                    </ul>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>