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
    </div>
@endsection
