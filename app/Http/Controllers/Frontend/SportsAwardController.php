<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SportsAward;
use Illuminate\Http\Request;

class SportsAwardController extends Controller
{
    public function index(Request $request)
    {
        $query = SportsAward::query();

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by award year
        if ($request->filled('year')) {
            $query->where('award_year', $request->year);
        }

        // Get all distinct award years for the filter dropdown
        $years = SportsAward::select('award_year')->distinct()->orderBy('award_year', 'desc')->pluck('award_year');

        // Pagination (6 awards per page)
        $awards = $query->latest()->paginate(6);

        return view('sports_awards.index', compact('awards', 'years'));
    }

    public function show(SportsAward $sportsAward)
    {
        return view('sports_awards.show', compact('sportsAward'));
    }
}
