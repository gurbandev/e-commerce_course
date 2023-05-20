<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function AllCategory(){
        $categories = Category::orderBy('id', 'desc')
            ->get();

        return view('backend.category.category_all', compact('categories'));
    }

    public function AddCategory(){
        return view('backend.category.category_add');
    }

    public function StoreCategory(Request $request){
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $save_url = 'upload/category/'.$name_gen;
        Image::make($image)->resize(120, 120)->save($save_url);

        Category::insert([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Category Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function EditCategory(Category $category){
        return view('backend.category.category_edit')->with([
            'category' => $category,
        ]);
    }

    public function UpdateCategory(Request $request){

        $category = Category::findOrFail($request->id);
        $save_url = $category->image;

        if ($request->file('image')){
            if (file_exists($category->image)){
                unlink($category->image);
            }

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_url = 'upload/category/'.$name_gen;
            Image::make($image)->resize(120, 120)->save($save_url);
        }

        $category->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Category Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function DeleteCategory(Category $category){

        unlink($category->image);

        $category->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
