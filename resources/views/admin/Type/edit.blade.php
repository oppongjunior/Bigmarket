@extends('admin.admin_layout')
@section('content')
<div class="py-12">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h4 class="card-header">Update Type Form</h4>
                    <div class="card-body">
                        <form action="{{ url('type/update/'.$type->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-1">
                                <label for="" class="form-label"></label>
                                @error("type")
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                                <input type="text" name="type_name" id="" class="form-control" value="{{ $type->type_name }}" placeholder="Enter Type name" aria-describedby="helpId">
                                <br />
                            </div>
                            <div class="form-group">
                                @error("category")
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                                <label for="">Category</label>
                                <select class="form-control" name="category" id="category">
                                    <option value={{ $type->category_id }}>{{ $type->category->category_name }}</option>
                                    @foreach($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">Update Type</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
