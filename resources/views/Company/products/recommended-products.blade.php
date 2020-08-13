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
                            <h2 class="content-header-title float-left mb-0">جدول المنتجات الموصى بها</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item active">ادارة المنتجات الموصى بها
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
                                <h4 class="card-title">المنتجات الموصى بها</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="card-text">
                                        <a href="" class="btn btn-primary">تحديث</a>
                                        <a href="" class="btn btn-danger">حذف الكل</a>
                                    </p>
                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>المنتج</th>
                                                <th>الحالة</th>
                                                <th>الكمية</th>
                                                <th>صورة</th>
                                                <th>موصى بها</th>
                                                <th>القسم</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($elements as $index=>$element)
                                                    <tr>
                                                        <th scope="row">{{ $index +1 }}</th>
                                                        <td>{{ $element->title }}</td>
                                                        @if($element->status == 'hot')
                                                            <td>ساخن</td>
                                                        @elseif($element->status == 'cold')
                                                            <td>بارد</td>
                                                        @else
                                                            <td>غير غذائي</td>
                                                        @endif
                                                        <td>{{ $element->quantity }}</td>
                                                        <td><img src="{{ url('uploads/products/'.$element->photo) }}" style="width: 50px;height: 50px" alt=""></td>
                                                        <td>
                                                            @if($element->recommended == 0)
                                                                <button type="button" class="btn btn-warning product-recommended-button" data-id="{{ $element->id }}">منتج موصي</button>
                                                            @else
                                                                <button type="button" class="btn btn-warning product-recommended-button" data-id="{{ $element->id }}">الغاء التوصيه</button>
                                                            @endif
                                                        </td>
                                                        <td>{{ $element->department->title }}</td>
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
        $('.product-recommended-button').on('click',function (e) {
            e.preventDefault();
            let that = this;

            $.ajax({
                url: `{{ route('company.recommended-products.destroy') }}/${that.dataset.id}`,
                method: 'post',
                data : {_token: "{{ csrf_token() }}"},
                success: (data) => {
                    if(data.data == 0) {
                        $(this).html('منتج موصي');
                    }else{
                        $(this).html('الغاء التوصية');
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
                    window.location.href = `{{ route('company.recommended-products.destroy') }}/${that.dataset.id}`;
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
