<div class="row">
    <div class="col-12">
        <div class="card card-widget widget-user-2" style="border: none !important; box-shadow:none !important; border-radius:0px !important;">
            <div class="widget-user-header elevation-1">
                <div class="row" style="position: relative !important;">
                    <div class="widget-user-image">
                        @if($patient->account)
                            <img class="img-circle elevation-2" src="{{ $patient->account->picture }}" alt="{{ $patient->account->username }}">
                        @else
                            <img class="img-circle elevation-2" src="{{ asset('dist/img/users/no-image2.png') }}" alt="{{ $patient->name }}">
                        @endif
                    </div>
                    <div class="btn-group" style="position: absolute !important; right:0 !important; top:0;">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" title="{{ __('Change Picture') }}" data-placement="right">
                            <i class="fas fa-pen mr-1"></i> <span class="sr-only">{{ __('Change Picture') }}</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <a href="javascript:void(0)" id="change_picture_btn" class="dropdown-item"><i class="fas fa-user-edit mr-1"></i><span>{{ __('Change Picture') }}</span></a>
                        </div>
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
                        <div>
                            <h5 class="text-bold">#{{ __('Couple Informations') }}</h5>
                            <hr>
                            @include('crew.patient_management.acceptor_management.partials._row_couple_Information')
                        </div>
                        @else
                        @include('crew.patient_management.acceptor_management.partials._row_couple_create')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>