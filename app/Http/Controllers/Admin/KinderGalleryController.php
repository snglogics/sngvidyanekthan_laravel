<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KinderGallery;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class KinderGalleryController extends Controller
{
    public function showUploadForm()
    {
        $galleryImages = KinderGallery::all()->groupBy('common_header');
        return view('admin.kinderGarden.kinderUpload', compact('galleryImages'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'common_header' => 'required|string|max:255',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $cloudinary = $this->cloudinary();

        foreach ($request->file('images') as $file) {
            $uploadResponse = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                'folder' => 'kinder_gallery',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image',
                'quality' => 'auto',
                'fetch_format' => 'auto',
            ]);

            KinderGallery::create([
                'common_header' => $request->common_header,
                'image_url' => $uploadResponse['secure_url'],
            ]);
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    public function delete($id)
    {
        $image = KinderGallery::findOrFail($id);
        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }

    public function deleteByHeader(Request $request)
    {
        $request->validate([
            'common_header' => 'required|string',
        ]);

        KinderGallery::where('common_header', $request->common_header)->delete();

        return back()->with('success', 'All images under "' . $request->common_header . '" deleted.');
    }

    public function list()
    {
        $groupedGalleries = KinderGallery::orderBy('id', 'desc')->get()->groupBy('common_header');
        return view('admin.kinderGarden.kinderList', compact('groupedGalleries'));
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
