<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoCurricularProgram;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class CoCurricularProgramController extends Controller
{
    public function index()
    {
        $programs = CoCurricularProgram::orderBy('name')->get();
        return view('admin.co_curricular_programs.index', compact('programs'));
    }

    public function create()
    {
        $programs = CoCurricularProgram::orderBy('name')->get();
        return view('admin.co_curricular_programs.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = $this->cloudinary();

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

        CoCurricularProgram::create($data);

        return redirect()->route('admin.co_curricular_programs.index')
            ->with('success', 'Program created successfully.');
    }

    public function edit(CoCurricularProgram $program)
    {
        return view('admin.co_curricular_programs.edit', compact('program'));
    }

    public function update(Request $request, CoCurricularProgram $program)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = $this->cloudinary();

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

        return redirect()->route('admin.co_curricular_programs.create')
            ->with('success', 'Program updated successfully.');
    }

    public function destroy(CoCurricularProgram $program)
    {
        $program->delete();
        return redirect()->route('admin.co_curricular_programs.create')
            ->with('success', 'Program deleted successfully.');
    }

    /**
     * DRY helper for Cloudinary initialization
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
