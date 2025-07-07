<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{

    public function showUploadForm()
    {
        $announcements = Announcement::with('files')->get(); // Fetch announcements with files

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
            $uploadedUrl = (new Cloudinary())->uploadApi()->upload($doc->getRealPath(), [
                'resource_type' => 'raw'  // for PDF/DOC files
            ]);

            $announcement->files()->create([
                'file_url' => $uploadedUrl['secure_url'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Announcement uploaded successfully!']);
    }

    public function destroy($id)
    {
        $announcement = Announcement::with('files')->findOrFail($id);

        // Delete each attached file record
        foreach ($announcement->files as $file) {
            // Optional: If you are using Cloudinary and have saved public_id, you can also delete from Cloudinary like this:
            // (new Cloudinary())->uploadApi()->destroy($file->public_id);

            $file->delete(); // delete file record from database
        }

        // Delete the announcement itself
        $announcement->delete();

        return redirect()->route('announcement.uploadForm')->with('success', 'Announcement deleted successfully.');
    }
}
