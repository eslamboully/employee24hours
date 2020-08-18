@extends('Employee.layouts.app')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">اعدادات الملف الشخصي</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('employee.home') }}">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item active"> الملف الشخصي
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- account setting page start -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                        <i class="feather icon-globe mr-50 font-medium-3"></i>
                                        الرئيسية
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                        <i class="feather icon-lock mr-50 font-medium-3"></i>
                                        تغيير كلمة المرور
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                                        <i class="feather icon-info mr-50 font-medium-3"></i>
                                        معلومات اضافية
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                                <form action="{{ route('employee.profile_post') }}" method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <div class="media">
                                                        <a href="javascript: void(0);">
                                                            <img src="{{ url('uploads/employees/avatar/'.auth('employee')->user()->photo) }}" class="rounded mr-75" alt="profile image" height="64" width="64">
                                                        </a>
                                                        <div class="media-body mt-75">
                                                            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                                <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload">صورة جديدة</label>
                                                                <input type="file" name="photo" id="account-upload" hidden>
                                                                <button class="btn btn-sm btn-outline-warning ml-50">اعادة</button>
                                                            </div>
                                                            <p class="text-muted ml-75 mt-50"><small>Allowed JPG or PNG. Max
                                                                    size of
                                                                    800kB</small></p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-username">الاسم</label>
                                                                    <input type="text" class="form-control" name="name" id="account-username" placeholder="اسم الموظف" value="{{ auth('employee')->user()->name }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-e-mail">البريد الالكتروني</label>
                                                                    <input type="email" class="form-control" name="email" id="account-e-mail" placeholder="البريد الالكتروني للشركة" value="{{ auth('employee')->user()->email }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="account-employee">حالة الحساب</label>
                                                                <input type="text" class="form-control" id="account-employee" disabled placeholder="{{ auth('employee')->user()->block == 0 ? 'مفعل' : 'غير مفعل' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">تحديث الملف الشخصي</button>
                                                            <a href="{{ route('employee.home') }}" class="btn btn-outline-warning">عوده</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                                <form action="{{ route('employee.profile_post') }}" method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-new-password">كلمة المرور الجديدة</label>
                                                                    <input type="password" name="password" class="form-control" placeholder="كلمة المرور الجديدة" minlength="6">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-retype-new-password">اعادة كتابة كلمة المرور</label>
                                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="اعادة كتابة كلمة المرور" minlength="6">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">تحديث الملف الشخصي</button>
                                                            <a href="{{ route('employee.home') }}" class="btn btn-outline-warning">عوده</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                                <form action="{{ route('employee.profile_post') }}" method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="accountTextarea">نبذه عن الموظف مع بيانات تحويل الراتب</label>
                                                                <textarea class="form-control" id="accountTextarea" name="bio" rows="3" placeholder="معلومات اضافية عن الموظف">{{ auth('employee')->user()->bio }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-birth-date">اللغات المتحدث بها</label>
                                                                    <select name="languages[]" id="" class="form-control select2" multiple="multiple">
                                                                        @foreach(getLanguages() as $language)
                                                                            <option
                                                                                {{ in_array($language,auth('employee')->user()->languages()) ? 'selected' : '' }}
                                                                                value="{{ $language }}">{{ $language }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-birth-date">المهارات</label>
                                                                    <select name="skills[]" id="" class="form-control select2" multiple="multiple">
                                                                        @foreach($skills as $skill)
                                                                            <option
                                                                                {{ in_array($skill->id,auth('employee')->user()->getSkillsId()) ? 'selected' : '' }}
                                                                                value="{{ $skill->id }}">{{ $skill->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="account-website">البلد المقيم فيها</label>
                                                                <input type="text" class="form-control" id="account-website" name="country" value="{{ auth('employee')->user()->country }}" placeholder="البلد التي تقيم بها حاليا">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="account-website">عدد الايام التي استطيع العمل بها في الاسبوع</label>
                                                                <input type="text" class="form-control" id="account-website" name="work_days_in_week" value="{{ auth('employee')->user()->work_days_in_week }}" placeholder="عدد الايام التي استطيع ان اعملها في الاسبوع">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="account-website">اعمل من الساعة</label>
                                                                <input type="text" class="form-control pickatime" id="account-website" name="work_from" value="{{ auth('employee')->user()->work_from }}" placeholder="استطيع العمل من الساعة">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="account-website">حتي الساعة</label>
                                                                <input type="text" class="form-control pickatime" id="account-website" name="work_to" value="{{ auth('employee')->user()->work_to }}" placeholder="استطيع العمل حتي الساعة">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">تحديث الملف الشخصي</button>
                                                            <a href="{{ route('employee.home') }}" class="btn btn-outline-warning">عوده</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- account setting page end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/Admin') }}/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/Admin') }}/app-assets/vendors/css/forms/select/select2.min.css">
@endpush

@push('js')
    <!-- BEGIN: Page JS-->
    <script src="{{ url('assets/Admin') }}/app-assets/js/scripts/pages/account-setting.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/js/scripts/forms/select/form-select2.js"></script>
    <!-- END: Page JS-->
    @if(session()->has('login-success'))
        <script>
            toastr.success('{{ session('login-success') }}', 'Login', { positionClass: 'toast-bottom-right', containerId: 'toast-bottom-right' });
        </script>
    @endif
    @if(session()->has('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success', { positionClass: 'toast-bottom-right', containerId: 'toast-bottom-right' });
        </script>
    @endif
@endpush
