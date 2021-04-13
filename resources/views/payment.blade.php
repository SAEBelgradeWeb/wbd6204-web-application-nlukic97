@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Click here to pay for your game</h1>
                <h3>Event info</h3>
                <p>Price: {{$event->court->price / $event->player_num}}</p>
                <p>Player num: {{$event->player_num}}</p>
                <a href="/pay"><span class="btn btn-primary">Pay</span></a>
            </div>
        </div>
    </div>
@endsection
