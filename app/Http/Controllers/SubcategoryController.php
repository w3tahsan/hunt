<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SubcategoryController extends Controller
{
    function subcategory(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('backend.subcategory.index', [
            'categories'=>$categories,
            'subcategories'=>$subcategories,
        ]);
    }

    function subcategory_store(Request $request){
        $sub_photo = $request->subcategory_photo;
        $extension = $sub_photo->extension();
        $file_name = Str::lower(str_replace(' ', '-', $request->subcategory_name)).'.'.$extension;
        Image::make($sub_photo)->resize(100,100)->save(public_path('uploads/subcategory/'.$file_name));

        Subcategory::insert([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_photo'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);

        return back();
    }

    function subcategory_edit($sub_cat_id){
        $subcategory_info = Subcategory::find($sub_cat_id);
        $categories = Category::all();
        return view('backend.subcategory.edit', [
            'categories'=>$categories,
            'subcategory_info'=>$subcategory_info,
        ]);
    }

    function subcategory_update(Request $request, $sub_cat_id){
        $sub_category_info = Subcategory::find($sub_cat_id);
        if($request->subcategory_photo == ''){
            Subcategory::find($sub_cat_id)->update([
                'category_id'=>$request->category_id,
                'subcategory_name'=>$request->subcategory_name,
            ]);
            return back()->with('update', 'Subcategory Updated!');
        }
        else{
            $delete_form = public_path('uploads/subcategory/'.$sub_category_info->subcategory_photo);
            unlink($delete_form);
           $image = $request->subcategory_photo;
           $extension = $image->extension();
           $file_name = Str::lower(str_replace(' ', '-', $request->subcategory_name)).'.'.$extension;
           Image::make($image)->resize(100,100)->save(public_path('uploads/subcategory/'.$file_name));
           Subcategory::find($sub_cat_id)->update([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_photo'=>$file_name,
            ]);
            return back()->with('update', 'Subcategory Updated!');
        }
    }
    function subcategory_delete($sub_cat_id){
        Subcategory::find($sub_cat_id)->delete();
        return back()->with('soft_del', 'Subcategory Move To Trash');
    }
}
