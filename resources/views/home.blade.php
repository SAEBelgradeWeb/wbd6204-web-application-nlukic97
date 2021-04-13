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
            <h1>Welcome to the home page</h1>
            <a href="/create-event"><span class="btn btn-primary">Create game</span></a>
        </div>
    </div>
</div>
@endsection
