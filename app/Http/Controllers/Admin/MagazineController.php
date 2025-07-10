<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Magazine;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::latest()->paginate(20); // Use pagination for large data
        return view('admin.magazin.uploadMagazin', compact('magazines'));
    }

    public function list()
    {
        $magazines = Magazine::orderBy('title', 'asc')->get();
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
            'title' => 'required',
            'pdf' => 'required|mimes:pdf|max:20480',
        ]);

        try {
            $cloudinary = $this->cloudinary();

            Log::info('Uploading magazine: ' . $request->file('pdf')->getClientOriginalName());

            $uploaded = $cloudinary->uploadApi()->upload(
                $request->file('pdf')->getRealPath(),
                [
                    'resource_type' => 'raw',
                    'folder' => 'magazines',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                ]
            );

            Magazine::create([
                'title' => $request->title,
                'pdf_url' => $uploaded['secure_url'],
                'public_id' => $uploaded['public_id'],
            ]);

            Log::info('Magazine uploaded successfully: ' . $request->title);
            return back()->with('success', 'Magazine uploaded successfully!');
        } catch (\Exception $e) {
            Log::error('Magazine upload failed: ' . $e->getMessage());
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
            'title' => 'required',
            'pdf' => 'nullable|mimes:pdf|max:20480',
        ]);

        $magazine = Magazine::findOrFail($id);
        $magazine->title = $request->title;

        if ($request->hasFile('pdf')) {
            $cloudinary = $this->cloudinary();

            if ($magazine->public_id) {
                $cloudinary->uploadApi()->destroy($magazine->public_id, ['resource_type' => 'raw']);
            }

            $uploaded = $cloudinary->uploadApi()->upload(
                $request->file('pdf')->getRealPath(),
                [
                    'resource_type' => 'raw',
                    'folder' => 'magazines',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                ]
            );

            $magazine->pdf_url = $uploaded['secure_url'];
            $magazine->public_id = $uploaded['public_id'];
        }

        $magazine->save();

        return redirect()->route('admin.magazines.index')->with('success', 'Magazine updated successfully!');
    }

    public function destroy($id)
    {
        $magazine = Magazine::findOrFail($id);

        if ($magazine->public_id) {
            $this->cloudinary()->uploadApi()->destroy($magazine->public_id, ['resource_type' => 'raw']);
        }

        $magazine->delete();
        return back()->with('success', 'Magazine deleted successfully.');
    }

    public function download($id)
    {
        $magazine = Magazine::findOrFail($id);

        // Stream download for remote URLs
        return response()->streamDownload(function () use ($magazine) {
            echo file_get_contents($magazine->pdf_url);
        }, $magazine->title . '.pdf');
    }

    /**
     * DRY Cloudinary initialization
     */
    private function cloudinary()
    {
        return new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key' => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ]
        ]);
    }
}
