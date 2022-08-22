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
                            <div>{{ $categories->links() }}</div>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-default">
                                    <i class="fa fa-plus"></i>
                                </button>
                                {{-- <a href="{{ route('admin.category.create') }}"><i class="fa fa-plus"></i></a> --}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->user->name }}</td>
                                <td>
                                    <button class="btn {{$category->status == config('custom.category_status_text.active') ? 'btn-success' :'btn-danger'}} btn-sm btn-update"
                                            data-id="{{ $category->id }}">{{ $category->status }}</button>
                                <td>
                                    <button class="btn btn-primary btn-sm btn-modal-edit" data-toggle="modal"
                                        data-target="#modal-edit" data-name="{{ $category->name }}"
                                        data-id="{{ $category->id }}"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm delete-confirm" value="{{ $category->id }}"><i
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
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" name="name" id="nameInput" placeholder="Enter Name">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade  p-1 " id="message" role="alert">
                        <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-primary btn-create">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" name="nameEdit" id="nameEdit" placeholder="Enter Name">
                    </div>
                    <input type="hidden" value="" id="idCate">
                    <div class="alert alert-danger alert-dismissible fade  p-1 " id="messageEdit" role="alert">
                        <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <span></span>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-primary btn-edit">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/remove-ajax.js') }}"></script>
    <script src="{{ asset('js/create-update-category.js') }}"></script>
@endsection
