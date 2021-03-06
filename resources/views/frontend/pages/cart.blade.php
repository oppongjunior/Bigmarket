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
                    <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                    <li class="active"> SHOPPING CART</li>
                </ul>
                <h3> SHOPPING CART [ <small>3 Item(s) </small>]<a href="products.html" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>
                <hr class="soft" />
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Quantity/Update</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Tax</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <img width="60" src="themes/images/products/4.jpg" alt="" /></td>
                            <td>MASSA AST<br />Color : black, Material : metal</td>
                            <td>
                                <div class="input-append"><input class="span1" style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="text"><button class="btn" type="button"><i class="icon-minus"></i></button><button class="btn" type="button"><i class="icon-plus"></i></button><button class="btn btn-danger" type="button"><i class="icon-remove icon-white"></i></button> </div>
                            </td>
                            <td>$120.00</td>
                            <td>$25.00</td>
                            <td>$15.00</td>
                            <td>$110.00</td>
                        </tr>
                        <tr>
                            <td> <img width="60" src="themes/images/products/8.jpg" alt="" /></td>
                            <td>MASSA AST<br />Color : black, Material : metal</td>
                            <td>
                                <div class="input-append"><input class="span1" style="max-width:34px" placeholder="1" size="16" type="text"><button class="btn" type="button"><i class="icon-minus"></i></button><button class="btn" type="button"><i class="icon-plus"></i></button><button class="btn btn-danger" type="button"><i class="icon-remove icon-white"></i></button> </div>
                            </td>
                            <td>$7.00</td>
                            <td>--</td>
                            <td>$1.00</td>
                            <td>$8.00</td>
                        </tr>
                        <tr>
                            <td> <img width="60" src="themes/images/products/3.jpg" alt="" /></td>
                            <td>MASSA AST<br />Color : black, Material : metal</td>
                            <td>
                                <div class="input-append"><input class="span1" style="max-width:34px" placeholder="1" size="16" type="text"><button class="btn" type="button"><i class="icon-minus"></i></button><button class="btn" type="button"><i class="icon-plus"></i></button><button class="btn btn-danger" type="button"><i class="icon-remove icon-white"></i></button> </div>
                            </td>
                            <td>$120.00</td>
                            <td>$25.00</td>
                            <td>$15.00</td>
                            <td>$110.00</td>
                        </tr>

                        <tr>
                            <td colspan="6" style="text-align:right">Total Price: </td>
                            <td> $228.00</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align:right">Total Discount: </td>
                            <td> $50.00</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align:right">Total Tax: </td>
                            <td> $31.00</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align:right"><strong>TOTAL ($228 - $50 + $31) =</strong></td>
                            <td class="label label-important" style="display:block"> <strong> $155.00 </strong></td>
                        </tr>
                    </tbody>
                </table>
                <a href="products.html" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
                <a href="login.html" class="btn btn-large pull-right">Place Order <i class="icon-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
