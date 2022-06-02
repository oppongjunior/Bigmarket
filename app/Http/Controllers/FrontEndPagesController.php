<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontEndPagesController extends Controller
{
    //
    public function Home()
    {
        $categories = Category::all();
        $brands = [];
        $sliders = Slider::latest()->get();
        $latest_products = Product::latest()->paginate(12);
        $popular_products = Product::where("tags", "like", "popular")->get();
        return view("frontend.pages.home", [
            'brands' => $brands, 'sliders' => $sliders,
            'categories' => $categories,
            'latest_products' => $latest_products,
            'popular_products' => $popular_products,
        ]);
    }
    public function Product($id)
    {
        $categories = Category::all();
        $clients = [];
        $product = Product::find($id);
        return view("frontend.pages.details", [
            'brands' => $clients,
            'categories' => $categories,
            'product' => $product
        ]);
    }
    //sub category
    public function sub_category($id)
    {
        $categories = Category::all();
        $clients = [];
        $products =[];
        $name = [];
        return view("frontend.pages.products", [
            'brands' => $clients,
            'categories' => $categories,
            'products' => $products,
            'brand_name' => $name,
        ]);
    }
    public function search(Request $request)
    {
        $category = $request->category;
        $search = $request->search;

        $categories = Category::all();
        $clients = [];

        $products = [];
        if ($category == "all") {
            $products = Product::where("name", "like", "%%$search%%")
                ->orWhere("description", "like", "%%$search%%")
                ->get();
        } else {
            $products = Product::where("name", "like", "%%$search%%")
                ->where("category_id", "=", $category)
                ->orWhere("description", "like", "%%$search%%")
                ->where("category_id", "=", $category)
                ->get();
        }

        $name = "Result / search"; //Category::find($category)->category_name;
        return view("frontend.pages.products", [
            'brands' => $clients,
            'categories' => $categories,
            'products' => $products,
            'brand_name' => $name,
        ]);
    }
    
    //contact
    public function contact()
    {
        return view("frontend.pages.contact");
    }
}
