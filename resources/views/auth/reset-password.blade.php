<x-app-layout title="{{ __('Reset Password') }}">
    <section class="forgot-password d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 d-flex flex-column justify-content-center typograph">
                    <div data-aos="fade-up">
                        <div class="card">
                            <h1>{{ __('Reset Password') }}</h1>
                            <small>{{ __('Enter Your Password') }}</small>
                            <hr class="m-0 mx-2">
                            <div class="card-body">
                                <form method="POST" class="my-login-validation" action="{{ route('password.store') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $request->email) }}" required autofocus placeholder="{{ __('Enter Your Email') }}">
                                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autofocus placeholder="{{ __('Enter Your Password') }}">
                                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">{{ __('Retype Your Password') }}</label>
                                        <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" required autofocus placeholder="{{ __('Enter Your Password') }}">
                                        <span class="text-danger">@error('password_confirmation'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Reset Password') }} <i class="fas"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
