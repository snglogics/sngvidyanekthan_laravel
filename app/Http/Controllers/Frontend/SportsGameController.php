<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SportsGame;

class SportsGameController extends Controller
{
    public function index() {
        $sports = SportsGame::orderBy('title')->get();
        return view('sports_games.index', compact('sports'));
    }

    public function show(SportsGame $sportsGame) {
        return view('sports_games.show', compact('sportsGame'));
    }
}
