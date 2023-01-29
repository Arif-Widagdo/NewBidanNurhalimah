 <!-- Navbar -->
 {{-- <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="border-bottom:2px solid #6F42C1 !important;"> --}}
 <nav class="main-header navbar navbar-expand navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         {{-- @if(auth()->user()->role->slug === 'administrator')
         <li class="nav-item d-none d-sm-inline-block">
             <a href="" class="nav-link">{{ __('Data Master') }}</a>
         </li>

         @elseif(auth()->user()->role->slug === 'patient')
         <li class="nav-item d-none d-sm-inline-block">
             <a href="" class="nav-link">{{ __('Dashboard') }}</a>
         </li>
         @endif --}}
        @if(auth()->user()->role->slug === 'patient' && !request()->is('patient/dashboard'))
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('patient/dashboard') ? 'active' : '' }}">{{ __('Dashboard') }}</a>
        </li>
        @endif 
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <!-- Languange Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link drop-english btn btn-outline-light mr-1" data-toggle="dropdown" href="#">
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-translate" viewBox="0 0 16 16">
                     <path  d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286H4.545zm1.634-.736L5.5 3.956h-.049l-.679 2.022H6.18z" />
                     <path d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2zm7.138 9.995c.193.301.402.583.63.846-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6.066 6.066 0 0 1-.415-.492 1.988 1.988 0 0 1-.94.31z" />
                 </svg>
                 {{ __('Language') }}
                 <i class="fas fa-angle-down"></i>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right ">
                 <span class=" dropdown-header text-left">{{ __('Language') }}</span>
                 <div class="dropdown-divider"></div>
                 <a href="{{ url('locale/id') }}" class="dropdown-item">
                     <i class="fas fa-globe mr-2"></i> {{ __('Indonesian') }}
                     @if(app()->getLocale()=='id')
                     <span class="float-right text-sm badge badge-danger">{{ __('Active') }}</span>
                     @endif
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="{{ url('locale/en') }}" class="dropdown-item">
                     <i class="fas fa-globe mr-2"></i> {{ __('English') }}
                     @if(app()->getLocale()=='en')
                     <span class="float-right text-sm badge badge-danger">{{ __('Active') }}</span>
                     @endif
                 </a>
             </div>
             <style>
                 .drop-english {
                     font-weight: 500;
                 }

                 .drop-english:hover,
                 .drop-english:active {
                     background-color: #007BFF !important;
                     color: #ffffff !important;
                 }
             </style>
         </li>
         <!-- Auth Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link btn btn-primary dropdown-inverse2 " data-toggle="dropdown" href="#">
                 <i class="far fa-user"></i> {{ auth()->user()->username }} <i class="fas fa-angle-down"></i>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right ">
                 <a href="{{ route('profile.edit') }}"
                     class="dropdown-item dropdown-header text-left d-flex align-items-center">
                     <img src="{{ auth()->user()->picture }}" alt="" width="50"
                         class="img-circle elevation-2 user_picture">
                     <ul style="list-style-type: none; margin-left:-25px;">
                         <li class="name_user">
                             <p>
                                 {{ auth()->user()->username }}
                             </p>
                         </li>
                         <li>
                             <p>{{ auth()->user()->email }}</p>
                         </li>
                     </ul>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="{{ route('profile.edit') }}" class="dropdown-item">
                     <i class="fas fa-cogs mr-2" style="width: 20px; height:20px"></i> {{ __('Settings Account') }}
                 </a>
                 <div class="dropdown-divider"></div>
                 <form action="{{ route('logout') }}" method="POST">
                     @csrf
                     <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer text-left"
                         onclick="event.preventDefault(); this.closest('form').submit();">
                         <i class="fas fa-sign-out-alt mr-2" style="width: 20px; height:20px"></i> {{ __('Sign Out') }}
                     </a>
                 </form>
             </div>

             <style>
                 .dropdown-inverse2 {
                     font-weight: 500;
                     color: #ffffff !important;
                 }

                 .dropdown-inverse2:active {
                     color: #007BFF !important;
                     background-color: #F8F9FA !important;
                 }
             </style>
         </li>
     </ul>
 </nav>