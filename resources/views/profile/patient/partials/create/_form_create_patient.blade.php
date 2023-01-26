<form action="{{ route('patient.registerPatient') }}" id="form_create" method="POST">
    @csrf
    <!-------- Full Name ----->
    <div class="form-group row">
        <label for="inputName_create" class="col-md-3 col-form-label ">
            {{ __('Full Name') }} <span class="text-danger">*</span>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control error_input_name_create" id="inputName_create" placeholder="{{ __('Enter Your Full Name') }}" name="name">
            <span class="text-danger error-text name_create_error"></span>
        </div>
    </div>
    <!-------- Gender ----->
    <div class="form-group row">
        <label for="gender_create" class="col-md-3 col-form-label">
            {{ __('Gender') }} <span class="text-danger">*</span>
        </label>
        <div class="col-md-9">
            <select class="form-control error_input_gender_create" style="width: 100%;" name="gender" id="gender_create">
                <option selected="selected" disabled>{{ __('Select Gender') }}</option>
                <option value="M">{{ __('Male') }}</option>
                <option value="F">{{ __('Female') }}</option>
            </select>
            <span class="text-danger error-text gender_create_error"></span>
        </div>
    </div>
    <!-------- Place of Birthday ----->
    <div class="form-group row">
        <label for="inputPlaceBrithday_create" class="col-md-3 col-form-label ">
            {{ __('Place of Birthday') }} <span class="text-danger">*</span>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control error_input_place_brithday_create" id="inputPlaceBrithday_create" placeholder="{{ __('Enter your Place of Birth') }}" name="place_brithday">
            <span class="text-danger error-text place_brithday_create_error"></span>
        </div>
    </div>
    <!-------- Date of Birthday ----->
    <div class="form-group row align-items-center">
        <label for="reservationdate_create" class="col-md-3 col-form-label">
            {{ __('Date of Birthday') }} <span class="text-danger">*</span>
        </label>
        <div class="col-md-9">
            <div class="input-group date" id="reservationdate_create" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input error_input_date_brithday_create" placeholder="{{ __('Enter your Date of Birth') }}" data-target="#reservationdate_create" name="date_brithday">
                <div class="input-group-append" data-target="#reservationdate_create" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <small>{{ __('Example') }}: 30-12-1995</small><br>
            <span class="text-danger error-text date_brithday_create_error"></span>
        </div>
    </div>
    <!-------- Marital Status ----->
    <div class="form-group row">
        <label for="marital_status" class="col-md-3 col-form-label">
            {{ __('Marital Status') }} <span class="text-danger">*</span>
        </label>
        <div class="col-md-9">
            <select class="form-control select2" style="width: 100%;" name="marital_status" id="marital_status_create">
                <option selected="selected" disabled >{{ __('Select Marital Status') }}</option>
                <option value="single">{{ __('Single') }}</option>
                <option value="married">{{ __('Married') }}</option>
                <option value="divorced">{{ __('Divorced') }}</option>
                <option value="dead_divorced">{{ __('Dead Divorced') }}</option>
            </select>
            <span class="text-danger error-text marital_status_create_error"></span>
        </div>
    </div>
    <!-------- Job Status ----->
    <div class="form-group row">
        <label for="work_id_create" class="col-md-3 col-form-label">
            {{ __('Job Status') }} <span class="text-danger">*</span>
        </label>
        <div class="col-md-9">
            <select class="form-control select2" style="width: 100%;" name="work_id" id="work_id_create">
                <option selected="selected" disabled >{{ __('Select Job Status') }}</option>
                @foreach ($works as $work)
                    <option value="{{ $work->id }}">{{ $work->name }}</option>
                @endforeach
            </select>
            <span class="text-danger error-text work_id_create_error"></span>
        </div>
    </div>
    <!-------- Graduate Status ----->
    <div class="form-group row">
        <label for="graduated_id_create" class="col-md-3 col-form-label">
            {{ __('Graduate Status') }} <span class="text-danger">*</span>
        </label>
        <div class="col-md-9">
            <select class="form-control select2" style="width: 100%;" name="graduated_id" id="graduated_id_create">
                <option selected="selected" disabled >{{ __('Select Graduated') }}</option>
                @foreach ($graduateds as $graduated)
                    <option value="{{ $graduated->id }}">{{ $graduated->name }}</option>
                @endforeach
            </select>
            <span class="text-danger error-text graduated_id_create_error"></span>
        </div>
    </div>
    <!-------- Phone Number ----->
    <div class="form-group row">
        <label for="phoneNumber_create" class="col-md-3 col-form-label">
            {{ __('Number Phone') }} <span class="text-danger">*</span>
        </label>
        <div class="col-md-9">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text text-bold">(+62)</span>
                </div>
                <input class="form-control square error_input_phoneNumber_create" name="phoneNumber" type="text" placeholder="{{ __('Enter') }} {{ __('Enter Your Phone Number') }}" oninput="format(this)">
            </div>
            <span class="text-danger error-text phoneNumber_create_error"></span>
        </div>
    </div>
    <!-------- Address ----->
    <div class="form-group row">
        <label for="InputAddress_create" class="col-md-3 col-form-label">
            {{ __('Address') }} <span class="text-danger">*</span>
        </label>
        <div class="col-md-9">
            <textarea class="form-control error_input_address_create" id="InputAddress_create" name="address" cols="30" rows="2" placeholder="{{ __('Enter Your Address') }}"></textarea>
            <span class="text-danger error-text address_create_error"></span>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-md-3 col-md-9">
            <button type="submit" class="btn btn-primary float-right mt-4">{{ __('Register Now') }}</button>
        </div>
    </div>
</form>