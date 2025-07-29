<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class AssessmentController extends Controller
{
    // 🔧 Cloudinary config helper
    private function cloudinary()
    {
        $config = new Configuration([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key'    => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => ['secure' => true]
        ]);

        return new Cloudinary($config);
    }

    // 📄 Show all assessments
    public function index()
    {
        $assessments = Assessment::orderBy('classname')->get();
        return view('admin.assessments.index', compact('assessments'));
    }

    // ➕ Show create form
    public function create()
    {
        return view('admin.assessments.create');
    }

    // 💾 Store new assessment PDF
    public function store(Request $request)
    {
        $request->validate([
            'classname' => 'required|string|max:255',
            'assessment_pdf' => 'required|mimes:pdf|max:2048',
        ]);

        try {
            $cloudinary = $this->cloudinary();

            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('assessment_pdf')->getRealPath(),
                [
                    'folder' => 'assessments',
                    'public_id' => 'assessment_' . uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'raw'
                ]
            );

            Assessment::create([
                'classname' => $request->classname,
                'pdf_url' => $uploadedFile['secure_url'],
                'pdf_public_id' => $uploadedFile['public_id'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Assessment PDF uploaded successfully.',
                'redirect' => route('admin.assessments.index')
            ]);
        } catch (\Exception $e) {
            Log::error('Assessment upload failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // 📝 Edit assessment view
    public function edit(Assessment $assessment)
    {
        return view('admin.assessments.edit', compact('assessment'));
    }

    // 🔁 Update assessment PDF
    public function update(Request $request, Assessment $assessment)
    {
        $request->validate([
            'classname' => 'required|string|max:255',
            'assessment_pdf' => 'nullable|mimes:pdf|max:2048',
        ]);

        try {
            $data = ['classname' => $request->classname];

            if ($request->hasFile('assessment_pdf')) {
                $cloudinary = $this->cloudinary();

                // Remove old PDF from Cloudinary
                if ($assessment->pdf_public_id) {
                    $cloudinary->uploadApi()->destroy($assessment->pdf_public_id, [
                        'resource_type' => 'raw'
                    ]);
                }

                // Upload new PDF
                $uploadedFile = $cloudinary->uploadApi()->upload(
                    $request->file('assessment_pdf')->getRealPath(),
                    [
                        'folder' => 'assessments',
                        'public_id' => 'assessment_' . uniqid(),
                        'overwrite' => true,
                        'resource_type' => 'raw'
                    ]
                );

                $data['pdf_url'] = $uploadedFile['secure_url'];
                $data['pdf_public_id'] = $uploadedFile['public_id'];
            }

            $assessment->update($data);

            return redirect()->route('admin.assessments.index')
                ->with('success', 'Assessment updated successfully.');
        } catch (\Exception $e) {
            Log::error('Assessment update failed: ' . $e->getMessage());

            return back()->with('error', 'Assessment update failed: ' . $e->getMessage())
                ->withInput();
        }
    }

    // ❌ Delete assessment and PDF
    public function destroy(Assessment $assessment)
    {
        try {
            if ($assessment->pdf_public_id) {
                $cloudinary = $this->cloudinary();
                $cloudinary->uploadApi()->destroy($assessment->pdf_public_id, [
                    'resource_type' => 'raw'
                ]);
            }

            $assessment->delete();

            return redirect()->back()->with('success', 'Assessment deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Assessment deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Assessment deletion failed: ' . $e->getMessage());
        }
    }

    // 👁️ View assessment PDF
    public function assessmentview()
    {
        $assessments = Assessment::orderBy('classname')->get();
        return view('admin.assessments.assessment', compact('assessments'));
    }

    // ⬇️ Download assessment PDF
    public function download($id)
    {
        $assessment = Assessment::findOrFail($id);
        $filename = $assessment->classname . '_assessment.pdf';

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->streamDownload(function () use ($assessment) {
            echo file_get_contents($assessment->pdf_url);
        }, $filename, $headers);
    }
}