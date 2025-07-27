<?php
namespace App\Http\Controllers\Frontend;

use App\Models\Assessment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class AssessmentFrontendController extends Controller
{
    public function index(Request $request)
    {
        // Get unique classes for filter dropdown
        $classes = Assessment::select('class')->distinct()->orderBy('class')->pluck('class');
        
        // Base query
        $query = Assessment::query();
        
        // Apply class filter if selected
        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }
        
        // Get all assessments (we'll sort and group them in PHP for more flexibility)
        $assessments = $query->get();
        
        // Group assessments by class and then by month (June to May)
        $groupedAssessments = $assessments->groupBy('class')->map(function ($classAssessments) {
            // Sort assessments by date
            $sorted = $classAssessments->sortBy('assessment_date');
            
            // Group by month name (June to May)
            return $sorted->groupBy(function ($item) {
                $date = Carbon::parse($item->assessment_date);
                $month = $date->month;
                $year = $date->year;
                
                // Adjust year display for months June-Dec (show both years)
                if ($month >= 6) {
                    return $date->format('F Y');
                } else {
                    return $date->format('F Y');
                }
            });
        });
        
        // If filtered by class, we might have only one group
        if ($request->filled('class') && $groupedAssessments->isEmpty()) {
            // Add empty group for the selected class to show header
            $groupedAssessments = collect([
                $request->class => collect()
            ]);
        }
        
        return view('frontend.assessments', compact('groupedAssessments', 'classes'));
    }


}