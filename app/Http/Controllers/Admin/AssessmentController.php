<?php
namespace App\Http\Controllers\Admin;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class AssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Assessment::query();

        // Filter by class
        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        // Custom sort: June (6) to May (5)
        $query->get()->sortBy(function ($assessment) {
            $month = Carbon::parse($assessment->assessment_date)->month;
            return $month < 6 ? $month + 12 : $month;
        });

        $assessments = Assessment::all();

        return view('admin.assessments.index', compact('assessments'));
    }

    public function create()
    {
        return view('admin.assessments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'assessment_date' => 'required|date',
            'assessment_type' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'marks' => 'nullable|integer|min:0',
            'duration' => 'nullable|string|max:255',
            'open_house' => 'nullable|string|max:255',
        ]);

        Assessment::create($request->all());

        return redirect()->route('admin.assessments.index')->with('success', 'Assessment added successfully.');
    }

    public function edit(Assessment $assessment)
    {
        return view('admin.assessments.edit', compact('assessment'));
    }

    public function update(Request $request, Assessment $assessment)
    {
        $request->validate([
            'assessment_date' => 'required|date',
            'assessment_type' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'marks' => 'nullable|integer|min:0',
            'duration' => 'nullable|string|max:255',
            'open_house' => 'nullable|string|max:255',
        ]);

        $assessment->update($request->all());

        return redirect()->route('admin.assessments.index')->with('success', 'Assessment updated successfully.');
    }

    public function destroy(Assessment $assessment)
    {
        $assessment->delete();
        return redirect()->route('admin.assessments.index')->with('success', 'Assessment deleted.');
    }
}
