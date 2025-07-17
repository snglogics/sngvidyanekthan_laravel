<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class TimeTableController extends Controller
{
    // 🔧 Cloudinary config helper
    private function cloudinary()
    {
        $config = new Configuration([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key'    => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => ['secure' => true]
        ]);

        return new Cloudinary($config);
    }

    // 📄 Show all uploaded timetables
    public function index()
    {
        $timetables = Timetable::orderBy('classname')->get();
        return view('admin.timetable.index', compact('timetables'));
    }

    // ➕ Show upload form
    public function create()
    {
        return view('admin.timetable.create');
    }

    // 💾 Upload new timetable PDF
    public function store(Request $request)
    {
        $request->validate([
            'classname' => 'required|string|max:255',
            'timetable_pdf' => 'required|mimes:pdf|max:2048',
        ]);

        try {
            $cloudinary = $this->cloudinary();

            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('timetable_pdf')->getRealPath(),
                [
                    'folder' => 'timetables',
                    'public_id' => 'timetable_' . uniqid() . '.pdf',
                    'overwrite' => true,
                    'resource_type' => 'raw' // for PDF
                ]
            );

            Timetable::create([
                'classname' => $request->classname,
                'pdf_url' => $uploadedFile['secure_url'],
                'pdf_public_id' => $uploadedFile['public_id'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Timetable PDF uploaded successfully.',
                'redirect' => route('admin.timetables.index')
            ]);
        } catch (\Exception $e) {
            Log::error('Timetable upload failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // 📝 Edit timetable view
    public function edit(Timetable $timetable)
    {
        return view('admin.timetable.edit', compact('timetable'));
    }

    // 🔁 Update timetable PDF
    public function update(Request $request, Timetable $timetable)
    {
        $request->validate([
            'classname' => 'required|string|max:255',
            'timetable_pdf' => 'nullable|mimes:pdf|max:2048',
        ]);

        try {
            $data = ['classname' => $request->classname];

            if ($request->hasFile('timetable_pdf')) {
                $cloudinary = $this->cloudinary();

                // 🧹 Remove old PDF from Cloudinary
                if ($timetable->pdf_public_id) {
                    $cloudinary->uploadApi()->destroy($timetable->pdf_public_id, [
                        'resource_type' => 'raw'
                    ]);
                }

                // 📤 Upload new PDF
                $uploadedFile = $cloudinary->uploadApi()->upload(
                    $request->file('timetable_pdf')->getRealPath(),
                    [
                        'folder' => 'timetables',
                        'public_id' => 'timetable_' . uniqid() . '.pdf',
                        'overwrite' => true,
                        'resource_type' => 'raw'
                    ]
                );

                $data['pdf_url'] = $uploadedFile['secure_url'];
                $data['pdf_public_id'] = $uploadedFile['public_id'];
            }

            $timetable->update($data);

            return redirect()->route('admin.timetables.index')
                ->with('success', 'Timetable updated successfully.');
        } catch (\Exception $e) {
            Log::error('Timetable update failed: ' . $e->getMessage());

            return back()->with('error', 'Timetable update failed: ' . $e->getMessage())
                ->withInput();
        }
    }

    // ❌ Delete timetable and PDF
    public function destroy(Timetable $timetable)
    {
        try {
            if ($timetable->pdf_public_id) {
                $cloudinary = $this->cloudinary();
                $cloudinary->uploadApi()->destroy($timetable->pdf_public_id, [
                    'resource_type' => 'raw'
                ]);
            }

            $timetable->delete();

            return redirect()->back()->with('success', 'Timetable deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Timetable deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Timetable deletion failed: ' . $e->getMessage());
        }
    }

    public function timetableview()
    {
        $timetables = Timetable::orderBy('classname')->get();

        return view('admin.timetable.timetable', compact('timetables'));
    }

    public function download($id)
    {
        $timetable = Timetable::findOrFail($id);
        $filename = $timetable->classname . '_timetable.pdf';

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->streamDownload(function () use ($timetable) {
            echo file_get_contents($timetable->pdf_url);
        }, $filename, $headers);
    }
}
