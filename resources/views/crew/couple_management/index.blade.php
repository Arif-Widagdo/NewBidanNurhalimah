<x-app-dashboard title=" {{ __('Patient List') }}">

    <x-slot name="header">
        {{ __('Couples') }} {{ __('No. Medical records') }} #{{ $patient->no_rm }}
    </x-slot>

    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{ route('patients.index') }}">{{ __('Patient List') }}</a></li>
            <li class="breadcrumb-item active">#{{ $patient->no_rm }}</li>
        </ol>
    </x-slot>

    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
               
            </div>
        </div>
    </div>
    <!-- /.row -->

    @section('scripts')
    <script>
      
    </script>
    @endsection
</x-app-dashboard>