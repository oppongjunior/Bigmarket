<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function getCart($user_id)
    {
        $user_cart =  DB::table("carts")
            ->join("products", "carts.product_id", "=", "products.id")
            ->where("carts.user_id", "=", $user_id)
            ->get([
                "products.*",
                "carts.quantity"
            ]);

        return [
            "error" => false,
            "message" => "successfully",
            "myCart" => $user_cart,
        ];
    }
    public function addToCart(Request $request)
    {
        $user_id = $request->input("user_id");
        $product_id = $request->input("product_id");
        $quantity = $request->input("quantity");
        $cart = new Cart();
        $cart->user_id = $user_id;
        $cart->product_id = $product_id;
        $cart->quantity = $quantity;
        $cart->save();
        $user_cart =  DB::table("carts")
            ->join("products", "carts.product_id", "=", "products.id")
            ->where("carts.user_id", "=", $user_id)
            ->get([
                "products.*",
                "carts.quantity"
            ]);

        return [
            "error" => false,
            "message" => "successfully",
            "myCart" => $user_cart,
        ];
    }
    public function removeCart(Request $request)
    {
        $user_id = $request->input("user_id");
        $product_id = $request->input("product_id");
        DB::delete('delete from carts where user_id = ? and product_id = ?', [$user_id, $product_id]);
        $user_cart =  DB::table("carts")
            ->join("products", "carts.product_id", "=", "products.id")
            ->where("carts.user_id", "=", $user_id)
            ->get([
                "products.*",
                "carts.quantity"
            ]);

        return [
            "error" => false,
            "message" => "successfully",
            "myCart" => $user_cart,
        ];
    }
    public function modifyCart(Request $request)
    {
        $user_id = $request->input("user_id");
        $product_id = $request->input("product_id");
        $quantity = $request->input("quantity");
        DB::update('update carts set quantity = ? where user_id = ? and product_id = ?', [$quantity, $user_id, $product_id]);
        $user_cart =  DB::table("carts")
            ->join("products", "carts.product_id", "=", "products.id")
            ->where("carts.user_id", "=", $user_id)
            ->get([
                "products.*",
                "carts.quantity"
            ]);

        return [
            "error" => false,
            "message" => "successfully",
            "myCart" => $user_cart,
        ];
    }
}
