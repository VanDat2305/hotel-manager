@extends('admin.layout.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $user->email }}"
                                placeholder="Enter email">
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
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ $user->name }}" placeholder="Enter name">
                        </div>
                        @error('name')
                            <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
                                <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label for="Phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="Phone"
                                value="{{ $user->phone }}" placeholder="Enter Phone">
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
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password">
                        </div>
                        @error('password')
                            <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
                                <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label for="password">Confirm password</label>
                            <input type="password" class="form-control" name="re-password" id="password"
                                placeholder="Password">
                        </div>
                        @error('re-password')
                            <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
                                <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                {{ $message }}
                            </div>
                        @enderror
                       <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Status</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="status" value="1"
                                        {{ $user->status == config('custom.user_status_text.active') ? 'checked' : '' }}
                                        id="checkbox">
                                    <label class="form-check-label" for="checkbox">Active</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">IsAdmin</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="role_id" value="1"
                                        {{ $user->role_id == config('custom.user_roles.admin') ? 'checked' : '' }}
                                        id="checkbox">
                                    <label class="form-check-label" for="checkbox">Active</label>
                                </div>
                            </div>
                        </div>
                       </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-4 control-label">Image</label>
                            <div class="col-md-9 col-sm-8">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <img id="image_preview"
                                            src="{{ $user->image ? Storage::url($user->image) : asset('bower_components/template-admin/dist/img/avatar.png') }}"
                                            alt="your image" style="max-width: 200px; height:100px; margin-bottom: 10px;"
                                            class="img-fluid" />
                                        <input type="file" name="image" accept="image/*"
                                            class="form-control-file @error('image') is-invalid @enderror" id="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('image')
                            <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
                                <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @parent
    <script>
        $(function() {
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        $(selector).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function() {
                readURL(this, '#image_preview');
            });

        });
    </script>
@endsection
