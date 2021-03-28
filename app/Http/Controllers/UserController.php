<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth'); //this is all you need to authenticate.
    }

    protected function index()
    {
        $user = User::find(Auth::user()->id);
        return view('user-index',compact('user'));
//        return view('user-index');
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
    public function updateAboutInfo(Request $request)
    {
        $request->validate([
            'age' => 'required|integer',
            'sex' => 'required|string|in:male,female',
            'location_id' => 'required|integer|exists:locations,id'
        ]);

        $id = $request->all()['user_id'];
        $user = User::find($id);
        $user->update($request->except('userId'));
        return 'Data successfully updated';
    }
}
