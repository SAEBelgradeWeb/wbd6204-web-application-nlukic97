@extends('layouts.app')

@section('content')
    <div class="container">
        {{--<div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>--}}

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Create event page</h1>
                <form action="/create-event" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title">
                    </div>

                    <locations-and-courts></locations-and-courts> {{--This is dynamic. When a user selects a location, a list of courts will be generated--}}

                    <div>
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date">
                    </div>

                    <div>
                        <label for="player_num">Players</label>
                        <input type="number" id="player_num" name="player_num">
                    </div>

                    <div>
                        <label for="time">Time</label>
                        <input type="time" id="time" name="time">
                    </div>
                    <button type="submit" class="btn btn-primary">Create event</button>
                </form>
            </div>
        </div>
    </div>
@endsection
