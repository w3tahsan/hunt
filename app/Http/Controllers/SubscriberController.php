<?php

namespace App\Http\Controllers;

use App\Models\Subs;
use App\Models\Subscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SubscriberController extends Controller
{
    function subscribe_store(Request $request){
        Subscribe::insert([
            'customer_id'=>0,
            'email'=>$request->email,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }

    function subscribe(){
        $subs_content = Subs::all();
        return view('backend.subscribe.subs', [
            'subs_content'=>$subs_content,
        ]);
    }

    function subs_update(Request $request){

        if($request->image == ''){
            Subs::find($request->id)->update([
                'title'=>$request->title,
            ]);
            return back();
        }
        else{
            $prev_img = Subs::find($request->id);
            $delete_from = public_path('uploads/subs/'.$prev_img->image);
            unlink($delete_from);

            $image = $request->image;
            $extension = $image->extension();
            $file_name = 'sub'.'.'.$extension;
            Image::make($image)->save(public_path('uploads/subs/'.$file_name));

            Subs::find($request->id)->update([
                'title'=>$request->title,
                'image'=>$file_name,
            ]);
            return back();
        }
        
    }
}
