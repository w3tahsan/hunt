<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;

class CustomerRegisterController extends Controller
{
    function customer_register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'=> 'required|unique:users',
            'password'=>'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->all();
        }
        $users = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        $token = $users->createToken('hudaitoken')->plainTextToken;
        $response = [
            'customer'=> $users,
            'token'=>$token,
        ];
        return response()->json($response);
    }

    function customer_login(Request $request){
        $validate = $request->validate([
            'email'=> 'required',
            'password'=>'required',
        ]);
        $customer = User::where('email', $request->email)->first();
        if (User::where('email', $request->email)->exists()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $token = $customer->createToken('logintoken')->plainTextToken;
                $response = [
                    'customer' => $customer,
                    'token' => $token,
                    'succsss' => 'Login Successfully',
                ];
                return response()->json($response);
            }
            else {
                return response(['message' => 'Wrong Password']);
            }
        }
        else {
            return response(['message'=> 'Email Does Not Exist']);
        }
    }

    function customer_logout(Request $request){
        // Get bearer token from the request
        $accessToken = $request->bearerToken();

        // Get access token from database
        $token = PersonalAccessToken::findToken($accessToken);

        // Revoke token
        $token->delete();
        return response(['message' => 'customer Logout success']);
    }
}
