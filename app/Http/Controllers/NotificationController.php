<?php

namespace App\Http\Controllers;

use App\Models\FriendshipNotification;
use App\Models\MessageNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $notifications = collect();

        // 1 - friendship notifications

        $friendNotifications = FriendshipNotification::where('receiver_id',Auth::user()->id)->get();
        //these two loops are needed. The first collection is to be displayed to the user upon load
        foreach ($friendNotifications as $item){
            $notifications->add($item); //adding any existing notification to collection
        }

            // ... this second loop changes the status of 'seen' in the database to true for all these notifications.
        //a new variable is required, using the original will also copact the notifications with the new values
        $friendNotifCopy = FriendshipNotification::where('receiver_id',Auth::user()->id)->get();
        foreach ($friendNotifCopy as $item){
            $item->seen = 1;
            $item->save();
        }

        // 2 - message notifications

        $msgNotifications = MessageNotification::where('receiver_id',Auth::user()->id)->get();
        foreach ($msgNotifications as $item){
            $notifications->add($item);//adding any existing notification to collection
        }

        $msgNotificationsCopy = MessageNotification::where('receiver_id',Auth::user()->id)->get();
        foreach ($msgNotificationsCopy as $item){
            $item->seen = 1;
            $item->save();
        }


        // 3 - event notifications   ---- still to be made
        /*$eventNotifications = MessageNotification::where('receiver_id',Auth::user()->id)
            ->orderBy('updated_at','DESC')
            ->get();

        $msgCopy = FriendshipNotification::where('receiver_id',Auth::user()->id)->get();
        foreach ($msgCopy as $item){
            $item->seen = 1;
            $item->save();
        }*/
        return view('notifications',compact('notifications'));
    }
}
