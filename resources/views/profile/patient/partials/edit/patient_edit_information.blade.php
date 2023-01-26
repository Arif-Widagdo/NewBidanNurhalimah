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
                <form class="form-horizontal" action="{{ route('profile.update.patient') }}" method="POST" id="fromUpdateInfo">
                    @csrf
                    @method('patch')
                    <!----- Full Name ------->
                    <div class="form-group row">
                        <label for="inputName" class="col-md-3 col-form-label ">
                            {{ __('Full Name') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control error_input_name" id="inputName" placeholder="{{ __('Enter Your Full Name') }}" value="{{ auth()->user()->patient->name }}" name="name" disabled readonly>
                            <span class="text-danger error-text name_error"></span>
                        </div>
                    </div>
                    <!----- Email ------->
                    <div class="form-group row">
                        <label for="inputEmail" class="col-md-3 col-form-label ">
                            {{ __('Email') }} 
                        </label>
                        <div class="col-md-9">
                            <input type="email" class="form-control error_input_email" id="inputEmail" placeholder="{{ __('Enter Your Email') }}" value="{{ auth()->user()->email }}" name="email" disabled readonly>
                            <span class="text-danger error-text email_error"></span>
                        </div>
                    </div>
                    <!----- Username ------->
                    <div class="form-group row">
                        <label for="inputUsername" class="col-md-3 col-form-label ">
                            {{ __('Username') }} 
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control error_input_username" id="inputUsername" placeholder="{{ __('Enter Your Username') }}" value="{{ auth()->user()->username }}" name="username" disabled readonly>
                            <span class="text-danger error-text username_error"></span>
                        </div>
                    </div>
                    <!----- Gender ------->
                    <div class="form-group row">
                        <label for="inputGender" class="col-md-3 col-form-label">
                            {{ __('Gender') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <select class="form-control error_input_gender" style="width: 100%;" name="gender" id="gender" disabled>
                                @if(auth()->user()->patient->gender === 'M')
                                <option value="M" selected="selected">{{ __('Male') }}</option>
                                <option value="F">{{ __('Female') }}</option>
                                @elseif(auth()->user()->patient->gender === 'F')
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
                    <!----- Place of Birthday ------->
                    <div class="form-group row">
                        <label for="inputPlaceBrithday" class="col-md-3 col-form-label ">
                            {{ __('Place of Birthday') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control error_input_place_brithday" id="inputPlaceBrithday" placeholder="{{ __('Enter your Place of Birth') }}" value="{{ auth()->user()->patient->place_brithday }}" name="place_brithday">
                            <span class="text-danger error-text place_brithday_error"></span>
                        </div>
                    </div>
                    <!----- Date of Birthday ------->
                    <div class="form-group row">
                        <label for="inputDateBrithday" class="col-md-3 col-form-label ">
                            {{ __('Date of Birthday') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input error_input_date_brithday" placeholder="{{ __('Enter your Date of Birth') }}" data-target="#reservationdate" value="{{ auth()->user()->patient->date_brithday != '' ? date('d-m-Y', strtotime(auth()->user()->patient->date_brithday)) : '' }}" name="date_brithday">
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <small>{{ __('Example') }}: 30-12-1995</small><br>
                            <span class="text-danger error-text date_brithday_error"></span>
                        </div>
                    </div>
                    <!----- Marital Status ------->
                    <div class="form-group row">
                        <label for="marital_status" class="col-lg-3 col-form-label">
                            {{ __('Marital Status') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <select class="form-control select2" style="width: 100%;" name="marital_status" id="marital_status">
                                <option selected="selected" disabled >{{ __('Select Marital Status') }}</option>
                                <option value="single" {{ auth()->user()->patient->marital_status == 'single' ? 'selected="selected"' : '' }}>{{ __('Single') }}</option>
                                <option value="married" {{ auth()->user()->patient->marital_status == 'married' ? 'selected="selected"' : '' }}>{{ __('Married') }}</option>
                                <option value="divorced" {{ auth()->user()->patient->marital_status == 'divorced' ? 'selected="selected"' : '' }} >{{ __('Divorced') }}</option>
                                <option value="dead_divorced" {{ auth()->user()->patient->marital_status == 'dead_divorced' ? 'selected="selected"' : '' }}>{{ __('Dead Divorced') }}</option>
                            </select>
                            <span class="text-danger error-text marital_status_error"></span>
                        </div>
                    </div>
                    <!----- Job ------->
                    <div class="form-group row">
                        <label for="work_id" class="col-lg-3 col-form-label">
                            {{ __('Job Status') }}<span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <select class="form-control select2" style="width: 100%;" name="work_id" id="work_id">
                                <option selected="selected" disabled >{{ __('Select Job') }}</option>
                                @if(auth()->user()->patient->gender == 'F')
                                    @foreach ($works->whereNotIn('work_status', 'male') as $work)
                                        @if(auth()->user()->patient->work_id != '' && auth()->user()->patient->work->id  == $work->id)
                                        <option value="{{ $work->id }}" selected>{{ $work->name }}</option>
                                        @else
                                        <option value="{{ $work->id }}">{{ $work->name }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($works->whereNotIn('work_status', 'female') as $work)
                                        @if(auth()->user()->patient->work_id != '' && auth()->user()->patient->work->id  == $work->id)
                                        <option value="{{ $work->id }}" selected>{{ $work->name }}</option>
                                        @else
                                        <option value="{{ $work->id }}">{{ $work->name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                               
                            </select>
                            <span class="text-danger error-text work_id_error"></span>
                        </div>
                    </div>
                    <!----- Graduateds ------->
                    <div class="form-group row">
                        <label for="graduated_id" class="col-lg-3 col-form-label">
                            {{ __('Graduate Status') }}<span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <select class="form-control select2" style="width: 100%;" name="graduated_id" id="graduated_id">
                                <option selected="selected" disabled >{{ __('Select Graduated') }}</option>
                                @foreach ($graduateds as $graduated)
                                    @if(auth()->user()->patient->graduated_id != '' && auth()->user()->patient->graduated->id  == $graduated->id)
                                    <option value="{{ $graduated->id }}" selected>{{ $graduated->name }}</option>
                                    @else
                                    <option value="{{ $graduated->id }}">{{ $graduated->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="text-danger error-text graduated_id_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="InputNoHp" class="col-md-3 col-form-label">
                            {{ __('Number Phone') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-bold">(+62)</span>
                                </div>
                                <input class="form-control square error_input_phoneNumber" name="phoneNumber" type="text" placeholder="{{ __('Enter') }} {{ __('Number Phone') }}" value="{{ auth()->user()->patient->phoneNumber }}" oninput="format(this)">
                            </div>
                            <span class="text-danger error-text phoneNumber_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="InputAddress" class="col-md-3 col-form-label">
                            {{ __('Address') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <textarea class="form-control error_input_address" id="InputAddress" name="address" cols="30" rows="2" placeholder="{{ __('Enter') }} {{ __('Address') }}">{{ auth()->user()->patient->address }}</textarea>
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