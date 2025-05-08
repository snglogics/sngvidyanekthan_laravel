<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index() {
        $curriculums = Curriculum::orderBy('class_group')->get();
        return view('admin.curriculums.index', compact('curriculums'));
    }

    public function create() {
        return view('admin.curriculums.create');
    }

    public function store(Request $request) {
        $request->validate([
            'class_group' => 'required',
            'subject' => 'required',
            'description' => 'required',
            'academic_year' => 'required',
            'document_url' => 'nullable|url',
        ]);

        Curriculum::create($request->all());
        return redirect()->back()->with('success', 'Curriculum created successfully.');
    }

    public function edit(Curriculum $curriculum) {
        return view('admin.curriculums.edit', compact('curriculum'));
    }

    public function update(Request $request, Curriculum $curriculum) {
        $request->validate([
            'class_group' => 'required',
            'subject' => 'required',
            'description' => 'required',
            'academic_year' => 'required',
            'document_url' => 'nullable|url',
        ]);

        $curriculum->update($request->all());
        return redirect()->back()->with('success', 'Curriculum updated successfully.');
    }

    public function destroy(Curriculum $curriculum) {
        $curriculum->delete();
        return redirect()->back()->with('success', 'Curriculum deleted successfully.');
    }
}
