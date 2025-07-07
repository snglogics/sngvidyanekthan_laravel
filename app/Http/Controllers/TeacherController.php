<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Cloudinary\Cloudinary;

class TeacherController extends Controller
{
    public function publicList()
    {
        $teachers = Teacher::latest()->get();
        return view('about.teacherslist', compact('teachers'));
    }

    public function teacherProfile(Teacher $teacher)
    {
        $teachers = Teacher::all();
        return view('about.teacherProfile', compact('teachers'));
    }

    public function categorizedList(Request $request)
    {
        $departments = Teacher::distinct()->pluck('department')->sort();
        $subjects = Teacher::distinct()->pluck('subject')->sort();

        $teachers = Teacher::query();

        if ($request->department) {
            $teachers->where('department', $request->department);
        }

        if ($request->subject) {
            $teachers->where('subject', $request->subject);
        }

        return view('about.teachers_categories', [
            'teachers' => $teachers->get(),
            'departments' => $departments,
            'subjects' => $subjects,
        ]);
    }


    public function index()
    {
        $teachers = Teacher::latest()->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'experience' => 'nullable|integer',
            'qualification' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photoUrl = null;
        if ($request->hasFile('photo')) {
            $cloudinary = new Cloudinary();

            $uploadResult = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'teachers',
                    'transformation' => [
                        ['width' => 400, 'height' => 400, 'crop' => 'limit', 'quality' => 'auto']
                    ]
                ]
            );

            $photoUrl = $uploadResult['secure_url'];
        }

        Teacher::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'experience' => $request->experience,
            'qualification' => $request->qualification,
            'department' => $request->department,
            'subject' => $request->subject,
            'description' => $request->description,
            'photo' => $photoUrl,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully!');
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'qualification' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:5120',
        ]);

        $photoUrl = $teacher->photo;

        if ($request->hasFile('photo')) {
            $cloudinary = new Cloudinary();
            $uploadResult = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'teachers',
                    'transformation' => [['width' => 400, 'height' => 400, 'crop' => 'limit', 'quality' => 'auto']]
                ]
            );
            $photoUrl = $uploadResult['secure_url'];
        }

        $teacher->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'experience' => $request->experience,
            'qualification' => $request->qualification,
            'department' => $request->department,
            'subject' => $request->subject,
            'description' => $request->description,
            'photo' => $photoUrl,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
