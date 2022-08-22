@extends('admin.layout.app')
@section('title')
    {{ $title }}
@endsection
@section('style')
    @parent
    <link rel="stylesheet"
        href="{{ asset('bower_components/template-admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="card col-12">
            <div class="card-header">
                <h3 class="card-title">{{ __($title) }}</h3>
                <p class="">
                </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table">

                    <body>
                        <tr>
                            <th>{{__('Fullname')}}: </th>
                            <td>{{ $booking->fullname }}</td>
                        </tr>
                        <tr>
                            <th>{{__('Email')}}: </th>
                            <td>{{ $booking->customer->email }}</td>
                        </tr>
                        <tr>
                            <th>{{__('PHONE')}}: </th>
                            <td>{{ $booking->customer->phone }}</td>
                        </tr>
                        <tr>
                            <th>{{__('ADDRESS')}}: </th>
                            <td>{{ $booking->customer->address }}</td>
                        </tr>
                        <tr>
                            <th>{{__('NAMEROOM')}}: </th>
                            <td>{{ $booking->room->name }}</td>
                        </tr>
                        <tr>
                            <th>{{__('CHECKIN')}}: </th>
                            <td>{{ $booking->check_in }}</td>
                        </tr>
                        <tr>
                            <th>{{__('CHECKOUT')}}: </th>
                            <td>{{ $booking->check_out }}</td>
                        </tr>
                        <tr>
                            <th>{{__('INFORMATION')}}: </th>
                            <td>{{ $booking->infomation }}</td>
                        </tr>
                        <tr>
                            <th>{{__('SUBPRICE')}}: </th>
                            <td>{{ number_format($booking->sub_price, 0, '.', ',') }} VND</td>
                        </tr>
                        <tr>
                            <th>{{__('TOTALPRICE')}}: </th>
                            <td>{{ number_format($booking->sub_price, 0, '.', ',') }} VND</td>
                        </tr>
                        <tr>
                            <th>{{__('STATUS')}} </th>
                            <td>{{ __($booking->status) }}</td>
                        </tr>
                    </body>
                </table>
                <div class="p-4">
                    <a href="{{ route('admin.booking.index') }}" class="btn btn-primary">{{ __('BACK')}}</a>
                </div> 
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
