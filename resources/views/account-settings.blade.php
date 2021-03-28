@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Account Settings</h1>

        <div class="row">
            <div class=" col-lg-4 col-md-10 col-10">

                <!--About area-->
                <span>Personal information:</span>
                <ul class="list-group position-relative mb-3">
                    <li class="list-group-item">Name: {{$user->name}}<a href="#">Updateds</a></li>
                    <li class="list-group-item">Username: {{$user->username}}</li>
                </ul>

                <p>Password</p>
                <a href="#" class="btn btn-primary">Update password</a>
{{--                <ul class="list-group position-relative">--}}
{{--                    <li class="list-group-item">Name: {{$user->name}}</li>--}}
{{--                    <li class="list-group-item">Username: {{$user->username}}</li>--}}
{{--                </ul>--}}

            </div>
        </div>
    </div>
@endsection
