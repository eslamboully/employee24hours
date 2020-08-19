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
                            <h2 class="content-header-title float-left mb-0">جدول اقسام الوظائف</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item active">ادارة اقسام الوظائف
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
                                <h4 class="card-title">{{ $type !== null ? $type->title : 'الاقسام المرتبطة'}}</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="card-text">
{{--                                        @if(im('company')->hasPermissionTo('create_jobtypes'))--}}
                                        <a href="{{ route('company.job-types.create') }}" class="btn btn-success">اضف جديد</a>
{{--                                        @else--}}
{{--                                            <a href="#" class="btn btn-success disabled" disabled>اضف جديد</a>--}}
{{--                                        @endif--}}
                                        <a href="" class="btn btn-primary">تحديث</a>
                                        <a href="" class="btn btn-danger">حذف الكل</a>
                                    </p>
                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>العنوان</th>
                                                @if($type === null)
                                                    <th>الاقسام المرتبطة</th>
                                                @endif
                                                <th>الاجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($elements as $index=>$element)
                                                    <tr>
                                                <th scope="row">{{ $index +1 }}</th>
                                                <td>{{ $element->title }}</td>
                                                @if($type === null)
                                                    <td><a href="?type={{ $element->id }}" class="btn btn-info">الاقسام الفرعية</a></td>
                                                @endif
                                                <td>

                                                    <form action="{{ route('company.job-types.destroy',$element->id) }}" method="post">
                                                        @method('delete')
                                                        {{ csrf_field() }}
                                                            <a href="{{ route('company.job-types.edit',$element->id) }}" class="btn btn-success"><i class="fa fa-edit"></i> تعديل</a>
                                                            <button class="btn btn-danger delete_class" data-id="{{ $element->id }}">
                                                                <i class="fa fa-trash"></i>
                                                                حذف
                                                            </button>
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
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
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
                    window.location.href = `{{ route('company.job-types.destroy') }}/${that.dataset.id}`;
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
