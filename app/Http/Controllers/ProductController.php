<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Tag;
use App\Models\Thumbnail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function add_product(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        $tags = Tag::all();
        return view('backend.product.add_product', [
            'categories'=>$categories,
            'subcategories'=>$subcategories,
            'brands'=>$brands,
            'tags'=> $tags,
        ]);
    }
    function getSubcategory(Request $request){
        $str = '<option value="">Select Sub Category</option>';
        $subcategories =  Subcategory::where('category_id', $request->category_id)->get();
        foreach($subcategories as $subcategory){
            $str .= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
        }
        echo $str;

    }

    function product_store(Request $request){
    $tags= implode(',', $request->tags);
    $category_name = Category::where('id', $request->category_id)->first()->category_name;
    $sku = Str::upper(substr($category_name, 0, 3)).'-'.random_int(100000, 10000000000);
    $slug = Str::lower(str_replace(' ', '-', $request->product_name)).'-'.random_int(100000, 10000000000);
    $preview_name = Str::lower(str_replace(' ', '-', $request->product_name)).'-'.random_int(100000, 10000000000);


    $preview = $request->preview;
    $extension = $preview->extension();
    $file_name = $preview_name.'.'.$extension;
    Image::make($preview)->resize(600,600)->save(public_path('uploads/product/preview/'.$file_name));

    $product_id = Product::insertGetId([
        'added_by'=>Auth::id(),
        'category_id'=>$request->category_id,
        'subcategory_id'=>$request->subcategory_id,
        'product_name'=>$request->product_name,
        'brand_id'=>$request->brand_id,
        'price'=>$request->price,
        'discount'=>$request->discount,
        'after_discount'=>$request->price - $request->price*$request->discount/(100),
        'sku'=>$sku,
        'tags'=> $tags,
        'slug'=>$slug,
        'additional_info'=>$request->additional_info,
        'short_desp'=>$request->short_desp,
        'long_desp'=>$request->long_desp,
        'preview'=>$file_name,
        'created_at'=>Carbon::now(),
        ]);


        $thumbnails = $request->thumbnail;

        foreach($thumbnails as $thumb){
            $thumb_extension = $thumb->extension();
            $thumb_name = Str::lower(str_replace(' ', '-', $request->product_name)).'-'.random_int(100000, 10000000000).'.'.$thumb_extension;
            Image::make($thumb)->resize(600,600)->save(public_path('uploads/product/thumbnail/'.$thumb_name));

            Thumbnail::insert([
                'added_id'=>Auth::id(),
                'product_id'=>$product_id,
                'thumbnail'=>$thumb_name,
                'created_at'=>Carbon::now(),
            ]);
        }
        return back()->with('success', 'Product Added!');

    }

    function product_list(){
        $products = Product::simplePaginate(5);
        return view('backend.product.list', [
            'products'=>$products,
        ]);
    }

}
