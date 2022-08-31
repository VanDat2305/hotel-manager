@extends('client.layout.app')
@section('title')
    {{ __('INFOCHECKOUT') }}
@endsection
@section('style')
    @parent
    <style>
        .disable-input{
            pointer-events: none; 
            background-color: #eee;
        }
    </style>
@endsection
@section('content')
    <section class="Checkout-area section-bg-2 pat-50 pab-100">
        <div class="container">
            <form class="row g-4" method="POST" action="{{route('payment')}}">
                @csrf
                <div class="col-xl-8 col-lg-7">
                    <div class="checkout-wrapper">
                        <div class="checkout-single bg-white radius-10">
                            <h4 class="checkout-title"> {{ __('User Information') }} </h4>
                            <div class="checkout-contents mt-3">
                                <div class="checkout-form custom-form">
                                    <div class="input-flex-item">
                                        <div class="single-input mt-4">
                                            <label class="label-title"> {{ __('Firstname') }} </label>
                                            <input class="form--control disable-input "  type="text" name="firstname"
                                                value="{{ auth('customer')->user()->firstname }}">
                                        </div>
                                        <div class="single-input mt-4">
                                            <label class="label-title"> {{ __('Lastname') }} </label>
                                            <input class="form--control disable-input"  type="text" name="lastname"
                                                value="{{ auth('customer')->user()->lastname }}">
                                        </div>
                                    </div>
                                    <div class="input-flex-item">
                                        <div class="single-input mt-4">
                                            <label class="label-title"> {{ __('PHONE') }} </label>
                                            <input class="form--control disable-input"  type="text"
                                                value="{{ auth('customer')->user()->phone }}">
                                        </div>
                                        <div class="single-input mt-4">
                                            <label class="label-title"> {{ __('Email Address') }} </label>
                                            <input class="form--control disable-input"  type="text" name="email"
                                                value="{{ auth('customer')->user()->email }}">
                                        </div>
                                    </div>
                                    <div class="input-flex-item">
                                        <div class="single-input mt-4">
                                            <label class="label-title"> {{ __('ADDRESS') }} </label>
                                            <input class="form--control disable-input"  type="text" name="address"
                                                value="{{ auth('customer')->user()->address }}">
                                        </div>
                                    </div>
                                    <div class="input-flex-item">
                                        <div class="single-input mt-4">
                                            <label class="label-title"> {{ __('INFORMATION') }} </label>
                                            <textarea class="form--control "  type="text" name="infomation"
                                                value=""></textarea>
                                        </div>
                                    </div>
                                    <div class="btn-wrapper mt-4">
                                        <button type="submit" name="redirect" class="cmn-btn btn-bg-1 btn-small"> {{__('Pay & Confirm')}} </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="sticky-top">
                        <div class="checkout-widget checkout-widget-padding widget bg-white radius-10">
                            <div class="checkout-sidebar">
                                <h4 class="checkout-sidebar-title"> {{ __('Booking Details') }} </h4>
                                <div class="checkout-sidebar-contents">
                                    <ul class="checkout-flex-list list-style-none checkout-border-top pt-3 mt-3">
                                        <li class="list"> <span class="regular"> {{ __('CHECKIN') }} </span> <span
                                                class="strong"><input type="text" class="disable-input border-0" name="checkin" value=" {{ $checkin }}"> </span> </li>
                                        <li class="list"> <span class="regular"> {{ __('CHECKOUT') }} </span> <span
                                                class="strong"><input type="text" class="disable-input border-0" name="checkout" value=" {{ $checkout }}">  </span> </li>
                                        <li class="list"> <span class="regular"> {{ __('NAMEROOM') }} </span> <span
                                                class="strong"> {{ $room->name }} </span> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-widget checkout-widget-padding widget bg-white radius-10">
                            <div class="checkout-sidebar">
                                <h4 class="checkout-sidebar-title"> {{ __('Invoice') }} </h4>
                                <div class="checkout-sidebar-contents">
                                    <ul class="checkout-flex-list list-style-none checkout-border-top pt-3 mt-3">
                                        <li class="list"> <span class="regular"> {{ __('PRICE') }} </span> <span
                                                class="strong">
                                                {{ number_format($sub_price, 0, ',', '.') }} {{ __('VND') }}</span>
                                        </li>
                                        <li class="list"> <span class="regular"> {{ __('Vat') }} </span> <span
                                                class="strong">
                                                (+{{ config('custom.vat') }}%) {{ number_format($vat, 0, ',', '.') }}
                                                {{ __('VND') }}</span> </li>
                                    </ul>
                                    <ul class="checkout-flex-list list-style-none checkout-border-top pt-3 mt-3">
                                        <li class="list"> <span class="regular"> {{ __('TOTALPRICE') }} </span> <span
                                                class="strong color-one fs-20"> {{ number_format($totalPrice, 0, ',', '.') }}
                                                {{ __('VND') }}</span> </li>
                                                <input type="hidden" name="total_price" value="{{$totalPrice}}">
                                                <input type="hidden" name="room_id" value="{{$room->id}}">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
