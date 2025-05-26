<?php

namespace App\Http\Controllers;

use App\Models\SeniorStudentAdmission;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;


class SeniorStudentAdmissionController extends Controller
{
    public function showForm()
    {
        return view('student_application.seniourForm');
    }

    public function submitForm(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'admission_class' => 'required|string|max:255',
            'pupil_name' => 'required|string|max:255',
            'gender' => 'required|in:Boy,Girl,Transgender',
            'date_of_birth' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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
        $student = SeniorStudentAdmission::create(array_merge($validatedData, [
            'photo_url' => $uploadResponse['secure_url'],
            'aadhaar_no' => $request->aadhaar_no,
            'father_name' => $request->father_name,
            'father_occupation' => $request->father_occupation,
            'mother_name' => $request->mother_name,
            'mother_occupation' => $request->mother_occupation,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'whatsapp_number' => $request->whatsapp_number,
            'email' => $request->email,
            'annual_income' => $request->annual_income,
            'nationality' => $request->nationality,
            'religion_caste' => $request->religion_caste,
            'last_institution_attended' => $request->last_institution_attended,
            'medium_of_instruction' => $request->medium_of_instruction,
            'mother_tongue' => $request->mother_tongue,
            'parent_education' => $request->parent_education,
            'family_members' => $request->family_members,
            'siblings' => $request->siblings,
            'immunization_status' => $request->immunization_status,
            'local_guardian' => $request->local_guardian,
            'hobbies' => $request->hobbies,
            'games_played' => $request->games_played,
            'cocurricular_achievements' => $request->cocurricular_achievements,
            'cca_options' => $request->cca_options,
            'year_of_passing' => $request->year_of_passing,
            'total_marks' => $request->total_marks,
        ]));

        // Generate and Save PDF
          // Generate the PDF
          $pdf = Pdf::loadView('student_application.admissions.pdf', compact('student'));
          $pdfPath = storage_path('app/public/admissions/' . $student->id . '.pdf');
          $pdf->save($pdfPath);
  
          // Upload the PDF to Cloudinary
          $pdfResponse = $cloudinary->uploadApi()->upload($pdfPath, [
              'folder' => 'student_admissions',
              'public_id' => 'admission_' . $student->id,
              'resource_type' => 'raw',
              'format' => 'pdf'
          ]);
  
          $downloadUrl = $pdfResponse['secure_url'] . '?fl_attachment=admission_form';

          // Save the Cloudinary PDF URL in the database
          $student->update([
              'pdf_url' => $downloadUrl
          ]);
  
          // Delete the local PDF to save space
          unlink($pdfPath);
        return redirect()->back()->with('success', 'Application submitted successfully!');
    }


    public function listStudents()
    {
        $query = SeniorStudentAdmission::query();

        if ($search = request('search')) {
            $query->where('pupil_name', 'like', "%{$search}%");
        }

        $students = $query->orderBy('id', 'desc')->paginate(10);

        return view('student_application.seniorSecondary.senior_student_list', compact('students'));
    }

     public function viewStudent($id)
    {
        $student = SeniorStudentAdmission::findOrFail($id);
        return view('student_application.seniorSecondary.senior_student_details', compact('student'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $student = SeniorStudentAdmission::findOrFail($id);

        // Optionally delete the photo and PDF from Cloudinary here
        // e.g. Cloudinary cleanup if needed

        $student->delete();

        return redirect()
            ->route('admin.senior-students.list')
            ->with('success', 'Student record deleted successfully.');
    }
}
