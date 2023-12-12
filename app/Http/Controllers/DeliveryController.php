<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    function delivery(){
        $charges = Delivery::all();
        return view('backend.delivery.delivery', [
            'charges'=> $charges,
        ]);
    }
    function delivery_store(Request $request){
        Delivery::insert([
            'type'=>$request->type,
            'amount'=>$request->amount,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }
}
