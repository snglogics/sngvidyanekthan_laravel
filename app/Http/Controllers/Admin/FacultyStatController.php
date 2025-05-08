<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacultyStat;

class FacultyStatController extends Controller
{
    public function facultyHome()
    {
        return view('admin.faculty.home');
    }

    public function create()
{
    $existing = FacultyStat::latest()->first();
    return view('admin.faculty.create', compact('existing'));
}

public function store(Request $request)
{
    $request->validate([
        'total_teachers' => 'required|integer',
        'pgts' => 'required|integer',
        'tgts' => 'required|integer',
        'prts' => 'required|integer',
        'pets' => 'required|integer',
        'non_teaching' => 'required|integer',
        'mandatory_training_teachers' => 'required|integer',
        'trainings_attended' => 'required|integer',
        'special_educator' => 'required|in:YES,NO',
        'counsellor_appointed' => 'required|in:YES,NO',
        'mandatory_training_completed' => 'required|in:YES,NO',
        'ntts' => 'required|in:YES,NO',
    ]);

    FacultyStat::create($request->all());

    return redirect()->back()->with('success', 'Faculty details saved successfully.');
}

public function showFacultyStats()
{
    $facultyStat = FacultyStat::latest()->first(); // get the most recent entry
    return view('faculty.faculty', compact('facultyStat'));
}
}
