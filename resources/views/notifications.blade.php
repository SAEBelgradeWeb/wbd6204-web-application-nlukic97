@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 text-center">
                <h1>Notifications</h1>

                @foreach($notifications as $notif)
                    @if($notif->source === 'message') {{--if it is a msg, we must have the ve--}}
                        <ul>
                            <li><a href="/user/{{$notif->sender->id}}">{{$notif->sender->name}}</a></li>
                            <li>Type: {{$notif->source}}</li>
                            <li>...sent a new <a href="/event/{{$notif->event_id}}">message</a></li>
                            <li>Status: {{$notif->seen}}</li>
                        </ul>
                        @elseif($notif->source === 'friendship' AND $notif->type === 'request')
                        <ul>
                            <li><a href="/user/{{$notif->sender->id}}">{{$notif->sender->name}}</a></li>
                            <li>Type: {{$notif->source}}</li>
                            <li>...has sent you a friend request</li>
                            <li>Status: {{$notif->seen}}</li>
                        </ul>
                    @elseif($notif->source === 'friendship' AND $notif->type === 'accept')
                        <ul>
                            <li><a href="/user/{{$notif->sender->id}}">{{$notif->sender->name}}</a></li>
                            <li>Type: {{$notif->source}}</li>
                            <li>...has accepted your friend request</li>
                            <li>Status: {{$notif->seen}}</li>
                        </ul>
                        @endif


                @endforeach
            </div>
        </div>

    </div>
@endsection
