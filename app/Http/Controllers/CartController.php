<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function cart_store(Request $request){
        $quantity = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->quantity;
        if($quantity <= $request->quantity){
            return back()->withStockout($quantity);
        }

        if(Cart::where('customer_id', Auth::guard('customer')->id())->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()){
            Cart::where('customer_id', Auth::guard('customer')->id())->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->quantity);
            return back()->with('cart_added', 'Cart Added Successfully');
        }
        else{
            Cart::insert([
                'customer_id' => Auth::guard('customer')->id(),
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now(),
            ]);

            return back()->with('cart_added', 'Cart Added Successfully');
        }
    }

    function cart_remove($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }
    function cart_update(Request $request){
       foreach($request->quantity as $cart_id=>$quantity){
        Cart::find($cart_id)->update([
            'quantity'=> $quantity,
        ]);
       }
       return back();
    }
}
