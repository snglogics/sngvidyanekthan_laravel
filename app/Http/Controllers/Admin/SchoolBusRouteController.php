<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolBusRoute;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class SchoolBusRouteController extends Controller
{
    public function index()
    {
        $routes = SchoolBusRoute::latest()->get();
        return view('admin.school_bus_routes.index', compact('routes'));
    }

    public function create()
    {
        return view('admin.school_bus_routes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'route_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stops' => 'required|array',
            'driver_name' => 'required|string|max:255',
            'driver_contact' => 'required|string|max:20',
            'bus_number' => 'required|string|max:20',
            'bus_image' => 'nullable|image|max:2048',
        ]);

        // Handle Image Upload
        if ($request->hasFile('bus_image')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploadResponse = $cloudinary->uploadApi()->upload($request->file('bus_image')->getRealPath(), [
                'folder' => 'school_bus_routes',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image',
            ]);

            $validated['bus_image_url'] = $uploadResponse['secure_url'];
        }

        $validated['stops'] = json_encode($request->stops);
        SchoolBusRoute::create($validated);

        return redirect()->route('admin.school_bus_routes.index')->with('success', 'School bus route added successfully.');
    }

    public function show(SchoolBusRoute $schoolBusRoute)
    {
        return view('admin.school_bus_routes.show', compact('schoolBusRoute'));
    }

    public function edit(SchoolBusRoute $schoolBusRoute)
    {
        return view('admin.school_bus_routes.edit', compact('schoolBusRoute'));
    }

    public function update(Request $request, SchoolBusRoute $schoolBusRoute)
    {
        $validated = $request->validate([
            'route_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stops' => 'required|array',
            'driver_name' => 'required|string|max:255',
            'driver_contact' => 'required|string|max:20',
            'bus_number' => 'required|string|max:20',
            'bus_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('bus_image')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploadResponse = $cloudinary->uploadApi()->upload($request->file('bus_image')->getRealPath(), [
                'folder' => 'school_bus_routes',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image',
            ]);

            $validated['bus_image_url'] = $uploadResponse['secure_url'];
        }

        $validated['stops'] = json_encode($request->stops);
        $schoolBusRoute->update($validated);

        return redirect()->route('admin.school_bus_routes.index')->with('success', 'School bus route updated successfully.');
    }

    public function destroy(SchoolBusRoute $schoolBusRoute)
    {
        $schoolBusRoute->delete();
        return redirect()->route('admin.school_bus_routes.index')->with('success', 'School bus route deleted successfully.');
    }
}
