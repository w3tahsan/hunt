<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    function category(){
        $categories = Category::all();
        return view('backend.category.add_category', [
            'categories'=>$categories,
        ]);
    }

    function category_store(CategoryRequest $request){

        $photo = $request->category_photo;
        $extension = $photo->extension();
        $file_name = Str::lower(str_replace(' ', '-', $request->category_name)).'.'.$extension;
        Image::make($photo)->save(public_path('uploads/category/'.$file_name));

        Category::create([
            'category_name'=>$request->category_name,
            'category_photo'=>$file_name,
        ]);

        return back();
    }

    function category_soft_delete($category_id){
        Category::find($category_id)->delete();
        return back();
    }

    function trash_category(){
        $trash_categories = Category::onlyTrashed()->get();
        return view('backend.category.trash_category', [
            'trash_categories'=>$trash_categories,
        ]);
    }
    function category_delete($category_id){

        $sub_category_info = Subcategory::where('category_id', $category_id)->get();

        // foreach($sub_category_info as $sub){
        //     $subcat_photo = Subcategory::find($sub->id);
        //     $delete_from = public_path('uploads/subcategory/'.$subcat_photo->subcategory_photo);
        //     unlink($delete_from);
        //     $subcat_photo->forceDelete();

        // }

        foreach($sub_category_info as $sub){
            Subcategory::find($sub->id)->update([
                'category_id'=>13,
            ]);
        }

        $cat_photo = Category::onlyTrashed()->find($category_id);
        $delete_from = public_path('uploads/category/'.$cat_photo->category_photo);
        unlink($delete_from);

        Category::onlyTrashed()->find($category_id)->forceDelete();
        return back();
    }
    function category_restore($category_id){
        Category::onlyTrashed()->find($category_id)->restore();
        return redirect()->route('add.category');
    }

    function checked_delete(Request $request){
        foreach($request->category_id as $category_id){
            Category::find($category_id)->delete();
        }
        return back();
    }

    function category_edit($category_id){
        $category_info = Category::find($category_id);
        return view('backend.category.edit', [
            'category_info'=>$category_info,
        ]);
    }
    function category_update(Request $request){
        $cat_info = Category::find($request->category_id);
        if($request->category_photo == ''){
            Category::find($request->category_id)->update([
                'category_name'=>$request->category_name,
            ]);
        }
        else{
            $delete_form = public_path('uploads/category/'.$cat_info->category_photo);
            unlink($delete_form);

            $category_img = $request->category_photo;
            $extension = $category_img->extension();
            $file_name = Str::lower(str_replace(' ', '-', $request->category_name)).'.'.$extension;
            Image::make($category_img)->save(public_path('uploads/category/'.$file_name));

            Category::find($request->category_id)->update([
                'category_name'=>$request->category_name,
                'category_photo'=>$file_name,
                'updated_at'=>Carbon::now(),
            ]);

            return redirect()->route('add.category');
        }
    }

    function checked_delete_permanent(Request $request){
        foreach($request->category_id as $category){
            $select_img = Category::onlyTrashed()->find($category);
            $delete_from = public_path('uploads/category/'.$select_img->category_photo);
            unlink($delete_from);
            Category::onlyTrashed()->find($category)->forceDelete();
        }
        return back();
    }
}
