@extends('admin.layout.app')
@section('title')
    {{ $title }}
@endsection
@section('style')
    @parent
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/template-admin/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('bower_components/template-admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-7">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{__('BOOKING')}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.booking.store', $room->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">{{__('Firstname')}}</label>
                                    <input type="text" class="form-control" name="firstname" id="name"
                                        value="{{ old('firstname') }}" placeholder="{{__('Enter firstname')}}">
                                </div>
                                @error('firstname')
                                    <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
                                        <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">{{__('Lastname')}} </label>
                                    <input type="text" class="form-control" name="lastname" id="name"
                                        value="{{ old('lastname') }}" placeholder="{{__('Enter lastname')}} ">
                                </div>
                                @error('lastname')
                                    <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
                                        <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                                placeholder="{{__('Enter email')}}">
                        </div>
                        @error('email')
                            <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
                                <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label for="Phone">{{__('PHONE')}}</label>
                            <input type="text" class="form-control" name="phone" id="Phone"
                                value="{{ old('phone') }}" placeholder="{{__('Enter phone')}}">
                        </div>
                        @error('phone')
                            <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
                                <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="row">
                            <div class="form-group col-6">
                                <label>{{__('CHECKIN')}}:</label>
                                <div class="input-group date mb-2" id="checkin" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="checkin"  value="{{old('checkin')}}"
                                        data-target="#checkin" />
                                    <div class="input-group-append" data-target="#checkin" data-toggle="datetimepicker">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                                @error('checkin')
                                    <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
                                        <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>{{__('CHECKOUT')}}:</label>
                                <div class="input-group date mb-2" id="checkout" data-target-input="nearest">
                                    <input type="text" name="checkout" class="form-control datetimepicker-input" value="{{old('checkout')}}"
                                        data-target="#checkout" />
                                    <div class="input-group-append" data-target="#checkout" data-toggle="datetimepicker">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                                @error('checkout')
                                    <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
                                        <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">{{__('ADDRESS')}}</label>
                            <input type="text" class="form-control" name="address" id="address"
                                value="{{ old('address') }}" placeholder="{{__('Enter address')}}">
                        </div>
                        @error('address')
                            <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
                                <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label for="">{{__('INFORMATION')}}</label>
                            <textarea name="infomation" class="form-control" id="" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{__('SAVE')}}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <img class="card-img-top" src="{{ Storage::url($room->image) }}" alt="">
                <div class="card-body">
                    <h4 class="card-title">{{__('ROOM')}}: {{ $room->name }}</h4>
                    <p class="card-text">{{ number_format($room->price, 0, '.', ',') }} VND/{{__('DAY')}}</p>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    @parent
    <!-- InputMask -->
    <script src="{{ asset('bower_components/template-admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/template-admin/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('bower_components/template-admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script
        src="{{ asset('bower_components/template-admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <script>
        $(function() {
            $("#checkin").datetimepicker({
                minDate: new Date(),
                // disabledDates:datesForDisable,
                icons: {
                    time: "far fa-clock"
                },
            });
            $("#checkout").datetimepicker({
                minDate: new Date(),
                format : 
                // disabledDates:datesForDisable,
                icons: {
                    time: "far fa-clock"
                },
            });
        });
    </script>
@endsection
