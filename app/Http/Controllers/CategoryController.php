<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //contructor function to activate the authentication middle ware for this class
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    //
    public function index(){
        $categories = Category::latest()->paginate(5);
        $trashed = Category::onlyTrashed()->paginate(5);
        return view("admin.category.index",["categories"=>$categories,"trashed"=>$trashed]);
    }
    //add category
    public function store(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category();
        $category->category_name = $request->input("category_name");
        $category->save();

        return redirect()->back()->with("success","category inserted successfully");
    }
     
    //edit category
    public function edit($id){
        $category = Category::find($id);
        return view("admin.category.edit",['category'=>$category]);
    }

    //update category
    public function update(Request $request, $id){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        $category = Category::find($id);
        $category->category_name = $request->input("category_name");
        $category->save();
        return redirect("category/all")->with("success","update successfully");
    }

    //delete category
    public function softDelete($id){
        $category = Category::find($id);
        $category->delete();

        return redirect()->back()->with("success", "Category deleted successfully");
    }
      //restore category
      public function restore($id){
        Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with("success", "trash item restored successfully");
    }

    //permanent delete
    public function P_Delete($id){
        Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with("success", "trash item permanently deleted successfully");
    }
}
