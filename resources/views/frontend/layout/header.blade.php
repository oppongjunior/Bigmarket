<div id="header">
    <div class="container">
        <div id="welcomeLine" class="row">
            @if(Auth::check())
            <div class="span6">Welcome!<strong> {{ Auth::user()->name }}</strong></div>
            @else
            <div class="span6">Welcome!<strong> Guest</strong></div>
            @endif

            <div class="span6">
                <div class="pull-right">
                    <span class="btn btn-mini">$155.00</span>
                    <a href="product_summary.html"><span class="">$</span></a>
                    <a href="product_summary.html"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ 3 ] Itemes in your cart </span> </a>
                </div>
            </div>
        </div>
        <!-- Navbar ================================================== -->
        <div id="logoArea" class="navbar">
            <a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-inner">
                <a class="brand" href="{{ url("/") }}"><img src="{{ asset('frontend/themes/images/logo.png') }}" alt="Bootsshop" /></a>
                <form class="form-inline navbar-search" method="post" action="{{ url("search/product") }}">
                    @csrf
                    <input id="srchFld" name="search" class="srchTxt" type="text" />
                    <select class="srchTxt" name="category">
                        <option value="all">All</option>
                        @foreach ($categories as $category)
                        <option class="text-uppercase" value="{{ $category->id }}">{{ $category->category_name }} </option>
                        @endforeach
                    </select>
                    <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
                </form>
                <ul id="topMenu" class="nav pull-right">
                    <li class=""><a href="special_offer.html">Specials Offer</a></li>
                    <li class=""><a href="normal.html">Delivery</a></li>
                    <li class=""><a href="contact.html">Contact</a></li>
                    <li class="">
                        @if (Auth::check())
                        <a href="{{ route("user.dashboard") }}" style="padding-right:0"><span class="btn btn-large btn-success">Profile</span></a>
                        @else
                        <a href="{{ route("user.login") }}" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
