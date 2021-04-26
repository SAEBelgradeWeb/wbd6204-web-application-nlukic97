<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class ImageUploadController extends Controller
{
    //getting the upload page
    public function uploadImagePage(){
        return view('upload-image');
    }


    //storing and resizing (fit) the avatar
    public function storeImage(Request $request){
        $request->validate([
            'avatar'=>'required|image'
        ]);

        $path = $request->file('avatar')->store('public/avatars');
        $imageName = str_replace('public/avatars/','',$path);

        //changing the size of the image to be 300 x 300 -> fit, not resize.
        $image = Image::make(getcwd()."/storage/avatars/".$imageName)
            ->orientate()
            ->fit(300,300, function ($constraint) {
                $constraint->upsize();
            }); //the image will not be rotated if its height is much larger than the width
        $image->save();

        //saving the image name to the users table
        $user = User::find(Auth::user()->id);

        //deleting the old profile picture
        $deleteImagePath = getcwd()."\\storage\\avatars\\".$user->image_url;
        if($user->image_url != '' OR $user->image_url != null){ //delete old profile picture
            if(file_exists($deleteImagePath)){
                unlink($deleteImagePath); //check if this executes properly on the server
            }
        }

        //storing the new picture name to the database
        $user->image_url = $imageName;
        $user->save();

        return redirect("/user/".Auth::user()->id);
    }
}
