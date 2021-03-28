<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //this is all you need to authenticate.
    }

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
        $user = User::find(Auth::user()->id);
        $friends = $user->friends;

        return view('friends',compact('friends'));
    }

    //if user edits their data (exclusing password, the method called shall be this one
    public function update($data)
    {
        return $data;
    }

    public function testBranchSaving()
    {
        dd('nice day today');
    }
}
