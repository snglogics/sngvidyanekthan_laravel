<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrincipalMsg;
// use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Cloudinary;
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

    // ✅ Upload to Cloudinary using Storage disk
    $cloudinary = new Cloudinary([
        'cloud' => [
            'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
            'api_key'    => env('CLOUDINARY_API_KEY'),
            'api_secret' => env('CLOUDINARY_API_SECRET'),
        ],
    ]);
    
    // Now upload
    $uploadedFile = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), [
        'folder' => 'principal_msgs',
    ]);
    
    $imageUrl = $uploadedFile['secure_url'];
    $publicId = $uploadedFile['public_id'];

    // ✅ Save into database
    PrincipalMsg::create([
        'image_name' => $request->imageName,
        'description' => $request->description,
        'image_header' => $request->imageHeader,
        'image_url' =>  $imageUrl,
        'public_id' => $publicId, // save public id to delete later
    ]);

    return redirect()->back()->with('success', [
        'message' => 'Image uploaded successfully!',
        'imageName' => $request->imageName,
        'description' => $request->description,
        'imageUrl' => $imageUrl,
        'publicId' => $publicId,
    ]);
}



}
