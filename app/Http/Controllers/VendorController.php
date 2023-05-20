<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function VendorDashboard(){
        return view('vendor.index');
    }

    public function VendorLogin(){
        return view('vendor.vendor_login');
    }

    public function VendorProfile(){

        $id = Auth::user()->id;

        $vendorData = User::find($id);

        return view('vendor.vendor_profile_view')->with([
            'vendorData' => $vendorData,
        ]);
    }

    public function VendorProfileStore(Request $request){

        $id =  Auth::user()->id;
        $vendorData = User::find($id);
        $vendorData->name = $request->name;
        $vendorData->email = $request->email;
        $vendorData->phone = $request->phone;
        $vendorData->address = $request->address;
        $vendorData->vendor_join = $request->vendor_join;
        $vendorData->vendor_short_info = $request->vendor_short_info;

        if ($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/vendor_images/').$vendorData->photo);
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/vendor_images'), $filename);
            $vendorData['photo'] = $filename;
        }

        $notification = array(
            'message' => 'Vendor Profile Update Successfully',
            'alert-type' => 'success'
        );

        $vendorData->save();
        return redirect()->back()->with($notification);
    }

    public function VendorChangePassword(){
        return view('vendor.vendor_change_password');
    }

    public function VendorUpdatePassword(Request $request){
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

    public function VendorDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    }

    public function VendorBecome(){
        return view('auth.become_vendor');
    }

    public function VendorRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'vendor_join' => $request->vendor_join,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Vendor Registered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
