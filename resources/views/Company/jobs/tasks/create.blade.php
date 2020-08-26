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
                            <h2 class="content-header-title float-left mb-0">اضف مهمة لوظيفة ({{ $job->title }})</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">المهمات</a>
                                    </li>
                                    <li class="breadcrumb-item active"> اضف المهمات
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
                                    <h4 class="card-title">مهمة جديد</h4>
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
                                        <form class="form form-horizontal" action="{{ route('company.job.tasks.store') }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-12">
                                                                <label for="">موعد التسليم</label>
                                                                <input type="string" class="form-control pickadate" name="deadline" placeholder="موعد التسليم">
                                                            </div>
                                                            @if($job->contract->job->convention->agreement_id == 3)
                                                                <div class="col-md-12">
                                                                    <label for="">السعر</label>
                                                                    <input type="number" class="form-control" name="price" placeholder="المقابل">
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <input type="hidden" name="job_id" value="{{ $job->id }}">
                                                            <input type="hidden" name="employee_id" value="{{ $job->contract->employee_id }}">
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12">
                                                                <label for="">وصف التاسك</label>
                                                                <textarea class="form-control" name="description" placeholder="وصف التاسك"></textarea>
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
