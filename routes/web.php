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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/my_account', [App\Http\Controllers\HomeController::class, 'getAccountData'])->name('my-account');

// Route::get('/friends', [App\Http\Controllers\HomeController::class, 'showUserFriends']); //return to this later
Route::get('/friends/{id}', [App\Http\Controllers\UserController::class, 'showUserFriends']);
