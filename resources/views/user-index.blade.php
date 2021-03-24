@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
{{--            Profile picture--}}
            <div class="rounded-circle d-inline overflow-hidden" style="border:3px solid #fff; height:160px;width:160px; background-image:url('{{$user->image_url}}'); background-size: 80%; background-repeat: no-repeat; background-position: center center ">
{{--                <img src="{{$user->image_url}}" style="width: 130px;" alt="">--}}
            </div>
        </div>
        <div class="row text-center">
            <div class="col pt-2">
                <p><span class="font-weight-bold">{{$user->name}}</span> <span>({{$user->username}})</span></p>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-md-11 col-10">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci cumque, dolorem enim est exercitationem facilis illum incidunt iusto molestiae molestias mollitia nam neque pariatur praesentium reiciendis repellat sint, tempora vel?</p>
            </div>
        </div>

        {{-- Personal user information box       --}}
        <div class="row">
            <div class="position-relative col-lg-3 col-md-11 col-10"> {{-- this needs to be centered better for smaller screens--}}
                <div class="position-absolute" style="z-index: 1; right:-10px; top:-10px"><a href="#" class="btn btn-secondary">...</a></div> {{-- button to open popup adn edit data --}}
                <ul class="list-group">
                    <li class="list-group-item">Age: {{$user->age}}</li>
                    <li class="list-group-item">sex: {{$user->sex}}</li>
                    <li class="list-group-item">From: {{$user->location->city}}</li>
                </ul>
            </div>
            <div class="col-lg-9 col-md-12 col-12">
                <h1>some content</h1>
            </div>
        </div>
    </div>
@endsection
