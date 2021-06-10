<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use App\Models\Message;
use App\Models\MessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request){
        $request->validate([
            'message'=>'required|string|max:255',
            'event_id'=>'required|integer|exists:events,id'
        ]);

        $data = $request->only('message','event_id');
        $userId = Auth::user()->id;

        $eventUserRow = EventUser::where('event_id',$data['event_id'])->where('user_id',$userId)->get();

        if(count($eventUserRow) === 0){ //so is
            return abort(500,'The user is not a member of this game');
        }

        Message::create([
            'user_id'=>Auth::user()->id,
            'event_id'=>$data['event_id'],
            'message'=>$data['message']
        ]);

        $users =  Event::find($data['event_id'])->users;
        foreach ($users as $user){
            if($user->id != Auth::user()->id){ //the user who sent the message will not receive a notification
                MessageNotification::create([
                    'receiver_id'=>$user->id,
                    'sender_id'=>Auth::user()->id,
                    'event_id'=>$data['event_id'],
                    'seen'=>0
                ]);
            }
        }

        //inform other members there is a new message
        return 'reload';
    }
}
