<?php

namespace App\Http\Controllers;

use App\Models\TlEvaluationReport;
use Illuminate\Http\Request;

class TlEvaluationReportController extends Controller
{
    public function index()
    {
        $search = trim((string) request('search'));
        $reports = TlEvaluationReport::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('employee_id', 'like', '%' . $search . '%')
                        ->orWhere('process_project', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('tl-evaluation-reports.index', compact('reports'));
    }

    public function create()
    {
        return view('tl-evaluation-reports.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        TlEvaluationReport::create($validated);

        return redirect()
            ->route('tl-evaluation-reports.index')
            ->with('status', 'TL evaluation report created successfully.');
    }

    public function show($id)
    {
        $report = TlEvaluationReport::findOrFail($id);

        return view('tl-evaluation-reports.show', compact('report'));
    }

    public function edit($id)
    {
        $report = TlEvaluationReport::findOrFail($id);

        return view('tl-evaluation-reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = TlEvaluationReport::findOrFail($id);
        $validated = $this->validateData($request);
        $report->update($validated);

        return redirect()
            ->route('tl-evaluation-reports.show', $report->id)
            ->with('status', 'TL evaluation report updated successfully.');
    }

    public function destroy($id)
    {
        TlEvaluationReport::findOrFail($id)->delete();

        return redirect()
            ->route('tl-evaluation-reports.index')
            ->with('status', 'TL evaluation report deleted successfully.');
    }

    public function downloadPdf($id)
    {
        $report = TlEvaluationReport::findOrFail($id);

        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.tl-evaluation-report-pdf', compact('report'));
            return $pdf->download('tl-evaluation-report-' . $report->id . '.pdf');
        }

        return view('reports.tl-evaluation-report-pdf', compact('report'));
    }

    public function downloadAllPdf()
    {
        $reports = TlEvaluationReport::latest()->get();

        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.tl-evaluation-report-pdf-all', compact('reports'));
            return $pdf->download('tl-evaluation-reports-all.pdf');
        }

        return view('reports.tl-evaluation-report-pdf-all', compact('reports'));
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:150',
            'employee_id' => 'required|string|max:50',
            'process_project' => 'required|string|max:150',
            'team_strength' => 'required|integer|min:0',
            'evaluation_from' => 'required|date',
            'evaluation_to' => 'required|date',
            'team_handling_rating' => 'required|integer|min:1|max:5',
            'team_handling_remarks' => 'nullable|string',
            'productivity_achievement_rating' => 'required|integer|min:1|max:5',
            'productivity_achievement_remarks' => 'nullable|string',
            'quality_improvement_rating' => 'required|integer|min:1|max:5',
            'quality_improvement_remarks' => 'nullable|string',
            'attendance_management_rating' => 'required|integer|min:1|max:5',
            'attendance_management_remarks' => 'nullable|string',
            'training_coaching_rating' => 'required|integer|min:1|max:5',
            'training_coaching_remarks' => 'nullable|string',
            'escalation_handling_rating' => 'required|integer|min:1|max:5',
            'escalation_handling_remarks' => 'nullable|string',
            'client_communication_rating' => 'required|integer|min:1|max:5',
            'client_communication_remarks' => 'nullable|string',
            'reporting_documentation_rating' => 'required|integer|min:1|max:5',
            'reporting_documentation_remarks' => 'nullable|string',
            'kpi_aht_target' => 'nullable|string|max:50',
            'kpi_aht_achieved' => 'nullable|string|max:50',
            'kpi_aht_status' => 'nullable|in:met,not_met',
            'kpi_qa_target' => 'nullable|string|max:50',
            'kpi_qa_achieved' => 'nullable|string|max:50',
            'kpi_qa_status' => 'nullable|in:met,not_met',
            'kpi_csat_target' => 'nullable|string|max:50',
            'kpi_csat_achieved' => 'nullable|string|max:50',
            'kpi_csat_status' => 'nullable|in:met,not_met',
            'kpi_attendance_target' => 'nullable|string|max:50',
            'kpi_attendance_achieved' => 'nullable|string|max:50',
            'kpi_attendance_status' => 'nullable|in:met,not_met',
            'kpi_productivity_target' => 'nullable|string|max:50',
            'kpi_productivity_achieved' => 'nullable|string|max:50',
            'kpi_productivity_status' => 'nullable|in:met,not_met',
            'team_discipline_maintained' => 'required|boolean',
            'shift_adherence' => 'required|boolean',
            'roster_planning' => 'required|boolean',
            'attrition_control' => 'required|in:strong,moderate,weak',
            'regular_coaching_sessions' => 'required|boolean',
            'training_plan_prepared' => 'required|boolean',
            'performance_improvement_tracking' => 'required|boolean',
            'low_performer_management' => 'required|in:strong,moderate,weak',
            'client_communication' => 'required|in:excellent,good,average,poor',
            'internal_reporting' => 'required|in:excellent,good,average,poor',
            'escalation_closure_speed' => 'required|in:fast,moderate,slow',
            'coordination_with_hr' => 'required|in:good,average,weak',
            'strengths1' => 'nullable|string',
            'strengths2' => 'nullable|string',
            'strengths3' => 'nullable|string',
            'improvement1' => 'nullable|string',
            'improvement2' => 'nullable|string',
            'improvement3' => 'nullable|string',
            'overall_rating' => 'required|integer|min:1|max:5',
            'final_remarks' => 'nullable|string',
            'evaluator_name' => 'required|string|max:150',
            'evaluation_date' => 'required|date',
            'promotion_recommended' => 'required|boolean',
            'training_required' => 'required|boolean',
            'warning_required' => 'required|boolean',
            'pip_recommended' => 'required|boolean',
            'salary_revision' => 'required|boolean',
        ]);
    }
}
