<div class="row" id="change_password_row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h5 class="float-left mt-1 text-bold"><i class="fas fa-lock"></i> {{ __('Change Password') }}</h5>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('password.update') }}" id="changePasswordForm">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-4 col-form-label">{{ __('Old Password') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control error_input_oldpassword" id="inputName" placeholder="{{ __('Enter') }} {{ __('Old Password') }}" name="oldpassword">
                                    <span class="text-danger error-text oldpassword_error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName3" class="col-sm-4 col-form-label">{{ __('New Password') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control error_input_newpassword" id="inputName3" placeholder="{{ __('Enter') }} {{ __('New Password') }}" name="newpassword">
                                    <span class="text-danger error-text newpassword_error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-4 col-form-label">{{ __('Confirm New Password') }}
                                    <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control error_input_cnewpassword" id="inputEmail" placeholder="{{ __('Enter') }} {{ __('Confirm New Password') }}" name="cnewpassword">
                                    <span class="text-danger error-text cnewpassword_error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-4 col-sm-8">
                                    <button type="submit" class="btn btn-danger float-sm-right mt-4">{{ __('Update Password') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>