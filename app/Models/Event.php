<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'date',
        'time',
        'host_id',
        'court_id',
        'player_num',
        'timestamp'
    ];

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
