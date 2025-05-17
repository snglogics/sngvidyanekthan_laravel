<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\InterschoolParticipation;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class InterFrontendschoolParticipationController extends Controller
{

public function frontendindex()
{
    $participations = InterschoolParticipation::latest()->paginate(12);
    return view('frontend.interschool_participations.index', compact('participations'));
}
}