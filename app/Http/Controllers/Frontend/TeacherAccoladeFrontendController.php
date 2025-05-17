<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherAccoladeFrontendController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all accolades
        $accolades = TeacherAccolade::latest()->get();

        return view('frontend.teachers_accolades.index', compact('accolades'));
    }

    public function show(TeacherAccolade $teacherAccolade)
    {
        return view('frontend.teachers_accolades.show', compact('teacherAccolade'));
    }
}
