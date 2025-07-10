<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Magazine;
use Illuminate\Support\Facades\Log;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::latest()->get();
        return view('admin.magazin.uploadMagazin', compact('magazines'));
    }

    public function list()
    {
        $magazines = Magazine::all()->sortBy('title', SORT_NATURAL);
        return view('magazin.listMagazin', compact('magazines'));
    }

    public function show($id)
    {
        $magazine = Magazine::findOrFail($id);
        return view('magazin.viewMagazin', compact('magazine'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'pdf' => 'required|mimes:pdf|max:20480', // 20MB
        ]);

        try {
            $cloudinary = $this->cloudinary();

            Log::info('Starting file upload: ' . $request->file('pdf')->getClientOriginalName());

            $uploaded = $cloudinary->uploadApi()->upload($request->file('pdf')->getRealPath(), [
                'resource_type' => 'raw',
                'folder' => 'magazines',
                'public_id' => 'magazine_' . uniqid(),
                'overwrite' => true,
            ]);

            Magazine::create([
                'title' => $request->title,
                'pdf_url' => $uploaded['secure_url'],
                'public_id' => $uploaded['public_id'],
                'file_size' => $uploaded['bytes'] ?? null,
            ]);

            return back()->with('success', 'Magazine uploaded successfully!');
        } catch (\Exception $e) {
            Log::error('Upload failed: ' . $e->getMessage());
            return back()->with('error', 'Upload failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $magazine = Magazine::findOrFail($id);
        return view('admin.magazin.edit', compact('magazine'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'pdf' => 'nullable|mimes:pdf|max:20480',
        ]);

        try {
            $magazine = Magazine::findOrFail($id);
            $magazine->title = $request->title;

            if ($request->hasFile('pdf')) {
                $cloudinary = $this->cloudinary();

                // Delete old file if exists
                if ($magazine->public_id) {
                    $cloudinary->uploadApi()->destroy($magazine->public_id, ['resource_type' => 'raw']);
                }

                $uploaded = $cloudinary->uploadApi()->upload($request->file('pdf')->getRealPath(), [
                    'resource_type' => 'raw',
                    'folder' => 'magazines',
                    'public_id' => 'magazine_' . uniqid(),
                    'overwrite' => true,
                ]);

                $magazine->pdf_url = $uploaded['secure_url'];
                $magazine->public_id = $uploaded['public_id'];
                $magazine->file_size = $uploaded['bytes'] ?? null;
            }

            $magazine->save();
            return redirect()->route('admin.magazines.index')->with('success', 'Magazine updated!');
        } catch (\Exception $e) {
            Log::error('Update failed: ' . $e->getMessage());
            return back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $magazine = Magazine::findOrFail($id);

            if ($magazine->public_id) {
                $cloudinary = $this->cloudinary();
                $cloudinary->uploadApi()->destroy($magazine->public_id, ['resource_type' => 'raw']);
            }

            $magazine->delete();
            return redirect()->back()->with('success', 'Magazine deleted.');
        } catch (\Exception $e) {
            Log::error('Delete failed: ' . $e->getMessage());
            return back()->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }

    public function download($id)
    {
        $magazine = Magazine::findOrFail($id);

        // For Cloudinary URLs
        $filename = $magazine->title . '.pdf';
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->streamDownload(function () use ($magazine) {
            echo file_get_contents($magazine->pdf_url);
        }, $filename, $headers);
    }

    /**
     * Cloudinary configuration helper (similar to video controller)
     */
    private function cloudinary()
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
}
