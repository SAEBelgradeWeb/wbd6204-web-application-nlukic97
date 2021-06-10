@extends('layouts.app')

@section('content') {{-- Make something that checks if you are the admin of the game, if not are you in the game. If not, can you join the game--}}
<div class="container">
    <h1 class="text-center text-danger">{{$event->title}} (Event cancelled)</h1>

    <event-info
        event="{{$event}}"
        court="{{$event->court}}"
        city="{{$event->court->location->city}}"
        host="{{$event->host}}"
    ></event-info>
</div>
@endsection
