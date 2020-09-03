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
                            <h2 class="content-header-title float-left mb-0">جدول عروضي</h2>
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
                                <h4 class="card-title">اخر العروض</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="card-text">
                                    </p>
                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>العرض</th>
                                                <th>الوظيفة</th>
                                                <th>المرتب بالدولار</th>
                                                <th>عدد العروض</th>
                                                <th>التفاصيل</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($bids as $index=>$element)
                                                    <tr>
                                                        <td scope="row">{{ $index +1 }}</td>
                                                        <td>{{ $element->description }}</td>
                                                        <td>{{ $element->job->title }}</td>
                                                        <td>{{ $element->job->salary }} دولار</td>
                                                        <td>{{ count($element->job->bids) }}</td>
                                                        <td>
                                                            @if($element->status == 0)
                                                                <a href="{{ route('employee.jobs.show',$element->id) }}" class="btn btn-success">المزيد</a>
                                                            @elseif($element->status == 1)
                                                                @if($element->job->contract && $element->job->contract->again == 0)
                                                                    @if($element->job->contract->accept == 0)
                                                                        <div class="text-nowrap">
                                                                            <button type="button" class="btn btn-success see_contract"
                                                                                    data-description="{{ $element->job->contract->description }}">
                                                                                الاتفاقية
                                                                            </button>
                                                                            <a href="{{ route('employee.jobs.contracts.accept',$element->job->contract->id) }}" class="btn btn-info">
                                                                                موافقة
                                                                            </a>
                                                                            <button type="button" class="btn btn-primary refuse_contract" data-contract-id="{{ $element->job->contract->id }}">
                                                                                رفض العرض
                                                                            </button>
                                                                        </div>
                                                                    @else
                                                                        <div class="text-nowrap">
                                                                            <button type="button" class="btn btn-success">
                                                                                تم الاتفاق بنجاح
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                @elseif($element->job->contract && $element->job->contract->again == 1)
                                                                    <a href="#" class="btn btn-success">بانتظار عرض جديد</a>
                                                                @endif
                                                            @elseif($element->status == 2)
                                                                <a href="##" class="btn btn-danger disabled">تم الالغاء</a>
                                                            @endif
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
        $('.see_contract').on('click',function (e) {
            e.preventDefault();
            let description = $(this).data('description');
            Swal.fire(description);
        });
        $('.refuse_contract').on('click',async function (e) {
            e.preventDefault();

            let contract_id = $(this).data('contract-id');
            const { value: text } = await Swal.fire({
                input: 'textarea',
                inputPlaceholder: 'سبب رفض العقد للتفاوض مرة اخري ...',
                inputAttributes: {
                    'aria-label': 'سبب رفض العقد للتفاوض مرة اخري ...'
                },
                showCancelButton: true
            });

            if (text) {
                $.ajax({
                    'url' : '{{ route('employee.jobs.contracts.refuse') }}',
                    'method' : 'post',
                    data: {_token: '{{ csrf_token() }}',refusal_details: text,contract_id: contract_id},
                    success : function () {
                        window.location.href = `{{ route('employee.jobs.bids.index') }}`
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
