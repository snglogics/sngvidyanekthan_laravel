<?php

namespace App\Http\Controllers;

use App\Models\CampusOverview;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Support\Facades\Log;

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
        $data = $request->validate([
            'main_heading' => 'required|string|max:255',
            'description' => 'required|string',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:5120'
        ]);

        $photos = [];
        if ($request->hasFile('photos')) {
            $cloudinary = $this->cloudinary();

            foreach ($request->file('photos') as $photo) {
                $uploadResponse = $cloudinary->uploadApi()->upload(
                    $photo->getRealPath(),
                    [
                        'folder' => 'campus_overview_photos',
                        'public_id' => uniqid(),
                        'overwrite' => true,
                        'resource_type' => 'image'
                    ]
                );

                $photos[] = [
                    'url' => $uploadResponse['secure_url'],
                    'title' => ''
                ];
            }
            $data['photos'] = $photos;
        }

        CampusOverview::create($data);

        return redirect()->route('admin.campus-overviews.index')
            ->with('success', 'Campus overview added successfully!');
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
        $data = $request->validate([
            'main_heading' => 'required|string|max:255',
            'description' => 'required|string',
            'existing_photos' => 'nullable|array',
            'photo_titles' => 'nullable|array',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:5120'
        ]);

        $photos = [];
        $existingPhotos = $request->input('existing_photos', []);
        $photoTitles = $request->input('photo_titles', []);

        foreach ($existingPhotos as $index => $url) {
            $photos[] = [
                'url' => $url,
                'title' => $photoTitles[$index] ?? ''
            ];
        }

        Log::info("Final photos array before update", ['photos' => $photos]);

        if ($request->hasFile('photos')) {
            $cloudinary = $this->cloudinary();

            foreach ($request->file('photos') as $photo) {
                $uploadResponse = $cloudinary->uploadApi()->upload(
                    $photo->getRealPath(),
                    [
                        'folder' => 'campus_overview_photos',
                        'public_id' => uniqid(),
                        'overwrite' => true,
                        'resource_type' => 'image'
                    ]
                );

                $photos[] = [
                    'url' => $uploadResponse['secure_url'],
                    'title' => ''
                ];
            }
        }

        $data['photos'] = $photos;
        $campusOverview->update($data);

        return redirect()->route('admin.campus-overviews.index')
            ->with('success', 'Campus overview updated successfully!');
    }

    public function updatePhoto(Request $request, CampusOverview $campusOverview, $photoIndex)
    {
        $request->validate([
            'new_photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $photos = $campusOverview->photos;

        if (isset($photos[$photoIndex])) {
            $cloudinary = $this->cloudinary();

            $oldUrl = $photos[$photoIndex]['url'];
            $publicId = $this->extractPublicId($oldUrl);
            if ($publicId) {
                $cloudinary->uploadApi()->destroy($publicId, ['resource_type' => 'image']);
            }

            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('new_photo')->getRealPath(),
                [
                    'folder' => 'campus_overview_photos',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image'
                ]
            );

            $photos[$photoIndex]['url'] = $uploadResponse['secure_url'];
            $campusOverview->update(['photos' => $photos]);
        }

        return redirect()->back()
            ->with('success', 'Photo updated successfully!');
    }

    public function destroyPhoto(CampusOverview $campusOverview, $photoIndex)
    {
        $photos = $campusOverview->photos;

        if (isset($photos[$photoIndex])) {
            $cloudinary = $this->cloudinary();

            $url = $photos[$photoIndex]['url'];
            $publicId = $this->extractPublicId($url);
            if ($publicId) {
                $cloudinary->uploadApi()->destroy($publicId, ['resource_type' => 'image']);
            }

            unset($photos[$photoIndex]);
            $campusOverview->update(['photos' => array_values($photos)]);
        }

        return redirect()->back()
            ->with('success', 'Photo deleted successfully!');
    }

    public function destroy(CampusOverview $campusOverview)
    {
        $cloudinary = $this->cloudinary();
        foreach ($campusOverview->photos as $photo) {
            $publicId = $this->extractPublicId($photo['url']);
            if ($publicId) {
                $cloudinary->uploadApi()->destroy($publicId, ['resource_type' => 'image']);
            }
        }

        $campusOverview->delete();

        return redirect()->route('admin.campus-overviews.index')
            ->with('success', 'Campus overview deleted successfully!');
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
                'secure' => true
            ]
        ]);

        return new Cloudinary($config);
    }

    /**
     * Helper method to extract Cloudinary public_id from URL
     */
    private function extractPublicId($url)
    {
        $parsedUrl = parse_url($url);
        if (!isset($parsedUrl['path'])) {
            return null;
        }

        $path = $parsedUrl['path'];
        $pathParts = explode('/', $path);

        $uploadIndex = array_search('upload', $pathParts);
        if ($uploadIndex === false) {
            return null;
        }

        $publicIdParts = array_slice($pathParts, $uploadIndex + 2);
        if (empty($publicIdParts)) {
            return null;
        }

        $publicIdWithExtension = implode('/', $publicIdParts);
        $publicId = preg_replace('/\.[^.]+$/', '', $publicIdWithExtension);

        return $publicId;
    }
}
