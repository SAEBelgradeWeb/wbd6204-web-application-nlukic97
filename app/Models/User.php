<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'sex',
        'location_id',
        'username',
        'image_url',
        'bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function location(){
        return $this->belongsTo(Location::class);
    }


    //----- friendship handling -----
    public function friendshipsSent()
    {
        return $this->hasMany(Friendship::class,'requester_id','id');
    }

    public function friendshipsReceived()
    {
        return $this->hasMany(Friendship::class,'receiver_id','id');
    }

    //getting friendlist - updated function
    public function getFriendsAttribute()
    {
        $friendlist = [];

        $sentRequests =  $this->friendshipsSent->where('status','accepted');
        foreach ($sentRequests as $key => $friendship) {
            array_push($friendlist,$friendship->usersReceivers);
        }

        $receivedRequests =  $this->friendshipsReceived->where('status','accepted');
        foreach ($receivedRequests as $key => $friendship) {
            array_push($friendlist,$friendship->usersRequesters);
        }

        return $friendlist;
    }
}
