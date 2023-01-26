<hr>
<div class="row">
    <div class="col-lg-6">
        <ul class="list-group list-group-unbordered " style="list-style-type: none;">
            <li class="d-flex flex-column flex-lg-row align-items-center">
                <p class="col-lg-5 border-right">{{ __('Name') }}</p>
                <p class="col-lg-7 text-bold">
                    {{ auth()->user()->patient->name != '' ? auth()->user()->patient->name : '-' }}
                </p>
            </li>
            <li class="d-flex flex-column flex-lg-row align-items-center">
                <p class="col-lg-5 border-right">{{ __('Gender') }}</p>
                <p class="col-lg-7 text-bold ">
                    @if(auth()->user()->patient->gender == 'M')
                    {{ __('Male') }}
                    @elseif(auth()->user()->patient->gender == 'F')
                    {{ __('Female') }}
                    @else
                    -
                    @endif
                </p>
            </li>
            <li class="d-flex flex-column flex-lg-row align-items-center">
                <p class="col-lg-5 border-right">{{ __('Place and date of birth') }}</p>
                <p class="col-lg-7 text-bold">
                    {{  auth()->user()->patient->place_brithday && auth()->user()->patient->date_brithday != '' ? auth()->user()->patient->place_brithday.', '.auth()->user()->patient->date_brithday   : '-'  }}
                </p>
            </li>
            <li class="d-flex flex-column flex-lg-row align-items-center">
                <p class="col-lg-5 border-right">{{ __('Age') }}</p>
                <p class="col-lg-7 text-bold "> {{ auth()->user()->patient->date_brithday != '' ? $ageInYears.' '.__('Year Old') : '-' }} </p>
            </li>
        </ul>
    </div>
    <div class="col-lg-6">
        <ul class="list-group list-group-unbordered " style="list-style-type: none;">
            <li class="d-flex flex-column flex-lg-row align-items-start">
                <p class="col-lg-5 border-right">{{ __('Marital Status') }}</p>
                <p class="col-lg-7 text-bold ">
                    @if (auth()->user()->patient->marital_status == 'married')
                    {{ __('Married') }}
                    @elseif(auth()->user()->patient->marital_status == 'divorced')
                        {{ __('Divorced') }}
                    @elseif(auth()->user()->patient->marital_status == 'dead_divorced')
                        {{ __('Dead Divorced') }}
                    @else
                        {{ __('Single') }}
                    @endif
                </p>
            </li>
            <li class="d-flex flex-column flex-lg-row align-items-start ">
                <p class="col-lg-5 border-right">{{ __('Job Status') }}</p>
                <p class="col-lg-7 text-bold ">
                    {{ auth()->user()->patient->work_id != '' ? auth()->user()->patient->work->name : '-' }}
                </p>
            </li>
            <li class="d-flex flex-column flex-lg-row align-items-center">
                <p class="col-lg-5 border-right">{{ __('Graduate Status') }}</p>
                <p class="col-lg-7 text-bold ">
                    {{ auth()->user()->patient->graduated_id != '' ? auth()->user()->patient->graduated->name : '-' }}
                </p>
            </li>
            <li class="d-flex flex-column flex-lg-row align-items-center">
                <p class="col-lg-5 border-right">{{ __('Number Phone') }}</p>
                <p class="col-lg-7 text-bold ">
                    {{ auth()->user()->patient->phoneNumber != '' ? auth()->user()->patient->phoneNumber : '-' }}
                </p>
            </li>
            <li class="d-flex d-lg-none flex-column flex-lg-row align-items-start">
                <p class="col-lg-5 border-right">{{ __('Address') }}</p>
                <p class="col-lg-7 text-bold ">
                    {{ auth()->user()->patient->address != '' ? auth()->user()->patient->address : '-' }}
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
                {{ auth()->user()->patient->address != '' ? auth()->user()->patient->address : '-' }}
            </p>
        </div>
    </div>
</div>