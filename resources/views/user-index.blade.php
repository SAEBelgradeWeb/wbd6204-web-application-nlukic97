@extends('layouts.app')

@section('content')
    <div class="container">

        @if($pageOwner == true) {{--Display these components only if the user is requesting their page--}}
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
                events="{{$user->events}}"
            ></profile-content>


        @else {{--Render these components if a user is viewing another users page--}}
            <h1>not owner</h1>
        @endif


    </div>
@endsection
