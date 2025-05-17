<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CulturalCompetition;
use Illuminate\Http\Request;

class CulturalCompetitionFrontendController extends Controller
{
    public function index()
    {
        $competitions = CulturalCompetition::latest()->get();
        return view('frontend.cultural_competitions.index', compact('competitions'));
    }

    public function show(CulturalCompetition $culturalCompetition)
    {
        return view('frontend.cultural_competitions.show', compact('culturalCompetition'));
    }
}
