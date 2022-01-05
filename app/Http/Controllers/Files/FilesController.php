<?php

namespace App\Http\Controllers\Files;

use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    //total number of pages needed to display all the files
    public $total_pages;

    //currently displayed page of files
    public $current_page;

    //how many files are displayed in a single file page
    public $files_per_page;

    //search bar text
    public $searching_for;

    public function __construct()
    {
        $this -> total_pages = 0;
        $this -> current_page = 0;
        $this -> files_per_page = 5;
        $this -> searching_for = "";

        //only authenticated users can reach the files page
        $this -> middleware(['auth']);
    }

    //search in files (search bar)
    public function searchInFiles($files, $string){
        $this->searching_for = $string;

        $new_file_collection = collect();

        foreach($files as $file){
            $file_name = substr($file->file_name,13);
            if(str_contains($file_name,$string)){
                $new_file_collection->push($file);
            }
        }

        return $new_file_collection;
    }

    //choose the files needed to display for the next page (next page button)
    public function pickTheNextFilesToDisplay($files, Request $request){
        if($request->current_page + 1 == $this->total_pages){
            $this->current_page = 0;
        } else {
            $this->current_page = $request->current_page + 1;
        }
        return $files->slice($this->current_page * $this-> files_per_page, $this->files_per_page);
    }

    //choose the files needed to display for the previous page (previous page button)
    public function pickThePreviousFilesToDisplay($files, Request $request){
        if($request->current_page == 0){
            $this->current_page = $this->total_pages-1;
        } else {
            $this->current_page = $request->current_page - 1;
        }
        return $files->slice($this->current_page * $this-> files_per_page, $this->files_per_page);
    }

    //display the view of the files page
    public function index(Request $request)
    {
        //sort the files
        if(isset($request->sort_by_date)){
            $files = auth()->user()->files()->orderBy('updated_at', 'ASC')->get();
        } else {
            $files = auth()->user()->files()->orderBy('file_name', 'ASC')->get();
        }

        //choose the files needed to display if the search bar has data in it
        if(isset($request->string)){
            $files = $this->searchInFiles($files, $request->string);
        }

        //total number of pages needed to display all the files
        $this->total_pages = ceil($files->count()/$this->files_per_page);

        //choose the files needed to display for the next page
        if(isset($request->next)){
            $files = $this->pickTheNextFilesToDisplay($files, $request);
        }
        //choose the files needed to display for theprevious page
        elseif(isset($request->previous)){
            $files = $this->pickThePreviousFilesToDisplay($files, $request);
        } else {
            $files = $files->slice($this->current_page * $this-> files_per_page, $this->files_per_page);
        }

        //return view with data
        return view('files.files', [
            'files' => $files,
            'current_page' => $this->current_page,
            'total_pages' => $this->total_pages,
            'searching_for' => $this->searching_for
        ]);
    }

    //upload a file
    public function upload(Request $request)
    {
        //validate
        $this->validate($request, [
            'file'=>'required'
        ]);

        $storing_id = uniqid();

        $file_name = $storing_id.$request->file('file')->getClientOriginalName();
        $file_path = 'app/public/' . $request->file('file')->storeAs('uploads', $file_name, 'public');
        $file_size = $request->file('file')->getSize();

        //upload
        auth()->user()->files()->create([
            'storing_id'=>$storing_id,
            'file_name' => $file_name,
            'file_path' => $file_path,
            'file_size' => $file_size
        ]);
        
        //redirect
        return redirect()->route('files');
    }

    //delete a file
    public function destroy(File $file)
    {
        Storage::disk('public')->delete('/uploads/' . $file->file_name);
        $file->delete();
        return back();
    }

    //download a file
    public function download(File $file)
    {
        $path_to_file = storage_path($file->file_path);
        return response()->download($path_to_file);
    }
}
