<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function indexNewEvent()
    {
        return view('create-event');
    }

    public function indexEvent($id)
    {
        $event = Event::find($id);
        if($event == null){
            return abort('404');
        }
        $host = $event->host;

        //check game status
            // if game is cancelled
                //if you are a member - display messages but lock them, no button
                //if you are not a member - display 'cancelled' but no messages, no buttons

            //if game is set - do this other stuff:

                //if you have not joined - display page with no messages and 'join' button.

                //if you are admin - display page with 'cancel' option
                //if you are joined in - display page with 'leave' button

        return view('event',compact(['event','host'])); //just returns it as a normal event
    }

    public function createNewEvent(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'date'=>'required',
            'time'=>'required',
            'court_id'=>'required'
        ]);

        $request['status'] = 'pending';
        $request['host_id'] = Auth::user()->id;
        $request['timestamp'] = time();

        $event = Event::create($request->except(['_token','location_id']));
        return redirect("/payment/$event->id");
    }


    public function showPayment($id)
    {
        $event = Event::find($id);
        return view('payment',compact(['event']));
    }


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
}
