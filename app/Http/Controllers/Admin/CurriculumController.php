<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CurriculumController extends Controller
{
    public function frontend() {
        $curriculums = Curriculum::orderBy('class_group')->get();
        return view('admin.curriculam.curriculums', compact('curriculums'));
    }
    public function index() {
        $curriculums = Curriculum::orderBy('class_group')->get();
        return view('admin.curriculam.index', compact('curriculums'));
    }

    public function create(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                'class_group' => 'required',
                'subject' => 'required',
                'description' => 'required',
                'term' => 'required',
                'academic_year' => 'required',
                'syllabus_file' => 'nullable|file|mimes:pdf|max:2048',
            ]);

            $data = $request->all();

            // Handle file upload
            if ($request->hasFile('syllabus_file')) {
                $path = $request->file('syllabus_file')->store('curriculums', 'public');
                $data['document_url'] = asset('storage/' . $path);
            }

            Curriculum::create($data);

            return redirect()->route('admin.curriculums.index')->with('success', 'Curriculum created successfully.');
        }

        $terms = ['Term 1', 'Term 2', 'Term 3', 'Term 4'];
        return view('admin.curriculam.create', compact('terms'));
    }

    public function edit(Curriculum $curriculum) {
        $terms = ['Term 1', 'Term 2', 'Term 3', 'Term 4'];
        return view('admin.curriculam.edit', compact('curriculum', 'terms'));
    }

    public function update(Request $request, Curriculum $curriculum) {
        $request->validate([
            'class_group' => 'required',
            'term' => 'required',
            'subject' => 'required',
            'description' => 'required',
            'academic_year' => 'required',
            'syllabus_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('syllabus_file')) {
            // Delete old file if exists
            if ($curriculum->document_url) {
                $filePath = str_replace(asset('storage/'), '', $curriculum->document_url);
                Storage::disk('public')->delete($filePath);
            }

            $path = $request->file('syllabus_file')->store('curriculums', 'public');
            $data['document_url'] = asset('storage/' . $path);
        }

        $curriculum->update($data);

        return redirect()->route('admin.curriculums.index')->with('success', 'Curriculum updated successfully.');
    }

    public function destroy(Curriculum $curriculum) {
        if ($curriculum->document_url) {
            $filePath = str_replace(asset('storage/'), '', $curriculum->document_url);
            Storage::disk('public')->delete($filePath);
        }

        $curriculum->delete();

        return redirect()->route('admin.curriculums.index')->with('success', 'Curriculum deleted successfully.');
    }
}
