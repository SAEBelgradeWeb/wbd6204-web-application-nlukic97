@extends('layouts.app')

@section('content')
    <div class="container">
            <non-friend-profile-picture
                imageurl="{{$user->image_url}}"
                name="{{$user->name}}"
                username="{{$user->username}}"
                sex="{{$user->sex}}"
                id="{{$user->id}}"
            ></non-friend-profile-picture>

            <other-profile-bio
                bio="{{$user->bio}}"
            ></other-profile-bio>


        {{-- Hide this from any visitor that is not our friend --}}
{{--            <other-profile-content
                age="{{$user->age}}"
                sex="{{$user->sex}}"
                city="{{$user->location->city}}"
                events="{{$user->events}}"
            ></other-profile-content>--}}

    </div>
@endsection
