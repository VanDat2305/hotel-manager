@extends('client.layout.app')
@section('title')
   {{__('HOME')}} 
@endsection
@section('content')
<div class="banner-area banner-area  ">
    {{-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($banners as $banner)
                <div class="carousel-item {{ $loop->index == 1 ? 'active' : '' }}">
                    <img height="450rem" src="{{ Storage::url($banner->image) }}" class="d-block w-100" alt="...">
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> --}}
</div>

<div class="location-area pat-90">
    <div class="container">
        <div class="banner-location bg-white radius-5">
            <form class="banner-location-flex" method="post" action="">
                @csrf
                <div class="banner-location-single">
                    <div class="banner-location-single-flex">
                        <div class="banner-location-single-contents">
                            <span class="banner-location-single-contents-subtitle">{{__('CHECKIN')}} </span>
                            <input class="form-control " name="checkin" id="from-picker" type="text"
                                placeholder="{{__('Enter checkin')}}">
                        </div>
                    </div>
                </div>
                <div class="banner-location-single">
                    <div class="banner-location-single-flex">
                        <div class="banner-location-single-contents">
                            <span class="banner-location-single-contents-subtitle"> {{__('CHECKOUT')}} </span>
                            <input class="form-control " name="checkout" id="to-picker" type="text"
                                placeholder="{{__('Enter checkout')}}">
                        </div>
                    </div>
                </div>
                <div class="banner-location-single">
                    <div class="banner-location-single-flex">
                        <div class="banner-location-single-contents">
                            <span class="banner-location-single-contents-subtitle"> {{__('CATEGORY')}} </span>
                            <select class=" form-control" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="banner-location-single-search">
                        <button class="btn btn-primary  search-click-icon ">
                            <i class="las la-search pt-1 pb-1"></i>
                        </button>
                </div>
            </form>
        </div>
    </div>
