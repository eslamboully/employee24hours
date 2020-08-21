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
                            <h2 class="content-header-title float-left mb-0">تعديل وجبات</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">وجبات</a>
                                    </li>
                                    <li class="breadcrumb-item active">تعديل وجبة
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
                                    <h4 class="card-title">تعديل بيانات وجبة</h4>
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
                                        <form class="form form-horizontal" action="{{ route('company.meals.update',$element->id) }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            @method('put')
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
                                                                                            <input type="text" id="first-name" class="form-control" name="{{ $language->locale }}[title]" value="{{ $element->translate($language->locale)->title }}" placeholder="العنوان">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-4">
                                                                                            <span>الوصف</span>
                                                                                        </div>
                                                                                        <div class="col-md-8">
                                                                                            <textarea name="{{ $language->locale }}[description]" class="form-control" id="" placeholder="الوصف">{{ $element->translate($language->locale)->description }}</textarea>
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
                                                                    <span>المنتجات المرتبطة</span>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-birth-date">تحتوي علي</label>
                                                                                <select name="related_products[]" id="" class="form-control select2" multiple="multiple">
                                                                                    @foreach($products as $product)
                                                                                            <option {{ in_array($product->id,$element->related_array()) ? 'selected' : '' }} value="{{ $product->id }}">{{ $product->title }}</option>
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
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label for="">نوع العرض</label>
                                                                                    <select name="offer_type" id="" class="form-control">
                                                                                        <option value="">نوع العرض</option>
                                                                                        <option {{ $element->offer_type == '0' ? 'selected' : '' }} value="0">دائم</option>
                                                                                        <option {{ $element->offer_type == '1' ? 'selected' : '' }} value="1">مؤقت</option>
                                                                                    </select>
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
                                                                                    <label for="account-birth-date">بدأ العرض في</label>
                                                                                    <input type="text" name="start_offer_at" value="{{ $element->start_offer_at }}" class="form-control pickadate">
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
                                                                                    <label for="account-birth-date">ينتهي العرض في</label>
                                                                                    <input type="text" name="end_offer_at" value="{{ $element->end_offer_at }}" class="form-control pickadate">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label for="basicInputFile">سعر المنتج</label>
                                                                                    <input type="number" name="price" class="form-control" placeholder="سعر المنتج" value="{{ $element->price }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label for="basicInputFile">سعر العرض</label>
                                                                                    <input type="number" name="offer_price" class="form-control" placeholder="سعر العرض" value="{{ $element->offer_price }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label for="account-birth-date">التصنيف</label>
                                                                                    <select name="department_id" id="" class="form-control">
                                                                                        @foreach($departments as $department)
                                                                                            <option {{ $element->department_id == $department->id ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->title }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">تعديل</button>
                                                        <a href="{{ route('company.meals.index') }}" class="btn btn-outline-warning mr-1 mb-1">عودة</a>
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
    <link rel="stylesheet" type="text/css" href="{{ url('assets/Admin') }}/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/Admin') }}/app-assets/vendors/css/forms/select/select2.min.css">
@endpush

@push('js')
    <!-- BEGIN: Page JS-->
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/js/scripts/forms/select/form-select2.js"></script>
@endpush
