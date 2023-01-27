<form action="" id="form-validate" style="display: none">
    <div class="card border border-danger">
        <div class="card-body">
            <div class="d-inline-flex align-items-start">
                <i class="fas fa-info mr-2" style="margin-top: 2px;"></i>
                <strong class="text-danger">Masukan Data Diri Anda yang Telah Terdaftar</strong>
            </div>
        </div>
    </div>
    <!-------- No Medical ----->
    <div class="form-group row">
        <label for="inputName" class="col-md-3 col-form-label ">
            {{ __('No. Medical records') }} <span class="text-danger">*</span>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control error_input_name" id="inputName" placeholder="Masukan Nomor Pendaftaran Anda yang telah Terdaftar" name="name" disabled>
            <span class="text-danger error-text name_error"></span>
        </div>
    </div>
    <!-------- Full Name ----->
    <div class="form-group row">
        <label for="inputName" class="col-md-3 col-form-label ">
            {{ __('Full Name') }} <span class="text-danger">*</span>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control error_input_name" id="inputName" placeholder="{{ __('Enter') }} {{ __('Full Name') }}" name="name" disabled>
            <span class="text-danger error-text name_error"></span>
        </div>
    </div>
    <!-------- Date of Birthday ----->
    <div class="form-group row align-items-center">
        <label for="inputDateBrithday" class="col-md-3 col-form-label">
            {{ __('Date of Birthday') }} <span class="text-danger">*</span>
        </label>
        <div class="col-md-9">
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input error_input_date_brithday" placeholder="{{ __('Enter your Date of Birth') }}" data-target="#reservationdate" name="date_brithday" disabled>
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <small>{{ __('Example') }}: 30-12-1995</small><br>
            <span class="text-danger error-text date_brithday_error"></span>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-md-3 col-md-9">
            <button type="submit" class="btn btn-primary float-right mt-4">Periksa Kecocokan Data</button>
        </div>
    </div>
</form>