</div>
<section class="attraction-area pat-50 pab-50">
    <div class="container">
        <div class="section-title center-text">
            <h2 class="title">{{__('ROOM')}}</h2>
            <div class="section-title-line"></div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="global-slick-init attraction-slider nav-style-one nav-color-two slider-inner-margin"
                    data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="4"
                    data-swipeToSlide="true" data-autoplay="true" data-autoplaySpeed="2500"
                    data-prevArrow='<div class="prev-icon radius-parcent-50"><i class="las la-angle-left"></i></div>'
                    data-nextArrow='<div class="next-icon radius-parcent-50"><i class="las la-angle-right"></i></div>'
                    data-responsive='[{"breakpoint": 1400,"settings": {"slidesToShow": 4}},{"breakpoint": 1200,"settings": {"slidesToShow": 3}},{"breakpoint": 992,"settings": {"slidesToShow": 3}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 576, "settings": {"slidesToShow": 1} }]'>
                    @foreach ($rooms as $room )
                    <div class="attraction-item">
                        <div class="single-attraction-two radius-20">
                            <div class="single-attraction-two-thumb">
                                <a href="{{Storage::url($room->image)}}"
                                    class="gallery-popup">
                                    <img src="{{Storage::url($room->image)}}" height="200rem"
                                        alt="img" />
                                </a>
                            </div>
                            <div class="single-attraction-two-contents">
                                <h4 class="single-attraction-two-contents-title">
                                    <a href="{{route('room-detail',$room->id)}}"> {{$room->name}} </a>
                                </h4>
                                <p class="single-attraction-two-contents-para">
                                    <a href="{{route('room-detail',$room->id)}}">{{__('BOOKING')}}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<section class="attraction-area pat-50 pab-50">
    <div class="container">
        <div class="section-title center-text">
            <h2 class="title">{{__('AROUNDHOTEL')}}</h2>
            <div class="section-title-line"></div>
        </div>
        <div class="row g-4 mt-4">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="single-attraction-two radius-20">
                    <div class="single-attraction-two-thumb">
                        <a href="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl1.jpg') }}"
                            class="gallery-popup-two">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl1.jpg') }}"
                                alt="img" />
                        </a>
                    </div>
                    <div class="single-attraction-two-contents">
                        <h4 class="single-attraction-two-contents-title">
                            <a href="hotel_details.html"> Eiffel Tower </a>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="single-attraction-two radius-20">
                    <div class="single-attraction-two-thumb">
                        <a href="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl2.jpg') }}"
                            class="gallery-popup-two">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl2.jpg') }}"
                                alt="img" />
                        </a>
                    </div>
                    <div class="single-attraction-two-contents">
                        <h4 class="single-attraction-two-contents-title">
                            <a href="hotel_details.html"> Disneyland </a>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="single-attraction-two radius-20">
                    <div class="single-attraction-two-thumb">
                        <a href="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl3.jpg') }}"
                            class="gallery-popup-two">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl3.jpg') }}"
                                alt="img" />
                        </a>
                    </div>
                    <div class="single-attraction-two-contents">
                        <h4 class="single-attraction-two-contents-title">
                            <a href="hotel_details.html"> Palace de justice </a>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="single-attraction-two radius-20">
                    <div class="single-attraction-two-thumb">
                        <a href="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl4.jpg') }}"
                            class="gallery-popup-two">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl4.jpg') }}"
                                alt="img" />
                        </a>
                    </div>
                    <div class="single-attraction-two-contents">
                        <h4 class="single-attraction-two-contents-title">
                            <a href="hotel_details.html"> Arc de Trimorph </a>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="single-attraction-two radius-20">
                    <div class="single-attraction-two-thumb">
                        <a href="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl5.jpg') }}"
                            class="gallery-popup-two">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl5.jpg') }}"
                                alt="img" />
                        </a>
                    </div>
                    <div class="single-attraction-two-contents">
                        <h4 class="single-attraction-two-contents-title">
                            <a href="hotel_details.html"> Disneyland </a>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="single-attraction-two radius-20">
                    <div class="single-attraction-two-thumb">
                        <a href="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl6.jpg') }}"
                            class="gallery-popup-two">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl6.jpg') }}"
                                alt="img" />
                        </a>
                    </div>
                    <div class="single-attraction-two-contents">
                        <h4 class="single-attraction-two-contents-title">
                            <a href="hotel_details.html"> Disneyland </a>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="single-attraction-two radius-20">
                    <div class="single-attraction-two-thumb">
                        <a href="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl7.jpg') }}"
                            class="gallery-popup-two">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl7.jpg') }}"
                                alt="img" />
                        </a>
                    </div>
                    <div class="single-attraction-two-contents">
                        <h4 class="single-attraction-two-contents-title">
                            <a href="hotel_details.html"> Disneyland </a>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="single-attraction-two radius-20">
                    <div class="single-attraction-two-thumb">
                        <a href="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl8.jpg') }}"
                            class="gallery-popup-two">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/cl8.jpg') }}"
                                alt="img" />
                        </a>
                    </div>
                    <div class="single-attraction-two-contents">
                        <h4 class="single-attraction-two-contents-title">
                            <a href="hotel_details.html"> Disneyland </a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="brand-area pat-50 pab-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="global-slick-init attraction-slider slider-inner-margin" data-slidesToShow="6"
                    data-infinite="true" data-arrows="false" data-dots="false" data-swipeToSlide="true"
                    data-autoplay="true" data-autoplaySpeed="2500"
                    data-prevArrow='<div class="prev-icon"><i class="las la-angle-left"></i></div>'
                    data-nextArrow='<div class="next-icon"><i class="las la-angle-right"></i></div>'
                    data-responsive='[{"breakpoint": 1400,"settings": {"slidesToShow": 5}},{"breakpoint": 1200,"settings": {"slidesToShow": 4}},{"breakpoint": 992,"settings": {"slidesToShow": 3}},{"breakpoint": 576, "settings": {"slidesToShow": 2} }]'>
                    <div class="single-brand">
                        <a href="javascript:void(0)" class="single-brand-thumb">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/logo1.png') }}"
                                alt="brandLogo" />
                        </a>
                    </div>
                    <div class="single-brand">
                        <a href="javascript:void(0)" class="single-brand-thumb">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/logo2.png') }}"
                                alt="brandLogo" />
                        </a>
                    </div>
                    <div class="single-brand">
                        <a href="javascript:void(0)" class="single-brand-thumb">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/logo3.png') }}"
                                alt="brandLogo" />
                        </a>
                    </div>
                    <div class="single-brand">
                        <a href="javascript:void(0)" class="single-brand-thumb">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/logo4.png') }}"
                                alt="brandLogo" />
                        </a>
                    </div>
                    <div class="single-brand">
                        <a href="javascript:void(0)" class="single-brand-thumb">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/logo5.png') }}"
                                alt="brandLogo" />
                        </a>
                    </div>
                    <div class="single-brand">
                        <a href="javascript:void(0)" class="single-brand-thumb">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/logo6.png') }}"
                                alt="brandLogo" />
                        </a>
                    </div>
                    <div class="single-brand">
                        <a href="javascript:void(0)" class="single-brand-thumb">
                            <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/logo3.png') }}"
                                alt="brandLogo" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection