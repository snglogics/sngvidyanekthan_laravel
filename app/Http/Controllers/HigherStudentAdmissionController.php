<?php

namespace App\Http\Controllers;

use App\Models\HigherStudentAdmission;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class HigherStudentAdmissionController extends Controller
{
    /**
     * Show the higher admission form
     */
    public function showHigherForm(): View
    {
        return view('student_application.higherForm');
    }

    /**
     * Handle form submission
     */
    public function submitHigherForm(Request $request): RedirectResponse
    {
        $data = $request->validate([
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
            $cloudinary = $this->cloudinary();

            // Upload Marks Table Image
            $marksTableResponse = $cloudinary->uploadApi()->upload(
                $request->file('marks_table_image')->getRealPath(),
                [
                    'folder' => 'higher_student_marks_tables',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image'
                ]
            );

            // Upload Student Photo
            $photoResponse = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'higher_student_photos',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image'
                ]
            );

            $data['marks_table_image_url'] = $marksTableResponse['secure_url'];
            $data['photo_url'] = $photoResponse['secure_url'];
            $data['subjects'] = $request->subjects ?? [];
            $data['percentages'] = $request->percentages ?? [];
            $data['grades'] = $request->grades ?? [];

            HigherStudentAdmission::create($data);

            return redirect()->back()
                ->with('success', 'Application submitted successfully!');
        } catch (\Exception $e) {
            Log::error('Higher student admission error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to submit application: ' . $e->getMessage());
        }
    }

    /**
     * List all students
     */
    public function listStudents(Request $request): View
    {
        $query = HigherStudentAdmission::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('candidate_name', 'like', '%' . $request->search . '%');
        }

        $students = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.higher_student_list', compact('students'));
    }

    /**
     * View a single student
     */
    public function viewStudent(int $id): View
    {
        $student = HigherStudentAdmission::findOrFail($id);
        return view('admin.higher_student_details', compact('student'));
    }

    /**
     * Print a single student
     */
    public function printStudent(int $id): View
    {
        $student = HigherStudentAdmission::findOrFail($id);
        return view('admin.higher_student_details', compact('student'));
    }

    /**
     * Delete a student record
     */
    public function destroy(int $id): RedirectResponse
    {
        $student = HigherStudentAdmission::findOrFail($id);

        try {
            $cloudinary = $this->cloudinary();

            // Delete marks table image
            $marksTablePublicId = $this->extractPublicId($student->marks_table_image_url);
            if ($marksTablePublicId) {
                $cloudinary->uploadApi()->destroy($marksTablePublicId, ['resource_type' => 'image']);
            }

            // Delete student photo
            $photoPublicId = $this->extractPublicId($student->photo_url);
            if ($photoPublicId) {
                $cloudinary->uploadApi()->destroy($photoPublicId, ['resource_type' => 'image']);
            }

            $student->delete();

            return redirect()
                ->route('admin.higher-students.list')
                ->with('success', 'Student record deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting student: ' . $e->getMessage());
            return redirect()
                ->route('admin.higher-students.list')
                ->with('error', 'Failed to delete student record.');
        }
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
