@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center text-danger">{{$event->title}} (Event confirmed)</h1>

    <event-info
        event="{{$event}}"
        court="{{$event->court}}"
        city="{{$event->court->location->city}}"
        host="{{$event->host}}"
    ></event-info>
</div>
@endsection
