<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    function add_color_size(){
        $colors = Color::all();
        $sizes = Size::all();
        $categories = Category::all();
        return view('backend.product.size_color', [
            'colors'=>$colors,
            'categories'=>$categories,
            'sizes'=>$sizes,
        ]);
    }
    function color_store(Request $request){
        Color::insert([
            'color_name'=>$request->color_name,
            'color_code'=>$request->color_code,
        ]);
        return back();
    }
    function size_store(Request $request){
        Size::insert([
            'size_name'=>$request->size_name,
            'category_id'=>$request->category_id,
        ]);
        return back();
    }

    function inventory($product_id){
        $product_info = Product::find($product_id);
        $colors = Color::all();
        $sizes = Size::where('category_id', $product_info->category_id)->get();
        $inventory = Inventory::where('product_id', $product_id)->get();
        return view('backend.product.inventory', [
            'colors'=>$colors,
            'sizes'=>$sizes,
            'product_info'=>$product_info,
            'inventory'=>$inventory,
        ]);
    }

    function inventory_store(Request $request){
        if(Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()){
            Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->quantity);
            return back();
        }
        else{
            Inventory::insert([
                'product_id'=>$request->product_id,
                'color_id'=>$request->color_id,
                'size_id'=>$request->size_id,
                'quantity'=>$request->quantity,
                'created_at'=>Carbon::now(),
            ]);
            return back();
        }
        
    }
}
