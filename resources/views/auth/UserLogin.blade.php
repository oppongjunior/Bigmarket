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
                            <h5>Login</h5>
                            <form action="{{ route("user.login") }}" method="post">
                                @csrf
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
                                    <div class="controls">
                                        <button type="submit" class="btn">Sign in</button>
                                        <hr>
                                        <a href="{{ route("user.register") }}">Create an Account</a>
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
