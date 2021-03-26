<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
//    Api route -> sent to AboutProfileModal.vue
    public function index()
    {
        $locations = Location::orderBy('city','asc')->get();
        return $locations->all();
    }
}
