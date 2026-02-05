<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Agent Chat Evaluations</title>
    <style>
        @page {
            size: A4;
            margin: 18mm 16mm 18mm 16mm;
        }

        :root {
            --ink: #0f172a;
            --muted: #5a6473;
            --line: #e5e7eb;
            --accent: #1d4ed8;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            color: var(--ink);
            background: #fff;
            font-size: 12px;
        }

        .page {
            page-break-after: always;
            position: relative;
            width: 100%;
        }

        .page:last-child { page-break-after: auto; }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            opacity: 0.08;
            z-index: 0;
        }

        .watermark img {
            width: 560px;
            max-width: 95%;
            transform: rotate(-18deg);
        }

        .header {
            position: relative;
            z-index: 1;
            display: table;
            table-layout: fixed;
            width: 100%;
            border-bottom: 2px solid #dbeafe;
            background: linear-gradient(90deg, #eff6ff, #ffffff);
            padding: 12px 14px;
            border-radius: 12px;
        }

        .header > div {
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }

        .brand .title {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.4px;
        }

        .brand .subtitle {
            font-size: 11px;
            color: var(--muted);
            margin-top: 2px;
        }

        .header-left { display: block; }

        .header-left { display: block; }

        .report-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 8px;
            border-radius: 999px;
            background: #e0e7ff;
            color: #1e40af;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .meta {
            text-align: right;
            font-size: 12px;
            color: var(--muted);
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }

        .section {
            position: relative;
            z-index: 1;
            margin-top: 12px;
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 12px 14px;
        }

        .section h3 {
            margin: 0 0 10px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--muted);
        }

        .grid-table,
        .scores-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        .grid-table td,
        .scores-table td {
            padding: 4px 6px;
            vertical-align: top;
        }

        .grid-table td strong,
        .scores-table td strong {
            color: var(--ink);
        }

        .overall {
            display: table;
            table-layout: fixed;
            width: 100%;
            margin-top: 8px;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px dashed #c7d2fe;
            background: #eef2ff;
        }

        .overall > div {
            display: table-cell;
            vertical-align: middle;
        }

        .overall .score {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 18px;
            font-weight: 800;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 11px;
            font-weight: 600;
        }

        .remarks {
            color: var(--ink);
            white-space: pre-line;
        }

        .footer {
            position: relative;
            z-index: 1;
            margin-top: 12px;
            display: table;
            table-layout: fixed;
            width: 100%;
            font-size: 11px;
            color: var(--muted);
            border-top: 1px solid var(--line);
            padding-top: 8px;
        }

        .footer > div {
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }

        .footer-right {
            text-align: right;
        }
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
@foreach ($evaluations as $evaluation)
    <div class="page">
        <div class="watermark">
            @if ($logoData)
                <img src="{{ $logoData }}" alt="Watermark">
            @endif
        </div>

        <div class="header">
            <div>
                <span class="report-chip">Confidential</span>
                <div class="title">Agent Chat Evaluation</div>
                <div class="subtitle">Internal Report</div>
            </div>
            <div class="meta">
                @if ($logoData)
                    <img src="{{ $logoData }}" alt="Logo">
                @endif
               
            </div>
        </div>

        <div class="section">
            <h3>Basic Details</h3>
            <table class="grid-table">
                <tr>
                    <td>Project: <strong>{{ $evaluation->project_name }}</strong></td>
                    <td>Center: <strong>{{ $evaluation->center_name }}</strong></td>
                </tr>
                <tr>
                    <td>Location: <strong>{{ $evaluation->location }}</strong></td>
                    <td>Evaluator: <strong>{{ $evaluation->evaluator_name }}</strong></td>
                </tr>
                <tr>
                    <td>Agent ID: <strong>{{ $evaluation->agent_id }}</strong></td>
                    <td>Agent Name: <strong>{{ $evaluation->agent_name }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>Scores</h3>
            <table class="scores-table">
                <tr>
                    <td>Communication Skills: <strong>{{ $evaluation->communication_skills }}</strong></td>
                    <td>Opening/Closing: <strong>{{ $evaluation->opening_closing }}</strong></td>
                    <td>Grammar: <strong>{{ $evaluation->grammar }}</strong></td>
                </tr>
                <tr>
                    <td>Chat Etiquettes: <strong>{{ $evaluation->chat_etiquettes }}</strong></td>
                    <td>Scenario Based: <strong>{{ $evaluation->scenario_based_questions }}</strong></td>
                    <td>Response Time: <strong>{{ $evaluation->response_time }}</strong></td>
                </tr>
                <tr>
                    <td>CRM Knowledge: <strong>{{ $evaluation->crm_knowledge }}</strong></td>
                    <td>Customer Handling: <strong>{{ $evaluation->customer_handling }}</strong></td>
                    <td>Quality/Accuracy: <strong>{{ $evaluation->quality_accuracy }}</strong></td>
                </tr>
            </table>
            <div class="overall">
                <div>
                    Overall Score
                    <!-- <span class="pill">{{ $evaluation->percentage }}%</span> -->
                </div>
                <div class="score">{{ $evaluation->percentage }}%</div>
            </div>
        </div>

        <div class="section">
            <h3>Remarks</h3>
            <div class="remarks">{{ $evaluation->evaluator_remarks }}</div>
        </div>

        <div class="footer">
            <div>Bitmax Admin System</div>
            <div class="footer-right">
                <div>Generated on {{ date('Y-m-d H:i:s') }}</div>
            </div>
        </div>
    </div>
@endforeach
</body>
</html>