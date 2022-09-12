@extends('client.layout.app')
@section('title')
    {{__('Dashboard')}}
@endsection
@section('content')
    <div class="body-overlay"></div>
    <div class="dashboard-area section-bg-2 dashboard-padding">
        <div class="container">
            <div class="dashboard-contents-wrapper">
                <div class="dashboard-icon">
                    <div class="sidebar-icon">
                        <i class="las la-bars"></i>
                    </div>
                </div>
                <div class="dashboard-left-content">
                    <div class="dashboard-close-main">
                        <div class="close-bars"> <i class="las la-times"></i> </div>
                        <div class="dashboard-bottom">
                            <ul class="dashboard-list list-style-none">
                                <li class="list active">
                                    <a href="{{route('dashboard')}}"> <i class="las la-briefcase"></i> {{__('DASHBOARD')}} </a>
                                </li>
                                {{-- <li class="list has-children">
                                    <a> <i class="las la-user-circle"></i>{{__('Profile')}}</a>
                                    <ul class="submenu list-style-none">
                                        <li class="list"> <a href="dashboard_profile.html"> {{__('Profile')}} </a> </li>
                                        <li class="list"> <a href="dashboard_edit_profile.html"> {{__('Edit Profile')}} </a> </li>
                                        <li class="list"> <a href="dashboard_pass_change.html"> {{__('Password Change')}} </a>
                                        </li>
                                    </ul>
                                </li> --}}
                                <li class="list">
                                    <a href="{{ route('logoutClient') }}"> <i class="las la-sign-out-alt"></i> {{__('LOGOUT')}} </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="dashboard-right-contents mt-4 mt-lg-0">
                    {{-- <div class="dashboard-promo">
                        <div class="row gy-4 justify-content-center">
                            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                                <div class="single-order">
                                    <div class="single-order-flex">
                                        <div class="single-order-contents">
                                            <span class="single-order-contents-subtitle"> Pending Reservation </span>
                                            <h2 class="single-order-contents-title"> 02 </h2>
                                        </div>
                                        <div class="single-order-icon">
                                            <i class="las la-history"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                                <div class="single-order">
                                    <div class="single-order-flex">
                                        <div class="single-order-contents">
                                            <span class="single-order-contents-subtitle"> Accepted Reservation </span>
                                            <h2 class="single-order-contents-title"> 32 </h2>
                                        </div>
                                        <div class="single-order-icon">
                                            <i class="las la-check-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                                <div class="single-order">
                                    <div class="single-order-flex">
                                        <div class="single-order-contents">
                                            <span class="single-order-contents-subtitle"> Cancelled Reservation </span>
                                            <h2 class="single-order-contents-title"> 08 </h2>
                                        </div>
                                        <div class="single-order-icon">
                                            <i class="las la-times-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                                <div class="single-order">
                                    <div class="single-order-contents">
                                        <span class="single-order-contents-subtitle"> Completed Reservation </span>
                                        <h2 class="single-order-contents-title">38 </h2>
                                    </div>
                                    <div class="single-order-icon">
                                        <i class="las la-clipboard-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="dashboard-reservation">
                      @foreach ($bookings as $booking)
                      <div class="single-reservation bg-white base-padding @php echo $loop->index == 0 ? 'show open' : ''  @endphp ">
                        <div class="single-reservation-expandIcon"> <i class="las la-angle-down"></i> </div>
                        <div class="single-reservation-head">
                            <div class="single-reservation-flex">
                                <div class="single-reservation-content">
                                    <h5 class="single-reservation-content-title"> {{__('BOOKINGID')}} </h5>
                                    <span class="single-reservation-content-id"> #{{$booking->id}} </span>
                                </div>
                                <div class="single-reservation-btn">
                                    <a href="javascript:void(0)" class="dash-btn btn-pending"> {{__($booking->status)}} </a>
                                </div>
                            </div>
                        </div>
                        <div class="single-reservation-inner">
                            <div class="single-reservation-item">
                                <div class="single-reservation-details">
                                    <div class="single-reservation-details-item">
                                        <span class="single-reservation-details-subtitle"> {{__('CHECKIN')}} </span>
                                        <h5 class="single-reservation-details-title"> {{$booking->check_in}} </h5>
                                    </div>
                                    <div class="single-reservation-details-item">
                                        <span class="single-reservation-details-subtitle">  {{__('CHECKOUT')}} </span>
                                        <h5 class="single-reservation-details-title"> {{$booking->check_out}} </h5>
                                    </div>
                                    <div class="single-reservation-details-item">
                                        <span class="single-reservation-details-subtitle"> {{__('TOTALPRICE')}} </span>
                                        <h5 class="single-reservation-details-title"> {{number_format($booking->total_price,0,',','.')}} {{__('VND')}}  </h5>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="single-reservation-item">
                                <div class="single-reservation-flex">
                                    <div class="single-reservation-btn">
                                        <a href="javascript:void(0)" class="dash-btn popup-click"> <i
                                                class="las la-exclamation-circle"></i> Cancel? </a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                      @endforeach
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <div class="pagination-wrapper">
                               {{ $bookings->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="popup-overlay"></div>
    <div class="popup-fixed">
        <div class="popup-contents popup-cancell-modal">
            <h2 class="popup-contents-title"> Why do you want to cancel? </h2>
            <div class="popup-contents-select">
                <label class="popup-contents-select-label"> Choose a reason </label>
                <div class="js-select">
                    <select>
                        <option value="1">Don't want to Book</option>
                        <option value="2">Booked Accidentally</option>
                        <option value="3">Don't want to Book</option>
                    </select>
                </div>
            </div>
            <div class="popup-contents-btn flex-btn">
                <a href="javascript:void(0)" class="dash-btn popup-close"> <i class="las la-arrow-left"></i> Go Back
                </a>
                <a href="javascript:void(0)" class="dash-btn btn-cancelled popup-close"> Cancel </a>
            </div>
        </div>
    </div>
@endsection