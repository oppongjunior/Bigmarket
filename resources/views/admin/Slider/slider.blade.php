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
                        All Sliders
                        <a href="{{ route('add.slider') }}"><button class="btn btn-primary">Add Slider</button></a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="10%">ID</th>
                                        <th width="15%">Slider Title</th>
                                        <th width="15%">Slider image</th>
                                        <th width="15%">Slider description</th>
                                        <th width="15%">Slider type</th>
                                        <th width="15%">Created At</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $slider )
                                    <tr>
                                        <td>{{ $slider->id }}</td>
                                        <td>{{ $slider->title }}</td>
                                        <td><img src="{{ asset($slider->image) }}" alt="{{ $slider->image }}" class="img-thumbnail w-100"></td>
                                        <td>{{ $slider->description }}</td>
                                        <td>{{ $slider->type }}</td>
                                        <td>{{ $slider->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ url("slider/edit/".$slider->id) }}"><button class="btn btn-info mx-2">Edit</button></a>
                                                <a href="{{ url("slider/delete/".$slider->id) }}"><button class="btn btn-danger">Delete</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $sliders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
