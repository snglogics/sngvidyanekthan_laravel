<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StudentCouncil;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class StudentCouncilController extends Controller
{
    public function index()
    {
        $studentCouncils = StudentCouncil::latest()->get();
        return view('admin.student_council.index', compact('studentCouncils'));
    }

    public function create()
    {
        return view('admin.student_council.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('photo')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'student_council',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                ]
            );

            $validated['photo'] = $uploadResponse['secure_url'];
        }

        StudentCouncil::create($validated);

        return redirect()->route('admin.student_council.index')->with('success', 'Student Council member created successfully.');
    }

    public function edit(StudentCouncil $studentCouncil)
    {
        return view('admin.student_council.edit', compact('studentCouncil'));
    }

    public function update(Request $request, StudentCouncil $studentCouncil)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('photo')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'student_council',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                ]
            );

            $validated['photo'] = $uploadResponse['secure_url'];
        }

        $studentCouncil->update($validated);

        return redirect()->route('admin.student_council.index')->with('success', 'Student Council member updated successfully.');
    }

    public function destroy(StudentCouncil $studentCouncil)
    {
        $studentCouncil->delete();
        return redirect()->route('admin.student_council.index')->with('success', 'Student Council member deleted successfully.');
    }
}
