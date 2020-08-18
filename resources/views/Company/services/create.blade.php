@extends('Company.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">اضف خدمة جديدة</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">الخدمات</a>
                                    </li>
                                    <li class="breadcrumb-item active">اضف خدمة
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
                                    <h4 class="card-title">خدمة جديدة</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form class="form form-horizontal" action="{{ route('company.services.store') }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card overflow-hidden">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <ul class="nav nav-tabs" role="tablist">
                                                                        @foreach($languages as $index=>$language)
                                                                            <li class="nav-item">
                                                                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="home-tab" data-toggle="tab" href="#{{ str_replace(' ','-',$language->name) }}" aria-controls="home" role="tab" aria-selected="true">{{ $language->name }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <br/>
                                                                    <div class="tab-content">
                                                                        @foreach($languages as $index=>$language)
                                                                            @php $locale = $language->locale @endphp
                                                                        <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="{{ str_replace(' ','-',$language->name) }}" aria-labelledby="home-tab" role="tabpanel">
                                                                            <div class="col-12">
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4">
                                                                                        <span>العنوان</span>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <input type="text" id="first-name" class="form-control" name="{{ $language->locale }}[title]" value="{{ old($language->locale)["title"] }}" placeholder="العنوان">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4">
                                                                                        <span>الوصف</span>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <textarea name="{{ $language->locale }}[description]" class="form-control" id="" placeholder="الوصف">{{ old($language->locale)["description"] }}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr/>
                                                        <div class="col-12">
                                                            <div class="form-group row">
                                                                <div class="col-md-4">
                                                                    <span>القسم</span>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-birth-date">القسم</label>
                                                                                <select name="service_category_id" id="" class="form-control select2">
                                                                                    @foreach($categories as $category)
                                                                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <fieldset class="form-group">
                                                                    <label for="basicInputFile">ملف الاوراق الثبوتية</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" name="file" id="inputGroupFile01">
                                                                        <label class="custom-file-label" for="inputGroupFile01">رفع الملف</label>
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label for="account-birth-date">تكلفة الخدمة</label>
                                                                                    <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label for="basicInputFile">مدة تقديم الخدمة</label>
                                                                                    <input type="text" name="time" class="form-control" placeholder="مدة تقديم الخدمة" value="{{ old('time') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">حفظ</button>
                                                        <a href="{{ route('company.services.index') }}" class="btn btn-outline-warning mr-1 mb-1">عودة</a>
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

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/Admin') }}/app-assets/vendors/css/forms/select/select2.min.css">
@endpush

@push('js')
    <!-- BEGIN: Page JS-->
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/js/scripts/forms/select/form-select2.js"></script>
@endpush
