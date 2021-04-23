<?php

namespace App\Http\Controllers;

use App\Models\FriendshipNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $notifications = FriendshipNotification::where('receiver_id',Auth::user()->id)
            ->orderBy('updated_at','DESC')
            ->get();

        //updating the seen status to true
        $notificationCopy = FriendshipNotification::where('receiver_id',Auth::user()->id)->get();
        foreach ($notificationCopy as $item){
            $item->seen = 1;
            $item->save();
        }


        return view('notifications',compact('notifications'));
    }
}
