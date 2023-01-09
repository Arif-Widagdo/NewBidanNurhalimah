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

    <!-- Card Profile -->
    <div class="row">
        <div class="col-12">
            <div class="card card-widget widget-user-2 card-outline card-primary">
                <div class="widget-user-header elevation-1">
                    <div class="row" style="position: relative !important;">
                        <div class="widget-user-image ">
                            <img class="img-circle elevation-2 user_picture" src="{{ auth()->user()->picture }}" alt="{{ auth()->user()->username }}">
                        </div>
                        <div class="btn-group" style="position: absolute !important; right:0 !important; top:0;">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" title="{{ __('Change Picture') }}" data-placement="right">
                                <i class="fas fa-pen mr-1"></i> <span class="sr-only">{{ __('Change Picture') }}</span>
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
                                        {{ auth()->user()->staff->place_brithday && auth()->user()->staff->date_brithday != '' ? auth()->user()->staff->place_brithday.', '.date('d-m-Y', strtotime(auth()->user()->staff->date_brithday))   : '-'  }} 
                                    </p>
                                </li>
                                <li class="d-flex flex-column flex-lg-row align-items-center">
                                    <p class="col-lg-5 border-right">{{ __('Age') }}</p>
                                    <p class="col-lg-7 text-bold ">
                                        {{ auth()->user()->staff->date_brithday != '' ? $ageInYears : '-' }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-group list-group-unbordered " style="list-style-type: none;">
                                <li class="d-flex flex-column flex-lg-row align-items-center">
                                    <p class="col-lg-5 border-right">{{ __('Position') }}</p>
                                    <p class="col-lg-7 text-bold ">
                                        @if(auth()->user()->staff->position->slug === 'admin')
                                        {{ __('Admin') }}
                                        @else
                                        {{ __('Staff') }}
                                        @endif
                                    </p>
                                </li>
                                <li class="d-flex flex-column flex-lg-row align-items-center ">
                                    <p class="col-lg-5 border-right">{{ __('Username') }}</p>
                                    <p class="col-lg-7 text-bold ">
                                        {{ auth()->user()->username != '' ? auth()->user()->username : '-' }}
                                    </p>
                                </li>
                                <li class="d-flex flex-column flex-lg-row align-items-center">
                                    <p class="col-lg-5 border-right">{{ __('Email') }}</p>
                                    <p class="col-lg-7 text-bold ">
                                        {{ auth()->user()->email != '' ? auth()->user()->email : '-' }}
                                    </p>
                                </li>
                                <li class="d-flex flex-column flex-lg-row align-items-center">
                                    <p class="col-lg-5 border-right">{{ __('Number Phone') }}</p>
                                    <p class="col-lg-7 text-bold ">
                                        {{ auth()->user()->staff->phoneNumber != '' ? auth()->user()->staff->phoneNumber : '-' }}
                                    </p>
                                </li>
                                <li class="d-flex d-lg-none flex-column flex-lg-row align-items-center">
                                    <p class="col-lg-5 border-right">{{ __('Address') }}</p>
                                    <p class="col-lg-7 text-bold ">
                                        {{ auth()->user()->staff->address != '' ? auth()->user()->staff->address : '-' }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row d-none d-lg-flex">
                        <div class="col-lg-12">
                            <div class="border d-flex flex-column p-2">
                                <p class="text-bold">{{ __('Address') }}</p>
                                <p class="">
                                    {{ auth()->user()->staff->address != '' ? auth()->user()->staff->address : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row Information -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline" id="card_custom_collapsed">
                <div class="card-header align-items-center">
                    <h5 class="float-left mt-1 text-bold">
                        <i class="fas fa-user"></i> {{ __('Personal Information') }}
                    </h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="border-bottom text-danger border-primary mb-4">
                        {{ __('* required fileds') }}
                    </div>
                    <form class="form-horizontal" action="{{ route('profile.update.staff') }}" method="POST" id="fromInfo">
                        @csrf
                        @method('patch')
                        <div class="form-group row">
                            <label for="inputName" class="col-md-3 col-form-label ">
                                {{ __('Full Name') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control error_input_name" id="inputName" placeholder="{{ __('Enter Your Full Name') }}" value="{{ auth()->user()->staff->name }}" name="name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-md-3 col-form-label ">
                                {{ __('Email') }} 
                            </label>
                            <div class="col-md-9">
                                <input type="email" class="form-control error_input_email" id="inputEmail" placeholder="{{ __('Enter Your Email') }}" value="{{ auth()->user()->email }}" name="email" disabled readonly>
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputUsername" class="col-md-3 col-form-label ">
                                {{ __('Username') }} 
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control error_input_username" id="inputUsername" placeholder="{{ __('Enter Your Username') }}" value="{{ auth()->user()->username }}" name="username" disabled readonly>
                                <span class="text-danger error-text username_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputGender" class="col-md-3 col-form-label">
                                {{ __('Gender') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control error_input_gender" style="width: 100%;" name="gender" id="gender">
                                    @if(auth()->user()->staff->gender === 'M')
                                    <option value="M" selected="selected">{{ __('Male') }}</option>
                                    <option value="F">{{ __('Female') }}</option>
                                    @elseif(auth()->user()->staff->gender === 'F')
                                    <option value="M">{{ __('Male') }}</option>
                                    <option value="F" selected="selected">{{ __('Female') }}</option>
                                    @else
                                    <option selected="selected" disabled>{{ __('Select Your Gender') }}</option>
                                    <option value="M">{{ __('Male') }}</option>
                                    <option value="F">{{ __('Female') }}</option>
                                    @endif
                                </select>
                                <span class="text-danger error-text gender_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPlaceBrithday" class="col-md-3 col-form-label ">
                                {{ __('Place of Birthday') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control error_input_place_brithday" id="inputPlaceBrithday" placeholder="{{ __('Enter your Place of Birth') }}" value="{{ auth()->user()->staff->place_brithday }}" name="place_brithday">
                                <span class="text-danger error-text place_brithday_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputDateBrithday" class="col-md-3 col-form-label ">
                                {{ __('Date of Birthday') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input error_input_date_brithday" placeholder="{{ __('Enter your Date of Birth') }}" data-target="#reservationdate" value="{{ auth()->user()->staff->date_brithday != '' ? date('d-m-Y', strtotime(auth()->user()->staff->date_brithday)) : '' }}" name="date_brithday">
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <small>{{ __('Example') }}: 30-12-1995</small><br>
                                <span class="text-danger error-text date_brithday_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="InputNoHp" class="col-md-3 col-form-label">
                                {{ __('Number Phone') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-bold">ID</span>
                                    </div>
                                    <input class="form-control square error_input_phoneNumber" name="phoneNumber" type="text" placeholder="{{ __('Enter') }} {{ __('Number Phone') }}" value="{{ auth()->user()->staff->phoneNumber }}" oninput="format(this)">
                                </div>
                                <span class="text-danger error-text phoneNumber_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="InputAddress" class="col-md-3 col-form-label">
                                {{ __('Address') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <textarea class="form-control error_input_address" id="InputAddress" name="address" cols="30" rows="2" placeholder="{{ __('Enter') }} {{ __('Address') }}">{{ auth()->user()->staff->address }}</textarea>
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-md-3 col-md-9">
                                <button type="submit" class="btn btn-primary float-md-left mt-4">{{ __('Save Changes') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Row Change Passowrd -->
    @include('profile.partials.change_password')
    <!-- /Row Change Passowrd -->



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

        $('#reservationdate').datetimepicker({
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
                    Swal.fire(xhr.statusText, '{{ __('Wait a few minutes totry again ') }}', 'error')
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
                    Swal.fire(xhr.statusText, '{{ __('Wait a few minutes totry again ') }}', 'error')
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
                document.getElementById('notifSucccess').play();
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
                document.getElementById('notifFail').play();
                return $('.errorToast').each(function () {
                    Toast.fire({
                        icon: 'error',
                        title: message
                    })
                });
            }
        });

        $('#btn_delete_picture').on('click', function (e) {
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
                    $("#form_delete_picture").click();
                }
            });
        });
    </script>

    @endsection

</x-app-dashboard>
