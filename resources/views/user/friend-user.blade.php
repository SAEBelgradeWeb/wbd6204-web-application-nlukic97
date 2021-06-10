@extends('layouts.app')

@section('content')
    <div class="container">
        {{--        Profile picture and name(username)--}}
        <other-profile-picture
            imageurl="{{$user->image_url}}"
            name="{{$user->name}}"
            username="{{$user->username}}"
            sex="{{$user->sex}}"
            id="{{$user->id}}"
        ></other-profile-picture>

        {{--  Profile bio component      --}}
        <other-profile-bio
            bio="{{$user->bio}}"
        ></other-profile-bio>


        {{-- Personal user information box + content on their page      --}}
        <other-profile-content
            age="{{$user->age}}"
            sex="{{$user->sex}}"
            city="{{$user->location->city}}"
            events="{{$user->events}}"
            friends_prop="{{$friends}}"
            id_prop="{{$user->id}}"
        ></other-profile-content>


    </div>
@endsection
