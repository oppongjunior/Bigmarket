<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;

class SupplierController extends Controller
{
    //
    public function getSuppliers($id)
    {
        $users = Supplier::limit($id)->get();
        return $users;
    }
    //get products that belongs to supplier
    public function getProducts($id)
    {

        $myProduct =
        DB::table('products')
        ->join("categories", "categories.id", "=", "products.category_id")
        ->join("suppliers", "suppliers.id", "=", "products.supplier_id")
        ->join("special_categories", "special_categories.id", "=", "products.special_category_id")
        ->where("products.supplier_id",$id)
        ->get([
            "products.*", "suppliers.name as supplier_name",
            "categories.category_name",
            "special_categories.category_name as special_category_name"
        ]);
        return [
            "error"=>false,
            "myProducts"=>$myProduct
        ];
    }
    //login supplier
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => "required|email",
            'password' => "required",
        ], [
            "email" => "Invalid Email",
            "password" => "Please enter a password"
        ]);
        if ($validate->fails()) {
            return ["error" => true, "errorType" => "validation", "error" => $validate->errors(),];
        }
        if (Auth::guard("supplier")->attempt($request->all())) {
            $supplier = Supplier::where("email", "=", $request->email)->get();
            return ['error' => false, 'message' => "logged in", "supplier" => $supplier];
        }
        return ([
            "error" => true, 'message' => 'The provided credentials do not match our records.',
        ]);
    }

    //register supplier
    public function create(Request $request)
    {
        //validate supplier
        $validate = Validator::make($request->all(), [
            "name" => "required|min:3|max:255",
            "email" => "required|email|unique:suppliers,email|max:255",
            "password_confirmation" => "required",
            "password" => "required|min:8|max:16|confirmed",
        ]);

        if ($validate->fails()) {
            return ["error" => true, "errorType" => "validation", "error" => $validate->errors()];
        }

        //insert into supplier table
        $user = new Supplier();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->tel = "";
        $user->logo = "";
        $user->banner_image = "";
        $user->address = "";
        $user->verified = 0;
        $user->save();
        return [
            "error" => false,
            "message" => "Supplier registered successfully"
        ];
    }

    public function updateInfo(Request $request)
    {
        $id = $request->input('id');

        $validate = Validator::make($request->all(), [
            "name" => "required|min:3|max:255",
            "email" => "required|email|max:255|unique:suppliers,email,$id",
        ]);

        if ($validate->fails()) {
            return ["error" => true, "errorType" => "validation", "error" => $validate->errors()];
        }

        //insert into user table

        $user = Supplier::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        return [
            "error" => false,
            "message" => "user Info updated successfully"
        ];
    }

    //update name
    public function updateName(Request $request)
    {
        //validate user
        $id = $request->input('id');
        $validate = Validator::make($request->all(), [
            "name" => "required|min:3|max:255",
        ]);
        if ($validate->fails()) {
            return ["error" => true, "errorType" => "validation", "error" => $validate->errors()];
        }
        //insert into user table
        $supplier = Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->update();

        $supplier = Supplier::where("id", "=", $request->id)->get();
        return [
            "error" => false,
            "message" => "name updated successfully",
            "supplier" => $supplier,
        ];
    }

    //update email
    public function updateEmail(Request $request)
    {
        //validate user
        $id = $request->input('id');
        $validate = Validator::make($request->all(), [
            "email" => "required|email|max:255|unique:suppliers,email,$id",
        ]);
        if ($validate->fails()) {
            return ["error" => true, "errorType" => "validation", "error" => $validate->errors()];
        }
        //insert into user table
        $supplier = Supplier::find($id);
        $supplier->email = $request->email;
        $supplier->update();

        $supplier = Supplier::where("id", "=", $request->id)->get();
        return [
            "error" => false,
            "message" => "email updated successfully",
            "supplier" => $supplier,
        ];
    }
    //update tel
    public function updateTel(Request $request)
    {
        //validate user
        $id = $request->input('id');
        $validate = Validator::make($request->all(), [
            "tel" => "required|max:50",
        ]);
        if ($validate->fails()) {
            return ["error" => true, "errorType" => "validation", "error" => $validate->errors()];
        }
        //insert into user table
        $supplier = Supplier::find($id);
        $supplier->tel = $request->tel;
        $supplier->update();

        $supplier = Supplier::where("id", "=", $request->id)->get();
        return [
            "error" => false,
            "message" => "Tel updated successfully",
            "supplier" => $supplier,
        ];
    }
    //update image
    public function supplierImage(Request $request)
    {
        //validate user
        $id = $request->input('id');
        $validate = Validator::make($request->all(), [
            "banner_image" => 'required|mimes:png,jpg,jpeg|max:5000'
        ]);
        if ($validate->fails()) {
            return ["error" => true, "errorType" => "validation", "error" => $validate->errors()];
        }

        $image_file = $request->file("banner_image");
        $image_name = hexdec(uniqid());
        $image_ext = strtolower($image_file->getClientOriginalExtension());

        $image_name = $image_name . '.' . $image_ext;
        $location = "images/supplier_banners/";
        $saved_image = $location . $image_name;

        //upload image with image intervention
        Image::make($image_file)->resize(1200, 720)->save($saved_image);

        //insert into user table
        $supplier = Supplier::find($id);
        //delete previous image from folder
        if($supplier->banner_image != ""){
            unlink($supplier->banner_image);
        }
        $supplier->banner_image = $saved_image;
        $supplier->update();



        $supplier = Supplier::where("id", "=", $request->id)->get();
        return [
            "error" => false,
            "message" => "Image updated successfully",
            "supplier" => $supplier,
        ];
    }
    /*
    public function userPassword(Request $request)
    {
        //validate user
         //validate user
         $id = $request->input('id');

         $validate = Validator::make($request->all(), [
            "password_confirmation" => "required",
            "password" => "required|min:8|confirmed",
         ]);

         if ($validate->fails()) {
             return ["error" => true, "errorType" => "validation", "error" => $validate->errors()];
         }
        if ((Hash::check($request->old_password, Auth::user()->password))) {
            //update into password table
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->update();
            return redirect()->back()->with("success", "Password updated Successfully");
        }
        // The passwords matches
        return redirect()->back()->with("error", "Your current password does not matches with the password.");
    }
    */
}
