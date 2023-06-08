<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function AllSubCategory(){
        $subcategories = SubCategory::orderBy('id', 'desc')
            ->get();

        return view('backend.subcategory.subcategory_all', compact('subcategories'));
    }

    public function AddSubCategory(){
        $caregories = Category::orderBy('name')->get();

        return view('backend.subcategory.subcategory_add')
            ->with([
                'categories' => $caregories,
            ]);
    }

    public function StoreSubCategory(Request $request){
        SubCategory::insert([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
        ]);

        $notification = array(
            'message' => 'SubCategory Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    }

    public function EditSubCategory(SubCategory $subcategory){

        $categories = Category::orderBy('name')->get();

        return view('backend.subcategory.subcategory_edit')->with([
            'subcategory' => $subcategory,
            'categories' => $categories,
        ]);
    }

    public function UpdateSubCategory(Request $request){

        $subcategory = SubCategory::findOrFail($request->id);

        $subcategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
        ]);

        $notification = array(
            'message' => 'SubCategory Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    }

    public function DeleteSubCategory(SubCategory $subcategory){

        $subcategory->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function GetSubCategory($category_id){

        $subcategory = SubCategory::where('category_id', $category_id)
            ->orderBy('name', 'ASC')
            ->get();

        return json_encode($subcategory);
    }
}
