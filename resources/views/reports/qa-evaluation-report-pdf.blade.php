<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QA Evaluation Report</title>
    <style>
        @page { size: A4; margin: 18mm 16mm; }
        :root { --ink:#0f172a; --muted:#5a6473; --line:#e5e7eb; --accent:#1d4ed8; }
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
                <div class="title">QA Evaluation Report</div>
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
                    <td>Client: <strong>{{ $report->client_name }}</strong></td>
                </tr>
                <tr>
                    <td>Reporting Manager: <strong>{{ $report->reporting_manager }}</strong></td>
                    <td>Audit Type: <strong>{{ $report->audit_type }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>Work Performance</h3>
            <table class="grid-table">
                <tr>
                    <td>Audit Accuracy: <strong>{{ $report->audit_accuracy_rating }}</strong></td>
                    <td>Process Knowledge: <strong>{{ $report->process_knowledge_rating }}</strong></td>
                </tr>
                <tr>
                    <td>Compliance SOP: <strong>{{ $report->compliance_sop_rating }}</strong></td>
                    <td>Reporting Accuracy: <strong>{{ $report->reporting_accuracy_rating }}</strong></td>
                </tr>
                <tr>
                    <td>Productivity: <strong>{{ $report->productivity_rating }}</strong></td>
                    <td>Escalation Handling: <strong>{{ $report->escalation_handling_rating }}</strong></td>
                </tr>
                <tr>
                    <td>Documentation Skills: <strong>{{ $report->documentation_skills_rating }}</strong></td>
                    <td>Overall Rating: <strong>{{ $report->overall_rating }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>QA Skills & Compliance</h3>
            <table class="grid-table">
                <tr>
                    <td>Monitoring Quality: <strong>{{ $report->monitoring_quality }}</strong></td>
                    <td>Error Identification: <strong>{{ $report->error_identification }}</strong></td>
                </tr>
                <tr>
                    <td>Correct Parameter Marking: <strong>{{ $report->correct_parameter_marking ? 'Yes' : 'No' }}</strong></td>
                    <td>Score Calculation Accuracy: <strong>{{ $report->score_calculation_accuracy ? 'Yes' : 'No' }}</strong></td>
                </tr>
                <tr>
                    <td>Attendance Adherence: <strong>{{ $report->attendance_adherence ? 'Yes' : 'No' }}</strong></td>
                    <td>Punctuality: <strong>{{ $report->punctuality ? 'Yes' : 'No' }}</strong></td>
                </tr>
                <tr>
                    <td>Data Confidentiality: <strong>{{ $report->data_confidentiality_awareness }}</strong></td>
                    <td>Policy Compliance: <strong>{{ $report->policy_compliance }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>Summary</h3>
            <table class="grid-table">
                <tr>
                    <td>Average Quality Score: <strong>{{ $report->average_quality_score }}</strong></td>
                    <td>Error Count: <strong>{{ $report->error_count }}</strong></td>
                </tr>
                <tr>
                    <td>Critical Errors: <strong>{{ $report->critical_errors }}</strong></td>
                    <td>Repeat Errors: <strong>{{ $report->repeat_errors }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>Final Remarks</h3>
            <div style="white-space: pre-line;">{{ $report->final_remarks }}</div>
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
