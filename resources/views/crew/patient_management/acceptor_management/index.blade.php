<x-app-dashboard title="#{{ $patient->no_rm }}">
    @section('links')
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
     <!-- Data Range -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css') }}">

    {{-- <style>
        .td_row{
            vertical-align: middle !important;
        }
    </style> --}}
    {{-- <style>
          th, td { white-space: nowrap; }
    </style> --}}

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


    <h4 class="font-weight-bold" style="font-family: 'Nunito';">Data Pemeriksaan</h4>
    
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header align-items-center">
                    <a class="btn btn-danger float-left" id="btn_delete_all" hidden>
                        <i class="fas fa-solid fa-trash-alt"></i> {{ __('Delete All Selected') }}
                    </a>
                    <button formaction="" class="d-none" type="submit" id="form_deleteAll_Staff">
                        {{ __('Delete All Selected') }}
                    </button>
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_create_acceptors">
                        Tambah Data <i class="fas fa-plus-circle"></i>
                    </button>
                </div>
                <div class="card-body ">
                    <table id="table-patient" class="table table-bordered text-nowrap"  style="width:100%">
                        <thead>
                            <tr>
                                <th rowspan="2">Tanggal Datang</th>
                                <th rowspan="2">Tanggal Haid Terakhir</th>
                                <th rowspan="2">Berat Badan</th>
                                <th colspan="2" class="text-center">Akibat</th>
                                <th rowspan="2">Kegagalan</th>
                                <th rowspan="2">{{ __('Birth Controls') }}</th>
                                <th rowspan="2">Deskripsi</th>
                                <th rowspan="2">Tanggal Kunjugan Ulang</th>
                            </tr>
                            <tr>
                                <th>Komplikasi Berat</th>
                                <th>Kegagalan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($patient->acceptor->count() > 0)
                            @foreach ($acceptors as $acceptor)
                            <tr>
                                <td>
                                    {{ $acceptor->attendance_date }}
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

    <!--- Modal Create -->
    <div class="modal fade" id="modal_create_acceptors">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title"><i class="fas fa-pencil-alt"></i> {{ __('New Form of Staff Position') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="POST" action="" id="form_create_position">
                    @csrf
                    <div class="modal-body">
                        <div class="border-bottom text-danger mb-4" style="border-color: #007BFF !important">
                            {{ __('* required fileds') }}
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="inputDateBrithday" class="col-md-3 col-form-label">
                                {{ __('Date of Birthday') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input error_input_date_brithday" placeholder="{{ __('Enter your Date of Birth') }}" data-target="#reservationdate" value="" name="date_brithday">
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <span class="text-danger error-text date_brithday_error"></span>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="inputDateBrithday" class="col-md-3 col-form-label">
                                Tanggal Haid Terakhir <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input error_input_date_brithday" placeholder="{{ __('Enter your Date of Birth') }}" data-target="#reservationdate" value="" name="date_brithday">
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <span class="text-danger error-text date_brithday_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-md-3 col-form-label ">
                                Berat Badan <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control error_input_name" id="inputName" placeholder="{{ __('Enter') }} {{ __('Full Name') }}" name="name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-md-3 col-form-label ">
                                Tekanan Darah <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control error_input_name" id="inputName" placeholder="{{ __('Enter') }} {{ __('Full Name') }}" name="name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-md-3 col-form-label ">
                                Komplikasi Berat <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control error_input_name" id="inputName" placeholder="{{ __('Enter') }} {{ __('Full Name') }}" name="name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-md-3 col-form-label ">
                                Kegagalan <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control error_input_name" id="inputName" placeholder="{{ __('Enter') }} {{ __('Full Name') }}" name="name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <!-------- Job Status Couple Create ----->
                        <div class="form-group row">
                            <label for="work_id" class="col-md-3 col-form-label">
                                Cara KB <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control select2" style="width: 100%;" name="work_id" id="work_id">
                                    <option selected="selected" disabled >{{ __('Select Job Status') }}</option>
                                    @foreach ($birthControls as $birthControl)
                                        <option value="{{ $birthControl->id }}">{{ $birthControl->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text work_id_error"></span>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="inputDateBrithday" class="col-md-3 col-form-label">
                                Tanggal Kunjungan Ulang <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input error_input_date_brithday" placeholder="{{ __('Enter your Date of Birth') }}" data-target="#reservationdate" value="" name="date_brithday">
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <span class="text-danger error-text date_brithday_error"></span>
                            </div>
                        </div>
                        <!-------- Address Couple Create ----->
                        <div class="form-group row">
                            <label for="InputAddress" class="col-md-3 col-form-label">
                                keterangan <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <textarea class="d-none" id="inputAddressCouple1">{{ $patient->address }}</textarea>
                                <textarea class="form-control error_input_address" id="inputAddressCouple2" name="address" cols="30" rows="2" placeholder="{{ __('Enter') }} {{ __('Address') }}"></textarea>
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->




    

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
    <script src="{{ asset('plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js') }}"></script>
    
 
    <script>
        $('.select2').select2();

        $('#reservationdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#reservationdate_edit_couple').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#sameAddress').change(function() {
            if (this.checked) {
                document.getElementById("inputAddressCouple2").value = document.getElementById("inputAddressCouple1").value;
            } else{
                document.getElementById("inputAddressCouple2").value = ''
            }
        });

        $("#table-patient").DataTable({
            // "scrollY": "300px",  
            "scrollX": true,
            "scrollCollapse": true,
            "fixedColumns": {
                leftColumns:1,
                rightColumns:1,
            },
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

       
        $('#form_create_couple_edit').on('submit', function (e) {
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
                        $('#form_create_couple_edit')[0].reset();
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