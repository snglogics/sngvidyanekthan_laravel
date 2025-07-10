<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeacherController extends Controller
{
    /**
     * Display public list of teachers
     */
    public function publicList(): View
    {
        $teachers = Teacher::latest()->get();
        return view('about.teacherslist', compact('teachers'));
    }

    /**
     * Display teacher profile
     */
    public function teacherProfile(Teacher $teacher): View
    {
        $teachers = Teacher::all();
        return view('about.teacherProfile', compact('teachers', 'teacher'));
    }

    /**
     * Display categorized list of teachers
     */
    public function categorizedList(Request $request): View
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

    /**
     * Display a listing of teachers for admin
     */
    public function index(): View
    {
        $teachers = Teacher::latest()->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new teacher
     */
    public function create(): View
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created teacher
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'experience' => 'nullable|integer',
            'qualification' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $cloudinary = $this->cloudinary();
            $uploadResult = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'teachers',
                    'transformation' => [
                        ['width' => 400, 'height' => 400, 'crop' => 'limit', 'quality' => 'auto']
                    ]
                ]
            );
            $data['photo'] = $uploadResult['secure_url'];
        }

        Teacher::create($data);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher added successfully!');
    }

    /**
     * Show the form for editing a teacher
     */
    public function edit(Teacher $teacher): View
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified teacher
     */
    public function update(Request $request, Teacher $teacher): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'qualification' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $cloudinary = $this->cloudinary();

            // Delete old photo if exists
            if ($teacher->photo) {
                $publicId = $this->extractPublicId($teacher->photo);
                if ($publicId) {
                    $cloudinary->uploadApi()->destroy($publicId, ['resource_type' => 'image']);
                }
            }

            $uploadResult = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'teachers',
                    'transformation' => [
                        ['width' => 400, 'height' => 400, 'crop' => 'limit', 'quality' => 'auto']
                    ]
                ]
            );
            $data['photo'] = $uploadResult['secure_url'];
        }

        $teacher->update($data);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher updated successfully!');
    }

    /**
     * Remove the specified teacher
     */
    public function destroy(Teacher $teacher): RedirectResponse
    {
        // Delete photo from Cloudinary if exists
        if ($teacher->photo) {
            $cloudinary = $this->cloudinary();
            $publicId = $this->extractPublicId($teacher->photo);
            if ($publicId) {
                $cloudinary->uploadApi()->destroy($publicId, ['resource_type' => 'image']);
            }
        }

        $teacher->delete();

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }

    /**
     * DRY helper for Cloudinary initialization
     */
    private function cloudinary(): Cloudinary
    {
        $config = new Configuration([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key'    => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        return new Cloudinary($config);
    }

    /**
     * Helper method to extract Cloudinary public_id from URL
     */
    private function extractPublicId(string $url): ?string
    {
        $parsedUrl = parse_url($url);
        if (!isset($parsedUrl['path'])) {
            return null;
        }

        $path = $parsedUrl['path'];
        $pathParts = explode('/', $path);

        $uploadIndex = array_search('upload', $pathParts);
        if ($uploadIndex === false) {
            return null;
        }

        $publicIdParts = array_slice($pathParts, $uploadIndex + 2);
        if (empty($publicIdParts)) {
            return null;
        }

        $publicIdWithExtension = implode('/', $publicIdParts);
        return preg_replace('/\.[^.]+$/', '', $publicIdWithExtension);
    }
}
