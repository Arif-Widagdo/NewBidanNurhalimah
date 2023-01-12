<!--- Modal Show -->
@foreach ($staffs as $staff_show)
<div class="modal fade" id="modal-show-staff{{ $staff_show->employe_id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">#{{ $staff_show->employe_id }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card card-widget widget-user-2 shadow-none border-none" style="border: none !important; box-shadow:none !important; border-radius:0px !important;">
                    <div class="widget-user-header elevation-1">
                        <div class="row">
                            <div class="widget-user-image" style="position: relative !important;">
                                @if($staff_show->account)
                                    <img class="img-circle elevation-2" src="{{ $staff_show->account->picture }}" alt="{{ $staff_show->account->username }}">
                                @else
                                    <img class="img-circle elevation-2" src="{{ asset('dist/img/users/no-image2.png') }}" alt="{{ $staff_show->name }}">
                                @endif
                                @if($staff_show->account)
                                <div style="position: absolute; right:2px; top:2px;">
                                    @if($staff_show->account->status == 'actived')
                                    <div style="width: 16px; height:16px; border-radius:100%; background-color:#28A745"></div>
                                    @else
                                    <div style="width: 16px; height:16px; border-radius:100%; background-color:#DC3545"></div>
                                    @endif
                                </div>
                                @endif
                            </div>
                            <div class="d-flex flex-column ml-2">
                                <h3 class="name_user mr-2 mt-1">{{ $staff_show->name }}</h3>
                                <p class="user_email" style="margin-top: -10px !important">{{ $staff_show->position->name }}</p>
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
                                                <p class="col-lg-5 border-right">{{ __('Position') }}</p>
                                                <p class="col-lg-7 text-bold">
                                                    {{ $staff_show->position_id != '' ? $staff_show->position->name : '-' }}
                                                </p>
                                            </li>
                                            <li class="d-flex flex-column flex-lg-row align-items-start">
                                                <p class="col-lg-5 border-right">{{ __('Name') }}</p>
                                                <p class="col-lg-7 text-bold">
                                                    {{ $staff_show->name != '' ? $staff_show->name : '-' }}
                                                </p>
                                            </li>
                                            <li class="d-flex flex-column flex-lg-row align-items-start">
                                                <p class="col-lg-5 border-right">{{ __('Gender') }}</p>
                                                <p class="col-lg-7 text-bold ">
                                                    @if($staff_show->gender == 'M')
                                                    {{ __('Male') }}
                                                    @elseif($staff_show->gender == 'F')
                                                    {{ __('Female') }}
                                                    @else
                                                    -
                                                    @endif
                                                </p>
                                            </li>
                                            <li class="d-flex flex-column flex-lg-row align-items-start">
                                                <p class="col-lg-5 border-right">{{ __('Place and date of birth') }}</p>
                                                <p class="col-lg-7 text-bold">
                                                    {{ $staff_show->place_brithday && $staff_show->date_brithday != '' ? $staff_show->place_brithday.', '.date('d-m-Y', strtotime($staff_show->date_brithday))   : '-'  }} 
                                                </p>
                                            </li>
                                            <li class="d-flex flex-column flex-lg-row align-items-start">
                                                <p class="col-lg-5 border-right">{{ __('Address') }}</p>
                                                <p class="col-lg-7 text-bold ">
                                                    {{ $staff_show->address != '' ? $staff_show->address : '-' }}
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6">
                                        <ul class="list-group list-group-unbordered " style="list-style-type: none;">
                                            <li class="d-flex flex-column flex-lg-row align-items-start">
                                                <p class="col-lg-5 border-right">{{ __('Age') }}</p>
                                                <p class="col-lg-7 text-bold ">
                                                    {{ $staff_show->date_brithday != '' ? \Carbon\Carbon::parse($staff_show->date_brithday)->diff(\Carbon\Carbon::now())->format('%y ' . __('Years') ) : '-' }}
                                                </p>
                                            </li>
                                            <li class="d-flex flex-column flex-lg-row align-items-start">
                                                <p class="col-lg-5 border-right">{{ __('Graduate Status') }}</p>
                                                <p class="col-lg-7 text-bold ">
                                                    {{ $staff_show->graduated_id != '' ? $staff_show->graduated->name : '-' }}
                                                </p>
                                            </li>
                                            <li class="d-flex flex-column flex-lg-row align-items-start">
                                                <p class="col-lg-5 border-right">{{ __('Number Phone') }}</p>
                                                <p class="col-lg-7 text-bold ">
                                                    {{ $staff_show->phoneNumber != '' ? $staff_show->phoneNumber : '-' }}
                                                </p>
                                            </li>
                                            <li class="d-flex flex-column flex-lg-row align-items-start">
                                                <p class="col-lg-5 border-right">{{ __('Username') }}</p>
                                                <p class="col-lg-7 text-bold ">
                                                    {{ $staff_show->user_id != '' ? $staff_show->account->username : '-' }}
                                                </p>
                                            </li>
                                            <li class="d-flex flex-column flex-lg-row align-items-start">
                                                <p class="col-lg-5 border-right">{{ __('Email') }}</p>
                                                <p class="col-lg-7 text-bold ">
                                                    {{ $staff_show->user_id != '' ? $staff_show->account->email : '-' }}
                                                </p>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- /.modal -->