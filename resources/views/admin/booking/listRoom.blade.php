@extends('admin.layout.app')
@section('title')
    {{ $title }}
@endsection
@section('style')
    @parent
    <link rel="stylesheet"
        href="{{ asset('bower_components/template-admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="card col-12">
            <div class="card-header">
                <h3 class="card-title">{{ __($title) }}</h3>
                <p class="">
                </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                   @foreach ($rooms as $room )
                   <div class="card col-3 m-4 p-0" >
                    <div class="img" style="height: 120px">
                        <img class="card-img-top" height="100%" src="{{Storage::url($room->image)}}" >
                    </div>
                    <div class="card-body">
                      <div class="row p-2">
                        <h5 class="card-title pb-2">{{$room->name}}  </h5><p class="ml-3"><span class="badge {{$room->empty==0 ? 'badge-danger' : 'badge-success'}}">{{$room->empty==0 ? __("OFF") : __("ON")}}</span></p>
                    </div>
                    <p >{{$room->category->name }}</p>
                    <div class="d-flex">
                        <a href="{{route('admin.booking.create',$room->id)}}" class="flex-right btn btn-primary">{{__('BOOKING')}}</a>
                    </div>
                    </div>
                  </div>
                   @endforeach
                </div>
                <div class="row">
                    {{$rooms->links()}}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/remove-ajax.js') }}"></script>
@endsection
