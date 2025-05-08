<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Timetable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{

public function timetableview ()
{
    $timetables = Timetable::orderBy('classname')
        ->orderBy('period_number')
        ->get();

    $groupedTimetables = $timetables
        ->groupBy(function ($item) {
            return $item->classname . ($item->section ? '-' . $item->section : '');
        })
        ->map(function ($group) {
            return $group->groupBy('day');
        });

return view('admin.timetable.timetable', compact('groupedTimetables'));

}
    public function index()
    {
        $timetables = Timetable::orderBy('classname')
    ->orderBy('section')
    ->orderBy('created_at', 'asc')
    ->get()
    ->groupBy(function ($item) {
        return $item->classname . ' - ' . ($item->section ?? 'No Section');
    });
        return view('admin.timetable.index', compact('timetables'));
    }

    public function create()
    {
        return view('admin.timetable.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'classname' => 'required|string|max:255',
            'section' => 'nullable|string|max:100',
            'day' => 'required|string|max:50',
            'period_number' => 'required|integer|min:1',
            'subject' => 'required|string|max:255',
            'teacher_name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_number' => 'nullable|string|max:100',
        ]);

        Timetable::create($request->all());

        return response()->json(['success' => true, 'message' => 'Timetable entry created successfully.']);
    }

    public function edit(Timetable $timetable)
    {
        return view('admin.timetable.edit', compact('timetable'));
    }

    public function update(Request $request, Timetable $timetable)
    {
        $request->validate([
            'classname' => 'required|string|max:255',
            'section' => 'nullable|string|max:100',
            'day' => 'required|string|max:50',
            'period_number' => 'required|integer|min:1',
            'subject' => 'required|string|max:255',
            'teacher_name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_number' => 'nullable|string|max:100',
        ]);

        $timetable->update($request->all());

        return redirect()->route('admin.timetables.index')->with('success', 'Timetable updated successfully.');
    }

    public function destroy(Timetable $timetable)
    {
        $timetable->delete();
        return redirect()->back()->with('success', 'Timetable deleted successfully.');
    }


}
