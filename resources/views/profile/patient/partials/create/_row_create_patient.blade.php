<!-- Row Information -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline" id="card_custom_collapsed">
            <div class="card-header align-items-center">
                <h5 class="float-left mt-1 text-bold">
                    @if(auth()->user()->patient)
                        <i class="fas fa-user"></i> {{ __('Personal Information') }}
                    @else
                        <i class="fas fa-user"></i> {{ __('Patient Registration Form') }}
                    @endif
                </h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="border-bottom text-danger border-primary mb-4">
                    {{ __('* required fileds') }}
                </div>
                <div class="form-group row d-flex flex-row align-items-center">
                    <label for="createAccout" class="col-form-label mr-2 px-2">
                        Sudah Pernah Mendaftar di Bidan Nurhalimah?
                    </label>
                    <input id="createAccout" type="checkbox" name="create_account" data-bootstrap-switch data-off-color="light" data-on-color="primary" data-off-text="{{ __('No') }}" data-on-text="{{ __('Yes') }}"  > 
                </div>
                @include('profile.patient.partials.create._form_create_patient')
                @include('profile.patient.partials.create._form_validate')
                <!-------- Validate ----->
            </div>
        </div>
    </div>
</div>