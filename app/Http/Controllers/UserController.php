<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    //
    public function register()
    {
        if (Auth::check()) {
            return redirect()->intended("user/dashboard");
        }
        $categories = Category::all();
        return view("auth.UserRegister", ['categories' => $categories]);
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->tel = "";
        $user->address = "";
        $user->verified = 0;
        $user->profile_picture = "";
        $user->save();
        Auth::login($user);
        return redirect("user/dashboard");
    }

    //login view
    public function CreateLogin()
    {
        if (Auth::check()) {
            return redirect()->intended("user/dashboard");
        }
        $categories = Category::all();
        return view("auth.UserLogin", ["categories" => $categories]);
    }

    //login user
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);



        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            return redirect()->intended('user/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard()
    {
        $categories = Category::all();
        return view("auth.UserDashboard", ['categories' => $categories]);
    }
    public function orders()
    {
        $categories = Category::all();
        return view("frontend.pages.orders", ['categories' => $categories]);
    }
    public function shipping()
    {
        $categories = Category::all();
        return view("frontend.pages.shipping", ['categories' => $categories]);
    }


    public function updateInfo(Request $request)
    {
        //validate user
        $id = Auth::user()->id;
        $request->validate([
            "name" => "required|min:3|max:255",
            "email" => "required|email|max:255|unique:users,email,$id",
        ]);

        //insert into user table
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();

        $request->session()->regenerate();
        return redirect()->back()->with("success", "Person information updated");
    }

    public function userPassword(Request $request)
    {
        //validate user
        $request->validate([
            "password_confirmation" => "required",
            "password" => "required|min:8|confirmed",
        ]);
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

    public function userImage(Request $request)
    {
        //validate user
        $request->validate([
            "profile_picture" => "required|mimes:png,jpg,jpeg|max:5000",
        ]);

        $image_file = $request->file("profile_picture");
        $image_name = hexdec(uniqid());
        $image_ext = strtolower($image_file->getClientOriginalExtension());

        $image_name = $image_name . '.' . $image_ext;
        $location = "images/profile_images/";
        $saved_image = $location . $image_name;



        //delete the previous profile image
        if (Auth::user()->profile_picture) {
            unlink(Auth::user()->profile_picture);
        }
        //upload image with image intervention
        Image::make($image_file)->resize(200, 200)->save($saved_image);
        //update into password table
        $user = User::find(Auth::user()->id);
        $user->profile_picture = $saved_image;
        $user->update();
        return redirect()->back()->with("success", "Profile Image updated successfully");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->intended("/user/login");
    }
}
