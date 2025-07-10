<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrincipalMsg;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function showForm()
    {
        return view('admin.image_upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'imageName' => 'required|string|max:255',
            'description' => 'nullable|string',
            'imageHeader' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $cloudinary = $this->cloudinary();

        $uploadedFile = $cloudinary->uploadApi()->upload(
            $request->file('image')->getRealPath(),
            [
                'folder' => 'principal_msgs',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image',
                'quality' => 'auto',
                'fetch_format' => 'auto',
            ]
        );

        $imageUrl = $uploadedFile['secure_url'];
        $publicId = $uploadedFile['public_id'];

        PrincipalMsg::create([
            'image_name' => $request->imageName,
            'description' => $request->description,
            'image_header' => $request->imageHeader,
            'image_url' => $imageUrl,
            'public_id' => $publicId,
        ]);

        return redirect()->back()->with('success', [
            'message' => 'Image uploaded successfully!',
            'imageName' => $request->imageName,
            'description' => $request->description,
            'imageUrl' => $imageUrl,
            'publicId' => $publicId,
        ]);
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
