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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;



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
        // Enhanced validation rules
        $validator = Validator::make($request->all(), [
            'class' => ['required', 'string', 'max:50', Rule::in(['LKG', 'UKG', 'lkg', 'ukg'])],
            'pupil_name' => 'required|string|max:255|regex:/^[A-Z\s]+$/',
            'gender' => ['required', 'string', 'max:10', Rule::in(['Boy', 'Girl'])],
            'date_of_birth' => [
                'required', 
                'date',
                'before_or_equal:' . now()->subYears(3)->format('Y-m-d'),
                'after_or_equal:' . now()->subYears(6)->format('Y-m-d')
            ],
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'mobile_number' => 'required|string|digits:10',
            'email' => 'required|email:rfc,dns|max:255',
            'nationality' => 'nullable|string|max:100',
            'religion' => 'nullable|string|max:100',
            'father_occupation' => 'required|string|max:255',
            'mother_occupation' => 'required|string|max:255',
            'Whatsapp_number' => 'nullable|string|digits:10',
            'aadhar' => [
                'nullable', 
                'string', 
                'digits:12',
                'regex:/^[2-9]{1}[0-9]{11}$/'
            ],
            'annual_income' => 'nullable|numeric|min:0',
            'mother_toungue' => 'nullable|string|max:50',
            'father_education' => 'nullable|string|max:255',
            'mother_education' => 'nullable|string|max:255',
            'total_members' => 'nullable|integer|min:1',
            'siblings' => 'nullable|string|max:255',
            'local_guardian' => 'nullable|string|max:255',
            'hobbies' => 'nullable|string|max:255',
            'blood_group' => [
                'nullable', 
                'string', 
                'max:5',
                Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])
            ],
            'boarding_point' => 'nullable|string|max:255',
            'photo' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048',
               
            ],
        ], [
            'pupil_name.regex' => 'Student name must be in block letters',
            'date_of_birth.before_or_equal' => 'Student must be at least 3 years old',
            'date_of_birth.after_or_equal' => 'Student must not be older than 6 years',
            'photo.dimensions' => 'Photo must be at least 300x300 pixels ',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = $validator->validated();
            
            // Format data consistently
            $data['class'] = strtoupper($data['class']);
            $data['pupil_name'] = Str::upper($data['pupil_name']);
            $data['father_name'] = Str::title($data['father_name']);
            $data['mother_name'] = Str::title($data['mother_name']);

            // Handle photo upload
            $cloudinary = $this->cloudinary();
            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'admission_photos',
                    'public_id' => 'student_' . Str::slug($data['pupil_name']) . '_' . time(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'transformation' => [
                        'width' => 400,
                        'height' => 533,
                        'crop' => 'fill',
                        'quality' => 'auto'
                    ]
                ]
            );

            $data['photo_url'] = $uploadResponse['secure_url'];
            $data['application_number'] = $this->generateApplicationNumber();

            // Create student record
            $student = StudentApplication::create($data);

            // Generate and store PDF
            $pdfUrl = $this->generateAndStorePdf($student);

            // Send confirmation email
            $this->sendConfirmationEmail($student, $pdfUrl);

            return redirect()->back()
                ->with('success', 'Application submitted successfully! Your application number is: ' . $data['application_number']);

        }  catch (\Exception $e) {
    Log::error('Student application error: ' . $e->getMessage());
    Log::error('Exception trace: ' . $e->getTraceAsString());
    Log::error('Input data: ', $request->all());
    
    return redirect()->back()
        ->with('error', 'Failed to submit application. Error: ' . $e->getMessage())
        ->withInput();
}
    }

    /**
     * Generate unique application number
     */
    private function generateApplicationNumber(): string
    {
        return 'APP-' . date('Y') . '-' . Str::upper(Str::random(6));
    }

    // ... [Keep other methods exactly as they are] ...

    /**
     * Generate and store PDF for the application
     */
    private function generateAndStorePdf(StudentApplication $student): string
    {
        Storage::makeDirectory('public/applications');

        $pdf = Pdf::loadView('student_application.pdf', ['student' => $student])
                  ->setPaper('a4', 'portrait')
                  ->setOption('isPhpEnabled', true);

        $pdfFilename = 'applications/' . $student->application_number . '.pdf';
        Storage::put('public/' . $pdfFilename, $pdf->output());

        $pdfUrl = 'storage/' . $pdfFilename;
        $student->update(['pdf_url' => $pdfUrl]);

        return $pdfUrl;
    }

    /**
     * Send confirmation email with PDF attachment
     */
  private function sendConfirmationEmail(StudentApplication $student, string $pdfUrl): void
{
    try {
        if (empty($student->email)) {
            Log::warning('Student email is empty for student ID: ' . $student->id);
            return; // don't proceed if no email
        }

        $pdfPath = storage_path('app/public/' . str_replace('storage/', '', $pdfUrl));

        Mail::send(
            'emails.application',
            ['student' => $student],
            function ($message) use ($student, $pdfPath) {
                $message->to($student->email)
                    ->cc(config('mail.admin_email')) // CC to admin
                    ->subject('Application Confirmation - ' . $student->application_number)
                    ->attach($pdfPath, [
                        'as' => 'Application_' . $student->application_number . '.pdf',
                        'mime' => 'application/pdf',
                    ]);
            }
        );
    } catch (\Exception $e) {
        Log::error('Email sending failed: ' . $e->getMessage());
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
