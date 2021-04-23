@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 text-center">
                <h1>Notifications</h1>

                @foreach($notifications as $notif)
                <ul>
                    <li><a href="/user/{{$notif->sender->id}}">{{$notif->sender->name}}</a></li>
                    <li>Type: {{$notif->type}}</li>
                    <li>Status: {{$notif->seen}}</li>
                </ul>
                @endforeach
            </div>
        </div>

    </div>
@endsection
