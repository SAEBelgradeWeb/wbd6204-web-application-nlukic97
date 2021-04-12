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

//user routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');;
Route::get('/myAccount', [App\Http\Controllers\UserController::class, 'index'])->name('myAccount')->middleware('auth');
Route::get('/account-settings', [App\Http\Controllers\UserController::class, 'getAccountData'])->name('account-settings')->middleware('auth');
//Route::get('/editAccountData', [App\Http\Controllers\UserController::class, 'editAccountData'])->name('editAccountData')->middleware('auth');; //fix the naming for the method


 Route::get('/friends', [App\Http\Controllers\UserController::class, 'showUserFriends'])->middleware('auth');; //return to this later
Route::get('/friends/{id}', [App\Http\Controllers\UserController::class, 'showUserFriends'])->middleware('auth');;
