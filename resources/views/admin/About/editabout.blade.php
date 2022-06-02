@extends('admin.admin_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <h4 class="card-header">About Edit Form</h4>
                <div class="card-body">
                    <form action="{{ url('about/update/'.$about->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-1">
                            <label for="" class="form-label">Title</label>
                            @error("title")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <input type="text" name="title" value="{{ $about->title }}" required id="" class="form-control" placeholder="Enter about title" aria-describedby="helpId">
                            <br />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">About Image</label>
                            @error("image")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <input type="file" name="image" id="" class="form-control" aria-describedby="helpId">
                            <input type="hidden" name="old_image" value="{{ $about->image }}">
                            <br />
                            <img src="{{ asset($about->image) }}" alt="" class="img-thumbnail img-fluid">
                        </div>
                        <div class="mb-1">
                            <label for="" class="form-label">Short Description</label>
                            @error("short_description")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <textarea name="short_description" required class="form-control" id="description" rows="10" placeholder="Enter short Description">{{ $about->short_description }}</textarea>
                            <br />
                        </div>
                        <div class="mb-1">
                            <label for="" class="form-label">Long Description</label>
                            @error("long_description")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <textarea name="long_description" required class="form-control" id="description" rows="10" placeholder="Enter long Description">{{ $about->long_description }}</textarea>
                            <br />
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Edit About</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
