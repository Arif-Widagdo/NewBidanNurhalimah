<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="" class="logo d-flex align-items-center">
            <img src="{{ asset('dist/img/logos/logo.png') }}" alt="">
            <span>Bidan Nurhalimah</span>
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="/#hero">{{ __('Home') }}</a></li>
                <li><a class="nav-link scrollto" href="#features">{{ __('About Us') }}</a></li>
                <li><a class="nav-link scrollto" href="#services">{{ __('Services') }}</a></li>
                <li><a class="nav-link scrollto" href="#portfolio">{{ __('Gallery') }}</a></li>
                <li><a class="nav-link scrollto" href="#contact">{{ __('Contact') }}</a></li>
                <li class="dropdown"><a href="#"><i class="bi bi-translate" style="font-size:16px; margin-right:2px !important;"></i> <span>{{ __('Language') }}</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li>
                            <a href="{{ url('locale/id') }}">
                                <img src="{{ asset('dist/img/id.png') }}" alt="" width="20"
                                    class="border rounded-circle shadow">
                                {{ __('Indonesian') }}
                                @if(app()->getLocale()=='id')
                                <i class="bi bi-check"></i>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('locale/en') }}">
                                <img src="{{ asset('dist/img/en.png') }}" alt="" width="20"
                                    class="border rounded-circle shadow">
                                {{ __('English') }}
                                @if(app()->getLocale()=='en')
                                <i class="bi bi-check"></i>
                                @endif
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    @if (Route::has('login'))
                        @auth
                            <li>
                                <a class="getstarted scrollto" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                        @else
                            <li>
                                <a class="getstarted-outline" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                            </li>
                            <li class="">
                                <a class="getstarted scrollto m-1" href="{{ route('login') }}">{{ __('Sign In') }}</a>
                            </li>
                        @endauth
                    @endif
                    
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>
