@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 text-center">
            <h1>Home</h1>
            <a href="/create-event"><span class="btn btn-primary">Create event</span></a>
            <a href="/event-search"><span class="btn btn-primary">Find Events</span></a>
            <a href="/user-search"><span class="btn btn-primary">Find users</span></a>
{{--            <a href="/notifications"><span class="btn btn-primary">Notifications</span></a>--}}
        </div>
    </div>
</div>
@endsection
