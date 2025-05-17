<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\CulturalCompetition;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class CulturalCompetitionController extends Controller
{
    public function index()
    {
        $competitions = CulturalCompetition::latest()->get();
        return view('admin.cultural_competitions.index', compact('competitions'));
    }

    public function create()
    {
        return view('admin.cultural_competitions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'competition_year' => 'required|string|max:4',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploadResponse = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), [
                'folder' => 'cultural_competitions',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image',
            ]);

            $validated['image_url'] = $uploadResponse['secure_url'];
        }

        CulturalCompetition::create($validated);

        return redirect()->route('admin.cultural_competitions.index')->with('success', 'Cultural competition added successfully.');
    }

    public function show(CulturalCompetition $culturalCompetition)
    {
        return view('admin.cultural_competitions.show', compact('culturalCompetition'));
    }

    public function edit(CulturalCompetition $culturalCompetition)
    {
        return view('admin.cultural_competitions.edit', compact('culturalCompetition'));
    }

    public function update(Request $request, CulturalCompetition $culturalCompetition)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'competition_year' => 'required|string|max:4',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploadResponse = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), [
                'folder' => 'cultural_competitions',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image',
            ]);

            $validated['image_url'] = $uploadResponse['secure_url'];
        }

        $culturalCompetition->update($validated);

        return redirect()->route('admin.cultural_competitions.index')->with('success', 'Cultural competition updated successfully.');
    }

    public function destroy(CulturalCompetition $culturalCompetition)
    {
        $culturalCompetition->delete();

        return redirect()->route('admin.cultural_competitions.index')->with('success', 'Cultural competition deleted successfully.');
    }
}
