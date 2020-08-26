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
                            <h2 class="content-header-title float-left mb-0">جدول الوظائف</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item active">ادارة الوظائف
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
                                <h4 class="card-title">وظائف الشركة</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="card-text">
{{--                                        @if(im('company')->hasPermissionTo('create_jobtypes'))--}}
                                        <a href="{{ route('company.jobs.create') }}" class="btn btn-success">اضف جديد</a>
{{--                                        @else--}}
{{--                                            <a href="#" class="btn btn-success disabled" disabled>اضف جديد</a>--}}
{{--                                        @endif--}}
                                        <a href="" class="btn btn-primary">تحديث</a>
                                        <a href="" class="btn btn-danger">حذف الكل</a>
                                    </p>
                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>العنوان</th>
                                                <th>الراتب / المقابل</th>
                                                <th>ايام العمل في الاسبوع</th>
                                                <th>العمل من</th>
                                                <th>حتي الساعة</th>
                                                <th>القسم</th>
                                                <th>العروض المقدمة</th>
                                                <th>الحالة</th>
                                                <th>الاجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($elements as $index=>$element)
                                                    <tr>
                                                        <td scope="row">{{ $index +1 }}</td>
                                                        <td>{{ $element->title }}</td>
                                                        <td>{{ $element->salary }}دولار</td>
                                                        <td>{{ $element->work_days_in_week }}</td>
                                                        <td>{{ $element->work_from }}</td>
                                                        <td>{{ $element->work_to }}</td>
                                                        <td>{{ $element->type->title }}</td>
                                                        <td>
                                                            @if($element->status == 1)
                                                                <a href="{{ route('company.job.tasks.index',$element->id) }}" class="btn btn-primary waves-effect waves-light">مهمات الوظيفة</a>
                                                            @else
                                                            <a href="{{ route('company.jobs.bids.index',$element->id) }}" class="btn btn-dark">عروض الوظيفة</a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($element->status == 0)
                                                                <button class="btn btn-success" disabled>في انتظار القبول</button>
                                                            @elseif($element->status == 1)
                                                                <button class="btn btn-info" disabled>قيد العمل</button>
                                                            @elseif($element->status == 2)
                                                                <button class="btn btn-primary" disabled>وظيفة ملغية</button>
                                                            @elseif($element->status == 3)
                                                                <button class="btn btn-primary see_refusal_details" data-refusal="{{ $element->refusal_details }}">وظائف مرفوضة : السبب</button>
                                                            @elseif($element->status == 4)
                                                                <button class="btn btn-dark" disabled>وظائف معروضة</button>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('company.jobs.destroy',$element->id) }}" method="post">
                                                                @method('delete')
                                                                {{ csrf_field() }}
                                                                @if($element->status == 3)
                                                                    <a href="{{ route('company.jobs.edit',$element->id) }}" class="btn btn-success"><i class="fa fa-edit"></i>تعديل</a>
                                                                @elseif($element->contract && $element->contract->accept == 1)
                                                                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-info info_button"
                                                                        data-name="{{ $element->choosenBid()->employee->name }}"
                                                                        data-email="{{ $element->choosenBid()->employee->email }}"
                                                                        data-languages="{{ $element->choosenBid()->employee->languages }}"
                                                                        data-work-from="{{ $element->choosenBid()->employee->work_from }}"
                                                                        data-work-to="{{ $element->choosenBid()->employee->work_to }}"
                                                                        data-work-days-in-week="{{ $element->choosenBid()->employee->work_days_in_week }}">
                                                                        الموظف الحالي
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
        $('.see_refusal_details').on('click',function (e) {
            e.preventDefault();
            let that = this;
            let refusal_details = $(this).data('refusal');
            Swal.fire(refusal_details);
        });


        $('.delete_class').on('click',function (e) {
            e.preventDefault();
            let that = this;
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'هل انت متأكد من عملية المسح ؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'نعم احذف هذا',
                cancelButtonText: 'الغاء وتراجع',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    window.location.href = `{{ route('company.jobs.destroy') }}/${that.dataset.id}`;
                }
            })
        });
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
