@extends('admin.layout')

@section('title', 'QA Report Details')
@section('header', 'QA Report Details')

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
            <div style="font-size:18px;font-weight:700;">QA Report #{{ $report->id }}</div>
            <div style="color:#606776;">{{ $report->name }} - {{ $report->employee_id }}</div>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <a class="btn" href="{{ route('qa-evaluation-reports.pdf', $report->id) }}">Download PDF</a>
            <a class="btn btn-secondary" href="{{ route('qa-evaluation-reports.edit', $report->id) }}">Edit</a>
            <a class="btn" href="{{ route('qa-evaluation-reports.index') }}">Back</a>
        </div>
    </div>

    <div class="page-card" style="display:grid;gap:18px;">
        <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;">
            <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Basic</div>
                <div>Name: <strong>{{ $report->name }}</strong></div>
                <div>Employee ID: <strong>{{ $report->employee_id }}</strong></div>
                <div>Process/Project: <strong>{{ $report->process_project }}</strong></div>
                <div>Client: <strong>{{ $report->client_name }}</strong></div>
                <div>Reporting Manager: <strong>{{ $report->reporting_manager }}</strong></div>
                <div>Evaluation Date: <strong>{{ $report->evaluation_date }}</strong></div>
            </div>
            <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Audit</div>
                <div>From: <strong>{{ $report->evaluation_from }}</strong></div>
                <div>To: <strong>{{ $report->evaluation_to }}</strong></div>
                <div>Total Audits: <strong>{{ $report->total_audits_done }}</strong></div>
                <div>Audit Type: <strong>{{ $report->audit_type }}</strong></div>
            </div>
        </div>

        <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Work Performance</div>
            <div>Audit Accuracy: <strong>{{ $report->audit_accuracy_rating }}</strong></div>
            <div>Process Knowledge: <strong>{{ $report->process_knowledge_rating }}</strong></div>
            <div>Compliance SOP: <strong>{{ $report->compliance_sop_rating }}</strong></div>
            <div>Reporting Accuracy: <strong>{{ $report->reporting_accuracy_rating }}</strong></div>
            <div>Productivity: <strong>{{ $report->productivity_rating }}</strong></div>
            <div>Escalation Handling: <strong>{{ $report->escalation_handling_rating }}</strong></div>
            <div>Documentation Skills: <strong>{{ $report->documentation_skills_rating }}</strong></div>
        </div>

        <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">QA Skill</div>
            <div>Monitoring Quality: <strong>{{ $report->monitoring_quality }}</strong></div>
            <div>Error Identification: <strong>{{ $report->error_identification }}</strong></div>
            <div>Correct Parameter Marking: <strong>{{ $report->correct_parameter_marking ? 'Yes' : 'No' }}</strong></div>
            <div>Score Calculation Accuracy: <strong>{{ $report->score_calculation_accuracy ? 'Yes' : 'No' }}</strong></div>
        </div>

        <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Feedback & Coaching</div>
            <div>Agent Coaching Quality: <strong>{{ $report->agent_coaching_quality }}</strong></div>
            <div>Feedback Professionalism: <strong>{{ $report->feedback_professionalism }}</strong></div>
            <div>Improvement Tracking: <strong>{{ $report->improvement_tracking ? 'Yes' : 'No' }}</strong></div>
            <div>Repeat Error Follow-up: <strong>{{ $report->repeat_error_followup ? 'Yes' : 'No' }}</strong></div>
        </div>

        <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Compliance</div>
            <div>Attendance Adherence: <strong>{{ $report->attendance_adherence ? 'Yes' : 'No' }}</strong></div>
            <div>Punctuality: <strong>{{ $report->punctuality ? 'Yes' : 'No' }}</strong></div>
            <div>Data Confidentiality Awareness: <strong>{{ $report->data_confidentiality_awareness }}</strong></div>
            <div>Policy Compliance: <strong>{{ $report->policy_compliance }}</strong></div>
        </div>

        <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;">
            <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Observations</div>
                <div>Strengths: <strong>{{ $report->strengths }}</strong></div>
                <div>Improvement Areas: <strong>{{ $report->improvement_areas }}</strong></div>
            </div>
            <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Summary</div>
                <div>Average Quality Score: <strong>{{ $report->average_quality_score }}</strong></div>
                <div>Error Count: <strong>{{ $report->error_count }}</strong></div>
                <div>Critical Errors: <strong>{{ $report->critical_errors }}</strong></div>
                <div>Repeat Errors: <strong>{{ $report->repeat_errors }}</strong></div>
                <div>Overall Rating: <strong>{{ $report->overall_rating }}</strong></div>
            </div>
        </div>

        <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Final Remarks</div>
            <div>{{ $report->final_remarks }}</div>
            <div style="margin-top:8px;">Evaluator: <strong>{{ $report->evaluator_name }}</strong></div>
        </div>
    </div>
@endsection
