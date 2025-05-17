<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FieldTrip;

class FieldTripController extends Controller
{
    public function index() {
        $trips = FieldTrip::orderBy('start_date', 'desc')->get();
        return view('field_trips.index', compact('trips'));
    }

    public function show(FieldTrip $trip) {
        return view('field_trips.show', compact('trip'));
    }
}
