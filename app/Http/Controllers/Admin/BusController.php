<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\BusStop;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BusImport;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::with('stops')->get();
        return view('admin.buses.index', compact('buses'));
    }

    public function create()
    {
        return view('admin.buses.create');
    }

    public function store(Request $request)
    {
        $bus = Bus::create($request->only(['bus_no', 'driver_name', 'driver_phone', 'attender_name', 'attender_phone']));

        foreach ($request->stops as $stop) {
            $bus->stops()->create([
                'stop_name' => $stop['stop_name'],
                'morning_time' => $stop['morning_time'],
                'evening_time' => $stop['evening_time'],
            ]);
        }

        return redirect()->route('admin.buses.index')->with('success', 'Bus route created successfully.');
    }

    public function edit(Bus $bus)
    {
        $bus->load('stops');
        return view('admin.buses.edit', compact('bus'));
    }

    public function update(Request $request, Bus $bus)
    {
        $bus->update($request->only(['bus_no', 'driver_name', 'driver_phone', 'attender_name', 'attender_phone']));

        $bus->stops()->delete();
        foreach ($request->stops as $stop) {
            $bus->stops()->create([
                'stop_name' => $stop['stop_name'],
                'morning_time' => $stop['morning_time'],
                'evening_time' => $stop['evening_time'],
            ]);
        }

        return redirect()->route('admin.buses.index')->with('success', 'Bus route updated successfully.');
    }

    public function destroy(Bus $bus)
    {
        $bus->delete();
        return redirect()->route('admin.buses.index')->with('success', 'Bus route deleted successfully.');
    }
}
