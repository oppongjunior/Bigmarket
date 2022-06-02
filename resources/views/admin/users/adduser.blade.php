@extends('admin.admin_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-5">
                    <h4 class="text-dark mb-5">Add user </h4>
                    <x-jet-validation-errors class="mb-4 text-danger" />

                    @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('store.user') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 mb-4">
                                <input type="text" name="name" required autofocus autocomplete="name" class="form-control input-lg" id="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-12 mb-4">
                                <input type="email" name="email" required class="form-control input-lg" id="email" placeholder="Email">
                            </div>
                            <div class="form-group col-md-12 ">
                                <input type="password" name="password" required autocomplete="new-password" class="form-control input-lg" id="password" placeholder="Password">
                            </div>
                            <div class="form-group col-md-12 ">
                                <input type="password" name="password_confirmation" required autocomplete="new-password" class="form-control input-lg" id="cpassword" placeholder="Confirm Password">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Add user</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
