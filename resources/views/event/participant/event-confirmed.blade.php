@extends('layouts.app')

@section('content') {{-- Make something that checks if you are the admin of the game, if not are you in the game. If not, can you join the game--}}
<div class="container">
    <h1 class="text-center text-success">{{$event->title}} (confirmed)</h1>
    <div class="row d-flex justify-content-around">
        <div class="col-lg-4 col-md-5 col-12">
            <event-info
                event="{{$event}}"
                court="{{$event->court}}"
                city="{{$event->court->location->city}}"
                host="{{$event->host}}"
            >

            </event-info>
        </div>

        <div class="col-lg-8 col-md-7 col-12">
            <event-messages
                prop_messages="{{$event->messages}}"
                prop_users="{{$event->users}}"
            ></event-messages>
        </div>
    </div>
</div>
@endsection
