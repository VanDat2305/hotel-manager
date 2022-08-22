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
                            <div> {{ $customers->links() }}</div>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>{{__('Fullname')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('PHONE')}}</th>
                            <th>{{__('ADDRESS')}}</th>
                            <th>{{__('STATUS')}}</th>
                            <th>
                                {{-- <a href="{{ route('admin.customer.create') }}"><i class="fa fa-plus"></i></a> --}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $customer->fullname }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                    <button
                                        class="btn {{ $customer->status == config('custom.customer_status_text.active') ? 'btn-success' : 'btn-danger' }} btn-sm btn-update"
                                        data-id="{{ $customer->id }}">{{ __($customer->status) }}</button>
                                <td>
                                    <button class="btn btn-danger btn-sm delete-confirm" value="{{ $customer->id }}"><i
                                            class="fa fa-trash"></i></button>
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
