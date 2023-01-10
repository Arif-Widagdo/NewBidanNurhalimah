<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-group list-group-unbordered " style="list-style-type: none;">
                    <li class="d-flex flex-column flex-lg-row align-items-start">
                        <p class="col-lg-5 border-right">{{ __('Name') }}</p>
                        <p class="col-lg-7 text-bold">
                            {{ $patient->couple->name }}
                        </p>
                    </li>
                    <li class="d-flex flex-column flex-lg-row align-items-start">
                        <p class="col-lg-5 border-right">{{ __('Gender') }}</p>
                        <p class="col-lg-7 text-bold ">
                            @if($patient->couple->gender == 'M')
                            {{ __('Male') }}
                            @else
                            {{ __('Female') }}
                            @endif
                        </p>
                    </li>
                    <li class="d-flex flex-column flex-lg-row align-items-start">
                        <p class="col-lg-5 border-right">{{ __('Place and date of birth') }}</p>
                        <p class="col-lg-7 text-bold">
                            {{ $patient->couple->place_brithday.', '.date('d-m-Y', strtotime($patient->couple->date_brithday)) }}
                        </p>
                    </li>
                    <li class="d-flex flex-column flex-lg-row align-items-start">
                        <p class="col-lg-5 border-right">{{ __('Address') }}</p>
                        <p class="col-lg-7 text-bold">
                            {{ $patient->couple->address }}
                        </p>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="list-group list-group-unbordered " style="list-style-type: none;">
                    <li class="d-flex flex-column flex-lg-row align-items-start">
                        <p class="col-lg-5 border-right">{{ __('Age') }}</p>
                        <p class="col-lg-7 text-bold ">
                            {{ \Carbon\Carbon::parse($patient->couple->date_brithday )->diff(\Carbon\Carbon::now())->format('%y ' . __('Years') . ', %m ' . __('Months') . ' ' . __('and') . '  %d ' . __('Days')) }}
                        </p>
                    </li>
                    <li class="d-flex flex-column flex-lg-row align-items-start ">
                        <p class="col-lg-5 border-right">{{ __('Job Status') }}</p>
                        <p class="col-lg-7 text-bold ">
                            {{ $patient->couple->work_id != '' ? $patient->couple->work->name : '-' }}
                        </p>
                    </li>
                    <li class="d-flex flex-column flex-lg-row align-items-start">
                        <p class="col-lg-5 border-right">{{ __('Graduate Status') }}</p>
                        <p class="col-lg-7 text-bold ">
                            {{ $patient->couple->graduated_id != '' ? $patient->couple->graduated->name : '-' }}
                        </p>
                    </li>
                    <li class="d-flex flex-column flex-lg-row align-items-start">
                        <p class="col-lg-5 border-right">{{ __('Number Phone') }}</p>
                        <p class="col-lg-7 text-bold ">
                            {{ $patient->couple->phoneNumber != '' ? $patient->couple->phoneNumber : '-' }}
                        </p>
                    </li>
                    <li class="d-flex d-lg-none flex-column flex-lg-row align-items-start">
                        <p class="col-lg-5 border-right">{{ __('Address') }}</p>
                        <p class="col-lg-7 text-bold ">
                            {{ $patient->couple->address }}
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>