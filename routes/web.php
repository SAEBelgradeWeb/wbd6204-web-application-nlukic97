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


// ----- fix this down
Route::get('/friends', [App\Http\Controllers\UserController::class, 'showUserFriends'])->middleware('auth');
Route::get('/friends/{id}', [App\Http\Controllers\UserController::class, 'showUserFriends'])->middleware('auth');
Route::get('/removeFriend/{id}', [App\Http\Controllers\FriendshipController::class, 'removeFriend'])->middleware('auth');
// ----- fix this up


Route::get('/upload-image', [App\Http\Controllers\UserController::class, 'uploadImagePage'])->middleware('auth');
Route::post('/upload-image', [App\Http\Controllers\UserController::class, 'storeImage'])->middleware('auth');

// event routes
Route::get('/event/{id}',[\App\Http\Controllers\EventController::class,'indexEvent'])->middleware('auth');
Route::get('/create-event',[\App\Http\Controllers\EventController::class,'indexNewEvent'])->middleware('auth');
Route::post('/create-event',[\App\Http\Controllers\EventController::class,'createNewEvent'])->middleware('auth');

// ---------------revisit the join event function
//Route::get('/join-event/{id}',[\App\Http\Controllers\EventController::class,'joinEvent'])->middleware('auth');

Route::get('/leave-event/{id}',[\App\Http\Controllers\EventController::class,'leaveEvent'])->middleware('auth');
Route::get('/cancel-event/{id}',[\App\Http\Controllers\EventController::class,'cancelEvent'])->middleware('auth');


// --- payment
Route::get('/payment/{id}',[\App\Http\Controllers\EventController::class,'showPayment'])->middleware('auth');
Route::get('/pay/{id}',[\App\Http\Controllers\EventController::class,'firstGamePayment'])->middleware('auth');

// ---- Search routes
Route::get('/event-search',[\App\Http\Controllers\EventController::class,'indexSearchPage'])->middleware('auth');
Route::get('/user-search',[\App\Http\Controllers\UserController::class,'indexSearchPage'])->middleware('auth');
