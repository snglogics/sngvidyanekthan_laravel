<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Magazine;

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
}
