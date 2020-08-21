<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class=" nav-item">
        <a href="#"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">@lang('admin.dashboard')</span><span class="badge badge badge-warning badge-pill float-right mr-2">2</span></a>
        <ul class="menu-content">
            <li class="{{ active('') }}"><a href="{{ route('admin.home') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">@lang('admin.analytics')</span></a>
            </li>
            @if(im('admin')->hasPermissionTo("read_languages"))
                <li class="{{ active('languages') }}"><a href="{{ route('admin.languages.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">اللغات</span></a>
                </li>
            @endif
        </ul>
    </li>
    <li class=" navigation-header"><span>ادارة المنصة</span>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-aperture"></i>
            <span class="menu-title" data-i18n="Menu Levels">المشرفين</span>
        </a>
        <ul class="menu-content">
            @if(im('admin')->hasPermissionTo("read_admins"))
                <li class="{{ active('admins') }}">
                    <a href="{{ route('admin.admins.index') }}">
                        <i class="feather icon-circle"></i>
                        <span class="menu-item" data-i18n="Second Level">
                            المشرفين
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    </li>

    <li class=" nav-item">
        <a href="#"><i class="feather icon-aperture"></i>
            <span class="menu-title" data-i18n="Menu Levels">الشركات والمؤسسات</span>
        </a>
        <ul class="menu-content">
            @if(im('admin')->hasPermissionTo("read_companies"))
                <li class="{{ active('companies') }}">
                    <a href="{{ route('admin.companies.index') }}">
                        <i class="feather icon-circle"></i>
                        <span class="menu-item" data-i18n="Second Level">
                            الشركات والمؤسسات
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-cloud"></i>
            <span class="menu-title" data-i18n="Menu Levels">باقات الوظائف</span>
        </a>
        <ul class="menu-content">
            @if(im('admin')->hasPermissionTo("read_plans"))
                <li class="{{ active('plans') }}">
                    <a href="{{ route('admin.plans.index') }}">
                        <i class="feather icon-circle"></i>
                        <span class="menu-item" data-i18n="Second Level">
                            باقات الوظائف
                        </span>
                    </a>
                </li>
            @endif
            @if(im('admin')->hasPermissionTo("create_plans"))
                <li>
                    <a href="{{ route('admin.plans.create') }}">
                        <i class="feather icon-circle"></i>
                        <span class="menu-item" data-i18n="Second Level">
                            اضف جديد
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-users"></i>
            <span class="menu-title" data-i18n="Menu Levels">ادارة الموظفين</span>
        </a>
        <ul class="menu-content">
            @if(im('admin')->hasPermissionTo("create_employees"))
            <li class="{{ active('employees') }}">
                <a href="{{ route('admin.employees.index') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        الموظفين
                    </span>
                </a>
            </li>
            @endif
        </ul>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-dollar-sign"></i>
            <span class="menu-title" data-i18n="Menu Levels">القسم المالي والتقارير</span>
        </a>
        <ul class="menu-content">
            <li>
                <a href="#"><i class="feather icon-trending-up"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        تقارير الارباح
                    </span>
                </a>
            </li>
            <li>
                <a href="#"><i class="feather icon-activity"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        تقارير الرواتب
                    </span>
                </a>
            </li>
            <li>
                <a href="#"><i class="feather icon-airplay"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        تقارير الايداع
                    </span>
                </a>
            </li>
            <li>
                <a href="#"><i class="feather icon-trending-down"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        تقارير المرتجع
                    </span>
                </a>
            </li>
        </ul>
    </li>
    @if(im('admin')->hasPermissionTo("read_support-systems"))
        <li class="nav-item {{ active('support-systems') }}">
            <a href="{{ route('admin.support-systems.index') }}"><i class="feather icon-play-circle"></i>
                <span class="menu-title" data-i18n="Second Level">الانظمة الداعمة</span>
            </a>
        </li>
    @endif
    @if(im('admin')->hasPermissionTo("read_departments"))
        <li class="nav-item {{ active('departments') }}">
            <a href="{{ route('admin.departments.index') }}"><i class="feather icon-shopping-cart"></i>
                <span class="menu-title" data-i18n="Second Level">اقسام المنتجات</span>
            </a>
        </li>
    @endif
    <li class=" navigation-header"><span>الوظائف والاعضاء</span>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-code"></i>
            <span class="menu-title" data-i18n="Menu Levels">ادارة الوظائف</span>
        </a>
        <ul class="menu-content">
            <li>
                <a href="{{ route('admin.jobs.index') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        كل الوظائف
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.jobs.index') }}?status=0">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        الوظائف الجديدة
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.jobs.index') }}?status=1">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        وظائف قيد العمل
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.jobs.index') }}?status=2">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        وظائف ملغية
                    </span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#"><i class="feather icon-shopping-bag"></i>
            <span class="menu-title" data-i18n="Second Level">اقسام الاعمال</span>
        </a>
    </li>
    @if(im('admin')->hasPermissionTo("read_blacklist"))
        <li class="nav-item {{ active('blacklist') }}">
            <a href="{{ route('admin.blacklist') }}"><i class="feather icon-lock"></i>
                <span class="menu-title" data-i18n="Second Level">القائمة السوداء</span>
            </a>
        </li>
    @endif
    @if(im('admin')->hasPermissionTo("read_agreements"))
        <li class="nav-item {{ active('agreements') }}">
            <a href="{{ route('admin.agreements.index') }}"><i class="feather icon-code"></i>
                <span class="menu-title" data-i18n="Second Level">اعداد بند الاتفاقيات</span>
            </a>
        </li>
    @endif
    @if(im('admin')->hasPermissionTo("read_skills"))
        <li class="nav-item {{ active('skills') }}">
            <a href="{{ route('admin.skills.index') }}"><i class="feather icon-code"></i>
                <span class="menu-title" data-i18n="Second Level">اعداد المهارات</span>
            </a>
        </li>
    @endif
    <li class=" navigation-header"><span>التواصل واعدادات المنصة</span>
    </li>
    @if(im('admin')->hasPermissionTo("read_contact-us"))
        <li class="nav-item {{ active('contact-us') }}">
            <a href="{{ route('admin.contact-us') }}"><i class="feather icon-phone-call"></i>
                <span class="menu-title" data-i18n="Second Level">الدعم الفني والتواصل</span>
            </a>
        </li>
    @endif
    @if(im('admin')->hasPermissionTo("read_settings"))
        <li class="nav-item">
            <a href="#"><i class="feather icon-settings"></i>
                <span class="menu-title" data-i18n="Second Level">الاعدادات</span>
            </a>
        </li>
    @endif
</ul>
