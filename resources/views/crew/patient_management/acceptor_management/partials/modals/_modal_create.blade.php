 <!--- Modal Create -->
 <div class="modal fade" id="modal_create_acceptors">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title"><i class="fas fa-pencil-alt"></i> {{ __('New Inspection Data Form') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('acceptors.store') }}" id="form_create_acceptor">
                @csrf
                <div class="modal-body">
                    <div class="border-bottom text-danger mb-4" style="border-color: #007BFF !important">
                        {{ __('* required fileds') }}
                    </div>
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    <!--------- Attendance Date ---------->
                    <div class="form-group row">
                        <label for="inputAttendance" class="col-md-3 col-form-label">
                            {{ __('Coming Date') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <div class="input-group date" id="attendance" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input error_input_attendance_date" placeholder="{{ __('Enter') }} {{ __('Coming Date') }}" data-target="#attendance" value="" name="attendance_date">
                                <div class="input-group-append" data-target="#attendance" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <span class="text-danger error-text attendance_date_error"></span>
                        </div>
                    </div>
                    <!--------- Menstrual Date ---------->
                    <div class="form-group row">
                        <label for="inputMenstrualDate" class="col-md-3 col-form-label">
                            {{ __('Date of Last Menstruation') }}
                        </label>
                        <div class="col-md-9">
                            <div class="input-group date" id="menstrual" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input error_input_menstrual_date" placeholder="{{ __('Enter') }} {{ __('Date of Last Menstruation') }}" data-target="#menstrual" value="" name="menstrual_date">
                                <div class="input-group-append" data-target="#menstrual" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <span class="text-danger error-text menstrual_date_error"></span>
                        </div>
                    </div>
                    <!--------- Weight ---------->
                    <div class="form-group row">
                        <label for="inputWeight" class="col-md-3 col-form-label ">
                            {{ __('B Weight') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="number" min="40" class="form-control error_input_weight" id="inputWeight" placeholder="{{ __('Enter') }} {{ __('B Weight') }}" name="weight">
                            <span class="text-danger error-text weight_error"></span>
                        </div>
                    </div>
                    <!--------- Blood Pressure ---------->
                    <div class="form-group row">
                        <label for="inputBlood" class="col-md-3 col-form-label ">
                            {{ __('Blood Pressure') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control error_input_blood_pressure" id="inputBlood" placeholder="{{ __('Enter') }} {{ __('Blood Pressure') }}" name="blood_pressure" oninput="formatBlood(this)">
                            <span class="text-danger error-text blood_pressure_error"></span>
                        </div>
                    </div>
                    <!--------- Complication & Failure ---------->
                    <div class="form-group row">
                        <label for="inputAkibat" class="col-md-3 col-form-label ">
                            {{ __('Effect') }}
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control error_input_complication" id="inputAkibat" placeholder="{{ __('Serious Complications') }}" name="complication">
                            <span class="text-danger error-text complication_error"></span>
                            <input type="text" class="form-control error_input_failure mt-3" id="inputFailure" placeholder="{{ __('Failure') }}" name="failure">
                            <span class="text-danger error-text failure_error"></span>
                        </div>
                    </div>
                    <!-------- Job Status Couple Create ----->
                    <div class="form-group row">
                        <label for="birthControl_id" class="col-md-3 col-form-label">
                            {{ __('Birth Control') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <select class="form-control select2" style="width: 100%;" name="birthControl_id" id="birthControl_id">
                                <option selected="selected" disabled >{{ __('Select Birth Control') }}</option>
                                @foreach ($birthControls as $birthControl)
                                    <option value="{{ $birthControl->id }}">{{ $birthControl->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text birthControl_id_error"></span>
                        </div>
                    </div>
                    <!-------- Return Visit Date ----->
                    <div class="form-group row">
                        <label for="" class="col-md-3 col-form-label">
                            {{ __('Return Visit Date') }}
                        </label>
                        <div class="col-md-9">
                            <div class="input-group date" id="returnDate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input error_input_return_date" placeholder="{{ __('Enter') }} {{ __('Return Visit Date') }}" data-target="#returnDate" value="" name="return_date">
                                <div class="input-group-append" data-target="#returnDate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <span class="text-danger error-text return_date_error"></span>
                        </div>
                    </div>
                    <!-------- Address Couple Create ----->
                    <div class="form-group row">
                        <label for="InputDesc" class="col-md-3 col-form-label">
                            {{ __('Description') }}
                        </label>
                        <div class="col-md-9">
                            <textarea class="form-control error_input_description" id="inputDesc" name="description" cols="30" rows="2" placeholder="{{ __('Description') }}"></textarea>
                            <span class="text-danger error-text description_error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->