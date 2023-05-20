<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserDashboard(){

        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('index', compact('userData'));
    }

    public function UserProfileStore(Request $request){

        $id =  Auth::user()->id;
        $userData = User::find($id);
        $userData->name = $request->name;
        $userData->email = $request->email;
        $userData->phone = $request->phone;
        $userData->address = $request->address;

        if ($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/').$userData->photo);
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $userData['photo'] = $filename;
        }

        $notification = array(
            'message' => 'User Profile Update Successfully',
            'alert-type' => 'success'
        );

        $userData->save();
        return redirect()->back()->with($notification);
    }

    public function UserUpdatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)){
            return back()->with("error", "Old Password Doesn't Match!!");
        }

        User::find(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password Changed Successfully");
    }


    public function UserDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

}
