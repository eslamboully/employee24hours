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
                            <h2 class="content-header-title float-left mb-0">جدول عروض الوظيفة</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item active">ادارة العروض
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
                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ $element->title }}</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="card-text">
{{--                                        @if(im('company')->hasPermissionTo('create_jobtypes'))--}}
{{--                                        <a href="{{ route('company.jobs.create') }}" class="btn btn-success">اضف جديد</a>--}}
{{--                                        @else--}}
{{--                                            <a href="#" class="btn btn-success disabled" disabled>اضف جديد</a>--}}
{{--                                        @endif--}}
{{--                                        <a href="" class="btn btn-primary">تحديث</a>--}}
{{--                                        <a href="" class="btn btn-danger">حذف الكل</a>--}}
                                    </p>
                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>العرض</th>
                                                <th>صاحب العرض</th>
                                                <th>الاجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($element->bids as $index=>$bid)
                                                    <tr>
                                                        <td scope="row">{{ $index +1 }}</td>
                                                        <td>{{ $bid->description }}</td>
                                                        <td><button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-info info_button"
                                                               data-name="{{ $bid->employee->name }}"
                                                               data-email="{{ $bid->employee->email }}"
                                                               data-languages="{{ $bid->employee->languages }}"
                                                               data-work-from="{{ $bid->employee->work_from }}"
                                                               data-work-to="{{ $bid->employee->work_to }}"
                                                               data-work-days-in-week="{{ $bid->employee->work_days_in_week }}">
                                                                صاحب العرض
                                                            </button></td>
                                                        <td>
                                                            <form action="{{ route('company.jobs.bids.accept',$bid->id) }}" method="post">
                                                                {{ csrf_field() }}
                                                                @if($bid->status == 0)
                                                                    <button class="btn btn-success">
                                                                        <i class="fa fa-edit"></i>
                                                                        اختيار
                                                                    </button>
                                                                @elseif($bid->status == 1)
                                                                    <button class="btn btn-dark">
                                                                        <i class="fa fa-edit"></i>
                                                                        رسائل التفاوض
                                                                    </button>
                                                                @endif
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Basic Tables end -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تفاصيل صاحب العرض</h5>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0 info_table">

                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">حسنا</button>
                </div>
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

    <script>
        $('.info_button').on('click',function (e) {
            e.preventDefault();
            let name = $(this).data('name');
            let email = $(this).data('email');
            let languages = $(this).data('languages');
            let work_from = $(this).data('work-from');
            let work_to = $(this).data('work-to');
            let work_days_in_week = $(this).data('work-days-in-week');

            $('.info_table').html(`
                <thead>
                            <tr>
                                <th>المعلومات</th>
                                <th class="text-left">التفاصيل</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>الاسم</td>
                                <td>${name}</td>
                            </tr>
                            <tr>
                                <td>البريد الالكتروني</td>
                                <td>${email}</td>
                            </tr>
                            <tr>
                                <td>اللغات</td>
                                <td>${languages}</td>
                            </tr>
                            <tr>
                                <td>يعمل من</td>
                                <td>${work_from}</td>
                            </tr>
                            <tr>
                                <td>يعمل الي</td>
                                <td>${work_to}</td>
                            </tr>
                            <tr>
                                <td>ايام العمل في الاسبوع</td>
                                <td>${work_days_in_week}</td>
                            </tr>
                            </tbody>
            `);
        });
    </script>
    @if(session()->has('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Good Job!', { positionClass: 'toast-bottom-right', containerId: 'toast-bottom-right' });
        </script>
    @endif
@endpush
