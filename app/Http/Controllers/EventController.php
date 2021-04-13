<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function firstGamePayment($id)
    {
        $event = Event::find($id);
        $event->status = 'created';
        $event->save();

        EventUser::create([
            'user_id'=>Auth::user()->id,
            'event_id'=>$event->id
        ]);

        return redirect('/');
    }
}
