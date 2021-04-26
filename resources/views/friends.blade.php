@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h3>FriendsList</h3>
        </div>
    </div>
    <friend-list friends_prop="{{$friends}}"></friend-list>
</div>
@endsection
