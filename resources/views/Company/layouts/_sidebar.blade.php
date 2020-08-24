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
            <span class="menu-title" data-i18n="Menu Levels">الشركات التابعة</span>
        </a>
        <ul class="menu-content">
            <li class="{{ active('corporations') }}">
                <a href="{{ route('company.corporations.index') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        الشركات التابعة
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('company.corporations.create') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        اضف شركة تابعة
                    </span>
                </a>
            </li>
        </ul>
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
            <li class="{{ active('job-types') }}">
                <a href="{{ route('company.job-types.index') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        اقسام الوظائف
                    </span>
                </a>
            </li>
            <li class="{{ active('jobs') }}">
                <a href="{{ route('company.jobs.index') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        وظائف الشركة
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('company.jobs.create') }}">
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
        <a href="#"><i class="feather icon-settings"></i>
            <span class="menu-title" data-i18n="Second Level">الاعدادات</span>
        </a>
    </li>

    <li class=" navigation-header"><span>ادارة اعمال استلام الطلبات</span>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-aperture"></i>
            <span class="menu-title" data-i18n="Menu Levels">المنتجات</span>
        </a>
        <ul class="menu-content">
            <li class="{{ active('products') }}">
                <a href="{{ route('company.products.index') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        المنتجات
                    </span>
                </a>
            </li>
            <li class="{{ active('recommended-products') }}">
                <a href="{{ route('company.recommended-products') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        المنتجات الموصى بها
                    </span>
                </a>
            </li>
            <li class="{{ active('block-products') }}">
                <a href="{{ route('company.block-products') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        المنتجات الغير مفعلة
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('company.products.create') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        اضف منتج
                    </span>
                </a>
            </li>
        </ul>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-book-open"></i>
            <span class="menu-title" data-i18n="Menu Levels">الوجبات</span>
        </a>
        <ul class="menu-content">
            <li class="{{ active('meals') }}">
                <a href="{{ route('company.meals.index') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        الوجبات
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('company.meals.create') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        اضف وجبة
                    </span>
                </a>
            </li>
        </ul>
    </li>
    <li class=" navigation-header"><span>الاستقبال والاستعلامات</span>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-help-circle"></i>
            <span class="menu-title" data-i18n="Menu Levels">الاسئلة الشائعة</span>
        </a>
        <ul class="menu-content">
            <li class="{{ active('questions') }}">
                <a href="{{ route('company.questions.index') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        الاسئلة
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('company.questions.create') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        اضف سؤال
                    </span>
                </a>
            </li>
        </ul>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-command"></i>
            <span class="menu-title" data-i18n="Menu Levels">الخدمات</span>
        </a>
        <ul class="menu-content">
            <li class="{{ active('service-categories') }}">
                <a href="{{ route('company.service-categories.index') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        الاقسام
                    </span>
                </a>
            </li>
            <li class="{{ active('services') }}">
                <a href="{{ route('company.services.index') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        الخدمات
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('company.services.create') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        اضف خدمة
                    </span>
                </a>
            </li>
        </ul>
    </li>

    <li class=" navigation-header"><span>موظف اداري او فني</span>
    </li>
    <li class=" nav-item">
        <a href="#"><i class="feather icon-help-circle"></i>
            <span class="menu-title" data-i18n="Menu Levels">المهام</span>
        </a>
        <ul class="menu-content">
            <li class="{{ active('questions') }}">
                <a href="{{ route('company.questions.index') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        جدول المهام
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('company.questions.create') }}">
                    <i class="feather icon-circle"></i>
                    <span class="menu-item" data-i18n="Second Level">
                        اضف مهمة
                    </span>
                </a>
            </li>
        </ul>
    </li>
</ul>
