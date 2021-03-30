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
        <div class="row ml-4 mr-4 pt-2 pb-2 border-bottom d-flex align-items-center"> {{--  .bg-dark --}}
            <div class="col-2 pt-2 pb-2">
                <span class="font-weight-bold text-left">Name</span>
            </div>

            <div class="col-8 pt-2 pb-2">
                <span class="text-left d-block text-muted text-break">{{$user->name}}</span>
            </div>
            <div class="pt-2 pb-2 col-1 text-right">
                <span class="text-primary btn border-0 bg-light">Edit</span>
            </div>
        </div>


    </div>
@endsection
