<!DOCTYPE html>
<html>
<head>
    <title>{{ $contents['title'] }}</title>
</head>
<body style="display: flex;justify-content: center;">
    <div style="width: 70%;padding: 10px; margin: 0 auto">
        <p>{{ __('Dear') }}, <b>{{ $contents['firstname'] }}</b></p>
        <p>{{ __('Thank you for trusting and using services')}}  <strong>Beyond Hotel</strong>.
            <p>{{__("Details are as follows")}}:</p>
        </p>
        <p></p>
        <table border="1"  style="border-collapse: collapse; margin: auto" cellpadding="10px">
            <tbody>
                <tr>
                    <th>{{ __('BOOKINGID') }}</th>
                    <td>{{ $contents['booking_id'] }}</td>
                </tr>
                <tr>
                    <th>{{ __('NAMEROOM') }}</th>
                    <td>{{ $contents['name'] }}</td>
                </tr>
                <tr>
                    <th>{{ __('CHECKIN') }}</th>
                    <td>{{ $contents['checkin'] }}</td>
                </tr>
                <tr>
                    <th>{{ __('CHECKOUT') }}</th>
                    <td>{{ $contents['checkout'] }}</td>
                </tr>
                <tr>
                    <th>{{ __('PRICE') }}</th>
                    <td>{{ number_format($contents['price'],0,'.',',') }}{{__('VND')}}</td>
                </tr>
                <tr>
                    <th>{{ __('SUBPRICE') }}</th>
                    <td>{{ number_format($contents['sub_price'],0,'.',',') }}{{__('VND')}}</td>
                </tr>
                <tr>
                    <th>{{ __('Vat') }}</th>
                    <td>{{ number_format($contents['vat'],0,'.',',') }}{{__('VND')}}</td>
                </tr>
                <tr>
                    <th>{{ __('TOTALPRICE') }}</th>
                    <td>{{ number_format($contents['total_price'],0,'.',',') }}{{__('VND')}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>