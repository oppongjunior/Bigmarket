@extends('frontend.layout.layout')
@section('content')
<div id="mainBody">
    <div class="container">
        <div class="row">

            <!-- Sidebar ================================================== -->
            @include("frontend.layout.sidebar")

            <!-- Sidebar end=============================================== -->
            <div class="span9">
                <ul class="breadcrumb">
                    <li><a href="{{ url("/") }}">Home</a> <span class="divider">/</span></li>
                    <li class="active">{{ $brand_name }}</li>
                </ul>
                <h3> {{ count($products) == "0"? "No Product Found":"In Stock" }}<small class="pull-right"> {{ count($products) }} products are available </small></h3>
                <hr class="soft" />
                @if (count($products) != "0")
                <form class="form-horizontal span6">
                    <div class="control-group">
                        <label class="control-label alignL">Sort By </label>
                        <select>
                            <option>Priduct name A - Z</option>
                            <option>Priduct name Z - A</option>
                            <option>Priduct Stoke</option>
                            <option>Price Lowest first</option>
                        </select>
                    </div>
                </form>


                <div id="myTab" class="pull-right">
                    <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
                    <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
                </div>
                <br class="clr" />
                <div class="tab-content">
                    <div class="tab-pane" id="listView">
                        @foreach ($products as $item )
                        <div class="row">
                            <div class="span2">
                                <img src="{{ asset($item->product_image) }}" alt="" />
                            </div>
                            <div class="span4">
                                <h3>In Stock</h3>
                                <hr class="soft" />
                                <h5>{{ $item->name }} </h5>
                                <p>{{ Str::limit($item->description,200,$end="...") }}</p>
                                <a class="btn btn-small pull-right" href="{{ url("product/$item->id") }}">View Details</a>
                                <br class="clr" />
                            </div>
                            <div class="span3 alignR">
                                <form class="form-horizontal qtyFrm">
                                    <h3> $140.00</h3>
                                    <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                                </form>
                            </div>
                        </div>
                        <hr class="soft" />
                        @endforeach

                    </div>
                    <div class="tab-pane  active" id="blockView">
                        <ul class="thumbnails">
                            @foreach ($products as $item )
                            <li class="span3">
                                <div class="thumbnail">
                                    <a href="{{ url("product/$item->id") }}"><img src="{{ asset($item->product_image) }}" alt="" /></a>
                                    <div class=" caption">
                                        <h5>{{ $item->name }}</h5>
                                        <p>
                                            {{ Str::limit($item->description,200,$end="...") }}
                                        </p>
                                        <h4 style="text-align:center"><a class="btn" href="{{ url("product/$item->id") }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">&euro;{{ $item->price }}</a></h4>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                        <hr class="soft" />
                    </div>
                </div>
                <div class="pagination">
                    <ul>
                        <li><a href="#">&lsaquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">...</a></li>
                        <li><a href="#">&rsaquo;</a></li>
                    </ul>
                </div>
                <br class="clr" />
                @endif
               
            </div>
        </div>
    </div>
</div>
@endsection
