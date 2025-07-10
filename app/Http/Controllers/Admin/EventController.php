<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UploadEvents;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function showUploadForm()
    {
        $galleryImages = UploadEvents::all()->groupBy('common_header'); // Fetch existing records if you want to list them

        return view('admin.eventsUpload', compact('galleryImages'));
    }

    public function eventUpload(Request $request)
    {
        try {
            $request->validate([
                'common_header' => 'required|string|max:255',
                'headers' => 'required|array',
                'images' => 'required|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);

            $commonHeader = $request->input('common_header');
            $headers = $request->input('headers', []);

            $cloudinary = $this->cloudinary();

            foreach ($request->file('images') as $index => $file) {
                $uploadedFileUrl = $cloudinary->uploadApi()->upload(
                    $file->getRealPath(),
                    [
                        'folder' => 'events_uploads',
                        'public_id' => uniqid(),
                        'overwrite' => true,
                        'resource_type' => 'image',
                        'quality' => 'auto',
                        'fetch_format' => 'auto',
                    ]
                )['secure_url'];

                UploadEvents::create([
                    'common_header' => $commonHeader,
                    'header' => $headers[$index] ?? null,
                    'image_url' => $uploadedFileUrl,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Images uploaded successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        $event = UploadEvents::findOrFail($id);
        return view('admin.eventsEdit', compact('event'));
    }

    public function delete($id)
    {
        $event = UploadEvents::findOrFail($id);
        $event->delete();

        return redirect()->back()->with('success', 'Event image deleted successfully.');
    }

    public function deleteByHeader(Request $request)
    {
        $request->validate([
            'common_header' => 'required|string',
        ]);

        UploadEvents::where('common_header', $request->common_header)->delete();

        return redirect()->back()->with('success', 'All images under "' . $request->common_header . '" deleted successfully.');
    }

    public function eventlist()
    {
        $groupedEvents = UploadEvents::orderBy('id', 'desc')->get()->groupBy('common_header');
        return view('activities.evntlist', compact('groupedEvents'));
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
