<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    //
    public function getSuppliers()
    {
        $users = Supplier::all();
        return $users;
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
