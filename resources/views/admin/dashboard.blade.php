<x-app-dashboard title="{{ __('Dashboard') }}">

    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
        </ol>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- {{ Auth::user()->staff->position->slug }} --}}
                    @if(auth()->user()->role->slug === 'administrator' && auth()->user()->staff->position->slug === 'admin')
                        Hallo Owner
                    @elseif(auth()->user()->role->slug === 'administrator' && auth()->user()->staff->position->slug !== 'admin') 
                        LU CUMA STAFF BIASA
                    @endif
                </div>
            </div>
        </div>
    </div>



</x-app-dashboard>
