<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class LogoController extends Controller
{
    function logo(){
        $main_logo = Logo::where('location', 'main')->get();
        $footer_logo = Logo::where('location', 'footer')->get();
        return view('backend.logo.logo', [
            'main_logo'=>$main_logo,
            'footer_logo'=>$footer_logo,
        ]);
    }

    function mainlogo_update(Request $request){
        $logo = Logo::find($request->logo_id);
        $delete_from = public_path('uploads/logo/'.$logo->logo);
        unlink($delete_from);


        $image = $request->logo;
        $extension = $image->extension();
        $file_name = 'main_logo'.'.'.$extension;
        Image::make($image)->save(public_path('uploads/logo/'.$file_name));
        Logo::find($request->logo_id)->update([
            'logo'=>$file_name,
        ]);

        return back();
    }
    function footerlogo_update(Request $request){
        $logo = Logo::find($request->logo_id);
        $delete_from = public_path('uploads/logo/'.$logo->logo);
        unlink($delete_from);


        $image = $request->logo;
        $extension = $image->extension();
        $file_name = 'footer_logo'.'.'.$extension;
        Image::make($image)->save(public_path('uploads/logo/'.$file_name));
        Logo::find($request->logo_id)->update([
            'logo'=>$file_name,
        ]);

        return back();
    }
}
