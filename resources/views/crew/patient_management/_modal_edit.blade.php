<!--- Modal Show -->
@foreach ($patients as $patient_edit)
<div class="modal fade" id="modal_edit_patient{{ $patient_edit->no_rm }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                {{-- <h5 class="modal-title">{{ __('Patient') }} #{{ $patient_edit->no_rm }}</h5> --}}
                <h5 class="modal-title"><i class="fa fa-hospital-user"></i> {{ __('Patient Edit Form') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('patients.update', $patient_edit->no_rm) }}" method="POST" id="form_edit_patient{{ $loop->iteration }}">
            @csrf
            @method('PATCH')
                <div class="modal-body p-0">
                    <div class="card card-widget widget-user-2 shadow-none border-none" style="border: none !important; box-shadow:none !important; border-radius:0px !important;">
                        <div class="widget-user-header elevation-1">
                            <div class="row">
                                <div class="widget-user-image" style="position: relative !important;">
                                    @if($patient_edit->account)
                                        <img class="img-circle elevation-2" src="{{ $patient_edit->account->picture }}" alt="{{ $patient_edit->account->username }}">
                                    @else
                                        <img class="img-circle elevation-2" src="{{ asset('dist/img/users/no-image2.png') }}" alt="{{ $patient_edit->name }}">
                                    @endif
                                    @if($patient_edit->account)
                                    <div style="position: absolute; right:2px; top:2px;">
                                        @if($patient_edit->account->status == 'actived')
                                        <div style="width: 16px; height:16px; border-radius:100%; background-color:#28A745"></div>
                                        @else
                                        <div style="width: 16px; height:16px; border-radius:100%; background-color:#DC3545"></div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                <div class="d-flex flex-column ml-2">
                                    <h3 class="name_user mr-2 mt-1">{{ $patient_edit->name }}</h3>
                                    <p class="user_email" style="margin-top: -10px !important">{{ $patient_edit->no_rm }}</p>
                                </div>
                            </div>
                            <hr>
                            <!----- Row Patient ------>
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-danger d-flex align-items-center justify-content-between">
                                        <small class="text-danger">{{ __('* required fileds') }}</small>
                                        <input type="hidden" class="form-control error_input_name" value="{{ $patient_edit->user_id != '' ? $patient_edit->account->id : '' }}" name="user_id">
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <!----- Username ------->
                                            <div class="form-group row">
                                                <label for="username" class="col-lg-4 col-form-label">
                                                    {{ __('Username') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control error_input_username" id="username" placeholder="{{ __('Enter') }} {{ __('Username') }}" value="{{ $patient_edit->user_id != '' ? $patient_edit->account->username : '' }}" name="username">
                                                    <span class="text-danger error-text username_error"></span>
                                                </div>
                                            </div>
                                            <!----- Email ------->
                                            <div class="form-group row">
                                                <label for="email" class="col-lg-4 col-form-label">
                                                    {{ __('Email') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="email" class="form-control error_input_email" id="email" placeholder="{{ __('Enter') }} {{ __('Email') }}" value="{{ $patient_edit->user_id != '' ? $patient_edit->account->email : '' }}" name="email">
                                                    <span class="text-danger error-text email_error"></span>
                                                </div>
                                            </div>
                                            <!----- Status Activation Account ------->
                                            <div class="form-group row">
                                                <label for="status" class="col-lg-4 col-form-label">
                                                    {{ __('Activation Status') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select class="form-control error_input_status" style="width: 100%;" name="status" id="status">
                                                        <option selected="selected" disabled>{{ __('Select Status') }}</option>
                                                        <option {{ $patient_edit->user_id != '' && $patient_edit->account->status == 'actived' ? "selected='selected'" : '-' }} value="actived">{{ __('Active') }}</option>
                                                        <option {{ $patient_edit->user_id != '' && $patient_edit->account->status == 'blocked' ? "selected='selected'" : '-' }} value="blocked">{{ __('Blocked') }}</option>
                                                    </select>
                                                    <span class="text-danger error-text status_error"></span>
                                                </div>
                                            </div>
                                            <!----- Full Name ------->
                                            <div class="form-group row">
                                                <label for="inputName" class="col-lg-4 col-form-label ">
                                                    {{ __('Full Name') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control error_input_name" id="inputName" placeholder="{{ __('Enter') }} {{ __('Full Name') }}" name="name" value="{{ $patient_edit->name }}">
                                                    <span class="text-danger error-text name_error"></span>
                                                </div>
                                            </div>
                                            <!----- Gender ------->
                                            <div class="form-group row">
                                                <label for="gender" class="col-lg-4 col-form-label">
                                                    {{ __('Gender') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select class="form-control error_input_gender" style="width: 100%;" name="gender" id="gender">
                                                        <option selected="selected" disabled>{{ __('Select Gender') }}</option>
                                                        @if($patient_edit->gender == 'F')
                                                            <option value="M">{{ __('Male') }}</option>
                                                            <option value="F" selected>{{ __('Female') }}</option>
                                                        @elseif($patient_edit->gender == 'M')
                                                            <option value="M" selected>{{ __('Male') }}</option>
                                                            <option value="F">{{ __('Female') }}</option>
                                                        @else
                                                            <option value="M">{{ __('Male') }}</option>
                                                            <option value="F">{{ __('Female') }}</option>
                                                        @endif
                                                    </select>
                                                    <span class="text-danger error-text gender_error"></span>
                                                </div>
                                            </div>
                                            <!----- Marital Status ------->
                                            <div class="form-group row">
                                                <label for="marital_status" class="col-lg-4 col-form-label">
                                                    {{ __('Marital Status') }} <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select class="form-control select2" style="width: 100%;" name="marital_status" id="marital_status">
                                                        <option selected="selected" disabled >{{ __('Select Marital Status') }}</option>
                                                        <option value="single" {{ $patient_edit->marital_status == 'single' ? 'selected="selected"' : '' }}>{{ __('Single') }}</option>
                                                        <option value="married" {{ $patient_edit->marital_status == 'married' ? 'selected="selected"' : '' }}>{{ __('Married') }}</option>
                                                        <option value="divorced" {{ $patient_edit->marital_status == 'divorced' ? 'selected="selected"' : '' }} >{{ __('Divorced') }}</option>
                                                        <option value="dead_divorced" {{ $patient_edit->marital_status == 'dead_divorced' ? 'selected="selected"' : '' }}>{{ __('Dead Divorced') }}</option>
                                                    </select>
                                                    <span class="text-danger error-text marital_status_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <!----- Place Birthday ------->
                                            <div class="form-group row">
                                                <label for="inputPlaceBrithday" class="col-lg-4 col-form-label ">
                                                    {{ __('Place of Birthday') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control error_input_place_brithday" id="inputPlaceBrithday" placeholder="{{ __('Enter') }} {{ __('Place of Birthday') }}" value="{{ $patient_edit->place_brithday }}" name="place_brithday">
                                                    <span class="text-danger error-text place_brithday_error"></span>
                                                </div>
                                            </div>
                                            <!----- Date Birthday ------->
                                            <div class="form-group row">
                                                <label for="inputDateBrithday" class="col-lg-4 col-form-label">
                                                    {{ __('Date of Birthday') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <div class="input-group date" id="reservationdate{{ $loop->iteration }}" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input error_input_date_brithday" placeholder="{{ __('Enter your Date of Birth') }}" data-target="#reservationdate{{ $loop->iteration }}" value="{{ $patient_edit->date_brithday != '' ? date('d-m-Y', strtotime($patient_edit->date_brithday)) : '' }}" name="date_brithday">
                                                        <div class="input-group-append" data-target="#reservationdate{{ $loop->iteration }}" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger error-text date_brithday_error"></span>
                                                </div>
                                            </div>
                                            <!----- Job ------->
                                            <div class="form-group row">
                                                <label for="work_id" class="col-lg-4 col-form-label">
                                                    {{ __('Job Status') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select class="form-control select2" style="width: 100%;" name="work_id" id="work_id{{ $loop->iteration }}">
                                                        <option selected="selected" disabled >{{ __('Select Job') }}</option>
                                                        @foreach ($works as $work)
                                                            @if($patient_edit->work_id != '' && $patient_edit->work->id  == $work->id)
                                                            <option value="{{ $work->id }}" selected>{{ $work->name }}</option>
                                                            @else
                                                            <option value="{{ $work->id }}">{{ $work->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger error-text work_id_error"></span>
                                                </div>
                                            </div>
                                            <!----- Graduated ------->
                                            <div class="form-group row">
                                                <label for="graduated_id" class="col-lg-4 col-form-label">
                                                    {{ __('Graduate Status') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select class="form-control select2" style="width: 100%;" name="graduated_id" id="graduated_id{{ $loop->iteration }}">
                                                        <option selected="selected" disabled >{{ __('Select Graduated') }}</option>
                                                        @foreach ($graduateds as $graduated)
                                                            @if($patient_edit->graduated_id != '' && $patient_edit->graduated->id  == $graduated->id)
                                                            <option value="{{ $graduated->id }}" selected>{{ $graduated->name }}</option>
                                                            @else
                                                            <option value="{{ $graduated->id }}">{{ $graduated->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger error-text graduated_id_error"></span>
                                                </div>
                                            </div>
                                            <!----- Phone Number ------->
                                            <div class="form-group row">
                                                <label for="phoneNumber" class="col-lg-4 col-form-label">
                                                    {{ __('Number Phone') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text text-bold">(+62)</span>
                                                        </div>
                                                        <input class="form-control square error_input_phoneNumber" name="phoneNumber" type="text" placeholder="{{ __('Enter') }} {{ __('Number Phone') }}" value="{{ $patient_edit->phoneNumber }}" oninput="format(this)">
                                                    </div>
                                                    <span class="text-danger error-text phoneNumber_error"></span>
                                                </div>
                                            </div>
                                            <!----- Addresss ------->
                                            <div class="form-group row">
                                                <label for="InputAddress" class="col-lg-4 col-form-label">
                                                    {{ __('Address') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <textarea class="form-control error_input_address" id="InputAddress" name="address" cols="30" rows="2" placeholder="{{ __('Enter') }} {{ __('Address') }}">{{ $patient_edit->address }}</textarea>
                                                    <span class="text-danger error-text address_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-dark float-right">{{ __('Save Change') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- /.modal -->