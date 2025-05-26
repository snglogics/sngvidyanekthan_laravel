<?php

namespace App\Http\Controllers;

use App\Models\AcademicPerformance;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;


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
        'roll_number' => 'required|string|max:255|unique:academic_performances',
        'class' => 'required|string|max:255',
        'section' => 'nullable|string|max:255',
        'subjects_marks' => 'required|string',
        'total_marks' => 'required|integer|min:0',
        'percentage' => 'required|numeric|min:0|max:100',
        'grade' => 'nullable|string|max:255',
        'performance_description' => 'nullable|string',
        'term' => 'required|string|max:255',
        'year' => 'required|string|max:255',
        'image_url' => 'nullable|image|max:2048',
    ]);

    // Initialize Cloudinary
    $cloudinary = new Cloudinary([
        'cloud' => [
            'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
            'api_key' => env('CLOUDINARY_API_KEY'),
            'api_secret' => env('CLOUDINARY_API_SECRET'),
        ],
    ]);

    // Handle Image Upload
    if ($request->hasFile('image_url')) {
        $uploadResponse = $cloudinary->uploadApi()->upload($request->file('image_url')->getRealPath(), [
            'folder' => 'academic_performances',
            'public_id' => uniqid(),
            'overwrite' => true,
            'resource_type' => 'image',
        ]);

        // Save the secure URL
        $validated['image_url'] = $uploadResponse['secure_url'];
    }

    // Save the Academic Performance Record
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
        'student_name'            => 'required|string|max:255',
        'roll_number'             => 'required|string|max:255|unique:academic_performances,roll_number,' . $academicPerformance->id,
        'class'                   => 'required|string|max:255',
        'section'                 => 'nullable|string|max:255',
        'subjects_marks'          => 'required|json',
        'total_marks'             => 'required|integer|min:0',
        'percentage'              => 'required|numeric|min:0|max:100',
        'grade'                   => 'nullable|string|max:255',
        'performance_description' => 'nullable|string',
        'term'                    => 'required|string|max:255',
        'year'                    => 'required|string|max:255',
        'image_file'              => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Handle new image upload
    if ($request->hasFile('image_file')) {
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        // delete old one
        if ($academicPerformance->image_url) {
            $publicId = pathinfo($academicPerformance->image_url, PATHINFO_FILENAME);
            $cloudinary->uploadApi()->destroy("academic_performances/{$publicId}", ['resource_type'=>'image']);
        }

        $upload = $cloudinary->uploadApi()->upload(
            $request->file('image_file')->getRealPath(),
            ['folder'=>'academic_performances','public_id'=>uniqid()]
        );

        $validated['image_url'] = $upload['secure_url'];
    }

    $academicPerformance->update($validated);

    return redirect()
        ->route('admin.academic_performances.index')
        ->with('success', 'Academic performance updated successfully.');
}


    public function destroy(AcademicPerformance $academicPerformance)
{
    if ($academicPerformance->image_url) {
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        // derive the public_id from the URL
        // e.g. https://res.cloudinary.com/…/academic_performances/abc123.jpg
        $pathParts = pathinfo($academicPerformance->image_url);
        $publicId = 'academic_performances/' . $pathParts['filename'];

        // delete via the upload API
        $cloudinary->uploadApi()->destroy($publicId, [
            'resource_type' => 'image'
        ]);
    }

    $academicPerformance->delete();

    return redirect()
        ->route('admin.academic_performances.index')
        ->with('success', 'Academic performance deleted successfully.');
}

}
