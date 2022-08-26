<header class="header-style-01">
    <nav class="navbar navbar-area navbar-border navbar-padding navbar-expand-lg">
        <div class="container custom-container-one nav-container">
            <div class="logo-wrapper">
                <a href="" class="logo">
                    <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/logo.png') }}"
                        alt="">
                </a>
            </div>
            <div class="responsive-mobile-menu d-lg-none">
                <a href="javascript:void(0)" class="click-nav-right-icon">
                    <i class="las la-ellipsis-v"></i>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#hotel_booking_menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="hotel_booking_menu">
                <ul class="navbar-nav">
                    <li><a href="{{route('home')}}">{{ __('HOME')}}</a></li>
                    <li><a href="#"> {{__('ABOUT')}} </a></li>
                    <li><a href="{{route('room')}}"> {{__('ROOM')}} </a></li>
                    <li><a href="#">{{__('BLOG')}}</a> </li>
                    <li><a href="#"> {{__('CONTACTUS')}} </a></li>
                </ul>
                <div class="dropdown show">
                    <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="las la-language"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item"
                        href="{{ route('change-language', ['en']) }}">{{__('ENGLISH')}}</a>
                    <a class="dropdown-item"
                        href="{{ route('change-language', ['vi']) }}">{{ __('VIETNAMESE') }}</a>
                    </div>
                  </div>
            </div>
            @if ( !auth('customer')->check())
            <div class="navbar-right-content show-nav-content">
                <div class="single-right-content">
                    <div class="navbar-right-flex">
                        <div class="navbar-right-btn">
                            <a href="{{route('login')}}"> {{__('SignIn')}} </a>
                        </div>
                        <div class="btn-wrapper">
                            <a href="{{route('register')}}" class="cmn-btn btn-bg-1 radius-10"> {{__('SignUp')}} </a>
                        </div>
                    </div>
                </div>
            </div> 
            @else
            <div class="navbar-right-content show-nav-content">
                <div class="single-right-content">
                    <div class="navbar-author">
                        <div class="navbar-author-flex">
                            <div class="navbar-author-name">
                                <h6 class="navbar-author-name-title">{{auth('customer')->user()->fullname}} </h6>
                            </div>
                        </div>
                        <div class="navbar-author-wrapper">
                            <div class="navbar-author-wrapper-list">
                                <a href="#" class="navbar-author-wrapper-list-item"> {{__('Profile')}} </a>
                                <a href="{{route('logoutClient')}}" class="navbar-author-wrapper-list-item">{{__('LOGOUT')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </nav>
</header>