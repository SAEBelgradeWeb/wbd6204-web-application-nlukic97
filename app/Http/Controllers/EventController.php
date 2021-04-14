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
        //check if the event host id matches the authenticated id. Also, if the game
        // has already be confirmed, do divert them away from here to the regular payment section.
        $event = Event::find($id);
        $event->status = 'created';
        $event->save();

        EventUser::create([
            'user_id'=>Auth::user()->id,
            'event_id'=>$event->id
        ]);

        return redirect('/');
    }


    public function indexEvent($id)
    {
        $event = Event::find($id);
        if($event == null){
            return abort('404');
        }
        return view('event',compact('event'));
    }
}
