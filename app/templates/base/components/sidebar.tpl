<div class="sidebar">
    <div class="sidebar-scroll">
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a href="@{BASE_URL}" class="nav-link">
                    <i class="material-icons">home</i>
                    <span class="nav-link-title">@lang(dashboard)</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="@{BASE_URL}users" class="nav-link">
                    <i class="material-icons">person_pin</i>
                    <span class="nav-link-title">@lang(users)</span>
                </a>
            </li>
            <li class="nav-item has-menu">
                <a href="javascript:void()" class="nav-link">
                    <i class="material-icons">announcement</i>
                    <span class="nav-link-title">@lang(roles_and_permissions)</span>
                    <i class="material-icons arrow">chevron_right</i>
                </a>
                <ul class="menu show">
                    <li class="menu-item">
                        <a class="menu-link" href="/admin/roles">
                            <span class="site-menu-title">@lang(roles)</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="/admin/roles">
                            <span class="site-menu-title">@lang(permissions)</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="@{BASE_URL}categories" class="nav-link">
                    <i class="material-icons">label</i>
                    <span class="nav-link-title">@lang(categories)</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="@{BASE_URL}listings" class="nav-link">
                    <i class="material-icons">description</i>
                    <span class="nav-link-title">@lang(ads)</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="material-icons">tv</i>
                    <span class="nav-link-title">@lang(control_panel)</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="@{BASE_URL}settings" class="nav-link">
                    <i class="material-icons">settings</i>
                    <span class="nav-link-title">@lang(settings)</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-footer">
        <a href="@{BASE_URL}settings" class="footer-link">
            <i class="material-icons">settings</i>
        </a>
        <a href="" class="footer-link">
            <i class="material-icons">person</i>
        </a>
        <a href="" class="footer-link">
            <i class="material-icons">power_settings_new</i>
        </a>
    </div>
</div>