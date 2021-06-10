@extends('layouts.app')

@section('content') {{-- Make something that checks if you are the admin of the game, if not are you in the game. If not, can you join the game--}}
    <div class="container">
        <h1 class="text-center text-secondary">{{$event->title}}</h1>
        <div class="row d-flex justify-content-around">
            <div class="col-lg-4 col-md-5 col-12">
                <event-info
                    event="{{$event}}"
                    court="{{$event->court}}"
                    city="{{$event->court->location->city}}"
                    host="{{$event->host}}"
                >

                </event-info>
                <a href="/leave-event/{{$event->id}}" class="btn btn-danger">Leave event</a>
            </div>

            <div class="col-lg-8 col-md-7 col-12">
                <event-messages
                    prop_messages="{{$event->messages}}"
                    prop_users="{{$event->users}}"
                ></event-messages>

                <send-message-box
                    event_id_prop="{{$event->id}}"
                ></send-message-box>
            </div>
        </div>
    </div>
@endsection
