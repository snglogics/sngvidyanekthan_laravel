<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FieldTrip;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class FieldTripController extends Controller
{
    public function index()
    {
        $trips = FieldTrip::orderBy('start_date', 'desc')->get();
        return view('admin.field_trips.index', compact('trips'));
    }

    public function create()
    {
        return view('admin.field_trips.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'contact_person' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = $this->cloudinary();

            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'field_trips',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ]
            );

            $data['image_url'] = $uploadedFile['secure_url'];
        }

        FieldTrip::create($data);

        return redirect()->route('admin.field_trips.index')
            ->with('success', 'Field Trip created successfully.');
    }

    public function edit(FieldTrip $trip)
    {
        return view('admin.field_trips.edit', compact('trip'));
    }

    public function update(Request $request, FieldTrip $trip)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'contact_person' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = $this->cloudinary();

            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'field_trips',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ]
            );

            $data['image_url'] = $uploadedFile['secure_url'];
        }

        $trip->update($data);

        return redirect()->route('admin.field_trips.index')
            ->with('success', 'Field Trip updated successfully.');
    }

    public function destroy(FieldTrip $trip)
    {
        $trip->delete();

        return redirect()->route('admin.field_trips.index')
            ->with('success', 'Field Trip deleted successfully.');
    }

    /**
     * DRY helper for Cloudinary initialization
     */
    private function cloudinary()
    {
        $config = new Configuration([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key' => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true,
            ],
        ]);

        return new Cloudinary($config);
    }
}
