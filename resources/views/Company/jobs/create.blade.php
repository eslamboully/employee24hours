@extends('company.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">اضف وظيفة جديدة</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">الوظائف</a>
                                    </li>
                                    <li class="breadcrumb-item active"> اضف وظيفة
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
                                    <h4 class="card-title">وظيفة جديد</h4>
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
                                        <form class="form form-horizontal" action="{{ route('company.jobs.store') }}" method="post">
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
                                                                                        <span>الوصف والشروط</span>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <textarea name="{{ $language->locale }}[description]" class="form-control ckeditor" placeholder="شروط الوظيفة ومواصفاتها">{{ old($language->locale)["description"] }}</textarea>
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
                                                            <div class="col-md-4">
                                                                <span>الاتفاقية</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <select name="parent_type" class="form-control" id="">
                                                                    <option value="">اختر اتفاقية الوظيفة</option>
                                                                    @foreach($conventions as $convention)
                                                                        <option value="{{ $convention->id }}">{{ $convention->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>القسم الرئيسي</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <select name="parent_type" class="form-control" id="">
                                                                    <option value="">القسم رئيسي</option>
                                                                    @foreach($parents as $parent)
                                                                        <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>القسم الفرعي</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <select name="job_type_id" class="form-control" id="">
                                                                    <option value="">القسم الفرعي</option>
{{--                                                                @foreach($categories as $category)--}}
{{--                                                                        <option value="{{ $category->id }}">{{ $category->title }}</option>--}}
{{--                                                                    @endforeach--}}
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">حفظ</button>
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

@push('js')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
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
