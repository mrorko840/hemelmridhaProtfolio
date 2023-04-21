<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function changePass(){
        return view('backend.user.change-pass');
    }
    
    public function updatePass(Request $request){
        $request->validate([
            'old_pass'          => 'required',
            'new_pass'          => 'required|min:6',
        ]);

        if(!Hash::check($request->old_pass, auth()->user()->password)){
            return response()->json(['msg'=>'Old Password doesn\'t matched!', 'cls'=>'error']);
        }
        if($request->new_pass != $request->confirm_new_pass){
            return response()->json(['msg'=>'New Password and Confirm Password doesn\'t matched!', 'cls'=>'error']);
        }

        $user = Auth::user();
        $user->password = Hash::make($request->new_pass);
        $user->save();
         
        return response()->json(['msg'=>'Password Changed Successfully!', 'cls'=>'success']);
    }
}
