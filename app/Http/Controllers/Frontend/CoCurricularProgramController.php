<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CoCurricularProgram;

class CoCurricularProgramController extends Controller
{
    public function index() {
        $programs = CoCurricularProgram::orderBy('name')->get();
        return view('co_curricular_programs.index', compact('programs'));
    }

    public function show(CoCurricularProgram $program) {
        return view('co_curricular_programs.show', compact('program'));
    }
}
