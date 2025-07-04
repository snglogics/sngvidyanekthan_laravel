<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Magazine;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::latest()->get();
        return view('admin.magazin.uploadMagazin', compact('magazines'));
    }

    public function list()
    {
        $magazines = Magazine::latest()->get();
        return view('magazin.listMagazin', compact('magazines'));
    }
    public function show($id)
    {
        $magazine = Magazine::findOrFail($id); // will throw 404 if not found
        return view('magazin.viewMagazin', compact('magazine'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'pdf' => 'required|mimes:pdf|max:10240',
        ]);

        $cloudinary = new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ]
        ]);

        $uploaded = $cloudinary->uploadApi()->upload($request->file('pdf')->getRealPath(), [
            'resource_type' => 'raw',
            'folder' => 'magazines'
        ]);

        Magazine::create([
            'title' => $request->title,
            'pdf_url' => $uploaded['secure_url'],
            'public_id' => $uploaded['public_id']
        ]);

        return back()->with('success', 'Magazine uploaded successfully!');
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
            'pdf' => 'nullable|mimes:pdf|max:153600',
        ]);

        $magazine = Magazine::findOrFail($id);
        $magazine->title = $request->title;

        if ($request->hasFile('pdf')) {
            $cloudinary = new \Cloudinary\Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ]
            ]);

            // Optionally delete old file
            if ($magazine->public_id) {
                $cloudinary->uploadApi()->destroy($magazine->public_id, ['resource_type' => 'raw']);
            }

            $uploaded = $cloudinary->uploadApi()->upload($request->file('pdf')->getRealPath(), [
                'resource_type' => 'raw',
                'folder' => 'magazines'
            ]);

            $magazine->pdf_url = $uploaded['secure_url'];
            $magazine->public_id = $uploaded['public_id'];
        }

        $magazine->save();
        return redirect()->route('admin.magazines.index')->with('success', 'Magazine updated!');
    }

    public function destroy($id)
    {
        $magazine = Magazine::findOrFail($id);

        if ($magazine->public_id) {
            $cloudinary = new \Cloudinary\Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ]
            ]);
            $cloudinary->uploadApi()->destroy($magazine->public_id, ['resource_type' => 'raw']);
        }

        $magazine->delete();
        return redirect()->back()->with('success', 'Magazine deleted.');
    }

    public function download($id)
    {
        $magazine = Magazine::findOrFail($id);

        // If the PDF is stored locally in storage/app/public/magazines/
        $filePath = str_replace(asset('storage'), 'public', $magazine->pdf_url);

        if (Storage::exists($filePath)) {
            return Storage::download($filePath, $magazine->title . '.pdf');
        }

        // For remote URLs, use a streamed response
        return response()->streamDownload(function () use ($magazine) {
            echo file_get_contents($magazine->pdf_url);
        }, $magazine->title . '.pdf');
    }
}
