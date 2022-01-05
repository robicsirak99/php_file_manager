<?php

namespace App\Http\Controllers\Files;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\FileRecievedMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendFilesController extends Controller
{
    //only authenticated users can reach the send files page
    public function __construct()
    {
        $this -> middleware(['auth']);
    }

    //display the view of the send files page
    public function index()
    {
        $files = auth()->user()->files;

        return view('files.send_files', [
            'files' => $files
        ]);
    }

    //send files to a user from the send files page
    public function send(Request $request)
    {   
        //validation
        $this->validate($request, [
            'username'=>'required'
        ]);

        //validation
        if(empty($request->file_list)){
            return back()->with('status','you must check at least one box');
        }

        //send the files to this user
        $user = User::where('username','like', $request->username) -> first();

        //validation
        if($user == null){
            return back()->with('status','no user found with this username');
        }

        //this is the user who is sending the files
        $current_users_username = auth()->user()->username;

        //these are the files needed to send
        $file_name_list = array();

        //send each file selected
        foreach($request->file_list as $file_id){
            $file = File::where('id','like', $file_id)->first();

            array_push($file_name_list, substr($file->file_name,13));

            $storing_id = uniqid();
            $new_file_name = $storing_id.substr($file->file_name,13);
            $file_path = 'app/public/uploads/'.$new_file_name;

            $user->files()->create([
                'storing_id' => $storing_id,
                'file_name' => $new_file_name,
                'file_path' => $file_path,
                'file_size' => $file->file_size,
                'recieved_from' => $current_users_username
            ]);

            $file_content = Storage::disk('public')->get('uploads/' . $file->file_name);
            Storage::disk('public')->put('/uploads/' . $new_file_name, $file_content);
        }

        //send the mail
        Mail::to($user->email)->send(new FileRecievedMail($file_name_list, $request->username));

        //redirect
        return redirect()->route('send_files')->with('status_1','files sent successfully');
    }
}
