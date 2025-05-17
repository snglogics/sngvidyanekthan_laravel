<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InterschoolParticipation;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class InterschoolParticipationController extends Controller
{
    public function index()
    {
        $participations = InterschoolParticipation::latest()->paginate(10);
        return view('admin.interschool_participations.index', compact('participations'));
    }

    public function create()
    {
        return view('admin.interschool_participations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'position' => 'nullable|string|max:255',
            'school_name' => 'required|string|max:255',
            'remarks' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $photoUrl = null;
        if ($request->hasFile('photo')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploadResponse = $cloudinary->uploadApi()->upload($request->file('photo')->getRealPath(), [
                'folder' => 'interschool_participations',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image',
            ]);

            $photoUrl = $uploadResponse['secure_url'];
        }

        InterschoolParticipation::create(array_merge($request->all(), [
            'photo_url' => $photoUrl,
        ]));

        return redirect()->route('admin.interschool-participations.index')->with('success', 'Participation record added successfully!');
    }

    public function edit(InterschoolParticipation $interschoolParticipation)
    {
        return view('admin.interschool_participations.edit', compact('interschoolParticipation'));
    }

    public function update(Request $request, InterschoolParticipation $interschoolParticipation)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'position' => 'nullable|string|max:255',
            'school_name' => 'required|string|max:255',
            'remarks' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $photoUrl = $interschoolParticipation->photo_url;
        if ($request->hasFile('photo')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploadResponse = $cloudinary->uploadApi()->upload($request->file('photo')->getRealPath(), [
                'folder' => 'interschool_participations',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image',
            ]);

            $photoUrl = $uploadResponse['secure_url'];
        }

        $interschoolParticipation->update(array_merge($request->all(), [
            'photo_url' => $photoUrl,
        ]));

        return redirect()->route('admin.interschool-participations.index')->with('success', 'Participation record updated successfully!');
    }

    public function destroy(InterschoolParticipation $interschoolParticipation)
    {
        $interschoolParticipation->delete();
        return redirect()->route('admin.interschool-participations.index')->with('success', 'Participation record deleted successfully!');
    }
}

