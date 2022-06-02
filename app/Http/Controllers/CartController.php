<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function cartpage(){
        $categories = Category::all();
        return view("frontend.pages.cart",["categories"=>$categories]);
    }

    //cart add
    public function cartadd(Request $request){
        $cart = [];
        if(isset($_COOKIE['cart'])){
            $cart = $_COOKIE['cart'];
        }
        $product = Product::find($request->productId);
        //$cart =[$product];
        return response()->json([
            'status'=>200,
            'message'=>"success",
            'data'=>$cart
        ]);
    }
}
