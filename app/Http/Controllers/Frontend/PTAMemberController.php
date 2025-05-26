<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PTAMember;

class PTAMemberController extends Controller
{
    public function index()
    {
        // Group PTA Members by position
        $ptaMembers = PTAMember::all()->groupBy('position');

        return view('frontend.pta-members.index', compact('ptaMembers'));
    }
}
