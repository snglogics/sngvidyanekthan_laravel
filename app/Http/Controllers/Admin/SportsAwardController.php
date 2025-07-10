<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SportsAward;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Log;

class SportsAwardController extends Controller
{
    public function index()
    {
        $awards = SportsAward::latest()->paginate(10);
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

        try {
            if ($request->hasFile('image')) {
                $uploadResponse = $this->cloudinary()->uploadApi()->upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'sports_awards',
                        'public_id' => uniqid(),
                        'overwrite' => true,
                        'resource_type' => 'image',
                    ]
                );

                $validated['image_url'] = $uploadResponse['secure_url'];
                $validated['public_id'] = $uploadResponse['public_id'] ?? null;
            }

            SportsAward::create($validated);

            return redirect()->route('admin.sports_awards.index')->with('success', 'Sports award created successfully.');
        } catch (\Exception $e) {
            Log::error('Sports award upload failed: ' . $e->getMessage());
            return back()->with('error', 'Upload failed: ' . $e->getMessage());
        }
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

        try {
            if ($request->hasFile('image')) {
                if ($sportsAward->public_id) {
                    $this->cloudinary()->uploadApi()->destroy($sportsAward->public_id);
                }

                $uploadResponse = $this->cloudinary()->uploadApi()->upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'sports_awards',
                        'public_id' => uniqid(),
                        'overwrite' => true,
                        'resource_type' => 'image',
                    ]
                );

                $validated['image_url'] = $uploadResponse['secure_url'];
                $validated['public_id'] = $uploadResponse['public_id'] ?? null;
            }

            $sportsAward->update($validated);

            return redirect()->route('admin.sports_awards.index')->with('success', 'Sports award updated successfully.');
        } catch (\Exception $e) {
            Log::error('Sports award update failed: ' . $e->getMessage());
            return back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function destroy(SportsAward $sportsAward)
    {
        try {
            if ($sportsAward->public_id) {
                $this->cloudinary()->uploadApi()->destroy($sportsAward->public_id);
            }

            $sportsAward->delete();

            return redirect()->route('admin.sports_awards.index')->with('success', 'Sports award deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Sports award deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Deletion failed: ' . $e->getMessage());
        }
    }

    private function cloudinary()
    {
        return new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key' => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);
    }
}
