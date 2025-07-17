<?php

namespace App\Http\Controllers;

use App\Models\AcademicPerformance;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class AcademicPerformanceController extends Controller
{
    public function index()
    {
        $performances = AcademicPerformance::all();
        return view('admin.academic_performances.index', compact('performances'));
    }

    public function create()
    {
        return view('admin.academic_performances.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0|max:100',
            'performance_description' => 'nullable|string',
            'term' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'image_url' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            $cloudinary = $this->cloudinary();

            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('image_url')->getRealPath(),
                [
                    'folder' => 'academic_performances',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                ]
            );

            $validated['image_url'] = $uploadResponse['secure_url'];
        }

        AcademicPerformance::create($validated);

        return redirect()->route('admin.academic_performances.index')->with('success', 'Academic performance added successfully.');
    }

    public function show(AcademicPerformance $academicPerformance)
    {
        return view('academic_performances.show', compact('academicPerformance'));
    }

    public function edit(AcademicPerformance $academicPerformance)
    {
        return view('admin.academic_performances.edit', compact('academicPerformance'));
    }

    public function update(Request $request, AcademicPerformance $academicPerformance)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0|max:100',
            'performance_description' => 'nullable|string',
            'term' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image_file')) {
            $cloudinary = $this->cloudinary();

            if ($academicPerformance->image_url) {
                $publicId = 'academic_performances/' . pathinfo($academicPerformance->image_url, PATHINFO_FILENAME);
                $cloudinary->uploadApi()->destroy($publicId, ['resource_type' => 'image']);
            }

            $upload = $cloudinary->uploadApi()->upload(
                $request->file('image_file')->getRealPath(),
                [
                    'folder' => 'academic_performances',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                ]
            );

            $validated['image_url'] = $upload['secure_url'];
        }

        $academicPerformance->update($validated);

        return redirect()->route('admin.academic_performances.index')->with('success', 'Academic performance updated successfully.');
    }

    public function destroy(AcademicPerformance $academicPerformance)
    {
        if ($academicPerformance->image_url) {
            $cloudinary = $this->cloudinary();

            $publicId = 'academic_performances/' . pathinfo($academicPerformance->image_url, PATHINFO_FILENAME);
            $cloudinary->uploadApi()->destroy($publicId, [
                'resource_type' => 'image',
            ]);
        }

        $academicPerformance->delete();

        return redirect()->route('admin.academic_performances.index')->with('success', 'Academic performance deleted successfully.');
    }

    private function cloudinary()
    {
        $config = new Configuration([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key' => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => ['secure' => true],
        ]);

        return new Cloudinary($config);
    }
}
