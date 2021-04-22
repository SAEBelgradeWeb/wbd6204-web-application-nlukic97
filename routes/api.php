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

Route::middleware('auth:api')->get('/AboutInfo',[\App\Http\Controllers\UserController::class,'getAboutInfo']);
Route::middleware('auth:api')->post('/updateAboutInfo',[\App\Http\Controllers\UserController::class,'updateAboutInfo']);

//updating bio
Route::middleware('auth:api')->post('/updateBio',[\App\Http\Controllers\UserController::class,'updateBio']);

//updating name, username
Route::middleware('auth:api')->post('/accountSettings',[\App\Http\Controllers\UserController::class,'updateAccountData']);
// updating user password
Route::middleware('auth:api')->post('/changePassword',[\App\Http\Controllers\UserController::class,'changePassword']);

//courts
Route::middleware('auth:api')->get('/getCourts/{id}',[\App\Http\Controllers\LocationController::class,'getCourts']);


//Friendship Api routes
Route::middleware('auth:api')->get('/checkNonFriendStatus/{id}',[\App\Http\Controllers\FriendshipController::class,'checkNonFriendStatus']);
Route::middleware('auth:api')->post('/acceptFriendRequest',[\App\Http\Controllers\FriendshipController::class,'acceptFriendRequest']);
Route::middleware('auth:api')->post('/addFriend',[\App\Http\Controllers\FriendshipController::class,'addFriend']);
Route::middleware('auth:api')->post('/cancelFriendRequest',[\App\Http\Controllers\FriendshipController::class,'cancelFriendRequest']);
Route::middleware('auth:api')->post('/rejectFriendRequest',[\App\Http\Controllers\FriendshipController::class,'rejectFriendRequest']);

//search API routes
//Route::middleware('auth:api')->post('/user-search',[\App\Http\Controllers\UserController::class,'searchUsers']);
//Route::middleware('auth:api')->post('/event-search',[\App\Http\Controllers\EventController::class,'searchEvents']);
