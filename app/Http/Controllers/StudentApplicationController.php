<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentApplicationController extends Controller
{
    /**
     * Show the application form
     */
    public function showForm(): View
    {
        return view('student_application.form');
    }

    /**
     * Handle form submission
     */
    public function submitForm(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'class' => 'required|string|max:50',
            'pupil_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'date_of_birth' => 'required|date',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'address' => 'required|string',
            'mobile_number' => 'required|string|max:15',
            'email' => 'required|email',
            'nationality' => 'nullable|string|max:100',
            'religion' => 'nullable|string|max:100',
            'father_occupation' => 'nullable|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',
            'Whatsapp_number' => 'nullable|string|max:15',
            'aadhar' => 'nullable|string|max:12',
            'annual_income' => 'nullable|string|max:20',
            'mother_toungue' => 'nullable|string|max:50',
            'father_education' => 'nullable|string|max:255',
            'mother_education' => 'nullable|string|max:255',
            'total_members' => 'nullable|string|max:3',
            'siblings' => 'nullable|string|max:255',
            'local_guardian' => 'nullable|string|max:255',
            'hobbies' => 'nullable|string|max:255',
            'blood_group' => 'nullable|string|max:5',
            'boarding_point' => 'nullable|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $cloudinary = $this->cloudinary();

            // Upload photo to Cloudinary
            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'admission_photos',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image'
                ]
            );

            $data['photo_url'] = $uploadResponse['secure_url'];

            // Create student record
            $student = StudentApplication::create($data);

            // Generate and store PDF
            $this->generateAndStorePdf($student);

            // Send confirmation email
            $this->sendConfirmationEmail($student);

            return redirect()->back()
                ->with('success', 'Application submitted successfully!');
        } catch (\Exception $e) {
            Log::error('Student application error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to submit application: ' . $e->getMessage());
        }
    }

    /**
     * List all applications with search functionality
     */
    public function index(): View
    {
        $query = StudentApplication::query();

        if ($search = request('search')) {
            $query->where('pupil_name', 'like', "%{$search}%");
        }

        $students = $query->orderBy('id', 'desc')->paginate(10);

        return view('student_application.admissions.primary.primary_students_list', compact('students'));
    }

    /**
     * Show the details of a single application
     */
    public function show(int $id): View
    {
        $student = StudentApplication::findOrFail($id);
        return view('student_application.admissions.primary.primary_student_details', compact('student'));
    }

    /**
     * Delete an application
     */
    public function destroy(int $id): RedirectResponse
    {
        $student = StudentApplication::findOrFail($id);

        try {
            // Delete photo from Cloudinary
            $photoPublicId = $this->extractPublicId($student->photo_url);
            if ($photoPublicId) {
                $this->cloudinary()->uploadApi()->destroy($photoPublicId, ['resource_type' => 'image']);
            }

            // Delete local PDF file if exists
            if ($student->pdf_url && Storage::exists(str_replace('storage/', 'public/', $student->pdf_url))) {
                Storage::delete(str_replace('storage/', 'public/', $student->pdf_url));
            }

            $student->delete();

            return redirect()
                ->route('admin.primary-students.list')
                ->with('success', 'Application deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting student application: ' . $e->getMessage());
            return redirect()
                ->route('admin.primary-students.list')
                ->with('error', 'Failed to delete application.');
        }
    }

    /**
     * Generate and store PDF for the application
     */
    private function generateAndStorePdf(StudentApplication $student): void
    {
        Storage::makeDirectory('public/applications');

        $pdf = Pdf::loadView('student_application.pdf', ['student' => $student]);
        $pdfFilename = 'applications/' . $student->id . '.pdf';

        Storage::put('public/' . $pdfFilename, $pdf->output());

        $student->update([
            'pdf_url' => 'storage/' . $pdfFilename
        ]);
    }

    /**
     * Send confirmation email with PDF attachment
     */
    private function sendConfirmationEmail(StudentApplication $student): void
    {
        try {
            $pdfPath = storage_path('app/public/' . str_replace('storage/', '', $student->pdf_url));

            Mail::send(
                'emails.application',
                ['student' => $student],
                function ($message) use ($student, $pdfPath) {
                    $message->to($student->email)
                        ->subject('Application Confirmation')
                        ->attach($pdfPath);
                }
            );
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
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
