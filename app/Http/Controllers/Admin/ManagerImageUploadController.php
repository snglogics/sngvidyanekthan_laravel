<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManagerMsg; // 👈 New model
use Cloudinary\Cloudinary;

class ManagerImageUploadController extends Controller
{
    public function showForm()
    {
        $existingMsg = ManagerMsg::latest()->first(); // Get most recent
    return view('admin.managerMsg', compact('existingMsg'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'imageName' => 'required|string|max:255',
            'description' => 'nullable|string',
            'imageHeader' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        $uploadedFile = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), [
            'folder' => 'manager_msgs',
        ]);

        $imageUrl = $uploadedFile['secure_url'];
        $publicId = $uploadedFile['public_id'];

        ManagerMsg::create([
            'image_name' => $request->imageName,
            'description' => $request->description,
            'image_header' => $request->imageHeader,
            'image_url' =>  $imageUrl,
            'public_id' => $publicId,
        ]);

        return redirect()->back()->with('success', 'Manager message uploaded successfully!');
    }
}
