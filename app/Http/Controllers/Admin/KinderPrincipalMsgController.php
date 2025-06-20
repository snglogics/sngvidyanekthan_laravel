<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KinderPrincipalMsg;
use Cloudinary\Cloudinary;

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

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        $uploadedFile = $cloudinary->uploadApi()->upload(
            $request->file('image')->getRealPath(),
            ['folder' => 'kinder_principal']
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
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'kinder_principal']
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

    
}
