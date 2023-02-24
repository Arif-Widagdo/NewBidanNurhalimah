<x-app-dashboard title="{{ __('This weeks list of acceptors') }}">

    @section('links')
    <!-- Fixed Data Table -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css') }}">
    @endsection

    <x-slot name="header">
        {{ __('This weeks list of acceptors') }}
    </x-slot>
    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">{{ __('This weeks list of acceptors') }}</li>
        </ol>
    </x-slot>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <table id="table-patient" class="table table-bordered text-nowrap order-column" style="width:100%">
                        <thead>
                            <tr>
                                <th>{{ __('No. Medical records') }}</th>
                                <th>{{ __('Return Visit Date') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Gender') }}</th>
                                <th class="text-center">{{ __('Age') }}</th>
                                <th>{{ __('Marital Status') }}</th>
                                <th class="text-center">{{ __("Account activation") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($patients->count() > 0)
                            @foreach ($patients as $patient)
                            <tr>
                                <td><a href="{{ route('acceptors.index', $patient->no_rm) }}" target="_blank" class="text_rm"> <spanclass="crash_rm">#</spanclass=>{{ $patient->no_rm }}</a></td>
                                <td>
                                    @foreach ($patient->acceptor->whereBetween('return_date', [date('Y-m-d'), Carbon\Carbon::now()->addDay(7)])->sortBy('return_date') as $acceptor)
                                        {{ $acceptor->return_date != '' ? Carbon\Carbon::parse($acceptor->return_date)->translatedFormat('d F Y') : '-' }}
                                        <br>
                                    @endforeach
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
                                    {{ \Carbon\Carbon::parse($patient->date_brithday)->diff(\Carbon\Carbon::now())->format('%y ' . _('Years') ) }}
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
                                <td class="text-right d-flex align-items-center {{ $patient->account ? 'justify-content-between' :'justify-content-center' }}">
                                    @if($patient->account)
                                    @if($patient->account->status == 'actived')
                                    <i class="fas fa-check-circle text-success text-lg shadow rounded-circle mr-2"></i>
                                    @else
                                    <i class="fas fa-times-circle text-danger text-lg shadow rounded-circle mr-2"></i>
                                    @endif
                                    <small class="d-flex flex-column">
                                        <span>{{ __('Created date') }}</span>
                                        <span>
                                            {{ $patient->account->created_at != '' ? Carbon\Carbon::parse($patient->account->created_at)->translatedFormat('d F Y h:i a') : '-' }}
                                        </span>
                                    </small>
                                    @else
                                    <div class="text-center">
                                        -
                                    </div>
                                    @endif
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

    @section('scripts')
    <!-- Fixed Data Table -->
    <script src="{{ asset('plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js') }}"></script>
    <script>
        var t = $("#table-patient").DataTable({
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
            "order": [[1, 'asc']],
            "columnDefs": [{
                "targets": [0],
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
            "buttons": [{
                    "extend": 'copy',
                    "title": "{{ __('Acceptor List') }}",
                    "exportOptions": {
                        "columns": [2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    "extend": 'excel',
                    "title": "{{ __('Acceptor List') }}",
                    "exportOptions": {
                        "columns": [2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    "extend": 'print',
                    "title": "{{ __('Acceptor List') }}",
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
