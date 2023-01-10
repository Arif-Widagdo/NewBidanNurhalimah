<x-app-dashboard title="#{{ $patient->no_rm }}">

    <x-slot name="header">
        {{ __('No. Medical records') }} #{{ $patient->no_rm }}
    </x-slot>

    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{ route('patients.index') }}">{{ __('Patient List') }}</a></li>
            <li class="breadcrumb-item active">#{{ $patient->no_rm }}</li>
        </ol>
    </x-slot>

    @include('crew.patient_management.acceptor_management.partials._row_information')

    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header align-items-center">
                    <h5 class="float-left mt-2 text-bold"><i class="fas fa-user-tie"></i> </h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary " data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    @section('scripts')
    <script>
      
    </script>
    @endsection
</x-app-dashboard>