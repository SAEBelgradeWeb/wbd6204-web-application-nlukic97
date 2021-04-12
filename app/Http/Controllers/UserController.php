<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    //if user edits their data (excluding password), the method called shall be this one
    public function updateAboutInfo(Request $request)
    {
        $request->validate([
            'age' => 'required|integer|max:130',
            'sex' => 'required|string|in:male,female',
            'location_id' => 'required|integer|exists:locations,id'
        ]);

        User::find(Auth::user()->id)->update($request->only(['age','sex','location_id']));
        return 'Data successfully updated';
    }

    public function updateBio(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string|max:255',
        ]);

        $user = User::find(Auth::user()->id);

        $user->update($request->only('bio'));
        return $user->bio;
    }

    public function updateAccountData(Request $request)
    {
        $request->validate([
            'name'=>'string|max:255',
            'username'=>'string|unique:users|max:255'
        ]);

        User::find(Auth::user()->id)->update($request->only(['name','username']));

        return $request->all();
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'oldPass'=>'required|string',
            'newPass'=>'required|string',
            'confirmNewPass'=>'required|string'
        ]);

        $user = User::find(Auth::user()->id);
        if(!Hash::check($request->only('oldPass')['oldPass'],$user->password)){
            return 'Server says: Current password entered incorrectly.';
        }

        if(!($request->all()['newPass'] === $request->all()['confirmNewPass'])){
            return 'Server says: The new passwords do not match';
        }

        $user->password = Hash::make($request->only('confirmNewPass')['confirmNewPass']);
        $user->save();
    }

    public function showUser($id){
        if($id == Auth::user()->id){
            return redirect('/myAccount');
        } else {
            $user = User::find($id);
            return view('show-user',compact('user'));
        }
    }


    //uploading the avatar
    public function uploadImagePage(){
        return view('upload-image');
    }

    public function storeImage(Request $request){
        dd($request->all());
    }
}
