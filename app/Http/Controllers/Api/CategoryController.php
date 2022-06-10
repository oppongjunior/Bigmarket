<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAll()
    {
        $category = Category::all();

        return [
            "error" => false,
            "categories" => $category
        ];
    }
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category();
        $category->category_name = $request->input("category_name");
        $category->save();

        return redirect()->back()->with("success", "category inserted successfully");
    }

    //edit category
    public function edit($id)
    {
        $category = Category::find($id);
        return view("admin.category.edit", ['category' => $category]);
    }

    //update category
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        $category = Category::find($id);
        $category->category_name = $request->input("category_name");
        $category->save();
        return redirect("category/all")->with("success", "update successfully");
    }

    //delete category
    public function softDelete($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->back()->with("success", "Category deleted successfully");
    }
    //restore category
    public function restore($id)
    {
        Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with("success", "trash item restored successfully");
    }

    //permanent delete
    public function P_Delete($id)
    {
        Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with("success", "trash item permanently deleted successfully");
    }
}
