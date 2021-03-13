<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    public $table = 'friendships';
    public $fillable = ['receiver_id','requester_id','status'];

    //this will return the users who have *received* a request in a given friendship row
    public function usersReceivers()
    {
        return $this->belongsTo(User::class,'receiver_id');
    }
    
    //this will return the users who have sent a *request* in a given friendship row
    public function usersRequesters()
    {
        return $this->belongsTo(User::class,'requester_id');
    }

    public function unfriend($id,$deleterId)
    {
        //checking if the user we want to delete sent us the (approved) friend request
        $friendship = FriendShip::where('requester_id',$id)->where('receiver_id',$deleterId)->first();
        if($friendship === null){ //if this is null, we sent this user the (approved) friend request
            $friendship = FriendShip::where('receiver_id',$id)->where('requester_id',$deleterId)->first();
        }
        if($friendship === null){
            return redirect('/friendlist');
        }

        $friendship->update(['status'=>$this->friendStatuses[3]]);
    }
}
