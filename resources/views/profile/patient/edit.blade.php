<x-app-dashboard title="{{ __('Profile') }}">
    @section('links')
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Ijabo Crop Tool -->
    <link rel="stylesheet" href="{{ asset('plugins/ijabo-crop-tool/ijaboCropTool.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
     <!-- Data Range -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    @endsection
   
    <x-slot name="header">
        {{ __('Profile') }}
    </x-slot>

    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Profile') }}</li>
        </ol>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card card-widget widget-user-2 card-outline card-primary">
                <div class="widget-user-header elevation-1">
                    <div class="row" style="position: relative !important;">
                        <div class="widget-user-image ">
                            <img class="img-circle elevation-2 user_picture" src="{{ auth()->user()->picture }}"  alt="{{ auth()->user()->username }}">
                        </div>
                        <div class="btn-group" style="position: absolute !important; right:0 !important; top:0;">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" title="{{ __('Change Picture') }}" data-placement="right">
                                <i class="fas fa-pen mr-1"></i>
                                <span class="sr-only">{{ __('Change Picture') }}</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <input type="file" name="user_image" id="user_image" accept="image/png, image/gif, image/jpeg" style="opacity:0;height:1px;display:none">
                                <a href="javascript:void(0)" id="change_picture_btn" class="dropdown-item"><i class="fas fa-user-edit mr-1"></i><span>{{ __('Change Picture') }}</span></a>
                                <a href="{{ route('profile.edit') }}#change_password_row" class="dropdown-item"><i class="fas fa-lock mr-1"></i><span>{{ __('Change Password') }}</span></a>
                                @if(auth()->user()->picture != Url('dist/img/users/no-image.jpeg'))
                                <a id="btn_delete_picture" class="dropdown-item" href="#">
                                    <i class="fas fa-solid fa-trash mr-2"></i><span>{{ __('Delete Picture') }}</span>
                                </a>
                                <form action="" method="post" class="d-inline" id="deleted-picture">
                                    @csrf
                                    @method('patch')
                                    <button class="d-none" id="form_delete_picture">
                                        <i class="fas fa-solid fa-trash mr-2"></i><span>{{ __('Delete Picture') }}</span>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex flex-column ml-2">
                            <div class="d-flex align-items-center justify-between">
                                <h3 class="name_user mr-2 mt-1">
                                    {{ auth()->user()->username }}
                                </h3>
                                @if(auth()->user()->staff->position->slug === 'admin')
                                <small class=" badge badge-info">
                                    {{ __('Admin') }}
                                </small>
                                @else
                                <small class=" badge badge-info">
                                    {{ __('Staff') }}
                                </small>
                                @endif
                            </div>
                            <p class="user_email" style="margin-top: -10px !important">{{ auth()->user()->email }} </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-group list-group-unbordered " style="list-style-type: none;">
                                <li class="d-flex flex-column flex-lg-row align-items-center">
                                    <p class="col-lg-5 border-right">{{ __('Name') }}</p>
                                    <p class="col-lg-7 text-bold">
                                        {{ auth()->user()->staff->name != '' ? auth()->user()->staff->name : '-' }}
                                    </p>
                                </li>
                                <li class="d-flex flex-column flex-lg-row align-items-center">
                                    <p class="col-lg-5 border-right">{{ __('Gender') }}</p>
                                    <p class="col-lg-7 text-bold ">
                                        @if(auth()->user()->staff->gender == 'M')
                                        {{ __('Male') }}
                                        @elseif(auth()->user()->staff->gender == 'F')
                                        {{ __('Female') }}
                                        @else
                                        -
                                        @endif
                                    </p>
                                </li>
                                <li class="d-flex flex-column flex-lg-row align-items-center">
                                    <p class="col-lg-5 border-right">{{ __('Place and date of birth') }}</p>
                                    <p class="col-lg-7 text-bold">
                                        {{  auth()->user()->staff->place_brithday && auth()->user()->staff->date_brithday != '' ? auth()->user()->staff->place_brithday.', '.auth()->user()->staff->date_brithday   : '-'  }}
                                    </p>
                                </li>
                                <li class="d-flex flex-column flex-lg-row align-items-center">
                                    <p class="col-lg-5 border-right">{{ __('Age') }}</p>
                                    <p class="col-lg-7 text-bold "> {{ auth()->user()->date_brithday != '' ? $age.' '.__('Year Old') : '-' }} </p>
                                </li>
                                <li class="d-flex flex-column flex-lg-row align-items-center">
                                    <p class="col-lg-5 border-right">{{ __('Address') }}</p>
                                    <p class="col-lg-7 text-bold ">
                                        {{ auth()->user()->staff->address != '' ? auth()->user()->staff->address : '-' }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-group list-group-unbordered " style="list-style-type: none;">
                                <li class="d-flex flex-column flex-lg-row align-items-center ">
                                    <p class="col-lg-5 border-right">{{ __('Username') }}</p>
                                    <p class="col-lg-7 text-bold ">
                                        {{ auth()->user()->staff->username != '' ? auth()->user()->staff->username : '-' }}
                                    </p>
                                </li>
                                <li class="d-flex flex-column flex-lg-row align-items-center">
                                    <p class="col-lg-5 border-right">{{ __('Number Phone') }}</p>
                                    <p class="col-lg-7 text-bold ">
                                        {{ auth()->user()->staff->phoneNumber != '' ? auth()->user()->staff->phoneNumber : '-' }}
                                    </p>
                                </li>
                                <li class="d-flex flex-column flex-lg-row align-items-center">
                                    <p class="col-lg-5 border-right">{{ __('Email') }}</p>
                                    <p class="col-lg-7 text-bold ">
                                        {{ auth()->user()->staff->email != '' ? auth()->user()->staff->email : '-' }}
                                    </p>
                                </li>
                                <li class="d-flex flex-column flex-lg-row align-items-center">
                                    <p class="col-lg-5 border-right">{{ __('Graduates') }}</p>
                                    <p class="col-lg-7 text-bold ">
                                        {{ auth()->user()->graduated_id != '' ? auth()->user()->graduated->name : '-' }}
                                    </p>
                                </li>
                                <li class="d-flex flex-column flex-lg-row align-items-center">
                                    <p class="col-lg-5 border-right">{{ __('Job') }}</p>
                                    <p class="col-lg-7 text-bold ">
                                        {{ auth()->user()->job_id != '' ? auth()->user()->job->name : '-' }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 



        @section('scripts')
        <!-- Select 2 -->
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
        <!-- Ijabo Crop Tool -->
        <script src="{{ asset('plugins/ijabo-crop-tool/ijaboCropTool.min.js') }}"></script>
        <!-- date-range-picker -->
        <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
          {{--  --}}
          <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
          <!-- date-range-picker -->
          <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
          <!-- Tempusdominus Bootstrap 4 -->
          <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

        <script>
            $('.select2').select2();
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'DD-MM-YYYY'
            });

            $('#reservationdateHusband').datetimepicker({
                format: 'DD-MM-YYYY'
            });

            $('#fromInfo').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    withCSRF: ['_token', '{{ csrf_token() }}'],
                    beforeSend: function () {
                        $(document).find('span.error-text').text('');
                    },
                    success: function (data) {
                        if (data.status == 0) {
                            $.each(data.error, function (prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('input.error_input_' + prefix).addClass('is-invalid');
                                $('select.error_input_' + prefix).addClass('is-invalid');
                                $('#'+ prefix +' + span').addClass("is-invalid");
                                $('textarea.error_input_' + prefix).addClass('is-invalid');
                            });
                            alertToastInfo(data.msg)
                        } else {
                            document.getElementById('notifSucccess').play();
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.msg,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function () {
                                location.reload(true);
                            }, 1000);
                        }
                    },
                    error: function (xhr) {
                        Swal.fire(
                            xhr.statusText,
                            '{{ __('Wait a few minutes to try again') }}',
                            'error'
                        )
                    }
                });
            });

            $('#changePasswordForm').on('submit', function (e) {
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
                            });
                            alertToastInfo(data.msg)
                        } else {
                            $('#changePasswordForm')[0].reset();
                            $('input.error_input_oldpassword').removeClass('is-invalid');
                            $('input.error_input_newpassword').removeClass('is-invalid');
                            $('input.error_input_cnewpassword').removeClass('is-invalid');
                            document.getElementById('notifSucccess').play();
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.msg,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function (xhr) {
                        Swal.fire(
                            xhr.statusText, '{{ __('Wait a few minutes to try again') }}', 'error'
                        )
                    }
                });
            });

            $(document).on('click', '#change_picture_btn', function () {
                $('#user_image').click();
            });

            $('#user_image').ijaboCropTool({
                preview: '.user_picture',
                setRatio: 1,
                allowedExtensions: ['jpg', 'jpeg', 'png'],
                buttonsText: ['{{ __("Crop") }}', '{{ __("Cancel") }}'],
                buttonsColor: ['#28A745', '#DC3545', -15],
                processUrl: '',
                // withCSRF:['_token','{{ csrf_token() }}'],
                onSuccess: function (message, element, status) {
                    $('#successToast').addClass("successToast");
                    return $('.successToast').each(function () {
                        Toast.fire({
                            icon: 'success',
                            title: message
                        })
                        setTimeout(function () {
                            location.reload(true);
                        }, 1000);
                    });
                },
                onError: function (message, element, status) {
                    $('#errorToast').addClass("errorToast");
                    return $('.errorToast').each(function () {
                        Toast.fire({
                            icon: 'error',
                            title: message
                        })
                    });
                }
            });

            $('#btn_delete_picture').on('click',function(e){
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
                        $("#form_delete_picture").click();
                    }
                });
            });

            $('#fromAddHusband').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    withCSRF: ['_token', '{{ csrf_token() }}'],
                    beforeSend: function () {
                        $(document).find('span.error-text').text('');
                    },
                    success: function (data) {
                        if (data.status == 0) {
                            $.each(data.error, function (prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('input.error_input_husband_' + prefix).addClass('is-invalid');
                                $('#'+ prefix +' + span').addClass("is-invalid");
                                $('textarea.error_input_husband_' + prefix).addClass('is-invalid');
                            });
                            alertToastInfo(data.msg)
                        } else {
                            document.getElementById('notifSucccess').play();
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.msg,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function () {
                                location.href = "user/dashboard";
                            }, 1000);
                        }
                    },
                    error: function (xhr) {
                        Swal.fire(
                            xhr.statusText,
                            '{{ __('Wait a few minutes to try again') }}',
                            'error'
                        )
                    }
                });
            });

            for (let i = 1; i <= countPosition.value; i++) {
                $('#btn_delete_husband'+i).on('click',function(e){
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
                            $("#form_delete_husband"+i).click();
                        }
                    });
                });
            }


        </script>

        @endsection

</x-app-dashboard>
