<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CustomerLoginController extends Controller
{
    function customer_login_req(Request $request){
       $request->validate([
        'email'=>'required',
        'password'=>'required',
       ]);

       if(Customer::where('email', $request->email)->exists()){
            if(Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('index');
            }
            else{
                return back()->with('pass_err', 'Wrong Password');
            }
       }
       else{
        return back()->with('invalid', 'Email Does Not Exist');
       }
    }

    function customer_logout(){
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }
}
