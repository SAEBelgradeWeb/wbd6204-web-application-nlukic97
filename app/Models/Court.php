<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    protected $fillable = ['title','address','price','court_id'];


    public function location()
    {
        return $this->belongsTo(Location::class);
    }


    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
