@extends('client.layout.app')
@section('title')
    {{ __('Room detail') }}
@endsection
@section('style')
    @parent
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/template-admin/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('bower_components/template-admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css') }}">
    <style>
        .hotel-details-widget {
            overflow: inherit;
        }
    </style>
@endsection
@section('content')
    <section class="hotel-details-area section-bg-2 pat-50 pab-100">
        <div class="container">
            <div class="row g-4">
                <div class="col-xl-8 col-lg-7">
                    <div class="details-left-wrapper">
                        <div class="details-contents bg-white radius-10">
                            <div class="details-contents-header">
                                <div class="details-contents-thumb details-contents-main-thumb bg-image"
                                    style="background-image: url({{ Storage::url($room->image) }});">
                                </div>
                            </div>
                            <div class="hotel-view-contents">
                                <div class="hotel-view-contents-header">
                                    <h3 class="hotel-view-contents-title"> {{ $room->name }}</h3>
                                    <span>{{ $room->category->name }}</span>
                                    <div class="hotel-view-contents-location mt-2">
                                    </div>
                                </div>
                                <div class="hotel-view-contents-bottom">
                                    <div class="hotel-view-contents-bottom-flex">
                                        <div class="hotel-view-contents-bottom-contents">
                                            <h4 class="hotel-view-contents-bottom-title">
                                                {{ number_format($room->price, 0, ',', '.') }}
                                                VND<sub>/{{ __('DAY') }}</sub> </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="details-contents-tab">
                                <ul class="tabs details-tab details-tab-border">
                                    <li class="active" data-tab="about"> {{ __('DESCRIPTION') }} </li>
                                </ul>
                                <div id="about" class="tab-content-item active">
                                    <div class="about-tab-contents">
                                        {!! $room->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="sticky-top">
                        <div class="hotel-details-widget hotel-details-widget-padding widget bg-white radius-10">
                            <div class="details-sidebar">
                                <div class="details-sidebar-dropdown custom-form">
                                    @if (Session::has('error'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <strong>{{ Session::get('error') }}</strong>
                                        </div>
                                    @endif
                                    @if (Session::has('success'))
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <strong>{{ Session::get('success') }}</strong>
                                        </div>
                                    @endif
                                    <form action="{{route('formCheckout',$room->id)}}" id='checkout-form' method="post">
                                        @csrf
                                        @error('booking')
                                            <div class="text-danger error">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label class="details-sidebar-dropdown-title"> {{ __('CHECKIN') }} </label>
                                        </div>
                                        <div class="input-group date mb-2" id="checkin" data-target-input="nearest">
                                            <input type="text" name="checkin" class="form-control datetimepicker-input"
                                                value="{{ old('checkin') }}" data-target="#checkin" />
                                            <div class="input-group-append" data-target="#checkin"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text">
                                                    <i class="la la-calendar pt-1 pb-1"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @error('checkin')
                                            <div class="text-danger error">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label class="details-sidebar-dropdown-title"> {{ __('CHECKOUT') }} </label>
                                        </div>
                                        <div class="input-group date mb-2" id="checkout" data-target-input="nearest">
                                            <input type="text" name="checkout" class="form-control datetimepicker-input"
                                                value="{{ old('checkout') }}" data-target="#checkout" />
                                            <div class="input-group-append" data-target="#checkout"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text">
                                                    <i class="la la-calendar pt-1 pb-1"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @error('checkout')
                                            <div class="text-danger error">{{ $message }}</div>
                                        @enderror
                                    </form>
                                </div>
                                <div class="btn-wrapper mt-4">
                                    <input class="btn btn-info text-white" type="submit" value="Booking"
                                        form="checkout-form">
                                </div>
                            </div>
                        </div>
                        @if ($roomSameCate != null)
                            <div class="hotel-details-widget widget bg-white radius-10">
                                <div class="hotel-view">
                                    <div class="hotel-view-thumb hotel-view-grid-thumb bg-image"
                                        style="background-image: url({{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/hotel-grid1.jpg') }});">
                                    </div>
                                    <div class="hotel-view-contents">
                                        <div class="hotel-view-contents-header">
                                            <a href="{{route('room-detail',$roomSameCate->id)}}" class="hotel-view-contents-title"> {{ $roomSameCate->name }} </a>
                                            <div class="hotel-view-contents-location mt-2">
                                            </div>
                                        </div>
                                        <div class="hotel-view-contents-middle">
                                            <div class="hotel-view-contents-flex">
                                                <div class="hotel-view-contents-icon myTooltip" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Car Parking">
                                                    <i class="las la-parking"></i>
                                                </div>
                                                <div class="hotel-view-contents-icon myTooltip" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Free Wifi">
                                                    <i class="las la-wifi"></i>
                                                </div>
                                                <div class="hotel-view-contents-icon myTooltip" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Free Breakfast">
                                                    <i class="las la-coffee"></i>
                                                </div>
                                                <div class="hotel-view-contents-icon myTooltip" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Home Service">
                                                    <i class="las la-quidditch"></i>
                                                </div>
                                                <div class="hotel-view-contents-icon myTooltip" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Swimming Pool">
                                                    <i class="las la-swimming-pool"></i>
                                                </div>
                                                <div class="hotel-view-contents-icon myTooltip" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Reception">
                                                    <i class="las la-receipt"></i>
                                                </div>
                                                <div class="hotel-view-contents-icon myTooltip" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Gym">
                                                    <i class="las la-dumbbell"></i>
                                                </div>
                                                <div class="hotel-view-contents-icon">
                                                    <a class="hotel-view-contents-icon-more" href="{{route('room-detail',$roomSameCate->id)}}"> +8
                                                        More </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hotel-view-contents-bottom">
                                            <div class="hotel-view-contents-bottom-flex">
                                                <div class="hotel-view-contents-bottom-contents">
                                                    <h4 class="hotel-view-contents-bottom-title">
                                                        {{ number_format($roomSameCate->price, 0, ',', '.') }}
                                                        VND<sub>/{{ __('DAY') }}</sub>
                                                    </h4>
                                                </div>
                                                <div class="btn-wrapper">
                                                    <a href="{{route('room-detail',$roomSameCate->id)}}" class="cmn-btn btn-bg-1 btn-small">
                                                        {{ __('Room detail') }} </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    @parent
    <script src="{{asset('js/app.js')}}"></script>
    <!-- InputMask -->
    <script src="{{ asset('bower_components/template-admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/template-admin/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('bower_components/template-admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script
        src="{{ asset('bower_components/template-admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js') }}">
    </script>
    <script src="{{asset('js/getDate.js')}}"></script>
@endsection
