@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hello {{$user->name}}. This is your account data:</h1>
        <div class="row">
            <ul>
                <li>Age: {{$user->age}}</li>
                <li>sex: {{$user->sex}}</li>
                <li>location: {{$user->location->city}}</li>
                <li>email {{$user->email}}</li>
                <li>username: {{$user->username}}</li>
                <li>image_url: {{$user->image_url}}</li>
            </ul>
        </div>
    </div>
@endsection
