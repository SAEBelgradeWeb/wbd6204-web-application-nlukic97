@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 text-center">
                <h1>User search page</h1>
            </div>
        </div>

        <form action="/user-search-query" method="GET">
            <user-search></user-search>
            <button type="submit">Search</button>
        </form>

        @foreach($users as $user)
            <ul>
                <li>{{$user->name}}</li>
                <li>{{$user->location->city}}</li>
            </ul>
        @endforeach
    </div>
@endsection
