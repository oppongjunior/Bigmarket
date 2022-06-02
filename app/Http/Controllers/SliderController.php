<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Image;

class SliderController extends Controller
{
    ///contructor function to activate the authentication middle ware for this class
    public function __construct(){
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $sliders = Slider::latest()->paginate(5);
        return view('admin.Slider.slider',["sliders" => $sliders]);
    }

    //create slider
    public function create(){
        return view('admin.Slider.addslider');
    }


    //store slider
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'type' => 'required|max:255',
            'description' => 'required|max:10000',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $image_file = $request->file("image");
        $image_name = hexdec(uniqid());
        $image_ext = strtolower($image_file->getClientOriginalExtension());

        $image_name = $image_name . '.' . $image_ext;
        $location = "images/slider/";
        $saved_image = $location . $image_name;


        //upload image with image intervention
        Image::make($image_file)->resize(1170, 480)->save($saved_image);


        //upload image
        //$image_file->move($location, $image_name);


        //insert
        $slider = new Slider();
        $slider->title = $request->input('title');
        $slider->description = $request->input('description');
        $slider->type = $request->input('type');
        $slider->image = $saved_image;
        $slider->save();

        return redirect('slider/all')->with("success", "Slider inserted successfully");
    }

    public function edit($id){
        $slider = Slider::find($id);
        return view("admin.Slider.editslider",['slider'=>$slider]);
    }
    public function update(Request $request, $id){
        $validate = $request->validate([
            'title' => 'required|max:255',
            'type' => 'required|max:255',
            'description' => 'required|max:10000',
            'image' => 'mimes:png,jpg,jpeg'
        ]);

        $new_image = $request->input('old_image');
        if ($request->file('image')) {
            $image_file = $request->file("image");
            $image_name = hexdec(uniqid());
            $image_ext = strtolower($image_file->getClientOriginalExtension());

            $image_name = $image_name . '.' . $image_ext;
            $location = "images/slider/";
            $saved_image = $location . $image_name;
            unlink($request->input('old_image'));

            //upload image with image intervention
            Image::make($image_file)->resize(1170, 480)->save($saved_image);

            $new_image = $saved_image;
        }

        $slider = Slider::find($id);
        $slider->title = $request->input('title');
        $slider->description = $request->input('description');
        $slider->type = $request->input('type');
        $slider->image = $new_image;
        $slider->save();

        return redirect('slider/all')->with("success", "Slider updated successfully");

    }


    //delete slider
    public function destroy($id){

        $slider = Slider::find($id);
        $image = $slider->image;
        unlink($image);

        Slider::find($id)->delete();
        return redirect('slider/all')->with("success", "Slider deleted successfully");
    }

}
