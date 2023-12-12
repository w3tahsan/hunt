<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use PDF;

class CustomerController extends Controller
{
    function customer_profile(){
        return view('frontend.customer.profile');
    }
    function customer_profile_update(Request $request){
        if($request->image == ''){
            Customer::find(Auth::guard('customer')->id())->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'mobile'=>$request->phone,
                'address'=>$request->address,
            ]);
            return back();
        }
        else{
            $img = $request->image;
            $extension = $img->extension();
            $file_name = Auth::guard('customer')->id().'.'.$extension;
            if(Auth::guard('customer')->user()->image == null){
                Image::make($img)->save(public_path('uploads/customer/'.$file_name));
                Customer::find(Auth::guard('customer')->id())->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->phone,
                    'address' => $request->address,
                    'photo' => $file_name,
                ]);
                return back();
            }
            else{
                $current = public_path('uploads/customer/'.Auth::guard('customer')->user()->image);
                unlink($current);
                Image::make($img)->save(public_path('uploads/customer/' . $file_name));
                Customer::find(Auth::guard('customer')->id())->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->phone,
                    'address' => $request->address,
                    'photo' => $file_name,
                ]);
                return back();
            }
        }
    }

    function customer_password_change(){
        return view('frontend.customer.passchange');
    }
    function customer_password_update(Request $request){
        if(Hash::check($request->current_password, Auth::guard('customer')->user()->password)){
            Customer::find(Auth::guard('customer')->id())->update([
                'password'=>bcrypt($request->password),
            ]);
            return back()->with('updated', 'Password has been changed');
        }
        else{
            return back()->with('wrong', 'Current Password Does not Match!');
        }
    }

    function customer_order(){
        $orders = Order::where('customer_id', Auth::guard('customer')->id())->latest()->get();
        return view('frontend.customer.order', [
            'orders'=> $orders,
        ]);
    }

    function invoice_download($id){
        $order_info = Order::find($id);
        $data = [
            'order'=>$order_info,
        ];
        $pdf = PDF::loadView('frontend.customer.invoice', $data);
        return $pdf->download('order.pdf');
    }
}
