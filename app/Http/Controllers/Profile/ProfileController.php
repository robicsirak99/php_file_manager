<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //only authenticated users can reach the profile page
    public function __construct()
    {
        $this -> middleware(['auth']);
    }

    //display the view of the profile page
    public function index()
    {
        return view('profile.profile');
    }
}
