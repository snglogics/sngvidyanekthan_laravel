<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicPerformance;

class AcademicPerformanceController extends Controller
{
    public function index()
    {
        $performances = AcademicPerformance::latest()->get();
        return view('academic_performances.index', compact('performances'));
    }

    public function show(AcademicPerformance $academicPerformance)
    {
        return view('academic_performances.show', compact('academicPerformance'));
    }
}
