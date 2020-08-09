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
                            <h2 class="content-header-title float-left mb-0">اضف لغة جديدة</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">اللغات</a>
                                    </li>
                                    <li class="breadcrumb-item active">اضف لغة
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
                                    <h4 class="card-title">لغة جديدة</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="{{ route('admin.languages.store') }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>اسم اللغة</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="first-name" class="form-control" name="name" placeholder="اسم اللغة">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>كود الدولة</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="email-id" class="form-control" name="code" placeholder="كود الدولة المتحدثة بها مثال الانجليزية us او العربية ae او eg ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>كود اللغة</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="contact-info" class="form-control" name="locale" placeholder="كود اللغة مثال الانجليزية en">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>اتجاه اللغة</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="password" class="form-control" name="direction" placeholder="مثال العربية rtl اما الانجليزية ltr">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">حفظ</button>
                                                        <a href="{{ route('admin.languages.index') }}" class="btn btn-outline-warning mr-1 mb-1">عودة</a>
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
