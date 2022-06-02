<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="{{ route("all.cart")}}"><img src="{{ asset('frontend/themes/images/ico-cart.png') }}" alt="cart">3 Items in your cart <span class="badge badge-warning pull-right">$155.00</span></a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        @foreach($categories as $key => $category)
        <li class="subMenu  {{ $key === 0? 'open':'' }}"><a> {{ $category->category_name}} [{{ count($category->product) }}]</a>
            <ul style="{{ $key === 0? '':'display:none' }}">
                @foreach ($category->brand as $key=> $brand )
                <li><a class="{{ $key === 0? 'active':'' }}" href="{{ url("/sub-category/$brand->id") }}"><i class="icon-chevron-right"></i>{{ $brand->brand_name }} ({{ count($brand->product) }}) </a></li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
    <br />

    <div class="thumbnail">
        <img src="{{ asset("frontend/themes/images/payment_methods.png") }}" title="Bootshop Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>
