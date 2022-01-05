<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {

    //only guest users can reach the registration page
    public function __construct(){
        $this -> middleware(['guest']);
    }

    //display the view of the registration page
    public function index(){
        return view('auth.register');
    }
    
    public function store(Request $request){

        //validation
        $this->validate($request, [
            'name'=>'required|max:255',
            'username'=>'required|max:255',
            'email'=>'required|email|max:255',
            'password'=>'required|confirmed'
        ]);

        //validation
        if (User::where('email', '=', $request->email)->exists()) {
            return back()->with('status','this email has been taken');
        }

        //validation
        if (User::where('username', '=', $request->username)->exists()) {
            return back()->with('status','this username has been taken');
        }


        //store user details
        User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        //sign the user in
        auth()->attempt($request->only('username','password'));

        //redirect
        return redirect()->route('home');
    }
}
