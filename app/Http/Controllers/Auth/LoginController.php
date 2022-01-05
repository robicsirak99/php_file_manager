<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller {

    //only guest users can reach the login page
    public function __construct(){
        $this -> middleware(['guest']);
    }

    //display the view of the login page
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        //validation
        $this->validate($request, [
            'username'=>'required',
            'password'=>'required'
        ]);

        //sign the user in or return back with error message
        if(!auth()->attempt($request->only('username','password'))){
            return back()->with('status','invalid login details');
        }

        //redirect
        return redirect()->route('files');
    }
}
