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
                                                                        <option {{ in_array('Afrikaans',auth('employee')->user()->languages) ? 'selected' : '' }} value="Afrikaans">Afrikaans</option>
                                                                        <option {{ in_array('Albanian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Albanian">Albanian</option>
                                                                        <option {{ in_array('Arabic',auth('employee')->user()->languages) ? 'selected' : '' }} value="Arabic">Arabic</option>
                                                                        <option {{ in_array('Armenian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Armenian">Armenian</option>
                                                                        <option {{ in_array('Basque',auth('employee')->user()->languages) ? 'selected' : '' }} value="Basque">Basque</option>
                                                                        <option {{ in_array('Bengali',auth('employee')->user()->languages) ? 'selected' : '' }} value="Bengali">Bengali</option>
                                                                        <option {{ in_array('Bulgarian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Bulgarian">Bulgarian</option>
                                                                        <option {{ in_array('Catalan',auth('employee')->user()->languages) ? 'selected' : '' }} value="Catalan">Catalan</option>
                                                                        <option {{ in_array('Cambodian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Cambodian">Cambodian</option>
                                                                        <option {{ in_array('Chinese',auth('employee')->user()->languages) ? 'selected' : '' }} value="Chinese">Chinese (Mandarin)</option>
                                                                        <option {{ in_array('Croatian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Croatian">Croatian</option>
                                                                        <option {{ in_array('Czech',auth('employee')->user()->languages) ? 'selected' : '' }} value="Czech">Czech</option>
                                                                        <option {{ in_array('Dutch',auth('employee')->user()->languages) ? 'selected' : '' }} value="Dutch">Dutch</option>
                                                                        <option {{ in_array('English',auth('employee')->user()->languages) ? 'selected' : '' }} value="English">English</option>
                                                                        <option {{ in_array('French',auth('employee')->user()->languages) ? 'selected' : '' }} value="French">French</option>
                                                                        <option {{ in_array('German',auth('employee')->user()->languages) ? 'selected' : '' }} value="German">German</option>
                                                                        <option {{ in_array('Greek',auth('employee')->user()->languages) ? 'selected' : '' }} value="Greek">Greek</option>
                                                                        <option {{ in_array('Hindi',auth('employee')->user()->languages) ? 'selected' : '' }} value="Hindi">Hindi</option>
                                                                        <option {{ in_array('Hungarian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Hungarian">Hungarian</option>
                                                                        <option {{ in_array('Icelandic',auth('employee')->user()->languages) ? 'selected' : '' }} value="Icelandic">Icelandic</option>
                                                                        <option {{ in_array('Indonesian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Indonesian">Indonesian</option>
                                                                        <option {{ in_array('Irish',auth('employee')->user()->languages) ? 'selected' : '' }} value="Irish">Irish</option>
                                                                        <option {{ in_array('Italian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Italian">Italian</option>
                                                                        <option {{ in_array('Japanese',auth('employee')->user()->languages) ? 'selected' : '' }} value="Japanese">Japanese</option>
                                                                        <option {{ in_array('Javanese',auth('employee')->user()->languages) ? 'selected' : '' }} value="Javanese">Javanese</option>
                                                                        <option {{ in_array('Korean',auth('employee')->user()->languages) ? 'selected' : '' }} value="Korean">Korean</option>
                                                                        <option {{ in_array('Latin',auth('employee')->user()->languages) ? 'selected' : '' }} value="Latin">Latin</option>
                                                                        <option {{ in_array('Lithuanian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Lithuanian">Lithuanian</option>
                                                                        <option {{ in_array('Mongolian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Mongolian">Mongolian</option>
                                                                        <option {{ in_array('Norwegian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Norwegian">Norwegian</option>
                                                                        <option {{ in_array('Persian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Persian">Persian</option>
                                                                        <option {{ in_array('Polish',auth('employee')->user()->languages) ? 'selected' : '' }} value="Polish">Polish</option>
                                                                        <option {{ in_array('Portuguese',auth('employee')->user()->languages) ? 'selected' : '' }} value="Portuguese">Portuguese</option>
                                                                        <option {{ in_array('Quechua',auth('employee')->user()->languages) ? 'selected' : '' }} value="Quechua">Quechua</option>
                                                                        <option {{ in_array('Romanian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Romanian">Romanian</option>
                                                                        <option {{ in_array('Russian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Russian">Russian</option>
                                                                        <option {{ in_array('Serbian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Serbian">Serbian</option>
                                                                        <option {{ in_array('Slovak',auth('employee')->user()->languages) ? 'selected' : '' }} value="Slovak">Slovak</option>
                                                                        <option {{ in_array('Slovenian',auth('employee')->user()->languages) ? 'selected' : '' }} value="Slovenian">Slovenian</option>
                                                                        <option {{ in_array('Spanish',auth('employee')->user()->languages) ? 'selected' : '' }} value="Spanish">Spanish</option>
                                                                        <option {{ in_array('Swedish',auth('employee')->user()->languages) ? 'selected' : '' }} value="Swedish">Swedish</option>
                                                                        <option {{ in_array('Turkish',auth('employee')->user()->languages) ? 'selected' : '' }} value="Turkish">Turkish</option>
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
