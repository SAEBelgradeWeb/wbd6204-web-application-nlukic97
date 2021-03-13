<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUserFriends($id)
    {
        // $user = User::find(Auth::user()->id);
        if(Auth::user() === null){
            return redirect('/login');
        }
        $user = User::find($id);
        $friends = $user->friends;

        return view('friends',compact(['friends']));
    }
}
