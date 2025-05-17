<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoCurricularProgram;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class CoCurricularProgramController extends Controller
{
    

    public function index() {
        $programs = CoCurricularProgram::orderBy('name')->get();
        return view('admin.co_curricular_programs.index', compact('programs'));
    }

    public function create() {
        $programs = CoCurricularProgram::orderBy('name')->get();
        return view('admin.co_curricular_programs.create', compact('programs'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Upload to Cloudinary
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET')
                ]
            ]);

            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'programs',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            );

            $imageUrl = $uploadedFile['secure_url'];
            $data['image_url'] = $imageUrl;
        }

        CoCurricularProgram::create($data);

        return redirect()->route('admin.co_curricular_programs.index')->with('success', 'Program created successfully.');
    }

    public function edit(CoCurricularProgram $program) {
        return view('admin.co_curricular_programs.edit', compact('program'));
    }
    
    public function update(Request $request, CoCurricularProgram $program) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = $request->all();
    
        // Handle image upload to Cloudinary
        if ($request->hasFile('image')) {
            $cloudinary = new \Cloudinary\Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET')
                ]
            ]);
    
            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'programs',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            );
    
            $data['image_url'] = $uploadedFile['secure_url'];
        }
    
        $program->update($data);
    
        return redirect()->route('admin.co_curricular_programs.create')->with('success', 'Program updated successfully.');
    }
    

    public function destroy(CoCurricularProgram $program) {
        $program->delete();
        return redirect()->route('admin.co_curricular_programs.create')->with('success', 'Program deleted successfully.');
    }
}
