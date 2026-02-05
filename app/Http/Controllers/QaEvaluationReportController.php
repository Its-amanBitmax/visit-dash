<?php

namespace App\Http\Controllers;

use App\Models\QaEvaluationReport;
use Illuminate\Http\Request;

class QaEvaluationReportController extends Controller
{
    public function index()
    {
        $reports = QaEvaluationReport::latest()->paginate(10);

        return view('qa-evaluation-reports.index', compact('reports'));
    }

    public function create()
    {
        return view('qa-evaluation-reports.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        QaEvaluationReport::create($validated);

        return redirect()
            ->route('qa-evaluation-reports.index')
            ->with('status', 'QA evaluation report created successfully.');
    }

    public function show($id)
    {
        $report = QaEvaluationReport::findOrFail($id);

        return view('qa-evaluation-reports.show', compact('report'));
    }

    public function edit($id)
    {
        $report = QaEvaluationReport::findOrFail($id);

        return view('qa-evaluation-reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = QaEvaluationReport::findOrFail($id);

        $validated = $this->validateData($request);
        $report->update($validated);

        return redirect()
            ->route('qa-evaluation-reports.show', $report->id)
            ->with('status', 'QA evaluation report updated successfully.');
    }

    public function destroy($id)
    {
        QaEvaluationReport::findOrFail($id)->delete();

        return redirect()
            ->route('qa-evaluation-reports.index')
            ->with('status', 'QA evaluation report deleted successfully.');
    }

    public function downloadPdf($id)
    {
        $report = QaEvaluationReport::findOrFail($id);

        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.qa-evaluation-report-pdf', compact('report'));
            return $pdf->download('qa-evaluation-report-' . $report->id . '.pdf');
        }

        return view('reports.qa-evaluation-report-pdf', compact('report'));
    }

    public function downloadAllPdf()
    {
        $reports = QaEvaluationReport::latest()->get();

        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.qa-evaluation-report-pdf-all', compact('reports'));
            return $pdf->download('qa-evaluation-reports-all.pdf');
        }

        return view('reports.qa-evaluation-report-pdf-all', compact('reports'));
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:150',
            'employee_id' => 'required|string|max:50',
            'process_project' => 'required|string|max:150',
            'client_name' => 'required|string|max:150',
            'reporting_manager' => 'required|string|max:150',

            'evaluation_from' => 'required|date',
            'evaluation_to' => 'required|date',
            'total_audits_done' => 'required|integer|min:0',
            'audit_type' => 'required|in:calls,chats,both',

            'audit_accuracy_rating' => 'required|integer|min:1|max:5',
            'audit_accuracy_remarks' => 'nullable|string',
            'process_knowledge_rating' => 'required|integer|min:1|max:5',
            'process_knowledge_remarks' => 'nullable|string',
            'compliance_sop_rating' => 'required|integer|min:1|max:5',
            'compliance_sop_remarks' => 'nullable|string',
            'reporting_accuracy_rating' => 'required|integer|min:1|max:5',
            'reporting_accuracy_remarks' => 'nullable|string',
            'productivity_rating' => 'required|integer|min:1|max:5',
            'productivity_remarks' => 'nullable|string',
            'escalation_handling_rating' => 'required|integer|min:1|max:5',
            'escalation_handling_remarks' => 'nullable|string',
            'documentation_skills_rating' => 'required|integer|min:1|max:5',
            'documentation_skills_remarks' => 'nullable|string',

            'monitoring_quality' => 'required|in:excellent,good,average,poor',
            'error_identification' => 'required|in:excellent,good,average,poor',
            'correct_parameter_marking' => 'required|boolean',
            'score_calculation_accuracy' => 'required|boolean',
            'agent_coaching_quality' => 'required|in:excellent,good,average,poor',
            'feedback_professionalism' => 'required|in:excellent,good,average,poor',
            'improvement_tracking' => 'required|boolean',
            'repeat_error_followup' => 'required|boolean',
            'attendance_adherence' => 'required|boolean',
            'punctuality' => 'required|boolean',
            'data_confidentiality_awareness' => 'required|in:strong,moderate,weak',
            'policy_compliance' => 'required|in:strong,moderate,weak',

            'strengths' => 'nullable|string',
            'improvement_areas' => 'nullable|string',

            'average_quality_score' => 'nullable|numeric',
            'error_count' => 'nullable|integer|min:0',
            'critical_errors' => 'nullable|integer|min:0',
            'repeat_errors' => 'nullable|integer|min:0',

            'overall_rating' => 'required|integer|min:1|max:5',
            'final_remarks' => 'nullable|string',
            'evaluator_name' => 'required|string|max:150',
            'evaluation_date' => 'required|date',
        ]);
    }
}
