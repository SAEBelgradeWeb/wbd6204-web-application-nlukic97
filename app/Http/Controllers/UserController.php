<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    protected function getAccountData()
    {
        $user = User::find(Auth::user()->id);
        return view('my_account',compact('user'));
    }

    public function editAccountData()
    {
        $user = User::find(Auth::user()->id);
        return view('editAccountData',compact('user'));
    }

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
