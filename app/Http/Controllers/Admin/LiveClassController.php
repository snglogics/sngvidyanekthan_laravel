<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveClass;
use Illuminate\Http\Request;

class LiveClassController extends Controller
{
    public function facilityHome()
    {
        return view('admin.facilities.facilityhome');
    }

    public function index()
    {
        $classes = \App\Models\LiveClass::where('scheduled_at', '>=', now())
        ->orderBy('scheduled_at')
        ->get();

    return view('admin.live-classes.index', compact('classes'));
    }

    public function create()
    {
        $classes = LiveClass::orderBy('scheduled_at', 'desc')->get(); // fetch all for listing
        return view('admin.live-classes.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'platform' => 'required',
            'link' => 'required|url',
            'scheduled_at' => 'required|date',
        ]);

        LiveClass::create($request->all());

        return back()->with('success', 'Live class added.');
    }

    public function edit(LiveClass $liveClass)
    {
        return view('admin.live-classes.edit', compact('liveClass'));
    }

    public function update(Request $request, LiveClass $liveClass)
    {
        $request->validate([
            'title' => 'required',
            'platform' => 'required',
            'link' => 'required|url',
            'scheduled_at' => 'required|date',
        ]);

        $liveClass->update($request->all());

        return redirect()->route('admin.live-classes.create')->with('success', 'Live class updated.');
    }

    public function destroy(LiveClass $liveClass)
    {
        $liveClass->delete();
        return back()->with('success', 'Live class deleted.');
    }
}
