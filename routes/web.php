<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testm;
use App\Http\Controllers\sendEmail;
use App\Http\Controllers\posts;
use App\Http\Controllers\comment;
use App\Models\User;
use App\Http\Controllers\Auth\ForgotPasswordController;



Route::get('/', function () {
    return view('welcome');
});

Route::view('register','new/register');
Route::post('register',[testm::class,'register']);

Route::get('login', [testm::class,'login'] )->middleware('test');
Route::post('login', [testm::class,'sign'] );

Route::get('home', [testm::class,'home'] )->middleware('test2');

Route::view('add', 'new/add' )->middleware('test2');

Route::post('add', [testm::class,'add'] );

Route::get('logout', [testm::class,'signout'] );

Route::post('delete', [testm::class,'delete'] );

/////////////////////////////////////////////////////////////////////


Route::view('forgot_password', 'new/forgot' );

Route::post('forgot_password',[sendEmail::class,'send'] );


Route::get('reset/password/{token}',[sendEmail::class,'reset_form'] )->name('password.reset');

Route::post('reset/password',[sendEmail::class,'reset'] );


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//////////////////////////// social ////////////////////////////////////

route::group(['middleware'=>'social'],function(){
route::get('social/home',[posts::class,'main']);
route::post('social/home',[posts::class,'add']);
route::post('social/add_comment',[comment::class , 'add']);
route::get('social/myinfo',[posts::class,'profile']);
});

route::group(['middleware'=>'admin'],function(){
route::view('social/login','social/login');
route::post('social/login',[posts::class,'login']);

route::view('social/register','social/register');
route::post('social/register',[posts::class,'register']);
});

route::get('social/logout',[posts::class,'logout']);



