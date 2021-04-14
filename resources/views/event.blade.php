@extends('layouts.app')

@section('content') {{-- Make something that checks if you are the admin of the game, if not are you in the game. If not, can you join the game--}}
    <div class="container">
        <h1>Event</h1>
        <ul>
            <li>Title: {{$event->title}}</li>
            <li>Players: {{count($event->users)}} / {{$event->player_num}}</li>
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
        </ul>
    </div>
@endsection
