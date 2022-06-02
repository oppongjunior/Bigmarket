@extends('frontend.layout.layout')
@section('content')
<div id="mainBody">
    <div class="container">
        <div class="row">
            <div class="span12">
                <ul class="breadcrumb">
                    <li><a href="{{ url("/") }}">Home</a> <span class="divider">/</span></li>
                    <li class="active">Login</li>
                </ul>
                <h3> Login</h3>
                <hr class="soft" />

                <div class="row">
                    <div class="span4"> &nbsp;</div>
                    <div class="span5">
                        <div class="well">
                            <h5>Create Account</h5>
                            <form action="{{ route("user.register") }}" method="post">
                                @csrf
                                <div class="control-group">
                                    @error('name')
                                        <h6 class="text-danger">{{ $message }}</h6>
                                    @enderror
                                    <label class="control-label" for="inputEmail1">Name</label>
                                    <div class="controls">
                                        <input class="span4" name="name" type="name" id="inputEmail1" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    @error('email')
                                        <h6 class="text-danger">{{ $message }}</h6>
                                    @enderror
                                    <label class="control-label" for="inputEmail1">Email</label>
                                    <div class="controls">
                                        <input class="span4" name="email" type="email" id="inputEmail1" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputPassword1">Password</label>
                                    <div class="controls">
                                        <input type="password" name="password" class="span4" id="inputPassword1" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputPassword1">Confirm</label>
                                    <div class="controls">
                                        <input type="password" name="password_confirmation" class="span4" id="inputPassword1" placeholder="Repeat Password" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" class="btn">CREATE ACCOUNT</button>
                                        <hr>
                                        <a href="{{ route("user.register") }}">Login</a>
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
