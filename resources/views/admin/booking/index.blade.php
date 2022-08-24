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
                            <div>{{ $bookings->links() }}</div>
                        </tr> --}}
                        <tr>
                            <th>#</th>
                            <th>{{ __('Fullname') }}</th>
                            <th>{{ __('PHONE') }}</th>
                            <th>{{ __('ROOM') }}</th>
                            <th>{{ __('CHECKIN') }}</th>
                            <th>{{ __('CHECKOUT') }}</th>
                            <th>{{ __('STATUS') }}</th>
                            <th><a href="{{ route('admin.booking.listRoom') }}"><i class="fa fa-plus"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $booking->customer->fullname }}</td>
                                <td>{{ $booking->customer->phone }}</td>
                                <td>{{ $booking->room->name }}</td>
                                <td>{{ $booking->check_in }}</td>
                                <td>{{ $booking->check_out }}</td>
                                <td>
                                    @php
                                        foreach (config('custom.booking_status') as $key => $value) {
                                            if ($key == $booking->status) {
                                                $active = $value;
                                            }
                                        }
                                        $bookingStatus = null;
                                        switch ($booking->status) {
                                            case config('custom.booking_status_text.Confirmed'):
                                                $bookingStatus = 'bg-indigo';
                                                break;
                                            case config('custom.booking_status_text.Operational'):
                                                $bookingStatus = 'bg-navy';
                                                break;
                                            case config('custom.booking_status_text.Completed'):
                                                $bookingStatus = 'bg-purple';
                                                break;
                                            case config('custom.booking_status_text.Cancelled'):
                                                $bookingStatus = 'bg-fuchsia';
                                                break;
                                            case config('custom.booking_status_text.Unsuccessful'):
                                                $bookingStatus = 'bg-maroon';
                                                break;
                                            default:
                                                $bookingStatus = 'bg-indigo';
                                                break;
                                        }
                                    @endphp
                                    <a class="btn btn-second {{ $bookingStatus }} btn-sm dropdown-toggle"
                                        style="width: 100%" href="#" role="button" data-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ __($booking->status) }}
                                    </a>
                                    <div
                                        class="dropdown-menu {{ $booking->status == config('custom.booking_status_text.Unsuccessful') ? 'd-none' : '' }}">

                                        @foreach (config('custom.booking_status') as $key => $status)
                                            @if ($key != $booking->status && $status > $active)
                                                <a class="dropdown-item btn-status" data-id='{{ $booking->id }}'
                                                    data-status='{{ $status }}'>{{ __($key) }}</a>
                                            @endif
                                        @endforeach

                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.booking.detail', ['id' => $booking->id]) }}"><i
                                            class="fa fa-eye"></i></a>
                                    {{-- <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.booking.edit', ['id' => $booking->id]) }}"><i
                                            class="fa fa-edit"></i></a> --}}
                                    <button class="btn btn-danger btn-sm delete-confirm" type="submit"
                                        value="{{ $booking->id }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
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
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    </script>
    <script src="{{ asset('js/remove-ajax.js') }}"></script>
    <script>
        $('.btn-status').click(function() {
            var arrayUrl = $(location).attr('pathname').split('/');
            var model = arrayUrl[arrayUrl.length - 1]
            var thisBtn = $(this);
            var id = thisBtn.data('id');
            var status_id = thisBtn.data('status');
            Swal.fire({
                icon: 'warning',
                text: 'You want to change status?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                confirmButtonColor: '#e3342f',
                cancelButtonText: 'No'
            }).then(function(result) {
                if (result.isConfirmed) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: 'POST',
                        url: `${model}/update-status/${id}`,
                        data: {
                            "_method": 'POST',
                            "_token": CSRF_TOKEN,
                            "status": status_id,
                        },
                        success: function success(results) {

                            if (results.success === true) {
                                Swal.fire({
                                    title: 'Success',
                                    icon: 'success',
                                    type: 'success',
                                    text: results.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }, setTimeout(function() {
                                    thisBtn.attr('class',
                                        'dropdown-item btn-status d-none');
                                    $divChange = thisBtn.parent().parent().children(
                                        ":first");
                                    switch (results.data) {
                                        case 'Operational':
                                            $divChange.text(results.language);
                                            $divChange.attr('class',
                                                'btn  bg-navy btn-sm btn-status dropdown-toggle'
                                                )
                                            break;
                                        case 'Completed':
                                            $divChange.text(results.language);
                                            $divChange.attr('class',
                                                'btn  bg-purple btn-sm btn-status dropdown-toggle'
                                                )
                                            break;
                                        case 'Cancelled':
                                            $divChange.text(results.language);
                                            $divChange.attr('class',
                                                'btn  bg-fuchsia btn-sm btn-status dropdown-toggle'
                                                )
                                            break;
                                        case 'Unsuccessful':
                                            $divChange.text(results.language);
                                            $divChange.attr('class',
                                                'btn  bg-maroon btn-sm btn-status dropdown-toggle'
                                                )
                                            break;
                                        default:
                                            break;
                                    }
                                }, 0));
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    type: 'error',
                                    icon: 'error',
                                    text: results.message,
                                    timer: 1500
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
