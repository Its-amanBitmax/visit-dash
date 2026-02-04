@extends('admin.layout')

@section('title', 'Edit Evaluation')
@section('header', 'Edit Evaluation')

@section('content')
    <div class="page-card" style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
        <div>
            <div style="font-size:18px;font-weight:700;">Edit Evaluation #{{ $evaluation->id }}</div>
            <div style="color:#606776;">Update the details below.</div>
        </div>
        <a class="btn btn-secondary" href="{{ route('agent-chat-evaluations.show', $evaluation->id) }}">Cancel</a>
    </div>

    @if ($errors->any())
        <div class="page-card" style="border-color:#fecaca;background:#fef2f2;color:#991b1b;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('agent-chat-evaluations.update', $evaluation->id) }}" class="page-card form-grid">
        @csrf
        @method('PUT')

        <div class="form-section">
            <h3>Basic</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Project Name</label>
                    <input type="text" name="project_name" value="{{ old('project_name', $evaluation->project_name) }}">
                </div>
                <div class="form-group">
                    <label>Center Name</label>
                    <input type="text" name="center_name" value="{{ old('center_name', $evaluation->center_name) }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" value="{{ old('location', $evaluation->location) }}">
                </div>
                <div class="form-group">
                    <label>Evaluator Name</label>
                    <input type="text" name="evaluator_name" value="{{ old('evaluator_name', $evaluation->evaluator_name) }}">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Agent</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Agent ID</label>
                    <input type="text" name="agent_id" value="{{ old('agent_id', $evaluation->agent_id) }}">
                </div>
                <div class="form-group">
                    <label>Agent Name</label>
                    <input type="text" name="agent_name" value="{{ old('agent_name', $evaluation->agent_name) }}">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Scores</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Communication Skills (0-10)</label>
                    <input type="number" name="communication_skills" min="0" max="10" value="{{ old('communication_skills', $evaluation->communication_skills) }}">
                </div>
                <div class="form-group">
                    <label>Opening/Closing (0-10)</label>
                    <input type="number" name="opening_closing" min="0" max="10" value="{{ old('opening_closing', $evaluation->opening_closing) }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Grammar (0-10)</label>
                    <input type="number" name="grammar" min="0" max="10" value="{{ old('grammar', $evaluation->grammar) }}">
                </div>
                <div class="form-group">
                    <label>Chat Etiquettes (0-10)</label>
                    <input type="number" name="chat_etiquettes" min="0" max="10" value="{{ old('chat_etiquettes', $evaluation->chat_etiquettes) }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Scenario Based (0-20)</label>
                    <input type="number" name="scenario_based_questions" min="0" max="20" value="{{ old('scenario_based_questions', $evaluation->scenario_based_questions) }}">
                </div>
                <div class="form-group">
                    <label>Response Time (0-10)</label>
                    <input type="number" name="response_time" min="0" max="10" value="{{ old('response_time', $evaluation->response_time) }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>CRM Knowledge (0-10)</label>
                    <input type="number" name="crm_knowledge" min="0" max="10" value="{{ old('crm_knowledge', $evaluation->crm_knowledge) }}">
                </div>
                <div class="form-group">
                    <label>Customer Handling (0-10)</label>
                    <input type="number" name="customer_handling" min="0" max="10" value="{{ old('customer_handling', $evaluation->customer_handling) }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Quality/Accuracy (0-10)</label>
                    <input type="number" name="quality_accuracy" min="0" max="10" value="{{ old('quality_accuracy', $evaluation->quality_accuracy) }}">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Remarks</h3>
            <div class="form-group">
                <label>Evaluator Remarks</label>
                <textarea name="evaluator_remarks">{{ old('evaluator_remarks', $evaluation->evaluator_remarks) }}</textarea>
            </div>
        </div>

        <div class="form-section">
            <h3>Evaluation Date</h3>
            <div class="form-group">
                <label>Date of Evaluation</label>
                <input type="date" name="column001" value="{{ old('column001', $evaluation->column001) }}">
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:10px;flex-wrap:wrap;">
            <button type="submit" class="btn">Update</button>
            <a class="btn btn-secondary" href="{{ route('agent-chat-evaluations.show', $evaluation->id) }}">Cancel</a>
        </div>
    </form>
@endsection
