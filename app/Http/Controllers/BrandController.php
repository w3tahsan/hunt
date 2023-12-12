<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    function brand(){
        $brands = Brand::all();
        return view('backend.brand.index', [
            'brands'=>$brands,
        ]);
    }
    function brand_store(Request $request){

        $photo = $request->brand_photo;
        $extension = $photo->extension();
        $file_name = Str::lower(str_replace(' ', '-', $request->brand_name)).'.'.$extension;
        Image::make($photo)->resize(100,100)->save(public_path('uploads/brand/'.$file_name));

        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_photo'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);

        return back();
    }
}
