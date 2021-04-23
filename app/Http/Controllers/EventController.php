<?php

namespace App\Http\Controllers;

use App\Models\Court;
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
//        dd($event);
        if($event == null){
            return abort('404');
        }

        //safety precaution
        if($event->host === null || $event->status === 'pending'){
//            dd('Error, no host. just in case a game is seeded that does not have a host, or the host in not joined the game. Change seeder'); //just in case a game is seeded that does not have a host.
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
        if($event === null){
            return abort('404');
        }

        // when admin is paying (game is still pending, not viewable by other users)
        if($event->host_id == Auth::user()->id
            AND $event->status === 'pending'){
            $event->status = 'created';
            $event->save();

            EventUser::create([
                'user_id'=>Auth::user()->id,
                'event_id'=>$event->id
            ]);

            // another user can join a game with: status 'created', and that is not full
        } else if($event->status === 'created'
            AND count($event->users) < $event->player_num
            AND !$event->users->firstwhere('id',Auth::user()->id)
        ) {
            EventUser::create([
                'user_id'=>Auth::user()->id,
                'event_id'=>$event->id
            ]);
        }
        return redirect("/event/{$id}");
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


    public function leaveEvent($id) //handle refunds ???
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

    public function cancelEvent($id) //handling multiple refunds
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

    //event search
    public function indexSearchPage()
    {
        return view('search/event-search');
    }


    //Event filtering
    public function searchEvents(Request $request)
    {
        //option 1 - this means the user selected 'all'
        if($request->all()['id'] === 0){
            $events = Event::where('status','created')
                ->orderBy('date','ASC')
                ->orderBy('time','ASC')
                ->get();
            foreach ($events as $event){
                $event['location'] = $event->court->location;
                $event['court'] = $event->court;
            }
            return $events;

        } else { //option 2 - this means the user has selected a specific location id
            $request->validate([
                'id'=>'required|integer|exists:locations,id'
            ]);

            $filteredEvents = [];

            $id = $request->all()['id'];
            $courts = Court::where('location_id',$id)->get(); //find the courts that have the selected location

            foreach ($courts as $court){ //one location(city) can have many courts, so we loop through each
                foreach ($court->events as $event){ //and one court has many events
                    if($event['status'] === 'created'){
                        $event['location']= $court->location; //adding the location to the data
                        $event['court'] = $court->toArray(); //adding the court data to the post
                        array_push($filteredEvents,$event); //and we add each to the array
                    }
                }
            }

            //comparing the time and date of the posts together. The smallest one (soonest game) will be shown first.
            if($filteredEvents != null){
                usort($filteredEvents,function($a,$b){
                    return strcmp($a['date'].$a['time'],$b['date'].$b['time']);
                });
            }

            return $filteredEvents;
        }

    }




}
