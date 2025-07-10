<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StudentCouncil;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentCouncilController extends Controller
{
    /**
     * Display a listing of student council members
     */
    public function index(): View
    {
        $studentCouncils = StudentCouncil::latest()->get();
        return view('admin.student_council.index', compact('studentCouncils'));
    }

    /**
     * Show the form for creating a new student council member
     */
    public function create(): View
    {
        return view('admin.student_council.create');
    }

    /**
     * Store a newly created student council member
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'student_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('photo')) {
            $cloudinary = $this->cloudinary();
            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'student_council',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                ]
            );
            $data['photo'] = $uploadResponse['secure_url'];
        }

        StudentCouncil::create($data);

        return redirect()->route('admin.student_council.index')
            ->with('success', 'Student Council member created successfully.');
    }

    /**
     * Show the form for editing a student council member
     */
    public function edit(StudentCouncil $studentCouncil): View
    {
        return view('admin.student_council.edit', compact('studentCouncil'));
    }

    /**
     * Update the specified student council member
     */
    public function update(Request $request, StudentCouncil $studentCouncil): RedirectResponse
    {
        $data = $request->validate([
            'student_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('photo')) {
            $cloudinary = $this->cloudinary();

            // Delete old photo if exists
            if ($studentCouncil->photo) {
                $publicId = $this->extractPublicId($studentCouncil->photo);
                if ($publicId) {
                    $cloudinary->uploadApi()->destroy($publicId, ['resource_type' => 'image']);
                }
            }

            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'student_council',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                ]
            );
            $data['photo'] = $uploadResponse['secure_url'];
        }

        $studentCouncil->update($data);

        return redirect()->route('admin.student_council.index')
            ->with('success', 'Student Council member updated successfully.');
    }

    /**
     * Remove the specified student council member
     */
    public function destroy(StudentCouncil $studentCouncil): RedirectResponse
    {
        // Delete photo from Cloudinary if exists
        if ($studentCouncil->photo) {
            $cloudinary = $this->cloudinary();
            $publicId = $this->extractPublicId($studentCouncil->photo);
            if ($publicId) {
                $cloudinary->uploadApi()->destroy($publicId, ['resource_type' => 'image']);
            }
        }

        $studentCouncil->delete();

        return redirect()->route('admin.student_council.index')
            ->with('success', 'Student Council member deleted successfully.');
    }

    /**
     * DRY helper for Cloudinary initialization
     */
    private function cloudinary(): Cloudinary
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

    /**
     * Helper method to extract Cloudinary public_id from URL
     */
    private function extractPublicId(string $url): ?string
    {
        $parsedUrl = parse_url($url);
        if (!isset($parsedUrl['path'])) {
            return null;
        }

        $path = $parsedUrl['path'];
        $pathParts = explode('/', $path);

        $uploadIndex = array_search('upload', $pathParts);
        if ($uploadIndex === false) {
            return null;
        }

        $publicIdParts = array_slice($pathParts, $uploadIndex + 2);
        if (empty($publicIdParts)) {
            return null;
        }

        $publicIdWithExtension = implode('/', $publicIdParts);
        return preg_replace('/\.[^.]+$/', '', $publicIdWithExtension);
    }
}
