<x-app-dashboard title="{{ __('Site Information Management') }}">

    <x-slot name="header">
        {{ __('Site Information Management') }}
    </x-slot>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <form action="{{ route('site-management.update', $site->id) }}" method="POST"
                    id="form_update_information">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="text-danger d-flex justify-content-between">
                            <span>{{ __('* required fileds') }}</span>
                            <a href="{{ route('welcome') }}#contact" target="_blank" class="btn btn-outline-primary">{{ __('View Site') }} <i class="fas fa-arrow-alt-circle-right"></i></a>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>{{ __('Telp') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+62</span>
                                    </div>
                                    <input class="form-control square error_input_telp" name="telp" type="text"
                                        placeholder="{{ __('Enter') }} {{ __('Telp') }}"
                                        value="{{ $site ? $site->telp : '' }}" oninput="formatTelp(this)">
                                </div>
                                <span class="text-danger error-text telp_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('Email') }} <span class="text-danger">*</span></label>
                                <input class="form-control square error_input_email" name="email" type="email" id=""
                                    placeholder="{{ __('Enter') }} {{ __('Email') }}"
                                    value="{{ $site ? $site->email : '' }}">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('Facebook Address') }}</label>
                                <input class="form-control square error_input_facebook" name="facebook" type="text"
                                    id="" placeholder="{{ __('Enter') }} {{ __('Facebook Address') }}"
                                    value="{{ $site ? $site->facebook : '' }}">
                                <span class="text-danger error-text facebook_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('Twitter Address') }}</label>
                                <input class="form-control square error_input_twitter" name="twitter" type="text" id=""
                                    placeholder="{{ __('Enter') }} {{ __('Twitter Address') }}"
                                    value="{{ $site ? $site->twitter : '' }}">
                                <span class="text-danger error-text twitter_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('Instagram Address') }}</label>
                                <input class="form-control square error_input_instagram" name="instagram" type="text"
                                    id="" placeholder="{{ __('Enter') }} {{ __('Instagram Address') }}"
                                    value="{{ $site ? $site->instagram : '' }}">
                                <span class="text-danger error-text instagram_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('Linkedin Address') }}</label>
                                <input class="form-control square error_input_linkedin" name="linkedin" type="text" id=""
                                    placeholder="{{ __('Enter') }} {{ __('Linkedin Address') }}"
                                    value="{{ $site ? $site->linkedin : '' }}">
                                <span class="text-danger error-text linkedin_error"></span>
                            </div>
                            <div class="form-group col-md-12 ">
                                <label>{{ __('Address') }}<span class="text-danger">*</span></label>
                                <textarea class="form-control  error_input_address" cols="50" rows="3" name="address"
                                    type="text"
                                    placeholder="{{ __('Enter') }} {{ __('Address') }}">{{ $site ? $site->address : '' }}</textarea>
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary  text-bold submit " name="submit"
                            value="Submit">{{ __('Save Changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @section('scripts')
    <!-- Summernote -->

    <script>
        $('#form_update_information').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(document).find('span.error-text').text('');
                },
                success: function (data) {
                    if (data.status == 0) {
                        $.each(data.error, function (prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('input.error_input_' + prefix).addClass('is-invalid');
                            $('textarea.error_input_' + prefix).addClass('is-invalid');
                        });
                        alertToastInfo(data.msg)
                    } else {
                        $('#form_update_information')[0].reset();
                        setTimeout(function () {
                            location.reload(true);
                        }, 1000);
                        alertToastSuccess(data.msg)
                    }
                },
                error: function (xhr) {
                    Swal.fire(xhr.statusText, '{{ __('Wait a few minutes to try again ') }}', 'error')
                }
            });
        });
        
    </script>
    @endsection
</x-app-dashboard>