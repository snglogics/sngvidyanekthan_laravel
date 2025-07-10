<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManagerMsg;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Log;

class ManagerImageUploadController extends Controller
{
    public function showForm()
    {
        $existingMsg = ManagerMsg::latest()->first();
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

        try {
            $uploadedFile = $this->cloudinary()->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'manager_msgs']
            );

            ManagerMsg::create([
                'image_name' => $request->imageName,
                'description' => $request->description,
                'image_header' => $request->imageHeader,
                'image_url' => $uploadedFile['secure_url'],
                'public_id' => $uploadedFile['public_id'],
            ]);

            return redirect()->back()->with('success', 'Manager message "' . $request->imageName . '" uploaded successfully!');
        } catch (\Exception $e) {
            Log::error('Manager message upload failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Upload failed: ' . $e->getMessage());
        }
    }

    /**
     * DRY Cloudinary initialization
     */
    private function cloudinary()
    {
        return new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);
    }
}
