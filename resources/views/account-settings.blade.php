@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Account Settings</h1>
        <h1 class="text-danger">Add inputs to be edited...</h1>
        <div class="row">
            <span>Personal information</span>
        </div>
        <div class="row">
            <ul>
                <li>email {{$user->email}}<a class="btn btn-primary" href="#">Change ?</a></li>
                <li>username: {{$user->username}}<a class="btn btn-primary" href="#">Change</a></li>
                <li><a class="btn btn-primary" href="#">Update password</a></li>
            </ul>
        </div>
    </div>
@endsection
