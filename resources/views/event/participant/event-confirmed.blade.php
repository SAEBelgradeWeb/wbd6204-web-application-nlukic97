@extends('layouts.app')

@section('content') {{-- Make something that checks if you are the admin of the game, if not are you in the game. If not, can you join the game--}}
<div class="container">
    <h1 class="text-center text-success">Hey participant - Event confirmed</h1>
    <h2 class="text-center text-primary">You can see the chat, and can message. Can't join, can't leave</h2>

    <event-info
        event="{{$event}}"
        court="{{$event->court}}"
        city="{{$event->court->location->city}}"
        host="{{$event->host}}"
    >
        <event-messages
            prop_messages="{{$event->messages}}"
            prop_users="{{$event->users}}"
        ></event-messages>
    </event-info>
</div>
@endsection
