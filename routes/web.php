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

Route::get('/', function () {
    return view('index');
});

Route::get('/login',[App\Http\Controllers\CustomAuthController::class,'login'])->middleware('alreadyLoggedIn');
Route::get('/register',[App\Http\Controllers\CustomAuthController::class,'register'])->middleware('alreadyLoggedIn');
Route::post('/registration',[App\Http\Controllers\CustomAuthController::class,'registration'])->name('registration');
Route::post('/login-user',[App\Http\Controllers\CustomAuthController::class,'loginUser'])->name('login-user');
Route::get('/homepage',[App\Http\Controllers\CustomAuthController::class,'homepage'])->middleware('isLogedin');
Route::get('/settings',[App\Http\Controllers\CustomAuthController::class,'settings'])->middleware('isLogedin');
Route::post('/change-email',[App\Http\Controllers\CustomAuthController::class,'changeEmail'])->name('change-email');
Route::post('/change-password',[App\Http\Controllers\CustomAuthController::class,'changePass'])->name('change-password');
Route::post('/change-username',[App\Http\Controllers\CustomAuthController::class,'changeUser'])->name('change-username');
Route::post('/save-posts',[App\Http\Controllers\PostControlller::class, 'savePosts'])->name('save-posts');
Route::post('/delete/{id}/post',[App\Http\Controllers\PostControlller::class, 'deletePost'])->name('delete.post');
Route::post('/image-upload', [App\Http\Controllers\CustomAuthController::class, 'uploadImage'])->name('image-upload');
Route::get('/logout',[App\Http\Controllers\CustomAuthController::class,'logout']);
