<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    protected function index()
    {
        $user = User::find(Auth::user()->id);
        return view('user-index',compact('user'));
    }

    public function getAccountData()
    {
        $user = User::find(Auth::user()->id);
        return view('account-settings',compact('user'));
    }

    public function showUserFriends()
    {

        if(Auth::user() === null){
            return redirect('/login');
        }

        $user = User::find(Auth::user()->id);
        $friends = $user->friends;

        return view('friends',compact('friends'));
    }
}
