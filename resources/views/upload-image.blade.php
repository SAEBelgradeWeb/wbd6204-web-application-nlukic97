@extends('layouts.app')

@section('content')
    <div class="container">
        <upload-image
            csrf="{{csrf_token()}}"
            user-id="{{Auth::user()->id}}"
        />
    </div>
@endsection
