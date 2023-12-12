<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Billing;
use App\Models\Cart;
use App\Models\City;
use App\Models\Delivery;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    function checkout_store(Request $request){
        $inside_charge = Delivery::where('type', 1)->first()->amount;
        $outside_charge = Delivery::where('type', 2)->first()->amount;
        $charge = 0;
        if($request->delivery == 1){
            $charge = $inside_charge;
        }
        else{
            $charge = $outside_charge;
        }

        if($request->payment_method == 1){
            $order_id = '#'.random_int(10000000,90000000);
            Order::insert([
                'order_id'=> $order_id,
                'customer_id'=> Auth::guard('customer')->id(),
                'discount'=> $request->discount,
                'charge'=> $charge,
                'sub_total'=> $request->sub_total,
                'total'=> $request->sub_total - $request->discount + ($charge),
                'created_at'=>Carbon::now(),
            ]);

            Billing::insert([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customer')->id(),
                'fname'=>$request->fname,
                'lname'=>$request->lname,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'country_id'=>$request->country_id,
                'city_id'=>$request->city_id,
                'zip'=>$request->zip,
                'address'=>$request->address,
                'company'=>$request->company,
                'notes'=>$request->notes,
                'created_at' => Carbon::now(),
            ]);

            if($request->ship_check == 1){
                Shipping::insert([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customer')->id(),
                    'fname' => $request->ship_fname,
                    'lname' => $request->ship_lname,
                    'email' => $request->ship_email,
                    'phone' => $request->ship_phone,
                    'country_id' => $request->ship_country_id,
                    'city_id' => $request->ship_city_id,
                    'zip' => $request->ship_zip,
                    'address' => $request->ship_address,
                    'company' => $request->ship_company,
                    'created_at' => Carbon::now(),
                ]);
            }

            $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
            foreach($carts as $cart){
                OrderProduct::insert([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customer')->id(),
                    'product_id'=> $cart->product_id,
                    'color_id'=> $cart->color_id,
                    'size_id'=> $cart->size_id,
                    'quantity'=> $cart->quantity,
                    'created_at' => Carbon::now(),
                ]);

                Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
                // $cart->delete();
            }

            //sending invoice
            // Mail::to($request->email)->send(new InvoiceMail($order_id));

            return redirect()->route('order.success')->with('order_success', 'Your Order Has Been Placed Successfully');
        }
        else if($request->payment_method == 2){
           return redirect('/pay')->with('data', $request->all());
        }
        else{
            return redirect('stripe')->with('data', $request->all());
        }
    }

    function getCity(Request $request){
        $str = '<option value="">Select City</option>';
        $cities = City::where('country_id', $request->country_id)->get();
        foreach($cities as $city){
            $str .= '<option value="'. $city->id.'">'.$city->name.'</option>';
        }
        echo $str;
    }
}
