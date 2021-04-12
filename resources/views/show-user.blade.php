@extends('layouts.app') {{--EDIT THIS PAGE COMPONENTS SO THAT YOU CAN JUST VIEW THE DATA, NOT EDIT IT--}}

@section('content')
    <div class="container">

        {{--        Profile picture and name(username)--}}
        <profile-picture
            imageurl="{{$user->image_url}}"
            name="{{$user->name}}"
            username="{{$user->username}}"
            sex="{{$user->sex}}"
        ></profile-picture>

        {{--  Profile bio component      --}}
        <profile-bio
            bio="{{$user->bio}}"
        ></profile-bio>


        {{-- Personal user information box + content on their page      --}}
        <profile-content
            age="{{$user->age}}"
            sex="{{$user->sex}}"
            city="{{$user->location->city}}"
        ></profile-content>
    </div>
@endsection
