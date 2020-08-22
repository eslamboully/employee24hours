<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class=" nav-item">
        <a href="#"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">@lang('admin.dashboard')</span><span class="badge badge badge-warning badge-pill float-right mr-2">2</span></a>
        <ul class="menu-content">
            <li class="{{ active('') }}"><a href="{{ route('employee.home') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">الرئيسية</span></a>
            </li>
        </ul>
    </li>
    <li class=" navigation-header"><span>لوحتي الخاصة</span>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-aperture"></i>
            <span class="menu-title" data-i18n="Menu Levels">الوظائف</span>
        </a>
        <ul class="menu-content">
            <li class="{{ active('conventions') }}">
                <a href="{{ route('employee.jobs.index') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        اعلانات الوظائف
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('employee.jobs.bids.index') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        عروضي
                    </span>
                </a>
            </li>
        </ul>
    </li>
</ul>
