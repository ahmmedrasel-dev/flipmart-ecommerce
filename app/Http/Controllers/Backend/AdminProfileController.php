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
        return view('backend.admin-profile.admin-profile', [
            'adminProfile' => Admin::findOrFail(1),
        ]);
    }

    public function adminProfileEdit(){
        return view('backend.admin-profile.admin-profile-edit', [
            'adminProfile' => Admin::findOrFail(1),
        ]);
    }

    public function adminProfileUpdate(Request $request){
        $adminProfile = Admin::findOrFail(1);
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
            'adminProfile' => Admin::findOrFail(1),
        ]);

    }

    public function adminPasswordUpdate(Request $request){

        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashPass = Admin::findOrFail(1)->password;
        if(Hash::check($request->oldpassword, $hashPass)){
            $admin = Admin::findOrFail(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }else{
            return back();
        }

    }





}
