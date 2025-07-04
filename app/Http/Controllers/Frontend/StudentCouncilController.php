<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\StudentCouncil;

class StudentCouncilController extends Controller
{
    public function index()
    {
        $members = StudentCouncil::latest()->get();
        return view('frontend.student_council.index', compact('members'));
    }
}
