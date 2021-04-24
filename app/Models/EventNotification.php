<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventNotification extends Model
{
    use HasFactory;

    public $table = 'event_notifications';

    protected $fillable = [
        'receiver_id',
        'event_id',
        'type',
        'source'
    ];

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id','id');
    }
}
