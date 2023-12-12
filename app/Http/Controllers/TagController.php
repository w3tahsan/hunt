<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagController extends Controller
{
    function tags(){
        return view('backend.tag.tag');
    }
    function tag_store(Request $request){
        Tag::insert([
            'tag_name'=>$request->tag_name,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }
}
