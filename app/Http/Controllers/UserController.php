<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUserFriends($id)
    {
        // $user = User::find(Auth::user()->id);
        $user = User::find($id);
        $friends = $user->friends;

        dd($friends);
        return view('friends',compact(['friends']));
    }
}
