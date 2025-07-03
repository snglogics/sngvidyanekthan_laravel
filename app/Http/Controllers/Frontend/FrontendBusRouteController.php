<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SchoolBusRoute;
use Illuminate\Http\Request;

class FrontendBusRouteController extends Controller
{
    // public function index(Request $request)
    // {
    //     $route_names = SchoolBusRoute::distinct()->pluck('route_name')->sort();
    //     $bus_numbers = SchoolBusRoute::distinct()->pluck('bus_number')->sort();

    //     $routes = SchoolBusRoute::query();

    //     if ($request->route_name) {
    //         $routes->where('route_name', $request->route_name);
    //     }

    //     if ($request->bus_number) {
    //         $routes->where('bus_number', $request->bus_number);
    //     }

    //     return view('frontend.bus_routes', [
    //         'routes' => $routes->get(),
    //         'route_names' => $route_names,
    //         'bus_numbers' => $bus_numbers,
    //     ]);
    // }

    public function show(SchoolBusRoute $schoolBusRoute)
    {
        return view('frontend.bus_route_details', compact('schoolBusRoute'));
    }
}
