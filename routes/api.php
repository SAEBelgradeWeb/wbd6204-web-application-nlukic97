<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//used to display the locations available for users to edit in the 'update about me' modal (AboutProfileModal.vue)
Route::middleware('auth:api')->get('/getLocations',[\App\Http\Controllers\LocationController::class,'index']);

Route::middleware('auth:api')->post('/updateAboutInfo',[\App\Http\Controllers\UserController::class,'updateAboutInfo']);
Route::middleware('auth:api')->get('/AboutInfo',[\App\Http\Controllers\UserController::class,'getAboutInfo']);

//updating bio
Route::middleware('auth:api')->post('/updateBio',[\App\Http\Controllers\UserController::class,'updateBio']);
