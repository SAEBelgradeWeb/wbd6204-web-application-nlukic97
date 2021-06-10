@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Please select a location</h2>
            </div>
        </div>

        {{--the event filter results component--}}
        <event-search></event-search>


    </div>
@endsection
