<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TL Evaluation Report</title>
    <style>
        @page { size: A4; margin: 18mm 16mm; }
        :root { --ink:#0f172a; --muted:#5a6473; --line:#e5e7eb; }
        * { box-sizing: border-box; }
        body { margin:0; font-family:"Segoe UI", Arial, sans-serif; font-size:12px; color:var(--ink); }
        .page { position: relative; width:100%; }
        .watermark { position: fixed; top:50%; left:50%; transform:translate(-50%,-50%); opacity:0.08; z-index:0; }
        .watermark img { width:560px; max-width:95%; transform:rotate(-18deg); }
        .header { position:relative; z-index:1; display:table; table-layout:fixed; width:100%; border-bottom:2px solid #dbeafe; background:linear-gradient(90deg,#eff6ff,#ffffff); padding:12px 14px; border-radius:12px; }
        .header > div { display:table-cell; vertical-align:top; width:50%; }
        .title { font-size:20px; font-weight:700; letter-spacing:0.4px; }
        .subtitle { display:inline-block; margin-top:6px; padding:3px 8px; border-radius:999px; background:#e0e7ff; color:#1e40af; font-size:10px; font-weight:700; letter-spacing:0.3px; }
        .chip { display:inline-flex; align-items:center; padding:3px 8px; border-radius:999px; background:#e0e7ff; color:#1e40af; font-size:10px; font-weight:700; letter-spacing:0.6px; text-transform:uppercase; }
        .meta { text-align:right; font-size:12px; color:var(--muted); display:table-cell; vertical-align:top; width:50%; }
        .meta img { height:60px; width:auto; margin-bottom:4px; opacity:0.9; }
        .section { position:relative; z-index:1; margin-top:12px; border:1px solid var(--line); border-radius:12px; padding:12px 14px; }
        .section h3 { margin:0 0 10px; font-size:13px; text-transform:uppercase; letter-spacing:0.8px; color:var(--muted); }
        .grid-table { width:100%; border-collapse:collapse; font-size:12px; }
        .grid-table td { padding:4px 6px; vertical-align:top; }
        .footer { position:relative; z-index:1; margin-top:12px; display:table; table-layout:fixed; width:100%; font-size:11px; color:var(--muted); border-top:1px solid var(--line); padding-top:8px; }
        .footer > div { display:table-cell; vertical-align:top; width:50%; }
        .footer-right { text-align:right; }
    </style>
</head>
<body>
    @php
        $logoPath = public_path('yello.png');
        $logoData = '';
        if (is_file($logoPath)) {
            $logoData = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
        }
    @endphp
    <div class="page">
        <div class="watermark">
            @if ($logoData)
                <img src="{{ $logoData }}" alt="Watermark">
            @endif
        </div>

        <div class="header">
            <div>
                <span class="chip">Confidential</span>
                <div class="title">TL Evaluation Report</div>
                <div class="subtitle">Evaluation Date: {{ $report->evaluation_date }}</div>
            </div>
            <div class="meta">
                @if ($logoData)
                    <img src="{{ $logoData }}" alt="Logo">
                @endif
                <!-- <div>Report Summary</div>
                <div>Evaluation Date: {{ $report->evaluation_date }}</div> -->
            </div>
        </div>

        <div class="section">
            <h3>Basic Details</h3>
            <table class="grid-table">
                <tr>
                    <td>Name: <strong>{{ $report->name }}</strong></td>
                    <td>Employee ID: <strong>{{ $report->employee_id }}</strong></td>
                </tr>
                <tr>
                    <td>Project: <strong>{{ $report->process_project }}</strong></td>
                    <td>Team Strength: <strong>{{ $report->team_strength }}</strong></td>
                </tr>
                <tr>
                    <td>Evaluation From: <strong>{{ $report->evaluation_from }}</strong></td>
                    <td>Evaluation To: <strong>{{ $report->evaluation_to }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>TL Performance</h3>
            <table class="grid-table">
                <tr>
                    <td>Team Handling: <strong>{{ $report->team_handling_rating }}</strong></td>
                    <td>Productivity Achievement: <strong>{{ $report->productivity_achievement_rating }}</strong></td>
                </tr>
                <tr>
                    <td>Quality Improvement: <strong>{{ $report->quality_improvement_rating }}</strong></td>
                    <td>Attendance Management: <strong>{{ $report->attendance_management_rating }}</strong></td>
                </tr>
                <tr>
                    <td>Training & Coaching: <strong>{{ $report->training_coaching_rating }}</strong></td>
                    <td>Escalation Handling: <strong>{{ $report->escalation_handling_rating }}</strong></td>
                </tr>
                <tr>
                    <td>Client Communication: <strong>{{ $report->client_communication_rating }}</strong></td>
                    <td>Reporting & Documentation: <strong>{{ $report->reporting_documentation_rating }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>KPI Performance Review</h3>
            <table class="grid-table">
                <tr>
                    <td>AHT: <strong>{{ $report->kpi_aht_target }}</strong> / <strong>{{ $report->kpi_aht_achieved }}</strong> ({{ $report->kpi_aht_status }})</td>
                    <td>QA: <strong>{{ $report->kpi_qa_target }}</strong> / <strong>{{ $report->kpi_qa_achieved }}</strong> ({{ $report->kpi_qa_status }})</td>
                </tr>
                <tr>
                    <td>CSAT: <strong>{{ $report->kpi_csat_target }}</strong> / <strong>{{ $report->kpi_csat_achieved }}</strong> ({{ $report->kpi_csat_status }})</td>
                    <td>Attendance: <strong>{{ $report->kpi_attendance_target }}</strong> / <strong>{{ $report->kpi_attendance_achieved }}</strong> ({{ $report->kpi_attendance_status }})</td>
                </tr>
                <tr>
                    <td>Productivity: <strong>{{ $report->kpi_productivity_target }}</strong> / <strong>{{ $report->kpi_productivity_achieved }}</strong> ({{ $report->kpi_productivity_status }})</td>
                    <td></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>Leadership & Communication</h3>
            <table class="grid-table">
                <tr>
                    <td>Discipline Maintained: <strong>{{ $report->team_discipline_maintained ? 'Yes' : 'No' }}</strong></td>
                    <td>Shift Adherence: <strong>{{ $report->shift_adherence ? 'Yes' : 'No' }}</strong></td>
                </tr>
                <tr>
                    <td>Roster Planning: <strong>{{ $report->roster_planning ? 'Yes' : 'No' }}</strong></td>
                    <td>Attrition Control: <strong>{{ $report->attrition_control }}</strong></td>
                </tr>
                <tr>
                    <td>Client Communication: <strong>{{ $report->client_communication }}</strong></td>
                    <td>Internal Reporting: <strong>{{ $report->internal_reporting }}</strong></td>
                </tr>
                <tr>
                    <td>Escalation Speed: <strong>{{ $report->escalation_closure_speed }}</strong></td>
                    <td>Coordination with HR: <strong>{{ $report->coordination_with_hr }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>Recommendations</h3>
            <table class="grid-table">
                <tr>
                    <td>Promotion: <strong>{{ $report->promotion_recommended ? 'Yes' : 'No' }}</strong></td>
                    <td>Training: <strong>{{ $report->training_required ? 'Yes' : 'No' }}</strong></td>
                </tr>
                <tr>
                    <td>Warning: <strong>{{ $report->warning_required ? 'Yes' : 'No' }}</strong></td>
                    <td>PIP: <strong>{{ $report->pip_recommended ? 'Yes' : 'No' }}</strong></td>
                </tr>
                <tr>
                    <td>Salary Revision: <strong>{{ $report->salary_revision ? 'Yes' : 'No' }}</strong></td>
                    <td></td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <div>Bitmax Admin System</div>
            <div class="footer-right">
                <div>Generated on {{ date('Y-m-d H:i:s') }}</div>
            </div>
        </div>
    </div>
</body>
</html>
