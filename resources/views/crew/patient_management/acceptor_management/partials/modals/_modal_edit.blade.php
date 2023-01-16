<!--- Modal Edit -->
@if($patient->acceptor->count() > 0)
@foreach ($acceptors as $acceptor_edit)
<div class="modal fade" id="modal_edit_acceptors{{ $acceptor_edit->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title"><i class="fas fa-edit"></i> {{ __('Data Inspection Edit Form') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('acceptors.update', $acceptor_edit->id) }}" id="form_edit_acceptor{{ $loop->iteration }}">
                @csrf 
                @method('PATCH')
                <div class="modal-body">
                    <div class="border-bottom text-danger mb-4 border-dark" >
                        {{ __('* required fileds') }}
                    </div>
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    <!--------- Attendance Date ---------->
                    <div class="form-group row">
                        <label for="attendance_edit{{ $loop->iteration }}" class="col-md-3 col-form-label">
                            {{ __('Coming Date') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <div class="input-group date" id="attendance_edit{{ $loop->iteration }}" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input error_input_attendance_date_edit" placeholder="{{ __('Enter') }} {{ __('Coming Date') }}" data-target="#attendance_edit{{ $loop->iteration }}" value="{{ date('d-m-Y', strtotime($acceptor_edit->attendance_date)) }}" name="attendance_date_edit">
                                <div class="input-group-append" data-target="#attendance_edit{{ $loop->iteration }}" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <span class="text-danger error-text attendance_date_edit_error"></span>
                        </div>
                    </div>
                    <!--------- Menstrual Date ---------->
                    <div class="form-group row">
                        <label for="menstrual_edit{{ $loop->iteration }}" class="col-md-3 col-form-label">
                            {{ __('Date of Last Menstruation') }}
                        </label>
                        <div class="col-md-9">
                            <div class="input-group date" id="menstrual_edit{{ $loop->iteration }}" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input error_input_menstrual_date_edit" placeholder="{{ __('Enter') }} {{ __('Date of Last Menstruation') }}" data-target="#menstrual_edit{{ $loop->iteration }}" value="{{ $acceptor->menstrual_date != '' ? date('d-m-Y', strtotime($acceptor_edit->menstrual_date)) : '' }}" name="menstrual_date_edit">
                                <div class="input-group-append" data-target="#menstrual_edit{{ $loop->iteration }}" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <span class="text-danger error-text menstrual_date_edit_error"></span>
                        </div>
                    </div>
                    <!--------- Weight ---------->
                    <div class="form-group row">
                        <label for="inputWeight" class="col-md-3 col-form-label ">
                            {{ __('B Weight') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="number" min="40" class="form-control error_input_weight_edit" id="inputWeight" placeholder="{{ __('Enter') }} {{ __('B Weight') }}" value="{{ $acceptor_edit->weight }}" name="weight_edit">
                            <span class="text-danger error-text weight_edit_error"></span>
                        </div>
                    </div>
                    <!--------- Blood Pressure ---------->
                    <div class="form-group row">
                        <label for="inputBlood" class="col-md-3 col-form-label ">
                            {{ __('Blood Pressure') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control error_input_blood_pressure_edit" id="inputBlood" placeholder="{{ __('Enter') }} {{ __('Blood Pressure') }}" value="{{ $acceptor_edit->blood_pressure }}" name="blood_pressure_edit" oninput="formatBlood(this)">
                            <span class="text-danger error-text blood_pressure_edit_error"></span>
                        </div>
                    </div>
                    <!--------- Complication & Failure ---------->
                    <div class="form-group row">
                        <label for="inputAkibat" class="col-md-3 col-form-label ">
                            {{ __('Effect') }}
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control error_input_complication_edit" id="inputAkibat" placeholder="{{ __('Serious Complication_edits') }}" value="{{ $acceptor_edit->complication }}" name="complication_edit">
                            <span class="text-danger error-text complication_edit_error"></span>
                            <input type="text" class="form-control error_input_failure_edit mt-3" id="inputFailure" placeholder="{{ __('Failure') }}" value="{{ $acceptor_edit->failure }}" name="failure_edit">
                            <span class="text-danger error-text failure_edit_error"></span>
                        </div>
                    </div>
                    <!-------- Job Status Couple Create ----->
                    <div class="form-group row">
                        <label for="birthControl_id_edit" class="col-md-3 col-form-label">
                            {{ __('Birth Control') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <select class="form-control select2" style="width: 100%;" name="birthControl_id_edit" id="birthControl_id_edit">
                                <option selected="selected" disabled >{{ __('Select Birth Control') }}</option>
                                @foreach ($birthControls as $birthControl)
                                    @if($acceptor_edit->birthControl_id != '' && $acceptor_edit->birthControl->id  == $birthControl->id)
                                    <option value="{{ $birthControl->id }}" selected>{{ $birthControl->name }}</option>
                                    @else
                                    <option value="{{ $birthControl->id }}">{{ $birthControl->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="text-danger error-text birthControl_id_edit_error"></span>
                        </div>
                    </div>
                    <!-------- Return Visit Date ----->
                    <div class="form-group row">
                        <label for="return_date_edit{{ $loop->iteration }}" class="col-md-3 col-form-label">
                            {{ __('Return Visit Date') }}
                        </label>
                        <div class="col-md-9">
                            <div class="input-group date" id="return_date_edit{{ $loop->iteration }}" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input error_input_return_date_edit" placeholder="{{ __('Enter') }} {{ __('Return Visit Date') }}" data-target="#return_date_edit{{ $loop->iteration }}" value="{{ $acceptor->menstrual_date != '' ? date('d-m-Y', strtotime($acceptor_edit->return_date)) : '' }}" name="return_date_edit">
                                <div class="input-group-append" data-target="#return_date_edit{{ $loop->iteration }}" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <span class="text-danger error-text return_date_edit_error"></span>
                        </div>
                    </div>
                    <!-------- Address Couple Create ----->
                    <div class="form-group row">
                        <label for="InputDesc" class="col-md-3 col-form-label">
                            {{ __('Description') }}
                        </label>
                        <div class="col-md-9">
                            <textarea class="form-control error_input_description_edit" id="inputDesc" name="description_edit" cols="30" rows="2" placeholder="{{ __('Description') }}">{{ $acceptor_edit->description }}</textarea>
                            <span class="text-danger error-text description_edit_error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-dark">{{ __('Save Changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endif
<!-- /.modal -->