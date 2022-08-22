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
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
                    <thead>
                        <tr>
                            <div>{{ $users->links() }}</div>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>{{__('NAME')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('PHONE')}}</th>
                            <th>{{__('IMAGE')}}</th>
                            <th>{{__('ROLE')}}</th>
                            <th>{{__('STATUS')}}</th>
                            <th><a href="{{ route('admin.user.create') }}"><i class="fa fa-plus"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <img src="{{ $user->image ? Storage::url($user->image) : asset('bower_components/template-admin/dist/img/avatar.png') }}"
                                        alt="" srcset="" height="50px">
                                </td>
                                <td>{{ $user->role->name }}</td>
                                <td>
                                    <button
                                        class="btn  {{ $user->status == config('custom.user_status_text.active') ? 'btn-success' : 'btn-danger' }} btn-sm btn-update"
                                        data-id="{{ $user->id }}">{{ __($user->status) }}</button>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.user.edit', ['id' => $user->id]) }}"><i
                                            class="fa fa-edit"></i></a>
                                    @if ($user->role_id != config('custom.user_roles.admin'))
                                        <button class="btn btn-danger btn-sm delete-confirm" type="submit"
                                            value="{{ $user->id }}"><i class="fa fa-trash"></i></button>
                                    @endif
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
