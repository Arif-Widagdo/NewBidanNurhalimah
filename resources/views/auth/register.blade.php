<x-app-layout title="{{ __('Sign Up') }}">
    <!-- ======= Hero Section ======= -->
    <section class="register d-flex align-items-center">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 register-img d-lg-flex justify-content-center align-items-center" data-aos="zoom-out">
                    <img src="{{ asset('dist/img/login2.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center typograph">
                    <div data-aos="fade-up">
                        <div class="card ">
                            <h1>{{ __('Sign Up') }}</h1>
                            <small>{{ __('Please enter data in the form provided!') }}</small>
                            <hr class="m-0 mx-2">
                            <div class="card-body">
                                <form method="POST" class="my-login-validation" autocomplete="off" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">{{ __('Username') }}</label>
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus placeholder="{{ __('Enter Your Username') }}">
                                        <span class="text-danger">@error('username'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ __('Enter Your Email') }}">
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
                                            {{ __('Sign Up') }}
                                        </button>
                                    </div>
                                    <div>
                                        <p style="text-align: right;" class="text-right">{{ __('Already have an account?') }}
                                            <a href="{{route('login')}}" class="" >
                                                {{ __('Sign In') }}
                                            </a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- End Hero -->
    </x-app-layout>
