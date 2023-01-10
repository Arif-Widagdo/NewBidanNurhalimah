<x-app-dashboard title="#{{ $patient->no_rm }}">

    <x-slot name="header">
        {{ __('No. Medical records') }} #{{ $patient->no_rm }}
    </x-slot>

    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{ route('patients.index') }}">{{ __('Patient List') }}</a></li>
            <li class="breadcrumb-item active">#{{ $patient->no_rm }}</li>
        </ol>
    </x-slot>

    @include('crew.patient_management.acceptor_management.partials._row_information')

    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body table-responsive p-0 py-4 px-1">
                    <table id="table-patient" class="table table-bordered table-hover text-nowrap">
                        <thead>
                            {{-- <tr>
                                <th colspan="4" rowspan="1">

                                </th>
                                <th colspan="2" class="text-center">
                                    Akibat Penggunaan KB
                                </th>
                                <th colspan="3">

                                </th>
                            </tr> --}}
                            <tr>
                                <th>Tanggal Datang</th>
                                <th>Tanggal Haid Terakhir</th>
                                <th>Berat Badan</th>
                                <th>Tekan Darah</th>
                                <th>Komplikasi Berat</th>
                                <th>Kegagalan</th>
                                <th>{{ __('Birth Controls') }}</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Kunjugan Ulang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($patient->acceptor->count() > 0)
                            @foreach ($patient->acceptor as $acceptor)
                            <tr>
                                <td>
                                    {{ $acceptor->created_at }}
                                </td>
                                <td>
                                    {{ $acceptor->menstrual_date }}
                                </td>
                                <td>
                                    {{ $acceptor->weight }}
                                </td>
                                <td>
                                    {{ $acceptor->blood_pressure }}
                                </td>
                                <td>
                                    {{ $acceptor->complication }}
                                </td>
                                <td>
                                    {{ $acceptor->failure }}
                                </td>
                                <td>
                                    {{ $acceptor->birthControl_id != '' ? $acceptor->birthControl->name : '-' }}
                                </td>
                                <td>
                                    {{ $acceptor->description }}
                                </td>
                                <td>
                                    {{ $acceptor->return_date }}
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
    <script>
       $("#table-patient").DataTable({
            "responsive": false,
            "lengthChange": true,
            "autoWidth": false,
            "lengthMenu": [
                [-1, 5, 10, 25, 50, 100],
                ["{{ __('All') }}", 5, 10, 25, 50, 100]
            ],
            "order": [],
            "columnDefs": [{
                "targets": [],
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
                "sInfoFiltered": "{{ __('DataTabelInfoFiltered') }}"
            },
        });
    </script>
    @endsection
</x-app-dashboard>