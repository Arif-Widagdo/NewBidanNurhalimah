<x-app-layout title="{{ __('Sign In') }}">
    <section class="login d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 login-img d-lg-flex justify-content-center align-items-center" data-aos="zoom-out">
                    <img src="{{ asset('dist/img/login2.png') }}" class="img-fluid" alt="{{ __('Sign In') }}" style="width: 500px !important;">
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center typograph">
                    <div data-aos="fade-up">
                        <div class="card ">
                            <h1>{{ __('Sign In') }}</h1>
                            <small>{{ __('Please Enter Your Email Address and Password') }}</small>
                            <hr class="m-0 mx-2">
                            <div class="card-body">
                                @if(session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('error') }}</strong>
                                </div>
                                @endif
                                @if(session()->has('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('status') }}</strong>
                                </div>
                                @endif
                                <form method="POST" class="my-login-validation" autocomplete="off"
                                    action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ __('Enter Your Email') }}">
                                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">{{ __('Password') }}
                                            <a href="{{route('password.request')}}" class="float-right">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        </label>
                                        <input id="password" type="password" class="form-control" name="password" required data-eye placeholder="{{ __('Enter Your Password') }}">
                                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox d-flex">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me" value="1">
                                                <label class="form-check-label" for="remember_me" style="margin-left: 4px;"><span>{{ __('Remember me') }}</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Sign In') }} <i class="fas"></i>
                                        </button>
                                    </div>
                                    <div>
                                        <p style="text-align: right;" class="text-right">
                                            {{ __('Dont have an account yet?') }}
                                            <a href="{{route('register')}}">{{ __('Register here') }}</a>
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
</x-app-layout>
