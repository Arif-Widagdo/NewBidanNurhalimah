<!--- Modal Show -->
@foreach ($staffs as $staff_edit)
<div class="modal fade" id="modal-edit-staff{{ $staff_edit->employe_id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title"><i class="fa fa-user-nurse"></i> {{ __('Staff Edit Form') }}</h5>
                {{-- <h5 class="modal-title">#{{ $staff_edit->employe_id }}</h5> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('staffs.update', $staff_edit->employe_id) }}" method="POST" id="form_edit_staff{{ $loop->iteration }}">
            @csrf
            @method('PATCH')
                <div class="modal-body p-0">
                    <div class="card card-widget widget-user-2 shadow-none border-none" style="border: none !important; box-shadow:none !important; border-radius:0px !important;">
                        <div class="widget-user-header elevation-1">
                            <div class="row">
                                <div class="widget-user-image" style="position: relative !important;">
                                    @if($staff_edit->account)
                                        <img class="img-circle elevation-2" src="{{ $staff_edit->account->picture }}" alt="{{ $staff_edit->account->username }}">
                                    @else
                                        <img class="img-circle elevation-2" src="{{ asset('dist/img/users/no-image2.png') }}" alt="{{ $staff_edit->name }}">
                                    @endif
                                    @if($staff_edit->account)
                                    <div style="position: absolute; right:2px; top:2px;">
                                        @if($staff_edit->account->status == 'actived')
                                        <div style="width: 16px; height:16px; border-radius:100%; background-color:#28A745"></div>
                                        @else
                                        <div style="width: 16px; height:16px; border-radius:100%; background-color:#DC3545"></div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                <div class="d-flex flex-column ml-2">
                                    <h3 class="name_user mr-2 mt-1">{{ $staff_edit->name }}</h3>
                                    <p class="user_email" style="margin-top: -10px !important">{{ $staff_edit->position->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <!----- Row Forn ------>
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-danger d-flex align-items-center justify-content-between">
                                        <small class="text-danger">{{ __('* required fileds') }}</small>
                                        <input type="hidden" class="form-control error_input_name" value="{{ $staff_edit->user_id != '' ? $staff_edit->account->id : '' }}" name="user_id">
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
                                                    <input type="text" class="form-control error_input_username" id="username" placeholder="{{ __('Enter') }} {{ __('Username') }}" value="{{ $staff_edit->user_id != '' ? $staff_edit->account->username : '' }}" name="username">
                                                    <span class="text-danger error-text username_error"></span>
                                                </div>
                                            </div>
                                            <!----- Email ------->
                                            <div class="form-group row">
                                                <label for="email" class="col-lg-4 col-form-label">
                                                    {{ __('Email') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="email" class="form-control error_input_email" id="email" placeholder="{{ __('Enter') }} {{ __('Email') }}" value="{{ $staff_edit->user_id != '' ? $staff_edit->account->email : '' }}" name="email">
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
                                                        <option {{ $staff_edit->user_id != '' && $staff_edit->account->status == 'actived' ? "selected='selected'" : '-' }} value="actived">{{ __('Active') }}</option>
                                                        <option {{ $staff_edit->user_id != '' && $staff_edit->account->status == 'blocked' ? "selected='selected'" : '-' }} value="blocked">{{ __('Blocked') }}</option>
                                                    </select>
                                                    <span class="text-danger error-text status_error"></span>
                                                </div>
                                            </div>
                                            <!----- Position ------->
                                            <div class="form-group row">
                                                <label for="position_id" class="col-lg-4 col-form-label">
                                                    {{ __('Position Staff') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select class="form-control select2" style="width: 100%;" name="position_id" id="position_id{{ $loop->iteration }}">
                                                        <option selected="selected" disabled >{{ __('Select Position Staff') }}</option>
                                                        @foreach ($positions as $position)
                                                            @if($staff_edit->position_id != '' && $staff_edit->position->id  == $position->id)
                                                            <option value="{{ $position->id }}" selected>{{ $position->name }}</option>
                                                            @else
                                                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger error-text position_id_error"></span>
                                                </div>
                                            </div>
                                            <!----- Full Name ------->
                                            <div class="form-group row">
                                                <label for="inputName" class="col-lg-4 col-form-label ">
                                                    {{ __('Full Name') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control error_input_name" id="inputName" placeholder="{{ __('Enter') }} {{ __('Full Name') }}" name="name" value="{{ $staff_edit->name }}">
                                                    <span class="text-danger error-text name_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <!----- Gender ------->
                                            <div class="form-group row">
                                                <label for="gender" class="col-lg-4 col-form-label">
                                                    {{ __('Gender') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select class="form-control error_input_gender" style="width: 100%;" name="gender" id="gender">
                                                        <option selected="selected" disabled>{{ __('Select Gender') }}</option>
                                                        @if($staff_edit->gender == 'F')
                                                            <option value="M">{{ __('Male') }}</option>
                                                            <option value="F" selected>{{ __('Female') }}</option>
                                                        @elseif($staff_edit->gender == 'M')
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
                                            <!----- Place of Birthday ------->
                                            <div class="form-group row">
                                                <label for="inputPlaceBrithday" class="col-lg-4 col-form-label ">
                                                    {{ __('Place of Birthday') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control error_input_place_brithday" id="inputPlaceBrithday" placeholder="{{ __('Enter') }} {{ __('Place of Birthday') }}" value="{{ $staff_edit->place_brithday }}" name="place_brithday">
                                                    <span class="text-danger error-text place_brithday_error"></span>
                                                </div>
                                            </div>
                                            <!----- Date of Birthday ------->
                                            <div class="form-group row">
                                                <label for="inputDateBrithday" class="col-lg-4 col-form-label">
                                                    {{ __('Date of Birthday') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <div class="input-group date" id="reservationdate{{ $loop->iteration }}" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input error_input_date_brithday" placeholder="{{ __('Enter your Date of Birth') }}" data-target="#reservationdate{{ $loop->iteration }}" value="{{ $staff_edit->date_brithday != '' ? date('d-m-Y', strtotime($staff_edit->date_brithday)) : '' }}" name="date_brithday">
                                                        <div class="input-group-append" data-target="#reservationdate{{ $loop->iteration }}" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger error-text date_brithday_error"></span>
                                                </div>
                                            </div>
                                            <!----- Graduateds ------->
                                            <div class="form-group row">
                                                <label for="graduated_id" class="col-lg-4 col-form-label">
                                                    {{ __('Graduateds') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select class="form-control select2" style="width: 100%;" name="graduated_id" id="graduated_id{{ $loop->iteration }}">
                                                        <option selected="selected" disabled >{{ __('Select Graduated') }}</option>
                                                        @foreach ($graduateds as $graduated)
                                                            @if($staff_edit->graduated_id != '' && $staff_edit->graduated->id  == $graduated->id)
                                                            <option value="{{ $graduated->id }}" selected>{{ $graduated->name }}</option>
                                                            @else
                                                            <option value="{{ $graduated->id }}">{{ $graduated->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger error-text graduated_id_error"></span>
                                                </div>
                                            </div>
                                            <!----- Number Phone ------->
                                            <div class="form-group row">
                                                <label for="phoneNumber" class="col-lg-4 col-form-label">
                                                    {{ __('Number Phone') }}<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text text-bold">(+62)</span>
                                                        </div>
                                                        <input class="form-control square error_input_phoneNumber" name="phoneNumber" type="text" placeholder="{{ __('Enter') }} {{ __('Number Phone') }}" value="{{ $staff_edit->phoneNumber }}" oninput="format(this)">
                                                    </div>
                                                    <span class="text-danger error-text phoneNumber_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!----- Address ------->
                                    <div class="form-group">
                                        <label for="InputAddress" class="col-form-label">
                                            {{ __('Address') }}<span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control error_input_address" id="InputAddress" name="address" cols="30" rows="2" placeholder="{{ __('Enter') }} {{ __('Address') }}">{{ $staff_edit->address }}</textarea>
                                        <span class="text-danger error-text address_error"></span>
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