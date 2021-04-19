<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use App\Models\User;
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

        //safety precaution
        if($event->host === null || $event->status === 'pending'){
            dd('Error, no host. just in case a game is seeded that does not have a host, or the host in not joined the game. Change seeder'); //just in case a game is seeded that does not have a host.
            return abort('404');
        }


        // 1. If user has already joined the event...
        if($event->users->firstwhere('id',Auth::user()->id)){

            if($event->status === 'cancelled'){
                return view('/event/participant/event-cancelled',compact('event'));

            } else if($event->status == 'confirmed'){ //if joined game is confirmed (for admin and other users)
                return view('/event/participant/event-confirmed',compact('event'));

            } else if($event->host->id === Auth::user()->id){ //if you are the admin
                return view('/event/participant/event-admin',compact('event'));

            } else { //if user is not admin
                return view('/event/participant/event',compact('event'));
            }

        } else { //2. If user has not joined an event (meaning they are not the admin).
            if($event->status === 'cancelled'){ // if the game is cancelled
                return view('/event/non-participant/event-cancelled',compact('event'));

            } else if($event->status == 'confirmed'){ //if the game is confirmed
                return view('event/non-participant/event-confirmed',compact('event'));

            } else if(count($event->users) >= $event->player_num){ //if the game is already full
                return view('event/non-participant/event-full',compact('event'));

            } else { // in this case, a user can join this event
                return view('event/non-participant/event',compact('event'));
            }
        }

//        return view('event/event',compact('event')); //just returns it as a normal event
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

    public function joinEvent($id)
    {
        $event = Event::find($id);

        //if event exists, is not full, and you have not already joined
        if($event != null
            AND count($event->users) < $event->player_num
            AND !$event->users->firstwhere('id',Auth::user()->id) ){

            EventUser::create([
                'event_id'=>$id,
                'user_id'=>Auth::user()->id
            ]);
        }
        return redirect("/event/{$id}");
    }


    public function leaveEvent($id)
    {
        $event = Event::find($id);

        //if the event exist, and it's status is 'created', and the user is already in the game,
        // and if admin has entered the leave-event/{id} - a host can't leave, but only cancel their game.
        if($event != null
            AND $event->status === 'created'
            AND $event->users->firstwhere('id',Auth::user()->id)
            AND $event->host_id != Auth::user()->id)
        {
            $eventUser = EventUser::where('event_id',$id)
                ->where('user_id',Auth::user()->id)
                ->first();

            $eventUser->delete();
        }
        return redirect("/event/{$id}");
    }

    public function cancelEvent($id)
    {
        $event = Event::find($id);

        // conditions: event exists, user is the host,
        // and the game has status of 'created' --> which can still be cancelled
        if( $event != null
            AND $event->host_id == Auth::user()->id
            AND $event->status == 'created')
        {
            $event->update([
                'status'=>'cancelled'
            ]);

        }

        return redirect("/event/{$id}");
    }
}
