@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 text-center">
            <h1>Welcome to the home page</h1>
            <a href="/create-event"><span class="btn btn-primary">Create event</span></a>
            <a href="/event-search"><span class="btn btn-primary">Events</span></a>
            <a href="/user-search"><span class="btn btn-primary">Users</span></a>
        </div>
    </div>
    <div class="row text-center mt-4">
        <div class="col-12">
            <h2>events:</h2>
        </div>
    </div>
</div>
@endsection
