@extends('admin.layout')

@section('title', 'TL Report Details')
@section('header', 'TL Report Details')

@section('content')
    <div class="page-card" style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
        <div>
            <div style="font-size:18px;font-weight:700;">TL Report #{{ $report->id }}</div>
            <div style="color:#606776;">{{ $report->name }} - {{ $report->employee_id }}</div>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <a class="btn" href="{{ route('tl-evaluation-reports.pdf', $report->id) }}">Download PDF</a>
            <a class="btn btn-secondary" href="{{ route('tl-evaluation-reports.edit', $report->id) }}">Edit</a>
            <a class="btn" href="{{ route('tl-evaluation-reports.index') }}">Back</a>
        </div>
    </div>

    <div class="page-card" style="display:grid;gap:18px;">
        <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;">
            <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Basic</div>
                <div>Name: <strong>{{ $report->name }}</strong></div>
                <div>Employee ID: <strong>{{ $report->employee_id }}</strong></div>
                <div>Project: <strong>{{ $report->process_project }}</strong></div>
                <div>Team Strength: <strong>{{ $report->team_strength }}</strong></div>
                <div>Evaluation Period: <strong>{{ $report->evaluation_from }}</strong> to <strong>{{ $report->evaluation_to }}</strong></div>
                <div>Evaluation Date: <strong>{{ $report->evaluation_date }}</strong></div>
            </div>
            <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Final Rating</div>
                <div>Overall: <strong>{{ $report->overall_rating }}/5</strong></div>
                <div>Evaluator: <strong>{{ $report->evaluator_name }}</strong></div>
                <div>Final Remarks: <strong>{{ $report->final_remarks }}</strong></div>
            </div>
        </div>

        <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">TL Performance</div>
            <div>Team Handling: <strong>{{ $report->team_handling_rating }}</strong></div>
            <div>Productivity Achievement: <strong>{{ $report->productivity_achievement_rating }}</strong></div>
            <div>Quality Improvement: <strong>{{ $report->quality_improvement_rating }}</strong></div>
            <div>Attendance Management: <strong>{{ $report->attendance_management_rating }}</strong></div>
            <div>Training & Coaching: <strong>{{ $report->training_coaching_rating }}</strong></div>
            <div>Escalation Handling: <strong>{{ $report->escalation_handling_rating }}</strong></div>
            <div>Client Communication: <strong>{{ $report->client_communication_rating }}</strong></div>
            <div>Reporting & Documentation: <strong>{{ $report->reporting_documentation_rating }}</strong></div>
        </div>

        <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">KPI Performance</div>
            <div>AHT: <strong>{{ $report->kpi_aht_target }}</strong> / <strong>{{ $report->kpi_aht_achieved }}</strong> ({{ $report->kpi_aht_status }})</div>
            <div>QA: <strong>{{ $report->kpi_qa_target }}</strong> / <strong>{{ $report->kpi_qa_achieved }}</strong> ({{ $report->kpi_qa_status }})</div>
            <div>CSAT: <strong>{{ $report->kpi_csat_target }}</strong> / <strong>{{ $report->kpi_csat_achieved }}</strong> ({{ $report->kpi_csat_status }})</div>
            <div>Attendance: <strong>{{ $report->kpi_attendance_target }}</strong> / <strong>{{ $report->kpi_attendance_achieved }}</strong> ({{ $report->kpi_attendance_status }})</div>
            <div>Productivity: <strong>{{ $report->kpi_productivity_target }}</strong> / <strong>{{ $report->kpi_productivity_achieved }}</strong> ({{ $report->kpi_productivity_status }})</div>
        </div>

        <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Leadership</div>
            <div>Discipline Maintained: <strong>{{ $report->team_discipline_maintained ? 'Yes' : 'No' }}</strong></div>
            <div>Shift Adherence: <strong>{{ $report->shift_adherence ? 'Yes' : 'No' }}</strong></div>
            <div>Roster Planning: <strong>{{ $report->roster_planning ? 'Yes' : 'No' }}</strong></div>
            <div>Attrition Control: <strong>{{ $report->attrition_control }}</strong></div>
            <div>Coaching Sessions: <strong>{{ $report->regular_coaching_sessions ? 'Yes' : 'No' }}</strong></div>
            <div>Training Plan: <strong>{{ $report->training_plan_prepared ? 'Yes' : 'No' }}</strong></div>
            <div>Performance Tracking: <strong>{{ $report->performance_improvement_tracking ? 'Yes' : 'No' }}</strong></div>
            <div>Low Performer Management: <strong>{{ $report->low_performer_management }}</strong></div>
        </div>

        <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Communication</div>
            <div>Client Communication: <strong>{{ $report->client_communication }}</strong></div>
            <div>Internal Reporting: <strong>{{ $report->internal_reporting }}</strong></div>
            <div>Escalation Closure Speed: <strong>{{ $report->escalation_closure_speed }}</strong></div>
            <div>Coordination with HR/Operations: <strong>{{ $report->coordination_with_hr }}</strong></div>
        </div>

        <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;">
            <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Strengths</div>
                <div>{{ $report->strengths1 }}</div>
                <div>{{ $report->strengths2 }}</div>
                <div>{{ $report->strengths3 }}</div>
            </div>
            <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Improvement Areas</div>
                <div>{{ $report->improvement1 }}</div>
                <div>{{ $report->improvement2 }}</div>
                <div>{{ $report->improvement3 }}</div>
            </div>
        </div>

        <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Recommendations</div>
            <div>Promotion: <strong>{{ $report->promotion_recommended ? 'Yes' : 'No' }}</strong></div>
            <div>Training: <strong>{{ $report->training_required ? 'Yes' : 'No' }}</strong></div>
            <div>Warning: <strong>{{ $report->warning_required ? 'Yes' : 'No' }}</strong></div>
            <div>PIP: <strong>{{ $report->pip_recommended ? 'Yes' : 'No' }}</strong></div>
            <div>Salary Revision: <strong>{{ $report->salary_revision ? 'Yes' : 'No' }}</strong></div>
        </div>
    </div>
@endsection
