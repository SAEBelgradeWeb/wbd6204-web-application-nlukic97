@extends('layouts.app')

@section('content') {{-- Make something that checks if you are the admin of the game, if not are you in the game. If not, can you join the game--}}
<div class="container">
    <h1 class="text-center text-success">Hey participant - Event admin view, not confirmed yet but still on</h1>
    <a href="/cancel-event/{{$event->id}}" class="btn btn-danger">Cancel event</a>

    <event-info
        event="{{$event}}"
        court="{{$event->court}}"
        city="{{$event->court->location->city}}"
        host="{{$event->host}}"
    ></event-info>
    <event-messages
        prop_messages="{{$event->messages}}"
        prop_users="{{$event->users}}"
    ></event-messages>

    <send-message-box
        event_id_prop="{{$event->id}}"
    ></send-message-box>



</div>
@endsection
