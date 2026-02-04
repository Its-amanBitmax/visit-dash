<?php

namespace App\Http\Controllers;

use App\Models\AgentChatEvaluation;
use Illuminate\Http\Request;

class AgentChatEvaluationController extends Controller
{
    public function index()
    {
        $evaluations = AgentChatEvaluation::latest()->paginate(10);

        return view('agent-chat-evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        return view('agent-chat-evaluations.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $overall = $this->calculateOverall($validated);
        $validated['overall_score'] = $overall;
        $validated['percentage'] = $overall;

        AgentChatEvaluation::create($validated);

        return redirect()
            ->route('agent-chat-evaluations.index')
            ->with('status', 'Evaluation created successfully.');
    }

    public function show($id)
    {
        $evaluation = AgentChatEvaluation::findOrFail($id);

        return view('agent-chat-evaluations.show', compact('evaluation'));
    }

    public function downloadPdf($id)
    {
        $evaluation = AgentChatEvaluation::findOrFail($id);

        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.agent-chat-evaluation-pdf', compact('evaluation'));

            return $pdf->download('agent-chat-evaluation-' . $evaluation->id . '.pdf');
        }

        return view('reports.agent-chat-evaluation-pdf', compact('evaluation'));
    }

    public function edit($id)
    {
        $evaluation = AgentChatEvaluation::findOrFail($id);

        return view('agent-chat-evaluations.edit', compact('evaluation'));
    }

    public function update(Request $request, $id)
    {
        $evaluation = AgentChatEvaluation::findOrFail($id);

        $validated = $this->validateData($request);
        $overall = $this->calculateOverall($validated);
        $validated['overall_score'] = $overall;
        $validated['percentage'] = $overall;

        $evaluation->update($validated);

        return redirect()
            ->route('agent-chat-evaluations.show', $evaluation->id)
            ->with('status', 'Evaluation updated successfully.');
    }

    public function destroy($id)
    {
        AgentChatEvaluation::findOrFail($id)->delete();

        return redirect()
            ->route('agent-chat-evaluations.index')
            ->with('status', 'Evaluation deleted successfully.');
    }

    private function calculateOverall(array $data): int
    {
        return
            $data['communication_skills'] +
            $data['opening_closing'] +
            $data['grammar'] +
            $data['chat_etiquettes'] +
            $data['scenario_based_questions'] +
            $data['response_time'] +
            $data['crm_knowledge'] +
            $data['customer_handling'] +
            $data['quality_accuracy'];
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'project_name' => 'nullable|string|max:100',
            'center_name' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:100',
            'evaluator_name' => 'nullable|string|max:100',

            'agent_id' => 'required|string|max:50',
            'agent_name' => 'required|string|max:100',

            'communication_skills' => 'required|integer|min:0|max:10',
            'opening_closing' => 'required|integer|min:0|max:10',
            'grammar' => 'required|integer|min:0|max:10',
            'chat_etiquettes' => 'required|integer|min:0|max:10',
            'scenario_based_questions' => 'required|integer|min:0|max:20',
            'response_time' => 'required|integer|min:0|max:10',
            'crm_knowledge' => 'required|integer|min:0|max:10',
            'customer_handling' => 'required|integer|min:0|max:10',
            'quality_accuracy' => 'required|integer|min:0|max:10',

            'evaluator_remarks' => 'nullable|string',
            'column001' => 'nullable|date',
            'column002' => 'nullable|string|max:255',
        ]);
    }
}
