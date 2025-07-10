<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SportsAward;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class SportsAwardController extends Controller
{
    public function index()
    {
        $awards = SportsAward::latest()->get();
        return view('admin.sports_awards.index', compact('awards'));
    }

    public function create()
    {
        return view('admin.sports_awards.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'award_year' => 'required|string|max:4',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = $this->cloudinary();

            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'sports_awards',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            );

            $validated['image_url'] = $uploadResponse['secure_url'];
        }

        SportsAward::create($validated);

        return redirect()->route('admin.sports_awards.index')->with('success', 'Sports award created successfully.');
    }

    public function show(SportsAward $sportsAward)
    {
        return view('admin.sports_awards.show', compact('sportsAward'));
    }

    public function edit(SportsAward $sportsAward)
    {
        return view('admin.sports_awards.edit', compact('sportsAward'));
    }

    public function update(Request $request, SportsAward $sportsAward)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'award_year' => 'required|string|max:4',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = $this->cloudinary();

            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'sports_awards',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            );

            $validated['image_url'] = $uploadResponse['secure_url'];
        }

        $sportsAward->update($validated);

        return redirect()->route('admin.sports_awards.index')->with('success', 'Sports award updated successfully.');
    }

    public function destroy(SportsAward $sportsAward)
    {
        $sportsAward->delete();

        return redirect()->route('admin.sports_awards.index')->with('success', 'Sports award deleted successfully.');
    }

    /**
     * DRY helper for consistent Cloudinary initialization.
     */
    private function cloudinary()
    {
        $config = new Configuration([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key'    => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        return new Cloudinary($config);
    }
}
