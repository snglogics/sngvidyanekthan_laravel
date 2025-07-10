<?php

namespace App\Http\Controllers;

use App\Models\SeniorStudentAdmission;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class SeniorStudentAdmissionController extends Controller
{
    /**
     * Show the senior admission form
     */
    public function showForm(): View
    {
        return view('student_application.seniourForm');
    }

    /**
     * Handle form submission
     */
    public function submitForm(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'admission_class' => 'required|string|max:255',
            'pupil_name' => 'required|string|max:255',
            'gender' => 'required|in:Boy,Girl,Transgender',
            'date_of_birth' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'aadhaar_no' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'annual_income' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'religion_caste' => 'nullable|string|max:255',
            'last_institution_attended' => 'nullable|string|max:255',
            'medium_of_instruction' => 'nullable|string|max:255',
            'mother_tongue' => 'nullable|string|max:255',
            'parent_education' => 'nullable|string|max:255',
            'family_members' => 'nullable|string',
            'siblings' => 'nullable|string',
            'immunization_status' => 'nullable|string',
            'local_guardian' => 'nullable|string',
            'hobbies' => 'nullable|string',
            'games_played' => 'nullable|string',
            'cocurricular_achievements' => 'nullable|string',
            'cca_options' => 'nullable|string',
            'year_of_passing' => 'nullable|string|max:255',
            'total_marks' => 'nullable|string|max:255',
        ]);

        try {
            $cloudinary = $this->cloudinary();

            // Upload photo to Cloudinary
            $photoResponse = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'admission_photos',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image'
                ]
            );

            $data['photo_url'] = $photoResponse['secure_url'];

            // Create student record
            $student = SeniorStudentAdmission::create($data);

            // Generate and upload PDF
            $pdf = Pdf::loadView('student_application.admissions.pdf', compact('student'));
            $pdfPath = storage_path('app/public/admissions/' . $student->id . '.pdf');
            $pdf->save($pdfPath);

            $pdfResponse = $cloudinary->uploadApi()->upload(
                $pdfPath,
                [
                    'folder' => 'student_admissions',
                    'public_id' => 'admission_' . $student->id,
                    'resource_type' => 'raw',
                    'format' => 'pdf'
                ]
            );

            $downloadUrl = $pdfResponse['secure_url'] . '?fl_attachment=admission_form';
            $student->update(['pdf_url' => $downloadUrl]);

            // Clean up local file
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }

            return redirect()->back()
                ->with('success', 'Application submitted successfully!');
        } catch (\Exception $e) {
            Log::error('Senior student admission error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to submit application: ' . $e->getMessage());
        }
    }

    /**
     * List all students with search functionality
     */
    public function listStudents(): View
    {
        $query = SeniorStudentAdmission::query();

        if ($search = request('search')) {
            $query->where('pupil_name', 'like', "%{$search}%");
        }

        $students = $query->orderBy('id', 'desc')->paginate(10);

        return view('student_application.seniorSecondary.senior_student_list', compact('students'));
    }

    /**
     * View a single student
     */
    public function viewStudent(int $id): View
    {
        $student = SeniorStudentAdmission::findOrFail($id);
        return view('student_application.seniorSecondary.senior_student_details', compact('student'));
    }

    /**
     * Delete a student record
     */
    public function destroy(int $id): RedirectResponse
    {
        $student = SeniorStudentAdmission::findOrFail($id);

        try {
            $cloudinary = $this->cloudinary();

            // Delete photo from Cloudinary
            $photoPublicId = $this->extractPublicId($student->photo_url);
            if ($photoPublicId) {
                $cloudinary->uploadApi()->destroy($photoPublicId, ['resource_type' => 'image']);
            }

            // Delete PDF from Cloudinary
            $pdfPublicId = $this->extractPublicId($student->pdf_url);
            if ($pdfPublicId) {
                $cloudinary->uploadApi()->destroy($pdfPublicId, ['resource_type' => 'raw']);
            }

            $student->delete();

            return redirect()
                ->route('admin.senior-students.list')
                ->with('success', 'Student record deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting senior student: ' . $e->getMessage());
            return redirect()
                ->route('admin.senior-students.list')
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
