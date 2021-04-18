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
            if($event->status === 'cancelled'){ // 1a. if joined event is cancelled
                return view('/event/participant/event-cancelled',compact('event'));

            } else { // 1b. if joined event is not cancelled...
                if($event->host->id === Auth::user()->id){ // 1ba - if you are the admin
                    return view('/event/participant/event-admin',compact('event'));

                } else { // 1bb  - or you are not the admin:
                    return view('/event/participant/event',compact('event'));
                }
            }

        //2. or if they haven't joined the game yet
        } else {
//            dd('you have not joined this game');
            if($event->status === 'cancelled'){ // 1a. ... and if event is cancelled
//                dd('game you haven\'t joined is cancelled');
                return view('/event/non-participant/event-cancelled',compact('event'));

            } else if($event->status === 'confirmed') {
//                dd('this game is confirmed, no joining');
                return view('event/non-participant/event-confirmed',compact('event'));
            } else if(count($event->users) === $event->player_num){ //game is full, no joining
                return view('event/non-participant/event-full',compact('event'));
//                dd('this game is full.');
            } else {
                return view('event/non-participant/event',compact('event'));
//                dd('game not full, you can join');
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
}
