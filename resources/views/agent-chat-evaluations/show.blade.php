@extends('admin.layout')

@section('title', 'Evaluation Details')
@section('header', 'Evaluation Details')

@section('content')
    <style>
        html, body {
            height: 100%;
        }

        body {
            overflow: hidden;
        }

        .layout,
        .content {
            height: 100vh;
        }

        .main {
            overflow-y: auto;
            min-height: 0;
        }
    </style>
    <div class="page-card" style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
        <div>
            <div style="font-size:18px;font-weight:700;">Evaluation #{{ $evaluation->id }}</div>
            <div style="color:#606776;">Agent {{ $evaluation->agent_id }} - {{ $evaluation->agent_name }}</div>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <a class="btn" href="{{ route('agent-chat-evaluations.pdf', $evaluation->id) }}">Download PDF</a>
            <a class="btn btn-secondary" href="{{ route('agent-chat-evaluations.edit', $evaluation->id) }}">Edit</a>
            <a class="btn" href="{{ route('agent-chat-evaluations.index') }}">Back</a>
        </div>
    </div>

    @if (session('status'))
        <div class="page-card" style="border-color:#bfdbfe;background:#eff6ff;color:#1e3a8a;">
            {{ session('status') }}
        </div>
    @endif

    <div class="page-card" style="display:grid;gap:18px;">
        <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;">
            <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Basic Details</div>
                <div style="display:grid;gap:6px;">
                    <div>Project: <strong>{{ $evaluation->project_name }}</strong></div>
                    <div>Center: <strong>{{ $evaluation->center_name }}</strong></div>
                    <div>Location: <strong>{{ $evaluation->location }}</strong></div>
                    <div>Evaluator: <strong>{{ $evaluation->evaluator_name }}</strong></div>
                </div>
            </div>
            <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Overall</div>
                <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
                    <div style="font-size:28px;font-weight:700;color:#1d4ed8;">{{ $evaluation->overall_score }}</div>
                    <div style="color:#606776;">{{ $evaluation->percentage }}% Score</div>
                </div>
            </div>
        </div>

        <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Scores Breakdown</div>
            <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px;">
                <div>Communication Skills: <strong>{{ $evaluation->communication_skills }}</strong></div>
                <div>Opening/Closing: <strong>{{ $evaluation->opening_closing }}</strong></div>
                <div>Grammar: <strong>{{ $evaluation->grammar }}</strong></div>
                <div>Chat Etiquettes: <strong>{{ $evaluation->chat_etiquettes }}</strong></div>
                <div>Scenario Based Questions: <strong>{{ $evaluation->scenario_based_questions }}</strong></div>
                <div>Response Time: <strong>{{ $evaluation->response_time }}</strong></div>
                <div>CRM Knowledge: <strong>{{ $evaluation->crm_knowledge }}</strong></div>
                <div>Customer Handling: <strong>{{ $evaluation->customer_handling }}</strong></div>
                <div>Quality/Accuracy: <strong>{{ $evaluation->quality_accuracy }}</strong></div>
            </div>
        </div>

        <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Remarks</div>
            <div style="white-space:pre-line;">{{ $evaluation->evaluator_remarks }}</div>
        </div>

        <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Evaluation Date</div>
            <div>{{ $evaluation->column001 }}</div>
        </div>
    </div>
@endsection
