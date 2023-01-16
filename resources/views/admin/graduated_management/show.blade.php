<x-app-dashboard title="{{ __('Graduated List of') }} {{ $graduated->name }}">
    @section('links')
     <!-- Fixed Data Table -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css') }}">
    @endsection

    <x-slot name="header">
        {{ __('Graduated List of') }} {{ $graduated->name }}
    </x-slot>

    <x-slot name="links">
        <a href="{{ route('graduateds.index') }}" class="btn btn-outline-primary float-right"><i class="fas fa-arrow-circle-left"></i> {{ __('Back') }}</a>
    </x-slot>

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-12 col-md-6">
            <!-- small box -->
            <div class="small-box bg-light border-top border-primary">
                <div class="inner">
                    <h3>{{ $staffs->count() }}</h3>
                    <p>{{ __('Staff') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-nurse"></i>
                </div>
                <a href="{{ route('graduateds.show', $graduated->slug) }}#staffs" class="small-box-footer bg-primary" style="color: #ffffff !important;">{{ __('Show') }} <i class="fas fa-arrow-circle-down"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-12 col-md-6">
            <!-- small box -->
            <div class="small-box bg-light border-top border-primary">
                <div class="inner">
                    <h3>{{ $patients->count() }}</h3>
                    <p>{{ __('Acceptor') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hospital-user"></i>
                </div>
                <a href="{{ route('graduateds.show', $graduated->slug) }}#patients" class="small-box-footer bg-primary" style="color: #ffffff !important;">{{ __('Show') }} <i class="fas fa-arrow-circle-down"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

    <!-- Main Staff -->
    <div class="row" id="staffs">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header align-items-center">
                    <h5 class="float-left mt-2 text-bold d-flex align-items-center"><i class="fas fa-user-nurse mr-2"></i> {{ __('Staffs') }}</h5>
                    <div class="card-tools">
                        <a href="{{ route('staffs.create') }}" class="btn btn-primary">
                        {{ __('Add New Staff') }}  <i class="fas fa-plus-circle"></i>
                        </a>
                        <button type="button" class="btn btn-primary " data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="table-staff" class="table table-bordered table-hover text-nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>{{ __('Employee ID') }}</th>
                                <th>{{ __('Position') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Gender') }}</th>
                                <th class="text-center">{{ __("Account activation") }}</th>
                                <th class="text-center">{{ __("Actions") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($staffs->count() > 0)
                            @foreach ($staffs as $staff)
                            <tr>
                                <td class="text-center" style="width: 15px !important;">{{ $loop->iteration }}</td>
                                <td>#{{ $staff->employe_id }}</td>
                                <td>
                                    {{ $staff->position->name }}
                                </td>
                                <td>
                                    @if ($staff->gender == 'F')
                                        {{ __('Female') }}
                                    @else
                                        {{ __('Male') }}
                                    @endif
                                </td>
                                <td class="fw-500">
                                    {{ $staff->name }}
                                </td>
                                <td class="text-right d-flex align-items-center justify-content-between">
                                    @if($staff->account)
                                        @if($staff->account->status == 'actived')
                                        <i class="fas fa-check-circle text-success text-lg shadow rounded-circle mr-2"></i>
                                        @else
                                        <i class="fas fa-times-circle text-danger text-lg shadow rounded-circle mr-2"></i>
                                        @endif
                                        <small class="d-flex flex-column">
                                            <span>{{ __('Created date') }}</span>
                                            <span>{{ Carbon\Carbon::parse($staff->account->created_at)->translatedFormat('l, d F Y-  h:i:s A') }}</span>
                                        </small>
                                    @else
                                    <div class="text-center mx-auto">
                                        -
                                    </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-show-staff{{ $staff->employe_id }}"><i class="fas fa-eye"></i> {{ __('Show') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.Staff -->
    <!----- Modal Show ---->
    @include('admin.staff_management.partials._modal_show')
    <!----- Modal Edit ---->


    <!-- Main row Patients -->
    <div class="row" id="patients">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header align-items-center">
                    <h5 class="float-left mt-2 text-bold d-flex align-items-center"><i class="fas fa-hospital-user mr-2"></i> {{ __('Acceptors') }}</h5>
                    <div class="card-tools">
                        <a href="{{ route('patients.create') }}" class="btn btn-primary">
                            {{ __('Add New Patient') }} <i class="fas fa-plus-circle"></i>
                        </a>
                        <button type="button" class="btn btn-primary " data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table-patient" class="table table-bordered text-nowrap order-column" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>{{ __('No. Medical records') }}</th>
                                <th>{{ __('Registration Date') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Gender') }}</th>
                                <th class="text-center">{{ __('Age') }}</th>
                                <th>{{ __('Marital Status') }}</th>
                                <th class="text-center">{{ __("Account activation") }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($patients->count() > 0)
                            @foreach ($patients as $patient)
                            <tr>
                                <td class="text-center" style="width: 15px !important;">{{ $loop->iteration }}</td>
                                <td><a href="{{ route('acceptors.index', $patient->no_rm) }}" class="text_rm"> <span class="crash_rm">#</span>{{ $patient->no_rm }}</a></td>
                                <td>
                                    {{ $patient->created_at }}
                                </td>
                                <td>
                                    {{ $patient->name }}
                                </td>
                                <td>
                                    @if ($patient->gender == 'F')
                                        {{ __('Female') }}
                                    @else
                                        {{ __('Male') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($patient->date_brithday)->diff(\Carbon\Carbon::now())->format('%y ' . __('Years') ) }}
                                </td>
                                <td>
                                    @if ($patient->marital_status == 'married')
                                        {{ __('Married') }}
                                    @elseif($patient->marital_status == 'divorced')
                                        {{ __('Divorced') }}
                                    @elseif($patient->marital_status == 'dead_divorced')
                                        {{ __('Dead Divorced') }}
                                    @else
                                        {{ __('Single') }}
                                    @endif
                                </td>
                                <td class="text-right d-flex align-items-center {{ $patient->account ? 'justify-content-between' : 'justify-content-center' }}">
                                    @if($patient->account)
                                    @if($patient->account->status == 'actived')
                                    <i class="fas fa-check-circle text-success text-lg shadow rounded-circle mr-2"></i>
                                    @else
                                    <i class="fas fa-times-circle text-danger text-lg shadow rounded-circle mr-2"></i>
                                    @endif
                                    <small class="d-flex flex-column">
                                        <span>{{ __('Created date') }}</span>
                                        <span>{{ Carbon\Carbon::parse($patient->account->created_at)->translatedFormat('l, d F Y-  h:i:s A') }}</span>
                                    </small>
                                    @else
                                    <div class="text-center">
                                        -
                                    </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-info" href="{{ route('acceptors.index', $patient->no_rm) }}"><i class="fas fa-eye"></i> {{ __('Show') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->


    @section('scripts')
    <script src="{{ asset('plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js') }}"></script>
    <script>
        $("#table-staff").DataTable({
            "responsive": false,
            "lengthChange": true,
            "autoWidth": false,
            "lengthMenu": [[-1, 5, 10, 25, 50 , 100], ["{{ __('All') }}", 5, 10, 25, 50, 100]],
            "order": [],
            "columnDefs": [{
                "targets": [0, 6],
                "orderable": false,
            }],
            "oLanguage": {
                "sSearch": "{{ __('Quick Search') }}",
                "sLengthMenu": "{{ __('DataTableLengthMenu') }}", 
                "sInfo": "{{ __('DataTableInfo') }}",
                "oPaginate": {
                    "sPrevious": "{{ __('Previous') }}", // This is the link to the previous page
                    "sNext": "{{ __('Next') }}", // This is the link to the next page
                },
                "sInfoEmpty": "{{ __('DataTableInfoEmpty') }}",
                "sInfoFiltered" : "{{ __('DataTabelInfoFiltered') }}"
            },
        });

        $("#table-patient").DataTable({
            "scrollX": true,
            "scrollCollapse": true,
            "fixedColumns": {
                leftColumns:2,
                rightColumns:1,
            },
            "responsive": false,
            "lengthChange": true,
            "autoWidth": false,
            "lengthMenu": [[-1, 5, 10, 25, 50 , 100], ["{{ __('All') }}", 5, 10, 25, 50, 100]],
            "order": [],
            "columnDefs": [{
                "targets": [0, 8],
                "orderable": false,
            }],
            "oLanguage": {
                "sSearch": "{{ __('Quick Search') }}",
                "sLengthMenu": "{{ __('DataTableLengthMenu') }}", 
                "sInfo": "{{ __('DataTableInfo') }}",
                "oPaginate": {
                    "sPrevious": "{{ __('Previous') }}", // This is the link to the previous page
                    "sNext": "{{ __('Next') }}", // This is the link to the next page
                },
                "sInfoEmpty": "{{ __('DataTableInfoEmpty') }}",
                "sInfoFiltered" : "{{ __('DataTabelInfoFiltered') }}"
            },
        });
       

    </script>
    @endsection
</x-app-dashboard>