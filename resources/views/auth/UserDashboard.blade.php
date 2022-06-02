@extends('frontend.layout.layout')
@section('content')
<div id="mainBody">
    <div class="container">
        <div class="row">
            <div id="sidebar" class="span3">
                <div class="well well-small"><a id="myCart" href="product_summary.html"><img src="{{ asset('frontend/themes/images/ico-cart.png') }}" alt="cart">3 Items in your cart <span class="badge badge-warning pull-right">$155.00</span></a></div>
                <ul class="nav nav-tabs nav-stacked">
                    <li class=" open"><a href="{{ route("user.dashboard") }}">My Account Detail</a></li>
                    <li class=" open"><a href="{{ route("user.orders") }}">My Orders</a></li>
                    <li class=" open"><a href="{{ route("user.shipping") }}">Shipping Detail</a></li>
                    <li class=" open"><a href="{{ route("user.logout") }}">Logout</a></li>
                </ul>
                <br />
            </div>
            <div class="span9">
                <ul class="breadcrumb">
                    <li><a href="{{ url("/") }}">Home</a> <span class="divider">/</span></li>
                    <li class="active">My Account</li>
                </ul>
                <h3> My Account</h3>
                <hr class="soft" />
                <div class="row">
                    <div class="span5">
                        <div class="well">
                            <h5>Profile Picture</h5>
                            @if(session("success"))
                                <div class="text-center">
                                    <strong>{{ session('success') }}</strong>
                                    <br>
                                </div>
                            @endif
                            <form action="{{ route("user.image") }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="control-group">
                                    @error('profile_picture')
                                    <h6 class="text-danger">{{ $message }}</h6>
                                    @enderror

                                    @if (Auth::user()->profile_picture)
                                    <div class="thumbnail">
                                        <img src="{{ asset(Auth::user()->profile_picture) }}">
                                    </div>
                                    @endif
                                    <label class="control-label" for="inputPassword1">Profile Picture</label>
                                    <div class="controls">
                                        <input type="file" name="profile_picture" class="span4" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" class="btn">Change Profile Picture</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="span5">
                        <div class="well">
                            <h5>Personal Information</h5>
                            @if(session("success"))
                                <div class="text-center">
                                    <strong>{{ session('success') }}</strong>
                                    <br>
                                </div>
                            @endif
                            <form action="{{ route("user.info") }}" method="post">
                                @csrf
                                <div class="control-group">
                                    @error('name')
                                    <h6 class="text-danger">{{ $message }}</h6>
                                    @enderror
                                    <label class="control-label" for="inputPassword1">Name</label>
                                    <div class="controls">
                                        <input type="text" name="name" class="span4" value="{{ Auth::user()->name }}" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    @error('Email')
                                    <h6 class="text-danger">{{ $message }}</h6>
                                    @enderror
                                    <label class="control-label" for="inputEmail1">Email</label>
                                    <div class="controls">
                                        <input class="span4" name="email" type="email" value="{{ Auth::user()->email }}" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" class="btn">Change Details</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="span5">
                        <div class="well">
                            <h5>Password Change</h5>
                            @if(session("success"))
                                <div class="text-center">
                                    <strong>{{ session('success') }}</strong>
                                    <br>
                                </div>
                            @endif
                            <form action="{{ route('user.Password') }}" method="post">
                                @csrf
                                <div class="control-group">
                                    @error('old_password')
                                    <h6 class="text-danger">{{ $message }}</h6>
                                    @enderror
                                    <label class="control-label">Old Password</label>
                                    <div class="controls">
                                        <input type="password" name="old_password" class="span4" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    @error('password')
                                    <h6 class="text-danger">{{ $message }}</h6>
                                    @enderror
                                    <label class="control-label">Password</label>
                                    <div class="controls">
                                        <input class="span4" name="password" type="password" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    @error('password_confirmation')
                                    <h6 class="text-danger">{{ $message }}</h6>
                                    @enderror
                                    <label class="control-label">Confirm Password</label>
                                    <div class="controls">
                                        <input class="span4" name="password_confirmation" type="password" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" class="btn">Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
