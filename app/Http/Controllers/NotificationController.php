<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventNotification;
use App\Models\FriendshipNotification;
use App\Models\MessageNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $unsortedNotifications = collect();

        // 1 ----------------------------- friendship notifications----------------------------
        $friendNotifications = FriendshipNotification::where('receiver_id',Auth::user()->id)->get();
        //these two loops are needed. The first collection is to be displayed to the user upon load
        foreach ($friendNotifications as $item){
            $unsortedNotifications->add($item); //adding any existing notification to collection
        }

            // ... this second loop changes the status of 'seen' in the database to true for all these notifications.
        //a new variable is required, using the original will also copact the notifications with the new values
        $friendNotifCopy = FriendshipNotification::where('receiver_id',Auth::user()->id)->get();
        foreach ($friendNotifCopy as $item){
            $item->seen = 1;
            $item->save();
        }

        // 2 ----------------------------- message notifications----------------------------
        $msgNotifications = MessageNotification::where('receiver_id',Auth::user()->id)->get();
        foreach ($msgNotifications as $item){
            $unsortedNotifications->add($item);//adding any existing notification to collection
        }

        $msgNotificationsCopy = MessageNotification::where('receiver_id',Auth::user()->id)->get();
        foreach ($msgNotificationsCopy as $item){
            $item->seen = 1;
            $item->save();
        }


        // 3 ----------------------------- event notifications----------------------------
        $eventNotifications = EventNotification::where('receiver_id',Auth::user()->id)->get();
        foreach ($eventNotifications as $item){
            $unsortedNotifications->add($item); //adding any existing notification to collection
        }

        $eventNotificationsCopy = EventNotification::where('receiver_id',Auth::user()->id)->get();
        foreach ($eventNotificationsCopy as $item){
            $item->seen = 1;
            $item->save();
        }


        $notifications = $unsortedNotifications->sortByDesc('created_at');
        return view('notifications',compact('notifications'));
    }
}
