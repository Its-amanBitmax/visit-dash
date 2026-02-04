<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center Visit Evaluation Report</title>
    <style>
        @page { size: A4; margin: 18mm 16mm; }
        :root { --ink:#0f172a; --muted:#5a6473; --line:#e5e7eb; --accent:#1d4ed8; }
        * { box-sizing: border-box; }
        body { margin:0; font-family:"Segoe UI", Arial, sans-serif; font-size:12px; color:var(--ink); }
        .page { position: relative; width:100%; }
        .watermark { position: fixed; top:50%; left:50%; transform:translate(-50%,-50%); opacity:0.08; z-index:0; }
        .watermark img { width:560px; max-width:95%; transform:rotate(-18deg); }
        .header { position:relative; z-index:1; display:table; table-layout:fixed; width:100%; border-bottom:2px solid #dbeafe; background:linear-gradient(90deg,#eff6ff,#ffffff); padding:12px 14px; border-radius:12px; }
        .header-left { display:table-cell; vertical-align:top; width:50%; }
        .header-left { display:grid; gap:6px; }
        .title { font-size:20px; font-weight:700; letter-spacing:0.4px; }
        .subtitle { font-size:11px; color:var(--muted); }
        .chip { display:inline-flex; align-items:center; padding:3px 8px; border-radius:999px; background:#e0e7ff; color:#1e40af; font-size:10px; font-weight:700; letter-spacing:0.6px; text-transform:uppercase; }
        .meta { text-align:right; font-size:12px; color:var(--muted); display:table-cell; vertical-align:top; width:50%; }
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
            <div class="header-left">
                <span class="chip">Confidential</span>
                <div class="title">Center Visit Evaluation</div>
                <div class="subtitle">Internal Report</div>
            </div>
            <div class="meta">
                <div>Report Summary</div>
                <div>Visit Date: {{ $evaluation->visit_date }}</div>
            </div>
        </div>

        <div class="section">
            <h3>Basic Details</h3>
            <table class="grid-table">
                <tr>
                    <td>Center Name: <strong>{{ $evaluation->center_name }}</strong></td>
                    <td>Location: <strong>{{ $evaluation->location }}</strong></td>
                </tr>
                <tr>
                    <td>Visit Date: <strong>{{ $evaluation->visit_date }}</strong></td>
                    <td>Duration: <strong>{{ $evaluation->duration }}</strong></td>
                </tr>
                <tr>
                    <td>Evaluator: <strong>{{ $evaluation->evaluator_name }}</strong></td>
                    <td></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>Infrastructure</h3>
            <table class="grid-table">
                <tr>
                    <td>Status: <strong>{{ $evaluation->infrastructure_by_client }}</strong></td>
                    <td>Remarks: <strong>{{ $evaluation->remarks1 }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>System Required</h3>
            <table class="grid-table">
                <tr>
                    <td>Status: <strong>{{ $evaluation->system_required_by_client }}</strong></td>
                    <td>Remarks: <strong>{{ $evaluation->remarks2 }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>Manpower Required</h3>
            <table class="grid-table">
                <tr>
                    <td>Status: <strong>{{ $evaluation->manpower_required_by_client }}</strong></td>
                    <td>Remarks: <strong>{{ $evaluation->remarks3 }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>Evaluator Remarks</h3>
            <div style="white-space: pre-line;">{{ $evaluation->evaluator_remarks }}</div>
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
