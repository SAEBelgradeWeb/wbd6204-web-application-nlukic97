<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{

    //utility method: finds a row in the Friendship table with status 'accepted'
    public function acceptedStatusRow($id)
    {
        $friend = Auth::user()->friends->firstwhere('receiver_id',$id);
        if($friend == null){
            $friend = Auth::user()->friends->firstwhere('requester_id',$id);
        }
        return $friend;
    }



    //Utility method: finds a row in the Friendship table -regardless of its status-
    public function findRow($id)
    {
        $row = Friendship::where('requester_id',Auth::user()->id)->where('receiver_id',$id)->first();
        if($row == null){
            $row = Friendship::where('requester_id',$id)->where('receiver_id',Auth::user()->id)->first();
        }
        return $row;
    }



    public function checkNonFriendStatus($id) //fix this function up
    {
        // if auth user sent the request to user of id $id
        $friendship = Friendship::where('requester_id',Auth::user()->id)->where('receiver_id',$id)->first();

        if($friendship != null){
            $status = $friendship->status;
            if($status === 'pending'){
                return json_encode(['button'=>'cancel']);
            }
        } else {
            //If auth user received the friend request from a user with id of $id
            $friendship = Friendship::where('requester_id',$id)->where('receiver_id',Auth::user()->id)->first();
            if($friendship != null){
                $status = $friendship->status;

                if($status === 'pending'){
                    return json_encode(['button'=>'accept']);
                }
            } else {
                return json_encode(['button'=>'add']);
            }
        }
    }



    public function addFriend(Request $request)
    {
        $request->validate([
            'userId'=>'required|integer'
        ]);

        $id = $request->all()['userId'];

        $row = $this->findRow($id);

        if($row != null){
            $row->status ='pending';
            $row->save();

        } else {
            Friendship::create([
                'requester_id'=>Auth::user()->id,
                'receiver_id'=> $id,
                'status'=>'pending'
            ]);
        }
    }



    public function removeFriend($id){
        $friend = $this->acceptedStatusRow($id); //calling a method within the friendship controller using $this

        if($friend != null){
            $friend->delete(); //change to cancelled later
        }

        return redirect("/user/{$id}");
    }



    public function acceptFriendRequest(Request $request){
        $request->validate([
            'userId'=>'required|integer'
        ]);
        $id = $request->all()['userId'];

        $friendship = Friendship::where('receiver_id',Auth::user()->id)->where('requester_id',$id)->first();
        $friendship->status = 'accepted';
        $friendship->save();
    }



    public function cancelFriendRequest(Request $request){
        $request->validate([
            'userId'=>'required|integer'
        ]);
        $id = $request->all()['userId'];
        $this->findRow($id)->delete(); //change to cancelled later
    }


    public function rejectFriendRequest(Request $request)
    {
        $request->validate([
            'userId'=>'required|integer'
        ]);
        $id = $request->all()['userId'];
        $row = $this->findRow($id);
        $row->delete();
    }
}
