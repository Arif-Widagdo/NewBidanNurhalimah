<style>
     /* .text_rm {
            text-decoration: underline;
        }  */
        .text_rm {
            color: #5A5A5A;
        }
</style>

<div class="card shadow-none border">
    <div class="card-header">
        <h5 class="text-bold">#{{ __('Couple Informations') }}</h5>
        <h6 class="border-bottom border-top py-2 d-inline-block text_rm"><i class="fas fa-info"></i> {{ __('Please Complete Couple Informations') }}
            <small class="text-danger d-flex align-items-center justify-content-between">
                <span>{{ __('* required fileds') }}</span>
            </small>
        </h6>
       
    </div>
    <form action="{{ route('couples.store') }}" method="POST" id="form_create_couple">
        @csrf
        <div class="card-body">
            {{-- <div class="text-danger d-flex align-items-center justify-content-between">
                <span>{{ __('* required fileds') }}</span>
            </div>
            <hr> --}}
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
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
                        <option value="M" {{ $patient->gender == 'M' ? 'disabled' : 'selected' }}>{{ __('Male') }}</option>
                        <option value="F" {{ $patient->gender == 'F' ? 'disabled' : 'selected' }}>{{ __('Female') }}</option>
                    </select>
                    <span class="text-danger error-text gender_error"></span>
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
                <label for="work_id" class="col-md-3 col-form-label">
                    {{ __('Job Status') }} <span class="text-danger">*</span>
                </label>
                <div class="col-md-9">
                    <select class="form-control select2" style="width: 100%;" name="work_id" id="work_id">
                        <option selected="selected" disabled >{{ __('Select Job Status') }}</option>
                        @foreach ($works as $work)
                            <option value="{{ $work->id }}">{{ $work->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error-text work_id_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="graduated_id" class="col-md-3 col-form-label">
                    {{ __('Graduate Status') }} <span class="text-danger">*</span>
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
            <button type="submit" class="btn btn-primary float-right text-bold px-4 py-2 text-md" style="letter-spacing: 1px;">{{ __('Submit') }} </button>
        </div>
    </form>
</div>