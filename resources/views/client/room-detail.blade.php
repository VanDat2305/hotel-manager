@extends('client.layout.app')
@section('title')
    {{__('Room detail')}}
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
                            {{-- <div class="hotel-view-contents-middle">
                                <div class="hotel-view-contents-flex">
                                    <div class="hotel-view-contents-icon d-flex gap-1">
                                        <span> <i class="las la-parking"></i> </span>
                                        <p class="hotel-view-contents-icon-title flex-fill"> Parking </p>
                                    </div>
                                    <div class="hotel-view-contents-icon d-flex gap-1">
                                        <span> <i class="las la-wifi"></i> </span>
                                        <p class="hotel-view-contents-icon-title flex-fill"> Wifi </p>
                                    </div>
                                    <div class="hotel-view-contents-icon d-flex gap-1">
                                        <span> <i class="las la-coffee"></i> </span>
                                        <p class="hotel-view-contents-icon-title flex-fill"> Breakfast </p>
                                    </div>
                                    <div class="hotel-view-contents-icon d-flex gap-1">
                                        <span> <i class="las la-quidditch"></i> </span>
                                        <p class="hotel-view-contents-icon-title flex-fill"> Room Service </p>
                                    </div>
                                    <div class="hotel-view-contents-icon d-flex gap-1">
                                        <span> <i class="las la-swimming-pool"></i> </span>
                                        <p class="hotel-view-contents-icon-title flex-fill"> Pool </p>
                                    </div>
                                    <div class="hotel-view-contents-icon d-flex gap-1">
                                        <span> <i class="las la-receipt"></i> </span>
                                        <p class="hotel-view-contents-icon-title flex-fill"> Reception </p>
                                    </div>
                                    <div class="hotel-view-contents-icon d-flex gap-1">
                                        <span> <i class="las la-dumbbell"></i> </span>
                                        <p class="hotel-view-contents-icon-title flex-fill"> Gym </p>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="hotel-view-contents-bottom">
                                <div class="hotel-view-contents-bottom-flex">
                                    <div class="hotel-view-contents-bottom-contents">
                                        <h4 class="hotel-view-contents-bottom-title">
                                            {{ number_format($room->price, 0, ',', '.') }} VND<sub>/{{__('DAY')}}</sub> </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="details-contents-tab">
                            <ul class="tabs details-tab details-tab-border">
                                <li class="active" data-tab="about"> {{__("DESCRIPTION")}} </li>
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
                                <form action="" id='checkout-form'
                                    method="post">
                                    @csrf
                                    @error('booking')
                                        <div class="text-danger error">{{ $message }}</div>
                                    @enderror
                                    <div class="single-input">
                                        <label class="details-sidebar-dropdown-title"> {{__('CHECKIN')}} </label>
                                        <input class="form-control" name="departure_date" id="from-picker"
                                            type="text" autocomplete="off" placeholder="{{ __('Enter checkin')}}"
                                            value="{{ old('departure_date') }}">
                                    </div>
                                    @error('departure_date')
                                        <div class="text-danger error">{{ $message }}</div>
                                    @enderror
                                    <div class="single-input mt-3">
                                        <label class="details-sidebar-dropdown-title"> {{__('CHECKOUT')}} </label>
                                        <input class="form-control" name="arrival_date" id="to-picker" type="text"
                                            autocomplete="off" placeholder="{{ __('Enter checkout')}}"
                                            value="{{ old('arrival_date') }}">
                                    </div>
                                    @error('arrival_date')
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
                                <h3 class="hotel-view-contents-title"> {{$roomSameCate->name }} </h3>
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
                                        <a class="hotel-view-contents-icon-more" href="javascript:void(0)"> +8
                                            More </a>
                                    </div>
                                </div>
                            </div>
                            <div class="hotel-view-contents-bottom">
                                <div class="hotel-view-contents-bottom-flex">
                                    <div class="hotel-view-contents-bottom-contents">
                                        <h4 class="hotel-view-contents-bottom-title">   {{ number_format($roomSameCate->price, 0, ',', '.') }} VND<sub>/{{__('DAY')}}</sub> 
                                        </h4>
                                    </div>
                                    <div class="btn-wrapper">
                                        <a href="javascript:void(0)" class="cmn-btn btn-bg-1 btn-small"> {{__('Room detail')}} </a>
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