<x-app-layout title="{{ __('Verify Email') }}">

    <section class="forgot-password d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 d-flex flex-column justify-content-center typograph">
                    <div data-aos="fade-up">
                        <div class="card">
                            <h1>{{ __('Verify Email Address') }}</h1>
                            <small> {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didnt receive the email, we will gladly send you another.') }}</small>
                            <hr class="m-0 mx-2">
                            <div class="card-body">
                                @if (session('status') == 'verification-link-sent')
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ __('A new verification link has been sent to the email address you provided during registration.') }}</strong>
                                    </div>
                                @endif
                                <div class="row">
                                    <form method="POST" action="{{ route('verification.send') }}" class="col-lg-8">
                                        @csrf
                                        <div class="form-group m-0">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                {{ __('Resend Verification Email') }} <i class="fas"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <form method="POST" action="{{ route('logout') }}" class="col-lg-4">
                                        @csrf
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-primary btn-block">
                                                {{ __('Log Out') }} <i class="fas"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
