<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index(){
        return view('frontend.index');
    }

    public function userLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfile(){
        $userId = Auth::user()->id;
        return view('frontend.profile.user-profile', [
            'user' => User::findOrFail($userId),
        ]);
    }

    public function userProfileStore(Request $request){
        $userProfile = User::findOrFail(Auth::user()->id);
        $userProfile->phone = $request->phone;
        $userProfile->name = $request->name;
        $userProfile->email = $request->email;
        $userProfile->save();

        // Profile Photo Updated.
        if($request->file('photo')){
            $image = $request->file('photo');
            @unlink(public_path('front-assets/images/profile_photo/'.$userProfile->profile_photo_path));
            $imgNamGen = date('dmy').'-'.Str::random(3).'.'.$image->getClientOriginalExtension();

            $image->move(public_path('front-assets/images/profile_photo'), $imgNamGen);
            $userProfile->profile_photo_path = $imgNamGen;
            $userProfile->save();
        }

        $notification = array(
            'message' => 'Profile Updated Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function userPasswordEdit(){
        $userId = Auth::user()->id;
        return view('frontend.profile.user-password-edit', [
            'user' => User::findOrFail($userId),
        ]);
    }


    public function userPasswrodStore(Request $request){
        $userId = Auth::user()->id;
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashPass = User::findOrFail($userId )->password;
        if(Hash::check($request->oldpassword, $hashPass)){
            $user = User::findOrFail($userId );
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        }else{
            return back();
        }
    }




}
