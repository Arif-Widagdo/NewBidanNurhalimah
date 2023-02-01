<x-app-dashboard title="{{ __('Dashboard') }}">

    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
        </ol>
    </x-slot>

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box border-top border-info">
                <div class="inner">
                    <h3>{{ $patients->count() }}</h3>
                    <p>{{ __('Number of Acceptors') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hospital-user text-info"></i>
                </div>
                <a href="{{ route('patients.index') }}" class="small-box-footer bg-info">{{ __('More Info') }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box border-top border-success">
                <div class="inner">
                    <h3>{{ $users->count() }}</h3>
                    <p>{{ __('Number of Users') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users text-success"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer bg-success">{{ __('More Info') }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box border-top border-danger">
                <div class="inner">
                    <h3>{{ $birthControls->count() }}</h3>
                    <p>{{ __('Number of types of Birth Control') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-prescription-bottle-alt text-danger"></i>
                </div>
                <a href="{{ route('birth-controls.index') }}" class="small-box-footer bg-danger">{{ __('More Info') }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-8 animate__animated animate__slideInLeft">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title text-bold">{{ __('Number of Acceptor Registration by Month') }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            {{-- <span class="text-bold text-lg"> Rp. {{ number_format($salaryThisMonth,2,',','.') }}</span>
                            <span>{{ __('Salary must be issued in') }} <strong>{{ $month }}, {{ $year }}</strong></span> --}}
                        </p>
                    </div>
                    <!-- /.d-flex -->
                    <div class="position-relative mb-4">
                        <canvas id="sales-chart" height="310"></canvas>
                    </div>
                </div>
                <!-- ./card-body -->
            </div>
        </div>



        <div class="col-md-4 animate__animated animate__slideInRight">
              <!-- DONUT CHART -->
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title text-bold">{{ __('Number of Acceptors Based on Birth Control Users') }}</h3>
                </div>
                <div class="card-body">
                  <canvas id="birthControls" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%; "></canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
        </div>
    </div>
    
    
    <!-- /.row -->
    @section('scripts')
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        /* global Chart:false */
            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

            var $salesChart = $('#sales-chart')
            // eslint-disable-next-line no-unused-vars
            var salesChart = new Chart($salesChart, {
                type: 'bar',
                data: {
                labels: [
                    "{{ __('January') }}", 
                    "{{ __('February') }}",
                    "{{ __('March') }}",
                    "{{ __('April') }}",
                    "{{ __('May') }}",
                    "{{ __('June') }}",
                    "{{ __('July') }}",
                    "{{ __('August') }}",
                    "{{ __('September') }}",
                    "{{ __('October') }}",
                    "{{ __('November') }}",
                    "{{ __('December') }}",
                ],
                datasets: [
                    {
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    data: [
                        {{ $patientJan->count() }},
                        {{ $patientFeb->count() }},
                        {{ $patientMar->count() }},
                        {{ $patientApr->count() }},
                        {{ $patientMei->count() }},
                        {{ $patientJun->count() }},
                        {{ $patientJul->count() }},
                        {{ $patientAug->count() }},
                        {{ $patientSep->count() }},
                        {{ $patientOct->count() }},
                        {{ $patientNov->count() }},
                        {{ $patientDes->count() }}
                    ]
                    },
                    {
                    backgroundColor: '#ced4da',
                    borderColor: '#ced4da',
                    data: [
                        {{ $userJan }},
                        {{ $userFeb }},
                        {{ $userMar }},
                        {{ $userApr }},
                        {{ $userMei }},
                        {{ $userJun }},
                        {{ $userJul }},
                        {{ $userAug }},
                        {{ $userSep }},
                        {{ $userOct }},
                        {{ $userNov }},
                        {{ $userDes }}
                        ]
                    }
                ]
                },
                options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                    // display: false,
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,

                        // Include a dollar sign in the ticks
                        callback: function (value) {
                        if (value >= 1000) {
                            value /= 1000
                            value += 'k'
                        }
                        return value
                        }
                    }, ticksStyle)
                    }],
                    xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                    }]
                }
                }
            })

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var productChartCanvas = $('#birthControls').get(0).getContext('2d')
            var productData        = {
                labels: [
                    @foreach ($birthControls as $birthControl)
                        "{{ $birthControl->name }}",
                    @endforeach
                ],
            datasets: [
                {
                data: [
                    @foreach ($acceptors as $acceptor)
                        {{ $acceptor->count() }},
                    @endforeach
                ],
                backgroundColor : [
                    '#007bff',
                    '#6610f2', 
                    '#6f42c1', 
                    '#e83e8c', 
                    '#dc3545', 
                    '#fd7e14',
                    '#ffc107',
                    '#28a745', 
                    '#20c997', 
                    '#17a2b8', 
                    '#F4F6F9', 
                    '#6c757d'
                    ],
                }
            ]
            }
            var donutOptions     = {
                maintainAspectRatio : false,
                responsive : true,
            }
            new Chart(productChartCanvas, {
                type: 'doughnut',
                data: productData,
                options: donutOptions
            })


    </script>
    @endsection

</x-app-dashboard>
