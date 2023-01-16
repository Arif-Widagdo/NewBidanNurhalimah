<div class="row">
    <div class="col-12">
        <div class="card card-widget widget-user-2" style="border: none !important; box-shadow:none !important; border-radius:0px !important;">
            <div class="widget-user-header elevation-1">
                <div class="row">
                    <div class="widget-user-image">
                        @if($patient->account)
                            <img class="img-circle elevation-2" src="{{ $patient->account->picture }}" alt="{{ $patient->account->username }}">
                        @else
                            <img class="img-circle elevation-2" src="{{ asset('dist/img/users/no-image2.png') }}" alt="{{ $patient->name }}">
                        @endif
                    </div>
                    <div class="d-flex flex-column ml-2">
                        <h3 class="name_user mr-2 mt-1">{{ $patient->name }}</h3>
                        <p class="user_email" style="margin-top: -10px !important">#{{ $patient->no_rm }} </p>
                    </div>
                </div>
                <hr>
                <!----- Row Patient ------>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-group list-group-unbordered " style="list-style-type: none;">
                                    <li class="d-flex flex-column flex-lg-row align-items-start">
                                        <p class="col-lg-5 border-right">{{ __('Name') }}</p>
                                        <p class="col-lg-7 text-bold">
                                            {{ $patient->name != '' ? $patient->name : '-' }}
                                        </p>
                                    </li>
                                    <li class="d-flex flex-column flex-lg-row align-items-start">
                                        <p class="col-lg-5 border-right">{{ __('Gender') }}</p>
                                        <p class="col-lg-7 text-bold ">
                                            @if($patient->gender == 'M')
                                            {{ __('Male') }}
                                            @elseif($patient->gender == 'F')
                                            {{ __('Female') }}
                                            @else
                                            -
                                            @endif
                                        </p>
                                    </li>
                                    <li class="d-flex flex-column flex-lg-row align-items-start">
                                        <p class="col-lg-5 border-right">{{ __('Place and date of birth') }}</p>
                                        <p class="col-lg-7 text-bold">
                                            {{ $patient->place_brithday && $patient->date_brithday != '' ? $patient->place_brithday.', '.date('d-m-Y', strtotime($patient->date_brithday))   : '-'  }} 
                                        </p>
                                    </li>
                                    <li class="d-flex flex-column flex-lg-row align-items-start">
                                        <p class="col-lg-5 border-right">{{ __('Age') }}</p>
                                        <p class="col-lg-7 text-bold ">
                                            {{ $patient->date_brithday != '' ? $ageInYears : '-' }}
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-group list-group-unbordered " style="list-style-type: none;">
                                    <li class="d-flex flex-column flex-lg-row align-items-start">
                                        <p class="col-lg-5 border-right">{{ __('Marital Status') }}</p>
                                        <p class="col-lg-7 text-bold ">
                                            @if ($patient->marital_status == 'married')
                                            {{ __('Married') }}
                                            @elseif($patient->marital_status == 'divorced')
                                                {{ __('Divorced') }}
                                            @elseif($patient->marital_status == 'dead_divorced')
                                                {{ __('Dead Divorced') }}
                                            @else
                                                {{ __('Single') }}
                                            @endif
                                        </p>
                                    </li>
                                    <li class="d-flex flex-column flex-lg-row align-items-start ">
                                        <p class="col-lg-5 border-right">{{ __('Job Status') }}</p>
                                        <p class="col-lg-7 text-bold ">
                                            {{ $patient->work_id != '' ? $patient->work->name : '-' }}
                                        </p>
                                    </li>
                                    <li class="d-flex flex-column flex-lg-row align-items-start">
                                        <p class="col-lg-5 border-right">{{ __('Graduate Status') }}</p>
                                        <p class="col-lg-7 text-bold ">
                                            {{ $patient->graduated_id != '' ? $patient->graduated->name : '-' }}
                                        </p>
                                    </li>
                                    <li class="d-flex flex-column flex-lg-row align-items-start">
                                        <p class="col-lg-5 border-right">{{ __('Number Phone') }}</p>
                                        <p class="col-lg-7 text-bold ">
                                            {{ $patient->phoneNumber != '' ? $patient->phoneNumber : '-' }}
                                        </p>
                                    </li>
                                    <li class="d-flex d-lg-none flex-column flex-lg-row align-items-start">
                                        <p class="col-lg-5 border-right">{{ __('Address') }}</p>
                                        <p class="col-lg-7 text-bold ">
                                            {{ $patient->address != '' ? $patient->address : '-' }}
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
                                        {{ $patient->address != '' ? $patient->address : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!----- Row Couple ------>
                <hr>
                <div class="row">
                    <div class="col-12">
                        @if($patient->couple)
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-bold">#{{ __('Couple Informations') }}</h5>
                            <a href="#" class="btn btn-light border"  data-toggle="modal" data-target="#modal_edit_couple{{ $patient->couple->id }}"><i class="fas fa-user-edit mr-1"></i> {{ __('Edit') }}</a>
                        </div>
                        <hr>
                        @include('crew.patient_management.acceptor_management.partials._row_couple_Information')
                        @else
                        @include('crew.patient_management.acceptor_management.partials._row_couple_create')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--------  Modal Edit Couple ------>
@if($patient->couple)
<div class="modal fade" id="modal_edit_couple{{ $patient->couple->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title d-flex flex-column">
                    <span class="text-bold d-flex flex-column flex-md-row align-items-md-center">{{ __('Form Edit Couple') }} <small class="ml-md-2">({{ __('No. Medical records') }} #{{ $patient->no_rm }})</small></span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('couples.update', $patient->couple->id) }}" method="POST" id="form_create_couple_edit">
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
                                <input type="text" class="form-control error_input_name" id="inputName" placeholder="{{ __('Enter') }} {{ __('Full Name') }}" name="name_edit" value="{{ $patient->couple->name }}">
                                <span class="text-danger error-text name_edit_error"></span>
                            </div>
                        </div>
                        <!-------- Gender Couple Edit ----->
                        <div class="form-group row">
                            <label for="gender_edit" class="col-md-3 col-form-label">
                                {{ __('Gender') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control error_input_gender_edit" style="width: 100%;" name="gender_edit" id="gender_edit">
                                    <option value="M" {{ $patient->gender == 'M' ? 'disabled' : 'selected' }}>{{ __('Male') }}</option>
                                    <option value="F" {{ $patient->gender == 'F' ? 'disabled' : 'selected' }}>{{ __('Female') }}</option>
                                </select>
                                <span class="text-danger error-text gender_edit_error"></span>
                            </div>
                        </div>
                        <!-------- Place of Birthday Couple Edit ----->
                        <div class="form-group row">
                            <label for="inputPlaceBrithday" class="col-md-3 col-form-label ">
                                {{ __('Place of Birthday') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control error_input_place_brithday_edit" id="inputPlaceBrithday" placeholder="{{ __('Enter') }} {{ __('Place of Birthday') }}" value="{{ $patient->couple->place_brithday }}" name="place_brithday_edit">
                                <span class="text-danger error-text place_brithday_edit_error"></span>
                            </div>
                        </div>
                        <!-------- Date of Birthday Couple Edit ----->
                        <div class="form-group row align-items-center">
                            <label for="inputDateBrithday" class="col-md-3 col-form-label">
                                {{ __('Date of Birthday') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group date" id="reservationdate_edit_couple" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input error_input_date_brithday_edit" placeholder="{{ __('Enter your Date of Birth') }}" data-target="#reservationdate_edit_couple" value="{{ date('d-m-Y', strtotime($patient->couple->date_brithday)) }}" name="date_brithday_edit">
                                    <div class="input-group-append" data-target="#reservationdate_edit_couple" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <small>{{ __('Example') }}: 30-12-1995</small><br>
                                <span class="text-danger error-text date_brithday_edit_error"></span>
                            </div>
                        </div>
                        <!-------- Job Status Couple Edit ----->
                        <div class="form-group row">
                            <label for="work_id_edit" class="col-md-3 col-form-label">
                                {{ __('Job Status') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control select2" style="width: 100%;" name="work_id_edit" id="work_id_edit">
                                    <option selected="selected" disabled >{{ __('Select Job Status') }}</option>
                                        @if($patient->gender == 'F')
                                            @foreach ($works->whereNotIn('work_status', 'female') as $work)
                                                @if($patient->couple->work_id != '' && $patient->couple->work->id  == $work->id)
                                                <option value="{{ $work->id }}" selected>{{ $work->name }}</option>
                                                @else
                                                <option value="{{ $work->id }}">{{ $work->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach ($works->whereNotIn('work_status', 'male') as $work)
                                                @if($patient->couple->work_id != '' && $patient->couple->work->id  == $work->id)
                                                <option value="{{ $work->id }}" selected>{{ $work->name }}</option>
                                                @else
                                                <option value="{{ $work->id }}">{{ $work->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                </select>
                                <span class="text-danger error-text work_id_edit_error"></span>
                            </div>
                        </div>
                        <!-------- Graduate Status Couple Edit ----->
                        <div class="form-group row">
                            <label for="graduated_id" class="col-md-3 col-form-label">
                                {{ __('Graduate Status') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control select2" style="width: 100%;" name="graduated_id_edit" id="graduated_id_edit">
                                    <option selected="selected" disabled >{{ __('Select Graduated') }}</option>
                                    @foreach ($graduateds as $graduated)
                                        @if($patient->couple->graduated_id != '' && $patient->couple->graduated->id  == $graduated->id)
                                        <option value="{{ $graduated->id }}" selected>{{ $graduated->name }}</option>
                                        @else
                                        <option value="{{ $graduated->id }}">{{ $graduated->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="text-danger error-text graduated_id_edit_error"></span>
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
                                    <input class="form-control square error_input_phoneNumber_edit" name="phoneNumber_edit" type="text" placeholder="{{ __('Enter') }} {{ __('Number Phone') }}" value="{{ $patient->couple->phoneNumber }}" oninput="format(this)">
                                </div>
                                <span class="text-danger error-text phoneNumber_edit_error"></span>
                            </div>
                        </div>
                        <!-------- Address Couple Edit ----->
                        <div class="form-group row">
                            <label for="InputAddress" class="col-md-3 col-form-label">
                                {{ __('Address') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <textarea class="form-control error_input_address_edit" id="InputAddress_edit" name="address_edit" cols="30" rows="2" placeholder="{{ __('Enter') }} {{ __('Address') }}">{{ $patient->couple->address }}</textarea>
                                <span class="text-danger error-text address_edit_error"></span>
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
@endif