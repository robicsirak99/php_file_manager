<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ChnagePasswordController extends Controller
{
    //only authenticated users can reach the change password page
    public function __construct(){
        $this -> middleware(['auth']);
    }

    //display the view of the change password page
    public function index(){
        return view('profile.change_password');
    }

    //change the password
    public function store(Request $request){

        //validation
        $this->validate($request, [
            'password_old'=>'required',
            'password_new'=>'required|confirmed'
        ]);

        //current password validation
        if(!(Hash::check($request->password_old, auth()->user()->password))){
            return back()->with('status','current password invalid');
        }

        //changing the password
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password_new)]);

        //redirect
        return redirect()->route('profile')->with('status','password changed succesfully');
    }

}
