<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="/" class="brand-link" style="border-bottom:2px solid #6F42C1 !important;"> --}}
    <a href="/" class="brand-link">
        <img src="{{ asset('dist/img/logos/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light text-primary" style="font-weight: 700 !important; line-height:0;">Bidan Nurhalimah</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->picture }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('profile.edit') }}"
                    class="d-block user_name">{{ Auth::user()->username !== '' ? Auth::user()->username : Auth::user()->name }}
                </a>
            </div>
        </div>

        @if(auth()->user()->role->slug !== 'patient')
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(auth()->user()->role->slug === 'administrator')
                @if(auth()->user()->staff->position->slug === 'admin')
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('patients') || request()->is('patients/create') || request()->is('birth-controls') || request()->is('birth-controls/**') || request()->is('admin/works') || (request()->is('admin/works/**'))  ? 'menu-open' : '' }}">
                    <a class="nav-link {{ request()->is('patients') || request()->is('patients/create') || request()->is('birth-controls') || request()->is('birth-controls/**') || request()->is('admin/works') || (request()->is('admin/works/**'))  ? 'active' : '' }}" style="cursor: pointer;">
                        <i class="nav-icon fas fa-hospital-user"></i>
                        <p>{{ __('Acceptors') }} <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('patients.index') }}" class="nav-link {{ request()->is('patients') || request()->is('patients/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{ __('Acceptor List') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('birth-controls.index') }}" class="nav-link {{ request()->is('birth-controls') || (request()->is('birth-controls/**')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Birth Controls') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('works.index') }}" class="nav-link {{ request()->is('admin/works') || (request()->is('admin/works/**')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Jobs') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('admin/positions') || request()->is('admin/graduateds')  || request()->is('admin/positions/**') || request()->is('admin/graduateds/**')  ? 'menu-open' : '' }}">
                    <a class="nav-link {{ request()->is('admin/positions') || request()->is('admin/graduateds') || request()->is('admin/positions/**') || request()->is('admin/graduateds/**') ? 'active' : '' }}" style="cursor: pointer;">
                        <i class="nav-icon fas fa-laptop-medical"></i>
                        <p>{{ __('Master') }} <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('positions.index') }}" class="nav-link {{ request()->is('admin/positions') || request()->is('admin/positions/**')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Access Rights') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('graduateds.index') }}" class="nav-link {{ request()->is('admin/graduateds') || request()->is('admin/graduateds/**')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Graduateds') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('staffs.index') }}" class="nav-link {{ request()->is('admin/staffs') || request()->is('admin/staffs/create') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-nurse"></i>
                        <p>
                            {{ __('Staff') }}
                        </p>
                    </a>
                </li>
                <li class="nav-header">{{ __('Site Management') }}</li>
                <li class="nav-item">
                    <a href="{{ route('site-management.index') }}" class="nav-link {{ request()->is('admin/site-management') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>
                            {{ __('Site Information') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            {{ __('Users') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/categories') || request()->is('admin/galleries') || request()->is('admin/galleries/**/edit') ? 'menu-open' : '' }}">
                    <a class="nav-link {{ request()->is('admin/categories') || request()->is('admin/galleries') || request()->is('admin/galleries/**/edit') ? 'active' : '' }}" style="cursor: pointer;">
                        <i class="nav-icon fas fa-image"></i>
                        <p>{{ __('Gallery') }} <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link {{ request()->is('admin/categories') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Category') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('galleries.index') }}" class="nav-link {{ request()->is('admin/galleries') || request()->is('admin/galleries/**/edit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Images') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('faqs.index') }}" class="nav-link {{ request()->is('admin/faqs') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            {{ __('F.A.Q') }}
                        </p>
                    </a>
                </li>
                @else
                <!------------------------------
                --- End Admin/ Start Midwife ---
                -------------------------------->
                <li class="nav-item">
                    <a href="{{ route('patients.index') }}" class="nav-link {{ request()->is('patients') || request()->is('patients/create') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hospital-user"></i>
                        <p>
                            {{ __('Acceptors') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('birth-controls.index') }}" class="nav-link {{ request()->is('birth-controls') ? 'active' : '' }}">
                        <i class="fas fa-prescription-bottle-alt nav-icon"></i>
                        <p>{{ __('Birth Controls') }}</p>
                    </a>
                </li>
                @endif
                @else
                <!----------------------------------------
                --- End Admin & Midwife/ Start Patient ---
                ------------------------------------------>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->is('patient/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#modal_question">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            {{ __('Help') }}
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>