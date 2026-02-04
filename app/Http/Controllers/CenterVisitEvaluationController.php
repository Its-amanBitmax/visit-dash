<?php

namespace App\Http\Controllers;

use App\Models\CenterVisitEvaluation;
use Illuminate\Http\Request;

class CenterVisitEvaluationController extends Controller
{
    public function index()
    {
        $search = trim((string) request('search'));

        $evaluations = CenterVisitEvaluation::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('center_name', 'like', '%' . $search . '%')
                        ->orWhere('location', 'like', '%' . $search . '%')
                        ->orWhere('evaluator_name', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('center-visit-evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        return view('center-visit-evaluations.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        CenterVisitEvaluation::create($validated);

        return redirect()
            ->route('center-visit-evaluations.index')
            ->with('status', 'Center visit evaluation created successfully.');
    }

    public function show($id)
    {
        $evaluation = CenterVisitEvaluation::findOrFail($id);

        return view('center-visit-evaluations.show', compact('evaluation'));
    }

    public function downloadPdf($id)
    {
        $evaluation = CenterVisitEvaluation::findOrFail($id);

        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.center-visit-evaluation-pdf', compact('evaluation'));

            return $pdf->download('center-visit-evaluation-' . $evaluation->id . '.pdf');
        }

        return view('reports.center-visit-evaluation-pdf', compact('evaluation'));
    }

    public function edit($id)
    {
        $evaluation = CenterVisitEvaluation::findOrFail($id);

        return view('center-visit-evaluations.edit', compact('evaluation'));
    }

    public function update(Request $request, $id)
    {
        $evaluation = CenterVisitEvaluation::findOrFail($id);

        $validated = $this->validateData($request);

        $evaluation->update($validated);

        return redirect()
            ->route('center-visit-evaluations.show', $evaluation->id)
            ->with('status', 'Center visit evaluation updated successfully.');
    }

    public function destroy($id)
    {
        CenterVisitEvaluation::findOrFail($id)->delete();

        return redirect()
            ->route('center-visit-evaluations.index')
            ->with('status', 'Center visit evaluation deleted successfully.');
    }

    public function downloadAllPdf()
    {
        $evaluations = CenterVisitEvaluation::latest()->get();

        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.center-visit-evaluation-pdf-all', compact('evaluations'));

            return $pdf->download('center-visit-evaluations-all.pdf');
        }

        return view('reports.center-visit-evaluation-pdf-all', compact('evaluations'));
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'center_name' => 'required|string|max:150',
            'location' => 'required|string|max:150',
            'visit_date' => 'required|date',
            'duration' => 'required|string|max:50',

            'infrastructure_by_client' => 'required|in:meet,not_meet,need_change,action_required',
            'remarks1' => 'nullable|string',

            'system_required_by_client' => 'required|in:meet,not_meet,need_change,action_required',
            'remarks2' => 'nullable|string',

            'manpower_required_by_client' => 'required|in:meet,not_meet,need_change,action_required',
            'remarks3' => 'nullable|string',

            'evaluator_name' => 'required|string|max:100',
            'evaluator_remarks' => 'nullable|string',
        ]);
    }
}
