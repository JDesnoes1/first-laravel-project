<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public function allBrand() {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function addBrand(Request $request) {
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png'
        ],
        [
            'brand_name.required' => 'Vous devez insérer une marque !',
            'brand_name.unique' => 'Cette marque existe déjà !',
            'brand_name.max' => 'Le nom de votre marque doit avoir au moins 4 caractères !',
            'brand_image.required' => 'Vous devez insérer une image !',
        ]);

        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location, $img_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Brand inserted successfully');
    }

    public function editBrand($id) {
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }

    public function updateBrand(Request $request, $id) {
        $validatedData = $request->validate([
            'brand_name' => 'required|min:4',
        ],
        [
            'brand_name.required' => 'Vous devez insérer une marque !',
            'brand_name.min' => 'Le nom de votre marque doit avoir au moins 4 caractères !',
        ]);

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image){

            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location, $img_name);

        unlink($old_image);
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Brand updated successfully');
        } else {
             Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Brand updated successfully');
        }
    }

    public function deleteBrand($id) {
        $img = Brand::find($id);
        $old_image = $img->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand deleted successfully');
    }
}
