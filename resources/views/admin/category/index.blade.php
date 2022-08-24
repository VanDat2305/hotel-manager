@extends('admin.layout.app')
@section('title')
    {{ $title }}
@endsection
@section('style')
    @parent
    <link rel="stylesheet"
        href="{{ asset('bower_components/template-admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('bower_components/template-admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('bower_components/template-admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
                        {{-- <tr>
                            <div>{{ $categories->links() }}</div>
                        </tr> --}}
                        <tr>
                            <th>#</th>
                            <th>{{ __('NAME') }}</th>
                            <th>{{ __('AUTHOR') }}</th>
                            <th>{{ __('STATUS') }}</th>
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
                                    <button
                                        class="btn {{ $category->status == config('custom.category_status_text.active') ? 'btn-success' : 'btn-danger' }} btn-sm btn-update"
                                        data-id="{{ $category->id }}">{{ __($category->status) }}</button>
                                <td>
                                    <button class="btn btn-primary btn-sm btn-modal-edit" data-toggle="modal"
                                        data-target="#modal-edit" data-name="{{ $category->name }}"
                                        data-id="{{ $category->id }}"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm delete-confirm" value="{{ $category->id }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
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
                    <h4 class="modal-title">{{ __('Add category') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Name">{{ __('NAME') }}</label>
                        <input type="text" class="form-control" name="name" id="nameInput"
                            placeholder="{{ __('Enter Name') }}">
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
                    <button type="button" class="btn btn-primary btn-create">{{ __('SAVE') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit category') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Name">{{ __('NAME') }}</label>
                        <input type="text" class="form-control" name="nameEdit" id="nameEdit"
                            placeholder="{{ __('Enter Name') }}">
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
                    <button type="button" class="btn btn-primary btn-edit">{{ __('SAVE') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @parent
    <script src="{{ asset('bower_components/template-admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/template-admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script
        src="{{ asset('bower_components/template-admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script
        src="{{ asset('bower_components/template-admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('bower_components/template-admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ asset('bower_components/template-admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('bower_components/template-admin/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('bower_components/template-admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('bower_components/template-admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('bower_components/template-admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}">
    </script>
    <script src="{{ asset('bower_components/template-admin/plugins/datatables-buttons/js/buttons.print.min.js') }}">
    </script>
    <script src="{{ asset('bower_components/template-admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}">
    </script>
    <script>
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "paging": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    </script>
    <script src="{{ asset('js/remove-ajax.js') }}"></script>
    <script src="{{ asset('js/create-update-category.js') }}"></script>
@endsection
