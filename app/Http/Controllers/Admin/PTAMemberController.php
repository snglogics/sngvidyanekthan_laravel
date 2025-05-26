<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PTAMember;
use Cloudinary\Cloudinary;

class PTAMemberController extends Controller
{
    public function index()
    {
        $members = PTAMember::all();
        return view('admin.pta_members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.pta_members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'position']);

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
                    'folder' => 'pta_members',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            );

            $data['image_url'] = $uploadedFile['secure_url'];
        }

        PTAMember::create($data);

        return redirect()->route('admin.pta-members.index')->with('success', 'PTA Member added successfully.');
    }

    public function edit(PTAMember $ptaMember)
    {
        return view('admin.pta_members.edit', compact('ptaMember'));
    }

    public function update(Request $request, PTAMember $ptaMember)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'position']);

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
                    'folder' => 'pta_members',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            );

            $data['image_url'] = $uploadedFile['secure_url'];
        }

        $ptaMember->update($data);

        return redirect()->route('admin.pta-members.index')->with('success', 'PTA Member updated successfully.');
    }

    public function destroy(PTAMember $ptaMember)
    {
        $ptaMember->delete();
        return redirect()->back()->with('success', 'Member deleted.');
    }

    public function showPTAPage()
{
    $members = PTAMember::all()->groupBy('position');

    return view('frontend.pta', compact('members'));
}
}

