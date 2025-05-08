<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class StudentApplicationController extends Controller
{
    public function showForm()
    {
        return view('student_application.form');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'class' => 'required|string|max:50',
            'pupil_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'date_of_birth' => 'required|date',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email',
            'nationality' => 'nullable|string|max:100',
            'religion' => 'nullable|string|max:100',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
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

        //  Save student data
        $student = StudentApplication::create([
            'class' => $request->class,
            'pupil_name' => $request->pupil_name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'nationality' => $request->nationality,
            'religion' => $request->religion,
            'photo_url' => $uploadResponse['secure_url']
        ]);

        // Generate PDF
        $pdf = Pdf::loadView('student_application.pdf', compact('student'));
        $pdfPath = storage_path('app/public/applications/' . $student->id . '.pdf');
        $pdf->save($pdfPath);

        // Send email
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
}
