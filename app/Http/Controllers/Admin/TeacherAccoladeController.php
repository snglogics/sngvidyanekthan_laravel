<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherAccolade;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class TeacherAccoladeController extends Controller
{
    public function index()
    {
        $accolades = TeacherAccolade::latest()->get();
        return view('admin.teachers_accolades.index', compact('accolades'));
    }

    public function create()
    {
        return view('admin.teachers_accolades.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'year' => 'nullable|string|max:4',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = $this->cloudinary();

            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'teachers_accolades',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            );

            $validated['image_url'] = $uploadResponse['secure_url'];
        }

        TeacherAccolade::create($validated);

        return redirect()->route('admin.teachers_accolades.index')->with('success', 'Teacher accolade added successfully.');
    }

    public function update(Request $request, TeacherAccolade $teacherAccolade)
    {
        $validated = $request->validate([
            'teacher_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'year' => 'nullable|string|max:4',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = $this->cloudinary();

            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'teachers_accolades',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            );

            $validated['image_url'] = $uploadResponse['secure_url'];
        }

        $teacherAccolade->update($validated);

        return redirect()->route('admin.teachers_accolades.index')->with('success', 'Teacher accolade updated successfully.');
    }

    public function destroy(TeacherAccolade $teacherAccolade)
    {
        $teacherAccolade->delete();

        return redirect()->route('admin.teachers_accolades.index')->with('success', 'Teacher accolade deleted successfully.');
    }

    /**
     * DRY helper for Cloudinary initialization
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
            ],
        ]);

        return new Cloudinary($config);
    }
}
