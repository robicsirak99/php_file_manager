<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Files\FilesController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Files\SendFilesController;
use App\Http\Controllers\Profile\ChangeUsernameController;
use App\Http\Controllers\Profile\ChnagePasswordController;
use App\Http\Controllers\Files\TextFiles\TextFileController;


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/change_password', [ChnagePasswordController::class, 'index'])->name('change_password');
Route::post('/change_password', [ChnagePasswordController::class, 'store']);

Route::get('/change_username', [ChangeUsernameController::class, 'index'])->name('change_username');
Route::post('/change_username', [ChangeUsernameController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/files', [FilesController::class, 'index'])->name('files');
Route::post('/files', [FilesController::class, 'upload']);
Route::delete('/files/{file}', [FilesController::class, 'destroy'])->name('files.destroy');
Route::get('/files/{file}', [FilesController::class, 'download'])->name('files.download');

Route::get('/send_files', [SendFilesController::class, 'index'])->name('send_files');
Route::post('/send_files', [SendFilesController::class, 'send']);

Route::get('/create_text_file', [TextFileController::class, 'indexOfCreate'])->name('show_index_of_create_text_file');
Route::get('/edit_text_file/{file}', [TextFileController::class, 'indexOfEdit'])->name('show_index_of_edit_text_file');
Route::post('/create_text_file', [TextFileController::class, 'upload'])->name('save_created_text_file');
Route::post('/edit_text_file', [TextFileController::class, 'update'])->name('save_edited_text_file');

Route::get('/home', function(){
    return view('home.home');
})->name('home');


