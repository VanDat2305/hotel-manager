@extends('admin.layout.app')
@section('title')
    {{ $title }}
@endsection
@section('style')
    @parent
    <link rel="stylesheet"
        href="{{ asset('bower_components/template-admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <style>
        .disable-input {
            pointer-events: none;
            background-color: rgba(238, 238, 238, 0);
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="card col-5">
            <div class="card-header">
                <h3 class="card-title">{{ __($title) }}</h3>
                <p class="">
                </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table ">
                    <form class="row g-4" method="POST" action="{{ route('admin.booking.payment') }}">
                        @csrf

                        <body>
                            <tr>
                                <th>{{ __('Id') }}: </th>
                                <td><input type="text" name="booking_id" class="border-0  disable-input" value="{{ $booking->id }}"></td>
                            </tr>
                            <tr>
                                <th>{{ __('Fullname') }}: </th>
                                <td>{{ $booking->fullname }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Email') }}: </th>
                                <td>{{ $booking->customer->email }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('PHONE') }}: </th>
                                <td>{{ $booking->customer->phone }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('ADDRESS') }}: </th>
                                <td>{{ $booking->customer->address }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('NAMEROOM') }}: </th>
                                <td>{{ $booking->room->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('CHECKIN') }}: </th>
                                <td>{{ $booking->check_in }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('CHECKOUT') }}: </th>
                                <td>{{ $booking->check_out }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('INFORMATION') }}: </th>
                                <td>{{ $booking->infomation }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('SUBPRICE') }}: </th>
                                <td>{{ number_format($booking->sub_price, 0, '.', ',') }} VND</td>
                            </tr>
                            <tr>
                                <th>{{ __('Vat') }}: </th>
                                <td>{{ number_format($booking->sub_price*config('custom.vat')/100)}}
                                    VND
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('TOTALPRICE') }}: </th>
                                <td>{{ number_format($booking->total_price, 0, '.', ',') }}VND</td>
                            </tr>
                            <tr>
                                <th>{{ __('STATUS') }} </th>
                                <td>{{ __($booking->status) }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('PAYMENT') }} </th>
                                <td>
                                    @if ($payment == null)
                                        <button type="submit" name="redirect" class="btn btn-outline-primary btn-small">
                                            {{ __('PAYMENT') }} </button>
                                    @elseif ($payment['vnp_response_code'] == 00)
                                        {{ __('payment successful') }}
                                    @else
                                        <button type="submit" name="redirect" class="btn btn-outline-primary btn-small">
                                            {{ __('PAYMENT') }} </button>
                                    @endif
                                </td>
                            </tr>
                        </body>
                        <input type="text" name="total_price" class="border-0 disable-input d-none" value="{{ $booking->total_price}}">
                    </form>
                </table>
                <div class="p-4">
                    <a href="{{ route('admin.booking.index') }}" class="btn btn-primary">{{ __('BACK') }}</a>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
