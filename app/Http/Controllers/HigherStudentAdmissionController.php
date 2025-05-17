<?php

namespace App\Http\Controllers;

use App\Models\HigherStudentAdmission;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Barryvdh\DomPDF\Facade\Pdf;

class HigherStudentAdmissionController extends Controller
{
    // Show the higher admission form
    public function showHigherForm()
    {
        return view('student_application.higherForm');
    }

    // Handle form submission
    public function submitHigherForm(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'candidate_name' => 'required|string|max:255',
            'reg_roll_no' => 'required|string|max:255',
            'year_of_passing' => 'required|string|max:255',
            'board_type' => 'required|string|max:255',
            'sex' => 'required|string|max:10',
            'date_of_birth' => 'required|date',
            'annual_income' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'religion_caste' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'caste_details' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
            'father_education' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',
            'mother_education' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone_no' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'last_institution' => 'nullable|string|max:255',
            'medium_of_instruction' => 'nullable|string|max:255',
            'mother_tongue' => 'nullable|string|max:255',
            'siblings' => 'nullable|string',
            'local_guardian' => 'nullable|string',
            'hobbies' => 'nullable|string',
            'major_games' => 'nullable|string',
            'co_curricular_achievements' => 'nullable|string',
            'subjects' => 'required|array',
            'percentages' => 'required|array',
            'grades' => 'required|array',
            'marks_table_image' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        try {
            // Initialize Cloudinary
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            // Upload Marks Table Image to Cloudinary
            $marksTableResponse = $cloudinary->uploadApi()->upload($request->file('marks_table_image')->getRealPath(), [
                'folder' => 'higher_student_marks_tables',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image'
            ]);

            // Upload Student Photo to Cloudinary
            $photoResponse = $cloudinary->uploadApi()->upload($request->file('photo')->getRealPath(), [
                'folder' => 'higher_student_photos',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image'
            ]);

            // Save student data
            $student = HigherStudentAdmission::create(array_merge($validatedData, [
                'marks_table_image_url' => $marksTableResponse['secure_url'],
                'photo_url' => $photoResponse['secure_url'],
                'subjects' => $request->subjects ?? [],
                'percentages' => $request->percentages ?? [],
                'grades' => $request->grades ?? [],
            ]));
            
            return redirect()->back()->with('success', 'Application submitted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to upload files: ' . $e->getMessage());
        }
    }

    // List all students
    public function listStudents()
    {
        $students = HigherStudentAdmission::all();
        return view('admin.higher_student_list', compact('students'));
    }

    // View a single student
    public function viewStudent($id)
    {
        $student = HigherStudentAdmission::findOrFail($id);
        return view('admin.higher_student_details', compact('student'));
    }

    // Print a single student (optional)
    public function printStudent($id)
    {
        $student = HigherStudentAdmission::findOrFail($id);
        return view('admin.higher_student_details', compact('student'));
    }
}
