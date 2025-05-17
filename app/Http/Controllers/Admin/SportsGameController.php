<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SportsGame;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class SportsGameController extends Controller
{
    public function index() {
        $sports = SportsGame::orderBy('title')->get();
        return view('admin.sports_games.index', compact('sports'));
    }

    public function create() {
        return view('admin.sports_games.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'nullable|string|max:255',
            'coach_name' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Upload to Cloudinary
        if ($request->hasFile('image')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET')
                ]
            ]);

            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'sports_games',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            );

            $data['image_url'] = $uploadedFile['secure_url'];
        }

        SportsGame::create($data);

        return redirect()->route('admin.sports_games.index')->with('success', 'Sports/Game created successfully.');
    }

    public function edit(SportsGame $sportsGame) {
        return view('admin.sports_games.edit', compact('sportsGame'));
    }

    public function update(Request $request, SportsGame $sportsGame) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'nullable|string|max:255',
            'coach_name' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Upload to Cloudinary
        if ($request->hasFile('image')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET')
                ]
            ]);

            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'sports_games',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            );

            $data['image_url'] = $uploadedFile['secure_url'];
        }

        $sportsGame->update($data);

        return redirect()->route('admin.sports_games.index')->with('success', 'Sports/Game updated successfully.');
    }

    public function destroy(SportsGame $sportsGame) {
        $sportsGame->delete();
        return redirect()->route('admin.sports_games.index')->with('success', 'Sports/Game deleted successfully.');
    }
}
