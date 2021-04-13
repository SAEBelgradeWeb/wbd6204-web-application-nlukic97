<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function indexNewEvent()
    {
        return view('create-event');
    }

    public function createNewEvent(Request $request)
    {
//        dd($request);

        $request->validate([
            'title'=>'required|string',
            'date'=>'required',
            'time'=>'required',
            'court_id'=>'required'
        ]);


        $request['status'] = 'pending';
        $request['host_id'] = Auth::user()->id;

        $event = Event::create($request->except(['_token','location_id']));
        return redirect("/payment/$event->id");
    }

    public function showPayment($id)
    {
        $event = Event::find($id);
        return view('payment',compact(['event']));
    }

}
