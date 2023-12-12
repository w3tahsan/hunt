<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Stripeorder;
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Mail\InvoiceMail;
use App\Models\Billing;
use App\Models\Cart;
use App\Models\City;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        $data = session('data');
        $inside_charge = Delivery::where('type', 1)->first()->amount;
        $outside_charge = Delivery::where('type', 2)->first()->amount;
        $charge = 0;
        if ($data['delivery'] == 1) {
            $charge = $inside_charge;
        } else {
            $charge = $outside_charge;
        }

        $total_amount = $data['sub_total'] - $data['discount'] + $charge;

        $stripe_id = Stripeorder::insertGetId([
            'customer_id' => $data['customer_id'],
            'address' => $data['address'],
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'country_id' => $data['country_id'],
            'city_id' => $data['city_id'],
            'zip' => $data['zip'],
            'company' => $data['company'],
            'notes' => $data['notes'],
            'ship_fname' => $data['ship_fname'],
            'ship_email' => $data['ship_email'],
            'ship_phone' => $data['ship_phone'],
            'ship_country_id' => $data['ship_country_id'],
            'ship_city_id' => $data['ship_city_id'],
            'ship_address' => $data['ship_address'],
            'ship_zip' => $data['ship_zip'],
            'ship_company' => $data['ship_company'],
            'charge' => $data['delivery'],
            'discount' => $data['discount'],
            'sub_total' => $data['sub_total'],
            'total' => $total_amount,
            'ship_check' => $data['ship_check'],
        ]);

        return view('stripe', [
            'total'=> $total_amount,
            'stripe_id'=> $stripe_id,
        ]);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {

        $data = Stripeorder::find($request->stripe_id);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" =>$data->first()->total * 100,
            "currency" => "bdt",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        $inside_charge = Delivery::where('type', 1)->first()->amount;
        $outside_charge = Delivery::where('type', 2)->first()->amount;
        $charge = 0;
        if ($data->first()->charge == 1) {
            $charge = $inside_charge;
        } else {
            $charge = $outside_charge;
        }

        $order_id = '#' . random_int(10000000, 90000000);
        Order::insert([
            'order_id' => $order_id,
            'customer_id' => $data->first()->customer_id,
            'discount' => $data->first()->discount,
            'charge' => $charge,
            'sub_total' => $data->first()->sub_total,
            'total' => $data->first()->total,
            'created_at' => Carbon::now(),
        ]);

        Billing::insert([
            'order_id' => $order_id,
            'customer_id' => $data->first()->customer_id,
            'fname' =>  $data->first()->fname,
            'lname' =>  $data->first()->lname,
            'email' =>  $data->first()->email,
            'phone' =>  $data->first()->phone,
            'country_id' =>  $data->first()->country_id,
            'city_id' =>  $data->first()->city_id,
            'zip' =>  $data->first()->zip,
            'address' =>  $data->first()->address,
            'company' =>  $data->first()->company,
            'notes' =>  $data->first()->notes,
            'created_at' => Carbon::now(),
        ]);

        if ($data->first()->ship_check == 1) {
            Shipping::insert([
                'order_id' => $order_id,
                'customer_id' => $data->first()->customer_id,
                'fname' =>  $data->first()->ship_fname,
                'lname' =>  $data->first()->ship_lname,
                'email' =>  $data->first()->ship_email,
                'phone' =>  $data->first()->ship_phone,
                'country_id' =>  $data->first()->ship_country_id,
                'city_id' =>  $data->first()->ship_city_id,
                'zip' =>  $data->first()->ship_zip,
                'address' =>  $data->first()->ship_address,
                'company' =>  $data->first()->ship_company,
                'created_at' => Carbon::now(),
            ]);
        }

        $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
        foreach ($carts as $cart) {
            OrderProduct::insert([
                'order_id' => $order_id,
                'customer_id' => $data->first()->customer_id,
                'product_id' => $cart->product_id,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id,
                'quantity' => $cart->quantity,
                'created_at' => Carbon::now(),
            ]);

            Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
            // $cart->delete();
        }

        //sending invoice
        // Mail::to($data->first()->email)->send(new InvoiceMail($order_id));

        return redirect()->route('order.success')->with('order_success', 'Your Order Has Been Placed Successfully');
    }
}
