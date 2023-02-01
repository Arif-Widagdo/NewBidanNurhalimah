<!--- Modal Show -->
@foreach ($users as $user)
<div class="modal fade" id="modal-edit-staff{{ $user->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title"><i class="fa fa-user-nurse"></i> {{ __('Employee Account Edit Form') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.update', $user->id) }}" method="POST" id="form_edit_staff{{ $loop->iteration }}">
            @csrf
            @method('PATCH')
                <div class="modal-body p-0">
                    <div class="card card-widget widget-user-2 shadow-none border-none" style="border: none !important; box-shadow:none !important; border-radius:0px !important;">
                        <div class="widget-user-header elevation-1">
                            <div class="row">
                                <div class="widget-user-image" style="position: relative !important;">
                                    <img class="img-circle elevation-2" src="{{ $user->picture }}" alt="{{ $user->username }}">
                                    <div style="position: absolute; right:2px; top:2px;">
                                        @if($user->status == 'actived')
                                        <div style="width: 16px; height:16px; border-radius:100%; background-color:#28A745"></div>
                                        @else
                                        <div style="width: 16px; height:16px; border-radius:100%; background-color:#DC3545"></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex flex-column ml-2">
                                    <h3 class="name_user mr-2 mt-1">{{ $user->staff ? $user->staff->name : '-' }}</h3>
                                    <p class="user_email" style="margin-top: -10px !important">{{ $user->staff ? $user->staff->position->name : '-' }}</p>
                                </div>
                            </div>
                            <hr>
                            <!----- Row Patient ------>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row px-2">
                                        <!----- Username ------->
                                        <div class="col-lg-4">
                                            <div class="form-group mb-1">
                                                <label for="username" class="col-form-label">
                                                    {{ __('Username') }}<span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control error_input_username" id="username" placeholder="{{ __('Enter') }} {{ __('Username') }}" value="{{ $user->username }}" name="username">
                                                <span class="text-danger error-text username_error"></span>
                                            </div>
                                        </div>
                                        <!----- Email ------->
                                        <div class="col-lg-4">
                                            <div class="form-group mb-1">
                                                <label for="email" class="col-form-label">
                                                    {{ __('Email') }}<span class="text-danger">*</span>
                                                </label>
                                                <input type="email" class="form-control error_input_email" id="email" placeholder="{{ __('Enter') }} {{ __('Email') }}" value="{{ $user->email }}" name="email">
                                                <span class="text-danger error-text email_error"></span>
                                            </div>
                                        </div>
                                        <!----- Status Activation Account ------->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="status" class="col-form-label">
                                                    {{ __('Activation Status') }}<span class="text-danger">*</span>
                                                </label>
                                                <select class="form-control error_input_status" style="width: 100%;" name="status" id="status">
                                                    <option selected="selected" disabled>{{ __('Select status') }}</option>
                                                    <option {{ $user->status == 'actived' ? "selected='selected'" : '' }} value="actived">{{ __('Active') }}</option>
                                                    <option {{ $user->status == 'blocked' ? "selected='selected'" : '' }} value="blocked">{{ __('Blocked') }}</option>
                                                </select>
                                                <span class="text-danger error-text status_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($staffs->where('user_id', $user->id) as $staff)
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <ul class="list-group list-group-unbordered " style="list-style-type: none;">
                                                <li class="d-flex flex-column flex-lg-row align-items-start">
                                                    <p class="col-lg-5 border-right">{{ __('Position') }}</p>
                                                    <p class="col-lg-7 text-bold">
                                                        {{ $staff->position_id != '' ? $staff->position->name : '-' }}
                                                    </p>
                                                </li>
                                                <li class="d-flex flex-column flex-lg-row align-items-start">
                                                    <p class="col-lg-5 border-right">{{ __('Name') }}</p>
                                                    <p class="col-lg-7 text-bold">
                                                        {{ $staff->name != '' ? $staff->name : '-' }}
                                                    </p>
                                                </li>
                                                <li class="d-flex flex-column flex-lg-row align-items-start">
                                                    <p class="col-lg-5 border-right">{{ __('Gender') }}</p>
                                                    <p class="col-lg-7 text-bold ">
                                                        @if($user->staff->gender == 'M')
                                                        {{ __('Male') }}
                                                        @elseif($user->staff->gender == 'F')
                                                        {{ __('Female') }}
                                                        @else
                                                        -
                                                        @endif
                                                    </p>
                                                </li>
                                                <li class="d-flex flex-column flex-lg-row align-items-start">
                                                    <p class="col-lg-5 border-right">{{ __('Place and date of birth') }}</p>
                                                    <p class="col-lg-7 text-bold">
                                                        {{ $staff->place_brithday && $staff->date_brithday != '' ? $staff->place_brithday.', '.date('d-m-Y', strtotime($user->staff->date_brithday))   : '-'  }} 
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6">
                                            <ul class="list-group list-group-unbordered " style="list-style-type: none;">
                                                <li class="d-flex flex-column flex-lg-row align-items-start">
                                                    <p class="col-lg-5 border-right">{{ __('Age') }}</p>
                                                    <p class="col-lg-7 text-bold ">
                                                        {{ $staff->date_brithday != '' ? \Carbon\Carbon::parse($user->staff->date_brithday)->diff(\Carbon\Carbon::now())->format('%y ' . __('Years') ) : '-' }}
                                                    </p>
                                                </li>
                                                <li class="d-flex flex-column flex-lg-row align-items-start">
                                                    <p class="col-lg-5 border-right">{{ __('Graduate Status') }}</p>
                                                    <p class="col-lg-7 text-bold ">
                                                        {{ $staff->graduated_id != '' ? $staff->graduated->name : '-' }}
                                                    </p>
                                                </li>
                                                <li class="d-flex flex-column flex-lg-row align-items-start">
                                                    <p class="col-lg-5 border-right">{{ __('Number Phone') }}</p>
                                                    <p class="col-lg-7 text-bold ">
                                                        {{ $staff->phoneNumber != '' ? $staff->phoneNumber : '-' }}
                                                    </p>
                                                </li>
                                                <li class="d-flex flex-column flex-lg-row align-items-start">
                                                    <p class="col-lg-5 border-right">{{ __('Address') }}</p>
                                                    <p class="col-lg-7 text-bold ">
                                                        {{ $staff->address != '' ? $staff->address : '-' }}
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach
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