<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SportsGame;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Support\Facades\Log;

class SportsGameController extends Controller
{
    public function index()
    {
        $sports = SportsGame::orderBy('title')->get();
        return view('admin.sports_games.index', compact('sports'));
    }

    public function create()
    {
        return view('admin.sports_games.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'nullable|string|max:255',
            'coach_name' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $cloudinary = $this->cloudinary();

                $uploadedFile = $cloudinary->uploadApi()->upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'sports_games',
                        'public_id' => 'sport_' . uniqid(),
                        'overwrite' => true,
                        'resource_type' => 'image',
                        'quality' => 'auto',
                        'fetch_format' => 'auto'
                    ]
                );

                $data['image_url'] = $uploadedFile['secure_url'];
                $data['public_id'] = $uploadedFile['public_id'];
            }

            SportsGame::create($data);

            return redirect()->route('admin.sports_games.index')
                ->with('success', 'Sports/Game created successfully.');
        } catch (\Exception $e) {
            Log::error('Sports Game creation failed: ' . $e->getMessage());
            return back()->with('error', 'Sports/Game creation failed: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(SportsGame $sportsGame)
    {
        return view('admin.sports_games.edit', compact('sportsGame'));
    }

    public function update(Request $request, SportsGame $sportsGame)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'nullable|string|max:255',
            'coach_name' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $cloudinary = $this->cloudinary();

                // Delete old image if exists
                if ($sportsGame->public_id) {
                    $cloudinary->uploadApi()->destroy($sportsGame->public_id);
                }

                $uploadedFile = $cloudinary->uploadApi()->upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'sports_games',
                        'public_id' => 'sport_' . uniqid(),
                        'overwrite' => true,
                        'resource_type' => 'image',
                        'quality' => 'auto',
                        'fetch_format' => 'auto'
                    ]
                );

                $data['image_url'] = $uploadedFile['secure_url'];
                $data['public_id'] = $uploadedFile['public_id'];
            }

            $sportsGame->update($data);

            return redirect()->route('admin.sports_games.index')
                ->with('success', 'Sports/Game updated successfully.');
        } catch (\Exception $e) {
            Log::error('Sports Game update failed: ' . $e->getMessage());
            return back()->with('error', 'Sports/Game update failed: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(SportsGame $sportsGame)
    {
        try {
            if ($sportsGame->public_id) {
                $cloudinary = $this->cloudinary();
                $cloudinary->uploadApi()->destroy($sportsGame->public_id);
            }

            $sportsGame->delete();

            return redirect()->route('admin.sports_games.index')
                ->with('success', 'Sports/Game deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Sports Game deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Sports/Game deletion failed: ' . $e->getMessage());
        }
    }

    /**
     * DRY helper for consistent Cloudinary initialization
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
