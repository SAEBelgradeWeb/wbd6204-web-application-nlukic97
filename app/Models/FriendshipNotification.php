<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendshipNotification extends Model
{
    use HasFactory;

    public $table = 'friendship_notifications';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'type'
    ];

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id','id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id','id');
    }
}
