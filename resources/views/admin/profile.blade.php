@extends('admin.admin_layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row border-muted border py-5">
            <div class="col-md-4">
                <h5>Profile Picture</h5>
                <p>Update Profile Picture</p>
            </div>
            <div class="col-md-4">
                @if (session("success"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>{{ session("success") }}</strong>
                </div>
                @endif
                <form action="{{ url("update/adminImage") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="text-center">
                            @if (Auth::guard("admin")->user()->profile_picture)
                            <img src="{{ asset(Auth::guard("admin")->user()->profile_picture)  }}" class="user-image img-fluid img-thumbnail" alt="User Image" />
                            @else
                            <h1 class="text-center">{{ Str::upper(Str::limit(Auth::guard("admin")->user()->name,2,$end="")) }}</h1>
                            @endif
                        </div>
                        <br />
                        @error("profile_picture")
                        <div class="alert" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                        <input type="file" name="profile_picture" id="" class="form-control" required>
                    </div>
                    <div class="">
                        <button class="btn btn-dark" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="row border-muted border py-5">
            <div class="col-md-4">
                <h5>Personal Information</h5>
                <p>Update your personal information</p>
            </div>
            <div class="col-md-4">
                <form action="{{ url("update/adminInfo") }}" method="post">
                    @csrf
                    <div class="form-group">
                        <h6>Account name </h6>
                        <br />
                        <input type="text" name="name" id="" class="form-control" placeholder="" value="{{ Auth::guard("admin")->user()->name }}" required>
                    </div>

                    <div class="form-group">
                        <h6>Email </h6>
                        <br />
                        <input type="text" name="email" id="" class="form-control" placeholder="" value="{{ Auth::guard("admin")->user()->email }}" required>
                    </div>
                    <div class="">
                        <button class="btn btn-dark" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="row border-muted border py-5 my-5">
            <div class="col-md-4">
                <h5>Password</h5>
                <p>Change Password</p>
            </div>
            <div class="col-md-4">
                @if (session("success"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>{{ session("success") }}</strong>
                </div>
                @endif
                @if (session("error"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>{{ session("error") }}</strong>
                </div>
                @endif
                <form action="{{ url("update/adminPassword") }}" method="post">
                    @csrf
                    <div class="form-group">
                        <h6>Old Password</h6>
                        <br />

                        @error("old_password")
                        <div class="alert" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                        <input type="password" name="old_password" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <h6>New Password</h6>
                        <br />
                        @error("password")
                        <div class="alert" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                        <input type="password" name="password" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <h6>Confirm Password </h6>
                        <br />
                        @error("password_confirmation")
                        <div class="alert" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                        <input type="password" name="password_confirmation" id="" class="form-control">
                    </div>
                    <div class="">
                        <button class="btn btn-dark" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
