<x-app-dashboard title="{{ __('Dashboard') }}">
    @section('links')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css') }}">
    @endsection

    <x-slot name="header">
        {{ __('Visit Result Data') }}
    </x-slot>
    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">
               
            </li>
        </ol>
    </x-slot>

    {{-- @if($return_date)
        <div class="modal fade" id="modal_return_date">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header
                    @if($return_date->return_date == Date("Y-m-j") )
                    bg-warning
                    @elseif($return_date->return_date < Date("Y-m-j"))
                    bg-danger
                    @else
                    bg-info
                    @endif
                    ">
                        <h5 class="modal-title"><i class="icon fas fa-info"></i> Informasi Kunjugan Kembali!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if($return_date->return_date == Date("Y-m-j") )
                        <p>
                            Waktu kunjungan kembali kamu telah tiba, ayo segera datang ke Bidan Nurhalimah untuk melakukan pemeriksaan dengan tepat waktu pada waktu pada hari ini <span class="text-bold">{{ Carbon\Carbon::parse($return_date->return_date)->translatedFormat('d F Y') }}</span>
                        </p>
                        @elseif($return_date->return_date < Date("Y-m-j"))
                        <p>
                            Waktu kunjungan kembali kamu yang telah ditetapkan pada <span class="text-bold">{{ Carbon\Carbon::parse($return_date->return_date)->translatedFormat('d F Y') }}</span> telah melewati waktu sekarang, ayo segera datang ke Bidan Nurhalimah untuk melakukan pemeriksaan.
                        </p>
                        @else
                        <p>
                            Terima kasih telah mengikuti program akseptor di Bidan Nurhalimah, <br>
                            untuk memastikan Alat/Obat yang digunakan berjalan dengan baik, silahkan silahkan kunjungi kembali Bidan Nurhalimah untuk melakukan pemeriksaan dengan tepat waktu pada waktu <span class="text-bold">{{ Carbon\Carbon::parse($return_date->return_date)->translatedFormat('d F Y') }}</span> yang telah ditentukan
                        </p>
                        @endif
                       
                    </div>
                </div>
            </div>
        </div>
    @endif --}}

    <div class="row">
        <div class="col-12">
            <div class="alert alert-dismissible
            @if($return_date->return_date == Date("Y-m-j") )
            alert-warning
            @elseif($return_date->return_date < Date("Y-m-j"))
            alert-danger
            @else
            alert-info
            @endif
            ">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5 class="text-bold"><i class="icon fas fa-info"></i> Informasi Kunjugan Kembali!</h5>
                @if($return_date->return_date == Date("Y-m-j") )
                    <p>
                        Waktu kunjungan kembali kamu telah tiba, ayo segera datang ke Bidan Nurhalimah untuk melakukan pemeriksaan dengan tepat waktu pada waktu pada hari ini <span class="text-bold"{{ Carbon\Carbon::parse($return_date->return_date)->translatedFormat('d F Y') }}</span>
                    </p>
                    @elseif($return_date->return_date < Date("Y-m-j"))
                    <p>
                        Waktu kunjungan kembali kamu yang telah ditetapkan pada <span class="text-bold">{{Carbon\Carbon::parse($return_date->return_date)->translatedFormat('d F Y') }}</span> telah melewati waktu sekarang, ayo segera datang ke Bidan Nurhalimah untuk melakukan pemeriksaan.
                    </p>
                    @else
                    <p>
                        Terima kasih telah mengikuti program akseptor di Bidan Nurhalimah, <br>
                        untuk memastikan Alat/Obat yang digunakan berjalan dengan baik, silahkan silahkan kunjungikembali Bidan Nurhalimah untuk melakukan pemeriksaan dengan tepat waktu pada <span class="text-bold">{{ Carbon\Carbon::parse($return_date->return_date)->translatedFormat('d F Y') }}</span> yang telah ditentukan
                    </p>
                @endif
            </div>
        </div>
    </div>


    @if(auth()->user()->patient)
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <a href="{{ route('patient.print', auth()->user()->patient->no_rm) }}" 
                        rel="noopener" target="_blank" 
                        class="btn btn-primary float-right">
                        <i class="fas fa-print"></i> {{ __('Print') }}
                    </a>
                </div>
                <div class="card-body">
                    <table id="table-works" class="table table-bordered text-nowrap"  style="width:100%">
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
                                    {{ $acceptor->birth_control_id != '' ? $acceptor->birthControl->name : '-' }}
                                </td>
                                <td>
                                    {{ $acceptor->description != '' ? $acceptor->description : '-' }}
                                </td>
                                <td @if(Date("Y-m-j") ==  $acceptor->return_date) class="bg-warning" @endif>
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
    @endif
    

    @section('scripts')
    @if($return_date)
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#modal_return_date').modal('show');
            });
        </script>
    @endif
    
    <script src="{{ asset('plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js') }}"></script>
    <script>


       
        $("#table-works").DataTable({
            "scrollX": true,
            "scrollCollapse": true,
            "fixedColumns": {
                leftColumns:1,
                rightColumns:1,
            },
            "responsive": false,
            "lengthChange": true,
            "autoWidth": false,
            "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100,"{{ __('All') }}"]],
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

        // $("#table-acceptor").DataTable({
        //     // "scrollY": "300px",  
        //     "scrollX": true,
        //     "scrollCollapse": true,
        //     "fixedColumns": {
        //         leftColumns:2,
        //         rightColumns:1,
        //     },
        //     "responsive": false,
        //     "lengthChange": true,
        //     "autoWidth": false,
        //     "lengthMenu": [[-1, 5, 10, 25, 50 , 100], ["{{ __('All') }}", 5, 10, 25, 50, 100]],
        //     "order": [],
        //     "columnDefs": [{
        //         "targets": [0, 10],
        //         "orderable": false,
        //     }],
        //     "oLanguage": {
        //         "sSearch": "{{ __('Quick Search') }}",
        //         "sLengthMenu": "{{ __('DataTableLengthMenu') }}", 
        //         "sInfo": "{{ __('DataTableInfo') }}",
        //         "oPaginate": {
        //             // "sFirst": "First page", // This is the link to the first page
        //             "sPrevious": "{{ __('Previous') }}", // This is the link to the previous page
        //             "sNext": "{{ __('Next') }}", // This is the link to the next page
        //             // "sLast": "Last page" // This is the link to the last page
        //         },
        //         "sInfoEmpty": "{{ __('DataTableInfoEmpty') }}",
        //         "sInfoFiltered" : "{{ __('DataTabelInfoFiltered') }}"
        //     },
        // });
    </script>
    @endsection


</x-app-dashboard>




