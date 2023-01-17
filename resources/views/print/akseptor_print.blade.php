<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $patient->no_rm }} | Print</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700|Nunito:300,300i,400,400i,600,600i,700,700i,900|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i|Kalam:wght@700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-widget widget-user-2"
                        style="border: none !important; box-shadow:none !important; border-radius:0px !important;">
                        <div class="widget-user-header elevation-1">
                            <div class="row" style="position: relative;">
                                <div class="widget-user-image">
                                    @if($patient->account)
                                    <img class="img-circle elevation-2" src="{{ $patient->account->picture }}" alt="{{ $patient->account->username }}">
                                    @else
                                    <img class="img-circle elevation-2"src="{{ asset('dist/img/users/no-image2.png') }}" alt="{{ $patient->name }}">
                                    @endif
                                </div>
                                <div class="d-flex flex-column ml-2">
                                    <h3 class="name_user mr-2 mt-1">{{ $patient->name }}</h3>
                                    <p class="user_email" style="margin-top: -10px !important">#{{ $patient->no_rm }}</p>
                                </div>
                            </div>
                            <hr>
                            <!----- Row Information ------>
                            @include('print.partials.row_information')

                            <!----- Row Couple ------>
                            @include('print.partials.row_couple_information')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table row -->
            {{-- @include('components.invoice.table_invoice') --}}
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
