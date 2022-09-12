@extends('admin.layout.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $countBooking }}</h3>

                    <p>{{ __('BOOKING') }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="{{ route('admin.booking.index') }}" class="small-box-footer">{{ __('MOREINFO') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $category->count() }}</h3>

                    <p>{{ __('CATEGORY') }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('admin.category.index') }}" class="small-box-footer">{{ __('MOREINFO') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $countRoom }}</h3>

                    <p>{{ __('ROOM') }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('admin.room.index') }}" class="small-box-footer">{{ __('MOREINFO') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $countCustomer }}</h3>

                    <p>{{ __('CUSTOMER') }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="{{ route('admin.customer.index') }}" class="small-box-footer">{{ __('MOREINFO') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title" id="btn-client">{{__('Revenue monthly')}}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <canvas id="sales-chart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title" id="btn-client">{{__('Revenue by category')}}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <canvas id="category-chart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @parent
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('bower_components/template-admin/plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        $(function() {
            'use strict'
            var months = {!!json_encode($months)!!};
            var totalMoney = {!!json_encode($totalMoneyMonth)!!};
            var totalMoneyCate = {!!json_encode($totalMoneyCate)!!};
            var category = {!!json_encode($category->toArray())!!};
            var cateTitle = category.map(element => {
               return element.name
            });
            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

            var $salesChart = $('#sales-chart')
            var salesChart = new Chart($salesChart, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            data: totalMoney
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
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        value /= 1000000
                                        value += 'm'
                                    }else if(value >= 1000){
                                        value /= 1000
                                        value += 'k'
                                    }

                                    return   value
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
            var $categoryChart = $('#category-chart')
            var categoryChart = new Chart($categoryChart, {
                type: 'bar',
                data: {
                    labels: cateTitle,
                    datasets: [{
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            data: totalMoneyCate
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
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        value /= 1000000
                                        value += 'm'
                                    }else if(value >= 1000){
                                        value /= 1000
                                        value += 'k'
                                    }

                                    return   value
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
        })
    </script>
@endsection
