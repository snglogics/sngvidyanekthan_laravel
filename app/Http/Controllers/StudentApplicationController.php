<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class StudentApplicationController extends Controller
{
    public function showForm()
    {
        return view('student_application.form');
    }

    public function submitForm(Request $request)
    {
        // Validate incoming data
        $request->validate([
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
            'pdf_url' => 'nullable|string|max:255',
        ]);

        // Upload photo to Cloudinary
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key' => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        $uploadResponse = $cloudinary->uploadApi()->upload($request->file('photo')->getRealPath(), [
            'folder' => 'admission_photos',
            'public_id' => uniqid(),
            'overwrite' => true,
            'resource_type' => 'image'
        ]);

        // Save student data
        $student = StudentApplication::create([
            'class' => $request->class,
            'pupil_name' => $request->pupil_name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'address' => $request->address,
            'mobile_number' => $request->phone_number,
            'email' => $request->email,
            'nationality' => $request->nationality,
            'religion' => $request->religion,
            'photo_url' => $uploadResponse['secure_url'],
            'father_occupation' => $request->father_occupation,
            'mother_occupation' => $request->mother_occupation,
            'Whatsapp_number' => $request->Whatsapp_number,
            'aadhar' => $request->aadhar,
            'annual_income' => $request->annual_income,
            'mother_toungue' => $request->mother_toungue,
            'father_education' => $request->father_education,
            'mother_education' => $request->mother_education,
            'total_members' => $request->total_members,
            'siblings' => $request->siblings,
            'local_guardian' => $request->local_guardian,
            'hobbies' => $request->hobbies,
            'blood_group' => $request->blood_group,
            'boarding_point' => $request->boarding_point,
            'pdf_url' => $request->pdf_url,
        ]);

        // Generate PDF
        // Ensure directory exists
        Storage::makeDirectory('public/applications');

        // Generate PDF
        $pdf = Pdf::loadView('student_application.pdf', ['student' => $student]);

        $pdfFilename = 'applications/' . $student->id . '.pdf';
        Storage::put('public/' . $pdfFilename, $pdf->output());

        // Save PDF path to database
        $student->update([
            'pdf_url' => 'storage/' . $pdfFilename
        ]);

        // Send email with the application PDF
        try {
            Mail::send('emails.application', ['student' => $student], function ($message) use ($student, $pdfPath) {
                $message->to($student->email)
                        ->subject('Application Confirmation')
                        ->attach($pdfPath);
            });
        } catch (\Exception $e) {
            Log::error('Email Sending Failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }
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
     * Show the details of a single application.
     */
    public function show(int $id): View
    {
        $student = StudentApplication::findOrFail($id);
        return view('student_application.admissions.primary.primary_student_details', compact('student'));
    }

    /**
     * Delete an application and stay on the same page.
     */
    public function destroy(int $id): RedirectResponse
    {
        $student = StudentApplication::findOrFail($id);
        $student->delete();

        return redirect()
            ->route('admin.primary-students.list')
            ->with('success', 'Application deleted successfully.');
    }

}
 