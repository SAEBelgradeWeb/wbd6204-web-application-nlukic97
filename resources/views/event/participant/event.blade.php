@extends('layouts.app')

@section('content') {{-- Make something that checks if you are the admin of the game, if not are you in the game. If not, can you join the game--}}
    <div class="container">
        <h1 class="text-center text-secondary">Hey participant - Event basic user view</h1>
        <h2 class="text-center text-primary">You can see the 'leave game' btn</h2>
        <a href="/leave-event/{{$event->id}}" class="btn btn-danger">Leave event</a>
        {{--<ul>
            <li>Title: {{$event->title}}</li>
            <li>Players: {{count($event->users)}} / {{$event->player_num}}</li>
            <li>Host: <a href="/user/{{$event->host->id}}">{{$event->host->name}}</a></li>
        </ul>

        <h1>Court</h1>
        <ul>
            <li>{{$event->court->title}}</li>

            <li>{{$event->court->location->city}}</li>
            <li>{{$event->court->address}}</li>
        </ul>

        <h1>Participants</h1>
        <ul>
            @foreach($event->users as $user)
                <a href="/user/{{$user->id}}"><li>{{$user->name}}</li></a>
            @endforeach
        </ul>--}}

        <event-info
            event="{{$event}}"
            court="{{$event->court}}"
            city="{{$event->court->location->city}}"
            host="{{$event->host}}"
        ></event-info>
    </div>
@endsection
