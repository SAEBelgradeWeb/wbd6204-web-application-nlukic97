@extends('layouts.app')

@section('content')
<div class="container">
    <friend-list friends_prop="{{$friends}}"></friend-list>
</div>
@endsection
