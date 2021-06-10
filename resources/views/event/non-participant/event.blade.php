@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center text-primary">{{$event->title}}</h1>

    <event-info
        event="{{$event}}"
        court="{{$event->court}}"
        city="{{$event->court->location->city}}"
        host="{{$event->host}}"
    ></event-info>
    <a href="/payment/{{$event->id}}" class="btn btn-primary">Join event</a>
</div>
@endsection
