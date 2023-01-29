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
                                @if(auth()->user()->picture != Url('dist/img/users/no-image.jpeg'))
                                <a id="btn_delete_picture" class="dropdown-item" href="#">
                                    <i class="fas fa-solid fa-trash mr-2"></i><span>{{ __('Delete Picture') }}</span>
                                </a>
                                <form action="{{ route('profile.deletePicture') }}" method="post" class="d-inline"
                                    id="deleted-picture">
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
                            </div>
                            <p class="user_email" style="margin-top: -10px !important">{{ auth()->user()->email }} </p>
                        </div>
                    </div>
                    <!-- Notification row -->
                    @if(!auth()->user()->patient)
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card border border-danger">
                                <div class="card-body">
                                    <div class="d- d-inline-flex align-items-start">
                                        <i class="fas fa-info mr-2" style="margin-top: 2px;"></i>
                                        <strong class="text-danger">{{ __('Please complete your personal data in the form provided') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                        @include('profile.patient.partials.show._row_patient_information')
                    @endif
                   
                    @if(auth()->user()->patient)
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            @if(!auth()->user()->patient->couple)
                                @include('profile.patient.partials.create._row_couple_create')
                            @else
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="text-bold">#{{ __('Couple Informations') }}</h5>
                                @if(auth()->user()->patient->couple)
                                <a href="#" class="btn btn-light border"  data-toggle="modal" data-target="#modal_edit_couple"><i class="fas fa-user-edit mr-1"></i> {{ __('Edit') }}</a>
                                @endif
                            </div>
                                @include('profile.patient.partials.show._row_couple_information')
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

   

    @if(auth()->user()->patient)
        @include('profile.patient.partials.edit.patient_edit_information')
    @else
        @include('profile.patient.partials.create._row_create_patient')
    @endif
    
    @if(auth()->user()->patient)
        @if(auth()->user()->patient->couple)
            @include('profile.patient.partials.edit._modal_edit_couple')
        @endif
    @endif
 


    @include('profile.change_password')

    @section('scripts')
    <!-- Select 2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Ijabo Crop Tool -->
    <script src="{{ asset('plugins/ijabo-crop-tool/ijaboCropTool.min.js') }}"></script>
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
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });
      
        $('#fromUpdatePatient').on('submit', function (e) {
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
                        document.getElementById('notifSucccess').play();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.msg,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function () {
                            window.location.href='patient/dashboard';
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
                        setTimeout(function () {
                            window.location.href='patient/dashboard';
                        }, 1000);
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
            processUrl: '{{ route("profile.pictureUpdate") }}',
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

        // ----------- CRREATE OR VALIDATE 
        $('input#createAccout').bootstrapSwitch();
        $('input#createAccout').on('switchChange.bootstrapSwitch', function() {
            $('#form-validate').toggle();
            
            if ($('input#createAccout').bootstrapSwitch('state')){
                $('#form_create_patient').hide();
                $('#form_create_patient input').attr('disabled', true);
                $('#form_create_patient select').attr('disabled', true);
                $('#form_create_patient textarea').attr('disabled', true);

                $('#form-validate input').removeAttr('disabled');
                $('#form-validate select').removeAttr('disabled');
                
            }else{     
                $('#form_create_patient').show();
                $('#form_create_patient input').removeAttr('disabled');
                $('#form_create_patient select').removeAttr('disabled');
                $('#form_create_patient textarea').removeAttr('disabled');

                $('#form-validate input').attr('disabled', true);
                $('#form-validate select').attr('disabled', true); 
            }
        });

        $('#reservationdate_create').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        
        // ------- Form Regist Patient
        $('#form_create_patient').on('submit', function (e) {
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
                            $('span.' + prefix + '_create_error').text(val[0]);
                            $('input.error_input_' + prefix + '_create').addClass('is-invalid');
                            $('select.error_input_' + prefix + '_create').addClass('is-invalid');
                            $('#'+ prefix +'_create'+' + span').addClass("is-invalid");
                            $('textarea.error_input_' + prefix + '_create').addClass('is-invalid');
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
                            $('span.date_brithday_create_error').text("{{ __('Hes not yet 10 years old, you cant enter the data wrong, right?') }}");
                            $('input.error_input_date_brithday_create').addClass('is-invalid');
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
        // ------- Form Regist Couple
        $('#form_create_couple').on('submit', function (e) {
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
                            $('span.' + prefix + '_create_couple_error').text(val[0]);
                            $('input.error_input_' + prefix + '_create_couple').addClass('is-invalid');
                            $('select.error_input_' + prefix + '_create_couple').addClass('is-invalid');
                            $('#'+ prefix +'_create_couple'+' + span').addClass("is-invalid");
                            $('textarea.error_input_' + prefix + '_create_couple').addClass('is-invalid');
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
                            $('span.date_brithday_create_couple_error').text("{{ __('Hes not yet 10 years old, you cant enter the data wrong, right?') }}");
                            $('input.error_input_date_brithday_create_couple').addClass('is-invalid');
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
                            window.location.href='patient/dashboard';
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

        $('#reservationdate_create_couple').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        
        $('#sameAddress').change(function() {
            if (this.checked) {
                document.getElementById("inputAddressCouple2").value = document.getElementById("inputAddressCouple1").value;
            } else{
                document.getElementById("inputAddressCouple2").value = ''
            }
        }); 

        // --------- Form Edit Couple
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
                            $('span.' + prefix + '_couple_error').text(val[0]);
                            $('input.error_input_' + prefix + '_couple').addClass('is-invalid');
                            $('select.error_input_' + prefix + '_couple').addClass('is-invalid');
                            $('textarea.error_input_' + prefix + '_couple').addClass('is-invalid');
                            $('#'+ prefix + '_couple' + ' + span').addClass("is-invalid");
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
                        document.getElementById('notifSucccess').play();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.msg,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function () {
                            window.location.href='patient/dashboard';
                            // location.reload(true);
                        }, 1000);
                    }
                },
                error: function (xhr) {
                    Swal.fire(xhr.statusText, '{{ __('Wait a few minutes to try again ') }}', 'error')
                }
            });
        });

        $('#reservationdate_edit_couple').datetimepicker({
            format: 'DD-MM-YYYY'
        });


        // ------ Validate Patient
        $('#reservationdate_validate').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        
        $('#form-validate').on('submit', function (e) {
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
                            $('span.' + prefix + '_validate_error').text(val[0]);
                            $('input.error_input_' + prefix + '_validate').addClass('is-invalid');
                        });
                        alertToastInfo(data.msg)
                    } else {
                        if(data.statusValidate == 0){
                            document.getElementById('notifFail').play();
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: "{{ __('Information') }}",
                                text: data.msg,
                                showConfirmButton: true,
                                confirmButtonColor: '#007BFF',
                            });
                        }else{
                            document.getElementById('notifSucccess').play();
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.msg,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function () {
                                window.location.href='patient/dashboard';
                            }, 1000);
                        }
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
