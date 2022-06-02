
@extends('admin.admin_layout')
@section('content')
<div class="py-12">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h4 class="card-header">Update Brand Form</h4>
                    <div class="card-body">
                        <form action="{{ url('category/update/'.$category->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label"></label>
                                @error("category_name")
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                                <input type="text" name="category_name" id="" class="form-control" placeholder="Enter category name" aria-describedby="helpId" value="{{ $category->category_name }}">
                                <br />
                                <button class="btn btn-primary btn-block" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
