@extends('layouts.dashboard.app')

@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('site.home') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ __('site.home') }}</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Counters header -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $categories }}</h3>

                        <p>{{ __('site.categories') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('dashboard.categories.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $products }}</h3>

                        <p>{{ __('site.products') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('dashboard.products.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $clients }}</h3>

                        <p>{{ __('site.clients') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('dashboard.clients.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $users }}</h3>

                        <p>{{ __('site.users') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('dashboard.users.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <!-- solid sales graph -->
        <div class="card bg-gradient-info">
            <div class="border-0 card-header">
                <h3 class="card-title">
                    <i class="mr-1 fas fa-th"></i>
                    {{ __('site.sales_graph') }}
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <canvas class="chart" id="line-chart" style="height: 250px;"></canvas>
            </div>
            <!-- /.card-body -->
            {{-- <div class="bg-transparent card-footer">
                <div class="row">
                    <div class="text-center col-4">
                        <input type="text" class="knob" data-readonly="true" value="20" data-width="60"
                            data-height="60" data-fgColor="#39CCCC">

                        <div class="text-white">Mail-Orders</div>
                    </div>
                    <!-- ./col -->
                    <div class="text-center col-4">
                        <input type="text" class="knob" data-readonly="true" value="50" data-width="60"
                            data-height="60" data-fgColor="#39CCCC">

                        <div class="text-white">Online</div>
                    </div>
                    <!-- ./col -->
                    <div class="text-center col-4">
                        <input type="text" class="knob" data-readonly="true" value="30" data-width="60"
                            data-height="60" data-fgColor="#39CCCC">

                        <div class="text-white">In-Store</div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div> --}}
            <!-- /.card-footer -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        /*
         * Author: Abdullah A Almsaeed
         * Date: 4 Jan 2014
         * Description:
         *      This is a demo file used only for the main dashboard (index.html)
         **/

        $(function() {

            /* jQueryKnob */
            $('.knob').knob()

            // Sales graph chart
            var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d');
            //$('#revenue-chart').get(0).getContext('2d');

            var salesGraphChartData = {
                labels:  @json($month, JSON_PRETTY_PRINT),
                datasets: [{
                    label: 'Digital Goods',
                    fill: false,
                    borderWidth: 2,
                    lineTension: 0,
                    spanGaps: true,
                    borderColor: '#efefef',
                    pointRadius: 3,
                    pointHoverRadius: 7,
                    pointColor: '#efefef',
                    pointBackgroundColor: '#efefef',
                    data: @json($totalPrice, JSON_PRETTY_PRINT),
                }]
            }

            var salesGraphChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontColor: '#efefef',
                        },
                        gridLines: {
                            display: false,
                            color: '#efefef',
                            drawBorder: false,
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 5000,
                            fontColor: '#efefef',
                        },
                        gridLines: {
                            display: true,
                            color: '#efefef',
                            drawBorder: false,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            var salesGraphChart = new Chart(salesGraphChartCanvas, {
                type: 'line',
                data: salesGraphChartData,
                options: salesGraphChartOptions
            })

        });
    </script>
@endsection
