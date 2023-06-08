<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function AllProduct(){
        $products = Product::latest()->get();

        return view('backend.product.product_all')->with('products', $products);
    }

    public function AddProduct(){
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $vendors = User::where('role', 'vendor')
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('backend.product.product_add')->with([
            'categories' => $categories,
            'brands' => $brands,
            'vendors' => $vendors,
        ]);
    }

    public function StoreProduct(Request $request){


        $image = $request->file('thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $save_url = 'upload/products/thambnail/'.$name_gen;
        Image::make($image)->resize(800, 800)->save($save_url);

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'code' => $request->code,
            'tags' => $request->tags,
            'qty' => $request->qty,
            'size' => $request->size,
            'color' => $request->color,
            'selling_price' => $request->price,
            'discount_price' => $request->discount_price,
            'long_descp' => $request->long_descp,
            'short_descp' => $request->short_descp,
            'thambnail' => $save_url,
            'hot_deals' => $request->brand_id,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
        ]);

          $images = $request->file('multi_img');

          foreach($images as $image){
              $make_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
              $uploadPath = 'upload/products/multi-image/'.$make_name;
              Image::make($image)->resize(800, 800)->save($uploadPath);

              MultiImg::insert([
                  'product_id' => $product_id,
                  'photo_name' => $uploadPath,
              ]);
          }

        $notification = array(
            'message' => 'Product Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function EditProduct(Product $item){
        $multi_imgs = MultiImg::where('product_id', $item->id)->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $vendors = User::where('role', 'vendor')
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('backend.product.product_edit')->with([
            'multi_imgs' => $multi_imgs,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
            'vendors' => $vendors,
            'item' => $item,
        ]);
    }

    public function UpdateProduct(Product $item, Request $request){

        $item->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'code' => $request->code,
            'tags' => $request->tags,
            'qty' => $request->qty,
            'size' => $request->size,
            'color' => $request->color,
            'selling_price' => $request->price,
            'discount_price' => $request->discount_price,
            'long_descp' => $request->long_descp,
            'short_descp' => $request->short_descp,
            'hot_deals' => $request->brand_id,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function DeleteProduct(Product $item){

        unlink($item->thambnail);

        $item->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function UpdateProductThambnail(Product $item, Request $request){

        $image = $request->file('thambnail' );
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $save_url = 'upload/products/thambnail/'.$name_gen;
        Image::make($image)->resize(800, 800)->save($save_url);

        if (file_exists($item->thambnail)){
            unlink($item->thambnail);
        }

        $item->update([
            'thambnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Thambnail Image Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function UpdateProductMultiImage(Request $request, Product $item){

        foreach($request->multi_img as $id => $img){
            $imgOld = MultiImg::find($id);
//            unlink($imgOld->photo_name);

            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            $uploadPath = 'upload/products/multi-image/'.$make_name;
            Image::make($img)->resize(800, 800)->save($uploadPath);

//            return $uploadPath;

            MultiImg::find($id)->update([
                'photo_name' => $uploadPath,
//                'updated_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Product Multi Image Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}

