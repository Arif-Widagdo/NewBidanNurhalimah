<x-app-dashboard title="{{ __('Staff List') }}">
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

    <x-slot name="header">
        {{ __('Staff List') }}
    </x-slot>

    <div class="row d-none">
        <div class="col-12">
            <input type="text" id="countStaff" class="w-100" value="{{ $staffs->count() }}">
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
                        <button formaction="{{ route('admin.staff.deleteAll') }}" class="d-none" type="submit" id="form_deleteAll_Staff">
                            {{ __('Delete All Selected') }}
                        </button>
                        <a href="{{ route('staffs.create') }}" class="btn btn-primary float-right">
                            {{ __('Add New Staff') }}  <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="table-staff" class="table table-bordered table-hover text-nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" class="selectall" style="max-width: 15px !important; cursor: pointer;"></th>
                                    <th>{{ __('Employee ID') }}</th>
                                    <th>{{ __('Position') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Gender') }}</th>
                                    <th class="text-center">{{ __("Account activation") }}</th>
                                    <th class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($staffs->count() > 0)
                                @foreach ($staffs as $staff)
                                <tr>
                                    <td class="text-center" style="width: 15px !important;"><input type="checkbox" name="ids[]" class="selectbox" value="{{ $staff->id }}" style="cursor: pointer;"></td>
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
                                                <span>{{ $staff->account->created_at }}</span>
                                            </small>
                                        @else
                                        <div class="text-center mx-auto">
                                            -
                                        </div>
                                        @endif
                                    </td>
                                   
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-light btn-sm border dropdown-toggle" data-toggle="dropdown" data-offset="-120">
                                             <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                              <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-show-staff{{ $staff->employe_id }}">{{ __('Show') }}</a>
                                              <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-staff{{ $staff->employe_id }}">{{ __('Edit') }}</a>
                                              <div class="dropdown-divider"></div>
                                              <a class="dropdown-item" id="btn_delete_staff{{ $loop->iteration }}" style="cursor: pointer">{{ __('Remove') }}</a>
                                                <form method="post" class="d-none">
                                                    @method('delete')
                                                    @csrf
                                                    <button formaction="{{ route('staffs.destroy', $staff->employe_id) }}" class="d-none" id="form_delete_staff{{ $loop->iteration }}">
                                                        {{ __('Remove') }} <i class="fas fa-solid fa-trash-alt ml-2"></i>
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

    <!----- Modal Show ---->
    @include('admin.staff_management.partials._modal_show')
    
    
    <!----- Modal Edit ---->
    @include('admin.staff_management.partials._modal_edit')




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
        
        $("#table-staff").DataTable({
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
                "targets": [0, 6],
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
                    "title": "{{ __('Staff List') }}",
                    "exportOptions": {
                        "columns": [1, 2, 3, 4, 5]
                    }
                },
                {
                    "extend": 'excel',
                    "title": "{{ __('Staff List') }}",
                    "exportOptions": {
                        "columns": [1, 2, 3, 4, 5]
                    }
                },
                {
                    "extend": 'print',
                    "title": "{{ __('Staff List') }}",
                    "exportOptions": {
                        "columns": [1, 2, 3, 4, 5]
                    }
                },
                "colvis"
            ]
        }).buttons().container().appendTo('#table-staff_wrapper .col-md-6:eq(0)');

        $('.select2').select2();

       

        const countStaff = document.querySelector('#countStaff');
        for (let i = 1; i <= countStaff.value; i++) {

            $('#reservationdate'+i).datetimepicker({
                format: 'DD-MM-YYYY'
            });

            $('#form_edit_staff' + i).on('submit', function (e) {
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
                                $('#'+ prefix + i+' + span').addClass("is-invalid");
                            });
                            alertToastInfo(data.msg)
                        } else if (data.status == 'notAccept') {
                            Swal.fire({
                                position: 'center',
                                icon: 'info',
                                title: "{{ __('Information') }}",
                                text: data.msg,
                                showConfirmButton: true,
                                confirmButtonColor: '#007BFF',
                            });
                            $('span.date_brithday_error').text("{{ __('Hes not yet 10 years old, you cant enter the data wrong, right?') }}");
                            $('input.error_input_date_brithday').addClass('is-invalid');
                        } else {
                            $('#form_edit_staff' + i)[0].reset();
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

            $('#btn_delete_staff' + i).on('click', function (e) {
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
                        $("#form_delete_staff" + i).click();
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
                    $("#form_deleteAll_Staff").click();
                }
            });
        });
    </script>
    @endsection
</x-app-dashboard>