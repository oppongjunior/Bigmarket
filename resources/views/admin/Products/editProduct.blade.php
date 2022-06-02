@extends('admin.admin_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <h4 class="card-header">Product Edit Form</h4>
                <div class="card-body">
                    <form action="{{ url('product/update/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-1">
                            <label for="" class="form-label">Name</label>
                            @error("name")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <input type="text" name="name" value="{{ $product->name }}" required id="" class="form-control" placeholder="Enter Name" aria-describedby="helpId">
                            <br />
                        </div>
                        <div class="mb-1">
                            <label for="" class="form-label">Price</label>
                            @error("price")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <input type="text" name="price" value="{{ $product->price }}" required id="" class="form-control" placeholder="Enter Price" aria-describedby="helpId">
                            <br />
                        </div>

                        <div class="mb-1">
                            <label for="name" class="form-label">Quantity</label>
                            @error("quantity")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <input type="text" name="quantity" required id="" value="{{ $product->quantity }}" class="form-control" placeholder="Product quantity" aria-describedby="helpId">
                            <br />
                        </div>

                        <div class="mb-1">
                            <label for="name" class="form-label">Tags</label>
                            @error("tags")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <input type="text" name="tags" required id="" value="{{ $product->tags }}" class="form-control" placeholder="Product tags" aria-describedby="helpId">
                            <br />
                        </div>

                        <div class="form-group">
                            @error("category")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <label for="">Category</label>
                            <select class="form-control btn btn-primary text-left" name="category_id" id="category">
                                <option value="{{ $product->category_id }}">{{$product->category->category_name}}</option>
                                @foreach($category as $item)
                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            @error("brand")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <label for="">Brand</label>
                            <select class="form-control btn btn-primary text-left" name="brand_id" id="brand">
                                <option value="{{ $product->brand_id }}">{{ $product->brand->brand_name }}</option>
                                @foreach($brand as $item)
                                <option value="{{ $item->id }}">{{ $item->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Product Image</label>
                            @error("product_image")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <input type="file" name="product_image" id="" class="form-control" aria-describedby="helpId">
                            <input type="hidden" name="old_image" value="{{ $product->product_image }}">
                            <br />
                            <img src="{{ asset($product->product_image) }}" alt="" class="img-thumbnail img-fluid">
                        </div>
                        <div class="mb-1">
                            <label for="" class="form-label">Description</label>
                            @error("description")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <textarea name="description" required class="form-control" id="description" rows="10" placeholder="Enter Description">{{ $product->description }}</textarea>
                            <br />
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Edit Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
