<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function order(){
        $orders = Order::latest()->get();
        return view('backend.order.order', [
            'orders'=> $orders,
        ]);
    }

    function order_update(Request $request, $id){
        Order::find($id)->update([
            'status'=>$request->status,
        ]);
        return back();
    }
}
