<x-app-dashboard title="{{ app()->getLocale() == 'id' ? __('User kb List').' '.$birthControl->name  :  $birthControl->name.' '.__('User kb List') }}">
    @section('links')
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
     <!-- Data Range -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
     <!-- Fixed Data Table -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css') }}">
    @endsection

    <style>
        .text_rm {
            text-decoration: underline;
        } 
        .text_rm:hover .crash_rm{
            color: #5A5A5A;
        }
    </style>

    <x-slot name="header">
        {{ app()->getLocale() == 'id' ? __('User kb List').' '.$birthControl->name  :  $birthControl->name.' '.__('User kb List') }}
    </x-slot>

    <x-slot name="links">
        <a href="{{ route('birth-controls.index') }}" class="btn btn-outline-primary float-right"><i class="fas fa-arrow-circle-left"></i> {{ __('Back') }}</a>
    </x-slot>

    <div class="row d-none">
        <div class="col-12">
            <input type="text" id="countPatient" class="w-100" value="{{ $acceptors->count() }}">
        </div>
    </div>


    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <form method="post">
                    @method('delete')
                    @csrf
                    <div class="card-header align-items-center">
                        <a class="btn btn-danger float-left" id="btn_delete_all" hidden>
                            <i class="fas fa-solid fa-trash-alt"></i> {{ __('Delete All Selected') }}
                        </a>
                        <button formaction="{{ route('patient.deleteAll') }}" class="d-none" type="submit" id="form_deleteAll_Staff">
                            {{ __('Delete All Selected') }}
                        </button>
                        <a href="{{ route('patients.create') }}" class="btn btn-primary float-right">
                            {{ __('Add New Patient') }} <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="table-patient" class="table table-bordered text-nowrap order-column" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" class="selectall" style="max-width: 15px !important; cursor: pointer;"></th>
                                    <th>{{ __('No. Medical records') }}</th>
                                    <th>{{ __('Registration Date') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Gender') }}</th>
                                    <th class="text-center">{{ __('Age') }}</th>
                                    <th>{{ __('Marital Status') }}</th>
                                    <th class="text-center">{{ __("Account activation") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($acceptors->count() > 0)
                                @foreach ($acceptors as $key => $value)
                                @foreach ($patients->where('id', $key) as $acceptor)
                                <tr>
                                    <td class="text-center" style="width: 15px !important;"><input type="checkbox" name="ids[]" class="selectbox" value="{{ $acceptor->id }}" style="cursor: pointer;"></td>
                                    <td><a href="{{ route('acceptors.index', $acceptor->no_rm) }}" target="_blank" class="text_rm"> <span class="crash_rm">#</span>{{ $acceptor->no_rm }}</a></td>
                                    <td>{{ $acceptor->created_at }}</td>
                                    <td>{{ $acceptor->name }}</td>
                                    <td>
                                        @if ($acceptor->gender == 'F')
                                            {{ __('Female') }}
                                        @else
                                            {{ __('Male') }}
                                        @endif
                                    </td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($acceptor->date_brithday)->diff(\Carbon\Carbon::now())->format('%y ' . __('Years') ) }}</td>
                                    <td>
                                        @if ($acceptor->marital_status == 'married')
                                            {{ __('Married') }}
                                        @elseif($acceptor->marital_status == 'divorced')
                                            {{ __('Divorced') }}
                                        @elseif($acceptor->marital_status == 'dead_divorced')
                                            {{ __('Dead Divorced') }}
                                        @else
                                            {{ __('Single') }}
                                        @endif
                                    </td>
                                    <td class="text-right d-flex align-items-center {{ $acceptor->account ? 'justify-content-between' : 'justify-content-center' }}">
                                        @if($acceptor->account)
                                        @if($acceptor->account->status == 'actived')
                                        <i class="fas fa-check-circle text-success text-lg shadow rounded-circle mr-2"></i>
                                        @else
                                        <i class="fas fa-times-circle text-danger text-lg shadow rounded-circle mr-2"></i>
                                        @endif
                                        <small class="d-flex flex-column">
                                            <span>{{ __('Created date') }}</span>
                                            <span>{{ Carbon\Carbon::parse($acceptor->account->created_at)->translatedFormat('l, d F Y-  h:i:s A') }}</span>
                                        </small>
                                        @else
                                        <div class="text-center">
                                            -
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->


    @section('scripts')
    <!-- Select 2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Fixed Data Table -->
    <script src="{{ asset('plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js') }}"></script>

    <script>
        $("#table-patient").DataTable({
            // "scrollY": "300px",  
            "scrollX": true,
            "scrollCollapse": true,
            "fixedColumns": {
                leftColumns:2,
            },
            "responsive": false,
            "lengthChange": true,
            "autoWidth": false,
            "lengthMenu": [[-1, 5, 10, 25, 50 , 100], ["{{ __('All') }}", 5, 10, 25, 50, 100]],
            "order": [],
            "columnDefs": [{
                "targets": [0, 7],
                "orderable": false,
            }],
            "oLanguage": {
                "sSearch": "{{ __('Quick Search') }}",
                "sLengthMenu": "{{ __('DataTableLengthMenu') }}", 
                "sInfo": "{{ __('DataTableInfo') }}",
                "oPaginate": {
                    // "sFirst": "First page", // This is the link to the first page
                    "sPrevious": "{{ __('Previous') }}", // This is the link to the previous page
                    "sNext": "{{ __('Next') }}", // This is the link to the next page
                    // "sLast": "Last page" // This is the link to the last page
                },
                "sInfoEmpty": "{{ __('DataTableInfoEmpty') }}",
                "sInfoFiltered" : "{{ __('DataTabelInfoFiltered') }}"
            },
            "buttons": [{
                    "extend": 'copy',
                    "title": "{{ app()->getLocale() == 'id' ? __('User kb List').' '.$birthControl->name  :  $birthControl->name.' '.__('User kb List') }}",
                    "exportOptions": {
                        "columns": [2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    "extend": 'excel',
                    "title": "{{ app()->getLocale() == 'id' ? __('User kb List').' '.$birthControl->name  :  $birthControl->name.' '.__('User kb List') }}",
                    "exportOptions": {
                        "columns": [2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    "extend": 'print',
                    "title": "{{ app()->getLocale() == 'id' ? __('User kb List').' '.$birthControl->name  :  $birthControl->name.' '.__('User kb List') }}",
                    "exportOptions": {
                        "columns": [2, 3, 4, 5, 6, 7]
                    }
                },
                "colvis"
            ]
        }).buttons().container().appendTo('#table-patient_wrapper .col-md-6:eq(0)');

  
    

        
    </script>
    @endsection
</x-app-dashboard>