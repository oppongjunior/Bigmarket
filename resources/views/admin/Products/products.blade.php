@extends('admin.admin_layout')

@section('content')
<div class="py-12">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>{{ session('success') }}</strong>
                </div>
                @endif

                <script>
                    var alertList = document.querySelectorAll('.alert');
                    alertList.forEach(function(alert) {
                        new bootstrap.Alert(alert)
                    })
                </script>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        All Services
                        <a href="{{ route('add.product') }}"><button class="btn btn-primary">Add Product</button></a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="10%">ID</th>
                                        <th width="15%">Name</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Tags</th>
                                        <th>Price</th>
                                        <th>Quantiy</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th width="30%">Image</th>
                                        <th width="15%">Created At</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item )
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name}}</td>
                                        <td>{{ $item->category->category_name}}</td>
                                        <td>{{ $item->brand->brand_name}}</td>
                                        <td>{{ $item->tags}}</td>
                                        <td>{{ $item->price}}</td>
                                        <td>{{ $item->quantity}}</td>
                                        <td>{{ $item->rating}}</td>
                                        <td>{{ $item->review}}</td>
                                        <td><img src="{{ asset($item->product_image) }}" alt="{{ $item->product_image }}" class="img-thumbnail w-100"></td>
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ url("product/edit/".$item->id) }}"><button class="btn btn-info mx-2">Edit</button></a>
                                                <a href="{{ url("product/softdelete/".$item->id) }}"><button class="btn btn-danger">Delete</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $products->links() }}
                        </div>
                    </div>
                    <div class="card my-5">
                        <div class="card-header">
                            Trash Category
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10%">ID</th>
                                            <th width="15%">Name</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Tags</th>
                                            <th>Price</th>
                                            <th>Quantiy</th>
                                            <th>Rating</th>
                                            <th>Review</th>
                                            <th width="30%">Image</th>
                                            <th width="15%">Created At</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trashed as $item )
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name}}</td>
                                            <td>{{ $item->category->category_name}}</td>
                                            <td>{{ $item->brand->brand_name}}</td>
                                            <td>{{ $item->tags}}</td>
                                            <td>{{ $item->price}}</td>
                                            <td>{{ $item->quantity}}</td>
                                            <td>{{ $item->rating}}</td>
                                            <td>{{ $item->review}}</td>
                                            <td><img src="{{ asset($item->product_image) }}" alt="{{ $item->product_image }}" class="img-thumbnail w-100"></td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ url("product/restore/".$item->id) }}"><button class="btn btn-warning">Restore</button></a>
                                                    <a href="{{ url("product/pdelete/".$item->id) }}"><button class="btn btn-danger">Delete</button></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $products->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
