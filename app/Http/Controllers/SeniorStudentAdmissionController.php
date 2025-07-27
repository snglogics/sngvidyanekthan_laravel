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
     * Field labels for validation messages
     */
    protected $fieldLabels = [
        'admission_class' => 'Class for Admission',
        'pupil_name' => 'Student Name',
        'gender' => 'Gender',
        'date_of_birth' => 'Date of Birth',
        'photo' => 'Passport Photo',
        'aadhaar_no' => 'Aadhaar Number',
        'father_name' => 'Father\'s Name',
        'father_occupation' => 'Father\'s Occupation',
        'mother_name' => 'Mother\'s Name',
        'mother_occupation' => 'Mother\'s Occupation',
        'address' => 'Address',
        'phone_number' => 'Phone Number',
        'whatsapp_number' => 'WhatsApp Number',
        'email' => 'Email Address',
        'annual_income' => 'Annual Income',
        'nationality' => 'Nationality',
        'religion_caste' => 'Religion & Caste',
        'last_institution_attended' => 'Last Institution Attended',
        'medium_of_instruction' => 'Medium of Instruction',
        'mother_tongue' => 'Mother Tongue',
        'parent_education' => 'Parent Education',
        'family_members' => 'Family Members',
        'siblings' => 'Siblings',
        'immunization_status' => 'Immunization Status',
        'local_guardian' => 'Local Guardian',
        'hobbies' => 'Hobbies',
        'games_played' => 'Games Played',
        'cocurricular_achievements' => 'Co-curricular Achievements',
        'cca_options' => 'CCA Options',
        'year_of_passing' => 'Year of Passing',
        'total_marks' => 'Total Marks'
    ];

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
        $rules = [
            'admission_class' => 'required|string|max:255',
            'pupil_name' => 'required|string|max:255',
            'gender' => 'required|in:Boy,Girl,Transgender',
            'date_of_birth' => 'required|date',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'aadhaar_no' => 'nullable|string|max:255|regex:/^[0-9]{12}$/',
            'father_name' => 'required|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
            'mother_name' => 'required|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string|max:15|regex:/^[0-9]{10,15}$/',
            'whatsapp_number' => 'nullable|string|max:15|regex:/^[0-9]{10,15}$/',
            'email' => 'nullable|email|max:255',
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
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute must be a string.',
            'max' => 'The :attribute may not be greater than :max characters.',
            'in' => 'The selected :attribute is invalid.',
            'date' => 'The :attribute must be a valid date.',
            'image' => 'The :attribute must be an image.',
            'mimes' => 'The :attribute must be a file of type: :values.',
            'email' => 'The :attribute must be a valid email address.',
            'regex' => 'The :attribute format is invalid.',
            'numeric' => 'The :attribute must be a number.',
            'digits' => 'The :attribute must be :digits digits.',
        ];

        // Add custom attribute names
        $customAttributes = [];
        foreach ($this->fieldLabels as $field => $label) {
            $customAttributes[$field] = $label;
        }

        $validatedData = $request->validate($rules, $messages, $customAttributes);

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

            $validatedData['photo_url'] = $photoResponse['secure_url'];

            // Create student record
            $student = SeniorStudentAdmission::create($validatedData);

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

            $request->session()->forget(['success', 'error']);

        return redirect()
            ->back()
            ->with('success', 'Application submitted successfully! ID: ' . $student->id);
        } catch (\Exception $e) {
            Log::error('Senior student admission error: ' . $e->getMessage());
           return redirect()
            ->back()
            ->with('error', 'Failed to submit application: ' . $e->getMessage())
            ->withInput();
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