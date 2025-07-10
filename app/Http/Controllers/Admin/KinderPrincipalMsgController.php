<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KinderPrincipalMsg;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class KinderPrincipalMsgController extends Controller
{
    public function showForm()
    {
        $existingMsg = KinderPrincipalMsg::latest()->first();
        return view('admin.kinderPrincipalMsg', compact('existingMsg'));
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
                'folder' => 'kinder_principal',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image',
                'quality' => 'auto',
                'fetch_format' => 'auto',
            ]
        );

        KinderPrincipalMsg::create([
            'image_name' => $request->imageName,
            'image_header' => $request->imageHeader,
            'description' => $request->description,
            'image_url' => $uploadedFile['secure_url'],
            'public_id' => $uploadedFile['public_id'],
        ]);

        return redirect()->back()->with('success', 'Kinder Principal message uploaded successfully!');
    }

    public function update(Request $request, $id)
    {
        $msg = KinderPrincipalMsg::findOrFail($id);

        $request->validate([
            'imageName' => 'required|string|max:255',
            'description' => 'nullable|string',
            'imageHeader' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = $this->cloudinary();

            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'kinder_principal',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ]
            );

            $msg->image_url = $uploadedFile['secure_url'];
            $msg->public_id = $uploadedFile['public_id'];
        }

        $msg->image_name = $request->imageName;
        $msg->image_header = $request->imageHeader;
        $msg->description = $request->description;
        $msg->save();

        return redirect()->back()->with('success', 'Message updated successfully!');
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
