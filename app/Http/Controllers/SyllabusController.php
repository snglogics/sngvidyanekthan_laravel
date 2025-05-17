<?php

namespace App\Http\Controllers;

use App\Models\Syllabus;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class SyllabusController extends Controller
{

    public function publicList()
    {
        $syllabuses = Syllabus::orderBy('classname')->orderBy('subject')->get();
        return view('admin.syllabuses.syllabus-list', compact('syllabuses'));
    }

    public function index()
    {
        $syllabuses = Syllabus::orderBy('classname')->orderBy('subject')->get();
        return view('admin.syllabuses.index', compact('syllabuses'));
    }

    public function create()
    {
        return view('admin.syllabuses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'classname' => 'required|string|max:255',
            'section' => 'nullable|string|max:100',
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:10240',
            'academic_year' => 'required|string|max:50',
        ]);

        // Upload PDF to Cloudinary if provided
        $pdfUrl = null;
        if ($request->hasFile('pdf')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ]
            ]);

            $uploadedFile = $cloudinary->uploadApi()->upload($request->file('pdf')->getRealPath(), [
                'folder' => 'syllabus_files',
                'public_id' => uniqid(),
                'resource_type' => 'raw'
            ]);

            $pdfUrl = $uploadedFile['secure_url'];
        }

        // Save syllabus data
        Syllabus::create([
            'classname' => $request->classname,
            'section' => $request->section,
            'subject' => $request->subject,
            'description' => $request->description,
            'pdf_url' => $pdfUrl,
            'academic_year' => $request->academic_year,
        ]);

        return redirect()->route('admin.syllabuses.index')->with('success', 'Syllabus added successfully!');
    }

    public function edit($id)
{
    $syllabus = Syllabus::findOrFail($id);
    return view('admin.syllabuses.edit', compact('syllabus'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'classname' => 'required|string|max:255',
        'section' => 'nullable|string|max:100',
        'subject' => 'required|string|max:255',
        'description' => 'nullable|string',
        'pdf' => 'nullable|file|mimes:pdf|max:10240',
        'academic_year' => 'required|string|max:50',
    ]);

    $syllabus = Syllabus::findOrFail($id);
    $pdfUrl = $syllabus->pdf_url;

    if ($request->hasFile('pdf')) {
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ]
        ]);

        $uploadedFile = $cloudinary->uploadApi()->upload($request->file('pdf')->getRealPath(), [
            'folder' => 'syllabus_files',
            'public_id' => uniqid(),
            'resource_type' => 'raw'
        ]);

        $pdfUrl = $uploadedFile['secure_url'];
    }

    $syllabus->update([
        'classname' => $request->classname,
        'section' => $request->section,
        'subject' => $request->subject,
        'description' => $request->description,
        'pdf_url' => $pdfUrl,
        'academic_year' => $request->academic_year,
    ]);

    return redirect()->route('admin.syllabuses.index')->with('success', 'Syllabus updated successfully!');
}

  public function destroy($id)
  {
      $syllabus = Syllabus::findOrFail($id);
      $syllabus->delete();

      return redirect()->route('admin.syllabuses.index')->with('success', 'Syllabus deleted successfully!');
  }  
}
