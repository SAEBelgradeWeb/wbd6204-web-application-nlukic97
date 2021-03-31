@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row border-bottom">
            <div class="col-12">
                <h3>Account Settings</h3>
            </div>
        </div>

        <setting-element column_name='name' data="{{$user->name}}"></setting-element> {{--column_name ---> determines the column name and the column which will be updated in the table --}}
        <setting-element column_name='username' data="{{$user->username}}"></setting-element>
{{--        <setting-element column_name='password' data=""></setting-element>--}}


    </div>
@endsection
