<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\upcoming_events;
use Cloudinary\Cloudinary;

class UpcomingEventController extends Controller
{
    public function index()
    {
        $events = upcoming_events::orderByDesc('event_date')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_date' => 'required|date',
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time_interval' => 'required|string',
            'venue' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $imageUrl = (new Cloudinary())->uploadApi()->upload($request->file('image')->getRealPath())['secure_url'];

        upcoming_events::create([
            'event_date' => $request->event_date,
            'heading' => $request->heading,
            'description' => $request->description,
            'time_interval' => $request->time_interval,
            'venue' => $request->venue,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event uploaded successfully.');
    }

    public function destroy($id)
    {
        $event = upcoming_events::findOrFail($id);
        $event->delete();
        return back()->with('success', 'Event deleted.');
    }
}
 