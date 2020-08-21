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
                                                            @if($element->status == 0)
                                                                <button class="btn btn-success" disabled>في انتظار القبول</button>
                                                            @elseif($element->status == 1)
                                                                <button class="btn btn-info" disabled>قيد العمل بها</button>
                                                            @elseif($element->status == 2)
                                                                <button class="btn btn-primary" disabled>وظيفة ملغية</button>
                                                            @elseif($element->status == 3)
                                                                <button class="btn btn-primary" disabled>وظائف مرفوضة</button>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('admin.jobs.refuse',$element->id) }}" method="post">
                                                                {{ csrf_field() }}
                                                                    <button href="{{ route('admin.jobs.show',$element->id) }}" class="btn btn-info"><i class="fa fa-eye"></i>المزيد</button>
                                                                    <button class="btn btn-danger refuse_class" data-id="{{ $element->id }}">
                                                                        <i class="fa fa-edit"></i>
                                                                        رفض
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
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="{{ url('assets/Admin') }}/app-assets/js/scripts/datatables/datatable.js"></script>

    <script>
        $('.refuse_class').on('click',async function (e) {
            e.preventDefault();
            let that = this;
            let id = $(this).data('id');
            const { value: text } = await Swal.fire({
                input: 'textarea',
                inputPlaceholder: 'سبب الرفض...',
                inputAttributes: {
                    'aria-label': 'سبب الرفض...'
                },
                showCancelButton: true
            });

            if (text) {
                    $.ajax({
                        'url' : '{{ route('admin.jobs.refuse') }}',
                        'method' : 'post',
                        data: {_token: '{{ csrf_token() }}',refusal_details: text,id: id},
                        success : function () {
                            window.location.href = '{{ route('admin.jobs.index') }}?status=3'
                        }
                    });
            }


        });
    </script>

    @if(session()->has('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Good Job!', { positionClass: 'toast-bottom-right', containerId: 'toast-bottom-right' });
        </script>
    @endif
@endpush
