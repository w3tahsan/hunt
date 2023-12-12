<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    function profile(){
        return view('backend.profile.profile');
    }

    function profile_update(Request $request){
       if($request->password == ''){
            User::find(Auth::id())->update([
                'name'=>$request->name,
            ]);
       }
       else{
            if(Hash::check($request->old_password, Auth::user()->password)){
                User::find(Auth::id())->update([
                    'name'=>$request->name,
                    'password'=>bcrypt($request->password),
                ]);
            }
            else{
                return back()->with('wrong_old', 'Current Password does not matched');
            }
       }
    }

    function profile_photo_update(Request $request){

        $request->validate([
            'photo'=>'required|max:512|image',
        ],[
            'photo.required'=>'photo de',
            'photo.max'=>'choto photo de',
            'photo.image'=>'only photo de',
        ]);

        if(Auth::user()->profile_photo != null){
            $delete_from = public_path('uploads/profile_photo/'.Auth::user()->profile_photo);
            unlink($delete_from);

            $photo = $request->photo;
            $extension = $photo->extension();
            $file_name = Auth::id().'.'.$extension;
            Image::make($photo)->save(public_path('uploads/profile_photo/'.$file_name));

            User::find(Auth::id())->update([
                'profile_photo'=>$file_name,
            ]);

            return back();
        }
        else{
            $photo = $request->photo;
            $extension = $photo->extension();
            $file_name = Auth::id().'.'.$extension;
            Image::make($photo)->save(public_path('uploads/profile_photo/'.$file_name));

            User::find(Auth::id())->update([
                'profile_photo'=>$file_name,
            ]);

            return back();
        }
    }

    function user_list(){
        $users = User::where('id', '!=', Auth::id())->get();
        return view('backend.user.user_list', [
            'users'=>$users,
        ]);
    }

    function user_delete($user_id){
        $user = User::find($user_id);
        if($user->profile_photo){
            $delete_from = public_path('uploads/profile_photo/'.$user->profile_photo);
            unlink($delete_from);
        }

        User::find($user_id)->delete();

        return back();

    }


}
