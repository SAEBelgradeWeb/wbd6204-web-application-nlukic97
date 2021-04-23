@extends('layouts.app')

@section('content') {{-- Make something that checks if you are the admin of the game, if not are you in the game. If not, can you join the game--}}
    <div class="container">
        <h1 class="text-center text-secondary">Hey participant - Event basic user view</h1>
        <h2 class="text-center text-primary">You can see the 'leave game' btn</h2>
        <a class='btn btn-danger' href="/leave-event/{{$event->id}}">Leave game</a>
        <event-info
            event="{{$event}}"
            court="{{$event->court}}"
            city="{{$event->court->location->city}}"
            host="{{$event->host}}"
        >
        </event-info>
        <event-messages
            prop_messages="{{$event->messages}}"
            prop_users="{{$event->users}}"
        ></event-messages>

        <send-message-box
            event_id_prop="{{$event->id}}"
        ></send-message-box>
    </div>
@endsection
