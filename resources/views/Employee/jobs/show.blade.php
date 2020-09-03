@extends('Employee.layouts.app')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">{{ $element->title }}</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">الوظائف</a>
                                </li>
                                <li class="breadcrumb-item active">{{ $element->title }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!--native-font-stack -->
            @if($bid !== null)
                <section id="global-settings" class="card">
                    <div class="card-header">
                        <h4 class="card-title">قمت بتقديم عرض بالفعل</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-text">
                                <p>{!! $bid->description !!}</p>
                                <a href="{{ route('employee.jobs.bids.index') }}" class="btn btn-success btn-lg">قائمة عروضي</a>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            <section id="global-settings" class="card">
                <div class="card-header">
                    <h4 class="card-title">تفاصيل العمل</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="card-text">
                            <p>{!! $element->description !!}</p>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Global settings -->

            <!-- Headings -->
            <section id="html-headings-default" class="row match-height">
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تفاصيل المواعيد والراتب</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="card-text">
                                    <p></p>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                    <tr>
                                        <th>تفاصيل</th>
                                        <th class="text-right">قيمة</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <h3>اسم الشركة</h3>
                                        </td>
                                        <td class="type-info text-right">{{ $element->company->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3>البريد الالكتروني</h3>
                                        </td>
                                        <td class="type-info text-right">{{ $element->company->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3>الراتب</h3>
                                        </td>
                                        <td class="type-info text-right">{{ $element->salary }} دولار</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3>ايام العمل في الاسبوع</h3>
                                        </td>
                                        <td class="type-info text-right">{{ $element->work_days_in_week }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3>العمل من الساعة</h3>
                                        </td>
                                        <td class="type-info text-right">{{ $element->work_from }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3>حتي الساعة</h3>
                                        </td>
                                        <td class="type-info text-right">{{ $element->work_to }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تفاصيل الاتفاقية</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="card-text">
                                    <h6>البنود الاساسية</h6>
                                    <p>{!! $element->convention->main_items !!}</p>
                                    <h6>البنود الفرعية</h6>
                                    <p>{!! $element->convention->sub_items !!}</p>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                    <tr>
                                        <th>اخري</th>
                                        <th class="text-right">تفاصيل</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <h1 class="text-bold-300">الاتفاقية</h1>
                                        </td>
                                        <td class="text-right">
                                            <h1 class="text-bold-400">{{ $element->convention->agreement->title }}</h1>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                @if($bid === null)
                {{-- Job => work_from > Employee => work_from && Job => work_to > Employee => work_to  --}}

                    @if($elementWorkFrom >= $employeeWorkFrom && $elementWorkTo <= $employeeWorkTo)
                        <div class="col-sm-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">تقديم عرض</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pb-0">
                                        <form action="{{ route('employee.jobs.bids.create') }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="job_id" value="{{ $element->id }}">
                                            <div class="form-group">
                                                <textarea name="description" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-success">اضف عرض</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-sm-12 col-md-12">
                            <div class="card">
                                <div class="card-header" style="height: 90px;">
                                    <h4 class="card-title">لا يمكن تقديم عرض لاختلافك مع متطلبات الشركة</h4>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </section>
            <!--/ Headings -->

        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/js/scripts/datatables/datatable.js"></script>


    @if(session()->has('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Good Job!', { positionClass: 'toast-bottom-right', containerId: 'toast-bottom-right' });
        </script>
    @endif
@endpush
