@extends('admin.layout.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Room</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.room.update',['id'=>$room->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                value="{{ $room->name }}" placeholder="Enter name">
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
                            <label for="price">Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $room->price }}"
                                placeholder="Enter price">
                        </div>
                        @error('price')
                            <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
                                <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label for="">Category {{$room->category_id}}</label>
                            <select name="category_id" class="form-control" id="">
                                @foreach ($categories as $category)
                                    <option {{ $category->id == $room->category_id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name  }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-4 control-label">Image</label>
                            <div class="col-md-9 col-sm-8">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <img id="image_preview"
                                            src="{{ $room->image ? Storage::url($room->image): asset('bower_components/template-admin/dist/img/photo2.png') }}"
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
                        <textarea id="summernote" name="description" >{{ $room->description }}</textarea>
                        @error('description')
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
     <!-- Summernote -->
  <script src="{{ asset('bower_components/template-admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
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
        $('#summernote').summernote({
            placeholder: 'Enter content....',
            tabsize: 2,
            height: 200,
            minHeight: 100,
            maxHeight: 300,
        });
    </script>
@endsection
