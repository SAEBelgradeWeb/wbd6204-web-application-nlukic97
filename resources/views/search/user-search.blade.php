@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 text-center">
                <h1>User search page</h1>
            </div>
        </div>

        <form action="/user-search-query" method="GET" class="mb-3">
            @if($GET !== null) {{--Send the prop data to display the query inputs --}}
                <user-search
                    query_prop="{{$GET['query']}}"
                    location_id_prop="{{$GET['location_id']}}"
                ></user-search>
            @else {{--display empty search bar, and 'all' locations selected --}}
                <user-search
                    query_prop=""
                    location_id_prop=""
                ></user-search>
            @endif
        </form>

        @foreach($users as $user)
            <individual-user-result
                user_prop="{{$user}}"
                city_prop="{{$user->location->city}}"
            ></individual-user-result>
        @endforeach
    </div>
@endsection
