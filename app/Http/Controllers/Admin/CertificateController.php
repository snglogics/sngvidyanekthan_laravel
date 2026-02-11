<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use Illuminate\Support\Facades\Log;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::latest()->get();
        return view('admin.certificatesupload.uploadCertificate', compact('certificates'));
    }

    public function list()
    {
        $certificates = Certificate::all()->sortBy('title', SORT_NATURAL);
        return view('certificates.listCertificates', compact('certificates'));
    }

    public function show($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('certificates.viewCertificate', compact('certificate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'pdf' => 'required|mimes:pdf|max:102400' // 100MB
        ]);

        try {
            Log::info('File size (bytes): ' . $request->file('pdf')->getSize());
            $cloudinary = $this->cloudinary();

            Log::info('Starting file upload: ' . $request->file('pdf')->getClientOriginalName());

            $uploaded = $cloudinary->uploadApi()->upload($request->file('pdf')->getRealPath(), [
                'resource_type' => 'raw',
                'folder' => 'certificates',
                'public_id' => 'certificate_' . uniqid(),
                'overwrite' => true,
            ]);

            Certificate::create([
                'title' => $request->title,
                'pdf_url' => $uploaded['secure_url'],
                'public_id' => $uploaded['public_id'],
            ]);

            return back()->with('success', 'Certificate uploaded successfully!');
        } catch (\Exception $e) {
            Log::error('Upload failed: ' . $e->getMessage());
            return back()->with('error', 'Upload failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificatesupload.edit', compact('certificate'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'pdf' => 'nullable|mimes:pdf|max:102400', // 100MB
        ]);

        try {
            $certificate = Certificate::findOrFail($id);
            $certificate->title = $request->title;

            if ($request->hasFile('pdf')) {
                $cloudinary = $this->cloudinary();

                // Delete old file if exists
                if ($certificate->public_id) {
                    $cloudinary->uploadApi()->destroy($certificate->public_id, ['resource_type' => 'raw']);
                }

                $uploaded = $cloudinary->uploadApi()->upload($request->file('pdf')->getRealPath(), [
                    'resource_type' => 'raw',
                    'folder' => 'certificates',
                    'public_id' => 'certificate_' . uniqid(),
                    'overwrite' => true,
                ]);

                $certificate->pdf_url = $uploaded['secure_url'];
                $certificate->public_id = $uploaded['public_id'];
            }

            $certificate->save();

            return redirect()->route('admin.certificates.index')
                ->with('success', 'Certificate updated successfully!');

        } catch (\Exception $e) {
            Log::error('Update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $certificate = Certificate::findOrFail($id);

            if ($certificate->public_id) {
                $cloudinary = $this->cloudinary();
                $cloudinary->uploadApi()->destroy($certificate->public_id, ['resource_type' => 'raw']);
            }

            $certificate->delete();
            return redirect()->back()->with('success', 'Certificate deleted.');
        } catch (\Exception $e) {
            Log::error('Delete failed: ' . $e->getMessage());
            return back()->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }

    public function download($id)
    {
        $certificate = Certificate::findOrFail($id);

        $filename = $certificate->title . '.pdf';
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->streamDownload(function () use ($certificate) {
            echo file_get_contents($certificate->pdf_url);
        }, $filename, $headers);
    }

    public function viewFile($id)
    {
        $certificate = Certificate::findOrFail($id);

        $filename = $certificate->title . '.pdf';

        // Basic validation of the URL
        if (empty($certificate->pdf_url)) {
            abort(404, 'PDF URL not found');
        }

        return response()->stream(function () use ($certificate) {
            readfile($certificate->pdf_url);
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }

    private function cloudinary()
    {
        $config = new Configuration([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key' => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        return new Cloudinary($config);
    }
}