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
            $user = Auth::user();
            return view('user/auth-user',compact('user')); //return view of other non-friend profile
        } else {
            $user = User::find($id);
            if($user === null){
                return abort(404);
            }


            $friendLink = $user->friends->firstwhere('requester_id',Auth::user()->id);
            if($friendLink === [] OR $friendLink === null){ //means that $user didn't accept any requests from auth
                $friendLink = $user->friends->firstwhere('receiver_id',Auth::user()->id);

                if($friendLink === [] OR $friendLink === null){ // auth user didn't accept requests from $user | they are not friends
                    return view('user/non-friend-user',compact('user')); //return view of other non-friend profile
                }
            }
            return view('user/friend-user',compact('user')); //return view of other non-friend profile



        }
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


    //user search
    public function indexSearchPage()
    {
        return view('/search/user-search');
    }
}
