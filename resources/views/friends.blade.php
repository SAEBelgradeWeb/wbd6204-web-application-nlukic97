@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($friends as $friend)
    <ul>
        <li>{{$friend->name}}</li>
        <li>{{$friend->age}}</li>
        <li>{{$friend->sex}}</li>
    </ul>
    @endforeach
</div>
@endsection
