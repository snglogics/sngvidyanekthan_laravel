<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PTAMember;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Support\Facades\Log;

class PTAMemberController extends Controller
{
    private $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary(new Configuration([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key'    => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => ['secure' => true],
        ]));
    }

    public function index()
    {
        $members = PTAMember::latest()->get();
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

        try {
            if ($request->hasFile('image')) {
                $uploadedFile = $this->cloudinary->uploadApi()->upload(
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
                $data['public_id'] = $uploadedFile['public_id'] ?? null;
            }

            PTAMember::create($data);

            return redirect()->route('admin.pta-members.index')->with('success', 'PTA member added successfully.');
        } catch (\Exception $e) {
            Log::error('PTA member upload failed: ' . $e->getMessage());
            return back()->with('error', 'Upload failed: ' . $e->getMessage());
        }
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

        try {
            if ($request->hasFile('image')) {
                if ($ptaMember->public_id) {
                    $this->cloudinary->uploadApi()->destroy($ptaMember->public_id);
                }

                $uploadedFile = $this->cloudinary->uploadApi()->upload(
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
                $data['public_id'] = $uploadedFile['public_id'] ?? null;
            }

            $ptaMember->update($data);

            return redirect()->route('admin.pta-members.index')->with('success', 'PTA member updated successfully.');
        } catch (\Exception $e) {
            Log::error('PTA member update failed: ' . $e->getMessage());
            return back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function destroy(PTAMember $ptaMember)
    {
        try {
            if ($ptaMember->public_id) {
                $this->cloudinary->uploadApi()->destroy($ptaMember->public_id);
            }

            $ptaMember->delete();

            return redirect()->back()->with('success', 'PTA member deleted successfully.');
        } catch (\Exception $e) {
            Log::error('PTA member deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Deletion failed: ' . $e->getMessage());
        }
    }

    public function showPTAPage()
    {
        $members = PTAMember::all();

        // Group by lowercase trimmed key
        $grouped = $members->groupBy(function ($member) {
            return strtolower(trim($member->position));
        });

        // Force consistent heading for each group (avoid case duplication)
        $ptaMembers = $grouped->mapWithKeys(function ($group) {
            $displayKey = ucfirst(strtolower(trim($group->first()->position))); // Always "President"
            return [$displayKey => $group];
        });

        return view('frontend.pta', compact('ptaMembers'));
    }
}
