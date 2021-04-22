@extends('layouts.app')

@section('content') {{-- Make something that checks if you are the admin of the game, if not are you in the game. If not, can you join the game--}}
<div class="container">
    <h1 class="text-center text-danger">Hey participant - Event cancelled</h1>
    <h2 class="text-center text-warning">can't message, but can read them. that's it</h2>

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
