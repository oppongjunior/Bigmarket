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
                    <li class="active">My Orders</li>
                </ul>
                <h3> My Orders</h3>
                <hr class="soft" />
            </div>
        </div>
    </div>
</div>
@endsection
