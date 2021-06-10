@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1>Make reservation</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-lg-4 col-md-6 col-9">

                <div class="text-left card">
                    <h3 class="card-header m-0">Event</h3>
                    <div class="card-body">
                        <p class="mb-1"><span class="font-weight-bold">Title:</span> "{{$event->title}}"</p>
                        <p class="mb-1"><span class="font-weight-bold">Players:</span> {{$event->player_num}}</p>
                        <p class="mb-1"><span class="font-weight-bold">Court price:</span> {{number_format($event->court->price,2,'.','')}} &dollar;</p>
                        <p class="mb-1"><span class="font-weight-bold">Price per player:</span> {{number_format(($event->court->price / $event->player_num),2,'.','')}} &dollar;</p>
                        <p class="mb-1"><span class="font-weight-bold">Court:</span> "{{$event->court->title}}", {{$event->court->address}}, {{$event->court->location->city}}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-9">
                {{-- dummy form --}}
                <div id="dummy-form">
                    <div class="form-group row">
                        <label for="card_num" class="form-text m-0">Card number:</label>
                        <input type="number" id="card_num" name="card_num" class="form-control" readonly placeholder="2345 6543 7564 6464">
                    </div>

                    <div class="form-group row">
                        <label for="cvc" class="m-0">CVC</label>
                        <input type="number" id="cvc" name="cvc" class="form-control" readonly placeholder="385">
                    </div>

                    <div class="text-center mt-3 form-group">
                        <a href="/pay/{{$event->id}}"><span class="btn btn-primary pl-4 pr-4">Pay</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
