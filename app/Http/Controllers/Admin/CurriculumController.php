<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class CurriculumController extends Controller
{
    public function frontend()
    {
        $curriculums = Curriculum::orderBy('class_group')->get();
        return view('admin.curriculam.curriculums', compact('curriculums'));
    }

    public function index()
    {
        $curriculums = Curriculum::orderBy('class_group')->get();
        return view('admin.curriculam.index', compact('curriculums'));
    }

    public function create()
    {
        $terms = ['Term 1', 'Term 2', 'Term 3', 'Term 4'];
        return view('admin.curriculam.create', compact('terms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_group' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'term' => 'required|string|max:50',
            'academic_year' => 'required|string|max:20',
            'syllabus_file' => 'required|file|mimes:pdf|max:51200',
        ]);

        try {
            $cloudinary = $this->cloudinary();

            $fileName = Str::slug($request->subject) . '_' . time() . '.pdf';
            $publicId = 'curriculums/' . Str::slug($request->subject) . '_' . uniqid() . '.pdf';


            $upload = $cloudinary->uploadApi()->upload(
                $request->file('syllabus_file')->getRealPath(),
                [
                    'public_id' => $publicId,
                    'resource_type' => 'raw',
                    'use_filename' => true,
                    'unique_filename' => false,
                    'overwrite' => true
                ]
            );

            $fileNameWithoutExt = Str::slug($request->subject) . '_' . time();
            $downloadUrl = str_replace(
                '/upload/',
                '/upload/fl_attachment:' . $fileNameWithoutExt . '.pdf/',
                $upload['secure_url']
            );



            Curriculum::create([
                'class_group' => $request->class_group,
                'subject' => $request->subject,
                'description' => $request->description,
                'term' => $request->term,
                'academic_year' => $request->academic_year,
                'document_url' => $downloadUrl,
                'public_id' => $publicId,
            ]);

            return redirect()->route('admin.curriculums.index')->with('success', 'Curriculum created successfully!');
        } catch (\Exception $e) {
            Log::error('Curriculum creation failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to create curriculum. Please try again.')->withInput();
        }
    }

    public function edit(Curriculum $curriculum)
    {
        $terms = ['Term 1', 'Term 2', 'Term 3', 'Term 4'];
        return view('admin.curriculam.edit', compact('curriculum', 'terms'));
    }

    public function update(Request $request, Curriculum $curriculum)
    {
        $request->validate([
            'class_group' => 'required|string|max:255',
            'term' => 'required|string|max:50',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'academic_year' => 'required|string|max:20',
            'syllabus_file' => 'nullable|file|mimes:pdf|max:51200',
        ]);

        try {
            $data = $request->only(['class_group', 'subject', 'description', 'term', 'academic_year']);

            if ($request->hasFile('syllabus_file')) {
                $cloudinary = $this->cloudinary();

                // Delete old file
                if ($curriculum->public_id) {
                    try {
                        $cloudinary->uploadApi()->destroy($curriculum->public_id, [
                            'resource_type' => 'raw'
                        ]);
                    } catch (\Exception $e) {
                        Log::error('Failed to delete old file: ' . $e->getMessage());
                    }
                }

                $fileName = Str::slug($request->subject) . '_' . time() . '.pdf';
                $publicId = 'curriculums/' . Str::slug($request->subject) . '_' . uniqid() . '.pdf';


                $upload = $cloudinary->uploadApi()->upload(
                    $request->file('syllabus_file')->getRealPath(),
                    [
                        'public_id' => $publicId,
                        'resource_type' => 'raw',
                        'use_filename' => true,
                        'unique_filename' => false,
                        'overwrite' => true
                    ]
                );

                $fileNameWithoutExt = Str::slug($request->subject) . '_' . time();
                $downloadUrl = str_replace(
                    '/upload/',
                    '/upload/fl_attachment:' . $fileNameWithoutExt . '.pdf/',
                    $upload['secure_url']
                );



                $data['document_url'] = $downloadUrl;
                $data['public_id'] = $publicId;
            }

            $curriculum->update($data);

            return redirect()->route('admin.curriculums.index')->with('success', 'Curriculum updated successfully.');
        } catch (\Exception $e) {
            Log::error('Curriculum update failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to update curriculum. Please try again.')->withInput();
        }
    }

    public function destroy(Curriculum $curriculum)
    {
        try {
            if ($curriculum->public_id) {
                $cloudinary = $this->cloudinary();
                $cloudinary->uploadApi()->destroy($curriculum->public_id, [
                    'resource_type' => 'raw'
                ]);
            }

            $curriculum->delete();

            return redirect()->route('admin.curriculums.index')->with('success', 'Curriculum deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Curriculum deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete curriculum. Please try again.');
        }
    }

    public function download($id)
    {
        $curriculum = Curriculum::findOrFail($id);

        if (!$curriculum->document_url) {
            return back()->with('error', 'No document available for download.');
        }

        return redirect($curriculum->document_url);
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
