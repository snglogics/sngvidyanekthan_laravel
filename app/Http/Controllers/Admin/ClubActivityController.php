<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClubActivity;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

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
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = $this->cloudinary();

            $upload = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'club_activities']
            );

            $data['image_url'] = $upload['secure_url'];
        }

        ClubActivity::create($data);

        return redirect()->route('admin.clubs.index')
            ->with('success', 'Club activity created.');
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
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = $this->cloudinary();

            // Optional: Delete old image from Cloudinary if you store public_id
            // if ($club->cloudinary_public_id) {
            //     $cloudinary->uploadApi()->destroy($club->cloudinary_public_id);
            // }

            $upload = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'club_activities']
            );

            $data['image_url'] = $upload['secure_url'];
            // $data['cloudinary_public_id'] = $upload['public_id'];
        }

        $club->update($data);

        return redirect()->route('admin.clubs.index')
            ->with('success', 'Club activity updated.');
    }

    public function destroy(ClubActivity $club)
    {
        $club->delete();
        return back()->with('success', 'Club activity removed.');
    }

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
