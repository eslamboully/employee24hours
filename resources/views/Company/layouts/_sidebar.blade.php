<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class=" nav-item">
        <a href="#"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">@lang('admin.dashboard')</span><span class="badge badge badge-warning badge-pill float-right mr-2">2</span></a>
        <ul class="menu-content">
            <li class="{{ active('') }}"><a href="{{ route('company.home') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">الرئيسية</span></a>
            </li>
        </ul>
    </li>
    <li class=" navigation-header"><span>ادارة اعمال الشركة</span>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-aperture"></i>
            <span class="menu-title" data-i18n="Menu Levels">الاتفاقيات</span>
        </a>
        <ul class="menu-content">
            <li class="{{ active('conventions') }}">
                <a href="{{ route('company.conventions.index') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        الاتفاقيات
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('company.conventions.create') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        اضف اتفاقية
                    </span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#"><i class="feather icon-play-circle"></i>
            <span class="menu-title" data-i18n="Second Level">تقييم الموظفين</span>
        </a>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-users"></i>
            <span class="menu-title" data-i18n="Menu Levels">ادارة العمل</span>
        </a>
        <ul class="menu-content">
            <li>
                <a href="#">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        وظائف الشركة
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        اضف وظيفة
                    </span>
                </a>
            </li>
        </ul>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-edit"></i>
            <span class="menu-title" data-i18n="Menu Levels">ملاحظاتنا</span>
        </a>
        <ul class="menu-content">
            <li>
                <a href="#"><i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        ملاحظاتنا السابقة
                    </span>
                </a>
            </li>
            <li>
                <a href="#"><i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        ملاحظة جديدة
                    </span>
                </a>
            </li>
        </ul>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-dollar-sign"></i>
            <span class="menu-title" data-i18n="Menu Levels">القسم المالي</span>
        </a>
        <ul class="menu-content">
            <li>
                <a href="#"><i class="feather icon-trending-up"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        مستحقات الموظفين
                    </span>
                </a>
            </li>
            <li>
                <a href="#"><i class="feather icon-activity"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        تقارير المبيعات والفواتير
                    </span>
                </a>
            </li>
            <li>
                <a href="#"><i class="feather icon-activity"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        اصناف المواد
                    </span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#"><i class="feather icon-play-circle"></i>
            <span class="menu-title" data-i18n="Second Level">العهد</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#"><i class="feather icon-user"></i>
            <span class="menu-title" data-i18n="Second Level">الاعمال الموكلة</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#"><i class="feather icon-settings"></i>
            <span class="menu-title" data-i18n="Second Level">الاعدادات</span>
        </a>
    </li>
</ul>
