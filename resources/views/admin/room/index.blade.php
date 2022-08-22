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
                <h3 class="card-title">{{ $title }}</h3>
                <p class="">
                </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
                    <thead>
                        <tr>
                            <div>
                                {{ $rooms->links() }}</div>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th><a href="{{ route('admin.room.create') }}"><i class="fa fa-plus"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $room->name }}</td>
                                <td>{{ number_format($room->price, 0, '.', ',') }} VND</td>
                                <td>{{ $room->category->name }}</td>
                                <td>
                                    <img src="{{ $room->image ? Storage::url($room->image) : asset('bower_components/template-admin/dist/img/photo2.png') }}"
                                        alt="" srcset="" width="150px">
                                </td>
                                <td>{{ $room->description }}</td>
                                <td>
                                    <button
                                        class="btn {{ $room->status == config('custom.room_status_text.active') ? 'btn-success' : 'btn-danger' }} btn-sm btn-update"
                                        data-id="{{ $room->id }}">{{ $room->status }}</button>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.room.edit', ['id' => $room->id]) }}"><i
                                            class="fa fa-edit"></i></a>
                                    <button class="btn btn-danger btn-sm delete-confirm" type="submit"
                                        value="{{ $room->id }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <div class="d-felx justify-content-center">

                            </div>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/remove-ajax.js') }}"></script>
@endsection
