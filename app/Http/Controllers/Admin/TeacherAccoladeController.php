<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherAccolade;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

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
            'year' => 'required|string|max:4',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploadResponse = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), [
                'folder' => 'teachers_accolades',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image',
            ]);

            $validated['image_url'] = $uploadResponse['secure_url'];
        }

        TeacherAccolade::create($validated);

        return redirect()->route('admin.teachers_accolades.index')->with('success', 'Teacher accolade added successfully.');
    }

    public function show(TeacherAccolade $teacherAccolade)
    {
        return view('admin.teachers_accolades.edit', compact('teacherAccolade'));
    }

    public function edit(TeacherAccolade $teacherAccolade)
{
    return view('admin.teachers_accolades.edit', compact('teacherAccolade'));
}
    public function update(Request $request, TeacherAccolade $teacherAccolade)
    {
        $validated = $request->validate([
            'teacher_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploadResponse = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), [
                'folder' => 'teachers_accolades',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image',
            ]);

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
}
