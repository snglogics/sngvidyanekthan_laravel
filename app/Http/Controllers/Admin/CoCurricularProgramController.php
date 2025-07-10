<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoCurricularProgram;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class CoCurricularProgramController extends Controller
{
    public function index(): View
    {
        $programs = CoCurricularProgram::orderBy('name')->get();
        return view('admin.co_curricular_programs.index', compact('programs'));
    }

    public function create(): View
    {
        $programs = CoCurricularProgram::orderBy('name')->get();
        return view('admin.co_curricular_programs.create', compact('programs'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required',
                'category' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            Log::info('Store Request Validated Data:', $validated);

            if ($request->hasFile('image')) {
                $cloudinary = $this->cloudinary();

                $uploadResponse = $cloudinary->uploadApi()->upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'programs',
                        'public_id' => uniqid(),
                        'overwrite' => true,
                        'resource_type' => 'image',
                        'quality' => 'auto',
                        'fetch_format' => 'auto',
                    ]
                );

                Log::info('Cloudinary Upload Response:', $uploadResponse);

                $validated['image_url'] = $uploadResponse['secure_url'];
            }

            $program = CoCurricularProgram::create($validated);

            Log::info('Program created successfully:', $program->toArray());

            return redirect()->route('admin.co_curricular_programs.index')
                ->with('success', 'Program created successfully.');
        } catch (\Exception $e) {
            Log::error('Error in CoCurricularProgramController@store:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->with('error', 'An error occurred while creating the program.');
        }
    }

    public function edit(CoCurricularProgram $program): View
    {
        return view('admin.co_curricular_programs.edit', compact('program'));
    }

    public function update(Request $request, CoCurricularProgram $program): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = $this->cloudinary();

            // Delete old image from Cloudinary if exists
            if ($program->image_url) {
                $publicId = $this->extractPublicId($program->image_url);
                if ($publicId) {
                    $cloudinary->uploadApi()->destroy($publicId, ['resource_type' => 'image']);
                }
            }

            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'programs',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ]
            );

            $validated['image_url'] = $uploadResponse['secure_url'];
        }

        $program->update($validated);

        return redirect()->route('admin.co_curricular_programs.index')
            ->with('success', 'Program updated successfully.');
    }

    public function destroy(CoCurricularProgram $program): RedirectResponse
    {
        if ($program->image_url) {
            $cloudinary = $this->cloudinary();
            $publicId = $this->extractPublicId($program->image_url);
            if ($publicId) {
                $cloudinary->uploadApi()->destroy($publicId, ['resource_type' => 'image']);
            }
        }

        $program->delete();

        return redirect()->route('admin.co_curricular_programs.index')
            ->with('success', 'Program deleted successfully.');
    }

    /**
     * DRY helper for Cloudinary initialization
     */
    private function cloudinary(): Cloudinary
    {
        $config = new Configuration([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key' => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true,
            ],
        ]);

        return new Cloudinary($config);
    }

    /**
     * Helper to extract public_id from a Cloudinary URL for deletion
     */
    private function extractPublicId(string $url): ?string
    {
        $parsedUrl = parse_url($url);
        if (!isset($parsedUrl['path'])) {
            return null;
        }

        $path = $parsedUrl['path'];
        $pathParts = explode('/', $path);

        $uploadIndex = array_search('upload', $pathParts);
        if ($uploadIndex === false) {
            return null;
        }

        $publicIdParts = array_slice($pathParts, $uploadIndex + 2);
        if (empty($publicIdParts)) {
            return null;
        }

        $publicIdWithExtension = implode('/', $publicIdParts);
        return preg_replace('/\.[^.]+$/', '', $publicIdWithExtension);
    }
}
