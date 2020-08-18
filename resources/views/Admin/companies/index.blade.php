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
                            <h2 class="content-header-title float-left mb-0">جدول الشركات</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item active">ادارة الشركات
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
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">الشركات</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <p class="card-text">
                                            <a href="" class="btn btn-primary">تحديث</a>
                                            <a href="" class="btn btn-danger">حذف الكل</a>
                                        </p>
                                        <div class="table-responsive">
                                            <table class="table zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>الاسم</th>
                                                        <th>البريد الالكتروني</th>
                                                        <th>صورة</th>
                                                        <th>الوظائف</th>
                                                        <th>الموظفين التابعين</th>
                                                        <th>وقف الحساب</th>
                                                        <th>الاجراءات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($elements as $index=>$element)
                                                    <tr>
                                                        <td scope="row">{{ $index +1 }}</td>
                                                        <td>{{ $element->name }}</td>
                                                        <td>{{ $element->email }}</td>
                                                        <td>
                                                            <img src="{{ url('uploads/companies/avatar/'.$element->photo) }}" style="width: 50px;height: 50px" alt="">
                                                        </td>
                                                        <td><a href="#" class="btn btn-info">الوظائف التابعة</a></td>
                                                        <td><a href="#" class="btn btn-info">الموظفين التابعين</a></td>
                                                        <td>
                                                            @if($element->block == 0)
                                                                @if(im('admin')->hasPermissionTo('create_blacklist'))
                                                                <button type="button" class="btn btn-warning company-block-button" data-id="{{ $element->id }}">اضغط لوقف الحساب</button>
                                                                @else
                                                                <button type="button" class="btn btn-warning disabled" disabled>اضغط لوقف الحساب</button>
                                                                @endif
                                                            @else
                                                                @if(im('admin')->hasPermissionTo('create_blacklist'))
                                                                    <button type="button" class="btn btn-warning company-block-button" data-id="{{ $element->id }}">اضغط لتفعيل الحساب</button>
                                                                @else
                                                                    <button type="button" class="btn btn-warning disabled" disabled>اضغط لتفعيل الحساب</button>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>

                                                            <form action="{{ route('admin.companies.destroy',$element->id) }}" method="post">
                                                                @method('delete')
                                                                {{ csrf_field() }}
                                                                @if(im('admin')->hasPermissionTo('update_companies'))
                                                                <a href="#" class="btn btn-success"><i class="fa fa-edit"></i> تعديل</a>
                                                                @else
                                                                    <a href="#" class="btn btn-success disabled"><i class="fa fa-edit"></i> تعديل</a>
                                                                @endif
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>الاسم</th>
                                                        <th>البريد الالكتروني</th>
                                                        <th>صورة</th>
                                                        <th>الوظائف</th>
                                                        <th>الموظفين التابعين</th>
                                                        <th>وقف الحساب</th>
                                                        <th>الاجراءات</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/js/scripts/datatables/datatable.js"></script>
    <script>
        $('.company-block-button').on('click',function (e) {
            e.preventDefault();
            let that = this;
            // console.log($(this).html('god'));
            $.ajax({
                url: `{{ route('admin.companies.block') }}/${that.dataset.id}`,
                method: 'post',
                data : {_token: "{{ csrf_token() }}"},
                success: (data) => {
                    if(data.data == 0) {
                        $(this).html('اضغط لوقف الحساب');
                    }else{
                        $(this).html('اضغط لتفعيل الحساب');
                    }
                }
            });
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
                    window.location.href = `{{ route('admin.companies.destroy') }}/${that.dataset.id}`;
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
