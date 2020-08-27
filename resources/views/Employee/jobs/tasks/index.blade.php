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
                            <h2 class="content-header-title float-left mb-0">جدول مهماتي</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item active">ادارة المهمات
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
                                <h4 class="card-title">المهمات الخاصة بي</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="card-text">
{{--                                        @if(im('company')->hasPermissionTo('create_jobtypes'))--}}
{{--                                        <a href="" class="btn btn-success">اضف جديد</a>--}}
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
                                                <th>المهمة</th>
                                                <th>الوظيفة</th>
                                                <th>الشركة</th>
                                                <th>السعر</th>
                                                <th>ميعاد التسليم</th>
                                                <th>الحالة</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(im('employee')->tasks as $index=>$element)
                                                    <tr>
                                                        <td scope="row">{{ $index +1 }}</td>
                                                        <td>{{ \Illuminate\Support\Str::limit($element->description,20) }}</td>
                                                        <td>{{ $element->job->title }}</td>
                                                        <td>{{ $element->company->name }}</td>
                                                        <td>{{ $element->price }}</td>
                                                        <td>{{ $element->deadline }}</td>
                                                        <td>
                                                            <div class="text-nowrap">
                                                                @if($element->status == 0)
                                                                    <button class="btn btn-primary" disabled>قيد التنفيذ</button>
                                                                    <button class="btn btn-info finish_task" data-id="{{ $element->id }}">تسليم العمل</button>
                                                                @elseif($element->status == 1)
                                                                    <button class="btn btn-info" disabled>بانتظار التأكد</button>
                                                                @elseif($element->status == 2)
                                                                    <button class="btn btn-info" disabled>تم انجازها</button>
                                                                @elseif($element->status == 3)
                                                                    <button class="btn btn-primary see_refusal_details" data-refusal="{{ $element->refusal_details }}">سبب الرفض</button>
                                                                    <a href="" class="btn btn-info finish_task" data-id="{{ $element->id }}">تسليم مرة اخرى</a>
                                                                @endif
                                                            </div>
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

        $('.finish_task').on('click',function (e) {
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
                title: 'هل انت متأكد من اتمام العمل ؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'نعم اتممت العمل',
                cancelButtonText: 'الغاء',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    window.location.href = `{{ route('employee.tasks.finish') }}/${that.dataset.id}`;
                }
            })
        });
    </script>

    @if(session()->has('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Good Job!', { positionClass: 'toast-bottom-right', containerId: 'toast-bottom-right' });
        </script>
    @endif
@endpush
