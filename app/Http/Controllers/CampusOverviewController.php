<?php

namespace App\Http\Controllers;

use App\Models\CampusOverview;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class CampusOverviewController extends Controller
{
    public function frontendshow(CampusOverview $campusOverview)
{
    return view('frontend.campus_overviews.frontendshow', compact('campusOverview'));
}

public function frontendIndex()
{
    $overviews = CampusOverview::all();
    return view('frontend.campus_overviews.index', compact('overviews'));
}

    public function index()
    {
        $overviews = CampusOverview::all();
        return view('admin.campus_overviews.index', compact('overviews'));
    }
    public function create()
{
    return view('admin.campus_overviews.create');
}

    public function store(Request $request)
{
    $request->validate([
        'main_heading' => 'required|string|max:255',
        'description' => 'required|string',
        'photos' => 'nullable|array',
        'photos.*' => 'image|mimes:jpeg,png,jpg|max:5120'
    ]);

    $photos = [];
    if ($request->hasFile('photos')) {
        $cloudinary = new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ]
        ]);

        foreach ($request->file('photos') as $photo) {
            $uploadResponse = $cloudinary->uploadApi()->upload($photo->getRealPath(), [
                'folder' => 'campus_overview_photos',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image'
            ]);

            // Store as associative array with URL and empty title
            $photos[] = [
                'url' => $uploadResponse['secure_url'],
                'title' => ''  // Default empty title
            ];
        }
    }

    // Save the overview
    CampusOverview::create([
        'main_heading' => $request->main_heading,
        'description' => $request->description,
        'photos' => $photos,  // Directly pass the array, no need to json_encode
    ]);

    return redirect()->route('admin.campus-overviews.index')->with('success', 'Campus overview added successfully!');
}

    public function show(CampusOverview $campusOverview)
    {
        return view('admin.campus_overviews.show', compact('campusOverview'));
    }

    public function edit(CampusOverview $campusOverview)
    {
        return view('admin.campus_overviews.edit', compact('campusOverview'));
    }

    public function update(Request $request, CampusOverview $campusOverview)
    {
    $request->validate([
        'main_heading' => 'required|string|max:255',
        'description' => 'required|string',
        'photos' => 'nullable|array',
        'photos.*' => 'image|mimes:jpeg,png,jpg|max:5120'
    ]);

    // Handle existing photos
    $existingPhotos = $request->input('existing_photos', []);
    $photoTitles = $request->input('photo_titles', []);
    $photos = [];

    foreach ($existingPhotos as $index => $url) {
        $photos[] = [
            'url' => $url,
            'title' => $photoTitles[$index] ?? ''
        ];
    }
    \Log::info("Final photos array before update", $photos);
    // Handle new uploads
    if ($request->hasFile('photos')) {
        $cloudinary = new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ]
        ]);

        foreach ($request->file('photos') as $photo) {
            $uploadResponse = $cloudinary->uploadApi()->upload($photo->getRealPath(), [
                'folder' => 'campus_overview_photos',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image'
            ]);

            $photos[] = [
                'url' => $uploadResponse['secure_url'],
                'title' => ''  // Default empty title
            ];
        }
    }

    $campusOverview->update([
        'main_heading' => $request->main_heading,
        'description' => $request->description,
        'photos' => $photos,
    ]);

    return redirect()->route('admin.campus-overviews.index')->with('success', 'Campus overview updated successfully!');
    }

public function updatePhoto(Request $request, CampusOverview $campusOverview, $photoIndex)
{
    $request->validate([
        'new_photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
    ]);

    $photos = $campusOverview->photos;
    if (isset($photos[$photoIndex])) {
        $cloudinary = new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ]
        ]);

        $uploadResponse = $cloudinary->uploadApi()->upload($request->file('new_photo')->getRealPath(), [
            'folder' => 'campus_overview_photos',
            'public_id' => uniqid(),
            'overwrite' => true,
            'resource_type' => 'image'
        ]);

        $photos[$photoIndex]['url'] = $uploadResponse['secure_url'];
        $campusOverview->update(['photos' => $photos]);
    }

    return redirect()->back()->with('success', 'Photo updated successfully!');
}
    

    public function destroyPhoto(CampusOverview $campusOverview, $photoIndex)
    {
        $photos = $campusOverview->photos;
        if (isset($photos[$photoIndex])) {
            unset($photos[$photoIndex]);
            $campusOverview->update(['photos' => array_values($photos)]);
        }

        return redirect()->back()->with('success', 'Photo deleted successfully!');
    }

    public function destroy(CampusOverview $campusOverview)
    {
        $campusOverview->delete();
        return redirect()->route('admin.campus-overviews.index')->with('success', 'Campus overview deleted successfully!');
    }
}
