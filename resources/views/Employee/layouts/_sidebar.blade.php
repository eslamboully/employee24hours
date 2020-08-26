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
            <li class="{{ active('jobs') }}">
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
    <li class="{{ active('related-companies') }}">
        <a href="{{ route('employee.related-companies.index') }}">
            <i class="feather icon-airplay"></i>
            <span class="menu-item" data-i18n="Second Level">
                الشركات التي اعمل بها
            </span>
        </a>
    </li>
    <li class="{{ active('related-helper') }}">
        <a href="{{ route('employee.jobs.index') }}">
            <i class="feather icon-book"></i>
            <span class="menu-item" data-i18n="Second Level">
                اعمالي الموكلة
            </span>
        </a>
    </li>
    <li class="{{ active('tasks') }}">
        <a href="{{ route('employee.tasks.index') }}">
            <i class="feather icon-x-circle"></i>
            <span class="menu-item" data-i18n="Second Level">
                تاسكات الشركات
            </span>
        </a>
    </li>
</ul>
