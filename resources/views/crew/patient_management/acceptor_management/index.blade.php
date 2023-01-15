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


    <h3 class="font-weight-bold my-4" style="font-family: 'Nunito';">{{ __('Examination Data') }}</h3>
    
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" id="countAcceptor" class="w-100" value="{{ $acceptors->count() }}">
            <div class="card card-primary card-outline">
                <form method="post">
                @method('delete')
                @csrf
                    <div class="card-header align-items-center">
                        <a class="btn btn-danger float-left" id="btn_delete_all" hidden>
                            <i class="fas fa-solid fa-trash-alt"></i> {{ __('Delete All Selected') }}
                        </a>
                        <button formaction="{{ route('acceptor.deleteAll') }}" class="d-none" type="submit" id="form_deleteAll_acceptor">
                            {{ __('Delete All Selected') }}
                        </button>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_create_acceptors">
                            {{ __('Add New Data') }} <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="table-acceptor" class="table table-bordered text-nowrap"  style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th rowspan="2"><input type="checkbox" class="selectall" style="max-width: 15px !important; cursor: pointer;"></th>
                                    <th rowspan="2">{{ __('Coming Date') }}</th>
                                    <th rowspan="2">{{ __('Date of Last Menstruation') }}</th>
                                    <th rowspan="2">{{ __('B Weight') }}</th>
                                    <th rowspan="2">{{ __('Blood Pressure') }}</th>
                                    <th colspan="2">{{ __('Effect') }}</th>
                                    <th rowspan="2">{{ __('Birth Controls') }}</th>
                                    <th rowspan="2">{{ __('Description') }}</th>
                                    <th rowspan="2">{{ __('Return Visit Date') }}</th>
                                    <th rowspan="2">{{ __('Actions') }}</th>
                                </tr>
                                <tr class="text-center">
                                    <th>{{ __('Serious Complications') }}</th>
                                    <th>{{ __('Failure') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($patient->acceptor->count() > 0)
                                @foreach ($acceptors as $acceptor)
                                <tr class="text-center">
                                    <td style="width: 15px !important;"><input type="checkbox" name="ids[]" class="selectbox" value="{{ $acceptor->id }}" style="cursor: pointer;"></td>
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
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-light btn-sm border dropdown-toggle" data-toggle="dropdown" data-offset="-120">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal_edit_acceptors{{ $acceptor->id }}">
                                                {{ __('Edit') }}
                                            </button>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" id="btn_delete_acceptor{{ $loop->iteration }}" style="cursor: pointer">{{ __('Remove') }}</a>
                                                <form method="post" class="d-none">
                                                    @method('delete')
                                                    @csrf
                                                    <button formaction="{{ route('acceptors.destroy', $acceptor->id) }}" class="d-none" id="form_delete_acceptor{{ $loop->iteration }}">
                                                        {{ __('Remove') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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

    <!--- Modal Create -->
    @include('crew.patient_management.acceptor_management.partials.modals._modal_create')
    <!-- /.modal -->

    <!--- Modal Edit -->
    @include('crew.patient_management.acceptor_management.partials.modals._modal_edit')
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

        $("#table-acceptor").DataTable({
            // "scrollY": "300px",  
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
                "targets": [0, 10],
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

        // ----- Aceptors Create
        $('#attendance').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#menstrual').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#returnDate').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#form_create_acceptor').on('submit', function (e) {
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
                    } 
                    else if (data.status == 'notAccept') {
                        Swal.fire({
                            work: 'center',
                            icon: 'info',
                            title: "{{ __('Information') }}",
                            text: data.msg,
                            showConfirmButton: true,
                            confirmButtonColor: '#007BFF',
                        });
                        $('span.return_date_error').text(data.msg);
                        $('input.error_input_return_date').addClass('is-invalid');
                    }
                    else {
                        $('#form_create_acceptor')[0].reset();
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

        // ----- Aceptors Delete
        const countAcceptor = document.querySelector('#countAcceptor');
        for (let i = 1; i <= countAcceptor.value; i++) {
      
            $('#btn_delete_acceptor' + i).on('click', function (e) {
                e.preventDefault();
                swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('You wont be able to revert this') }}",
                    icon: 'warning',
                    iconColor: '#FD7E14',
                    showCancelButton: true,
                    confirmButtonColor: '#007BFF',
                    cancelButtonColor: '#DC3545',
                    confirmButtonText: "{{ __('Yes, deleted it') }}",
                    cancelButtonText: "{{ __('Cancel') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form_delete_acceptor" + i).click();
                    }
                });
            });
            
            $('#attendance_edit'+i).datetimepicker({
                format: 'DD-MM-YYYY'
            });

            $('#menstrual_edit'+i).datetimepicker({
                format: 'DD-MM-YYYY'
            });

            $('#return_date_edit'+i).datetimepicker({
                format: 'DD-MM-YYYY'
            });

            $('#form_edit_acceptor'+i).on('submit', function (e) {
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
                        } 
                        else if (data.status == 'notAccept') {
                            Swal.fire({
                                work: 'center',
                                icon: 'info',
                                title: "{{ __('Information') }}",
                                text: data.msg,
                                showConfirmButton: true,
                                confirmButtonColor: '#007BFF',
                            });
                            $('span.return_date_edit_error').text(data.msg);
                            $('input.error_input_return_date_edit').addClass('is-invalid');
                        }
                        else {
                            $('#form_edit_acceptor'+i)[0].reset();
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
        }

        $('#btn_delete_all').on('click',function(e){
            e.preventDefault();
            swal.fire({
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('You wont be able to revert this') }}",
                icon: 'warning',
                iconColor: '#FD7E14',
                showCancelButton: true,
                confirmButtonColor: '#007BFF',
                cancelButtonColor: '#DC3545',
                confirmButtonText: "{{ __('Yes, deleted it') }}",
                cancelButtonText: "{{ __('Cancel') }}"
            }).then((result) => {
                if (result.isConfirmed){
                    $("#form_deleteAll_acceptor").click();
                }
            });
        });
      

    </script>
    @endsection
</x-app-dashboard>