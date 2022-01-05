<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangeUsernameController extends Controller
{
    //only authenticated users can reach the change username page
    public function __construct(){
        $this -> middleware(['auth']);
    }

    //display the index of the change username page
    public function index(){
        return view('profile.change_username');
    }

    //change the username
    public function store(Request $request){

        //validation
        $this->validate($request, [
            'username_old'=>'required',
            'username_new'=>'required'
        ]);

        //current username validation
        if(!($request->username_old == auth()->user()->username)){
            return back()->with('status','current username invalid');
        }

        //changing the username
        User::find(auth()->user()->id)->update(['username'=> $request->username_new]);

        //redirect
        return redirect()->route('profile')->with('status','username changed succesfully');
    }
}
