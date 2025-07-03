<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bus;

class BusRouteController extends Controller
{
    public function index(Request $request)
    {
        $bus_numbers = Bus::pluck('bus_no')->unique()->filter()->values();

        $buses = Bus::with('stops')
            ->when($request->bus_no, fn($q) => $q->where('bus_no', $request->bus_no))
            ->orderBy('bus_no')
            ->get();

        return view('frontend.bus_route', compact('buses', 'bus_numbers'));
    }
}
