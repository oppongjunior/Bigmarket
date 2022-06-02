<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;
class UserController extends Controller
{
    //
    public function getUsers()
    {
        $users = User::all();
        return $users;
    }
    //login user
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
        if (Auth::attempt($request->all())) {
            $user = User::where("email", "=", $request->email)->get();
            return json_encode(["error" => false, 'message' => "logged in", "user" => $user]);
        }
        return ([
            "error" => true, 'message' => 'The provided credentials do not match our records.',
        ]);
    }

    //register user
    public function create(Request $request)
    {
        //validate user
        $validate = Validator::make($request->all(), [
            "name" => "required|min:3|max:255",
            "email" => "required|email|unique:users,email|max:255",
            "password_confirmation" => "required",
            "password" => "required|min:8|max:16|confirmed",
        ]);

        if ($validate->fails()) {
            return ["error" => true, "errorType" => "validation", "error" => $validate->errors()];
        }

        //insert into user table
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->tel = "";
        $user->profile_picture = "";
        $user->address = "";
        $user->verified = 0;
        $user->save();
        Auth::login($user);
        return [
            "error" => false,
            "message" => "user registered successfully"
        ];
    }

    public function updateInfo(Request $request)
    {
        //validate user
        $id = $request->input('id');
        $validate = Validator::make($request->all(), [
            "name" => "required|min:3|max:255",
            "email" => "required|email|max:255|unique:users,email,$id",
        ]);
        if ($validate->fails()) {
            return ["error" => true, "errorType" => "validation", "error" => $validate->errors()];
        }
        //insert into user table
        $user = User::find($id);
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->update();

        $user = User::where("id", "=", $request->id)->get();
        return [
            "error" => false,
            "message" => "name updated successfully",
            "user" => $user,
        ];
    }

    //update email
    public function updateEmail(Request $request)
    {
        //validate user
        $id = $request->input('id');
        $validate = Validator::make($request->all(), [
            "email" => "required|email|max:255|unique:users,email,$id",
        ]);
        if ($validate->fails()) {
            return ["error" => true, "errorType" => "validation", "error" => $validate->errors()];
        }
        //insert into user table
        $user = User::find($id);
        $user->email = $request->email;
        $user->update();

        $user = User::where("id", "=", $request->id)->get();
        return [
            "error" => false,
            "message" => "email updated successfully",
            "user" => $user,
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
        $user = User::find($id);
        $user->tel = $request->tel;
        $user->update();

        $user = User::where("id", "=", $request->id)->get();
        return [
            "error" => false,
            "message" => "Tel updated successfully",
            "user" => $user,
        ];
    }
    //update image
    public function userImage(Request $request)
    {
        //validate user
        $id = $request->input('id');
        $validate = Validator::make($request->all(), [
            "profile_picture" => 'required|mimes:png,jpg,jpeg'
        ]);
        if ($validate->fails()) {
            return ["error" => true, "errorType" => "validation", "error" => $validate->errors()];
        }

        $image_file = $request->file("profile_picture");
        $image_name = hexdec(uniqid());
        $image_ext = strtolower($image_file->getClientOriginalExtension());

        $image_name = $image_name . '.' . $image_ext;
        $location = "images/users/";
        $saved_image = $location . $image_name;


        //upload image with image intervention
        Image::make($image_file)->resize(750, 750)->save($saved_image);

        //insert into user table
        $user = User::find($id);
        //delete previous image from folder
        unlink($user->profile_picture);
        $user->profile_picture = $saved_image;
        $user->update();



        $user = User::where("id", "=", $request->id)->get();
        return [
            "error" => false,
            "message" => "Image updated successfully",
            "user" => $user,
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
