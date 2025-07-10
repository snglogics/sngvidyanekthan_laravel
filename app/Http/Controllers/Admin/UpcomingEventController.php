<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\upcoming_events;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

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
        $data = $request->validate([
            'event_date' => 'required|date',
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time_interval' => 'required|string',
            'venue' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = $this->cloudinary();

            $uploadResult = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'upcoming_events',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ]
            );

            $data['image_url'] = $uploadResult['secure_url'];
        }

        upcoming_events::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event uploaded successfully.');
    }

    public function destroy($id)
    {
        $event = upcoming_events::findOrFail($id);
        $event->delete();

        return back()->with('success', 'Event deleted.');
    }

    /**
     * DRY helper for Cloudinary initialization
     */
    private function cloudinary()
    {
        $config = new Configuration([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key'    => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true,
            ],
        ]);

        return new Cloudinary($config);
    }
}
