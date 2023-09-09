<div class="navbar">
    <div class="navbar-header">
        <div class="navbar-toggle sidebar-toggle-btn nav-btn">
            <div class="icon">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
        <div class="navbar-brand">
            <a href="@{BASE_URL}">
                <i class="material-icons">receipt</i>
                <span>@{SITE_NAME}</span>
            </a>
        </div>
        <div class="navbar-toggle search nav-btn">
            <i class="material-icons">search</i>
        </div>
    </div>
    <div class="navbar-content">
        <div class="sidebar-toggle-btn nav-btn">
            <div class="icon changed">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
        <div class="spacer"></div>
        <div class="nav-btn dropdown">
            <i class="material-icons">person</i>
            <div class="dropdown-menu" id="menu1">
                <a class="dropdown-item" href="#"><i class="material-icons">person</i><span>@lang(profile)</span></a>
                <a class="dropdown-item" href="@{BASE_URL}settings"><i class="material-icons">settings</i><span>@lang(settings)</span></a>
                <div class="dropdown-devider"></div>
                <a class="dropdown-item" href="#"><i class="material-icons">power_settings_new</i><span>@lang(logout)</span></a>
            </div>
        </div>
    </div>
</div>