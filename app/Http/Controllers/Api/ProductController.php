<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Image;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAllProducts()
    {
        $products =
            DB::table('products')
            ->join("categories", "categories.id", "=", "products.category_id")
            ->join("suppliers", "suppliers.id", "=", "products.supplier_id")
            ->join("special_categories", "special_categories.id", "=", "products.special_category_id")
            ->get([
                "products.*", "suppliers.name as supplier_name",
                "categories.category_name",
                "special_categories.category_name as special_category_name"
            ]);

        return [
            "error" => false,
            "products" => $products,
        ];
    }
    public function getSingle($id)
    {
        $products =
            DB::table('products')
            ->join("categories", "categories.id", "=", "products.category_id")
            ->join("suppliers", "suppliers.id", "=", "products.supplier_id")
            ->join("special_categories", "special_categories.id", "=", "products.special_category_id")
            ->where("products.id", $id)
            ->get([
                "products.*", "suppliers.name as supplier_name",
                "categories.category_name",
                "special_categories.category_name as special_category_name"
            ]);

        return [
            "error" => false,
            "product" => $products,
        ];
    }

    //select all product from category
    public function getCategoryProducts($id)
    {
        $cateogry = "";
        $product = "";
        if ($id == "clothing") {
            $category = 1;
        }
        if ($id == "electronics") {
            $category = 2;
        }
        if ($id == "foods") {
            $category = 4;
        }
        if ($id == "health") {
            $category = 5;
        }
        if ($id == "books") {
            $category = 6;
        }
        if ($id == "furnitures") {
            $category = 7;
        }
        if ($id == "all") {
            $products =
                DB::table('products')
                ->join("categories", "categories.id", "=", "products.category_id")
                ->join("suppliers", "suppliers.id", "=", "products.supplier_id")
                ->join("special_categories", "special_categories.id", "=", "products.special_category_id")
                ->paginate(5, [
                    "products.*", "suppliers.name as supplier_name",
                    "categories.category_name",
                    "special_categories.category_name as special_category_name"
                ]);
        } else {
            $products =
                DB::table('products')
                ->join("categories", "categories.id", "=", "products.category_id")
                ->join("suppliers", "suppliers.id", "=", "products.supplier_id")
                ->join("special_categories", "special_categories.id", "=", "products.special_category_id")
                ->where("products.category_id", $category)
                ->paginate(5, [
                    "products.*", "suppliers.name as supplier_name",
                    "categories.category_name",
                    "special_categories.category_name as special_category_name"
                ]);
        }


        return [
            "error" => false,
            "products" => $products,
        ];
    }
    //select all product with special category
    public function getSpecialCategoryProducts($id)
    {
        $products =
            DB::table('products')
            ->join("categories", "categories.id", "=", "products.category_id")
            ->join("suppliers", "suppliers.id", "=", "products.supplier_id")
            ->join("special_categories", "special_categories.id", "=", "products.special_category_id")
            ->where("products.special_category_id", $id)
            ->get([
                "products.*", "suppliers.name as supplier_name",
                "categories.category_name",
                "special_categories.category_name as special_category_name"
            ]);
        return [
            "error" => false,
            "products" => $products,
        ];
    }

    public function index()
    {
        $products = Product::latest()->paginate(20);
        $trashed = Product::onlyTrashed()->paginate(20);
        $cateogry = Category::all();
        return view("admin.Products.products", ["products" => $products, "trashed" => $trashed, "category" => $cateogry]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255|min:1',
            'price' => 'required|max:255|numeric',
            'quantity' => 'required|max:255|numeric',
            'tags' => 'required|max:255',
            'description' => 'required|max:10000',
            'product_image' => 'required|mimes:png,jpg,jpeg|max:50000'
        ]);

        if ($validate->fails()) {
            return ["error" => true, "errorType" => "validation", "error" => $validate->errors(),];
        }

        $image_file = $request->file("product_image");
        $image_name = hexdec(uniqid());
        $image_ext = strtolower($image_file->getClientOriginalExtension());

        $image_name = $image_name . '.' . $image_ext;
        $location = "images/products/";
        $saved_image = $location . $image_name;


        //upload image with image intervention
        Image::make($image_file)->resize(750, 750)->save($saved_image);

        //insert
        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->tags = $request->input('tags');
        $product->description = $request->input('description');
        $product->supplier_id = $request->input("supplier_id");
        $product->product_image = $saved_image;
        $product->special_category_id = 1;
        $product->review = 0;
        $product->rating = 0;
        $product->verified = 0;
        $product->save();


        $myProduct =
            DB::table('products')
            ->join("categories", "categories.id", "=", "products.category_id")
            ->join("suppliers", "suppliers.id", "=", "products.supplier_id")
            ->join("special_categories", "special_categories.id", "=", "products.special_category_id")
            ->where("products.supplier_id", $request->input("supplier_id"))
            ->get([
                "products.*", "suppliers.name as supplier_name",
                "categories.category_name",
                "special_categories.category_name as special_category_name"
            ]);
        return ["error" => false, "errorType" => "validation", "message" => "Product Add Successfully", "myProducts" => $myProduct];
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255|min:1',
            'price' => 'required|max:255|numeric',
            'quantity' => 'required|max:255|numeric',
            'tags' => 'required|max:255',
            'description' => 'required|max:10000',
            'product_image' => 'mimes:png,jpg,jpeg|max:50000'
        ]);

        if ($validate->fails()) {
            return ["error" => true, "errorType" => "validation", "error" => $validate->errors(),];
        }

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
            Image::make($image_file)->resize(750, 750)->save($saved_image);


            //upload image
            //$image_file->move($location, $image_name);
            $new_image = $saved_image;
        }
        //insert
        $product = Product::find($request->input('id'));
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->tags = $request->input('tags');
        $product->description = $request->input('description');
        $product->supplier_id = $request->input("supplier_id");
        $product->product_image = $new_image;
        $product->save();

        $myProduct =
            DB::table('products')
            ->join("categories", "categories.id", "=", "products.category_id")
            ->join("suppliers", "suppliers.id", "=", "products.supplier_id")
            ->join("special_categories", "special_categories.id", "=", "products.special_category_id")
            ->where("products.supplier_id", $request->input("supplier_id"))
            ->get([
                "products.*", "suppliers.name as supplier_name",
                "categories.category_name",
                "special_categories.category_name as special_category_name"
            ]);
        return ["error" => false, "errorType" => "validation", "message" => "Product Add Successfully", "myProducts" => $myProduct];
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
