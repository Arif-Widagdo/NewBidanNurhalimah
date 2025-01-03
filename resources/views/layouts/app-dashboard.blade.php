<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- SEO Meta Tags -->
    {{-- <meta name="description" content="" /> --}}
    <meta name="author" content="Arif Widagdo | arifwidagdo24@gmail.com" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{{ URL::to('/') }}}">

    <title>{{ $title }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700|Nunito:300,300i,400,400i,600,600i,700,700i,900|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i|Kalam:wght@700&display=fallback">

    <link rel="icon" href="{{ asset('dist/img/logos/logo.png') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}">
    <!-- Ijabo Crop Tool -->
    {{-- <link rel="stylesheet" href="{{ asset('plugins/ijabo-crop-tool/ijaboCropTool.min.css') }}"> --}}
    @yield('links')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
    <!-- Toaster -->
    <link rel="stylesheet" href="{{ asset('dist/css/animate.min.css') }}">
    <!-- SweetAlert 2 | Display Message -->
    <link rel="stylesheet" href={{ asset('plugins/sweetalert2/sweetalert2.css') }}>
    <!-- Toaster -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href={{ asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}>
    <link rel="stylesheet" href={{ asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}>
    <link rel="stylesheet" href={{ asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}>

    <style>
        .is-invalid .select2-selection,
        .needs-validation ~ span > .select2-dropdown{
            border-color:red !important;
        }
    </style>
</head>

<body class="hold-transition {{ auth()->user()->role->slug !== 'patient' ? 'sidebar-mini' : 'sidebar-closed sidebar-collapse' }} 
{{  (request()->is('patient/**/acceptors')) 
|| (request()->is('admin/dashboard'))
|| (request()->is('admin/profile'))
|| (request()->is('admin/positions/**'))
|| (request()->is('admin/graduateds/**'))
|| (request()->is('admin/works/**'))
|| (request()->is('birth-controls/**'))
|| (request()->is('patient/profile'))
 ? 'sidebar-collapse' : ''  }}" 
style="font-family: 'Nunito';">
    <!-- Site wrapper -->
    <div class="wrapper">

        <!-- Navbar -->
        @include('components.dashboard.navbar')
        <!-- /Navbar -->

        <!-- Main Sidebar Container -->
        @include('components.dashboard.sidebar')
        <!-- /Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header animate__animated animate__slideInDown">
                <div class="container-fluid">
                    <div class="row mb-2">
                        @if (isset($header))
                        <div class="col-lg-7">
                            <h3 class="m-0 font-weight-bold" style="font-family: 'Nunito';">{{ $header }}</h3>
                        </div><!-- /.col -->
                        @endif
                        @if (isset($links))
                        <div class="col-lg-5">
                            {{ $links }}
                        </div><!-- /.col -->
                        @endif
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if(session()->has('success'))
                    <div class="successToast"></div>
                    @elseif(session()->has('error'))
                    <div class="errorToast"></div>
                    @endif
                    
                    <div class="" id="successToast"></div>
                    <div class="" id="errorToast"></div>
                    <div class="" id="infoToast"></div>

                    <audio id="notifSucccess" src="{{ asset('dist/sound/notifSuccess.mp3') }}" preload="auto"></audio>
                    <audio id="notifFail" src="{{ asset('dist/sound/confirmation.wav') }}" preload="auto"></audio>
                    {{ $slot }}
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @if(auth()->user()->role->slug == 'patient')
        <div class="modal fade" id="modal_question">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title"><i class="fas fa-question-circle"></i> {{ __('Welcome to the Help Menu') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                {{ __('This floating capital or card is made to help the user or application users') }} {{ config('app.name') }}. {{ __('If when using this application there is something that you are confused about, please read the following guide or contact the administrator to more quickly solve the problem at hand.') }}
                            </div>
                        </div>
                        
                        <div class="card mt-4">
                            <div class="card-body">
                                <p>{{ __('If you register for the first time on this website you will be presented with a Profile page, on that profile page you can complete or change your personal data and also your partners data.') }}</p>
                                <img src="{{ app()->getLocale()=='id' ? asset('dist/img/help/id/2.png') : asset('dist/img/help/en/2.png')  }}" alt="{{ __('Profile') }}" class="img-fluid mb-3">
                                <p class="mb-1">{{ __('On the profile page, besides you can complete or change your personal data, you can also change the password for the account that you have created, you can find the feature to change the password on the bottom page of the profile menu. You can scroll through the arrows to find the change password form.') }}</p>
                                <img src="{{ app()->getLocale()=='id' ? asset('dist/img/help/id/3.png') : asset('dist/img/help/en/3.png')  }}" alt="{{ __('Patient Registration Form') }}"  class="img-fluid mb-3">
                                <p>{{ __('If you have completed your required personal data. then the system will direct you to the dashboard page. On this Dashboard page you can view and print data from the results of your visit to Midwife Nurhalimah after participating in the Acceptor program.') }}</p>
                                <img src="{{ app()->getLocale()=='id' ? asset('dist/img/help/id/4.png') : asset('dist/img/help/en/4.png')  }}" alt="{{ __('Visit Result Data') }}"  class="img-fluid mb-3">
                                <p>{{ __('After you print or check the data from the results of your visit at Midwife Nurhalimah, it is hoped that you will press the exit button, this is to prevent leakage of your personal data.') }}</p>
                                <img src="{{ app()->getLocale()=='id' ? asset('dist/img/help/id/5.png') : asset('dist/img/help/en/5.png')  }}" alt="{{ __('Sign Out') }}"  class="img-fluid mb-3">
                                <p>{{ __('For other information you can contact the administrator or can look at') }} <a href="/#faq">F.A.Q</a>.</p>
                                {{ __('Regards') }}
                                <br><br><br>
                                {{ config('app.name') }} <br>
                                <a href="/#contact">{{ config('app.url') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
      


       @include('components.dashboard.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset("dist/js/adminlte.js") }}"></script>
    <!-- SweetAlert 2 | Display Message -->
    <script src="{{ asset('dist/js/sweetalert2.all.min.js') }}"></script>
    <!-- Toaster -->
    <script src="{{ asset('dist/js/toastr.min.js') }}"></script>
    <!-- Ring Notif -->
    <script src="{{ asset('dist/js/mk-notifications.js') }}"></script>
    <!-- Input Mask -->
    <script src="{{ asset('dist/js/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src={{ asset("plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}></script>
    <script src={{ asset("plugins/datatables-responsive/js/dataTables.responsive.min.js") }}></script>
    <script src={{ asset("plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}></script>
    <script src={{ asset("plugins/datatables-buttons/js/dataTables.buttons.min.js") }}></script>
    <script src={{ asset("plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}></script>
    <script src={{ asset("plugins/jszip/jszip.min.js") }}></script>
    <script src={{ asset("plugins/pdfmake/pdfmake.min.js") }}></script>
    <script src={{ asset("plugins/pdfmake/vfs_fonts.js") }}></script>
    <script src={{ asset("plugins/datatables-buttons/js/buttons.html5.min.js") }}></script>
    <script src={{ asset("plugins/datatables-buttons/js/buttons.print.min.js") }}></script>
    <script src={{ asset("plugins/datatables-buttons/js/buttons.colVis.min.js") }}></script>

    @if(auth()->user()->role->slug == 'patient')
        @if(!auth()->user()->patient)
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#modal_question').modal('show');
            });
        </script>
        @endif
    @endif

    @yield('scripts')
    <script>
        // -- Custom JS Code --
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function formatBlood(element) {
            $(element).inputmask("numeric", {
                radixPoint: ",",
                groupSeparator: "/",
                digits: 3,
                autoGroup: true,
                prefix: ' ',
                rightAlign: false,
                nullable: false,
                clearMaskOnLostFocus: true
            });
        }

        function format(element) {
            $(element).inputmask("numeric", {
                radixPoint: ",",
                groupSeparator: "",
                digits: 2,
                autoGroup: true,
                prefix: '62',
                rightAlign: false,
                nullable: false,
                clearMaskOnLostFocus: true
            });
        }
        
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    
        $('.successToast').each(function () {
            document.getElementById('notifSucccess').play();
            Toast.fire({
                icon: 'success',
                title: '{{ Session::get("success") }}'
            })
        });
                
        $('.errorToast').each(function () {
            document.getElementById('notifFail').play();
            Toast.fire({
                icon: 'error',
                title: '{{ Session::get("error") }}'
            })
        });
        
        function alertToastInfo(msg) {
            $('#infoToast').addClass("infoToast");
            document.getElementById('notifFail').play();
            return $('.infoToast').each(function () {
                Toast.fire({
                    icon: 'info',
                    title: msg
                })
            });
        }
        function alertToastSuccess(msg) {
            $('#successToast').addClass("successToast");
            document.getElementById('notifSucccess').play();
            return $('.successToast').each(function () {
                Toast.fire({
                    icon: 'success',
                    title: msg
                })
            });
            
        }
        function alertToastError(msg) {
            $('#errorToast').addClass("errorToast");
            document.getElementById('notifFail').play();
            return $('.errorToast').each(function () {
                Toast.fire({
                    icon: 'error',
                    title: msg
                })
            });
        }

       

        $('.selectall').click(function () {
                $('.selectbox').prop('checked', $(this).prop('checked'));
                $("#btn_delete_all").prop("hidden", !$(this).prop('checked'));
            });

        $('.selectbox').change(function () {
            var total = $('.selectbox').length;
            var number = $('.selectbox:checked').length;
            if (total == number) {
                $('.selectall').prop('checked', true);
            } else {
                $('.selectall').prop('checked', false);
            }
            $("#btn_delete_all").prop("hidden", !$('.selectbox:checked').length);
        });
    </script>
</body>
</html>
