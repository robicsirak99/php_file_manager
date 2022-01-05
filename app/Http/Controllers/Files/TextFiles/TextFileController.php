<?php

namespace App\Http\Controllers\Files\TextFiles;

use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TextFileController extends Controller
{
    //only authenticated users can reach the create text file page
    public function __construct()
    {
        $this -> middleware(['auth']);
    }

    //display the view of the create file page
    public function indexOfCreate()
    {
        return view('text_file.create_text_file');
    }

    //display the view of the edit file page
    public function indexOfEdit(File $file)
    {
        //get the file content
        $fileContent = Storage::disk('public')->get('uploads/' . $file->file_name);

        //send file name and content to view
        return view('text_file.edit_text_file', [
            'file_name' => $file->file_name,
            'file_content' => $fileContent
        ]);
    }

    //upload a file from the create file page
    public function upload(Request $request)
    {
        //validate
        $this->validate($request, [
            'name'=>'required',
            'body'=>'required'
        ]); 

        //store new file
        $storing_id = uniqid();

        $new_file = $storing_id.$request->name.'.txt';
        Storage::disk('public')->put('/uploads/' . $new_file, $request->body);

        $file_size = Storage::disk('public')->size('/uploads/' . $new_file);
        $file_path = 'app/public/uploads/' .  $new_file;

        auth()->user()->files()->create([
            'storing_id' => $storing_id,
            'file_name' => $new_file,
            'file_path' => $file_path,
            'file_size' => $file_size
        ]);

        //redirect
        return redirect()->route('files');
    }

    //update a file from the edit file page
    public function update(Request $request)
    {
        //update file in the public storage
        Storage::disk('public')->delete('/uploads/' . $request->name);
        Storage::disk('public')->put('/uploads/' . $request->name, $request->body);

        $file_size = Storage::disk('public')->size('/uploads/' . $request->name);

        //update file in the database
        File::where('file_name', $request->name)->update(['file_size' => $file_size]);

        //redirect
        return redirect()->route('files');
    }
}
