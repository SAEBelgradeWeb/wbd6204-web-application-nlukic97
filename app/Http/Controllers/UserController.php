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


    protected function index($id)
    {
        if(Auth::user()->id == $id){
            $user = User::find(Auth::user()->id);
            $pageOwner = true;
        } else {
            $user = User::find($id);
            if($user === null){
                return abort(404);
            }
            $pageOwner = false;
        }
            return view('user-index',compact(['user','pageOwner']));
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
            'oldPass'=>'required|string|min:8|password:api',
            'password'=>'required|string|min:8|confirmed',
        ]);

        $user = User::find(Auth::user()->id);

        $user->password = Hash::make($request->all()['password']);
        $user->save();
    }


    //uploading the avatar
    public function uploadImagePage(){
        return view('upload-image');
    }


    public function storeImage(Request $request){
        $request->validate([
            'avatar'=>'required|image'
        ]);

        $path = $request->file('avatar')->store('public/avatars');
        $imageName = str_replace('public/avatars/','',$path);

        $user = User::find(Auth::user()->id);

        if($user->image_url != '' OR $user->image_url != null){ //deletes the old profile image
            unlink(getcwd()."\\storage\\avatars\\".$user->image_url); //check if this executes properly on the server
        }

        $user->image_url = $imageName;
        $user->save();

        return redirect("/user/".Auth::user()->id);
    }
}
