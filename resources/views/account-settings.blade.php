@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row border-bottom">
            <div class="col-12">
                <h3>Account Settings</h3>
            </div>
        </div>

        {{-- The component
            perhaps I could pass prop titled type (name, username or etc), and data(Nikola, Adminsky and so on...)

        --}}
        <setting-element column_name='name' data="{{$user->name}}"></setting-element>
        <setting-element column_name='username' data="{{$user->username}}"></setting-element>
{{--        <setting-element column_name='password' data=""></setting-element>--}}


    </div>
@endsection
