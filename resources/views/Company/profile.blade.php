@extends('Company.layouts.app')

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
                                    <li class="breadcrumb-item"><a href="{{ route('company.home') }}">الرئيسية</a>
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
                                                <form action="{{ route('company.profile_post') }}" method="post" enctype="multipart/form-data">
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
                                                            <img src="{{ url('uploads/companies/avatar/'.auth('company')->user()->photo) }}" class="rounded mr-75" alt="profile image" height="64" width="64">
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
                                                                    <label for="account-username">اسم الشركة</label>
                                                                    <input type="text" class="form-control" name="name" id="account-username" placeholder="اسم الشركة" value="{{ auth('company')->user()->name }}" required data-validation-required-message="اسم الشركة مطلوب">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-e-mail">البريد الالكتروني</label>
                                                                    <input type="email" class="form-control" name="email" id="account-e-mail" placeholder="البريد الالكتروني للشركة" value="{{ auth('company')->user()->email }}" required data-validation-required-message="البريد الالكتروني للشركة مطلوب">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="account-company">حالة الحساب</label>
                                                                <input type="text" class="form-control" id="account-company" disabled placeholder="{{ auth('company')->user()->block == 0 ? 'مفعل' : 'غير مفعل' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">تحديث الملف الشخصي</button>
                                                            <a href="{{ route('company.home') }}" class="btn btn-outline-warning">عوده</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                                <form action="{{ route('company.profile_post') }}" method="post" enctype="multipart/form-data">
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
                                                            <a href="{{ route('company.home') }}" class="btn btn-outline-warning">عوده</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                                <form action="{{ route('company.profile_post') }}" method="post" enctype="multipart/form-data">
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
                                                                <label for="accountTextarea">معلومات عن الشركة</label>
                                                                <textarea class="form-control" id="accountTextarea" name="bio" rows="3" placeholder="معلومات اضافية عن الشركة">{{ auth('company')->user()->bio }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-birth-date">هاتف الشركة الاساسي</label>
                                                                    <input type="text" class="form-control birthdate-picker" name="phone" value="{{ auth('company')->user()->phone }}" placeholder="رقم الهاتف">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="account-website">الموقع الرسمي</label>
                                                                <input type="text" class="form-control" id="account-website" name="website" value="{{ auth('company')->user()->website }}" placeholder="الموقع الرسمي للشركة">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">تحديث الملف الشخصي</button>
                                                            <a href="{{ route('company.home') }}" class="btn btn-outline-warning">عوده</a>
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

@push('js')
    <!-- BEGIN: Page JS-->
    <script src="{{ url('assets/Admin') }}/app-assets/js/scripts/pages/account-setting.js"></script>
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
