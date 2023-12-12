<?php

namespace App\Http\Controllers;

use App\Models\Newyear;
use App\Models\Upcoming;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class OfferController extends Controller
{
    function upcoming_offer(){
        $upcoming_offers = Upcoming::all();
        return view('backend.offer.upcoming', [
            'upcoming_offers'=>$upcoming_offers,
        ]);
    }

    function upcoming_store(Request $request){
        $preview_name = Str::lower(str_replace(' ', '-', $request->product_name)).'-'.random_int(100000, 10000000000);
        $image = $request->image;
        $extension = $image->extension();
        $file_name = $preview_name.'.'.$extension;
        Image::make($image)->save(public_path('uploads/upcoming_offer/'.$file_name));

        Upcoming::insert([
            'product_name'=>$request->product_name,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'after_discount'=>$request->price - $request->price*$request->discount/(100),
            'date'=>$request->date,
            'image'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }


    function newyear_offer(){
        $newyear_offers = Newyear::all();
        return view('backend.offer.newyear', [
            'newyear_offers'=>$newyear_offers,
        ]);
    }

    function newyear_store(Request $request){
        $preview_name = Str::lower(str_replace(' ', '-', $request->title)).'-'.random_int(100000, 10000000000);
        $image = $request->image;
        $extension = $image->extension();
        $file_name = $preview_name.'.'.$extension;
        Image::make($image)->save(public_path('uploads/newyear_offer/'.$file_name));

        Newyear::insert([
            'title'=>$request->title,
            'sub_title'=>$request->sub_title,
            'percentage'=>$request->percentage,
            'image'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }
}
