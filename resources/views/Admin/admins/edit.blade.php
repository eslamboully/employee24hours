@extends('Admin.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">تعديل مشرف</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">المشرفين</a>
                                    </li>
                                    <li class="breadcrumb-item active">تعديل مشرف
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Tables start -->
                <section id="basic-horizontal-layouts">
                    <div class="row match-height">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">مشرف جديد</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="{{ route('admin.admins.update',$element->id) }}" method="post">
                                            {{ csrf_field() }}
                                            @method("put")
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>اسم المشرف</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="first-name" class="form-control" name="name" value="{{ $element->name }}" placeholder="اسم المشرف">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>البريد الالكتروني</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="email-id" class="form-control" name="email" value="{{ $element->email }}" placeholder="البريد الالكتروني الخاص بالمشرف">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>كلمة المرور</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="contact-info" class="form-control" name="password" placeholder="كلمة المرور">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="table-responsive border rounded px-1 ">
                                                            <h6 class="border-bottom py-1 mx-1 mb-0 font-medium-2"><i class="feather icon-lock mr-50 "></i>الصلاحيات</h6>
                                                            <table class="table table-borderless">
                                                                <thead>
                                                                <tr>
                                                                    <th>التحكمات</th>
                                                                    <th>اضافة</th>
                                                                    <th>رؤية</th>
                                                                    <th>تعديل</th>
                                                                    <th>حذف</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($models as $model)
                                                                    <tr>
                                                                        <td>{{ $model }}</td>
                                                                        @foreach ($crud as $ssd)
                                                                            <td>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input {{ $element->hasPermissionTo($ssd . '_' . $model) ? "checked" : "" }} type="checkbox" id="{{ $ssd . '_' . $model }}" name="permissions[]" value="{{ $ssd . '_' . $model }}" class="custom-control-input">
                                                                                    <label class="custom-control-label" for="{{ $ssd . '_' . $model }}"></label>
                                                                                </div>
                                                                            </td>
                                                                        @endforeach
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">حفظ</button>
                                                        <a href="{{ route('admin.admins.index') }}" class="btn btn-outline-warning mr-1 mb-1">عودة</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Tables end -->
            </div>
        </div>
    </div>
@endsection
