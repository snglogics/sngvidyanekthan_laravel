<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClubActivity;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class ClubActivityController extends Controller
{
    public function index()
    {
        $clubs = ClubActivity::latest()->paginate(10);
        return view('admin.clubs.index', compact('clubs'));
    }

    public function create()
    {
        return view('admin.clubs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image_url'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $upload = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'club_activities']
            );

            $data['image_url'] = $upload['secure_url'];
        }

        ClubActivity::create($data);

        return redirect()->route('admin.clubs.index')
                         ->with('success','Club activity created.');
    }

    public function edit(ClubActivity $club)
    {
        return view('admin.clubs.edit', compact('club'));
    }

    public function update(Request $request, ClubActivity $club)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image_url'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);
            // Optionally delete old one by parsing public_id
            $upload = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'club_activities']
            );
            $data['image_url'] = $upload['secure_url'];
        }

        $club->update($data);

        return redirect()->route('admin.clubs.index')
                         ->with('success','Club activity updated.');
    }

    public function destroy(ClubActivity $club)
    {
        $club->delete();
        return back()->with('success','Club activity removed.');
    }
}
