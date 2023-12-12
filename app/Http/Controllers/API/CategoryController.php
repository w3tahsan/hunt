<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    function category_store(Request $request){
        $validator = Validator::make($request->all(), [
            'category_name'=>'required|unique:categories',
            'category_photo'=>'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->all();
        }
        $photo = $request->category_photo;
        $extension = $photo->extension();
        $file_name = Str::lower(str_replace(' ', '-', $request->category_name)) . '.' . $extension;
        Image::make($photo)->save(public_path('uploads/category/' . $file_name));

        $category = Category::create([
            'category_name' => $request->category_name,
            'category_photo' => $file_name,
        ]);
        $response = [
            'customer' => $category,
            'message' => 'Category Added Successfully!',
        ];
        return response()->json($response);
    }
}
