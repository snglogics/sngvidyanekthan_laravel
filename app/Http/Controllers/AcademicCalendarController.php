<?php

namespace App\Http\Controllers;

use App\Models\AcademicCalendar;
use Illuminate\Http\Request;

class AcademicCalendarController extends Controller
{
    public function academicCalendarFrontend()
    {
        // Fetch distinct academic years for filtering
        $academicYears = AcademicCalendar::select('academic_year')->distinct()->pluck('academic_year');
        return view('admin.academic_calendars.frontend', compact('academicYears'));
    }

    public function academicCalendar(Request $request)
    {
        $query = AcademicCalendar::query();

        if ($request->has('academic_year') && $request->academic_year !== 'all') {
            $query->where('academic_year', $request->academic_year);
        }

        if ($request->has('month') && $request->month !== 'all') {
            $query->whereMonth('start_date', $request->month);
        }

        $events = $query->get()->map(function ($event) {
            return [
                'event_name' => $event->event_name,
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'audience' => $event->audience,
                'attachment_url' => $event->attachment_url,
                'event_type' => $event->event_type,
                'academic_year' => $event->academic_year,
                'color' => $event->color,
                'description' => $event->description,
            ];
        });

        return response()->json($events);
    }

    public function index()
    {
        $events = AcademicCalendar::orderBy('start_date', 'asc')->get();
        return view('admin.academic_calendars.index', compact('events'));
    }

    public function create()
    {
        return view('admin.academic_calendars.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'event_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'event_type' => 'required|string|max:50',
            'academic_year' => 'required|string|max:50',
            'audience' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:7',
            'attachment' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'description' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('attachment')) {
            $cloudinary = $this->cloudinary();

            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('attachment')->getRealPath(),
                [
                    'folder' => 'academic_attachments',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'auto',
                ]
            );

            $data['attachment_url'] = $uploadedFile['secure_url'];
        }

        AcademicCalendar::create($data);

        return redirect()->route('admin.academic-calendars.index')->with('success', 'Event added successfully!');
    }

    public function show($id)
    {
        $event = AcademicCalendar::findOrFail($id);
        return view('admin.academic_calendars.show', compact('event'));
    }

    public function edit(AcademicCalendar $academicCalendar)
    {
        return view('admin.academic_calendars.edit', compact('academicCalendar'));
    }

    public function update(Request $request, AcademicCalendar $academicCalendar)
    {
        $data = $request->validate([
            'event_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'event_type' => 'required|string|max:50',
            'academic_year' => 'required|string|max:50',
            'audience' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:7',
            'attachment' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            $cloudinary = $this->cloudinary();

            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('attachment')->getRealPath(),
                [
                    'folder' => 'academic_attachments',
                    'public_id' => uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'auto',
                ]
            );

            $data['attachment_url'] = $uploadedFile['secure_url'];
        }

        $academicCalendar->update($data);

        return redirect()->route('admin.academic-calendars.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(AcademicCalendar $academicCalendar)
    {
        $academicCalendar->delete();
        return redirect()->route('admin.academic-calendars.index')->with('success', 'Event deleted successfully!');
    }

    /**
     * DRY helper for Cloudinary initialization
     */
    private function cloudinary()
    {
        return new \Cloudinary\Cloudinary(
            new \Cloudinary\Configuration\Configuration([
                'cloud' => [
                    'cloud_name' => config('cloudinary.cloud_name'),
                    'api_key' => config('cloudinary.api_key'),
                    'api_secret' => config('cloudinary.api_secret'),
                ],
                'url' => [
                    'secure' => true,
                ],
            ])
        );
    }
}
