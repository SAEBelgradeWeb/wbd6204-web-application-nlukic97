@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Create event page</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-4 col-md-6 col-9">
                <form action="/create-event" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="title" class="form-text m-0">Title</label>
                        <input type="text" id="title" name="title" class="form-control">
                    </div>

                    <locations-and-courts></locations-and-courts> {{--This is dynamic. When a user selects a location, a list of courts will be generated--}}

                    <div class="form-group row">
                        <label for="player_num" class="m-0">Players</label>
                        <input type="number" id="player_num" name="player_num" class="form-control" min="0" max="">
                    </div>

                    <div class="form-group row">
                        <label for="date" class="m-0">Date</label>
                        <input type="date" id="date" name="date" class="form-control">
                    </div>


                    <div class="form-group row">
                        <label for="time" class="m-0">Time</label>
                        <input type="time" id="time" name="time" class="form-control">
                    </div>
                    <div class="text-center mt-3 form-group">
                        <button type="submit" class="btn btn-primary">Create event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
