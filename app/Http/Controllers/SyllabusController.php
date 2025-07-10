<?php

namespace App\Http\Controllers;

use App\Models\Syllabus;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SyllabusController extends Controller
{
    /**
     * Display public list of syllabuses
     */
    public function publicList(): View
    {
        $syllabuses = Syllabus::orderBy('classname')->orderBy('subject')->get();
        return view('admin.syllabuses.syllabus-list', compact('syllabuses'));
    }

    /**
     * Display a listing of syllabuses
     */
    public function index(): View
    {
        $syllabuses = Syllabus::orderBy('classname')->orderBy('subject')->get();
        return view('admin.syllabuses.index', compact('syllabuses'));
    }

    /**
     * Show the form for creating a new syllabus
     */
    public function create(): View
    {
        return view('admin.syllabuses.create');
    }

    /**
     * Store a newly created syllabus
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'classname' => 'required|string|max:255',
            'section' => 'nullable|string|max:100',
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:10240',
            'academic_year' => 'required|string|max:50',
        ]);

        if ($request->hasFile('pdf')) {
            $cloudinary = $this->cloudinary();
            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('pdf')->getRealPath(),
                [
                    'folder' => 'syllabus_files',
                    'public_id' => uniqid(),
                    'resource_type' => 'raw'
                ]
            );
            $data['pdf_url'] = $uploadResponse['secure_url'];
        }

        Syllabus::create($data);

        return redirect()->route('admin.syllabuses.index')
            ->with('success', 'Syllabus added successfully!');
    }

    /**
     * Show the form for editing a syllabus
     */
    public function edit(int $id): View
    {
        $syllabus = Syllabus::findOrFail($id);
        return view('admin.syllabuses.edit', compact('syllabus'));
    }

    /**
     * Update the specified syllabus
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate([
            'classname' => 'required|string|max:255',
            'section' => 'nullable|string|max:100',
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:10240',
            'academic_year' => 'required|string|max:50',
        ]);

        $syllabus = Syllabus::findOrFail($id);

        if ($request->hasFile('pdf')) {
            $cloudinary = $this->cloudinary();

            // Delete old PDF if exists
            if ($syllabus->pdf_url) {
                $publicId = $this->extractPublicId($syllabus->pdf_url);
                if ($publicId) {
                    $cloudinary->uploadApi()->destroy($publicId, ['resource_type' => 'raw']);
                }
            }

            $uploadResponse = $cloudinary->uploadApi()->upload(
                $request->file('pdf')->getRealPath(),
                [
                    'folder' => 'syllabus_files',
                    'public_id' => uniqid(),
                    'resource_type' => 'raw'
                ]
            );
            $data['pdf_url'] = $uploadResponse['secure_url'];
        }

        $syllabus->update($data);

        return redirect()->route('admin.syllabuses.index')
            ->with('success', 'Syllabus updated successfully!');
    }

    /**
     * Remove the specified syllabus
     */
    public function destroy(int $id): RedirectResponse
    {
        $syllabus = Syllabus::findOrFail($id);

        // Delete PDF from Cloudinary if exists
        if ($syllabus->pdf_url) {
            $cloudinary = $this->cloudinary();
            $publicId = $this->extractPublicId($syllabus->pdf_url);
            if ($publicId) {
                $cloudinary->uploadApi()->destroy($publicId, ['resource_type' => 'raw']);
            }
        }

        $syllabus->delete();

        return redirect()->route('admin.syllabuses.index')
            ->with('success', 'Syllabus deleted successfully!');
    }

    /**
     * DRY helper for Cloudinary initialization
     */
    private function cloudinary(): Cloudinary
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

    /**
     * Helper method to extract Cloudinary public_id from URL
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
