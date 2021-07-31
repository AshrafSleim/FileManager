<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});



//Auth::routes();

Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');
Route::get('/register', [App\Http\Controllers\UserController::class, 'showUserRegisterForm'])->name('showUserRegisterForm');
Route::post('/register', [App\Http\Controllers\UserController::class, 'createUser'])->name('UserRegistration');

Route::get('/',  [App\Http\Controllers\UserController::class, 'showUserLoginForm'])->name('login');
Route::post('/login',  [App\Http\Controllers\UserController::class, 'loginUser'])->name('PostUserLogin');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');
    Route::get('/addMainFolder/{IdParentFolder}', [App\Http\Controllers\FolderController::class, 'viewAddFolder'])->name('newMainFolder');
    Route::post('/addMainFolder/{IdParentFolder}', [App\Http\Controllers\FolderController::class, 'submitAddfolder'])->name('addMainFolder');
    Route::get('/showFolder/{folderId}', [App\Http\Controllers\FolderController::class, 'viewFolder'])->name('viewFolder');

    Route::get('/addNewFile/{IdParentFolder}', [App\Http\Controllers\FolderController::class, 'addNewFile'])->name('NewFile');
    Route::post('/addNewFile/{IdParentFolder}', [App\Http\Controllers\FolderController::class, 'submitAddNewFile'])->name('addNewFile');

    Route::get('/downloadFile/{IdFile}', [App\Http\Controllers\FolderController::class, 'downloadFile'])->name('downloadFile');

});
