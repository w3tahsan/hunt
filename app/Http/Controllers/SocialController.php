<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    function social(){
        $socials = Social::all();
        return view('backend.social.social', [
            'socials'=>$socials,
        ]);
    }
    function social_store(Request $request){
        Social::insert([
            'icon'=>$request->icon,
            'link'=>$request->link,
        ]);
        return back();

    }
}
