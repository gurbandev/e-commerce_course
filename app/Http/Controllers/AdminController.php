<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }

    public function AdminProfile(){

        $id = Auth::user()->id;

        $adminData = User::find($id);

        return view('admin.admin_profile_view')->with([
            'adminData' => $adminData,
        ]);
    }

    public function AdminProfileStore(Request $request){

        $id =  Auth::user()->id;
        $adminData = User::find($id);
        $adminData->name = $request->name;
        $adminData->email = $request->email;
        $adminData->phone = $request->phone;
        $adminData->address = $request->address;

        if ($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/').$adminData->photo);
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $adminData['photo'] = $filename;
        }

        $notification = array(
            'message' => 'Admin Profile Update Successfully',
            'alert-type' => 'success'
        );

        $adminData->save();
        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword(){
        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request){
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

    public function AdminLogin(){
        return view('admin.admin_login');
    }

    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
