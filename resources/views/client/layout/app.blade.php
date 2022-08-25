<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> @yield('title', 'home') </title>
    <link rel=icon href="{{ asset('bower_components/template-hotel-booking/favicon.png') }}" sizes="16x16"
        type="icon/png">
    @section('style')
        @include('client.layout.style')
    @show
</head>

<body>
    @include('client.layout.header')
    <div class="responsive-overlay"></div>
    @yield('content')

    @include('client.layout.footer')
    @section('script')
        @include('client.layout.script')
    @show
</body>
</html>