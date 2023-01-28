<div class="modal fade" id="modal_edit_couple">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title d-flex flex-column">
                    <span class="text-bold d-flex flex-column flex-md-row align-items-md-center">{{ __('Form Edit Couple') }}</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('patient.coupleEdit', auth()->user()->patient->couple->id) }}" method="POST" id="form_create_couple_edit">
            @csrf
            @method('PATCH')
                <div class="modal-body p-0">
                    <div class="card-body">
                        <div class="border-bottom text-danger mb-4 border-dark" >
                            {{ __('* required fileds') }}
                        </div>
                        <!-------- Full Name Couple Edit ----->
                        <div class="form-group row">
                            <label for="inputName" class="col-md-3 col-form-label ">
                                {{ __('Full Name') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control error_input_name_edit_couple" id="inputName" placeholder="{{ __('Enter') }} {{ __('Full Name') }}" name="name_edit" value="{{ auth()->user()->patient->couple->name }}">
                                <span class="text-danger error-text name_edit_couple_error"></span>
                            </div>
                        </div>
                        <!-------- Gender Couple Edit ----->
                        <div class="form-group row">
                            <label for="gender_edit" class="col-md-3 col-form-label">
                                {{ __('Gender') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control error_input_gender_edit_couple" style="width: 100%;" name="gender_edit" id="gender_edit">
                                    <option value="M" {{ auth()->user()->patient->gender == 'M' ? 'disabled' : 'selected' }}>{{ __('Male') }}</option>
                                    <option value="F" {{ auth()->user()->patient->gender == 'F' ? 'disabled' : 'selected' }}>{{ __('Female') }}</option>
                                </select>
                                <span class="text-danger error-text gender_edit_couple_error"></span>
                            </div>
                        </div>
                        <!-------- Place of Birthday Couple Edit ----->
                        <div class="form-group row">
                            <label for="inputPlaceBrithday" class="col-md-3 col-form-label ">
                                {{ __('Place of Birthday') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control error_input_place_brithday_edit_couple" id="inputPlaceBrithday" placeholder="{{ __('Enter') }} {{ __('Place of Birthday') }}" value="{{ auth()->user()->patient->couple->place_brithday }}" name="place_brithday_edit">
                                <span class="text-danger error-text place_brithday_edit_couple_error"></span>
                            </div>
                        </div>
                        <!-------- Date of Birthday Couple Edit ----->
                        <div class="form-group row align-items-center">
                            <label for="inputDateBrithday" class="col-md-3 col-form-label">
                                {{ __('Date of Birthday') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group date" id="reservationdate_edit_couple" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input error_input_date_brithday_edit_couple" placeholder="{{ __('Enter your Date of Birth') }}" data-target="#reservationdate_edit_couple" value="{{ date('d-m-Y', strtotime(auth()->user()->patient->couple->date_brithday)) }}" name="date_brithday_edit">
                                    <div class="input-group-append" data-target="#reservationdate_edit_couple" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <small>{{ __('Example') }}: 30-12-1995</small><br>
                                <span class="text-danger error-text date_brithday_edit_couple_error"></span>
                            </div>
                        </div>
                        <!-------- Job Status Couple Edit ----->
                        <div class="form-group row">
                            <label for="work_id_edit" class="col-md-3 col-form-label">
                                {{ __('Job Status') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control select2" style="width: 100%;" name="work_id_edit" id="work_id_edit_couple">
                                    <option selected="selected" disabled >{{ __('Select Job Status') }}</option>
                                        @if(auth()->user()->patient->gender == 'F')
                                            @foreach ($works->whereNotIn('work_status', 'female') as $work)
                                                @if(auth()->user()->patient->couple->work_id != '' && auth()->user()->patient->couple->work->id  == $work->id)
                                                <option value="{{ $work->id }}" selected>{{ $work->name }}</option>
                                                @else
                                                <option value="{{ $work->id }}">{{ $work->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach ($works->whereNotIn('work_status', 'male') as $work)
                                                @if(auth()->user()->patient->couple->work_id != '' && auth()->user()->patient->couple->work->id  == $work->id)
                                                <option value="{{ $work->id }}" selected>{{ $work->name }}</option>
                                                @else
                                                <option value="{{ $work->id }}">{{ $work->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                </select>
                                <span class="text-danger error-text work_id_edit_couple_error"></span>
                            </div>
                        </div>
                        <!-------- Graduate Status Couple Edit ----->
                        <div class="form-group row">
                            <label for="graduated_id" class="col-md-3 col-form-label">
                                {{ __('Graduate Status') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control select2" style="width: 100%;" name="graduated_id_edit" id="graduated_id_edit_couple">
                                    <option selected="selected" disabled >{{ __('Select Graduated') }}</option>
                                    @foreach ($graduateds as $graduated)
                                        @if(auth()->user()->patient->couple->graduated_id != '' && auth()->user()->patient->couple->graduated->id  == $graduated->id)
                                        <option value="{{ $graduated->id }}" selected>{{ $graduated->name }}</option>
                                        @else
                                        <option value="{{ $graduated->id }}">{{ $graduated->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="text-danger error-text graduated_id_edit_couple_error"></span>
                            </div>
                        </div>
                        <!-------- Number Phone Couple Edit ----->
                        <div class="form-group row">
                            <label for="phoneNumber" class="col-md-3 col-form-label">
                                {{ __('Number Phone') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-bold">(+62)</span>
                                    </div>
                                    <input class="form-control square error_input_phoneNumber_edit_couple" name="phoneNumber_edit" type="text" placeholder="{{ __('Enter') }} {{ __('Number Phone') }}" value="{{ auth()->user()->patient->couple->phoneNumber }}" oninput="format(this)">
                                </div>
                                <span class="text-danger error-text phoneNumber_edit_couple_error"></span>
                            </div>
                        </div>
                        <!-------- Address Couple Edit ----->
                        <div class="form-group row">
                            <label for="InputAddress" class="col-md-3 col-form-label">
                                {{ __('Address') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <textarea class="form-control error_input_address_edit_couple" id="InputAddress_edit" name="address_edit" cols="30" rows="2" placeholder="{{ __('Enter') }} {{ __('Address') }}">{{ auth()->user()->patient->couple->address }}</textarea>
                                <span class="text-danger error-text address_edit_couple_error"></span>
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