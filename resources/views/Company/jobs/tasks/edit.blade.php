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
                            <h2 class="content-header-title float-left mb-0">تعديل الوظيفة</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">الوظائف</a>
                                    </li>
                                    <li class="breadcrumb-item active"> تعديل وظيفة
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
                                    <h4 class="card-title">تعديل وظيفة</h4>
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
                                        <form class="form form-horizontal" action="{{ route('company.jobs.update',$element->id) }}" method="post">
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
                                                                                        <span>الوصف والشروط</span>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <textarea name="{{ $language->locale }}[description]" class="form-control ckeditor" placeholder="شروط الوظيفة ومواصفاتها">{{ $element->translate($language->locale)->description }}</textarea>
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
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-12">
                                                                <label for="">اتفاقية الوظيفة</label>
                                                                <select name="convention_id" class="form-control" id="">
                                                                    <option value="">اختر اتفاقية الوظيفة</option>
                                                                    @foreach($conventions as $convention)
                                                                        <option {{ $convention->id == $element->convention_id ? 'selected' : '' }} value="{{ $convention->id }}">{!! $convention->main_items !!}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <label for="">العمل من الساعة</label>
                                                                <input type="text" name="work_from" class="form-control pickatime" placeholder="اعمل من الساعة" value="{{ $element->work_from }}">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="">حتي الساعة</label>
                                                                <input type="text" name="work_to" class="form-control pickatime" placeholder="حتي الساعة" value="{{ $element->work_to }}">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="">عدد ايام العمل في الاسبوع</label>
                                                                <input type="text" name="work_days_in_week" class="form-control" placeholder="عدد الايام التي استطيع العمل بها في الاسبوع" value="{{ $element->work_days_in_week }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label for="">الراتب او المبلغ</label>
                                                                <input type="text" name="salary" class="form-control" placeholder="الراتب او المبلغ" value="{{ $element->salary }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">اعادة ارسال</button>
                                                        <a href="{{ route('company.jobs.index') }}" class="btn btn-outline-warning mr-1 mb-1">عودة</a>
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
@endpush

@push('js')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js"></script>
    <script>
        $("[name='parent_type']").on('change',function () {
            var parent = $(this).val();
            $.ajax({
                url: `{{ route('company.jobs.parent.ajax') }}/${parent}`,
                method: 'post',
                data: {_token: '{{ csrf_token() }}'},
                success: (data) => {
                    $("[name='job_type_id']").empty();
                    data.data.forEach(function (job_type) {
                        $("[name='job_type_id']").append(
                            `<option value="${job_type.id}">${job_type.title}</option>`
                        );
                    });
                },
            });
        });
    </script>
@endpush
