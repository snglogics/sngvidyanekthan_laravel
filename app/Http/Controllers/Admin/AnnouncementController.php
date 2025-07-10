<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AnnouncementController extends Controller
{
    private $cloudinary;

    public function __construct()
    {
        $config = new Configuration([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key'    => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => ['secure' => true]
        ]);

        $this->cloudinary = new Cloudinary($config);
    }

    public function showUploadForm()
    {
        $announcements = Announcement::with('files')->get();
        return view('admin.announcement_upload', compact('announcements'));
    }

    public function uploadAnnouncement(Request $request)
    {
        $request->validate([
            'announcement_header' => 'required|string|max:255',
            'description' => 'required|string',
            'documents' => 'required|array',
            'documents.*' => 'mimes:pdf,doc,docx|max:5120', // 5MB max per file
        ]);

        $announcement = Announcement::create([
            'header' => $request->announcement_header,
            'description' => $request->description,
        ]);

        foreach ($request->file('documents') as $doc) {
            $uploadedFile = $this->cloudinary->uploadApi()->upload(
                $doc->getRealPath(),
                [
                    'resource_type' => 'raw', // for PDF/DOC files
                    'folder' => 'announcements'
                ]
            );

            $announcement->files()->create([
                'file_url' => $uploadedFile['secure_url'],
                // Optionally store public_id for later deletion:
                // 'public_id' => $uploadedFile['public_id'],
                // 'original_filename' => $doc->getClientOriginalName(),
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Announcement uploaded successfully!']);
    }

    public function destroy($id)
    {
        $announcement = Announcement::with('files')->findOrFail($id);

        foreach ($announcement->files as $file) {
            // Optional: delete from Cloudinary using public_id if stored
            // $this->cloudinary->uploadApi()->destroy($file->public_id, ['resource_type' => 'raw']);
            $file->delete();
        }

        $announcement->delete();

        return redirect()->route('announcement.uploadForm')->with('success', 'Announcement deleted successfully.');
    }

    public function downloadFile($announcementId, $fileId)
    {
        $announcement = Announcement::findOrFail($announcementId);
        $file = $announcement->files()->findOrFail($fileId);

        try {
            $filename = $file->original_filename ?: 'announcement_file.pdf';

            $response = Http::withOptions(['stream' => true])->get($file->file_url);

            if ($response->successful()) {
                return response()->streamDownload(function () use ($response) {
                    echo $response->body();
                }, $filename);
            } else {
                Log::error("Failed to fetch file from Cloudinary: Status " . $response->status());
                return back()->with('error', 'Failed to download file.');
            }
        } catch (\Exception $e) {
            Log::error("Download failed: " . $e->getMessage());
            return back()->with('error', 'Download failed: ' . $e->getMessage());
        }
    }
}
