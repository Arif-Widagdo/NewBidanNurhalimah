<x-app-dashboard title="{{ __('Dashboard') }}">

    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">
                Data Hasil Pemeriksaan
            </li>
        </ol>
    </x-slot>

    @if(auth()->user()->patient)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="table-works" class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2">{{ __('Coming Date') }}</th>
                                <th rowspan="2">{{ __('Date of Last Menstruation') }}</th>
                                <th rowspan="2">{{ __('B Weight') }}</th>
                                <th rowspan="2">{{ __('Blood Pressure') }}</th>
                                <th colspan="2">{{ __('Effect') }}</th>
                                <th rowspan="2">{{ __('Birth Controls') }}</th>
                                <th rowspan="2">{{ __('Description') }}</th>
                                <th rowspan="2">{{ __('Return Visit Date') }}</th>
                            </tr>
                            <tr class="text-center">
                                <th>{{ __('Serious Complications') }}</th>
                                <th>{{ __('Failure') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (auth()->user()->patient->acceptor->sortByDesc('attendance_date') as $acceptor)
                            <tr class="text-center">
                                <td>
                                    {{ Carbon\Carbon::parse($acceptor->attendance_date)->translatedFormat('d F Y') }}
                                </td>
                                <td>
                                    {{ $acceptor->menstrual_date != '' ? Carbon\Carbon::parse($acceptor->menstrual_date)->translatedFormat('d F Y') : '-' }}
                                </td>
                                <td>
                                    {{ $acceptor->weight }}
                                </td>
                                <td>
                                    {{ $acceptor->blood_pressure }}
                                </td>
                                <td>
                                    {{ $acceptor->complication != '' ? $acceptor->complication : '-' }}
                                </td>
                                <td>
                                    {{ $acceptor->failure != '' ? $acceptor->failure : '-' }}
                                </td>
                                <td>
                                    {{ $acceptor->birthControl_id != '' ? $acceptor->birthControl->name : '-' }}
                                </td>
                                <td>
                                    {{ $acceptor->description != '' ? $acceptor->description : '-' }}
                                </td>
                                <td>
                                    {{ $acceptor->return_date != '' ? Carbon\Carbon::parse($acceptor->return_date)->translatedFormat('d F Y') : '-' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
    Tidak Ada BUNG
    @endif
    

    @section('scripts')
    <script>
       
        $("#table-works").DataTable({
            "responsive": false,
            "lengthChange": true,
            "autoWidth": false,
            "lengthMenu": [[-1, 5, 10, 25, 50 , 100], ["{{ __('All') }}", 5, 10, 25, 50, 100]],
            "order": [],
            "columnDefs": [{
                "targets": [0, 2],
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
        });
    </script>
    @endsection


</x-app-dashboard>




