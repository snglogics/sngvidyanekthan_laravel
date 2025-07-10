<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InterschoolParticipation;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

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
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'position' => 'nullable|string|max:255',
            'school_name' => 'required|string|max:255',
            'remarks' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $cloudinary = $this->cloudinary();

            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'interschool_participations',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ]
            );

            $validated['photo_url'] = $uploadResponse['secure_url'];
        }

        InterschoolParticipation::create($validated);

        return redirect()->route('admin.interschool-participations.index')
            ->with('success', 'Participation record added successfully!');
    }

    public function edit(InterschoolParticipation $interschoolParticipation)
    {
        return view('admin.interschool_participations.edit', compact('interschoolParticipation'));
    }

    public function update(Request $request, InterschoolParticipation $interschoolParticipation)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'position' => 'nullable|string|max:255',
            'school_name' => 'required|string|max:255',
            'remarks' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $cloudinary = $this->cloudinary();

            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'interschool_participations',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ]
            );

            $validated['photo_url'] = $uploadResponse['secure_url'];
        } else {
            // Preserve existing photo_url if no new photo uploaded
            $validated['photo_url'] = $interschoolParticipation->photo_url;
        }

        $interschoolParticipation->update($validated);

        return redirect()->route('admin.interschool-participations.index')
            ->with('success', 'Participation record updated successfully!');
    }

    public function destroy(InterschoolParticipation $interschoolParticipation)
    {
        $interschoolParticipation->delete();

        return redirect()->route('admin.interschool-participations.index')
            ->with('success', 'Participation record deleted successfully!');
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
