<x-app-dashboard title="#{{ $patient->no_rm }}">
    @section('links')
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
     <!-- Data Range -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    @endsection

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
     <!-- Select 2 -->
     <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
     <!-- date-range-picker -->
     <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
     <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
     <!-- date-range-picker -->
     <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
     <!-- Tempusdominus Bootstrap 4 -->
     <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
     <!-- Bootstrap Switch -->
     <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
   
 
    <script>
        $('.select2').select2();

        $('#reservationdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });

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

        $('#form_create_couple').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(document).find('span.error-text').text('');
                },
                success: function (data) {
                    if (data.status == 0) {
                        $.each(data.error, function (prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('input.error_input_' + prefix).addClass('is-invalid');
                            $('select.error_input_' + prefix).addClass('is-invalid');
                            $('textarea.error_input_' + prefix).addClass('is-invalid');
                            $('#'+ prefix +' + span').addClass("is-invalid");
                        });
                        alertToastInfo(data.msg)
                    } else if (data.status == 'notAccept') {
                        Swal.fire({
                            work: 'center',
                            icon: 'info',
                            title: "{{ __('Information') }}",
                            text: data.msg,
                            showConfirmButton: true,
                            confirmButtonColor: '#007BFF',
                        });
                        $('span.date_brithday_error').text("{{ __('Hes not yet 17 years old, you cant enter the data wrong, right?') }}");
                        $('input.error_input_date_brithday').addClass('is-invalid');
                    }else {
                        $('#form_create_couple')[0].reset();
                        setTimeout(function () {
                            location.reload(true);
                        }, 1000);
                        alertToastSuccess(data.msg)
                    }
                },
                error: function (xhr) {
                    Swal.fire(xhr.statusText, '{{ __('Wait a few minutes to try again ') }}', 'error')
                }
            });
        });

       
      

    </script>
    @endsection
</x-app-dashboard>