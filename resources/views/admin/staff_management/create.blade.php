<x-app-dashboard title="{{ __('Staff Registration') }}">
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
        {{ __('Staff Registration Form') }}
    </x-slot>
    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{ route('staffs.index') }}">{{ __('Staff List') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Staff Registration') }}</li>
        </ol>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <form action="{{ route('staffs.store') }}" method="POST" id="form_create_staff">
                    @csrf
                    <div class="card-body">
                        <div class="text-danger d-flex align-items-center justify-content-between">
                            <span>{{ __('* required fileds') }}</span>
                            {{-- <button onclick="history.back()" class="btn btn-outline-primary"><i class="fas fa-arrow-circle-left"></i> {{ __('Back') }}</button> --}}
                            <a href="{{ route('staffs.index') }}" class="btn btn-outline-primary"><i class="fas fa-arrow-circle-left"></i> {{ __('Back') }}</a>
                        </div>
                        <hr>
                        <div class="form-group row d-flex flex-row align-items-center">
                            <label for="createAccout" class="col-6 col-lg-3 col-form-label">
                                {{ __('Create an account') }}
                            </label>
                            <div class="col-6 col-lg-9">
                                <div class="checkbox">
                                    <input id="createAccout" type="checkbox" name="create_account" data-bootstrap-switch data-off-color="light" data-on-color="primary" data-off-text="{{ __('No') }}" data-on-text="{{ __('Yes') }}"  > 
                                </div>
                            </div>
                        </div>
                        <div id="form-user" style="display: none" class="card">
                            <div class="card-header bg-primary d-flex align-items-lg-center align-items-start">
                                <i class="fas fa-info-circle mr-2 mt-1 mt-lg-0"></i> <span>{{ __('The password will be generated automatically using the username.') }}</span>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="username" class="col-md-3 col-form-label">
                                        {{ __('Username') }} <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control error_input_name" id="username" placeholder="{{ __('Enter') }} {{ __('Username') }}" value="" name="username" disabled>
                                        <span class="text-danger error-text username_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-3 col-form-label">
                                        {{ __('Email') }} <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control error_input_name" id="email" placeholder="{{ __('Enter') }} {{ __('Email') }}" value="" name="email" disabled>
                                        <span class="text-danger error-text email_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-md-3 col-form-label ">
                                {{ __('Full Name') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control error_input_name" id="inputName" placeholder="{{ __('Enter') }} {{ __('Full Name') }}" name="name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-md-3 col-form-label">
                                {{ __('Gender') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control error_input_gender" style="width: 100%;" name="gender" id="gender">
                                    <option selected="selected" disabled>{{ __('Select Gender') }}</option>
                                    <option value="M">{{ __('Male') }}</option>
                                    <option value="F">{{ __('Female') }}</option>
                                </select>
                                <span class="text-danger error-text gender_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="position_id" class="col-md-3 col-form-label">
                                {{ __('Position Staff') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control select2" style="width: 100%;" name="position_id" id="position_id">
                                    <option selected="selected" disabled >{{ __('Select Position Staff') }}</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text position_id_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="graduated_id" class="col-md-3 col-form-label">
                                {{ __('Graduateds') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control select2" style="width: 100%;" name="graduated_id" id="graduated_id">
                                    <option selected="selected" disabled >{{ __('Select Graduated') }}</option>
                                    @foreach ($graduateds as $graduated)
                                        <option value="{{ $graduated->id }}">{{ $graduated->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text graduated_id_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPlaceBrithday" class="col-md-3 col-form-label ">
                                {{ __('Place of Birthday') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control error_input_place_brithday" id="inputPlaceBrithday" placeholder="{{ __('Enter') }} {{ __('Place of Birthday') }}" value="" name="place_brithday">
                                <span class="text-danger error-text place_brithday_error"></span>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="inputDateBrithday" class="col-md-3 col-form-label">
                                {{ __('Date of Birthday') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input error_input_date_brithday" placeholder="{{ __('Enter your Date of Birth') }}" data-target="#reservationdate" value="{{ Auth::user()->date_brithday != '' ? date('d-m-Y', strtotime(Auth::user()->date_brithday)) : '' }}" name="date_brithday">
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <small>{{ __('Example') }}: 30-12-1995</small><br>
                                <span class="text-danger error-text date_brithday_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phoneNumber" class="col-md-3 col-form-label">
                                {{ __('Number Phone') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-bold">(+62)</span>
                                    </div>
                                    <input class="form-control square error_input_phoneNumber" name="phoneNumber" type="text" placeholder="{{ __('Enter') }} {{ __('Number Phone') }}" value="" oninput="format(this)">
                                </div>
                                <span class="text-danger error-text phoneNumber_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="InputAddress" class="col-md-3 col-form-label">
                                {{ __('Address') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <textarea class="form-control error_input_address" id="InputAddress" name="address" cols="30" rows="2" placeholder="{{ __('Enter') }} {{ __('Address') }}"></textarea>
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-id-card"></i> {{ __('Create Now') }} </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   
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

    $('input#createAccout').bootstrapSwitch();

    $('input#createAccout').on('switchChange.bootstrapSwitch', function() {
        $('#form-user').toggle();
        if ($('input#createAccout').bootstrapSwitch('state')){
            $('#form-user input').removeAttr('disabled');
            $('#form-user input[type=radio]:last').attr('checked', true);
        }else{
            $('#form-user input').attr('disabled', true);
        }
    });

    $('#form_create_staff').on('submit', function (e) {
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
                        position: 'center',
                        icon: 'info',
                        title: "{{ __('Information') }}",
                        text: data.msg,
                        showConfirmButton: true,
                        confirmButtonColor: '#007BFF',
                    });
                    $('span.date_brithday_error').text("{{ __('Hes not yet 10 years old, you cant enter the data wrong, right?') }}");
                }else {
                    $('#form_create_staff')[0].reset();
                    setTimeout(function () {
                        location.href = "admin/staffs";
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