<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Image;


class ProductController extends Controller
{
    //
    //contructor function to activate the authentication middle ware for this class
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(20);
        $trashed = Product::onlyTrashed()->paginate(20);
        $cateogry = Category::all();
        return view("admin.Products.products", ["products" => $products, "trashed" => $trashed, "category" => $cateogry]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cateogries = Category::all();
        $brand = Brand::all();
        return view('admin.Products.addProduct', ["category" => $cateogries, "brand" => $brand,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|max:255|numeric',
            'quantity' => 'required|max:255|numeric',
            'tags' => 'required|max:255',
            'description' => 'required|max:10000',
            'product_image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $image_file = $request->file("product_image");
        $image_name = hexdec(uniqid());
        $image_ext = strtolower($image_file->getClientOriginalExtension());

        $image_name = $image_name . '.' . $image_ext;
        $location = "images/products/";
        $saved_image = $location . $image_name;


        //upload image with image intervention
        Image::make($image_file)->resize(600, 400)->save($saved_image);

        //insert
        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->tags = $request->input('tags');
        $product->description = $request->input('description');
        $product->review = 0;
        $product->rating = 0;
        $product->product_image = $saved_image;
        $product->save();
        return redirect('product/all')->with("success", "Product added successfully");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::find($id);
        $cateogries = Category::all();
        $brand = Brand::all();
        return view("admin.Products.editProduct", ['product' => $product, "category" => $cateogries,"brand"=>$brand,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|max:255|numeric',
            'quantity' => 'required|max:255|numeric',
            'tags' => 'required|max:255',
            'description' => 'required|max:10000',
            'product_image' => 'mimes:png,jpg,jpeg'
        ]);

        $new_image = $request->input('old_image');
        if ($request->file('product_image')) {
            $image_file = $request->file("product_image");
            $image_name = hexdec(uniqid());
            $image_ext = strtolower($image_file->getClientOriginalExtension());

            $image_name = $image_name . '.' . $image_ext;
            $location = "images/products/";
            $saved_image = $location . $image_name;
            unlink($request->input('old_image'));

            //upload image with image intervention
            Image::make($image_file)->resize(600, 400)->save($saved_image);


            //upload image
            //$image_file->move($location, $image_name);
            $new_image = $saved_image;
        }

        //insert
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->tags = $request->input('tags');
        $product->description = $request->input('description');
        $product->product_image = $new_image;
        $product->save();

        return redirect('product/all')->with("success", "Product updated successfully");
    }

    //delete to trash
    public function softDelete($id)
    {
        Product::find($id)->delete();
        return redirect('product/all')->with("success", "Product deleted successfully");
    }
    //restore
    public function restore($id)
    {
        Product::withTrashed()->find($id)->restore();
        return redirect('product/all')->with("success", "Product restored successfully");
    }

    /**
     * Remove the specified resource from storage.
     * complete remove image from trash
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $product = Product::withTrashed()->find($id);
        $product_image = $product->product_image;
        unlink($product_image);

        Product::onlyTrashed()->find($id)->forceDelete();
        return redirect('product/all')->with("success", "Product deleted successfully");
    }
    
}
