<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function AllBrand(){
        $brands = Brand::orderBy('id', 'desc')
            ->get();

        return view('backend.brand.brand_all', compact('brands'));
    }

    public function AddBrand(){
        return view('backend.brand.brand_add');
    }

    public function StoreBrand(Request $request){
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $save_url = 'upload/brand/'.$name_gen;
        Image::make($image)->resize(300, 300)->save($save_url);

        Brand::insert([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Brand Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification);
    }

    public function EditBrand(Brand $brand){
        return view('backend.brand.brand_edit')->with([
            'brand' => $brand,
        ]);
    }

    public function UpdateBrand(Request $request){

        $brand = Brand::findOrFail($request->id);
        $save_url = $brand->image;

        if ($request->file('image')){
            if (file_exists($brand->image)){
                unlink($brand->image);
            }

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_url = 'upload/brand/'.$name_gen;
            Image::make($image)->resize(300, 300)->save($save_url);
        }

        $brand->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Brand Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification);
    }

    public function DeleteBrand(Brand $brand){

        unlink($brand->image);

        $brand->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
