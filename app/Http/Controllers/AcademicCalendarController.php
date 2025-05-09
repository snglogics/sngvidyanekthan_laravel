<?php

namespace App\Http\Controllers;

use App\Models\AcademicCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
    $request->validate([
        'event_name' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'event_type' => 'required|string|max:50',
        'academic_year' => 'required|string|max:50',
        'audience' => 'nullable|string|max:100',
        'color' => 'nullable|string|max:7',
        'attachment' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048'
    ]);

    // Initialize Cloudinary
    $cloudinary = new \Cloudinary\Cloudinary([
        'cloud' => [
            'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
            'api_key'    => env('CLOUDINARY_API_KEY'),
            'api_secret' => env('CLOUDINARY_API_SECRET'),
        ]
    ]);

    // Handle file upload to Cloudinary
    $attachmentUrl = null;
    if ($request->hasFile('attachment')) {
        $uploadedFile = $cloudinary->uploadApi()->upload($request->file('attachment')->getRealPath(), [
            'folder' => 'academic_attachments',
            'public_id' => uniqid(),
            'overwrite' => true,
            'resource_type' => 'auto'
        ]);
        
        // Extract the secure URL
        $attachmentUrl = $uploadedFile['secure_url'];
    }

    // Save the event
    AcademicCalendar::create([
        'event_name' => $request->event_name,
        'description' => $request->description,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'event_type' => $request->event_type,
        'academic_year' => $request->academic_year,
        'audience' => $request->audience,
        'color' => $request->color ?? '#007bff',
        'attachment_url' => $attachmentUrl
    ]);

    return redirect()->route('admin.academic-calendars.index')->with('success', 'Event added successfully!');
}

    public function show(AcademicCalendar $academicCalendar)
    {
        return view('admin.academic_calendars.show', compact('academicCalendar'));
    }

    public function edit(AcademicCalendar $academicCalendar)
    {
        return view('admin.academic_calendars.edit', compact('academicCalendar'));
    }

    public function update(Request $request, AcademicCalendar $academicCalendar)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'event_type' => 'required|string|max:50',
            'academic_year' => 'required|string|max:50',
            'audience' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:7',
            'attachment' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048'
        ]);
        
        $cloudinary = new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ]
        ]);
        // Update file if provided
        if ($request->hasFile('attachment')) {
            $uploadedFile =  $cloudinary->uploadApi()->upload($request->file('attachment')->getRealPath(), [
                'folder' => 'academic_attachments',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'auto'
            ]);
        
            // Set the new attachment URL
            $request->merge([
                'attachment_url' => $uploadedFile['secure_url']
            ]);
        }
        // Update other fields
        $academicCalendar->update($request->except(['attachment']));

        return redirect()->route('admin.academic-calendars.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(AcademicCalendar $academicCalendar)
    {
        $academicCalendar->delete();
        return redirect()->route('admin.academic-calendars.index')->with('success', 'Event deleted successfully!');
    }




}