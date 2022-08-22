@extends('admin.layout.app')
@section('title')
        {{$title}}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$countBooking}}</h3>

                <p>{{__('BOOKING')}}</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="{{route('admin.booking.index')}}" class="small-box-footer">{{__('MOREINFO')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$countCate}}</h3>

                <p>{{__('CATEGORY')}}</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('admin.category.index')}}" class="small-box-footer">{{__('MOREINFO')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$countRoom}}</h3>

                <p>{{__('ROOM')}}</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('admin.room.index')}}" class="small-box-footer">{{__('MOREINFO')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$countCustomer}}</h3>

                <p>{{__('CUSTOMER')}}</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="{{route('admin.customer.index')}}" class="small-box-footer">{{__('MOREINFO')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    
    <!-- ./col -->
</div>
@endsection