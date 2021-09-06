<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminProfileController extends Controller
{

    public function adminProfile(){
        $userId = Auth::id();
        return view('backend.admin-profile.admin-profile', [
            'adminProfile' => Admin::findOrFail($userId),
        ]);
    }

    public function adminProfileEdit(){
        return view('backend.admin-profile.admin-profile-edit', [
            'adminProfile' => Admin::findOrFail(Auth::id()),
        ]);
    }

    public function adminProfileUpdate(Request $request){
        $adminProfile = Admin::findOrFail(Auth::id());
        $adminProfile->name = $request->name;

        // Profile Photo Updated.
        if($request->file('profile_photo')){
            $image = $request->file('profile_photo');
            @unlink(public_path('backend-assets/profile_photo/'.$adminProfile->profile_photo_path));
            $imgNamGen = date('dmy').'-'.Str::random(3).'.'.$image->getClientOriginalExtension();

            $image->move(public_path('backend-assets/profile_photo'), $imgNamGen);
            $adminProfile->profile_photo_path = $imgNamGen;
            $adminProfile->save();
        }

        $notification = array(
            'message' => 'Profile Updated Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }


    public function adminPasswordEdit(Request $request){
        return view('backend.admin-profile.admin-password', [
            'adminProfile' => Admin::findOrFail(Auth::id()),
        ]);

    }

    public function adminPasswordUpdate(Request $request){

        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashPass = Admin::findOrFail(Auth::id())->password;
        if(Hash::check($request->oldpassword, $hashPass)){
            $admin = Admin::findOrFail(Auth::id());
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }else{
            return back();
        }

    }





}
