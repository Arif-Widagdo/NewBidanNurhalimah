<!----- Row Patient ------>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-6">
                <ul class="list-group list-group-unbordered " style="list-style-type: none;">
                    <li class="d-flex flex-row align-items-start">
                        <p class="col-5 border-right">{{ __('Name') }}</p>
                        <p class="col-7 text-bold">
                            {{ $patient->name != '' ? $patient->name : '-' }}
                        </p>
                    </li>
                    <li class="d-flex flex-row align-items-start">
                        <p class="col-5 border-right">{{ __('Gender') }}</p>
                        <p class="col-7 text-bold ">
                            @if($patient->gender == 'M')
                            {{ __('Male') }}
                            @elseif($patient->gender == 'F')
                            {{ __('Female') }}
                            @else
                            -
                            @endif
                        </p>
                    </li>
                    <li class="d-flex flex-row align-items-start">
                        <p class="col-5 border-right">{{ __('Place and date of birth') }}</p>
                        <p class="col-7 text-bold">
                            {{ $patient->place_brithday && $patient->date_brithday != '' ? $patient->place_brithday.', '.date('d-m-Y', strtotime($patient->date_brithday))   : '-'  }}
                        </p>
                    </li>
                    <li class="d-flex flex-row align-items-start">
                        <p class="col-5 border-right">{{ __('Age') }}</p>
                        <p class="col-7 text-bold ">
                            {{ $patient->date_brithday != '' ? $ageInYears : '-' }}
                        </p>
                    </li>
                </ul>
            </div>
            <div class="col-6">
                <ul class="list-group list-group-unbordered " style="list-style-type: none;">
                    <li class="d-flex flex-row align-items-start">
                        <p class="col-5 border-right">{{ __('Marital Status') }}</p>
                        <p class="col-7 text-bold ">
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
                    <li class="d-flex flex-row align-items-start ">
                        <p class="col-5 border-right">{{ __('Job Status') }}</p>
                        <p class="col-7 text-bold ">
                            {{ $patient->work_id != '' ? $patient->work->name : '-' }}
                        </p>
                    </li>
                    <li class="d-flex flex-row align-items-start">
                        <p class="col-5 border-right">{{ __('Graduate Status') }}</p>
                        <p class="col-7 text-bold ">
                            {{ $patient->graduated_id != '' ? $patient->graduated->name : '-' }}
                        </p>
                    </li>
                    <li class="d-flex flex-row align-items-start">
                        <p class="col-5 border-right">{{ __('Number Phone') }}</p>
                        <p class="col-7 text-bold ">
                            {{ $patient->phoneNumber != '' ? $patient->phoneNumber : '-' }}
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
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