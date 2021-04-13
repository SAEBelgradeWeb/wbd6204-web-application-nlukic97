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


Auth::routes();

Route::get('/home', function(){ //remove this later on, check if it is referenced anywhere
    return redirect('/');
});

//user routes
Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->middleware('auth');
Route::get('/account-settings', [App\Http\Controllers\UserController::class, 'getAccountData'])->name('account-settings')->middleware('auth');

Route::get('/user/{id}',[App\Http\Controllers\UserController::class,'index'])->middleware('auth');

Route::get('/friends', [App\Http\Controllers\UserController::class, 'showUserFriends'])->middleware('auth');
        //this underneath needs to be fixed
Route::get('/friends/{id}', [App\Http\Controllers\UserController::class, 'showUserFriends'])->middleware('auth');

Route::get('/upload-image', [App\Http\Controllers\UserController::class, 'uploadImagePage'])->middleware('auth');
Route::post('/upload-image', [App\Http\Controllers\UserController::class, 'storeImage'])->middleware('auth');

//home routes
Route::get('/create-event',[\App\Http\Controllers\HomeController::class,'indexNewEvent'])->middleware('auth');
Route::post('/create-event',[\App\Http\Controllers\HomeController::class,'createNewEvent'])->middleware('auth');

// --- payment
Route::get('/payment/{id}',[\App\Http\Controllers\HomeController::class,'showPayment'])->middleware('auth');
Route::get('/pay/{id}',[\App\Http\Controllers\EventController::class,'firstGamePayment'])->middleware('auth');


