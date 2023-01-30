<x-app-dashboard title="{{ __('User Management') }}">
    @section('links')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    {{--  --}}
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    @endsection

    <x-slot name="header">
        {{ __('List of Users') }}
    </x-slot>
    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">{{ __('User Management') }}</li>
        </ol>
    </x-slot>

    <div class="row d-none">
        <div class="col-12">
            <input type="text" id="countUser" class="w-100" value="{{ $users->count() }}">
        </div>
    </div>

    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <form method="post">
                    @method('delete')
                    @csrf
                    @if($users->count() > 0)
                    <div class="card-body table-responsive">
                        <table id="tabel_users" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>{{ __('Username') }}</th>
                                    <th>{{ __('Email Address') }}</th>
                                    <th>{{ __('Created date') }}</th>
                                    <th class="text-center">{{ __('Positions') }}</th>
                                    <th class="text-center">{{ __('Activation Status') }}</th>
                                    <th class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="text-center" style="width: 15px !important;">{{ $loop->iteration }}</td>
                                    <td class="fw-500">
                                        @if(Str::length($user->username) > 20)
                                            {{ substr( $user->username, 0, 20) }} ...
                                        @else
                                            {{ $user->username }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(Str::length($user->email) > 20)
                                            {{ substr( $user->email, 0, 20) }} ...
                                        @else
                                            {{ $user->email }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ Carbon\Carbon::parse($user->created_at)->translatedFormat('d/m/Y') }}</td>
                                    <td class="text-center">
                                        {{ $user->role->name }}
                                    </td>
                                    <td class="text-center">
                                        @if($user->status == 'actived')
                                        <i class="fas fa-check-circle text-success text-lg shadow rounded-circle" ></i>
                                        @else
                                        <i class="fas fa-times-circle text-danger text-lg shadow rounded-circle"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-light btn-sm border dropdown-toggle" data-toggle="dropdown" data-offset="-120">
                                                 <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    @if($user->staff)
                                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-staff{{ $user->id }}">{{ __('Edit') }}</a>
                                                    @else
                                                        @if ($user->patient)
                                                            <a href="{{ route('acceptors.index', $user->patient->no_rm) }}" class="dropdown-item">{{ __('Show') }}</a>
                                                        @endif
                                                    @endif

                                                    @if($user->staff)
                                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-staff{{ $user->id }}">{{ __('Edit') }}</a>
                                                    @endif
                                                  
                                                  <div class="dropdown-divider"></div>
                                                  <a href="#" class="dropdown-item">{{ __('Remove') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    @endif
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->



    {{-- @include('admin.user_management.partials._modal_show_staff') --}}
    @include('admin.user_management.partials._modal_edit_staff')
   


    @section('scripts')
    <!--- Select 2 --->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    {{--  --}}
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    

    <!-- Customs for pages -->
    <script>
        //fungsi untuk filtering data berdasarkan tanggal 
        var start_date;
        var end_date;
        var DateFilterFunction = (function (oSettings, aData, iDataIndex) {
            var dateStart = parseDateValue(start_date);
            var dateEnd = parseDateValue(end_date);
            //Kolom tanggal yang akan kita gunakan berada dalam urutan 3, karena dihitung mulai dari 0
            //nama depan = 0
            //nama belakang = 1
            //tanggal terdaftar =3
            var evalDate= parseDateValue(aData[3]);
                if ( ( isNaN( dateStart ) && isNaN( dateEnd ) ) ||
                    ( isNaN( dateStart ) && evalDate <= dateEnd ) ||
                    ( dateStart <= evalDate && isNaN( dateEnd ) ) ||
                    ( dateStart <= evalDate && evalDate <= dateEnd ) )
                {
                    return true;
                }
                return false;
        });

        // fungsi untuk converting format tanggal dd/mm/yyyy menjadi format tanggal javascript menggunakan zona aktubrowser
        function parseDateValue(rawDate) {
            var dateArray= rawDate.split("/");
            var parsedDate= new Date(dateArray[2], parseInt(dateArray[1])-1, dateArray[0]);  // -1 because months are from 0 to 11   
            return parsedDate;
        }    

        $( document ).ready(function() {
        //konfigurasi DataTable pada tabel dengan id tabel_users dan menambahkan  div class dateseacrhbox dengan dom untuk meletakkan inputan daterangepicker
        var $dTable = $('#tabel_users').DataTable({
            "responsive": false,
            "lengthChange": true,
            "buttons": [ 'copy', 'excel', 'pdf', 'colvis' ],
            "autoWidth": false,
            "lengthMenu": [
                [-1, 5, 10, 25, 50],
                ["{{ __('All') }}", 5, 10, 25, 50]
            ],
            "order": [],
            "columnDefs": [{
                "targets": [0, 5],
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
            "dom": "<'row'<'col-lg-4'l><'col-lg-4 mb-2' <'datesearchbox'>><'col-lg-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        });

        // dTable.buttons().container().appendTo( '#tabel_users_wrapper .col-md-6:eq(0)' )
           
        // $('#tabel_users').append('<buttons style="caption-side: bottom">A fictional company\'s staff table.</buttons>');
 


        //menambahkan daterangepicker di dalam datatables
        $("div.datesearchbox").html('<div class="input-group"><input type="text" class="form-control pull-right" id="datesearch" placeholder="{{ __('Search by date range') }}"> <div class="input-group-append"> <div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div>');

        document.getElementsByClassName("datesearchbox")[0].style.textAlign = "right";

        //konfigurasi daterangepicker pada input dengan id datesearch
        $('#datesearch').daterangepicker({
            autoUpdateInput: false
            });

            //menangani proses saat apply date range
            $('#datesearch').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            start_date=picker.startDate.format('DD/MM/YYYY');
            end_date=picker.endDate.format('DD/MM/YYYY');
            $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
            $dTable.draw();
            });

            $('#datesearch').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            start_date='';
            end_date='';
            $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
            $dTable.draw();
            });
        });

        $('#form_create_user').on('submit', function (e) {
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
                            $('#'+ prefix +' + span').addClass("is-invalid");
                        });
                        alertToastInfo(data.msg)
                    } else {
                        $('#form_create_user')[0].reset();
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


        const countUser = document.querySelector('#countUser');

        for (let i = 1; i <= countUser.value; i++) {
            $('#btn_delete'+i).on('click',function(e){
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
                        $("#form_delete_user"+i).click();
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
                    $("#form_deleteAll_user").click();
                }
            });
        });

    </script>
    @endsection
</x-app-dashboard>