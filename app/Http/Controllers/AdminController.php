<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
class AdminController extends Controller
{
    //
    //
    public function register()
    {
        if (Auth::guard("admin")->check()) {
            return redirect()->intended("admin/dashboard");
        }
        return view("auth.AdminRegister");
    }
    public function create(Request $request)
    {
        //validate user
        $request->validate([
            "name" => "required|min:3|max:255",
            "email" => "required|email|unique:users,email|max:255",
            "password_confirmation" => "required",
            "password" => "required|min:8|max:16|confirmed",

        ]);


        //insert into user table
        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->profile_picture = "";
        $user->save();

        return redirect("admin/login");
    }

    //login view
    public function CreateAdmin()
    {
        if (Auth::guard("admin")->check()) {
            return redirect()->intended("admin/dashboard");
        }
        return view("auth.adminLogin");
    }

    //login user
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard("admin")->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard()
    {
        $slider = Slider::all();
        $users = User::all();
        return view("admin.index", ["users" => $users, 'sliders' => $slider]);
    }
    public function profile()
    {
        return view("admin.profile");
    }

    public function updateInfo(Request $request)
    {
        //validate user
        $request->validate([
            "name" => "required|min:3|max:255",
            "email" => "required|email|unique:users,email|max:255",
        ]);
        //insert into user table
        $user = Admin::find(Auth::guard("admin")->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();

        $request->session()->regenerate();
        return redirect("admin/profile");
    }

    public function adminPassword(Request $request)
    {
        //validate user
        $request->validate([
            "password_confirmation" => "required",
            "password" => "required|min:8|confirmed",
        ]);
        if ((Hash::check($request->old_password, Auth::guard("admin")->user()->password))) {
            //update into password table
            $user = Admin::find(Auth::guard("admin")->user()->id);
            $user->password = Hash::make($request->password);
            $user->update();
            return redirect()->back()->with("success", "Password updated Successfully");
        }
        // The passwords matches
        return redirect()->back()->with("error", "Your current password does not matches with the password.");
    }

    public function adminImage(Request $request)
    {
        //validate user
        $request->validate([
            "profile_picture" => "required|mimes:png,jpg,jpeg",
        ]);

        $image_file = $request->file("profile_picture");
        $image_name = hexdec(uniqid());
        $image_ext = strtolower($image_file->getClientOriginalExtension());

        $image_name = $image_name . '.' . $image_ext;
        $location = "images/profile_images/";
        $saved_image = $location . $image_name;


        //upload image with image intervention
        Image::make($image_file)->resize(200, 200)->save($saved_image);
        //delete the previous profile image
        if (Auth::guard("admin")->user()->profile_picture) {
            unlink(Auth::guard("admin")->user()->profile_picture);
        }

        //update into password table
        $user = Admin::find(Auth::guard("admin")->user()->id);
        $user->profile_picture = $saved_image;
        $user->update();
        return redirect()->back()->with("success", "Profile Image updated successfully");
    }

    public function logout()
    {
        Auth::guard("admin")->logout();
        return redirect()->intended("/admin/login");
    }
}
